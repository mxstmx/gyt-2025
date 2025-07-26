<?php
	
	namespace Eventin\Order;
	
	use Etn\Core\Attendee\Attendee_Model;
	use Etn\Core\Event\Event_Model;
	use Eventin\Emails\AdminOrderEmail;
	use Eventin\Emails\AttendeeOrderEmail;
	use Eventin\Mails\Mail;
	use Eventin\Settings;
	use WP_Error;
	use WP_REST_Controller;
	use WP_REST_Server;
	use EventinPro\Integrations\Stripe\StripePayment;
	use EventinPro\Integrations\Paypal\PaypalPayment;
	
	/**
	 * Payment controller class
	 *
	 * @package Eventin
	 */
	class PaymentController extends WP_REST_Controller
	{
		/**
		 * Constructor for PaymentController
		 *
		 * @return void
		 */
		public function __construct()
		{
			$this->namespace = 'eventin/v2';
			$this->rest_base = 'payment';
		}
		
		/**
		 * Check if a given request has access to get items.
		 *
		 * @param WP_REST_Request $request Full data about the request.
		 * @return WP_Error|boolean
		 */
		public function register_routes()
		{
			register_rest_route($this->namespace, $this->rest_base, [
				[
					'methods' => WP_REST_Server::CREATABLE,
					'callback' => [$this, 'create_payment'],
					'permission_callback' => [$this, 'create_payment_permission_check'],
				],
				[
					'methods' => WP_REST_Server::EDITABLE,
					'callback' => [$this, 'payment_complete'],
					'permission_callback' => [$this, 'create_payment_permission_check'],
				],
			]);
		}
		
		/**
		 * Create payment persmission check
		 *
		 * @param WP_REST_Request $request
		 *
		 * @return  bool
		 */
		public function create_payment_permission_check($request)
		{
			return true;
		}
		
		/**
		 * Create payment itentents
		 *
		 * @param WP_REST_Request $request
		 *
		 * @return  JSON
		 */
		public function create_payment( $request ) {
			$data            = json_decode($request->get_body(), true);
			$order_id        = ! empty( $data['order_id'] ) ? intval( $data['order_id'] ) : 0;
			$payment_method  = ! empty( $data['payment_method'] ) ? sanitize_text_field( $data['payment_method'] ) : '';
			$payment         = PaymentFactory::get_method($payment_method);
			$order           = new OrderModel($order_id);
            $validate_ticket = $order->validate_ticket();

            if ( is_wp_error( $validate_ticket ) ) {
                return new WP_Error('payment_error', $validate_ticket->get_error_message());
            }
			
			$response = $payment->create_payment($order);
			
			if (is_wp_error($response)) {
				return new WP_Error('payment_error', $response->get_error_message());
			}
			
			// Update payment id.
			$order->update([
				'payment_id' => $response['id'],
				'payment_method' => $payment_method
			]);
			
			return rest_ensure_response($response);
		}
		
		/**
		 * @title Payment complete
		 * @description
		 * @return JSON
		 */
		public function payment_complete($request)
		{
			
			$data = json_decode($request->get_body(), true);
			$order_id = !empty($data['order_id']) ? intval($data['order_id']) : 0;
			$payment_status = !empty($data['payment_status']) ? $data['payment_status'] : 0;
			$payment_method = !empty($data['payment_method']) ? $data['payment_method'] : null;
            $order           = new OrderModel( $order_id );
            $validate_ticket = $order->validate_ticket();

            if ( is_wp_error( $validate_ticket ) ) {
                return $validate_ticket;
            }
			
			if (!in_array($data['payment_method'], ['stripe', 'paypal', 'free-ticket', 'local_payment'])) {
				return rest_ensure_response(["unauthorized"]);
			}
			
			if ( 'local_payment' === $payment_method && ( ! current_user_can('administrator') ) ) {
				return rest_ensure_response(["unauthorized"]);
			}
			
			if ( 'free-ticket' === $data['payment_method'] )
			{
				$order = new OrderModel($order_id);
				if ( $order->total_price >  0 ) {
					return rest_ensure_response([
						'success' => false,
						'message' => __('Payment Update Failed..', 'eventin'),
					]);
				}
			}
			else
			{
				// if payment_method stripe
				if ( 'stripe' === $data['payment_method'] ) {
					$stripe_transaction_id = $data['stripe_transaction_id'];
					
					$args = [
						'post_type' => 'etn-order', // Change to your post type
						'post_status' => 'draft', // Change to your post type
						'posts_per_page' => -1, // Get all posts
						'meta_query' => [
							[
								'key' => 'payment_id',
								'value' => $stripe_transaction_id,
								'compare' => '='
							],
							[
								'key' => 'status',
								'value' => "failed",
								'compare' => '!='
							]
						]
					];
					$post_query = new \WP_Query($args);
					$query_result = $post_query->query($args);
					$total_posts = $post_query->found_posts;
					
					// check if transaction_id is of another order
					if ($total_posts) {
						return rest_ensure_response($response = [
							'success' => false,
							'message' => __('Unexpected Error', 'eventin'),
						]);
					}
					
					try {
						$response = StripePayment::retrieveIntent($stripe_transaction_id);
					} catch (\Exception $exception) {
						return rest_ensure_response($response = [
							'success' => false,
							'message' => __('Unexpected Error', 'eventin'),
						]);
					}
					if ( $response["status"]["status"] != "succeeded" )
						return rest_ensure_response($response = [
							'success' => false,
							'message' => __('Payment Update Failed..', 'eventin'),
						]);
				}
				
				// if payment_method paypal
				if ( 'paypal' === $data['payment_method'] ) {
					$paypal_transaction_id = $data['paypal_transaction_id'];
					$args = [
						'post_type' => 'etn-order', // Change to your post type
						'post_status' => 'draft', // Change to your post type
						'posts_per_page' => -1, // Get all posts
						'meta_query' => [
							[
								'key' => 'payment_id',
								'value' => $paypal_transaction_id,
								'compare' => '='
							],
							[
								'key' => 'status',
								'value' => "failed",
								'compare' => '!='
							]
						]
					];
					$post_query = new \WP_Query($args);
					$query_result = $post_query->query($args);
					$total_posts = $post_query->found_posts;
					
					// check if transaction_id is of another order
					if ($total_posts) {
						return rest_ensure_response($response = [
							'success' => false,
							'message' => __('Unexpected Error', 'eventin'),
						]);
					}
					
					try {
						$paypalPayment = new PaypalPayment();
					} catch (\Exception $exception) {
						return rest_ensure_response([
							'success' => false,
							'message' => __('Unexpected Error', 'eventin'),
						]);
					}
					$response = $paypalPayment->retrievePaymentCapture($paypal_transaction_id);
					
					if (!in_array($response["status"]["status"], ["APPROVED", "COMPLETED"])) {
						return rest_ensure_response([
							'success' => false,
							'message' => __('Payment Update Failed', 'eventin'),
						]);
					}
				}
			}
			
			
			$order = new OrderModel($order_id);
		
			// if payment_method is local_payment
			if ( 'local_payment' === $payment_method && current_user_can('administrator') ) {
				$order->update([
					'payment_method' => $payment_method
				]);
			}
			
			if ( 'completed' === $order->status ) {
				$response = [
					'success' => true,
					'message' => __('Successfully payment updated', 'eventin'),
				];
				return rest_ensure_response($response);
			}
			
			if ( 'success' !== $payment_status ) {
				return new WP_Error('payment_error', __('Failed to completed your order', 'eventin'), ['status' => 422]);
			}
			
			
			if ( 'wc' === $order->payment_method && !$this->wc_payment($order_id) ) {
				return new WP_Error('payment_error', __('Invalid payment', 'eventin'), ['status' => 422]);
			}
			
			
			$order->update([
				'status' => 'completed'
			]);
			
			do_action('eventin_order_completed', $order);
			$this->send_email($order);
			
			$response = [
				'success' => true,
				"wc_payment_done" => $this->wc_payment($order_id),
				'message' => __('Successfully payment updated', 'eventin'),
			];
			
			return rest_ensure_response($response);
		}
		
		/**
		 * Check wc order is completed
		 *
		 * @param integer $eventin_order_id [$eventin_order_id description]
		 *
		 * @return  bool
		 */
		private function wc_payment($eventin_order_id)
		{
			$post_type = etn_is_enable_wc_synchronize_order() ? 'shop_order' : 'shop_order_placehold';
			
			$args = [
				'post_type' => $post_type,
				'post_status' => 'any',
				'posts_per_page' => -1,
				'fields' => 'ids',
				'meta_query' => [
					[
						'key' => 'eventin_order_id',
						'value' => $eventin_order_id,
						'compare' => '='
					]
				]
			];
			
			
			$orders_ids = get_posts($args);
			
			if (!$orders_ids) {
				return false;
			}
			
			$order = wc_get_order($orders_ids[0]);
			
			if (!$order) {
				return false;
			}
			
			$statuses = etn_get_wc_order_statuses();
			
			if (!in_array($order->get_status(), $statuses)) {
				return false;
			}
			
			return true;
		}
		
		/**
		 * Send email after payment complete
		 *
		 * @param OrderModel $order [$order description]
		 *
		 * @return  void
		 */
		private function send_email($order)
		{
			$order->send_email();
		}
	}