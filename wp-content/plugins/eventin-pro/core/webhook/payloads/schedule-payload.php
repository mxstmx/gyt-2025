<?php
/**
 * Schedule Payload
 *
 * @package Eventin
 */
namespace Etn_Pro\Core\Webhook\Payloads;

/**
 * Schedule Payload Class
 */
class SchedulePayload implements PayloadInterface {
    /**
     * Get payload
     *
     * @param   mixed  $item
     *
     * @return  array
     */
    public function get_data( $item ) {

        $post = get_post( $item->id );

        if ( ! $post ) {
            return $item->id;
        }

        $_topics         = get_post_meta( $item->id, 'etn_schedule_topics', true );
        $schedule_topics = [];

        if ( $_topics && is_array( $_topics ) ) {
            foreach ( $_topics as $_topic ) {
                $topic      = ! empty( $_topic['etn_schedule_topic'] ) ? $_topic['etn_schedule_topic'] : '';
                $start_time = ! empty( $_topic['etn_shedule_start_time'] ) ? $_topic['etn_shedule_start_time'] : '';
                $end_time   = ! empty( $_topic['etn_shedule_end_time'] ) ? $_topic['etn_shedule_end_time'] : '';
                $location   = ! empty( $_topic['etn_shedule_room'] ) ? $_topic['etn_shedule_room'] : '';
                $speakers   = ! empty( $_topic['speakers'] ) ? $_topic['speakers'] : '';
                $details    = ! empty( $_topic['etn_shedule_objective'] ) ? $_topic['etn_shedule_objective'] : '';

                $schedule_topics[] = [
                    'topic'     => $topic,
                    'startTime' => $start_time,
                    'endTime'   => $end_time,
                    'location'  => $location,
                    'speakers'  => $speakers,
                    'details'   => $details,
                ];
            }
        }

        return [
            'id'            => $item->id,
            'title'         => get_post_meta( $item->id, 'etn_schedule_title', true ),
            'date'          => get_post_meta( $item->id, 'etn_schedule_date', true ),
            'nameOfTheDay'  => get_post_meta( $item->id, 'etn_schedule_day', true ),
            'scheduleSlots' => $schedule_topics,
        ];
    }
}
