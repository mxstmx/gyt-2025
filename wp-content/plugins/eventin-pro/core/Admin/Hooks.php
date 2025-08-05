<?php
/**
 * Manage admin hooks
 *
 * @package EventinPro/Admin
 */
namespace EventinPro\Admin;

use Etn_Pro\Core\Modules\Rsvp\Api\RsvpController;
use Eventin\Integrations\Google\GoogleMeet;
use EventinPro\AccessControl\Api\PermissionController;
use EventinPro\AccessControl\PermissionManager;
use EventinPro\Blocks\BlockService;
use EventinPro\Event\Api\EventController;
use EventinPro\Integrations\Google\GoogleCredential;
use EventinPro\Integrations\Paypal\PaypalPayment;
use EventinPro\Integrations\Stripe\StripePayment;
use EventinPro\License\Api\LicenseController;
use EventinPro\ShortCodes\Api\ShortCodeController;
use EventinPro\Template\Api\TemplateController;
use Wpeventin_Pro;

/**
 * Admin Hooks Class
 */
class Hooks {
    /**
     * Initialize
     *
     * @return  void
     */
    public function __construct() {
        add_filter( 'etn_admin_register_scripts', [$this, 'add_script_dependency'] );
        add_filter( 'etn_admin_register_styles', [$this, 'add_style_dependency'] );
        add_filter( 'eventin_online_meeting_platforms', [$this, 'add_google_meet'] );
        add_filter( 'eventin_settings', [$this, 'added_google_connection'] );
        add_filter( 'eventin_api_controllers', [ $this, 'add_api_controllers' ] );
        add_filter( 'eventin_payment_methods', [ $this, 'add_payment_methods' ] );
        add_filter( 'eventin_services', [ $this, 'add_services' ] );
        add_filter( 'eventin_menu', [ $this, 'add_menu' ], 10, 2 );
        add_action( 'template_redirect', [ $this, 'render_template_preview' ] );     
        add_filter( 'etn_admin_register_scripts', [$this, 'etn_frontend_submission_script'] );
    }

    /**
     * Add script dependency
     *
     * @return  array
     */
    public function add_script_dependency( $scripts ) {
        $version_4_script = ! empty( $scripts['etn-dashboard'] ) ? $scripts['etn-dashboard'] : [];

        if ( ! $version_4_script ) {
            return $scripts;
        }

        $pro_dependency              = ['etn-script-pro'];
        $version_4_script['deps']    = array_merge( $version_4_script['deps'], $pro_dependency );
        $scripts['etn-dashboard'] = $version_4_script;

        return $scripts;
    }

    /**
     * Adds the 'etn-frontend-submission' script to the Eventin admin script list.
     *
     * This function registers a custom script (`etn-frontend-submission`) that is required 
     * for frontend event submissions. 
     *
     * @param array $scripts The existing list of registered scripts.
     * @return array The modified list of scripts with 'etn-frontend-submission' added.
     */
    public function etn_frontend_submission_script( $scripts ) {
        // Define the frontend submission script
        $scripts['etn-frontend-submission'] = [
            'src'       => \Wpeventin_Pro::plugin_url() . 'build/js/script.js',
            'deps'      => ['jquery', 'wp-element', 'wp-i18n'],
            'in_footer' => true,
        ];
    
        return $scripts;
    }

    /**
     * Add style dependency
     *
     * @return  array
     */
    public function add_style_dependency( $styles ) {
        $version_4_style = ! empty( $styles['etn-dashboard'] ) ? $styles['etn-dashboard'] : [];

        if ( ! $version_4_style ) {
            return $styles;
        }

        $pro_dependency             = ['etn-style-pro'];
        $version_4_style['deps']    = array_merge( $version_4_style['deps'], $pro_dependency );
        $styles['etn-dashboard'] = $version_4_style;

        return $styles;
    }

    /**
     * Added google meet platform for online event management
     *
     * @param   array  $platforms
     *
     * @return  array
     */
    public function add_google_meet( $platforms ) {
        $platforms['google_meet'] = GoogleMeet::class;

        return $platforms;
    }

    /**
     * Added google meet connection settings
     *
     * @param   array  $settings  Setting
     *
     * @return  array $settings
     */
    public function added_google_connection( $settings ) {
        $settings['google_meet_connected'] = GoogleMeet::is_connected();
        $settings['google_meet_authorize_url'] = GoogleCredential::get_auth_url();

        return $settings;
    }

    /**
     * Add api controllers
     *
     * @param   array  $controllers
     *
     * @return  array
     */
    public function add_api_controllers( $controllers ) {
        $new_controllers = [
            EventController::class,
            RsvpController::class,
            PermissionController::class,
            LicenseController::class,
            TemplateController::class,
            ShortCodeController::class,
        ];

        return array_merge( $controllers, $new_controllers );
    }

    /**
     * Add payment methods
     *
     * @return array
     */
    public function add_payment_methods( $methods ) {
        $new_methods = [
            'stripe' => StripePayment::class,
            'paypal' => PaypalPayment::class,
        ];

        return array_merge( $methods, $new_methods );
    }

    /**
     * Add services
     *
     * @param   array  $services  Existing services
     *
     * @return  array
     */
    public function add_services( $services ) {
        $new_services = [
            PermissionManager::class,
            BlockService::class,
        ];

        return array_merge( $services, $new_services );
    }

    /**
     * Added menu
     *
     * @param   array  $menus      [$menus description]
     * @param   string  $menu_slug  [$menu_slug description]
     *
     * @return  array
     */
    public function add_menu( $menus, $menu_slug ) {
        $new_menus = [
            [
                'title'      => __( 'License', 'eventin' ),
                'capability' => 'etn_manage_license',
                'url'        => 'admin.php?page=' . $menu_slug . '#/license',
                'position'   => 99,
            ],
        ];

        return array_merge( $menus, $new_menus );
    }

    /**
     * Render preview template
     *
     * @return  void
     */
    public function render_template_preview() {
        $action      = ! empty( $_GET['action'] ) ? $_GET['action'] : '';
        $template_id = ! empty( $_GET['template_id'] ) ? $_GET['template_id'] : 0;

        if ( 'etn-preview-template' !== $action ) {
            return;
        }

        include_once Wpeventin_Pro::core_dir() . 'Template/TemplatePreview.php';

        exit;
    }
}