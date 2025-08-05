<?php
defined( 'ABSPATH' ) || exit;

/********************
==== Speaker two ====
********************/

if ( !function_exists( 'speaker_two_sessions_details_before' ) ) {
    /**
     * Speaker details before
     */
    function speaker_two_sessions_details_before() {
        return;
    }

}

if ( !function_exists( 'speaker_two_sessions_details_after' ) ) {
    /**
     * Speaker details after
     */
    function speaker_two_sessions_details_after() {
        return;
    }

}

if ( !function_exists( 'speaker_two_company' ) ) {
    /**
     * Speaker Company
     */
    function speaker_two_company( $logo ) {
        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-company-logo.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-company-logo.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-company-logo.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-company-logo.php';
            } else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/speaker-company-logo.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_two_designation' ) ) {
    /**
     * Speaker designation
     */
    function speaker_two_designation() {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-designation.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-designation.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-designation.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-designation.php';
            } else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/speaker-designation.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_two_meta' ) ) {
    /**
     * Speaker meta
     */
    function speaker_two_meta() {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-meta.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-meta.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-meta.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-meta.php';
            } else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/speaker-meta.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_two_social' ) ) {
    /**
     * Speaker social
     */
    function speaker_two_social() {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){

            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-socials.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-socials.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-socials.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-socials.php';
            } else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/speaker-socials.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_two_summary' ) ) {
    /**
     * Speaker session summary
     */
    function speaker_two_summary() {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){

            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-summary.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-summary.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-summary.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-summary.php';
            } else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/schedule-summary.php';
            }
        }

    }

}

if ( !function_exists( 'schedule_two_header' ) ) {
    /**
     * Speaker main wrapper  before
     */
    function schedule_two_header( $head_title, $head_date ) {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-session-header.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-session-header.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-session-header.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-session-header.php';
            } else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/speaker-session-header.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_two_sessions_title' ) ) {
    /**
     *  Speaker sessions details title.
     */
    function speaker_two_sessions_title() {
        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-header.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-header.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-header.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-header.php';
            }else {
							require \Wpeventin_Pro::templates_dir() . 'speaker/schedule-header.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_two_sessions_details' ) ) {

    /**
     *  Speaker sessions details hook.
     */
    function speaker_two_sessions_details( $org ) {
        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){
            $post_id                 = $org;
            $author_id               = get_queried_object_id();
            $etn_schedule_meta_value = get_post_meta( $post_id, 'etn_schedule_topics', true );
            $schedule_date           = get_post_meta( $post_id, 'etn_schedule_date', true );

            ?>
            <div class="etn-col-lg-6">
                <div class="etn-schedule-wrap">
                    <?php
                    $head_title = get_post_meta( $post_id, 'etn_schedule_title', true );
                    $head_date  = date_i18n( \Etn\Core\Event\Helper::instance()->etn_date_format(), strtotime( $schedule_date ) );
            
                    /**
                     * Speaker schedule header hook.
                     *
                     * @hooked schedule_two_header - 18
                     */
                    do_action( 'etn_schedule_two_header', $head_title, $head_date );

                    foreach ( $etn_schedule_meta_value as $single_meta ) {

                        $start_time = isset($single_meta["etn_shedule_start_time"]) ? $single_meta["etn_shedule_start_time"] : "";
                        $end_time   = isset($single_meta["etn_shedule_end_time"]) ? $single_meta["etn_shedule_end_time"] : "";
                        $room       = isset($single_meta["etn_shedule_room"]) ? $single_meta["etn_shedule_room"] : "";
                        $topics     = isset($single_meta["etn_schedule_topic"]) ? $single_meta["etn_schedule_topic"] : "";
                        $desc       = isset($single_meta["etn_shedule_objective"]) ? $single_meta["etn_shedule_objective"] : "";


                        if (  !empty( $single_meta['speakers'] ) && in_array( $author_id, $single_meta['speakers'] ) ):
                            ?>
                            <div class="etn-single-schedule-item">
                                <?php

                                /**
                                 * Speaker schedule time hook.
                                 *
                                 * @hooked schedule_session_time - 19
                                 */
                                do_action( 'etn_schedule_two_session_time', $start_time,  $end_time );

                                ?>
                                <div class="etn-schedule-content">
                                    <?php
                                    /**
                                     * Speaker session title
                                     *
                                     * @hooked schedule_session_title - 20
                                     */
                                    do_action( 'etn_schedule_two_session_title', $topics );

                                    /**
                                     * Speaker  session location
                                     *
                                     * @hooked schedule_two_session_location - 21
                                     */
                                    do_action( 'etn_schedule_two_session_location',  $room );

                                    /**
                                     * Speaker session objective
                                     *
                                     * @hooked schedule_two_session_objective - 22
                                     */
                                    
                                    do_action( 'etn_schedule_two_session_objective', $desc );
                                    ?>
                                </div>
                            </div>
                        <?php 
                        endif;
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }

}



if ( !function_exists( 'schedule_two_session_time' ) ) {
    /**
     * Speaker main wrapper  before
     */
    function schedule_two_session_time( $start, $end ) {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-time.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-time.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-time.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-time.php';
            } else {
                require \Wpeventin::templates_dir() . 'speaker/schedule-time.php';
            }
        }

    }

}

if ( !function_exists( 'schedule_two_session_title' ) ) {
    /**
     * Speaker session title
     */
    function schedule_two_session_title( $topic ) {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){

            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-topic.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-topic.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-topic.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-topic.php';
            } else {
                require \Wpeventin::templates_dir() . 'speaker/schedule-topic.php';
            }
        }

    }

}

if ( !function_exists( 'schedule_two_session_location' ) ) {
    /**
     * Speaker session location
     */
    function schedule_two_session_location( $etn_shedule_room ) {
        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-locations.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-locations.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-locations.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-locations.php';
            } else {
                require \Wpeventin::templates_dir() . 'speaker/schedule-locations.php';
            }
        }

    }

}

if ( !function_exists( 'schedule_two_session_objective' ) ) {
    /**
     * Schedule objective
     */
    function schedule_two_session_objective( $objective ) {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_TWO_ID == get_queried_object_id(  ) ) ){
            
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-objective.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-objective.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-objective.php' ) ) {
                require_once get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-objective.php';
            } else {
                require \Wpeventin::templates_dir() . 'speaker/speaker-objective.php';
            }
        }

    }

}

/* **********************
 *  Speaker two end
 ************************/



/* *************************
 *  Speaker three start
 ***************************/

if ( !function_exists( 'speaker_three_designation' ) ) {
    /**
     * Speaker designation
     */
    function speaker_three_designation() {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-designation.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-designation.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-designation.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-designation.php';
            }else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/speaker-designation.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_three_meta' ) ) {
    /**
     * Speaker meta
     */
    function speaker_three_meta() {
        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-meta.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-meta.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-meta.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-meta.php';
            } else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/speaker-meta.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_three_social' ) ) {
    /**
     * Speaker social
     */
    function speaker_three_social() {
        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-socials.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-socials.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-socials.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-socials.php';
            } else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/speaker-socials.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_three_summary' ) ) {
    /**
     * Speaker summary
     */
    function speaker_three_summary() {
        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-summary.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-summary.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-summary.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-summary.php';
            } else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/schedule-summary.php';
            }
        }

    }

}

if ( !function_exists( 'speaker_three_details_before' ) ) {
    /**
     * Speaker details before
     */
    function speaker_three_details_before() {
        return;
    }

}

if ( !function_exists( 'schedule_three_header' ) ) {
    /**
     * Speaker details header
     */
    function schedule_three_header() {
        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-header.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-header.php';
            } elseif ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-header.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-header.php';
            }else {
                require \Wpeventin_Pro::templates_dir() . 'speaker/schedule-header.php';
            }
        }

    }

}

if ( !function_exists( 'schedule_three_session_time' ) ) {
    /**
     * Speaker details header
     */
    function schedule_three_session_time( $start, $end ) {
        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-time.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-time.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-time.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-time.php';
            } else {
                require \Wpeventin::templates_dir() . 'speaker/schedule-time.php';
            }
        }

    }

}

if ( !function_exists( 'schedule_three_session_topic' ) ) {
    /**
     * Speaker details header
     */
    function schedule_three_session_topic( $topic ) {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-topic.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-topic.php';
            } elseif ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-topic.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-topic.php';
            } else {
                require \Wpeventin::templates_dir() . 'speaker/schedule-topic.php';
            }
        }

    }

}


if ( !function_exists( 'schedule_three_session_location' ) ) {
    /**
     * Speaker details header
     */
    function schedule_three_session_location( $etn_shedule_room ) {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){

            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-locations.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-locations.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-locations.php' ) ) {
                require get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/schedule-locations.php';
            } else {
                require \Wpeventin::templates_dir() . 'speaker/schedule-locations.php';
            }
        }

    }

}

if ( !function_exists( 'schedule_three_session_objective' ) ) {
    /**
     * Schedule objective
     */
    function schedule_three_session_objective( $objective ) {

        if( ( ETN_DEMO_SITE === false ) || ( ETN_DEMO_SITE === true && ETN_SPEAKER_TEMPLATE_THREE_ID == get_queried_object_id(  ) ) ){
            
            if ( file_exists( get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-objective.php' ) ) {
                require get_stylesheet_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-objective.php';
            } else if ( file_exists( get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-objective.php' ) ) {
                require_once get_template_directory() . \Wpeventin::theme_templates_dir() . 'speaker/speaker-objective.php';
            } else {
                require \Wpeventin::templates_dir() . 'speaker/speaker-objective.php';
            }
        }

    }

}


if ( !function_exists( 'speaker_three_details_after' ) ) {
    /**
     * Speaker details after
     */
    function speaker_three_details_after() {
        return;
    }

}
/* *************************
 *  Speaker three start
 ***************************/
