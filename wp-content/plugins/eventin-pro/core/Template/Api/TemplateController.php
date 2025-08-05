<?php
/**
 * Template Controller
 * 
 * @package EventinPro
 */
namespace EventinPro\Template\Api;

use Eventin\Input;
use Eventin\Template\Api\TemplateController as ApiTemplateController;
use Eventin\Template\TemplateModel;
use WP_Error;
use WP_REST_Server;
use WP_REST_Request;

/**
 * Template controller class
 */
class TemplateController extends ApiTemplateController {
    /**
     * Check if a given request has access to get items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function register_routes() {
        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'             => WP_REST_Server::CREATABLE,
                'callback'            => [$this, 'create_item'],
                'permission_callback' => [$this, 'create_item_permission_check'],
            ],
        ]);

        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'             => WP_REST_Server::DELETABLE,
                'callback'            => [$this, 'delete_items'],
                'permission_callback' => [$this, 'delete_item_permissions_check'],
            ],
        ]);

        register_rest_route(  $this->namespace,
        '/' . $this->rest_base . '/(?P<id>[\d]+)', [
            [
                'methods'             => WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_item'],
                'permission_callback' => [$this, 'get_item_permissions_check'],
            ],
            [
                'methods'             => WP_REST_Server::EDITABLE,
                'callback'            => [$this, 'update_item'],
                'permission_callback' => [$this, 'update_item_permission_check'],
            ],
            [
                'methods'             => WP_REST_Server::DELETABLE,
                'callback'            => [$this, 'delete_item'],
                'permission_callback' => [$this, 'delete_item_permissions_check'],
            ],
        ]);

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)' . '/clone',
            [
                [
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'clone_item' ),
                    'permission_callback' => array( $this, 'get_item_permissions_check' ),
                    'args'                => $this->get_collection_params(),
                ],
            ],
        );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)' . '/status',
            [
                [
                    'methods'             => WP_REST_Server::EDITABLE,
                    'callback'            => array( $this, 'update_item_status' ),
                    'permission_callback' => array( $this, 'get_item_permissions_check' ),
                    'args'                => $this->get_collection_params(),
                ],
            ],
        );
    }

    /**
     * Get single item
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function get_item( $request ) {
        $id = intval( $request['id'] );

        $post = get_post( $id );

        if ( ! $post ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        if ( 'etn-template' !== $post->post_type ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        $template = new TemplateModel( $id );

        $response = $this->prepare_item_for_response( $template, $request );

        return rest_ensure_response( $response );
    }

    /**
     * Get item permission check
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  bool
     */
    public function get_item_permissions_check( $request ) {
        return true;
    }

    /**
     * Create item
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function create_item( $request ) {
        $data = $this->prepare_item_for_database( $request );

        if ( is_wp_error( $data ) ) {
            return $data;
        }

        $template = new TemplateModel();
        $template_created = $template->create( $data );

        if ( ! $template_created ) {
            return new WP_Error( 'template_create_error', __( 'Couldn\'t create template. Please try again.', 'eventin' ), ['status' => 422] );
        }

        $response = $this->prepare_item_for_response( $template, $request );

        return rest_ensure_response( $response );
    }

    /**
     * Create item permission check
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function create_item_permission_check( $request ) {
        return current_user_can( 'etn_manage_template' );
    }

    /**
     * Update item
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function update_item( $request ) {
        $data = $this->prepare_item_for_database( $request );

        if ( is_wp_error( $data ) ) {
            return $data;
        }

        $id = intval( $request['id'] );

        $post = get_post( $id );

        if ( ! $post ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        if ( 'etn-template' !== $post->post_type ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        $template = new TemplateModel( $request['id'] );
        $template_update = $template->update( $data );

        if ( ! $template_update ) {
            return new WP_Error( 'template_update_error', __( 'Couldn\'t update template. Please try again.', 'eventin' ), ['status' => 422] );
        }

        $response = $this->prepare_item_for_response( $template, $request );

        return rest_ensure_response( $response );
    }

    /**
     * Update item permission check
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  bool
     */
    public function update_item_permission_check( $request ) {
        return current_user_can( 'etn_manage_template' );
    }

    /**
     * Clone item
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  WP_Rest_Response
     */
    public function clone_item( $request ) {
        $id = intval( $request['id'] );

        $post = get_post( $id );

        if ( ! $post ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        if ( 'etn-template' !== $post->post_type ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        $template = new TemplateModel( $id );

        $clone_template = $template->clone();

        $response = $this->prepare_item_for_response( $clone_template, $request );

        return rest_ensure_response( $response );
    }

    /**
     * Update template status
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function update_item_status( $request ) {
        $id = intval( $request['id'] );

        $post = get_post( $id );
        $status = ! empty( $request['status'] ) ? $request['status'] : ''; 

        if ( ! $post ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        if ( 'etn-template' !== $post->post_type ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        if ( ! $status ) {
            return new WP_Error( 'status_error', __( 'Invalid template status', 'eventin-pro' ), ['status' => 422] );
        }

        $statuses = [
            'publish', 'draft'
        ];

        if ( ! in_array( $status, $statuses ) ) {
            return new WP_Error( 'invalid_status', __( 'Invalid template status', 'eventin-pro' ), ['status' => 422] );
        }

        // Prepare the post data
        $post_data = array(
            'ID'          => $id,
            'post_status' => $status, // Change this to 'draft', 'pending', 'private', etc.
        );

        // Update the post status
        $updated_template = wp_update_post( $post_data, true );

        if ( is_wp_error( $updated_template ) ) {
            return $updated_template;
        }

        $response = [
            'message' => __( 'Successfully updated template status', 'eventin-pro' ),
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Prepare item for database
     *
     * @param   WP_Rest_Re  $request  [$request description]
     *
     * @return  [type]            [return description]
     */
    public function prepare_item_for_database( $request ) {
        $input_data = json_decode( $request->get_body(), true ) ?? [];
        $validate   = etn_validate( $input_data, [
            'name'      => [
                'required',
            ],
            'type'   => [
                'required',
            ],
            'content' => [
                'required',
            ],
            'orientation'   => [
                'required',
            ]
        ] );

        if ( is_wp_error( $validate ) ) {
            return $validate;
        }

        $input = new Input( $input_data );

        $template_data = [
            'post_title'    => $input->get('name'),
            'post_content'  => $input->get('content'),
            'post_status'   => $input->get('status'),
            'type'          => $input->get('type'),
            'orientation'   => $input->get('orientation'),
            'thumbnail'     => $input->get('thumbnail'),
            'template_css'  => $input->get('template_css'),
            'is_pro'        => true,
            'template_css'  => $input->get('template_css'),
        ];

        return $template_data;
    }

    /**
     * Delete item
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function delete_item( $request ) {
        $id = intval( $request['id'] );

        $post = get_post( $id );

        if ( ! $post ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        if ( 'etn-template' !== $post->post_type ) {
            return new WP_Error( 'invalid_id', __( 'Invalid template id', 'eventin-pro' ), ['status' => 422] );
        }

        $template = new TemplateModel( $id );

        $deleted = $template->delete();

        if ( ! $deleted ) {
            return new WP_Error( 'delete_error', __( 'Unable to delete this template. Please try again.' ), ['status' => 409] );
        }

        $response = [
            'message'   => __( 'Successfully deleted template', 'eventin-pro' )
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Delete item permission check
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  bool
     */
    public function delete_item_permissions_check( $request ) {
        return current_user_can( 'etn_manage_template' );
    }

    /**
     * Bulk delete templates
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function delete_items( $request ) {
        $ids = ! empty( $request['ids'] ) ? $request['ids'] : [];

        if ( ! $ids ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'Template ids can not be empty.', 'eventin-pro' ),
                array( 'status' => 422 )
            );
        }

        $count = 0;

        foreach ( $ids as $id ) {
            $template = new TemplateModel( $id );

            if ( $template->delete() ) {
                $count++;
            }
        }

        if ( $count == 0 ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'Template cannot be deleted.', 'eventin-pro' ),
                array( 'status' => 409 )
            );
        }

        $message = sprintf( __( '%d templates are deleted of %d', 'eventin' ), $count, count( $ids ) );

        return rest_ensure_response( $message );
    }
}
