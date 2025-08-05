<?php
/**
 * Class stripe payment
 *
 * @package Timetics
 */
namespace EventinPro\Integrations\Stripe;

use Exception;

/**
 * Class Stripe
 */
class Stripe {
    /**
     * Store stripe paymentintent api url
     *
     * @var string
     */
    private $payment_intent_url = 'https://api.stripe.com/v1/payment_intents';

    /**
     * Store stripe secreate key
     *
     * @var string
     */
    private $secret_key;

    public function __construct( $secret_key = null ) {
        if ( ! $secret_key ) {
            throw new Exception( 'You must provide stripe secret key' );
        }

        $this->secret_key = $secret_key;
    }

    /**
     * Create stripe paymentintent
     *
     * @param   array  $args  Stripe payment details
     *
     * @return  array
     */
    public function create_payment( $args = [] ) {
        $defaults = [
            'amount'                 => 0,
            'currency'               => '',
            'payment_method_types[]' => 'card',
        ];

        $args   = wp_parse_args( $args, $defaults );

        $zero_decimal_currencies = [
            'JPY',
            'KRW',
            'VND',
            'IRR',
            'IDR',
            'COP',
            'CLP',
            'PYG',
        ];
        
        if ( ! in_array( $args['currency'], $zero_decimal_currencies ) ) {
            $args['amount'] = $args['amount'] * 100;
        }

        $url    = $this->payment_intent_url;
        $secret = $this->secret_key;

        $params = [
            'headers' => [
                'Authorization' => 'Bearer ' . $secret,
                'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
            ],
            'body'    => build_query( $args ),
        ];

        $response = wp_remote_post( $url, $params );

        if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
            $data = json_decode( wp_remote_retrieve_body( $response ), true );
            
            return [
                'id'            => $data['id'],
                'client_secret' => $data['client_secret'],
            ];
        }

        return $response;
    }

    /**
     * Create fund
     *
     * @return
     */
    public function create_refund( $payment_intent_id ) {
        $api_url = 'https://api.stripe.com/v1/refunds';

        $args = [
            'payment_intent' => $payment_intent_id,
        ];

        $params = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->secret_key,
                'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8',
            ],
            'body'    => build_query( $args ),
        ];

        $response = wp_remote_post( $api_url, $params );
        
        return 200 == wp_remote_retrieve_response_code( $response );
    }
	
}
