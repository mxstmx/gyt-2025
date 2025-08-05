<?php
namespace EventinPro\Blocks\BlockTypes;

use Etn\Core\Event\Event_Model;
use Eventin\Blocks\BlockTypes\AbstractBlock;
use Wpeventin_Pro;
 
/**
 * Event Venue Gutenberg block
 */
class EventRSVP extends AbstractBlock {
    /**
     * Block Namespace
     *
     * @var string
     */
    protected $namespace = 'eventin-pro';

    /**
     * Block name.
     *
     * @var string
     */
    protected $block_name = 'event-rsvp';

    /**
     * Include and render the block
     *
     * @param   array  $attributes  Block attributes. Default empty array
     * @param   string  $content     Block content. Default empty string
     * @param   WP_Block  $block       Block instance
     *
     * @return  string Rendered block type output
     */
    protected function render( $attributes, $content, $block ) {
        $container_class = ! empty( $attributes['containerClassName'] ) ? $attributes['containerClassName'] : '';

        if ( $this->is_editor() ) {
            $single_event_id = ! empty( $attributes['eventId'] ) ? intval( $attributes['eventId'] ) : 0;
        } else {
            $single_event_id = get_the_ID();
        } 
        ob_start();

        require_once Wpeventin_Pro::templates_dir() . 'event/parts/rsvp.php';
        
        return ob_get_clean();
    }
}

