<?php
/**
 * Manage frontend assets
 */
namespace EventinPro\Assets;

use Wpeventin_Pro;

/**
 * Frontend assets class
 */
class FrontendAsset {

    /**
     * Constructor for FrontendAsset
     *
     * @return  void
     */
    public function __construct() {
        add_filter( 'etn_frontend_register_scripts', [ $this, 'register_scripts'] );
        add_filter( 'etn_frontend_register_styles', [ $this, 'register_styles'] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
    }

    /**
     * Enqueue all assets
     *
     * @return  void
     */
    public function enqueue( $top ) {
        // Enqueue scripts.
        wp_enqueue_script('jquery');
        wp_enqueue_script( 'swiper-bundle-min' );
        wp_enqueue_script( 'jquery-countdown' );
        wp_enqueue_script( 'etn-qr-code' );
        wp_enqueue_script( 'etn-qr-code-scanner' );
        wp_enqueue_script( 'etn-qr-code-custom' );
        wp_enqueue_script( 'etn-public-pro' );
        wp_enqueue_script( 'etn-map' );
        wp_enqueue_script( 'etn-location' );
        // wp_enqueue_script( 'etn-frontend-submission' );

        // Enqueue styles.
        if ( is_rtl() ) {
            wp_enqueue_style( 'etn-rtl-pro' );
        }

        // wp_enqueue_style( 'etn-frontend-submission-style' );
        // wp_enqueue_style( 'etn-frontend-submission' );
        wp_enqueue_style( 'swiper-bundle-min' );
        wp_enqueue_style( 'jquery-countdown' );
        wp_enqueue_style( 'etn-public' );



        $array = [
            'ajax_url'                     => admin_url('admin-ajax.php'),
            'location_map_nonce'           => wp_create_nonce('location_map_nonce'),
            'scanner_nonce'                => wp_create_nonce('scanner_nonce_value'),
            'attendee_page_link'           => admin_url('/edit.php?post_type=etn-attendee'),
            'scanner_common_msg'           => esc_html__('Something went wrong! Please try again.', 'eventin-pro'),
            // 'attendee_verification_style'  => $attendee_verification_style,
            'location_icon'                => \Wpeventin_Pro::assets_url() . 'images/location-icon.png',
            // 'attendee_registration_option' => $attendee_registration,
            'event_expired_message'        => esc_html__('This event has been expired.', 'eventin-pro'),
            'is_enable_attendee_registration' => etn_get_option('attendee_registration') ?: false,
        ];

        wp_localize_script('etn-public-pro', 'etn_pro_public_object', $array);
        wp_localize_script('etn-qr-code-custom', 'etn_pro_public_object', $array);


        /**
         * Localize Frontend Submission strings
         */
        $etn_translate_text = [
            'cat_add_new'                   => esc_html__('Add New Category', 'eventin-pro'),
            'cat_name'                      => esc_html__('Category Name', 'eventin-pro'),
            'cat_search'                    => esc_html__('Search Category', 'eventin-pro'),
            'cat_name_empty_msg'            => esc_html__('Category name should not empty!', 'eventin-pro'),
            'cat_desc'                      => esc_html__('Category Description', 'eventin-pro'),
            'cat_create'                    => esc_html__('Create Category', 'eventin-pro'),
            'cat_update'                    => esc_html__('Update Category', 'eventin-pro'),
            'edit'                          => esc_html__('Edit', 'eventin-pro'),
            'preview'                       => esc_html__('Preview', 'eventin-pro'),
            'delete'                        => esc_html__('Delete', 'eventin-pro'),
            'delete_not'                    => esc_html__('Delete!', 'eventin-pro'),
            'deleted'                       => esc_html__('Deleted!', 'eventin-pro'),
            'error'                         => esc_html__('Something went wrong!', 'eventin-pro'),
            'back_to_category'              => esc_html__('Back to Category', 'eventin-pro'),
            'spinner_tip'                   => esc_html__('Loading...', 'eventin-pro'),
            'spinner_msg'                   => esc_html__('Please Wait.', 'eventin-pro'),
            'spinner_desc'                  => esc_html__('Loader will vanish after all data load.', 'eventin-pro'),
            'cat_result_title'              => esc_html__('You haven\'t added any categories yet.', 'eventin-pro'),
            'event_info'                    => esc_html__('Event Info', 'eventin-pro'),
            'add_new_event'                 => esc_html__('Add new event', 'eventin-pro'),
            'add_new_event_placeholder'     => esc_html__('Name your event', 'eventin-pro'),
            'event_title'                   => esc_html__('Event title', 'eventin-pro'),
            'event_title_empty_msg'         => esc_html__('Post title and content should not empty!', 'eventin-pro'),
            'event_content'                 => esc_html__('Event content', 'eventin-pro'),
            'attendee_list'                 => esc_html__('Attendee list', 'eventin-pro'),
            'back_to_events'                => esc_html__('Back to Events', 'eventin-pro'),
            'ticket_scanner'                => esc_html__('Ticket Scanner', 'eventin-pro'),
            'event_tooltip'                 => esc_html__('This event doesn\'t have any attendee', 'eventin-pro'),
            'event_result_title'            => esc_html__('You haven\'t added any events yet.', 'eventin-pro'),
            'post_content_error'            => esc_html__('Shouldn\'t empty!', 'eventin-pro'),
            'upload_event_logo'             => esc_html__('Upload event logo:', 'eventin-pro'),
            'upload_feature_img'            => esc_html__('Upload feature image:', 'eventin-pro'),
            'upload_banner_img'             => esc_html__('Upload banner image:', 'eventin-pro'),
            'add_category'                  => esc_html__('Add category:', 'eventin-pro'),
            'search_category'               => esc_html__('Search category', 'eventin-pro'),
            'add_tags'                      => esc_html__('Add tags:', 'eventin-pro'),
            'search_tags'                   => esc_html__('Search tags', 'eventin-pro'),
            'add_social_links'              => esc_html__('Add social links', 'eventin-pro'),
            'add'                           => esc_html__('Add', 'eventin-pro'),
            'success_title'                 => esc_html__('Event Created.', 'eventin-pro'),
            'success_msg'                   => esc_html__('Your event has been created. Take next action from the below button.', 'eventin-pro'),
            'error_save_title'              => esc_html__('Event couldn\'t saved.', 'eventin-pro'),
            'error_save_desc'               => esc_html__('Your event is not saved successfully.', 'eventin-pro'),
            'start_and_end_date'            => esc_html__('Start and end date', 'eventin-pro'),
            'start_and_end_time'            => esc_html__('Start and end time', 'eventin-pro'),
            'location_type'                 => esc_html__('Location Type', 'eventin-pro'),
            'existing_location'             => esc_html__('Existing Locations', 'eventin-pro'),
            'online_location'             => esc_html__('Online Locations', 'eventin-pro'),
            'online_location_placeholder'             => esc_html__('Select Online Location', 'eventin-pro'),
            'select_location'               => esc_html__('Select Locations', 'eventin-pro'),
            'event_location'                => esc_html__('Event location', 'eventin-pro'),
            'full_address'                  => esc_html__('Full Address', 'eventin-pro'),
            'offline_location'            => esc_html__('Offline Location', 'eventin-pro'),
            'timezone'                      => esc_html__('Timezone', 'eventin-pro'),
            'schedule'                      => esc_html__('Schedule', 'eventin-pro'),
            'search_schedule'               => esc_html__('Search Schedule', 'eventin-pro'),
            'add_new_tag'                   => esc_html__('Add New Tag', 'eventin-pro'),
            'tag_name'                      => esc_html__('Tag Name', 'eventin-pro'),
            'tag_desc'                      => esc_html__('Tag Description', 'eventin-pro'),
            'create_tag'                    => esc_html__('Create Tag', 'eventin-pro'),
            'update_tag'                    => esc_html__('Update Tag', 'eventin-pro'),
            'tag_result_title'              => esc_html__('Oops! You haven\'t added any tags yet.', 'eventin-pro'),
            'back_to_tags'                  => esc_html__('Back to Tags', 'eventin-pro'),
            'tag_name_empty_msg'            => esc_html__('Tag name should not empty!', 'eventin-pro'),
            'create_another'                => esc_html__('Create another', 'eventin-pro'),
            'add_new_location'              => esc_html__('Add New Location', 'eventin-pro'),
            'location_name'                 => esc_html__('Location Name', 'eventin-pro'),
            'location_desc'                 => esc_html__('Location Description', 'eventin-pro'),
            'back_to_location'              => esc_html__('Back to Location', 'eventin-pro'),
            'location_address'              => esc_html__('Location Address', 'eventin-pro'),
            'email'                         => esc_html__('Email', 'eventin-pro'),
            'valid_email'                   => esc_html__('Please enter a valid E-mail', 'eventin-pro'),
            'latitude'                      => esc_html__('Latitude', 'eventin-pro'),
            'longitude'                     => esc_html__('Longitude', 'eventin-pro'),
            'update_location'               => esc_html__('Update Location', 'eventin-pro'),
            'create_location'               => esc_html__('Create Location', 'eventin-pro'),
            'location_name_empty_msg'       => esc_html__('Location name should not empty!', 'eventin-pro'),
            'speaker_label'                 => esc_html__('Speaker Group', 'eventin-pro'),
            'speaker_empty_msg'             => esc_html__('Ops! You haven\'t added any speaker yet', 'eventin-pro'),
            'add_new_speaker'               => esc_html__('Add new speaker', 'eventin-pro'),
            'back_to_speaker'               => esc_html__('Back to speakers', 'eventin-pro'),
            'speaker_name_empty_msg'        => esc_html__('Speaker name should not empty!', 'eventin-pro'),
            'speaker_name'                  => esc_html__('Name', 'eventin-pro'),
            'speaker_designation'           => esc_html__('Designation', 'eventin-pro'),
            'speaker_desig_placeholder'     => esc_html__('Enter Designation', 'eventin-pro'),
            'speaker_profile_img'           => esc_html__('Speaker profile image:', 'eventin-pro'),
            'company_logo'                  => esc_html__('Company logo:', 'eventin-pro'),
            'speaker_summary'               => esc_html__('Summary', 'eventin-pro'),
            'create_speaker'                => esc_html__('Create Speaker', 'eventin-pro'),
            'update_speaker'                => esc_html__('Update Speaker', 'eventin-pro'),
            'speaker_cat'                   => esc_html__('Category', 'eventin-pro'),
            'speaker_cat_placeholder'       => esc_html__('Select Category', 'eventin-pro'),
            'organizer_label'               => esc_html__('Organizer Group', 'eventin-pro'),
            'add_more_organizer'            => esc_html__('Add More Organizer', 'eventin-pro'),
            'select_organizer'              => esc_html__('Select organizer', 'eventin-pro'),
            'display_name_of_the_day'       => esc_html__('Display name of the day', 'eventin-pro'),
            'program_title'                 => esc_html__('Program Title', 'eventin-pro'),
            'topic'                         => esc_html__('Topic', 'eventin-pro'),
            'topic_details'                 => esc_html__('Topic Details', 'eventin-pro'),
            'start_time'                    => esc_html__('Start Time', 'eventin-pro'),
            'end_time'                      => esc_html__('End Time', 'eventin-pro'),
            'add_new_schedule'              => esc_html__('Add New Schedule', 'eventin-pro'),
            'schedule_title'                => esc_html__('Schedule Title', 'eventin-pro'),
            'create_schedule'               => esc_html__('Create Schedule', 'eventin-pro'),
            'update_schedule'               => esc_html__('Update Schedule', 'eventin-pro'),
            'schedule_updated_title'        => esc_html__('Schedule Updated Successfully', 'eventin-pro'),
            'schedule_updated_message'      => esc_html__('Your schedule has been updated successfully.', 'eventin-pro'),
            'schedule_created_title'        => esc_html__('Schedule Created Successfully', 'eventin-pro'),
            'schedule_created_message'      => esc_html__('Your schedule has been created successfully.', 'eventin-pro'),
            'schedule_delete_message'       => esc_html__('Are you sure you want to delete this schedule?', 'eventin-pro'),
            'select_speaker_placeholder'    => esc_html__('Please select speakers', 'eventin-pro'),
            'add_new_topic'                 => esc_html__('Add New Topic', 'eventin-pro'),
            'back_to_schedule'              => esc_html__('Back to Schedule', 'eventin-pro'),
            'schedule_title_error'          => esc_html__('Please input schedule title!', 'eventin-pro'),
            'schedule_empty_msg'            => esc_html__('You have not added any schedule yet!', 'eventin-pro'),
            'date'                          => esc_html__('Date', 'eventin-pro'),
            'name_of_the_day'               => esc_html__('Day of the Week', 'eventin-pro'),
            'schedule_topic'                => esc_html__('Schedule Topic', 'eventin-pro'),
            'select_speaker'                => esc_html__('Select Speaker', 'eventin-pro'),
            'attendee_name'                 => esc_html__('Attendee name', 'eventin-pro'),
            'edit_attendee'                 => esc_html__('Edit attendee', 'eventin-pro'),
            'delete_attendee'               => esc_html__('Delete attendee', 'eventin-pro'),
            'attendee_email'                => esc_html__('Attendee e-mail', 'eventin-pro'),
            'attendee_update_details'       => esc_html__('Update details', 'eventin-pro'),
            'ticket_details'                => esc_html__('Ticket Details', 'eventin-pro'),
            'limited_ticket'                => esc_html__('Limited tickets', 'eventin-pro'),
            'limited_ticket_description'    => esc_html__('Enable limited ticket. Set ticket stock from ticket variation.', 'eventin-pro'),
            'ticket_variation'              => esc_html__('Ticket variation', 'eventin-pro'),
            'ticket_name'                   => esc_html__('Ticket Name:', 'eventin-pro'),
            'ticket_price'                  => esc_html__('Ticket Price:', 'eventin-pro'),
            'no_of_ticket'                  => esc_html__('No. of Tickets:', 'eventin-pro'),
            'min_purchase_qty'              => esc_html__('Minimum Purchase Qty:', 'eventin-pro'),
            'max_purchase_qty'              => esc_html__('Maximum Purchase Qty:', 'eventin-pro'),
            'ticket_id_label'               => esc_html__('Ticket ID', 'eventin-pro'),
            'ticket_status'                 => esc_html__('Ticket status', 'eventin-pro'),
            'used'                          => esc_html__('Used', 'eventin-pro'),
            'unused'                        => esc_html__('Unused', 'eventin-pro'),
            'payment_status'                => esc_html__('Payment status', 'eventin-pro'),
            'attendees_list'                => esc_html__('Attendees List', 'eventin-pro'),
            'empty_attendees_msg'           => esc_html__('This event doesn\'t have any attendee', 'eventin-pro'),
            'general_info'                  => esc_html__('General Info', 'eventin-pro'),
            'input_missing'                 => esc_html__('Input missing!', 'eventin-pro'),
            "confirm_delete"                => esc_html__('Are you sure you want to delete this item?', 'eventin-pro'),
            'name'                          => esc_html__('Name', 'eventin-pro'),
            'desc'                          => esc_html__('Description', 'eventin-pro'),
            'create'                        => esc_html__('Create', 'eventin-pro'),
            'previous'                      => esc_html__('Previous', 'eventin-pro'),
            'next'                          => esc_html__('Next', 'eventin-pro'),
            'update'                        => esc_html__('Update', 'eventin-pro'),
            'updated'                       => esc_html__('Updated', 'eventin-pro'),
            'success'                       => esc_html__('Success', 'eventin-pro'),
            'failed'                        => esc_html__('Failed', 'eventin-pro'),
            'cancel'                        => esc_html__('Cancel', 'eventin-pro'),
            'submit'                        => esc_html__('Submit', 'eventin-pro'),
            'action'                        => esc_html__('Action', 'eventin-pro'),
            'refresh'                       => esc_html__('Refresh', 'eventin-pro'),
            'select_all'                    => esc_html__('Select All', 'eventin-pro'),
            'already_exist'                 => esc_html__('Already exists', 'eventin-pro'),
            'virtual_product'               => esc_html__('Virtual Product', 'eventin-pro'),
            'virtual_product_description'   => esc_html__('Register event as WooCommerce virtual product and let WooCommerce handle it\'s behaviour.', 'eventin-pro'),
            'add_variation'                 => esc_html__('Add Variation', 'eventin-pro'),
            'event_external_link'           => esc_html__('Event external link', 'eventin-pro'),
            'google_meet_link'              => esc_html__('Google meet link', 'eventin-pro'),
            'google_meet_description'       => esc_html__('Google Meet Description', 'eventin-pro'),
            'enable_google_meet'            => esc_html__('Enable Google Meet', 'eventin-pro'),
            'certificate_title'             => esc_html__('Select Certificate Template', 'eventin-pro'),
            'certificate_desc'              => esc_html__('Select the page template which will be used as event certificate.', 'eventin-pro'),
            'item'                          => esc_html__('Item', 'eventin-pro'),
            'faq_title'                     => esc_html__('Event FAQ\'s', 'eventin-pro'),
            'faq_item_title'                => esc_html__('Faq Title', 'eventin-pro'),
            'faq_item_content'              => esc_html__('Faq Content', 'eventin-pro'),
            'events'                        => esc_html__('Events', 'eventin-pro'),
            'event_categories'              => esc_html__('Event Categories ', 'eventin-pro'),
            'event_tags'                    => esc_html__('Event Tags ', 'eventin-pro'),
            'event_locations'               => esc_html__('Event Locations', 'eventin-pro'),
            'speakers'                      => esc_html__('Speakers', 'eventin-pro'),
            'schedules'                     => esc_html__('Schedules', 'eventin-pro'),
            'upload'                        => esc_html__('Upload', 'eventin-pro'),
            'avatar_image'                  => esc_html__('Avatar Image', 'eventin-pro'),
            'search_sand_select'            => esc_html__('Search and select', 'eventin-pro'),
            'no_data_found'                 => esc_html__('No data found', 'eventin-pro'),
            'yearly_months_day'             => esc_html__('Yearly Month\'s Day', 'eventin-pro'),
            'select_month'                  => esc_html__('Select month', 'eventin-pro'),
            'preview_text'                  => esc_html__('Preview will appear here', 'eventin-pro'),
            'icons'                         => esc_html__('Icons', 'eventin-pro'),
            'close'                         => esc_html__('Close', 'eventin-pro'),
            'recurring_thumbnail'           => esc_html__('Do want to hide Recurring event thumbnail?', 'eventin-pro'),
            'recurring_event'               => esc_html__('Recurring Event', 'eventin-pro'),
            'registration_deadline'         => esc_html__('Registration Deadline', 'eventin-pro'),
            'step_one'                      => esc_html__('Step 1', 'eventin-pro'),
            'step_two'                      => esc_html__('Step 2', 'eventin-pro'),
            'step_three'                    => esc_html__('Step 3', 'eventin-pro'),
            'welcome_to_eventin'            => esc_html__('Welcome to Eventin', 'eventin-pro'),
            'subscriptions'                 => esc_html__('Subscription', 'eventin-pro'),
            'step'                          => esc_html__('step', 'eventin-pro'),
            'of'                            => esc_html__('of', 'eventin-pro'),
            'event_will_repeat'             => esc_html__('Event will repeat', 'eventin-pro'),
            'recurrence_interval'           => esc_html__('Recurrence Interval', 'eventin-pro'),
            'daily'                         => esc_html__('Daily', 'eventin-pro'),
            'weekly'                        => esc_html__('Weekly', 'eventin-pro'),
            'monthly'                       => esc_html__('Monthly', 'eventin-pro'),
            'monthly_advanced'              => esc_html__('Monthly (advanced)', 'eventin-pro'),
            'yearly'                        => esc_html__('Yearly', 'eventin-pro'),
            'ends'                          => esc_html__('Ends', 'eventin-pro'),
            'recurrence_duration'           => esc_html__('Each recurrence duration for Day(s)', 'eventin-pro'),
            'on_event_end_date'             => esc_html__('On event end date', 'eventin-pro'),
            'recurrence_validation_message' => esc_html__('You must provide event start and end date for enabling recurrence', 'eventin-pro'),
            'icon_media_name'               => esc_html__('Icon Name', 'eventin-pro'),
            'social_title'                  => esc_html__('Social Title', 'eventin-pro'),
            'social_url'                    => esc_html__('Social URL', 'eventin-pro'),
            'select_schedule_type'          => esc_html__('Select Schedule Type', 'eventin-pro'),
            'schedule_with_speaker'         => esc_html__('Schedule With Speaker', 'eventin-pro'),
            'schedule_without_speaker'      => esc_html__('Schedule Without Speaker', 'eventin-pro'),
            'start_date'                    => esc_html__('Start Date', 'eventin-pro'),
            'end_date'                      => esc_html__('End Date', 'eventin-pro'),
            'select_deadline'               => esc_html__('Select deadline', 'eventin-pro'),
            'select_with_dash'              => esc_html__('-- Select --', 'eventin-pro'),
            'add_question'                  => esc_html__('Add Question', 'eventin-pro'),
            'please_select_a_date'          => esc_html__('Please select a date!', 'eventin-pro'),
            'select_date'                   => esc_html__('Select date', 'eventin-pro'),
            'recurring_parent'              => esc_html__('Recurring Parent', 'eventin-pro'),
            'recurring_child'               => esc_html__('Recurring Child', 'eventin-pro'),
            'ticket_sale_dates'             => esc_html__('Ticket Sale Start and End Date', 'eventin-pro'),
            'ticket_sale_times'             => esc_html__('Ticket Sale Start and End Time', 'eventin-pro'),
            'google_meet'                   => esc_html__('Google Meet', 'eventin-pro'),
            'zoom'                          => esc_html__('Zoom', 'eventin-pro'),
            'custom_url'                    => esc_html__('Custom URL', 'eventin-pro'),
            'custom_url_placeholder'        => esc_html__('Please enter your custom url', 'eventin-pro'),
            'configure_zoom_meet'           => esc_html__("Click Here to Configure Google Meet and Zoom", 'eventin-pro'),
            'google_meet_notice'            => esc_html__("Click Here to Configure Google Meet", 'eventin-pro'),
            'zoom_notice'                   => esc_html__("Click Here to Configure Zoom", 'eventin-pro'),
            'use_google_meet'               => esc_html__("Use Google Meet for this Event", 'eventin-pro'),
            'meet_not_connected'            => esc_html__("Google Meet is not connected", 'eventin-pro'),
            'use_zoom'                      => esc_html__("Click Here to Configure Zoom", 'eventin-pro'),
            'zoom_not_connected'            => esc_html__("Click Here to Configure Zoom", 'eventin-pro'),

        ];
        wp_localize_script( 'etn-frontend-submission', 'etn_translate_object', $etn_translate_text );
    }

    /**
     * Register frontend scripts
     *
     * @param   array  $scripts 
     *
     * @return  array
     */
    public function register_scripts( $scripts ) {
        $new_scripts = [
            'swiper-bundle-min' => [
                'src'       => ETN_PRO_ASSETS . 'js/swiper-bundle.min.js',
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
            'jquery-countdown' => [
                'src'       => ETN_PRO_ASSETS . 'js/jquery.countdown.min.js',
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
            'etn-qr-code' => [
                'src'       => ETN_PRO_ASSETS . 'js/qr-code.js',
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
            'etn-qr-code-scanner' => [
                'src'       => ETN_PRO_ASSETS . 'js/qr-scanner.umd.min.js',
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
            'etn-qr-code-custom' => [
                'src'       => ETN_PRO_ASSETS . 'js/qr-code-custom.js',
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
            'etn-public-pro' => [
                'src'       => ETN_PRO_ASSETS . 'js/etn-public.js',
                'deps'      => ['jquery', 'etn-packages'],
                'in_footer' => false,
            ],
            'etn-map' => [
                'src'       => $this->map_url(),
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
            'etn-location' => [
                'src'       => ETN_PRO_ASSETS . 'js/etn-location.js',
                'deps'      => ['jquery', 'etn-map'],
                'in_footer' => false,
            ],
            'etn-frontend-submission' => [
                'src'       => Wpeventin_Pro::plugin_url() . 'build/js/script.js',
                'deps'      => [
                    'jquery',
                    'wp-element',
                    'wp-i18n',
                ],
                'in_footer' => false,
            ],
        ];

        return array_merge( $scripts, $new_scripts );
    }

    
    /**
     * Register styles
     *
     * @param   array  $styles  Frontend styles
     *
     * @return  array
     */
    public function register_styles( $styles ) {
        $new_styles = [
            'etn-rtl-pro'     => [
                'src' => ETN_PRO_ASSETS . 'css/rtl.css',
            ],
            'etn-frontend-submission-style'     => [
                'src'   => Wpeventin_Pro::plugin_url() . 'build/css/script.css',
            ],
            'etn-frontend-submission'     => [
                'src'   => Wpeventin_Pro::plugin_url() . 'build/css/style.css',
                'deps'  => ['wp-edit-blocks'],
            ],
            'swiper-bundle-min'     => [
                'src'   => ETN_PRO_ASSETS . 'css/swiper-bundle.min.css',
            ],
            'jquery-countdown'     => [
                'src'   => ETN_PRO_ASSETS . 'css/jquery.countdown.css',
            ],
            'etn-public'     => [
                'src'   => Wpeventin_Pro::plugin_url() . 'build/css/etn-public.css',
            ],
        ];

        return array_merge( $styles, $new_styles );
    }

    /**
     * Get Map Url
     */
    protected function map_url() {
        $map_js         = 'https://maps.googleapis.com/maps/api/js?libraries=places';
        $google_api_key = etn_get_option( 'google_api_key', 'AIzaSyBRiJpfKRV-hDFuQ6ynEAStJVO09g5Ecd4' );

        if ( $google_api_key ) {
            $map_js  = $map_js . '&key=' . $google_api_key;
            $map_js .= '&callback=Function.prototype';
        }

        return $map_js;
    }
}