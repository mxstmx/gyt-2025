<?php
/**
 * Event Payload
 *
 * @package Eventin
 */
namespace Etn_Pro\Core\Webhook\Payloads;

use Etn\Core\Attendee\Attendee_Model;
use Etn\Core\Event\Event_Model;
use \Etn_Pro\Utils\Helper;

/**
 * Attendee Payload Class
 */
class AttendeePayload implements PayloadInterface {
    /**
     * Get payload
     *
     * @param   mixed  $args
     *
     * @return  array
     */
    public function get_data( $id ) {
        $attendee = new Attendee_Model( $id );

        if ( ! get_post( $attendee->id ) ) {
            return $attendee->id;
        }

        $data        = $attendee->get_data();
        $event_id    = ! empty( $data['etn_event_id'] ) ? $data['etn_event_id'] : 0;
        $event       = new Event_Model( $event_id );
        
        $ticket_name = ! empty( $data['ticket_name'] ) ? $data['ticket_name'] : '';
        $ticket_slug = $event->get_ticket_slug_by_name( $ticket_name );

        $payload = [
            'id'                => intval( $data['id'] ),
            'name'              => ! empty( $data['etn_name'] ) ? $data['etn_name'] : '',
            'email'             => ! empty( $data['etn_email'] ) ? $data['etn_email'] : '',
            'phone'             => ! empty( $data['etn_phone'] ) ? $data['etn_phone'] : '',
            'event_id'          => $event_id,
            'event_name'        => ! empty( $data['event_name'] ) ? $data['event_name'] : '',
            'ticket_name'       => $ticket_name,
            'ticket_slug'       => $ticket_slug,
            'ticket_price'      => ! empty( $data['etn_ticket_price'] ) ? $data['etn_ticket_price'] : '',
            'ticket_status'     => ! empty( $data['etn_attendeee_ticket_status'] ) ? $data['etn_attendeee_ticket_status'] : '',
            'payment_status'     => ! empty( $data['etn_status'] ) ? $data['etn_status'] : '',

            'ticket_id'         => ! empty( $data['etn_unique_ticket_id'] ) ? $data['etn_unique_ticket_id'] : '',
            'extra_fields'      => $attendee->get_extra_fields(),
        ];

        return $payload;
    }
}
