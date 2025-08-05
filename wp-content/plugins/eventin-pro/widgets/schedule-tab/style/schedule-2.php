<?php
use \Etn_Pro\Utils\Helper;

$data = Helper::post_data_query( 'etn-schedule' , -1 , $order , null , null , $schedule_ids );
date_default_timezone_set('UTC');
$i = -1;
?>

<!-- schedule tab start -->
<div class="schedule-tab-wrapper etn-tab-wrapper schedule-tab-2">
    <ul class='etn-nav'>
        <?php
        $i = -1;
        foreach ($data as $post) {
            $i++;
            $schedule_meta = get_post_meta($post->ID);
            $schedule_date = strtotime($schedule_meta['etn_schedule_date'][0]);
            $schedule_date = date_i18n("d M", $schedule_date);
            $active_class = (($i == 0) ? 'etn-active' : ' ');
            ?>
            <li>
                <a href='#' class='etn-tab-a <?php echo esc_attr($active_class); ?>' data-id='tab<?php echo esc_attr($widget_id) . "-" . $i; ?>'>
                    <span class='etn-date'><?php echo esc_html($schedule_date); ?></span>
                    <span class=etn-day><?php echo esc_html($post->post_title); ?></span>
                </a>
            </li>
            <?php 
        } 
        ?>
    </ul>
    <div class='etn-tab-content clearfix etn-schedule-wrap'>
        <?php
        $event_options["time_format"] = empty( $event_options["time_format"] ) ?  '12' : $event_options["time_format"];
        $etn_sched_time_format = $event_options["time_format"] == '24' ? "H:i" : get_option( 'time_format' );

        $j = -1;
        foreach ($data as $post) {
            $j++;
            $schedule_meta = get_post_meta($post->ID);
            $schedule_date = strtotime($schedule_meta['etn_schedule_date'][0]);
            $schedule_topics = unserialize($schedule_meta['etn_schedule_topics'][0]);
            $schedule_date = date_i18n("d M", $schedule_date);
            $active_class = (($j == 0) ? 'tab-active' : ' ');
            ?>
            <!-- start repeatable item -->
            <div class='etn-tab <?php echo esc_attr($active_class); ?>' data-id='tab<?php echo esc_attr($widget_id) . "-" . $j; ?>'>
                <?php
                foreach ($schedule_topics as $key => $topic) {
                    $etn_schedule_topic         = (isset($topic['etn_schedule_topic']) ? $topic['etn_schedule_topic'] : '');
                    $etn_schedule_start_time    = !empty($topic['etn_shedule_start_time']) ? date_i18n($etn_sched_time_format, strtotime($topic['etn_shedule_start_time'])) : '';
                    $etn_schedule_end_time      = !empty($topic['etn_shedule_end_time']) ? date_i18n($etn_sched_time_format, strtotime($topic['etn_shedule_end_time'])) : '';
                    $etn_schedule_room          = (isset($topic['etn_shedule_room']) ? $topic['etn_shedule_room'] : '');
                    $etn_schedule_objective     = (isset($topic['etn_shedule_objective']) ? $topic['etn_shedule_objective'] : '');
                    $etn_schedule_speaker       = (isset($topic['speakers']) ? $topic['speakers'] : []);
                    $acc_class                  = ($key == 0) ? 'active' : '';

                    ?>
                    <div class='etn-single-schedule-item etn-row'>
                        <div class='etn-schedule-info etn-col-lg-3 etn-col-sm-3'>

                            <?php if ($show_time_duration == 'yes' && (!empty($etn_schedule_start_time) || !empty( $etn_schedule_end_time ))) { ?>
                                <span class='etn-schedule-time'><?php echo esc_html($etn_schedule_start_time) . " - " . esc_html($etn_schedule_end_time); ?></span>
                            <?php } ?>

                            <?php if ($show_location == 'yes' && !empty( $etn_schedule_room )) { ?>
                                <span class='etn-schedule-location'>
                                    <i class='etn-icon etn-location'></i>
                                    <?php echo esc_html($etn_schedule_room); ?>
                                </span>
                            <?php } ?>
                        </div>
                        <div class='etn-schedule-content etn-col-lg-9 etn-col-sm-9'>
                            <div class="etn-accordion-wrap etn-schedule-content-wrap xx">
                                <div class="etn-content-item">
                                    <h4 class='etn-title etn-accordion-heading <?php echo esc_attr($acc_class); ?>'>
                                        <?php echo esc_html($etn_schedule_topic); ?>
                                        <?php 
                                            if($acc_class){
                                                echo '<i class="etn-icon etn-minus"></i>';
                                            } else {
                                                echo '<i class="etn-icon etn-plus"></i>';
                                            }
                                        ?>
                                    </h4>
                                    <div class="etn-acccordion-contents <?php echo esc_attr($acc_class); ?>">
                                        <p>
                                            <?php echo Helper::render($etn_schedule_objective); ?>
                                        </p>
                                        <?php if ($show_speaker == 'yes') { ?>
                                            <div class='etn-schedule-speaker-item'>
                                                <?php
                                                $speaker_avatar = apply_filters("etn/speakers/avatar", \Wpeventin::assets_url() . "images/avatar.jpg");
                                                if (count($etn_schedule_speaker) > 0 && is_array($etn_schedule_speaker)) {
                                                    foreach ($etn_schedule_speaker as $key => $value) {
                                                        $etn_speaker_permalink = Helper::get_author_page_url_by_id($value);
                                                        $speaker_thumbnail     = get_user_meta( $value, 'image', true);
                                                        $speaker_designation   = get_user_meta( $value, 'etn_speaker_designation', true );
                                                        $speaker_title         = get_the_author_meta( 'display_name', $value );
                                                        ?>
                                                        <div class='etn-schedule-single-speaker'>
                                                            <a href='<?php echo esc_url($etn_speaker_permalink); ?>' aria-label="<?php echo esc_html($speaker_title); ?>">
                                                                <?php if(!empty($speaker_thumbnail)): ?>
                                                                    <img src="<?php echo esc_url($speaker_thumbnail); ?>" alt="<?php echo esc_attr($speaker_title);?>">
                                                                <?php else: ?>
                                                                    <img src='<?php echo esc_url( $speaker_avatar);?>' alt='<?php echo esc_attr($speaker_title);?>'>
                                                                <?php endif; ?>
                                                            </a>
                                                            <span class='etn-schedule-speaker-title'><?php echo esc_html($speaker_title); ?></span>
                                                            <span class='etn-schedule-speaker-designation'><?php echo Helper::kses($speaker_designation); ?></span>

                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <?php 
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                } 
                ?>
            </div>
            <!-- end repeatable item -->
        <?php  } ?>
    </div>
</div>
<!-- schedule tab end -->