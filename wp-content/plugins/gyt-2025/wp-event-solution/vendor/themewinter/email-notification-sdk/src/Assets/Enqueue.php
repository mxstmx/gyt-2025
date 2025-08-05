<?php

namespace Eventin\Ens\Assets;

use Eventin\Ens\Config;

/**
 * Class Enqueue
 *
 * @package ENS
 *
 * @since 1.0.0
 */
class Enqueue {

    /**
     * Initializing enqueue assets
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init() {
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_assets'] );
    }

    /**
     * Enqueue admin scripts and pass localized data
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function enqueue_assets() {
        $admin_script_handler = Config::get( 'admin_script_handler' );
        $plugin_slug          = Config::get( 'plugin_slug' );

        $general_prefix = Config::get( 'general_prefix' );

        wp_localize_script( $admin_script_handler, $general_prefix . '_ens_data', [
            'nonce'       => wp_create_nonce( 'wp_rest' ),
            'api_version' => 'v1',
            'plugin_slug' => $plugin_slug,
            'base_url'    => site_url(),
            'triggers'    => apply_filters( 'ens_eventin_available_actions', [] )
        ] );
    }
}
