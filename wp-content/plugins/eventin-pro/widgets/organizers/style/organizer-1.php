<?php

use \Etn_Pro\Utils\Helper;

    $speaker_id    = $settings["speaker_id"];
    $social        = get_user_meta( $speaker_id, 'etn_speaker_social', true);
    $company_logo = get_user_meta( $speaker_id, 'etn_speaker_company_logo', true);
    $speaker_email = get_the_author_meta(  'user_email', $speaker_id);

    ?>
    <div class="etn-speaker-wrapper">
        <div class="etn-organizer-item">
            <div class="etn-organizer-company-logo">
                <?php if (isset($company_logo)): ?>
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
