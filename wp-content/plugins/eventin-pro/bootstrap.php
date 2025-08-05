<?php

namespace Etn_Pro;

defined('ABSPATH') || exit;

use Etn\Utils\Helper;
use Etn_Pro\Core\Woocommerce\Woocommerce_Deposit\Woocommerce_Deposit;
use Etn_Pro\Utils\Plugin_Installer;
use EventinPro\Assets\AdminAsset;
use EventinPro\Assets\FrontendAsset;
use Wpeventin_Pro;

final class Bootstrap
{

    private static $instance;
    private $failed;

    public function __construct()
    {
        // Autoloader::run();


    }

    public function package_type()
    {
        return 'pro';
    }

    public function marketplace()
    {
        return 'themewinter';
    }

    public function author_name()
    {
        return 'themewinter';
    }

    public function account_url()
    {
        return 'https://account.themewinter.com';
    }

    public function api_url()
    {
        return 'https://api.themewinter.com/public/';
    }

    public static function instance()
    {

        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Main function
     *
     * @return void
     */
    public function init()
    {
        // check if eventin installed and activated
        if (!did_action('eventin/after_load')) {
            $this->failed = true;
        }

        if ($this->failed == true) {
            return;
        }

        include_once ABSPATH . 'wp-admin/includes/plugin.php';

        // fire up elementor widgets
        Widgets\Manifest::instance()->init();

        add_action('elementor/frontend/before_enqueue_scripts', [$this, 'etn_elementor_js']);
        // advanced search filter
        add_action('etn_advanced_search', '\Etn_Pro\Utils\Helper::advanced_search_filter');

        //fire-up all woocommerce related hooks
        if (file_exists(ETN_PRO_DIR . '/core/woocommerce/hooks.php')) {
            include_once ETN_PRO_DIR . '/core/woocommerce/hooks.php';
        }

        //  fire up all actions.
        \Etn_Pro\Core\Event\Event::instance()->init();

        // call shortcode hooks.
        \Etn_Pro\Core\Shortcodes\Hooks::instance()->init();

        // call event single-page view hook.
        \Etn_Pro\Core\Event\Single_Page_View::instance()->init();

        // Initialize external script.
        \Etn_Pro\Core\Event\Script_Generator::instance()->init();

        // Webhook.
        \Etn_Pro\Core\Webhook\Webhook_Admin::instance()->init();
        \Etn_Pro\Core\Webhook\Hooks::instance()->init();

        //fire up edd update module
        Utils\Updater\Init::instance()->init();

        // active modules.
        \Etn_Pro\Base\Config::instance()->init();

        if (file_exists(ETN_PRO_DIR . "/core/speaker/views/template-hooks.php")) {
            include_once ETN_PRO_DIR . "/core/speaker/views/template-hooks.php";
        }

        if (file_exists(ETN_PRO_DIR . "/core/speaker/views/template-functions.php")) {
            include_once ETN_PRO_DIR . "/core/speaker/views/template-functions.php";
        }


        if (class_exists('WC_Deposits')) {
            Woocommerce_Deposit::instance()->init();
        }

        \Etn_Pro\Core\Attendee\Hooks::instance()->init();


        // call ajax submit.
        if (defined('DOING_AJAX') && DOING_AJAX) {
            // All ajax action.
            \Etn_Pro\Widgets\Event_Locations\Actions\Ajax_Action::instance()->init();
        }

        if (class_exists('Wpeventin')) {
            // $this->require_files();
            // Google Auth.
            new \EventinPro\Integrations\Google\Auth();
            new \EventinPro\Admin\Hooks();
            new \EventinPro\Admin\PaypalOrder();
            new \EventinPro\Template\GutenBlock();
        }

        // Assets Classes.
        new AdminAsset();
        new FrontendAsset();
    }
    
    public function etn_elementor_js()
    {
        wp_enqueue_script('etn-elementor-pro-inputs', ETN_PRO_ASSETS . 'js/elementor.js', ['elementor-frontend'], \Wpeventin_Pro::version(), true);
    }

}