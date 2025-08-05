<?php

defined( 'ABSPATH' ) || exit;

use Etn_Pro\Utils\Helper;

$organizers = is_serialized( $etn_organizer_events ) ? maybe_unserialize( $etn_organizer_events ) : $etn_organizer_events;

$args = [
    'include' 	=> $organizers
];

$data = get_users( $args );

$event_options        = get_option( "etn_event_options" );
$email_show 		  =  $event_options["hide_oragnizer_email_from_events"] ?? '';

if ( $data && $organizers ) :
?>

<div class="etn-event-organizers etn-organizer-style-1">
    <h4 class="etn-title">
        <?php  
            $event_organizers_title = apply_filters( 'etn_event_organizers_title', esc_html__("Organizer:",  'eventin-pro' ) );
            echo esc_html( $event_organizers_title );
        ?> 
    </h4>
    <div class="etn-organizer-wrap">
        <?php
        if (isset( $data ) && !empty( $data )) {
            foreach ($data as $value) { 

                $social = get_user_meta( $value->ID , 'etn_speaker_social', true);
                $email = get_user_meta( $value->ID , 'etn_speaker_website_email', true);
                $etn_speaker_company_logo = get_user_meta( $value->ID , 'image_id', true);
                $etn_company_logo = get_user_meta( $value->ID , 'etn_speaker_company_logo', true);                  

                ?>
                <div class="etn-organaizer-item">
                    <?php 
                    if ( ! empty($etn_speaker_company_logo) ) { 
                        ?>
                        <div class="etn-organizer-logo">
                            <?php echo wp_get_attachment_image($etn_speaker_company_logo, 'large'); ?>
                        </div>
                        <?php 
                    } else {
                        ?>
                        <div class="etn-organizer-logo">
                            <img src="<?php echo esc_url( $etn_company_logo ); ?>" >
                        </div>
                    <?php
                    } ?>
                    <h4 class="etn-organizer-name">
                        <?php echo esc_html( get_user_meta( $value->ID, 'first_name', true ) ); ?>
                    </h4> 
                    <?php 
                    if ($email && $email_show ) { 
                        ?>
                        <div class="etn-organizer-email">
                            <span class="etn-label-name">
                                <?php echo esc_html__('Email :',  'eventin-pro' ); ?>
                            </span>
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                        </div>
                        <?php 
                    } 
                    ?>
                    <?php 
                    if (is_array( $social ) && !empty( $social ) ) { 
                        ?>
                        <div class="etn-social etn-social-style-1">
                            <!-- <span class="etn-label-name"><?php echo esc_html__('Social :',  'eventin-pro' ); ?></span> -->
                            <?php 
                                foreach ($social as $social_value) {
									// Validate and sanitize each value
									$icon = isset($social_value['icon']) && is_string($social_value['icon']) ? $social_value['icon'] : '';
									$etn_social_url = isset($social_value['etn_social_url']) ? $social_value['etn_social_url'] : '#';
									$etn_social_title = isset($social_value['etn_social_title']) ? $social_value['etn_social_title'] : '';
							
									// Generate the social class
									$etn_social_class = 'etn-' . str_replace('fab fa-', '', $icon);
									?>
									<a href="<?php echo esc_url($etn_social_url); ?>" 
										target="_blank" 
										class="<?php echo esc_attr($etn_social_class); ?>" 
										title="<?php echo esc_attr($etn_social_title); ?>" 
										aria-label="<?php echo esc_attr($etn_social_title); ?>">
										<i class="etn-icon <?php echo esc_attr($icon); ?>"></i>
									</a>
                            	<?php } ?>
                        </div>
                        <?php 
                    } 
                    ?>
                </div>
                <?php
            }
            wp_reset_postdata();
        }
        ?>
    </div>
</div>
<?php endif; ?>