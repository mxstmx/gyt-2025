<?php
/**
 * Timetics Liccense Api
 *
 * @package TimeticsPro
 */

namespace EventinPro\License\Api;

use EventinPro\License\LicenseActivator;
use EventinPro\License\Utils;
use WP_Error;
use WP_HTTP_Response;
use WP_REST_Controller;

/**
 * Timetics license api class
 *
 */
class LicenseController extends WP_REST_Controller {
    /**
     * Store api namespace
     *
     * @since 1.0.0
     *
     * @var string $namespace
     */
    protected $namespace = 'eventin/v2';

    /**
     * Store rest base
     *
     * @since 1.0.0
     *
     * @var string $rest_base
     */
    protected $rest_base = 'license';

    /**
     * Register routes
     *
     * @return void
     */
    public function register_routes() {
        /*
         * Register route
         */
        register_rest_route( $this->namespace, $this->rest_base . '/activate', [
            [
                'methods'             => \WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'activate'],
                'permission_callback' => function () {
                    return current_user_can( 'manage_options' );
                },
            ],
        ] );

        /**
         * Register route
         *
         * @var void
         */
        register_rest_route( $this->namespace, $this->rest_base . '/deactivate', [
            [
                'methods'             => \WP_REST_Server::EDITABLE,
                'callback'            => [$this, 'deactivate'],
                'permission_callback' => function () {
                    return current_user_can( 'manage_options' );
                },
            ],
        ] );

        /**
         * Register route
         *
         * @var void
         */
        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_settings'],
                'permission_callback' => function () {
                    return current_user_can( 'manage_options' );
                },
            ],
        ] );
    }

    /**
     * Aactivate license
     *
     * @param   Object  $requst
     *
     * @return  JSON
     */
    public function activate( $requst ) {
        $data = json_decode( $requst->get_body(), true );

        $name        = ! empty( $data['name'] ) ? sanitize_text_field( $data['name'] ) : '';
        $email       = ! empty( $data['email'] ) ? sanitize_text_field( $data['email'] ) : '';
        $license_key = ! empty( $data['license_key'] ) ? sanitize_text_field( $data['license_key'] ) : '';

        // Field validation.
        $validate = etn_validate( $data, [
            'name' => [
                'required'
            ],
            'email' => [
                'required',
            ],
            'license_key' => [
                'required'
            ],
        ] );

        if ( is_wp_error( $validate ) ) {
            return new WP_Error( 'license_validation_error', $validate->get_error_message(), ['status' => 422] );
        }

        // Activating the license.
        $activator = new LicenseActivator();


        $license_data = $activator->activate_license( [
            'name'        => $name,
            'email'       => $email,
            'license_key' => $license_key,
        ] );

        if ( ! $license_data['success'] ) {
            return new WP_Error( 'activation_error', $license_data['error'], ['status' => 422] );
        }

        $response = [
            'message'     => esc_html__( 'Your license has been activated successfully', 'eventin-pro' ),
            'data'        => $license_data,
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Deactivate license
     *
     * @param   Object  $requst
     *
     * @return  JSON
     */
    public function deactivate( $requst ) {
        $current_license = Utils::get_license();

        if ( ! $current_license ) {
            $message     = __( 'You don\'t any active license', 'eventin-pro' );

            return new WP_Error( 'license_error', $message, ['status' => 422] );
        }

        if ( $current_license && $current_license['license'] !== 'valid' ) {
            $message     = esc_html__( 'Your license is not activate.', 'eventin-pro' );

            return new WP_Error( 'license_error', $message, ['status' => 422] );
        }

        // Deactivating the license.
        $activator = new LicenseActivator();
        $license_data = $activator->deactivate_license();


        if ( ! $license_data['success'] ) {
            $error_message = ! empty( $license_data['error'] ) ? $license_data['error'] : __( 'Unknonwn error occured while deactivating license', 'eventin-pro' );

            return new WP_Error( 'license_deactivation_error', $error_message, ['status' => 422] );
        }

        $response = [
            'message'     => esc_html__( 'Your license has been deactivated successfully', 'eventin-pro' ),
            'data'        => $license_data,
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Get license settings
     *
     * @param   Object  $requst
     *
     * @return  JSON
     */
    public function get_settings( $requst ) {
        $license_data = Utils::get_license();

        if ( $license_data ) {
            $license_data['name']  = Utils::get_name();
            $license_data['email'] = Utils::get_email();
            $license_data['license_key'] = Utils::get_license_key();
        }

        $data = [
            'status_code' => 200,
            'success'     => 1,
            'data'        => $license_data,
        ];

        return rest_ensure_response( $data );
    }
}
