<?php
use \Etn_Pro\Utils\Helper;

$data = Helper::user_data_query( $speaker_count, $speaker_order, $categories_id, $orderby );

if ( !empty( $data ) ) { ?>
    <div class='etn-speaker-wrapper etn-speaker-slider speaker-style5' data-autoplay="<?php echo esc_attr($auto_play); ?>" data-count="<?php echo esc_attr($slider_count); ?>" data-space="<?php echo esc_attr($spaceBetween); ?>">
        <div class="swiper-wrapper">
            <?php
            foreach( $data as $value ) {
                $speaker_designation = get_user_meta( $value->data->ID , 'etn_speaker_designation', true);
                $etn_speaker_image = get_user_meta( $value->data->ID, 'image', true);
                $social = get_user_meta( $value->data->ID, 'etn_speaker_social', true);
                $author_id = get_the_author_meta($value->data->ID);
                ?>
                <div class="swiper-slide">
                    <div class="etn-single-speaker-item">
                        <div class="etn-speaker-thumb">
                            <a href="<?php echo Helper::get_author_page_url_by_id($value->data->ID); ?>" class="etn-img-link" aria-label="<?php echo esc_html($value->data->display_name); ?>">
                                <img src="<?php echo esc_url($etn_speaker_image); ?>" alt="">
                            </a>
                            <!-- content -->
                            <div class="etn-speaker-content">
                                <h3 class="etn-title etn-speaker-title"><a href="<?php echo Helper::get_author_page_url_by_id($value->data->ID); ?>"> <?php echo esc_html($value->data->display_name); ?></a></h3>
                                <?php if ($show_designation == 'yes') { ?>
                                    <p>
                                        <?php echo Helper::kses($speaker_designation); ?>
                                    </p>
                                <?php } ?>

                                <!-- social -->
                                <?php if ($show_social == 'yes') { ?>
                                    <div class="etn-speakers-social">
                                        <?php if (is_array($social)) { ?>
                                            <?php foreach ($social as $social_value) {  
                                                if(!empty($social_value["etn_social_title"])) {
                                                ?>
                                                <a href="<?php echo esc_url($social_value["etn_social_url"]); ?>" aria-label="<?php echo esc_attr($social_value["etn_social_title"]); ?>">
                                                    <i class="etn-icon <?php echo esc_attr($social_value["icon"]); ?>"></i>
                                                </a>
                                                <?php  
                                                }
                                            }  ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </div>

                    </div>
                    <!-- speaker end -->
                </div>
                <!-- col end -->
            <?php
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
<?php } ?>