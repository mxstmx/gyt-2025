<?php
/**
 * Manage admin assets
 */
namespace EventinPro\Assets;

use Wpeventin_Pro;

/**
 * Admin assets class
 */
class AdminAsset {

    /**
     * Constructor for AdminAsset
     *
     * @return  void
     */
    public function __construct() {
        add_filter( 'etn_admin_register_scripts', [ $this, 'register_scripts'] );
        add_filter( 'etn_admin_register_styles', [ $this, 'register_styles'] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
    }

    /**
     * Enqueue all assets
     *
     * @return  void
     */
    public function enqueue( $top ) {
        // Enqueue scripts.
        wp_enqueue_script( 'etn-admin-pro' );
        wp_enqueue_script( 'etn-pro-map-admin' );
        wp_enqueue_script( 'etn-location-admin' );
        wp_enqueue_script( 'etn-script-pro' );

        $base_url            = admin_url();
        $attendee_cpt        = new \Etn\Core\Attendee\Cpt();
        $attendee_endpoint   = $attendee_cpt->get_name();
        $action_url          = $base_url . $attendee_endpoint;
        $ticket_scanner_link = $action_url . "&etn_action=" . urlencode('ticket_scanner');
        $ticket_scanner_link = admin_url('/edit.php?post_type=etn-attendee&etn_action=ticket_scanner');

        // localize data
        $license_settings = \Etn_Pro\Utils\Helper::get_option("license");
        $enable_license   = (!empty($license_settings) ? "yes" : "no");
        $array            = [
            'ajax_url'            => admin_url('admin-ajax.php'),
            'license_module'      => $enable_license,
            'scanner_nonce'       => wp_create_nonce('scanner_nonce_value'),
            'ticket_scanner_link' => $ticket_scanner_link,
            'ticket_scanner_text' => esc_html__('Ticket Scanner', 'eventin-pro'),
            'required'            => esc_html__('Required', 'eventin-pro'),
            'optional'            => esc_html__('Optional', 'eventin-pro'),
            'warning_message'     => esc_html__('Please fill the label field', 'eventin-pro'),
            'warning_icon'        => '<svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.6574 2.34456C10.5339 -0.778916 5.46609 -0.778916 2.34261 2.34456C-0.78087 5.46804 -0.78087 10.5359 2.34261 13.6593C5.46609 16.7828 10.5339 16.7828 13.6574 13.6593C16.7843 10.5324 16.7809 5.46804 13.6574 2.34456ZM9.04522 11.4785C9.04522 12.0559 8.57913 12.522 8.00174 12.522C7.42435 12.522 6.95826 12.0559 6.95826 11.4785V7.30456C6.95826 6.72717 7.42435 6.26108 8.00174 6.26108C8.57913 6.26108 9.04522 6.72717 9.04522 7.30456V11.4785ZM7.98435 5.52021C7.38261 5.52021 6.98261 5.09587 6.99652 4.57065C6.98261 4.02108 7.38609 3.60717 7.99826 3.60717C8.61044 3.60717 9 4.02108 9.01391 4.57065C9.01044 5.09587 8.61044 5.52021 7.98435 5.52021Z" fill="#F42929"/></svg>',
            'certificate_nonce'   => wp_create_nonce('generate_attendee_certificate'),
            'site_url'            => site_url(),
        ];

        wp_localize_script('etn-admin-pro', 'etn_pro_admin_object', $array);
        

        // Enqueue styles.
        wp_enqueue_style( 'etn-public' );
        wp_enqueue_style( 'etn-style-pro' );
        wp_enqueue_style( 'etn-admin' );
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
            'etn-admin-pro' => [
                'src'       => ETN_PRO_ASSETS . 'js/etn-admin.js',
                'deps'      => ['jquery', 'wp-color-picker'],
                'in_footer' => false,
            ],
            'etn-pro-map-admin' => [
                'src'       => $this->map_url(),
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
            'etn-location-admin' => [
                'src'       => ETN_PRO_ASSETS . 'js/etn-location-admin.js',
                'deps'      => ['jquery'],
                'in_footer' => false,
            ],
            'etn-script-pro' => [
                'src'       => Wpeventin_Pro::plugin_url() . 'build/js/script.js',
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
            'etn-style-pro'     => [
                'src' => Wpeventin_Pro::plugin_url() . 'build/css/style.css',
            ],
            'etn-admin'     => [
                'src' => Wpeventin_Pro::plugin_url() . 'build/css/etn-admin.css',
            ],
        ];

        return array_merge( $styles, $new_styles );
    }

    /**
     * Get Map Url
     */
    protected function map_url() {
        $map_js         = 'https://maps.google.com/maps/api/js?libraries=places';
        $google_api_key = etn_get_option( 'google_api_key', 'AIzaSyBRiJpfKRV-hDFuQ6ynEAStJVO09g5Ecd4' );

        if ( $google_api_key ) {
            $map_js  = $map_js . '&key=' . $google_api_key;
            $map_js .= '&callback=Function.prototype';
        }

        return $map_js;
    }
}
