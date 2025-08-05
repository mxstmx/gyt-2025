<?php
/**
 * Register guten blocks
 * 
 * @package EventinPro
 */
namespace EventinPro\Template;

use Wpeventin_Pro;

/**
 * Gutenblock class
 */
class GutenBlock {
    /**
     * Constructor for gutenblock class
     *
     * @return  void
     */
    public function __construct() {
        add_action( 'init', [ $this, 'register_blocks' ] );
        add_action( 'enqueue_block_assets', [ $this, 'blocks_assets' ] );
    }

    /**
     * Register all blocks
     *
     * @return void
     */
    public function register_blocks() {
        $blocks = $this->get_blocks();

        if ( ! $blocks ) {
            return;
        }

        foreach( $blocks as $block ) {
            register_block_type( $block['name'], $block['attr']);
        }
    }

    /**
     * Register block assets
     *
     * @return  void
     */
    public function blocks_assets() {
        wp_enqueue_script('etn-blocks', \Wpeventin_Pro::plugin_url() . 'build/js/guten-blocks.js', [ 'wp-blocks', 'wp-element', 'wp-editor',"etn-dashboard" ], Wpeventin_Pro::version(), true);
        wp_enqueue_style('etn-blocks-style', \Wpeventin_Pro::plugin_url() . 'build/css/guten-blocks.css', [], \Wpeventin_Pro::version(), 'all');
        wp_enqueue_style('etn-blocks-style-custom', \Wpeventin_Pro::plugin_url() . 'build/css/etn-blocks-style.css', [], \Wpeventin_Pro::version(), 'all');

        wp_register_script('etn-qr-code-block', ETN_PRO_ASSETS . 'js/qr-code.js', array('jquery'), \Wpeventin_Pro::version(), false);
        wp_register_script('etn-qr-code-custom-block', ETN_PRO_ASSETS . 'js/qr-code-custom.js', array('jquery', 'etn-qr-code-block'), \Wpeventin_Pro::version(), false);

        wp_set_script_translations( 'etn-blocks', 'eventin-pro' );
    }

    /**
     * Get blocks
     *
     * @return  array
     */
    public function get_blocks() {
        $blocks = [
            [
                'name'  => 'eventin-pro/template-container',
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                    'editor_style' => 'etn-blocks-style',
                ]
            ],
            [
                'name'  => "eventin-pro/template-heading",
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                ]
            ],
            [
                'name'  => 'eventin-pro/diamond-separator',
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                    'editor_style' => 'etn-blocks-style',
                ]
            ],
            [
                'name'  => "eventin-pro/attendee-info",
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                    'editor_style' => 'etn-blocks-style',
                ]
            ],
            [
                'name'  => "eventin-pro/event-info",
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                    'editor_style' => 'etn-blocks-style',
                ]
            ],
            [
                'name'  => "eventin-pro/ticket-info",
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                    'editor_style' => 'etn-blocks-style',
                ]
            ],
            [
                'name'  => "eventin-pro/container",
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                    'editor_style' => ['etn-blocks-style',"etn-blocks-style-custom"],
                ]
            ],
            [
                'name'  => "eventin-pro/ticket-qrcode",
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                    'editor_style' => ['etn-blocks-style',"etn-blocks-style-custom"],
                    'script'       => 'etn-qr-code-custom-block',
                    'render_callback' => [$this, 'render_qr_code'],
                ]
            ],
            [
                'name'  => "eventin-pro/custom-image",
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                    'editor_style' => ['etn-blocks-style',"etn-blocks-style-custom"],
                ]
            ],
            [
                'name'  => "eventin-pro/custom-button",
                'attr'  => [
                    'editor_script' => 'etn-blocks',
                    'editor_style' => ['etn-blocks-style',"etn-blocks-style-custom"],
                ]
            ],

        ];

        return $blocks;
    }

    /**
     * Render QR code block
     *
     * @param   array  $attributes  [$attributes description]
     *
     * @return  string
     */
    public function render_qr_code( $attributes ) {
        ob_start();
        $attendee_id       = ! empty( $_GET['attendee_id'] ) ? intval( $_GET['attendee_id'] ) : 0;
        $unique_id         = get_post_meta( $attendee_id, 'etn_unique_ticket_id', true );
		$ticket_verify_url = admin_url( '/edit.php?post_type=etn-attendee&etn_action=ticket_scanner' );
		$ticket_verify_url .= "&attendee_id=$attendee_id&ticket_id=$unique_id";
        ?>
<p class="etn-ticket-id" id="ticketUnqId" data-ticketverifyurl="<?php echo esc_url( $ticket_verify_url ) ?>"></p>
<img class="etn-qrImage" src="" alt="" id="qrImage" />
<?php
        return ob_get_clean();
    }
}