<?php
namespace Eventin\Ens\Core;

use Eventin\Ens\Assets\Enqueue;
use Eventin\Ens\Config;
use Eventin\Ens\Flow\FlowAPI;
use Eventin\Ens\Flow\FlowCPT;
use Eventin\Ens\Hook\ActionListener;

/**
 * Class SDK
 *
 * @package ENS
 *
 * @since 1.0.0
 */
class SDK {

    /**
     * @var SDK|null
     */
    protected static $instance = null;

    /**
     * Get SDK instance.
     *
     * @since 1.0.0
     *
     * @return SDK
     */
    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Pass config data before init.
     *
     * @since 1.0.0
     *
     * @param array $config
     *
     * @return SDK
     */
    public function setup( $config ) {
        foreach ( $config as $key => $value ) {
            Config::set( $key, $value );
        }

        return $this;
    }

    /**
     * Initialize SDK.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init() {
        ( new FlowCPT() )->register();
        ( new FlowAPI() )->init();
        ( new ActionListener() )->register();
        ( new Enqueue() )->init();
    }
}