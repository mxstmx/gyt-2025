<?php
namespace Eventin\Order;

use Etn\Core\Event\Event_Model;
use Eventin\Emails\AttendeeOrderEmail;
use Eventin\Interfaces\HookableInterface;
use Eventin\Mails\Mail;
use Wpeventin;
use Eventin\Order\OrderModel;
use Etn\Core\Attendee\Attendee_Model;

class OrderTicket implements HookableInterface {
    /**
     * Register service
     *
     * @return  void
     */
    public function register_hooks(): void {
        add_action( 'eventin_order_completed', [$this, 'update_event_ticket'] );
        add_action( 'eventin_order_status_completed', [$this, 'order_status_completed'] );
        add_action( 'eventin_order_status_failed', [$this, 'order_status_failed'] );

        add_action( 'eventin_attendee_created', [ $this, 'send_attendee_ticket' ] );

        add_action( 'eventin_attendee_created', [ $this, 'decrease_ticket_after_attendee_create' ] );

        add_action( 'eventin_order_refund', [ $this, 'decrese_event_sold_ticket_after_refund' ] );
        
        add_action( 'eventin_order_before_delete', [ $this, 'decrese_event_sold_ticket_after_order_delete' ] );

        add_action( 'eventin_attendee_before_delete', [ $this, 'decrese_event_sold_ticket_after_attendee_delete' ] );
    }

    /**
     * After booking an event ticket decrese ticket amount
     *
     * @return  void
     */
    public function update_event_ticket( $order ) {
        if ( 'completed' !== $order->status ) {
            return;
        }

        $event = new Event_Model( $order->event_id );

        $event_tickets = $event->etn_ticket_variations;

        $updated_tickets = [];

        if ( $event_tickets ) {
            foreach( $event_tickets as $ticket ) {
                $updated_ticket = $this->prepare_event_ticket( $order, $ticket );

                $updated_tickets[] = $updated_ticket;
            }
        }
        
        $event->update([ 'etn_ticket_variations' => $updated_tickets ]);

        $this->update_booked_seat($event, $order);
    }

    /**
     * After booking update event ticket status
     *
     * @param   OrderModel  $order  The order need to update
     *
     * @return  void
     */
    public function order_status_completed( $order ) {
        if ( 'completed' !== $order->status ) {
            return;
        }

        $event = new Event_Model( $order->event_id );

        $event_tickets = $event->etn_ticket_variations;

        $updated_tickets = [];

        if ( $event_tickets ) {
            foreach( $event_tickets as $ticket ) {
                $updated_ticket = $this->prepare_event_ticket( $order, $ticket );

                $updated_tickets[] = $updated_ticket;
            }
        }
        
        $event->update([ 'etn_ticket_variations' => $updated_tickets ]);

        $this->update_booked_seat($event, $order);
    }

    /**
     * Prepare updated event ticket
     *
     * @param   OrderModel  $order  [$order description]
     * @param   string  $slug   [$slug description]
     *
     * @return  array          [return description]
     */
    private function prepare_event_ticket( $order, $event_ticket ) {
        $order_tickets = $order->tickets;

        foreach( $order_tickets as $ticket ) {
            if ( $ticket['ticket_slug'] === $event_ticket['etn_ticket_slug'] ) {
                $event_ticket['etn_sold_tickets'] = $event_ticket['etn_sold_tickets'] + $ticket['ticket_quantity'];
                $event_ticket['pending'] = isset( $event_ticket['pending'] ) ? $event_ticket['pending'] - $ticket['ticket_quantity'] : 0;
                break;
            }
        }

        return $event_ticket;
    }

    /**
     * Update booked event booked seats
     *
     * @param   Event_Model  $event  [$event description]
     * @param   Order_Model  $order  [$order description]
     *
     * @return  void
     */
    private function update_booked_seat( $event, $order ) {
        $event_seats = get_post_meta( $event->id, '_etn_seat_unique_id', true );

        $order_seats = $order->seat_ids;

        if ( ! $order_seats ) {
            return;
        }

        $event_seats = explode(',', $event_seats );

        $event_seats = array_merge( $event_seats, $order_seats );
        $event_seats = implode( ',', array_unique( $event_seats ) );

        update_post_meta( $event->id, '_etn_seat_unique_id', $event_seats );
    }

    /**
     * Send attendee ticket after creating a attendee
     *
     * @param   Attendee_Model  $attendee  [$attendee description]
     *
     * @return  void             [return description]
     */
    public function send_attendee_ticket( $attendee ) {
        $purchase_email = etn_get_email_settings( 'purchase_email' );
        if(is_array($purchase_email) && array_key_exists( 'send_email_to_attendees', $purchase_email ) ){
            // If the setting exists, use it
           $send_email_to_attendees = $purchase_email['send_email_to_attendees'];
        }
        else{
            $send_email_to_attendees = true;
        }

        if ( !$send_email_to_attendees ) {
            return;
        }

        if ( $attendee->etn_email ) {
            $from  = etn_get_email_settings( 'purchase_email' )['from'];
            $event = new Event_Model( $attendee->etn_event_id );
            Mail::to($attendee->etn_email)->from( $from )->send(new AttendeeOrderEmail($event, $attendee));
        }
    }

    /**
     * Update event ticket quantity after attendee create
     *
     * @return  void
     */
    public function decrease_ticket_after_attendee_create( $attendee ) {
        $event = new Event_Model( $attendee->etn_event_id );

        $event_tickets = $event->etn_ticket_variations;

        if ( $event_tickets ) {
            foreach( $event_tickets as &$ticket ) {
                if ( $ticket['etn_ticket_name'] === $attendee->ticket_name ) {
                    $ticket['etn_sold_tickets'] = $ticket['etn_sold_tickets'] + 1;
                }
            }
        }

        $event->update([
            'etn_ticket_variations' => $event_tickets,
            'etn_total_sold_tickets' => (int) $event->etn_total_sold_tickets + 1
        ]);
    }

    /**
     * Decrese event ticket variation amount after refunded
     *
     * @param   OrderModel  $order  The order need to refund
     *
     * @return  void
     */
    public function decrese_event_sold_ticket_after_refund( OrderModel $order ) {
        if ( 'refunded' != $order->status ) {
            return;
        }

        $event = new Event_Model( $order->event_id );

        $event_tickets = $event->etn_ticket_variations;

        if ( $event_tickets ) {
            foreach( $event_tickets as &$ticket ) {
                $ticket_amount = $order->get_total_ticket_by_ticket( $ticket['etn_ticket_slug'] );
                if ( $ticket_amount > 0 ) {
                    $ticket['etn_sold_tickets'] = $ticket['etn_sold_tickets'] - $ticket_amount;
                }
            }
        }

        $event->update([
            'etn_ticket_variations' => $event_tickets,
        ]);

        // Update seat on refunded.
        $event_seats = get_post_meta( $event->id, '_etn_seat_unique_id', true );
        $order_seats = $order->seat_ids;

        if ( $order_seats ) {
            $event_seats = explode(',', $event_seats );

            $event_seats = array_diff( $event_seats, $order_seats );
            $event_seats = implode( ',', array_unique( $event_seats ) );

            update_post_meta( $event->id, '_etn_seat_unique_id', $event_seats );
        }
    }

    /**
     * Decrese event ticket variation amount after order status failed
     *
     * @param   OrderModel  $order  The order need to update
     *
     * @return  void
     */
    public function order_status_failed( $order ) {
        if ( 'failed' != $order->status ) {
            return;
        }

        $event = new Event_Model( $order->event_id );

        $event_tickets = $event->etn_ticket_variations;

        if ( $event_tickets ) {
            foreach( $event_tickets as &$ticket ) {
                $ticket_amount = $order->get_total_ticket_by_ticket( $ticket['etn_ticket_slug'] );
                if ( $ticket_amount > 0 ) {
                    $ticket['etn_sold_tickets'] = $ticket['etn_sold_tickets'] - $ticket_amount;
                }
            }
        }

        $event->update([
            'etn_ticket_variations' => $event_tickets,
        ]);

        // Update seat on refunded.
        $event_seats = get_post_meta( $event->id, '_etn_seat_unique_id', true );
        $order_seats = $order->seat_ids;

        if ( $order_seats ) {
            $event_seats = explode(',', $event_seats );

            $event_seats = array_diff( $event_seats, $order_seats );
            $event_seats = implode( ',', array_unique( $event_seats ) );

            update_post_meta( $event->id, '_etn_seat_unique_id', $event_seats );
        }
    }

    /**
     * Decrese event ticket variation amount after order deleted
     *
     * @param   OrderModel  $order  The order need to delete
     *
     * @return  void
     */
    public function decrese_event_sold_ticket_after_order_delete( OrderModel $order ) {
        if ( $order->status !== 'completed' ) {
            return;
        }
        $event = new Event_Model( $order->event_id );

        $event_tickets = $event->etn_ticket_variations;

        if ( $event_tickets ) {
            foreach( $event_tickets as &$ticket ) {
                $ticket_amount = $order->get_total_ticket_by_ticket( $ticket['etn_ticket_slug'] );
                if ( $ticket_amount > 0 ) {
                    $ticket['etn_sold_tickets'] = $ticket['etn_sold_tickets'] - $ticket_amount;
                }
            }
        }

        $event->update([
            'etn_ticket_variations' => $event_tickets,
        ]);

        // Update seat on refunded.
        $event_seats = get_post_meta( $event->id, '_etn_seat_unique_id', true );
        $order_seats = $order->seat_ids;

        if ( $order_seats ) {
            $event_seats = explode(',', $event_seats );

            $event_seats = array_diff( $event_seats, $order_seats );
            $event_seats = implode( ',', array_unique( $event_seats ) );

            update_post_meta( $event->id, '_etn_seat_unique_id', $event_seats );
        }
    }

    /**
     * Decrese event sold ticket after attendee delete
     *
     * @param   Attendee_Model  $attendee
     *
     * @return  void
     */
    public function decrese_event_sold_ticket_after_attendee_delete( $attendee ) {
        if ( $attendee->etn_status != 'success' ) {
            return;
        }

        $event = new Event_Model( $attendee->etn_event_id );
        $order = new OrderModel( $attendee->eventin_order_id );

        // Decrease sold ticket quantity from event
        $event_tickets = $event->etn_ticket_variations;

        if ( $event_tickets ) {
            foreach( $event_tickets as &$ticket ) {
                if ( $ticket['etn_ticket_name'] == $attendee->ticket_name ) {
                    $ticket['etn_sold_tickets'] = $ticket['etn_sold_tickets'] - 1;
                }
            }
        }

        $event->update([
            'etn_ticket_variations' => $event_tickets,
        ]);

        // Decrease sold ticket quantity from order
        $order_tickets = $order->tickets;
        $updated_tickets = [];
        if ( $order_tickets ) {
            foreach( $order_tickets as $ticket ) {
                
                $ticket_slug = $event->get_ticket_slug_by_name( $attendee->ticket_name );
                if ( $ticket['ticket_slug'] === $ticket_slug ) {
                    $ticket['ticket_quantity'] = $ticket['ticket_quantity'] - 1;
                }

                if ( $ticket['ticket_quantity'] > 0 ) {
                    $updated_tickets[] = $ticket;
                }
            }
        }
        
        // Decrease ticket quantity from order
        $order->update([
            'tickets'     => $updated_tickets,
            'total_price' => floatval($order->total_price) - floatval($attendee->etn_ticket_price),
        ]);
    }

    /**
     * Temporary hold tickets after order created
     *
     * @param   OrderModel  $order  The order need to hold tickets
     *
     * @return  void
     */
    public function temporary_hold_tickets( OrderModel $order ) {
        if ( 'pending' !== $order->status ) {
            return;
        }

        $event = new Event_Model( $order->event_id );

        $event_tickets = $event->etn_ticket_variations;

        if ( ! $event_tickets ) {
            return;
        }

        foreach( $event_tickets as &$ticket ) {
            foreach( $order->tickets as $order_ticket ) {
                if ( $ticket['etn_ticket_slug'] === $order_ticket['ticket_slug'] ) {
                    if ( ! isset( $ticket['pending'] ) ) {
                        $ticket['pending'] = 0;
                    }
                    $ticket['pending'] += $order_ticket['ticket_quantity'];
                }
            }
        }

        // Update event tickets and pending seats
        if ( ! isset( $event->pending_seats ) ) {
            $event->pending_seats = [];
        }

        if ( ! is_array( $event->pending_seats ) ) {
            $event->pending_seats = explode( ',', $event->pending_seats );
        }

        $event->update([
            'etn_ticket_variations' => $event_tickets,
        ]);

        if ( is_array( $order->seat_ids ) && count( $order->seat_ids ) > 0 ) {
            $event->update([
                'pending_seats' => array_merge(
                    $event->pending_seats,
                    $order->seat_ids
                )
            ]);
        }

        $ticket_purchase_timer = etn_get_option( 'ticket_purchase_timer', 10 );
        
        wp_schedule_single_event( time() + ( $ticket_purchase_timer * MINUTE_IN_SECONDS ), 'eventin_release_held_tickets', [ $order->id ] );
    }

    /**
     * Release held tickets after order status changed to pending
     *
     * @param   integer  $order_id  The order ID
     *
     * @return  void
     */
    public function release_held_tickets( $order_id ) {
        $order = new OrderModel( $order_id );

        if ( 'pending' !== $order->status ) {
            return;
        }

        $order->update([
            'status' => 'failed'
        ]);

        $event = new Event_Model( $order->event_id );

        $event_tickets = $event->etn_ticket_variations;

        if ( ! $event_tickets ) {
            return;
        }

        foreach( $event_tickets as &$ticket ) {
            foreach( $order->tickets as $order_ticket ) {
                if ( $ticket['etn_ticket_slug'] === $order_ticket['ticket_slug'] ) {
                    $ticket['pending'] -= $order_ticket['ticket_quantity'];
                }
            }
        }

        // Update event tickets and pending seats
        if ( ! isset( $event->pending_seats ) ) {
            $event->pending_seats = [];
        }

        if ( ! is_array( $event->pending_seats ) ) {
            $event->pending_seats = explode( ',', $event->pending_seats );
        }
        
        $event->update([
            'etn_ticket_variations' => $event_tickets,
        ]);

        if ( is_array( $order->seat_ids ) && count( $order->seat_ids ) > 0 ) {
            $event->update([
                'pending_seats' => array_diff(
                    $event->pending_seats,
                    $order->seat_ids
                )
            ]);
        }

        // Update order attendees status
        $attendees = $order->get_attendees();
        if ( $attendees ) {
            foreach( $attendees as $attendee ) {
                $attendee = new Attendee_Model( $attendee['id'] );
                $attendee->update([
                    'etn_status' => 'failed'
                ]);
            }
        }
    }

    /**
     * Clear hold tickets cron
     *
     * @param   OrderModel  $order  The order need to clear hold tickets
     *
     * @return  void
     */
    public function clear_hold_tickets_cron( $order ) {
        wp_clear_scheduled_hook( 'eventin_release_held_tickets', [ $order->id ] );
    }
}
