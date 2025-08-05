<?php

Class most_recent_widget_custom extends WP_Widget {

    public function __construct() {
        $widget_details = array(
            'classname' => 'most_recent_widget_custom',
            'description' => esc_html__('Display Recent Thumbnail Posts.', 'most')
        );

        parent::__construct('most_recent_widget_custom', esc_html__('Most: Recent Thumbnail Posts', 'most'), $widget_details);
    }

    public function widget($args, $instance) {
                if ( ! isset( $args['widget_id'] ) ) {
                $args['widget_id'] = $this->id;
    }

    if ( function_exists( 'add_theme_support' ) ) {
        add_image_size( 'most-recent-post-thumb', 90, 90, true ); 
    }

    $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'most' );

    $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
    if ( ! $number )
        $number = 5;
    $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

    $r = new WP_Query( apply_filters( 'widget_posts_args', array(
        'posts_per_page'      => $number,
        'no_found_rows'       => true,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true
    ) ) );

    if ($r->have_posts()) :
    ?>
        <aside class="ms_widget_recent_posts">
        <?php  $args['before_widget']; ?>
        <?php if ( $title ) {
           echo wp_kses_post($args['before_title']) . $title . $args['after_title'];
        } ?>
        <ul>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <li class="recent-post">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="post-image">
                        <?php the_post_thumbnail($size = 'most-recent-post-thumb', array( 'alt' => get_the_title())); ?>
                    </div>
                    <?php endif; ?>
                    <div class="recent-post__info">
                        <?php get_the_title() ? the_title() : the_ID(); ?>
                        <?php if ( $show_date ) : ?>
                            <span class="post-date"><?php echo esc_html(get_the_date()); ?></span>
                        <?php endif; ?>
                    </div>
                </a>
            </li>
        <?php endwhile; ?>
        </ul>
        <?php $args['after_widget']; ?>
        <?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif; ?>
        </aside>
    <?php }

    public function flush_widget_cache() {
        wp_cache_delete('widget_recent_posts_thumbnail', 'widget');
    }
 
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        ?>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        <p>
        <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
        <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" style="width:50px;" />
        </p>
        <p>
        <input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
        <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label>
        </p>
        <?php
    }

}