<?php
use \Etn_Pro\Utils\Helper;

$data = Helper::user_data_query( $etn_speaker_count, $etn_speaker_order, $category_id, $orderby );

if ( !empty( $data ) ) {?>
    <div class='etn-row etn-speaker-wrapper'>
        <?php
          foreach( $data as $value ) { 
            $speaker_email = get_the_author_meta(  'user_email', $value->data->ID);
            $company_logo = get_user_meta( $value->data->ID, 'etn_speaker_company_logo', true);
            $social = get_user_meta( $value->data->ID, 'etn_speaker_social', true);
            ?>
            <div class="etn-col-lg-<?php echo esc_attr($etn_speaker_col); ?> etn-col-md-6">
                <div class="etn-organizer-item">
                    <div class="etn-organizer-company-logo">
                        <?php if (!empty($company_logo)): ?>
                            <img src="<?php echo esc_url($company_logo); ?>" alt="">
                        <?php endif; ?>
                    </div>

                    <ul class="etn-organizer-content">
                        <?php if ($speaker_email != '') : ?>
                            <li>
                                <strong>
                                    <?php echo esc_html__('Email : ', 'eventin-pro'); ?>
                                </strong>
                                <a class="etn-speaker-mail-anchor" href="mailto:<?php echo esc_attr($speaker_email); ?>"><?php echo esc_html($speaker_email); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (is_array( $social ) && !empty( $social )) { ?>
                            <li>
                                <strong>
                                    <?php echo esc_html__('Social : ', 'eventin-pro'); ?>
                                </strong>
                                <div class="etn-organizer-social">
                                        <?php foreach ($social as $social_value) {  ?>
                                            <a  target="_blank" href="<?php echo esc_url($social_value["etn_social_url"]); ?>" title="<?php echo esc_attr($social_value["etn_social_title"]); ?>">
                                                <i class="etn-icon <?php echo esc_attr($social_value["icon"]); ?>"></i>
                                            </a>
                                        <?php  } ?>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <?php 
        }
        ?>
    </div>
<?php } 