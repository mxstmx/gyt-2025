<?php
/**
 * Webhook For Eventin
 *
 * @package EventinPro
 */
namespace Etn_Pro\Core\Webhook;

use Etn_Pro\Core\Webhook\Payloads\PayloadFactory;
use Etn\Core\Speaker\User_Model;

/**
 * Class Webhook
 *
 * @since 3.3.6
 */
class Webhook {
    /**
     * Store post type
     *
     * @var string
     */
    protected $post_type = 'etn-webhook';

    /**
     * Store webhook id
     *
     * @var integer
     */
    protected $id;

    /**
     * Store meta key prefix
     *
     * @var string
     */
    protected $meta_prefix = '_etn_webhook_';

    /**
     * Check whick object IDS this webhook has been processed.
     *
     * @var array
     */
    protected $processed = [];

    /**
     * Medata data for webhook
     *
     * @var array
     */
    protected $data = [
        'name'         => '',
        'status'       => '',
        'topic'        => '',
        'delivery_url' => '',
        'description'  => '',
        'secrete'      => '',
    ];

    /**
     * Store all props
     *
     * @var array
     */
    protected $props = [];

    /**
     * Constructor for the Class Webhook
     *
     * @return  void
     */
    public function __construct( $webhook = 0 ) {
        if ( $webhook instanceof self ) {
            $this->set_id( $webhook->get_id() );
        } elseif ( ! empty( $webhook->ID ) ) {
            $this->set_id( $webhook->ID );
        } else if ( is_numeric( $webhook ) ) {
            $this->set_id( $webhook );
        }
    }

    /**
     * Enqueue the hooks associated with webhook
     *
     * @return  void
     */
    public function enqueue() {
        $hooks = $this->get_hooks();
        $url   = $this->get_delivery_url();

        if ( is_array( $hooks ) && ! empty( $url ) ) {
            foreach ( $hooks as $hook ) {
                add_action( $hook, [$this, 'process'] );
            }
        }
    }

    /**
     * Process the webhook for delivery by verifying that it should be delivered
     *
     * @param   mixed  $args  The first argument provided from the associated hook
     *
     * @return  mixed  $args Returns the argument incase the webhook was hooked into a filter
     */
    public function process( $args ) {
        if ( ! $this->should_deliver( $args ) ) {
            return;
        }
        
        $this->processed[] = $args;

        /**
         * Process webhook delivery.
         *
         * @hooked
         */
        do_action( 'etn_webhook_process_delivery', $this, $args );

        return $args;
    }

    /**
     * Check webhook deliver some hook.
     *
     * @param   integer  $arg  Post ID
     *
     * @return  bool
     */
    public function should_deliver( $arg ) {
        return $this->is_active() && ! $this->is_already_processed( $arg );
    }

    /**
     * Check if the speficied resource already been queued for delivery.
     *
     * @param   integer  $arg  [$arg description]
     *
     * @return  bool
     */
    public function is_already_processed( $arg ) {
        return false != array_search( $arg, $this->processed );
    }

    public function deliver( $args ) {
        $payload = $this->build_payload( $args );

        // Setup request args.
        $http_args = [
            'method'      => 'POST',
            'timeout'     => MINUTE_IN_SECONDS,
            'redirection' => 0,
            'httpversion' => 1.0,
            'blocking'    => true,
            'body'        => trim( wp_json_encode( $payload ) ),
            'headers'     => [
                'Content-Type' => 'application/json',
            ],
            'cookies'     => [],
        ];

        // Webhook away !
        $response = wp_remote_request( $this->get_delivery_url(), $http_args );
    }

    /**
     * Build the payload data for the webhook.
     *
     * @param   integer  $args  Post ID
     *
     * @return  array
     */
    public function build_payload( $arg ) {

        $payload = PayloadFactory::get_payload( $arg );

        $data = $payload->get_data( $arg );

        return $data;
    }

    // Getters.

    /**
     * Get webhook id
     *
     * @return  integer  Webhook id
     */
    public function get_id() {
        return $this->id;
    }

    /**
     * Get webhook name
     *
     * @return  string  Webhook name
     */
    public function get_name() {
        return $this->get_prop( 'name' );
    }

    /**
     * Get webhook status
     *
     * @return  string
     */
    public function get_status() {
        return $this->get_prop( 'status' );
    }

    /**
     * Get topic for the webhook
     *
     * @return  string
     */
    public function get_topic() {
        return $this->get_prop( 'topic' );
    }

    /**
     * Get webhook description
     *
     * @return  string
     */
    public function get_description() {
        return $this->get_prop( 'description' );
    }

    /**
     * Get webhook secrete
     *
     * @return  string
     */
    public function get_secrete() {
        return $this->get_prop( 'secrete' );
    }

    /**
     * Get webhook delivery url
     *
     * @return  string
     */
    public function get_delivery_url() {
        return $this->get_prop( 'delivery_url' );
    }

    /**
     * Get all hooks for the webhook
     *
     * @return  array
     */
    public function get_hooks() {
        return $this->get_topic_hooks( $this->get_topic() );
    }

    public function get_prop( $prop = '' ) {
        return $this->get_metadata( $prop );
    }

    /**
     * Get metadata
     *
     * @param   string  $prop  Meta key for the webhook
     *
     * @return  string
     */
    public function get_metadata( $prop ) {
        // Meta key for the value.
        $key = $this->meta_prefix . $prop;

        /**
         * Get meta value
         *
         * @var string
         */
        return get_post_meta( $this->id, $key, true );
    }

    /**
     * Check webhook status is active or not
     *
     * @return  bool
     */
    public function is_active() {
        return 'active' == $this->get_status();
    }

    /**
     * Get event name like: created, deleted, updated, restored
     *
     * @return  string
     */
    public function get_event() {
        $topic = explode( '.', $this->get_topic() );

        return isset( $topic[1] ) ? $topic[1] : '';
    }

    // Settters.

    /**
     * Set props for webhook
     *
     * @param   array  $data
     *
     * @return  []
     */
    public function set_props( $data = [] ) {
        $this->data = wp_parse_args( $data, $this->data );
    }

    /**
     * Set webhook id
     *
     * @param   integer $id  webhook id
     *
     * @return  void
     */
    public function set_id( $id ) {
        $this->id = $id;
    }

    /**
     * Update metadata for webhook
     *
     * @return  void
     */
    protected function save_metadata() {
        foreach ( $this->data as $key => $value ) {
            // Prepare meta key.
            $meta_key = $this->meta_prefix . $key;

            // Update webhook metadata.
            update_post_meta( $this->get_id(), $meta_key, $value );
        }
    }

    /**
     * Save webhook
     *
     * @return  void
     */
    public function save() {
        /**
         * Preapare args for the webhook
         *
         * @var array
         */
        $args = [
            'post_title'  => $this->data['name'],
            'post_type'   => $this->post_type,
            'post_status' => 'publish',
            'post_author' => 1,
        ];

        // Add id when need to update webhook.
        if ( ! empty( $this->id ) ) {
            $args['ID'] = $this->id;
        }

        // Insert or Update webhook.
        $post_id = wp_insert_post( $args );

        // Set webhook id.
        if ( ! is_wp_error( $post_id ) ) {
            $this->set_id( $post_id );
            $this->save_metadata();
        }
    }

    /**
     * Delete webhook
     *
     * @return bool
     */
    public function delete() {
        return wp_delete_post( $this->get_id(), true );
    }

    /**
     * Get webhook topic hooks
     *
     * @param   string  $topic
     *
     * @return  array
     */
    public function get_topic_hooks( $topic ) {
        $topic_hooks = [
            'event.created'    => [
                'eventin_event_created',
            ],
            'event.updated'    => [
                'eventin_event_updated',
            ],
            'event.deleted'    => [
                'eventin_event_before_delete',
            ],
            'event.restored'   => [
                'eventin_restore_etn',
            ],
            'speaker.created'  => [
                'eventin_speaker_created',
            ],
            'speaker.updated'  => [
                'eventin_speaker_update',
            ],
            'speaker.deleted'  => [
                'eventin_speaker_before_delete',
            ],
            'speaker.restored' => [
                'eventin_restore_etn-speaker',
            ],
            'attendee.created'  => [
                'eventin_attendee_payment_completed',
                'eventin_attendee_created',
            ],
            'attendee.updated'  => [
                'eventin_attendee_updated',
            ],
            'attendee.deleted'  => [
                'eventin_attendee_before_delete',
            ],
            'attendee.restored' => [
                'eventin_restore_etn-attendee',
            ],
            'schedule.created'  => [
                'eventin_schedule_created',
            ],
            'schedule.updated'  => [
                'eventin_schedule_updated',
            ],
            'schedule.deleted'  => [
                'eventin_schedule_before_delete',
            ],
            'schedule.restored' => [
                'eventin_restore_etn-schedule',
            ],
            'order.created'  => [
                'eventin_order_completed',
            ],
            'order.updated'  => [
                'eventin_after_order_update',
            ],
            'order.deleted'  => [
                'eventin_order_before_delete',
            ],
        ];

        $hooks = isset( $topic_hooks[$topic] ) ? $topic_hooks[$topic] : [];

        return $hooks;
    }
}
