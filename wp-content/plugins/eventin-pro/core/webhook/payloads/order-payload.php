<?php
/**
 * Order Payload
 *
 * @package Eventin
 */
namespace Etn_Pro\Core\Webhook\Payloads;

use Eventin\Order\OrderModel;

/**
 * Order Payload Class
 */
class OrderPayload implements PayloadInterface {
    /**
     * Get payload
     *
     * @param   mixed  $args
     *
     * @return  array
     */
    public function get_data( $id ) {
        $order = new OrderModel( $id );

        if ( ! get_post( $order->id ) ) {
            return $order->id;
        }

        $event = get_post( $order->event_id );

        $order_data = [
            'id'                => $order->id,
            'customer_fname'    => $order->customer_fname,
            'customer_lname'    => $order->customer_lname,
            'customer_email'    => $order->customer_email,
            'customer_phone'    => $order->customer_phone,
            'date_time'         => $order->date_time,
            'event_id'          => $order->event_id,
            'event_name'        => $event ? $event->post_title : '',
            'payment_method'    => $order->payment_method,
            'status'            => $order->status,
            'total_price'       => $order->total_price,
            'total_ticket'      => $order->get_total_ticket(),
            'ticket_items'      => $order->get_tickets(),
            'attendees'         => $order->get_attendees(),
            'seat_ids'          => $order->seat_ids,
            'attendee_seats'    => $order->attendee_seats,
        ];

        return $order_data;
    }
}
