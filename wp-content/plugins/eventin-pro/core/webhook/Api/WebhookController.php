<?php
/**
 * Webhook Api Class
 *
 * @package EventinPro\Webhook
 */
namespace EventinPro\Webhook\Api;

use WP_Error;
use WP_REST_Controller;
use WP_REST_Server;
use Etn_Pro\Core\Webhook\Webhook;

/**
 * Webhook Controller Class
 */
class WebhookController extends WP_REST_Controller {
    /**
     * Store cache key
     *
     * @var string
     */
    private $webhook_cache_key = 'etn_webhook';

    /**
     * Constructor for WebhookController
     *
     * @return void
     */
    public function __construct() {
        $this->namespace = 'eventin/v2';
        $this->rest_base = 'webhooks';
    }

    /**
     * Check if a given request has access to get items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function register_routes() {
        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_items'],
                'permission_callback' => [$this, 'get_item_permissions_check'],
            ],
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'create_item'],
                'permission_callback' => [$this, 'create_item_permissions_check'],
            ],
            [
                'methods'             => WP_REST_Server::DELETABLE,
                'callback'            => array( $this, 'delete_items' ),
                'permission_callback' => array( $this, 'update_item_permissions_check' ),
            ]
        ] );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)',
            array(
                'args' => array(
                    'id' => array(
                        'description' => __( 'Unique identifier for the post.', 'eventin-pro' ),
                        'type'        => 'integer',
                    ),
                ),
                array(
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'get_item' ),
                    'permission_callback' => array( $this, 'get_item_permissions_check' ),
                    'args'                => $this->get_collection_params(),
                ),
                array(
                    'methods'             => WP_REST_Server::EDITABLE,
                    'callback'            => array( $this, 'update_item' ),
                    'permission_callback' => array( $this, 'update_item_permissions_check' ),
                    'args'                => $this->get_collection_params(),
                ),
                array(
                    'methods'             => WP_REST_Server::DELETABLE,
                    'callback'            => array( $this, 'delete_item' ),
                    'permission_callback' => array( $this, 'update_item_permissions_check' ),
                    'args'                => array(
                        'id' => array(
                            'description' => __( 'Unique identifier for the post.', 'eventin' ),
                            'type'        => 'integer',
                        ),
                    ),
                ),
            ),
        );
    }

    /**
     * Check if a given request has access to get items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function get_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }

    /**
     * Get a collection of items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function get_items( $request ) {
        $per_page       = ! empty( $request['per_page'] ) ? intval( $request['per_page'] ) : 20;
        $paged          = ! empty( $request['paged'] ) ? intval( $request['paged'] ) : 1;
        $cache_key      = $this->webhook_cache_key;
        
        $args = [
            'post_type'   => 'etn-webhook',
            'post_status' => 'publish',
            'numberposts' => $per_page,
            'paged'       => $paged,
        ];

        $response = $this->get_webhooks_list( $args, $request );
        
        return $response;
    }

    /**
     * Get one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function get_item( $request ) {
        $tag = $this->get_tag( $request['id'] );
        if ( is_wp_error( $tag ) ) {
            return $tag;
        }

        $response = $this->prepare_item_for_response( $request['id'], $request );

        return rest_ensure_response( $response );
    }

    /**
     * Create one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function create_item( $request ) {
        $prepared_data = $this->prepare_item_for_database( $request );

        if ( is_wp_error( $prepared_data ) ) {
            return $prepared_data;
        }

        // Save webhook.
        $webhook = new Webhook();
        $webhook->set_props( $prepared_data );
        $webhook->save();

        $respons = $this->prepare_item_for_response( $webhook, $request );

        return rest_ensure_response( $respons );
    }

    /**
     * Check if a given request has access to create items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function create_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }

    /**
     * Update one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function update_item( $request ) {
        $prepared_data = $this->prepare_item_for_database( $request );
        $id = intval( $request['id'] );

        if ( is_wp_error( $prepared_data ) ) {
            return $prepared_data;
        }

        // Save webhook.
        $webhook = new Webhook( $id );
        $webhook->set_props( $prepared_data );
        $webhook->save();

        $respons = $this->prepare_item_for_response( $webhook, $request );

        return rest_ensure_response( $respons );
    }

    /**
     * Deletes an item from the database.
     *
     * @param array $request The request data containing the item ID.
     * @return WP_REST_Response|WP_Error The response indicating the success or failure of the deletion.
     */
    public function delete_item( $request ) {
        // Sanitize and validate the ID
        $id = intval( $request['id'] );

        $post = get_post( $id );
        if ( is_wp_error( $post ) ) {
            return $post;
        }

        $previous = $this->prepare_item_for_response( new Webhook( $post->ID ), $request );
        $result   = wp_delete_post( $id, true );
        $response = new \WP_REST_Response();
        $response->set_data(
            array(
                'deleted'  => true,
                'previous' => $previous,
            )
        );

        if ( ! $result ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'The webhook cannot be deleted.', 'eventin-pro' ),
                array( 'status' => 500 )
            );
        }

        do_action( 'eventin_event_deleted', $id );

        delete_transient( $this->webhook_cache_key );

        return $response;
    }

    /**
     * Bulk delete items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_REST_Response Response object.
     */
    public function delete_items( $request ) {
        $ids = ! empty( $request['ids'] ) ? $request['ids'] : [];

        if ( ! $ids ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'Webhook ids can not be empty.', 'eventin-pro' ),
                array( 'status' => 400 )
            );
        }
        $count = 0;

        foreach ( $ids as $id ) {
            $deleted = $this->delete_item( [ 'id' => $id ] );

            if ( ! is_wp_error( $deleted ) ) {
                $count++;
            }
        }

        if ( $count == 0 ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'Webhook cannot be deleted.', 'eventin-pro' ),
                array( 'status' => 500 )
            );
        }

        $message = sprintf( __( '%d webhooks are deleted of %d', 'eventin-pro' ), $count, count( $ids ) );

        delete_transient( $this->webhook_cache_key );

        return rest_ensure_response( $message );
    }


    /**
     * Check if a given request has access to update a specific item.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function update_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }

    /**
     * Get the tag, if the ID is valid.
     *
     * @since 4.0.0
     *
     * @param int $id Supplied ID.
     * @return WP_Term|WP_Error tag object if ID is valid, WP_Error otherwise.
     */
    protected function get_tag( $id ) {
        $error = new WP_Error(
            'rest_tag_invalid',
            __( 'Tag does not exist.', 'eventin' ),
            array( 'status' => 404 )
        );

        if ( (int) $id <= 0 ) {
            return $error;
        }

        $term = get_term( (int) $id, $this->taxonomy );
        if ( empty( $term ) || $term->taxonomy !== $this->taxonomy ) {
            return $error;
        }

        return $term;
    }

    /**
     * Prepare the item for the REST response.
     *
     * @param mixed           $item WordPress representation of the item.
     * @param WP_REST_Request $request Request object.
     * @return WP_REST_Response $response
     */
    public function prepare_item_for_response( $webhook, $request ) {
        $data = [
            'id'           => $webhook->get_id(),
            'name'         => $webhook->get_name(),
            'status'       => $webhook->get_status(),
            'topic'        => $webhook->get_topic(),
            'delivery_url' => $webhook->get_delivery_url(),
            'description'  => $webhook->get_description(),
            'secrete'      => $webhook->get_secrete(),
        ];

        return $data;
    }

    /**
     * Prepare data for database
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  array
     */
    protected function prepare_item_for_database( $request ) {
        $input_data = json_decode( $request->get_body(), true );
        $validate   = etn_validate( $input_data, [
            'name' => [
                'required',
            ],
            'topic' => [ 
                'required' 
            ],
            'delivery_url' => [
                'required'
            ]
        ] );

        $prepared_data = [];

        if ( is_wp_error( $validate ) ) {
            return $validate;
        }

        if ( ! empty( $input_data['name'] ) ) {
            $prepared_data['name'] = $input_data['name'];
        }

        if ( ! empty( $input_data['description'] ) ) {
            $prepared_data['description'] = $input_data['description'];
        }

        if ( ! empty( $input_data['status'] ) ) {
            $prepared_data['status'] = $input_data['status'];
        }

        if ( ! empty( $input_data['topic'] ) ) {
            $prepared_data['topic'] = $input_data['topic'];
        }

        if ( ! empty( $input_data['delivery_url'] ) ) {
            $prepared_data['delivery_url'] = $input_data['delivery_url'];
        }

        if ( ! empty( $input_data['secrete'] ) ) {
            $prepared_data['secrete'] = $input_data['secrete'];
        }

        delete_transient( $this->webhook_cache_key );

        return $prepared_data;
    }

    /**
     * Get webhook lists
     *
     * @param   array  $args     [$args description]
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  array
     */
    private function get_webhooks_list( $args, $request ) {
        $webhooks = [];

        $post_query   = new \WP_Query( $args );
        $query_result = $post_query->posts;

        $total_posts  = $post_query->found_posts;
    
        foreach ( $query_result as $post ) {
            $webhook = new Webhook( $post->ID );
            $post_data = $this->prepare_item_for_response( $webhook, $request );
    
            $webhooks[] = $this->prepare_response_for_collection( $post_data );
        }
    
        $data = [
            'total_items' => $total_posts,
            'items'       => $webhooks,
        ];

        $response = rest_ensure_response( $data );    
        $response->header( 'X-WP-Total', $total_posts );

        return $response;
    }
}
