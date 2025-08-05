<?php
/**
 * Manage access control
 * 
 * @package Eventin
 */
namespace EventinPro\AccessControl\Api;

use Eventin\AccessControl\Permission;
use Eventin\Input;
use WP_Error;
use WP_REST_Controller;

/**
 * Permission controllers
 */
class PermissionController extends WP_REST_Controller {
    /**
     * Store api namespace
     *
     * @since 4.0.13
     *
     * @var string $namespace
     */
    protected $namespace = 'eventin/v2';

    /**
     * Store rest base
     *
     * @since 4.0.13
     *
     * @var string $rest_base
     */
    protected $rest_base = 'permissions';

    /**
     * Register routes
     *
     * @return void
     */
    public function register_routes() {
        /*
         * Register route
         */
        register_rest_route( $this->namespace, $this->rest_base, [
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_items'],
                'permission_callback' => function () {
                    return current_user_can( 'manage_options' );
                },
            ],
        ] );

        register_rest_route( $this->namespace, $this->rest_base . '/roles', [
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_role_permissions'],
                'permission_callback' => function () {
                    return current_user_can( 'manage_options' );
                },
            ],
        ] );

        register_rest_route( $this->namespace, $this->rest_base . '/current-user', [
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_current_user'],
                'permission_callback' => function () {
                    return current_user_can( 'read' );
                },
            ],
        ] );

        register_rest_route( $this->namespace, $this->rest_base . '/roles/(?P<role>[a-zA-Z0-9_\-&*%]+)', [
            [
                'methods'             => \WP_REST_Server::DELETABLE,
                'callback'            => [$this, 'remove_role'],
                'permission_callback' => function () {
                    return current_user_can( 'manage_options' );
                },
            ],
        ] );

        register_rest_route( $this->namespace, $this->rest_base . '/settings', [
            [
                'methods'             => \WP_REST_Server::READABLE,
                'callback'            => [$this, 'get_settings'],
                'permission_callback' => function () {
                    return current_user_can( 'manage_options' );
                },
            ],
        ] );

        register_rest_route( $this->namespace, '/' . $this->rest_base . '/(?P<role>[a-zA-Z0-9_\-&*%]+)', [
            [
                'methods'             => \WP_REST_Server::EDITABLE,
                'callback'            => [$this, 'add_permissions'],
                'permission_callback' => function () {
                    return current_user_can( 'manage_options' );
                },
            ],
        ] );

        register_rest_route( $this->namespace, '/' . $this->rest_base . '/(?P<role>[a-zA-Z0-9_\-&*%]+)', [
            [
                'methods'             => \WP_REST_Server::DELETABLE,
                'callback'            => [$this, 'remove_permissions'],
                'permission_callback' => function () {
                    return current_user_can( 'manage_options' );
                },
            ],
        ] );

    }

    /**
     * Get all extensions
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  WP_Rest_Response
     */
    public function get_items( $request ) {
        $permissions = Permission::get();

        return rest_ensure_response( $permissions );
    }

    /**
     * Enable or disable extension
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Response | WP_Error
     */
    public function add_permissions( $request ) {
        $input       = new Input( json_decode( $request->get_body(), true ) );
        $role        = $request['role'];
        $permissions = $input->get( 'permissions' );

        if ( ! $role ) {
            return new WP_Error( 'empty_role', __( 'Please enter role', 'eventin' ), ['status' => 422] );
        }

        if ( ! Permission::is_valid_role( $role ) ) {
            return new WP_Error( 'invalid_role', __( 'Invalid Role', 'eventin' ), ['status' => 422] );
        }
        
        if ( ! Permission::is_valid( $permissions ) ) {
            return new WP_Error( 'invalid_permissions', __( 'Invalid permissions provided', 'eventin' ), ['status' => 422] );
        }

        $added = Permission::add( $role, $permissions );
        
        return $added;


        if ( ! $added ) {
            return new WP_Error( 'permission_update_error', __( 'Couldn\'t update permission', 'eventin' ), ['status' => 422] );
        }

        $response = [
            'message'   => __( 'Successfully updated permissions.', 'eventin' )
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Remove permissions from a certain role
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Response | WP_Error
     */
    public function remove_permissions( $request ) {
        $input       = new Input( json_decode( $request->get_body(), true ) );
        $role        = $request['role'];
        $permissions = $input->get( 'permissions' );

        if ( ! $role ) {
            return new WP_Error( 'empty_role', __( 'Please enter role', 'eventin' ), ['status' => 422] );
        }

        if ( ! Permission::is_valid_role( $role ) ) {
            return new WP_Error( 'invalid_role', __( 'Invalid Role', 'eventin' ), ['status' => 422] );
        }
        
        if ( ! Permission::is_valid( $permissions ) ) {
            return new WP_Error( 'invalid_role', __( 'Invalid permissions provided', 'eventin' ), ['status' => 422] );
        }

        $removed = Permission::remove( $role, $permissions );

        if ( ! $removed ) {
            return new WP_Error( 'permission_remove_error', __( 'Couldn\'t remove permission', 'eventin' ), ['status' => 422] );
        }

        $response = [
            'message'   => __( 'Successfully remove permissions.', 'eventin' )
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Get role permissions
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function get_role_permissions( $request ) {
        $role_permissions = Permission::get_roles();

        return rest_ensure_response( $role_permissions );
    }

    /**
     * Get permission settings
     *
     * @param   WP_Rest_Request  $request 
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function get_settings( $request ) {
        $settings = Permission::get_role_settings();

        return rest_ensure_response( $settings );
    }

    /**
     * Add role
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function remove_role( $request ) {
        $role = $request['role'];

        $removed = Permission::remove_role( $role );

        if ( ! $removed ) {
            return new WP_Error( 'role_remove_erro', __( 'Role can\'t remove. Please try again' ), ['status' => 409] );
        }

        $response = [
            'message'   => __( 'Successfully removed role', 'eventin' ),
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Get current user data
     *
     * @param   WP_Rest_Request  $request  [$request description]
     *
     * @return  WP_Rest_Response | WP_Error
     */
    public function get_current_user( $request ) {
        $user_data = $this->get_current_user_data_roles_permissions();

        return rest_ensure_response( $user_data );
    }

    /**
     * Get current user data, role and permissions
     *
     * @return  array
     */
    public function get_current_user_data_roles_permissions() {
        // Get the current user object
        $current_user = wp_get_current_user();
        
        // Check if there is a logged-in user
        if ( ! $current_user->exists() ) {
            return null;
        }
        $roles = array_values( $current_user->roles );

        // Get the user's data
        $user_data = [
            'ID'            => $current_user->ID,
            'username'      => $current_user->user_login,
            'email'         => $current_user->user_email,
            'display_name'  => $current_user->display_name,
            'roles'         => $roles,
            'is_super_admin' => is_super_admin(),
        ];

        $eventin_permissions = Permission::get_role_permissions();
        
        // Get the user's capabilities (permissions)
        $user_permissions = [];

        foreach ( $roles as $role ) {
            if ( ! empty( $eventin_permissions[ $role ] ) ) {
                $user_permissions = array_merge( $user_permissions,  $eventin_permissions[ $role ] );
            }
        }
        
        // Add permissions to the user data
        $user_data['permissions'] = $user_permissions;
        
        return $user_data;
    }
    
}

