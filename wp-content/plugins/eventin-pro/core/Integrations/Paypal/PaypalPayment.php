<?php
/**
 * Paypal Payment Method
 * 
 * @package Eventin Pro
 */
namespace EventinPro\Integrations\Paypal;

use Eventin\Order\OrderModel;
use Eventin\Order\PaymentInterface;
use WP_Error;

class PaypalPayment implements PaymentInterface {
    /**
     * Store paypal object
     *
     * @var Paypal
     */
    private $paypal;

    /**
     * Constructor for PaypalPayment class
     *
     * @return  void
     */
    public function __construct() {
        $config = $this->get_config();

        if ( is_wp_error( $config ) ) {
            return $config;
        }

        $this->paypal = new Paypal( $config );
    }

    /**
     * Create payment using Paypal
     *
     * @param   OrderModel  $order  Order object which need to be
     *
     * @return  string | WP_Error
     */
    public function create_payment( OrderModel $order ) {
        

        $response = $this->paypal->create_payment([
            'amount'    => $order->total_price,
            'currency'  => etn_get_option( 'etn_settings_country_currency', 'USD' ),
        ]);

        return $response;
    }

     /**
     * Create refund for woocommere order
     *
     * @param   OrderModel  $order
     *
     * @return
     */
    public function refund( OrderModel $order ) {
        return $this->paypal->refund( $order->payment_id );
    }

    /**
     * Complate paypal payment order
     *
     * @param   OrderModel  $order
     *
     * @return  void
     */
    public function complete_order( OrderModel $order ) {
        $this->paypal->complete_order( $order->payment_id );
    }

    /**
     * Get paypal config
     *
     * @return  array
     */
    private function get_config() {
        $client_id = etn_get_option( 'paypal_client_id' );
        $client_secret = etn_get_option( 'paypal_client_secret' );

        if ( ! $client_id || ! $client_secret ) {
            return new WP_Error( 'secret_key_error', 'Something went wrong please try again' );
        }

        return [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'is_sandbox'    => etn_get_option( 'paypal_sandbox', false ),
        ];
    }
	
	/**
	 * @return Paypal
	 */
	public function retrievePaymentCapture( $payment_transaction_id ) {
		//$this->paypal->retrieve_capture_id($payment_transaction_id);
		
		if ( 1 || isset( $body['status'] ) ) {
			return [
				'success' => true,
				'status'  => $this->paypal->retrieve_capture_id($payment_transaction_id) // Possible values: COMPLETED, PENDING, FAILED, etc.
			];
		}
		
		return new WP_Error( 'paypal_invalid_response', 'Invalid response from PayPal' );
	}
	
}
