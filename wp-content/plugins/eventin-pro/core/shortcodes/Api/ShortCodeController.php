<?php
namespace EventinPro\ShortCodes\Api;

use WP_Error;
use WP_REST_Controller;
use WP_REST_Server;

/**
 * Shortcode Controller Class
 */
class ShortCodeController extends WP_REST_Controller {
    /**
     * Constructor for ShortCodeController
     *
     * @return void
     */
    public function __construct() {
        $this->namespace = 'eventin/v2';
        $this->rest_base = 'shortcodes';
    }

    /**
     * Check if a given request has access to get items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function register_routes() {
        register_rest_route( $this->namespace, $this->rest_base . '/script' , [
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'create_shortcode_page'],
                'permission_callback' => [$this, 'create_short_code_permissions_check'],
            ],
        ] );
    }

    /**
     * Create shortcode page for script generator
     *
     * @param   WP_Rest_Request  $request  Full data about the request.
     *
     * @return  WP_Rest_Response
     */
    public function create_shortcode_page( $request ) {
        $input_data    = json_decode( $request->get_body(), true );

        $post_title = isset( $input_data['post_name'] ) ? sanitize_text_field( $input_data['post_name'] ) : '';
        $short_code = isset( $input_data['shortcode'] ) ? $input_data['shortcode'] : '';

        if ( empty( $post_title ) ) {
            return new WP_Error( 'post-name', __( 'Please provide post name', 'eventin-pro' ), ['status' => 422] );
        }

        if ( empty( $short_code ) ) {
            return new WP_Error( 'shortcode', __( 'Please provide shortcode', 'eventin-pro' ), ['status' => 422] );
        }

        $array_of_objects = get_posts(
            [
                'title' => $post_title,
                'post_type' => 'etn'
            ]
        );

        $page_id = get_post( $array_of_objects[0]->ID );

        $args = [
            'post_title'   => $post_title,
            'post_content' => $short_code,
            'post_status'  => 'publish',
            'post_author'  => '1',
            'post_type'    => 'page',
            'post_name'    => $post_title,
        ];

        if ( $page_id ) {
            $args['ID'] = $page_id->ID;
        }

        $page = wp_insert_post( $args );

        if ( is_wp_error( $page ) ) {

            return new WP_Error( 'page_create_error', $page->get_error_message(), ['status' => 422] );
        }

        $data = [
            'message' => __( 'Success', 'eventin-pro' ),
            'id'      => $page,
        ];

        return rest_ensure_response( $data );
    }

    /**
     * Check permissions for shortcode page script
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  bool
     */
    public function create_short_code_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }
}
