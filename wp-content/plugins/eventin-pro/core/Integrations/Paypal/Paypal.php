<?php
/**
 * Paypal Class
 * 
 * @package Eventin Pro
 */
namespace EventinPro\Integrations\Paypal;

use Exception;
use WP_Error;

class Paypal {

    /**
     * Store api url
     *
     * @var string
     */
    private $api = '';

    /**
     * Store live api url
     *
     * @var string
     */
    private $live_api_url = 'https://api-m.paypal.com';

    /**
     * Store sandbox url
     *
     * @var string
     */
    private $sandbox_url = 'https://api-m.sandbox.paypal.com';

    /**
     * Store client secret
     *
     * @var string
     */
    private $client_id;

    /**
     * Store client secret
     *
     * @var string
     */
    private $client_secret;

    /**
     * Checking sandbox or not
     *
     * @var bool
     */
    private $is_sandbox;

    /**
     * Constructor for paypal class
     *
     * @return  void
     */
    public function __construct( $config = [] ) {

        $configured = $this->set_config( $config );

        if ( is_wp_error( $configured ) ) {
            throw new Exception( $configured->get_error_message() );
        }
    }

    /**
     * Set paypal client configuration
     *
     * @param   array  $config  Paypal configuration details
     *
     * @return  void | WP_Error
     */
    private function set_config( $config ) {
        $client_id     = ! empty( $config['client_id'] ) ? $config['client_id'] : '';
        $client_secret = ! empty( $config['client_secret'] ) ? $config['client_secret'] : '';
        $is_sandbox    = ! empty( $config['is_sandbox'] ) ? $config['is_sandbox'] : false;

        $required_fields = [
            'client_id',
            'client_secret',
        ];

        foreach( $required_fields as $field ) {
            if ( empty( $config[$field] ) ) {
                return new WP_Error( "paypal_config_error", "You must prodive {$field}" );
            }
        }

        $this->client_id     = $client_id;
        $this->client_secret = $client_secret;
        $this->is_sandbox    = $is_sandbox;

        $this->api = $this->is_sandbox ? $this->sandbox_url : $this->live_api_url;
    }

    /**
     * Create paypal checkout order
     *
     * @return  array
     */
    public function create_payment( $data = [] ) {
        $url = $this->api . '/v2/checkout/orders';
        $data = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => $data['currency'],
                        'value'         => $data['amount'],
                    ]
                ]
            ]
        ];

        $params = [
            'headers' => $this->get_header(),
            'body'    => json_encode( $data ),
        ];

        $response = wp_remote_post( $url, $params );

        if ( 201 === wp_remote_retrieve_response_code( $response ) ) {
            $data = json_decode( wp_remote_retrieve_body( $response ), true );
            
            return [
                'id'  => $data['id'],
            ];
        }


       $message = wp_remote_retrieve_response_message($response);

       $code = wp_remote_retrieve_response_code( $response );

        $data = json_decode( $message, true );

        return new WP_Error( 'account_error', __( $message, 'eventin' ), ['status' => $code] );
    }

    /**
     * Compete paypal order
     *
     * @return  array
     */
    public function complete_order( $order_id ) {
        $url = $this->api . '/v2/checkout/orders/' . $order_id . '/capture';

        $params = [
            'headers' => $this->get_header(),
        ];

        $response = wp_remote_post( $url, $params );

        if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
            $data = json_decode( wp_remote_retrieve_body( $response ), true );
    
            return $data;
        }

        return $response;
    }

    /**
     * Send refund request
     *
     * @param   integer  $paypal_order_id
     *
     * @return  mixed
     */
    public function refund( $paypal_order_id ) {
        $capture_id = $this->get_capture_id( $paypal_order_id );

        if ( ! $capture_id ) {
            return false;
        }

        $url = $this->api . "/v2/payments/captures/{$capture_id}/refund";

        $params = [
            'headers' => $this->get_header(),
        ];

        $response = wp_remote_post( $url, $params );
        
        if ( 201 !== wp_remote_retrieve_response_code( $response ) ) {
            return false;
        }

        $data = json_decode( wp_remote_retrieve_body( $response ), true );
        
        if ( 'COMPLETED' !== $data['status'] ) {
            return false;
        }

        return true;
    }

    /**
     * Get header for remote access
     *
     * @return  array
     */
    public function get_header() {
        return [
            'Authorization' => 'Bearer ' . $this->get_access_token(),
            'Content-Type' => 'application/json'
        ];
    }

    /**
     * Get access token
     *
     * @return  string
     */
    private function get_access_token() {
        $access_token_key = $this->is_sandbox ? 'etn_paypal_sandbox_access_token' : 'etn_paypal_access_token';
        
        $token = get_transient( $access_token_key );
        
        if ( ! $token ) {
            $token = $this->get_remote_access_token();

            if ( $token && is_string( $token ) ) {
                set_transient( $access_token_key, $token, HOUR_IN_SECONDS * 1 );
            }
        }

        $token = is_string( $token ) ? $token : '';
        
        return $token;
    }
	
    /**
     * Get remote access token for paypal authorization
     *
     * @return  string
     */
    private function get_remote_access_token() {

        $token_url = $this->api . '/v1/oauth2/token';

        $client_id     = $this->client_id;
        $client_secret = $this->client_secret;

        $params = [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode( "{$client_id}:{$client_secret}" ),
            ],
            'body' => [
                'grant_type' => 'client_credentials',
            ]
        ];

        $response = wp_remote_post( $token_url, $params );

        if ( 200 === wp_remote_retrieve_response_code( $response ) ) {
            $data = json_decode( wp_remote_retrieve_body( $response ), true );

            return $data['access_token'];
        }

        return $response;
    }

    /**
     * Get capture id
     *
     * @param   integer  $paypal_order_id
     *
     * @return  mixed
     */
    private function get_capture_id( $paypal_order_id ) {
        $url = $this->api . '/v2/checkout/orders/' . $paypal_order_id;

        $params = [
            'headers' => $this->get_header(),
        ];

        $response = wp_remote_get( $url, $params );

        if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
            return false;
        }

        $data = json_decode( wp_remote_retrieve_body( $response ), true );

        if ( 'COMPLETED' !== $data['status'] ) {
            return false;
        }

        if ( ! empty( $data['purchase_units'][0]['payments']['captures'][0]['id'] ) ) {
            return $data['purchase_units'][0]['payments']['captures'][0]['id'];
        }

        return false;
    }
	
	
	public function retrieve_capture_id( $paypal_order_id ) {
		$url = $this->api . '/v2/checkout/orders/' . $paypal_order_id;
		
		$params = [
			'headers' => $this->get_header(),
		];
		
		$response = wp_remote_get( $url, $params );
		
		if ( 200 !== wp_remote_retrieve_response_code( $response ) ) {
			return false;
		}
		
		return $data = json_decode( wp_remote_retrieve_body( $response ), true );
		
		if ( 'COMPLETED' !== $data['status'] ) {
			return false;
		}
		
		if ( ! empty( $data['purchase_units'][0]['payments']['captures'][0]['id'] ) ) {
			return $data['purchase_units'][0]['payments']['captures'][0]['id'];
		}
		
		return false;
	}
}
