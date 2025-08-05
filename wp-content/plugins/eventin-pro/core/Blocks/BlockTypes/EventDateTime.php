<?php
namespace EventinPro\Blocks\BlockTypes;

use Etn\Core\Event\Event_Model;
use Eventin\Blocks\BlockTypes\AbstractBlock;
use Wpeventin_Pro;

/**
 * Event Date Time Gutenberg block
 */
class EventDateTime extends AbstractBlock {
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
    protected $block_name = 'event-datetime';

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
        $date_format = etn_date_format();
        $time_format = etn_time_format();

        $start_date = $event->get_start_date( $date_format );
        $start_time = $event->get_start_time( $time_format );
        $end_date   = $event->get_end_date( $date_format );
        $end_time   = $event->get_end_time( $time_format );
        $timezone   = $event->get_timezone();

        ob_start();

        require_once Wpeventin_Pro::templates_dir() . 'event/parts/event-datetime.php';

        return ob_get_clean();
    }
}

