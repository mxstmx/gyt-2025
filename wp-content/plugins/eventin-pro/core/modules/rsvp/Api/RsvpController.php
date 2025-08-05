<?php
/**
 * RSVP Api Class
 *
 * @package Eventin\Event
 */
namespace Etn_Pro\Core\Modules\Rsvp\Api;

use WP_Error;
use WP_Query;
use WP_REST_Controller;
use WP_REST_Server;
use DateTime;
use DateInterval;
use Etn\Utils\Helper;
/**
 * RSVP Controller Class
 */
class RsvpController extends WP_REST_Controller {

    /**
     * Constructor for EventController
     *
     * @return void
     */
    public function __construct() {
        $this->namespace = 'eventin/v2';
        $this->rest_base = 'rsvp-report';
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
                'methods'             => WP_REST_Server::DELETABLE,
                'callback'            => [$this, 'delete_items'],
                'permission_callback' => [$this, 'delete_item_permissions_check'],
            ],
        ] );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)',
            array(
                'args'   => array(
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
                    'methods'             => WP_REST_Server::DELETABLE,
                    'callback'            => array( $this, 'delete_item' ),
                    'permission_callback' => array( $this, 'delete_item_permissions_check' ),
                    'args'                => array(
                        'force' => array(
                            'type'        => 'boolean',
                            'default'     => false,
                            'description' => __( 'Whether to bypass Trash and force deletion.', 'eventin-pro' ),
                        ),
                    ),
                ),
                // 'allow_batch' => $this->allow_batch,
                'schema' => array( $this, 'get_item_schema' ),
            ),
        );        
        
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)'. '/invitations',
            array(
                array(
                    'methods'             => WP_REST_Server::EDITABLE,
                    'callback'            => array( $this, 'invite_item' ),
                    'permission_callback' => array( $this, 'edit_item_permissions_check' ),
                    'args'                => $this->get_collection_params(),
                ),
                // 'allow_batch' => $this->allow_batch,
                'schema' => array( $this, 'get_item_schema' ),
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
        return current_user_can( 'etn_manage_event' );
    }
    
    /**
     * Check if a given request has access to edit items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function edit_item_permissions_check( $request ) {
        return current_user_can( 'etn_manage_event' );
    }


    /**
     * Get one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function get_item( $request ) {
        $id                 = intval( $request['id'] );
        $rsvp_start_date    = $request['rsvp_start_date'];
        $rsvp_end_date      = $request['rsvp_end_date'];
        $status             = sanitize_text_field( $request['status'] );
        $rsvp_limit_amount  = '';
        $rsvp_title         = sanitize_text_field( $request['attendee_name'] );
        $rsvp               = [];
        $event_data         = get_post_meta( $id, 'rsvp_settings', true );
        $rsvp_date_range    = $request['rsvp_date_range'];
        $posts_per_page     = isset($request['posts_per_page']) ? intval($request['posts_per_page']) : -1;
        $paged              = isset($request['paged']) ? intval($request['paged']) : 1;

        if( $event_data ){
                $rsvp_limit_amount = isset( $event_data['etn_rsvp_limit_amount'] ) ? $event_data['etn_rsvp_limit_amount'] : '';
        }
        // Define query arguments to match the CPT and meta key
        $args = array(
            'post_type'  => 'etn_rsvp',
            'post_parent' => 0,
            'meta_query' => array(
                array(
                    'key'     => 'event_id',
                    'value'   => $id,        
                    'compare' => '=',       
                )
            ),
            'posts_per_page' => $posts_per_page,
            'paged'          => $paged 
        );

        // Add additional meta_query if status is not empty
        if ( !empty( $status ) ) {
            $args['meta_query'][] = array(
                'key'     => 'etn_rsvp_value',
                'value'   => str_replace( ['_', '-'], ' ', $status ),
                'compare' => '=',
            );
        }   

        // Add search query if name is not empty
        if ( !empty( $rsvp_title ) ) {
            $args['s'] = $rsvp_title;
        }
        

        if ( !empty( $rsvp_start_date ) && !empty( $rsvp_end_date ) ) {
            $args['date_query'] = array(
                array(
                    'after'     => $rsvp_start_date,
                    'before'    => $rsvp_end_date,
                    'inclusive' => true,
                ),
            );
        }

        // Calculate the date range based on rsvp_date_range
        if ( !empty( $rsvp_date_range ) ) {
            $current_date = new DateTime();
            if ($rsvp_date_range === 'today') {
                $start_date = $current_date->format( 'Y-m-d' );
                $end_date = $current_date->format( 'Y-m-d' );
            } else {
                $start_date = $current_date->sub( new DateInterval( 'P' . intval($rsvp_date_range) . 'D' ) )->format( 'Y-m-d' );
                $end_date = (new DateTime())->format( 'Y-m-d' );
            }

            $args['date_query'] = array(
                array(
                    'after'     => $start_date,
                    'before'    => $end_date,
                    'inclusive' => true,
                ),
            );
        }

        // Perform the query
        $query          = new WP_Query( $args );
        $total_count    = $query->found_posts;

        $query_result           = $query->posts;
        $rsvp['event_title']    = get_the_title( $id );
        
        if( $rsvp_limit_amount ) { 
            $rsvp['rsvp_limit'] = $rsvp_limit_amount;
        }
        $rsvp_count             = $this->get_etn_rsvp_counts( $query_result );
       

        if ( !empty( $rsvp_count ) && is_array( $rsvp_count ) ) {
            $rsvp['going']      = $rsvp_count['going'];
            $rsvp['not_going']  = $rsvp_count['not going'];
            $rsvp['maybe']      = $rsvp_count['maybe'];
        }

        foreach ( $query_result as $post ) {
            $post_data              = $this->prepare_item_for_response( $post, $request );
            $rsvp['items'][]        = $post_data;
        }

        $rsvp['total_items']        = $total_count;

        $response = rest_ensure_response( $rsvp );    
        // $response->header( 'X-WP-Total', $total_posts );

        return $response;
    }
    /**
     * Invite RSVP item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function invite_item( $request ) {
        $params  = $request->get_params();
        $id      = isset($params['id']) ? intval( $params['id'] ) : 0;
        $from    = ( isset( $params['from'] ) && ! empty( $params['from'] ) ) ? sanitize_email( $params['from'] ) : get_option( 'admin_email' );
        $subject = ( isset( $params['subject'] ) && ! empty( $params['subject'] ) ) ? sanitize_text_field( $params['subject'] ) : get_the_title( $id );
        $body    = ( isset( $params['body'] ) && ! empty( $params['body'] ) ) ? Helper::kses( $params['body'] ) : '';
        $status  = ( isset( $params['status'] ) && ! empty( $params['status'] ) ) ? sanitize_text_field( $params['status'] ) : 'going';

        // Define query arguments to match the CPT and meta key
        $args = array(
            'post_type'  => 'etn_rsvp',
            'post_parent' => 0,
            'meta_query' => array(
                array(
                    'key'     => 'event_id',
                    'value'   => $id,        
                    'compare' => '=',       
                )
            ),
        );

        // Add additional meta_query if status is not empty
        if ( !empty( $status ) ) {
            $args['meta_query'][] = array(
                'key'     => 'etn_rsvp_value',
                'value'   => str_replace( ['_', '-'], ' ', $status ),
                'compare' => '=',
            );
        }

        $shortcodes = $this->get_shortcode_values( $id ); 
        // Replace shortcodes in the body
        $body = str_replace( array_keys( $shortcodes ), array_values( $shortcodes ), $body );

        // Perform the query
        $query = new WP_Query( $args );

        $query_result           = $query->posts;
        $rsvp                   = [];
        foreach ( $query_result as $post ) {
            $emails = $this->get_speaker_email( $post->ID );
            if (is_array( $emails ) ) {
                foreach ( $emails as $email ) {
                    if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) { 
                        $rsvp[] = $email;
                    }
                }
            }else{
                if ( filter_var( $emails, FILTER_VALIDATE_EMAIL ) ) { 
                    $rsvp[] = $emails;
                }
            }
        }
        $rsvp = array_unique( $rsvp );
        $args = array(
            'mail_from'  => $from,
            'mail_to'    => $rsvp,
            'subject'    => $subject,
            'email_body' => $body,
            'type'       => '',
            'from_name'  => get_the_title( $id )
        );

        try {
            // Create an instance of the Invitations
            $invitation = new \Etn_Pro\Core\Modules\Rsvp\Notifications\Invitations( $args );
            
            // Return success response
            $response = array(
                'success' => true,
                'message' => 'Emails sent successfully',
                'data'    => $rsvp,
            );
        } catch ( Exception $e ) {
            // Return error response
            $response = array(
                'success' => false,
                'message' => $e->getMessage(),
            );
        }  
        // $response->header( 'X-WP-Total', $total_posts );

        return rest_ensure_response( $response );
    }

    /**
     * Delete one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function delete_item( $request ) {
        $id = intval( $request['id'] );
        $post = get_post( $id );
    
        if ( is_wp_error( $post ) ) {
            return $post;
        }
    
        // Check if the post type is 'etn_rsvp'
        if ( $post->post_type !== 'etn_rsvp' ) {
            return new WP_Error(
                'rest_invalid_post_type',
                __( 'This RSVP attende type cannot be deleted.', 'eventin-pro' ),
                array( 'status' => 403 )
            );
        }
    
        $previous = $this->prepare_item_for_response( $post, $request );
        $result = wp_delete_post( $id, true );
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
                __( 'The RSVP attendee cannot be deleted.', 'eventin-pro' ),
                array( 'status' => 500 )
            );
        }
    
        return $response;
    }

    /**
     * Delete multiple items from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function delete_items( $request ) {
        $ids = ! empty( $request['ids'] ) ? $request['ids'] : [];

        if ( ! $ids ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'RSVP attendee ids can not be empty.', 'eventin-pro' ),
                array( 'status' => 400 )
            );
        }
        $count = 0;

        foreach ( $ids as $id ) {
            $post = get_post( $id );
    
            if ( is_wp_error( $post ) ) {
                return $post;
            }
        
            // Check if the post type is 'etn_rsvp'
            if ( $post->post_type !== 'etn_rsvp' ) {
                return new WP_Error(
                    'rest_invalid_post_type',
                    __( 'RSVP attendee ids can not be empty.', 'eventin-pro' ),
                    array( 'status' => 403 )
                );
            }

            $result = wp_delete_post( $id, true );

            if ( $result ) {
                $count++;
            }
        }

        if ( $count == 0 ) {
            return new WP_Error(
                'rest_cannot_delete',
                __( 'RSVP Attendee cannot be deleted.', 'eventin-pro' ),
                array( 'status' => 500 )
            );
        }

        $message = sprintf( __( '%d events are deleted of %d', 'eventin-pro' ), $count, count( $ids ) );
        return rest_ensure_response( $message );
    }


    /**
     * Delete one item from the collection.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|WP_REST_Response
     */
    public function delete_item_permissions_check( $request ) {
        return current_user_can( 'manage_options' );
    }

    /**
     * Prepare the item for the REST response.
     *
     * @param mixed           $item WordPress representation of the item.
     * @return WP_REST_Response $response
     */
    public function prepare_item_for_response( $item, $request ) {
        $id                 = $item->ID;
        $post               = get_post( $id );
        $number_of_attendee = intval( get_post_meta( $id, 'number_of_attendee', true ) );
        $etn_rsvp_status    = get_post_meta( $id, 'etn_rsvp_value', true);
        $event_id           = intval( get_post_meta( $id, 'event_id', true ) );
        $attendee_name      = get_the_title( $id );
        $attendee_email     = get_post_meta( $id, 'attendee_email', true );
        $rsvp_date          = $post->post_modified;
        $guest              = $this->get_guest_details( $id );


        $rsvp_data = [
            'id'                      => $id,
            'number_of_attendee'      => ( $number_of_attendee >= 2 ) ? $number_of_attendee : 0,
            'status'                  => $etn_rsvp_status,
            'event_id'                => $event_id,
            'attendee_name'           => $attendee_name,
            'attendee_email'          => $attendee_email,
            'received_on'             => $rsvp_date,
            'guest'                   => $guest
        ];

        return $rsvp_data;
    }


    /**
     * Prepare the item for guest details.
     *
     * @param mixed  $post_parent_id WordPress .
     * @return WP_REST_Response $response
     */
    public function get_guest_details( $post_parent_id ) {
        $guests = array();

        $parent_email   = get_post_meta( $post_parent_id, 'attendee_email', true );
        $attendee_count = get_post_meta( $post_parent_id, 'number_of_attendee', true );
        // Set up the query arguments
        $args = array(
            'post_type'   => 'etn_rsvp',
            'post_parent' => $post_parent_id,
            'posts_per_page' => -1
        );
    
        $query = new WP_Query( $args );
    
        // Check if there are posts
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $post_id = get_the_ID();
                
                // Retrieve post meta
                $name = get_the_title( $post_id );
                $email = get_post_meta($post_id, 'attendee_email', true);

                // If parent and child post have the same email, and the attendee is equal to 1, return an empty array
                if ( $email == $parent_email && $attendee_count == 1 ) {
                    wp_reset_postdata();
                    return $guests;
                }

                if ( $name && $email ) {
                    $guests[] = array(
                        'name'  => $name,
                        'email' => $email
                    );
                }
            }
            wp_reset_postdata();
        }
    
        // Return the array of guest objects
        return $guests;
    }    
    
    
    /**
     * Prepare the item for guest details.
     *
     * @param mixed  $post_parent_id WordPress .
     * @return WP_REST_Response $response
     */
    public function get_speaker_email( $post_parent_id ) {
        $emails = array();
        $parent_email = get_post_meta( $post_parent_id, 'attendee_email', true );
    
        // Set up the query arguments
        $args = array(
            'post_type'   => 'etn_rsvp',
            'post_parent' => $post_parent_id,
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );
    
        // Create a new WP_Query instance
        $query    = new WP_Query( $args );
        //add post parent id
        $emails[] = $parent_email;
        // Check if there are posts
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $post_id = get_the_ID();
    
                // Retrieve email from child post
                $post_email = get_post_meta( $post_id, 'attendee_email', true );
    
                // Ensure the email is not the same as the parent's email
                if ( $post_email && $post_email !== $parent_email ) {
                    $emails[] = $post_email;
                }
            }
            wp_reset_postdata();
        }
    
        // Return unique emails only
        return array_unique( $emails );
    }
    


    public function get_etn_rsvp_counts($post_ids) {
        $posts = [];
        foreach ($post_ids as $post_id) {
            $posts[] = $post_id->ID;
        }
    
        // Initialize counters
        $counts = array(
            'going' => 0,
            'not going' => 0,
            'maybe' => 0,
        );
    
        if ($posts) {
            // Loop through each post ID
            foreach ($posts as $post_id) {
                // Get the RSVP value and number of attendees associated with the post
                $rsvp_value = get_post_meta($post_id, 'etn_rsvp_value', true);
                $number_of_attendees = get_post_meta($post_id, 'number_of_attendee', true);
    
                // Increment the corresponding counter
                if (isset($counts[$rsvp_value])) {
                    $counts[$rsvp_value] += $number_of_attendees;
                }
            }
    
            return $counts;
        }
    
        return $counts;
    }

    public function get_shortcode_values( $id ) {
            
        $location       = get_post_meta( $id, 'etn_event_location', true );
        $location       = isset( $location['address'] ) ? esc_attr( $location['address'] ) : '';
        $start_time     = get_post_meta( $id, 'etn_start_time', true );
        $end_time       = get_post_meta( $id, 'etn_end_time', true ); 
        $start_date     = get_post_meta( $id, 'etn_start_date', true );
        $end_date       = get_post_meta( $id, 'etn_end_date', true );
        $time           = esc_attr( $start_time ) .' - '. esc_attr( $end_time );
        $date           = esc_attr( $start_date ) .' - '. esc_attr( $end_date );
        $current_user   = wp_get_current_user();

        return [
            '{%site_name%}'         => get_bloginfo( 'name' ),
            '{%site_link%}'         => esc_url( get_permalink( $id ) ),
            '{%event_name%}'        => get_the_title( $id ),
            '{%event_date%}'        => $date,
            '{%event_time%}'        => $time,
            '{%event_location%}'    => $location,
            '{%event_title%}'       => $time,
            '{%host_name%}'         => $current_user->display_name,
            '{%host_email%}'        => $current_user->user_email,

        ];
        
    }
    
}
