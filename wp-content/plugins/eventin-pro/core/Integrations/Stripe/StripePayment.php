<?php
/**
 * Stripe Payment Method
 * 
 * @package Eventin Pro
 */

namespace EventinPro\Integrations\Stripe;

use Eventin\Order\OrderModel;
use Eventin\Order\PaymentInterface;
use WP_Error;

class StripePayment implements PaymentInterface {
    /**
     * Store stripe object
     *
     * @var Stripe
     */
    private $stripe;

    public function __construct() {
        $secret = etn_get_option('stripe_live_secret_key');

        if ( ! $secret ) {
            return new WP_Error( 'secret_key_error', 'You must provide stripe secret key' );
        }

        $this->stripe = new Stripe( $secret );
    }

    /**
     * Create payment using stripe
     *
     * @param   OrderModel  $order  Order object which need to be
     *
     * @return  string
     */
    public function create_payment( OrderModel $order ) {
        $response = $this->stripe->create_payment([
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
        return $this->stripe->create_refund( $order->payment_id );
    }
	
	
	
	
	public static function retrieveIntent( $payment_intent_id )
	{
		$secret = etn_get_option('stripe_live_secret_key');
		
		$url = "https://api.stripe.com/v1/payment_intents";
		$url = "{$url}/$payment_intent_id";
		
		$params = [
			'headers' => [
				'Authorization' => 'Bearer ' . $secret,
				'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
			],
		];
		
		$response = wp_remote_get( $url, $params );
		
		if ( is_wp_error( $response ) ) {
			return [
				'success' => false,
				'message' => $response->get_error_message(),
			];
		}
		
		$body = json_decode( wp_remote_retrieve_body( $response ), true );
		
		if ( isset( $body['status'] ) ) {
			return [
				'success' => true,
				'status'  => $body,
			];
		}
		
		return [
			'success' => false,
			'message' => 'Invalid response from Stripe.',
		];
	}
}
