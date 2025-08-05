<?php
/**
 * Event Controller
 * 
 * @package Eventin Pro
 */
namespace EventinPro\Event\Api;

use Eventin\Event\Api\EventController as ApiEventController;
use WP_REST_Server;
use Etn_Pro\Utils\Helper;
use WP_Error;
use Etn\Core\Attendee\Attendee_Model;
use Eventin\Mails\Mail;
use Etn\Core\Event\Event_Model;
use Eventin\Emails\AttendeeCertificateEmail;
use EventinAi\Core\Ai;
use EventinPro\AiGenerator\AiGeneratorManager;

/**
 * EventController Class
 */
class EventController extends ApiEventController {
    /**
     * Check if a given request has access to get items.
     *
     * @param WP_REST_Request $request Full data about the request.
     * @return WP_Error|boolean
     */
    public function register_routes() {
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/(?P<id>[\d]+)' . '/send_certificate',
            array(
                'args' => array(
                    'id' => array(
                        'description' => __( 'Unique identifier for the post.', 'eventin-pro' ),
                        'type'        => 'integer',
                    ),
                ),
                array(
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'send_certificate' ),
                    'permission_callback' => array( $this, 'get_item_permissions_check' ),
                    'args'                => $this->get_collection_params(),
                ),

                // 'allow_batch' => $this->allow_batch,
                'schema' => array( $this, 'get_item_schema' ),
            ),
        );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/certificate_templates',
            array(
                'args' => array(
                    'id' => array(
                        'description' => __( 'Unique identifier for the post.', 'eventin-pro' ),
                        'type'        => 'integer',
                    ),
                ),
                array(
                    'methods'             => WP_REST_Server::READABLE,
                    'callback'            => array( $this, 'get_certificate_templates' ),
                    'permission_callback' => array( $this, 'get_item_permissions_check' ),
                    'args'                => $this->get_collection_params(),
                ),

                // 'allow_batch' => $this->allow_batch,
                'schema' => array( $this, 'get_item_schema' ),
            ),
        );

        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/buddyboss/assign_group',
            array(
                'args' => array(
                    'id' => array(
                        'description' => __( 'Unique identifier for the post.', 'eventin-pro' ),
                        'type'        => 'integer',
                    ),
                ),
                array(
                    'methods'             => WP_REST_Server::CREATABLE,
                    'callback'            => array( $this, 'assign_buddyboss_group' ),
                    'permission_callback' => array( $this, 'get_item_permissions_check' ),
                    'args'                => $this->get_collection_params(),
                ),

                // 'allow_batch' => $this->allow_batch,
                'schema' => array( $this, 'get_item_schema' ),
            ),
        );
    }

    /**
     * Send certificate
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  json
     */
    public function send_certificate( $request ) {
        $event_id = intval( $request['id'] );

        $certificate_template = get_post_meta( $event_id, 'certificate_template', true );

        if ( ! $certificate_template ) {
            return new WP_Error( 'template_error', __( 'Please select certificate template first.', 'eventin' ), ['status' => 422] );
        }

        $event         = new Event_Model( $event_id );
        $attendees     = $event->get_attendees();
        $from          = get_option('admin_email');

        if ( ! $attendees ) {
            return new WP_Error( 'attendee_error', __( 'No attendee found.', 'eventin' ), ['status' => 422] );
        }

        // Send to attendees email.
        if ( $attendees ) {
            foreach( $attendees as $attendee ) {
                $attendee = new Attendee_Model( $attendee['id'] );
                
                if ( $attendee->etn_email ) {
                    Mail::to( $attendee->etn_email )->from( $from )->send( new AttendeeCertificateEmail( $event, $attendee ) );
                }
            }
        }

        $response = [
            'message'   => __( 'Successfully send certificate', 'eventin' ),
        ];

        return rest_ensure_response( $response );
    }

    /**
     * Get all certificate pages usages as certificate templates
     *
     * @param   WP_Rest_Request  $request
     *
     * @return  array
     */
    public function get_certificate_templates( $request ) {
        $args = array(
            'post_type' => 'page',//it is a Page right?
            'post_status' => 'publish',
            'meta_query' => array(
                array(
                    'key' => '_wp_page_template',
                    'value' => 'template-pdf-certificate.php', // template name as stored in the dB
                )
            )
        );

        $pages = get_posts( $args );

        $items = [];

        if ( $pages ) {
            
            foreach( $pages as $page ) {
                $item = [
                    'id'    => $page->ID,
                    'title' => $page->post_title
                ];
                $items[] = $item;
            }
        }

        return rest_ensure_response( $items );
    }

    /**
     * Assign buddyboss group to event
     *
     * @param   WP_Rest_Request  $request  Rest Request Object
     *
     * @return  WP_Rest_Response    Rest Response
     */
    public function assign_buddyboss_group( $request ) {
        $data = json_decode( $request->get_body(), true );

        $event_id = ! empty( $data['event_id'] ) ? intval( $data['event_id'] ) : 0;
        $group_id = ! empty( $data['group_id'] ) ? intval( $data['group_id'] ) : 0;

        if ( ! $event_id ) {
            return new WP_Error( 'event_id_error', __( 'Event id can\'t be empty', 'eventin-pro' ), ['status' => 422] );
        }

        if ( ! $group_id ) {
            return new WP_Error( 'group_id_error', __( 'Event id can\'t be empty', 'eventin-pro' ), ['status' => 422] );
        }

        $assigned_group = update_post_meta( $event_id, 'etn_bp_group_' . $group_id, $group_id );


        $saved_group_id = get_post_meta($event_id, "etn_bp_group_{$group_id}", true);
		
        $action = 'add';

        if ( $saved_group_id ) {
            $action = 'update';
        } 
		

        do_action('etn_assign_event_to_group', $event_id, $group_id, $action );

        return rest_ensure_response( [
            'success'       =>  true,
            'message'       => __( 'Successfully assigned event', 'eventin-pro' ),
        ] );
    }
}