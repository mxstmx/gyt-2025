<?php
if (!defined('ABSPATH')) exit;

use \Etn_Pro\Utils\Helper;



$date_options= Helper::get_date_formats();

$event_options = get_option("etn_event_options");

$data = Helper::post_data_query('etn', $event_count, $order, $event_cat, 'etn_category', null, null, $event_tag, $orderby_meta, $orderby,$filter_with_status,$post_parent);

?>
<div class='etn-event-wrapper etn-event-style3 etn-event-slider' data-autoplay="<?php echo esc_attr($auto_play); ?>" data-count="<?php echo esc_attr($event_slider_count); ?>">
    <div class="swiper-wrapper">

        <?php
        if ( !empty( $data ) ) {
            foreach( $data as $value ) { 

                $social                     = get_post_meta($value->ID, 'etn_event_socials', true);
                $etn_event_location         = \Etn\Core\Event\Helper::instance()->display_event_location($value->ID);
                $category                   = Helper::cate_with_link($value->ID, 'etn_category');
              ?>
                <div class="swiper-slide">

                    <div class="etn-event-item" style="background-image: url(<?php echo esc_url(esc_url( get_the_post_thumbnail_url( $value->ID ) )); ?>);">

                        <div class="etn-event-meta-info">
                            <?php if ($show_category === 'yes') : ?>
                                <div class="etn-event-category">
                                    <?php echo  Helper::kses($category); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($show_btn == 'yes') : ?>
                                <div class="etn-atend-btn">
                                    <a href="<?php echo esc_url( get_the_permalink( $value->ID ) ); ?>" class="etn-btn etn-btn-border"><?php echo esc_html($btn_text); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- content start-->
                        <div class="etn-event-content">
                        <?php Helper::event_recurring_status($value); ?>

                            <div class="etn-event-date">
                                <?php
                                    echo esc_html(Helper::etn_display_date($value->ID, 'yes', $show_end_date)); 
                                ?>  
                            </div>
                            <div class="etn-title-info">
                                
                                <?php if($show_event_location === 'yes' &&  !empty($etn_event_location)): ?>
                                    <div class="etn-event-location">
                                        <i class="etn-icon etn-location"></i>
                                        <?php echo esc_html($etn_event_location); ?>
                                    </div>
                                <?php endif; ?>
                                
                                
                                <h3 class="etn-title etn-event-title"><a href="<?php echo esc_url( get_the_permalink( $value->ID ) ); ?>"> <?php echo esc_html( get_the_title( $value->ID ) ); ?></a> </h3>
                                <?php if ($show_desc == 'yes') : ?>
                                    <p><?php echo esc_html(Helper::trim_words( get_the_excerpt($value->ID) , $desc_limit)); ?></p>
                                <?php endif; ?>

                                <?php if ($show_attendee_count == 'yes') : ?>
                                    <div class="etn-event-attendee-count">
                                        <i class="etn-icon etn-user-plus"></i>
                                        <?php echo 0; ?>
                                        <?php echo esc_html__('People Joined', 'eventin-pro'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- content end-->
                    </div>
                    <!-- etn event item end -->
                </div>
                <!-- col end -->
        <?php
            }
        }
        ?>
    </div>
    <?php if ($slider_nav_show == 'yes') : ?>
        <!-- next / prev arrows -->
        <div class="swiper-button-next"> <i class="etn-icon etn-arrow-right"></i> </div>
        <div class="swiper-button-prev"> <i class="etn-icon etn-arrow-left"></i> </div>
        <!-- !next / prev arrows -->
    <?php endif; ?>
    <?php if ($slider_dot_show == 'yes') : ?>
        <!-- pagination dots -->
        <div class="swiper-pagination"></div>
        <!-- !pagination dots -->
    <?php endif; ?>
</div>