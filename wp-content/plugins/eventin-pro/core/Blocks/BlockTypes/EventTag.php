<?php
namespace EventinPro\Blocks\BlockTypes;

use Etn\Core\Event\Event_Model;
use Eventin\Blocks\BlockTypes\AbstractBlock;
use Wpeventin_Pro;

/**
 * Event Tag Gutenberg block
 */
class EventTag extends AbstractBlock {
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
    protected $block_name = 'event-tag';

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
            $event_id = ! empty( $attributes['eventId'] ) ? intval( $attributes['eventId'] ) : 0;
        } else {
            $event_id = get_the_ID();
        }

        $event = new Event_Model( $event_id );

        $event_tags = $event->get_tags();

        ob_start();

        require_once Wpeventin_Pro::templates_dir() . 'event/parts/event-tag.php';

        return ob_get_clean();
    }
}

