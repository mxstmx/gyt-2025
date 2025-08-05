<?php

use \Etn_Pro\Utils\Helper;

if ( !empty( $schedule_id ) ) {
	date_default_timezone_set('UTC');
	$schedule = get_post( $schedule_id );
	if ( !empty( $schedule ) && is_object( $schedule ) && "etn-schedule" === $schedule->post_type) {
			?>
			<!-- schedule tab start -->
			<div class="schedule-list-wrapper schedule-tab-wrapper etn-schedule-style-3">
					<div class='etn-schedule-wrap'>
							<?php
							$event_options                                                      = get_option( "etn_event_options" );
							$event_options["time_format"]                                       = empty($event_options["time_format"]) ? '12' : $event_options["time_format"];
							$etn_sched_time_format                                              = $event_options["time_format"] == '24' ? "H:i" : get_option( 'time_format' );
							$schedule_meta                                                      = get_post_meta( $schedule->ID );
							$schedule_title                                                     = $schedule_meta['etn_schedule_title'][0];
							$schedule_date                                                      = ! empty( $schedule_meta['etn_schedule_date'][0] ) ? $schedule_meta['etn_schedule_date'][0] : '';
							$schedule_topics                                                    = unserialize( $schedule_meta['etn_schedule_topics'][0] );
							$schedule_date                                                      = \Etn\Utils\Helper::etn_date( $schedule_date );

							?>
							<!-- start repeatable item -->
							<ul>
									<?php
									foreach ( $schedule_topics as $topic ){
											$etn_schedule_topic      = ( isset( $topic['etn_schedule_topic'] ) ? $topic['etn_schedule_topic'] : '' );
											$etn_schedule_start_time = !empty($topic['etn_shedule_start_time']) ? date_i18n($etn_sched_time_format, strtotime($topic['etn_shedule_start_time'])) : '';
											$etn_schedule_end_time   = !empty($topic['etn_shedule_end_time']) ? date_i18n($etn_sched_time_format, strtotime($topic['etn_shedule_end_time'])) : '';
											$etn_schedule_room       = ( isset( $topic['etn_shedule_room'] ) ? $topic['etn_shedule_room'] : '' );
											$etn_schedule_objective  = ( isset( $topic['etn_shedule_objective'] ) ? $topic['etn_shedule_objective'] : '' );
											$etn_schedule_speaker    = ( isset( $topic['speakers'] ) ? $topic['speakers'] : [] );
											$dash_sign	                = ( !empty( $etn_schedule_start_time ) && !empty( $etn_schedule_end_time ) ) ? " - " : " ";

											?>
													<li>
															<div class='etn-single-schedule-item'>
																	<div class='etn-schedule-info'>
																			<?php if ($show_time_duration == 'yes' && ( !empty($etn_schedule_start_time) || !empty( $etn_schedule_end_time ) )) { ?>
																					<span class='etn-schedule-time'><?php echo esc_html($etn_schedule_start_time) . " - " . esc_html($etn_schedule_end_time); ?></span>
																			<?php } ?>

																			<?php if ($show_location == 'yes' && !empty( $etn_schedule_room )) { ?>
																					<span class='etn-schedule-location'>
																							<i class='etn-icon etn-location'></i>
																							<?php echo esc_html($etn_schedule_room); ?>
																					</span>
																			<?php } ?>
																	</div>
																	<div class='etn-schedule-content'>
																			<h4 class='etn-title'><?php echo esc_html($etn_schedule_topic); ?></h4>
																			<p><?php echo Helper::render($etn_schedule_objective); ?></p>
																	</div>
																	<?php if ($show_speaker == 'yes') { ?>
																		<div class='etn-schedule-right-content'>
																			<div class='etn-schedule-single-speaker'>
																				<div class='etn-schedule-speaker'>
																					<?php
																					$speaker_avatar = apply_filters("etn/speakers/avatar", \Wpeventin::assets_url() . "images/avatar.jpg");
																					if (count($etn_schedule_speaker) > 0 && is_array($etn_schedule_speaker)) {
																						foreach ($etn_schedule_speaker as $key => $value) {
																							$etn_speaker_permalink = Helper::get_author_page_url_by_id($value);
																							$speaker_thumbnail     = get_user_meta( $value, 'image', true);
																							$speaker_title         = get_the_author_meta( 'display_name', $value );
																							?>
																							<div class='etn-schedule-single-speaker'>
																								<a href='<?php echo esc_url($etn_speaker_permalink); ?>' target="_blank" rel="noopener" aria-label='<?php echo esc_attr($speaker_title);?>'>
																									<?php if($speaker_thumbnail): ?>
																										<img src="<?php echo esc_url($speaker_thumbnail); ?>" alt="<?php echo esc_attr($speaker_title);?>">
																									<?php else: ?>
																										<img src='<?php echo esc_url( $speaker_avatar);?>' class="schedule-slot-speakers" alt='<?php echo esc_attr($speaker_title);?>'>
																									<?php endif; ?>
																								</a>
																								<span class='etn-schedule-speaker-title'><?php echo esc_html($speaker_title); ?></span>
																							</div>
																						<?php
																						}
																					}
																					?>
																				</div>
																			</div>
																		</div>
																	<?php 
																	}
																	?>
															</div>
													</li>
											<?php 
									}
									?>
							<!-- end repeatable item -->
							</ul>
					</div>
			</div>
			<?php
	}

}
?>
<!-- schedule tab end -->