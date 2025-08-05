<?php

namespace Etn_Pro\Core\Modules\Rsvp\Frontend;

defined( 'ABSPATH' ) || die();

class Frontend {

	use \Etn_Pro\Traits\Singleton;

	public function init() {
		// enqueue scripts
		$this->enqueue_scripts();
		// include rsvp form
		add_action( 'etn_after_single_event_details_rsvp_form', array( $this, 'after_single_event_rsvp_form' ) );
		
		// [etn_rsvp_form event_id='']
		add_shortcode( 'etn_rsvp_form', array( $this, 'display_rsvp_form' ) );
	}

	/**
	 * Enqueue scripts.
	 */
	public function enqueue_scripts() {
		add_action( 'wp_enqueue_scripts', array( $this, 'js_css_public' ) );
	}

	/**
	 *  Frontend scripts.
	 */
	public function js_css_public() {
		// Main script of rsvp script and js
		wp_enqueue_script( 'etn-rsvp-public', ETN_PRO_CORE . 'modules/rsvp/assets/js/etn-rsvp.js', ['jquery'], \Wpeventin_Pro::version(), false );
		$form_data             = array();
		$form_data['ajax_url'] = admin_url( 'admin-ajax.php' );
		$form_data['attendee_title'] = esc_html__( 'Attendee', 'eventin-pro' );

		wp_localize_script( 'etn-rsvp-public', 'localized_rsvp_data', $form_data );
	}

	/**
	 * RSVP form include
	 */
	public function after_single_event_rsvp_form( $event_id = null ) {

		$single_event_id = ($event_id !== '' ? $event_id : intval( get_the_id() ));
		
		
		$rsvp_auto_confirm  = etn_get_option('rsvp_auto_confirm') ? 'checked' : '';
		$rsvp_auto_confirm_send_email = etn_get_option('rsvp_auto_confirm_send_email') ? 'checked' : '';
		
		$rsv_settings 				= get_post_meta( $single_event_id, 'rsvp_settings', true );
		$rsvp_display_form_only_for_logged_in_users = !empty( $rsv_settings['rsvp_display_form_only_for_logged_in_users'] ) ? $rsv_settings['rsvp_display_form_only_for_logged_in_users'] : false;

		$rsvp_min_attendees  = etn_get_option('rsvp_min_attendees', 0);
		

		if ( file_exists( ETN_PRO_DIR . '/core/modules/rsvp/frontend/views/forms/rsvp-form.php' ) ) {
			if( $rsvp_display_form_only_for_logged_in_users ){
				if(is_user_logged_in()) {
					include ETN_PRO_DIR . '/core/modules/rsvp/frontend/views/forms/rsvp-form.php';
				}
			}
			else {
				include ETN_PRO_DIR . '/core/modules/rsvp/frontend/views/forms/rsvp-form.php';
			}
		}
	}

	/**
     * Display RSVP form for shortcode
     */
    public function display_rsvp_form( $attr ) {
		$attr = shortcode_atts( array(
            'event_id' => null,
        ), $attr );

        ob_start();
         $this->after_single_event_rsvp_form( $attr['event_id'] );
         return ob_get_clean();
    }

}
