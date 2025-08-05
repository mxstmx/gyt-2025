<?php
/**
 * Speaker Payload
 * 
 * @package Eventin
 */
namespace Etn_Pro\Core\Webhook\Payloads;

use Etn\Core\Speaker\User_Model;

/**
 * Speaker Payload Class
 */
class SpeakerPayload implements PayloadInterface {
    /**
     * Get payload
     *
     * @param   mixed  $args
     *
     * @return  array
     */
    public function get_data( $user ) {

        $user_data = get_userdata( $user->id );

        if ( ! $user_data ) {
            return $user->id;
        }

        $item = $user->get_data( $user->id );

        return $item;
    }
}
