<?php
/**
 * Event Payload
 *
 * @package Eventin
 */
namespace Etn_Pro\Core\Webhook\Payloads;

use Etn\Core\Event\Event_Model;

/**
 * Event Payload Class
 */
class EventPayload implements PayloadInterface {
    /**
     * Get payload
     *
     * @param   mixed  $args
     *
     * @return  array
     */
    public function get_data( $event_id ) {
        $event          = new Event_Model( $event_id );

        $post           = get_post( $event->id );

        if ( ! $post ) {
            return $event->id;
        }

        $status         = get_post_status( $event->id );
        $id             = $event->id;
        $author         = get_userdata( $post->post_author )->display_name;
        $categories     = get_the_terms( $id, 'etn_category' );
        $category_names = wp_list_pluck( $categories, 'name', 'term_id' );
        $categories     = $categories ? array_column( $categories, 'term_id' ) : [];
        $end_date       = strtotime( get_post_meta( $id, 'etn_end_date', true ) );
        $curretn_date   = strtotime( date( 'Y-m-d' ) );

        $schedules       = get_post_meta( $id, 'etn_event_schedule', true );
        $organizer       = get_post_meta( $id, 'etn_event_organizer', true );
        $speaker         = get_post_meta( $id, 'etn_event_speaker', true );
        $organizer_group = get_post_meta( $id, 'organizer_group', true );
        $speaker_group   = get_post_meta( $id, 'speaker_group', true );
        $extra_fields    = get_post_meta( $id, 'attendee_extra_fields', true );
        $meeting_link    = get_post_meta( $id, 'meeting_link', true );
        $rsvp_settings   = get_post_meta( $id, 'rsvp_settings', true );
        $speaker_type    = get_post_meta( $id, 'speaker_type', true );
        $organizer_type  = get_post_meta( $id, 'organizer_type', true );
        $event_slug      = '';

        if ( ! empty( $rsvp_settings['rsvp_form_type'] ) ) {
            $rsvp_settings['rsvp_form_type'] = is_array( $rsvp_settings['rsvp_form_type'] ) ? array_values( $rsvp_settings['rsvp_form_type'] ) : [];
        }

        $extra_fields    = is_array( $extra_fields ) ? array_values( $extra_fields ) : [];
        
        if ( 'publish' === $status ) {
            $status = $curretn_date > $end_date ? __( 'Past', 'eventin' ) : __( 'Upcoming', 'eventin' );
        }

        $post = get_post( $id );

        $event_data = [
            'id'                      => $id,
            'title'                   => get_the_title( $id ),
            'event_slug'              => $post->post_name,
            'description'             => do_blocks( $post->post_content ),
            'author'                  => $author,
            'categories'              => get_the_terms( $id, 'etn_category' ),
            'tags'                    => get_the_terms( $id, 'etn_tags' ),
            'status'                  => $status,
            'link'                    => get_permalink( $id ),
            'schedules'               => is_array( $schedules ) ? array_map('intval', $schedules ) : [],
            'organizer'               => 'single' === $organizer_type && $organizer ? $organizer : [],
            'organizer_type'          => $organizer_type,
            'organizer_group'         => 'group' === $organizer_type && is_array( $organizer_group ) ? array_map( 'intval', $organizer_group ) : [],
            'speaker'                 => 'single' === $speaker_type && $speaker ? $speaker : [],
            'speaker_type'            => $speaker_type,
            'speaker_group'           => 'group' === $speaker_type && is_array( $speaker_group ) ? array_map( 'intval', $speaker_group ) : [],
            'timezone'                => get_post_meta( $id, 'event_timezone', true ),
            'start_date'              => get_post_meta( $id, 'etn_start_date', true ),
            'end_date'                => get_post_meta( $id, 'etn_end_date', true ),
            'start_time'              => get_post_meta( $id, 'etn_start_time', true ),
            'end_time'                => get_post_meta( $id, 'etn_end_time', true ),
            'ticket_availability'     => get_post_meta( $id, 'etn_ticket_availability', true ),
            'event_logo'              => get_post_meta( $id, 'etn_event_logo', true ),
            'calendar_bg'             => get_post_meta( $id, 'etn_event_calendar_bg', true ),
            'calendar_text_color'     => get_post_meta( $id, 'etn_event_calendar_text_color', true ),
            'registration_deadline'   => get_post_meta( $id, 'etn_registration_deadline', true ),
            'attende_page_link'       => get_post_meta( $id, 'attende_page_link', true ),
            'zoom_event'              => get_post_meta( $id, 'etn_zoom_event', true ),
            'zoom_id'                 => get_post_meta( $id, 'etn_zoom_id', true ),
            'total_ticket'            => $event->get_total_ticket(),
            'sold_tickets'            => $event->get_total_sold_ticket(),
            'ticket_variations'       => get_post_meta( $id, 'etn_ticket_variations', true ),
            'event_socials'           => get_post_meta( $id, 'etn_event_socials', true ),
            'google_meet'             => get_post_meta( $id, 'etn_google_meet', true ),
            'google_meet_link'        => get_post_meta( $id, 'etn_google_meet_link', true ),
            'google_meet_description' => get_post_meta( $id, 'etn_google_meet_short_description', true ),
            'fluent_crm'              => get_post_meta( $id, 'fluent_crm', true ),
            'fluent_crm_webhook'      => get_post_meta( $id, 'fluent_crm_webhook', true ),
            'faq'                     => get_post_meta( $id, 'etn_event_faq', true ),
            'external_link'           => get_post_meta( $id, 'external_link', true ),
            'ticket_template'         => get_post_meta( $id, 'ticket_template', true ),
            'certificate_template'    => get_post_meta( $id, 'certificate_template', true ),
            'seat_plan'               => get_post_meta( $id, 'seat_plan', true ),
            'rsvp_settings'           => $rsvp_settings,
            'recurring_enabled'       => get_post_meta( $id, 'recurring_enabled', true ),
            'event_recurrence'        => get_post_meta( $id, 'etn_event_recurrence', true ),
            'event_banner'            => get_post_meta( $id, 'event_banner', true ),
            'event_layout'            => get_post_meta( $id, 'event_layout', true ),
            'is_clone'                => get_post_meta( $id, 'is_clone', true ),
            'extra_fields'            => $extra_fields ? $extra_fields : [],
            'category_names'          => $category_names,
            'meeting_link'            => $meeting_link,
            'event_type'              => get_post_meta( $id, 'event_type', true ),
            '_virtual'                => get_post_meta( $id, '_virtual', true ),
            'etn_event_logo_url'      => get_post_meta( $id, 'etn_event_logo_url', true ),
            'banner_bg_image_url'     => get_post_meta( $id, 'banner_bg_image_url', true ),
            'event_logo_id'           => get_post_meta( $id, 'event_logo_id', true ),
            'event_banner_id'         => get_post_meta( $id, 'event_banner_id', true ),
        ];

        $location_type = get_post_meta( $id, 'etn_event_location_type', true );
        $location      = get_post_meta( $id, 'etn_event_location', true );

        if ( 'new_location' == $location_type ) {
            $location = get_post_meta( $id, 'etn_event_location_list', true );
        }

        $event_data['location_type'] = $location_type;
        $event_data['location']      = $location;

        return $event_data;
    }
}
