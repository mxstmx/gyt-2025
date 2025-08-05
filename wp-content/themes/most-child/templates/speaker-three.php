<?php
defined( 'ABSPATH' ) || exit;

use \Etn_Pro\Utils\Helper;

$author_id         = get_queried_object_id();
$speaker_thumbnail = get_user_meta( $author_id, 'image', true);
$author_name       = get_the_author_meta( 'display_name', $author_id );

if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE == true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){
    ?>
    <div class="etn-speaker-page-container">
        <div class="etn-container">
            <div class="etn-single-speaker-wrapper etn-speaker-details3">
                <div class="etn-speaker-details-info-wrap">
                    <div class="etn-row">
                        <div class="etn-col-lg-4">
                            <?php 
                            $speaker_avatar = !empty($speaker_thumbnail)? esc_url($speaker_thumbnail): apply_filters("etn/speakers/avatar", \Wpeventin::assets_url() . "images/avatar.jpg");
                            ?>
                            <div class="etn-speaker-thumb">
								<?php if($speaker_avatar): ?>
									<img src="<?php echo esc_url( $speaker_avatar ); ?>" alt="<?php esc_attr($author_name); ?>" />
								<?php endif; ?>
							</div>
                        
                            <div class="speaker-title-info">
                                <h3 class="etn-title etn-speaker-name"> öldfjgdöflgödf
									<?php echo esc_html($author_name); ?> 
								</h3>
                                <?php
                                    /**
                                    * Speaker designation hook.
                                    *
                                    * @hooked speaker_three_designation - 10
                                    */
                                    do_action('etn_speaker_three_designation');
                                ?>
                            </div>
                            <?php 		
                                /**
                                * Speaker meta hook.
                                *
                                * @hooked etn_speaker_company_logo - 12
                                */
                                do_action('etn_speaker_company_logo');
                            ?>
                            <div class="etn-speaker-info">
                                <?php
                                    /**
                                    * Speaker meta hook.
                                    *
                                    * @hooked speaker_three_meta - 11
                                    */
                                    do_action('etn_speaker_three_meta');
                                    /**
                                    * Speaker meta hook.
                                    *
                                    * @hooked speaker_three_social - 12
                                    */
                                    do_action('etn_speaker_three_social');
                                ?>
                            </div>
                        </div>
                        <div class="etn-col-lg-8">
                            <?php
                                /**
                                * Speaker summary hook.
                                *
                                * @hooked speaker_three_summary - 13
                                */
                                do_action('etn_speaker_three_summary');

                                /**
                                * Speaker summary hook.
                                *
                                * @hooked speaker_three_details_before - 15
                                */
                                do_action('etn_speaker_three_details_before');
                            ?>
                            <div class="schedule-list-1">
                                <?php
                                /**
                                * Speaker details header hook.
                                *
                                * @hooked schedule_three_header - 16
                                */
                                do_action('etn_schedule_three_header');

                                ?>
                                <div class="etn-row">
                                    <?php
                                    $orgs = Helper::speaker_sessions( $author_id );
                                    foreach ($orgs as $org) {
                                        $etn_schedule_meta_value = get_post_meta( $org, 'etn_schedule_topics', true );
                                        if( is_array( $etn_schedule_meta_value ) && !empty( $etn_schedule_meta_value )){

                                            foreach ($etn_schedule_meta_value as $single_meta) {

                                                $etn_schedule_speaker = !empty( $single_meta['speakers'] ) ? $single_meta['speakers'] : [];

                                                $start_time = isset($single_meta["etn_shedule_start_time"]) ? $single_meta["etn_shedule_start_time"] : "";
                                                $end_time   = isset($single_meta["etn_shedule_end_time"]) ? $single_meta["etn_shedule_end_time"] : "";
                                                $room       = isset($single_meta["etn_shedule_room"]) ? $single_meta["etn_shedule_room"] : "";
                                                $topics     = isset($single_meta["etn_schedule_topic"]) ? $single_meta["etn_schedule_topic"] : "";
                                                $desc       = isset($single_meta["etn_shedule_objective"]) ? $single_meta["etn_shedule_objective"] : "";

                                                
                                                if( in_array( $author_id , $etn_schedule_speaker ) ) :
                                                    ?>
                                                    <div class="etn-col-lg-6">
                                                        <div class="etn-schedule-wrap">
                                                            <div class="etn-single-schedule-item">
                                                                <?php
                                                                    /**
                                                                    * Speaker session time hook.
                                                                    *
                                                                    * @hooked schedule_three_session_time - 17
                                                                    */
                                                                    do_action('etn_schedule_three_session_time',  $start_time, $end_time);
                                                                ?>
                                                                <div class="etn-schedule-content">
                                                                    <?php
                                                                    /**
                                                                    * Speaker session topic hook.
                                                                    *
                                                                    * @hooked schedule_three_session_topic - 18
                                                                    */
                                                                    do_action('etn_schedule_three_session_topic', $topics  );
                
                                                                    
                                                                    /**
                                                                    * Speaker session topic hook.
                                                                    *
                                                                    * @hooked schedule_three_session_location - 19
                                                                    */
                                                                    do_action('etn_schedule_three_session_location', $room );

                                                                    /**
                                                                    * Speaker session objective hook.
                                                                    *
                                                                    * @hooked schedule_three_session_objective - 20
                                                                    */
                                                                    do_action( 'etn_schedule_three_session_objective', $desc );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                endif;
                                            }

                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- schedule list -->
            </div>
        </div>
    </div>
    <?php 
} 
?>