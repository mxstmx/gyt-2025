<?php
namespace Eventin\Ens\Hook;

use Eventin\Ens\Config;
use Eventin\Ens\Flow\FlowManager;

class ActionListener {

    protected $flow_manager;

    /**
     * ActionListener constructor.
     *
     * @since 1.0.0
     */
    public function __construct() {
        $this->flow_manager = new FlowManager();
    }

    /**
     * Register the action listener.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function register() {
        $general_prefix   = Config::get( 'general_prefix' );
        $sub_menu_filter_hook = Config::get( 'sub_menu_filter_hook' );

        add_filter( $sub_menu_filter_hook, [$this, 'ens_add_sub_menu'], 10, 1 );

        add_action( 'global_notification_hook', [$this, 'handle_action'], 10, 2 );

        add_action( $general_prefix . '_resume_flow_after_delay', function ( $flow_id, $resume_time ) {
            $this->flow_manager->resume_flow_callback( $flow_id, $resume_time );
        }, 10, 2 );
    }

    /**
     * Handle the action.
     *
     * @since 1.0.0
     *
     * @param string $action_name The name of the action.
     * @param array  $data        The data associated with the action.
     *
     * @return void
     */
    public function handle_action( $action_name, $data ) {
        $this->flow_manager->handle( $action_name, $data );
    }

    /**
     * Register the sub menu.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function ens_add_sub_menu( $data ) {
        $sub_menu_details = Config::get( 'sub_menu_details' );

        if ( !empty( $sub_menu_details ) && is_array( $sub_menu_details ) ) {
            array_push( $data, $sub_menu_details );
        }

        return $data;
    }

    /**
     * Render the flow manager page.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function ens_flow_manager_page() {
        $general_prefix = Config::get( 'general_prefix' );
        ?>
<div id="<?php echo $general_prefix; ?>_dashboard"></div>
<?php
}
}