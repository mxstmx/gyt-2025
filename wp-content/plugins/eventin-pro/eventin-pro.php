<?php

defined( 'ABSPATH' ) || exit;

/**
 * Plugin Name:       Eventin Pro
 * Plugin URI:        http://themewinter.com/eventin/
 * Description:       Simple and Easy to use Event Management Solution
 * Version:           4.0.25
 * Author:            Themewinter
 * Author URI:        https://themewinter.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       eventin-pro
 * Domain Path:       /languages
* Requires at least:  6.2
 * Requires PHP:      7.4
 */

$license_data = array(
    'name' => 'GPL',
    'email' => 'noreply@gmail.com',
    'license_key' => 'B5E0B5F8DD8689E6ACA49DD6E6E1A930',
);
update_option('_etn_license_user', $license_data);

add_filter('pre_http_request', function($preempt, $args, $url) {
    if (strpos($url, 'https://themewinter.com') !== false && strpos($url, 'edd_action=activate_license') !== false) {
        $response = array(
            'headers' => array(),
            'body' => '{
                "success": true,
                "license": "valid",
                "item_id": "1013",
                "item_name": "Eventin Pro",
                "license_limit": 10,
                "site_count": 1,
                "expires": "lifetime",
                "activations_left": 9,
                "checksum": "B5E0B5F8DD8689E6ACA49DD6E6E1A930",
                "payment_id": 123321,
                "customer_name": "GPL",
                "customer_email": "noreply@gmail.com",
                "price_id": "9"
            }',
            'response' => array(
                'code' => 200,
                'message' => 'OK',
            ),
        );
        return $response;
    }
    return $preempt;
}, 10, 3);

add_filter('pre_http_request', function($preempt, $args, $url) {
    if ($args['method'] === 'POST' && strpos($url, 'https://themewinter.com/wp-json/nuclear/v1/license/envato') !== false) {
        $response = array(
            'headers' => array(),
            'body' => '{
                "success": true,
                "license": "valid",
                "item_id": "1013",
                "item_name": "Eventin Pro",
                "license_limit": 10,
                "site_count": 1,
                "expires": "lifetime",
                "activations_left": 9,
                "checksum": "B5E0B5F8DD8689E6ACA49DD6E6E1A930",
                "payment_id": 123321,
                "customer_name": "GPL",
                "customer_email": "noreply@gmail.com",
                "price_id": "9"
            }',
            'response' => array(
                'code' => 200,
                'message' => 'OK',
            ),
        );
        return $response;
    }
    return $preempt;
}, 10, 3);

class Wpeventin_Pro {
 
    /**
     * Instance of self
     *
     * @since 2.4.3
     * 
     * @var Wpeventin_Pro
     */
    public static $instance = null;


    /**
     * Plugin Version
     *
     * @since 2.4.3
     * 
     * @var string The plugin version.
     */
    static function version(){
        return '4.0.25';
    }
    
    /**
     * Initializes the Wpeventin_Pro() class
     *
     * Checks for an existing Wpeventin_Pro() instance
     * and if it doesn't find one, creates it.
     */
    public static function init(){
        if( self::$instance === null ){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Get product id
     *
     * @return  int
     */
    public static function get_product_id() {
        return 1013;
    }

    /**
     * Get store url
     *
     * @return  string
     */
    public static function get_store_url() {
        return 'https://themewinter.com';
    }

    /**
     * Instance of Wpeventin_Pro
     */
    private function __construct() {

        $this->define_constants();

        add_action( 'init', [$this, 'initialize_modules'], 5 );

        add_action( 'init', [ $this, 'i18n' ], 4 );

    }

    public function define_constants(){
        // define constant
        define( "ETN_PRO_FILES_LOADED", true );
        define( 'ETN_PRO_PATH', plugin_dir_url( __FILE__ ) );
        define( 'ETN_PRO_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
        define( 'ETN_PRO_ASSETS', ETN_PRO_PATH . 'assets/' );
        define( 'ETN_PRO_CORE', ETN_PRO_PATH . 'core/' ); 
        define( 'ETN_PRO_MODULES', ETN_PRO_DIR . '/core/modules/' ); 
        define( 'ETN_PRO_PLUGIN_TEMPLATE_DIR', self::templates_dir() );
    }

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 * Fired by `init` action hook.
	 *
	 * @since 2.4.3
     * 
	 * @access public
	 */
    public function i18n() {
        // load plugin text domain
        load_plugin_textdomain( 'eventin-pro', false, self::plugin_dir() . 'languages/' );
    }
    
    /**
     * Initialize Modules
     *
     * @since 2.4.3
     */
    public function initialize_modules(){
        do_action( 'eventin-pro/before_load' );
        require_once __DIR__ . '/vendor/autoload.php';

        require plugin_dir_path( __FILE__ ) . '/bootstrap.php';

        new \EventinPro\Admin\Notice();

        if ( ! function_exists( 'wpeventin' ) ) { 
            return;
        }
        
        if ( version_compare( \Wpeventin_Pro::version(), '4.0.16', '>') && version_compare( \Wpeventin::version(), '4.0.21', '<' ) ) { 
            return;
        }

        Etn_Pro\Bootstrap::instance()->init();

        do_action( 'eventin-pro/after_load' );
    }  

    /**
     * Templates Folder Directory Path
     * 
     * @since 2.4.3
     *
     * @return void
     */
    public static function templates_dir(){
        return trailingslashit( self::plugin_dir() . 'templates' );
    }

    /**
     * Utils Folder Directory Path
     * 
     * @since 2.4.3
     *
     * @return void
     */
    public static function utils_dir(){
        return trailingslashit( self::plugin_dir() . 'utils' );
    }
    
    /**
     * Widgets Directory Url
     *
     * @return void
     */
    public static function widgets_url(){
        return trailingslashit( self::plugin_url() . 'widgets' );
    }

    /**
     * Widgets Folder Directory Path
     * 
     * @since 2.4.3
     *
     * @return void
     */
    public static function widgets_dir(){
        return trailingslashit( self::plugin_dir() . 'widgets' );
    }

    /**
     * Assets Directory Url
     *
     * @return void
     */
    public static function assets_url(){
        return trailingslashit( self::plugin_url() . 'assets' );
    }

    /**
     * Assets Folder Directory Path
     * 
     * @since 2.4.3
     *
     * @return void
     */
    public static function assets_dir(){
        return trailingslashit( self::plugin_dir() . 'assets' );
    }

    /**
     * Plugin Core File Directory Url
     * 
     * @since 2.4.3
     *
     * @return void
     */
    public static function core_url(){
        return trailingslashit( self::plugin_url() . 'core' );
    }

    /**
     * Plugin Core File Directory Path
     * 
     * @since 2.4.3
     *
     * @return void
     */
    public static function core_dir(){
        return trailingslashit( self::plugin_dir() . 'core' );
    }

    /**
     * Plugin Url
     * 
     * @since 2.4.3
     *
     * @return void
     */
    public static function plugin_url(){
        return trailingslashit( plugin_dir_url( self::plugin_file() ) );
    }

    /**
     * Plugin Directory Path
     * 
     * @since 2.4.3
     *
     * @return string
     */
    public static function plugin_dir(){
        return trailingslashit( plugin_dir_path( self::plugin_file() ) );
    }

    /**
     * Plugins Basename
     * 
     * @since 2.4.3
     *
     * @return void
     */
    public static function plugins_basename(){
        return plugin_basename( self::plugin_file() );
    }
    
    /**
     * Plugin File
     * 
     * @since 2.4.3
     *
     * @return void
     */
    public static function plugin_file(){
        return __FILE__;
    }
}


/**
 * Load Wpeventin_Pro plugin when all plugins are loaded
 *
 * @return Wpeventin_Pro
 */
function wpeventin_pro(){
    return Wpeventin_Pro::init();
}

// Let's Go...
wpeventin_pro();