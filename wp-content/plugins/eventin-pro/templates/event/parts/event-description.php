<div class="<?php echo esc_attr( $container_class ); ?>">
    <div class="eventin-block-container">
        <div class="etn-event-content-body">
            <?php 
            echo wp_kses_post( $event->get_description() );
        ?>
        </div>
    </div>
</div>