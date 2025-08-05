<?php
/**
 * Payload Class
 * 
 * @package Eventin
 */
namespace Etn_Pro\Core\Webhook\Payloads;

use Etn\Core\Event\Event_Model;
use Etn\Core\Attendee\Attendee_Model;
use Etn\Core\Speaker\User_Model;
use Eventin\Order\OrderModel;
use Etn\Core\Schedule\Schedule_Model;

/**
 * Class Payload
 */
class PayloadFactory {
    /**
     * Get payload method
     *
     * @return  Object
     */
    public static function get_payload( $object ) {
        switch ( $object ) {
            case is_a( $object, Event_Model::class ):
                return new EventPayload();
            case is_a( $object, User_Model::class ):
                return new SpeakerPayload();
            case is_a( $object, Attendee_Model::class ):
                return new AttendeePayload();
            case is_a( $object, Schedule_Model::class ):
                return new SchedulePayload();
            case is_a( $object, OrderModel::class ):
                return new OrderPayload();
        }
    }
}
