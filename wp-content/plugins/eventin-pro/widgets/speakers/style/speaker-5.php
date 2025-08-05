<?php
use \Etn_Pro\Utils\Helper;
$data = Helper::user_data_query( $speaker_count, $speaker_order, $categories_id, $orderby );

if ( !empty( $data ) ) {
    ?>
    <div class='etn-row etn-speaker-wrapper speaker-style5'>
        <?php
        foreach ($data as $value) {
            $speaker_designation = get_user_meta( $value->data->ID , 'etn_speaker_designation', true);
            $etn_speaker_image = get_user_meta( $value->data->ID, 'image', true);
            $social = get_user_meta( $value->data->ID, 'etn_speaker_social', true);
            $author_id = get_the_author_meta($value->data->ID);
        ?>
            <div class="etn-col-lg-<?php echo esc_attr($speaker_col); ?> etn-col-md-6">
                <div class="etn-single-speaker-item">
                    <div class="etn-speaker-thumb">
                        <a href="<?php echo Helper::get_author_page_url_by_id($value->data->ID);?>" class="etn-img-link" aria-label="<?php echo esc_html($value->data->display_name); ?>">
                            <img src="<?php echo esc_url($etn_speaker_image); ?>" alt="">
                        </a>
                    </div>
                    <!-- content -->
                    <div class="etn-speaker-content">
                        <h3 class="etn-title etn-speaker-title"><a href="<?php echo Helper::get_author_page_url_by_id($value->data->ID); ?>"> <?php echo esc_html($value->data->display_name); ?></a> </h3>
                        <?php if ($show_designation == 'yes') { ?>
                            <p>
                                <?php echo Helper::kses($speaker_designation); ?>
                            </p>
                        <?php } ?>

                        <!-- social -->
                        <?php if ($show_social == 'yes') { ?>
                            <div class="etn-speakers-social">
                                <?php if (is_array($social) && !empty($social)) { ?>
                                    <?php foreach ($social as $social_value) {  ?>
                                        <?php if(!empty($social_value)) { ?>
                                            <a 
                                                href="<?php echo esc_url($social_value["etn_social_url"]); ?>" 
                                                aria-label="<?php echo esc_attr($social_value["etn_social_title"]); ?>"
                                            >
                                                <i class="etn-icon <?php echo esc_attr($social_value["icon"]); ?>"></i>
                                            </a>
                                        <?php  } ?>
                                    <?php  } ?>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- speaker end -->
            </div>
            <!-- col end -->
        <?php } ?>
    </div>
<?php } ?>