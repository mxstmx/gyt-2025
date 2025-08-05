<?php
		use Etn_Pro\Utils\Helper;

		$location_latitude  = '37.4224428';
		$location_longitude = '-122.0842467';
		$default_address    = '';

		global $wp;
		$redirect_url = home_url( $wp->request );

		$locations_html = esc_html__( 'No event location is added yet.', 'eventin-pro' );
		$locations  = Helper::get_event_location();

		$all_locations = array_filter($locations, function($value) {
		    return $value !== "Select Location";
		});

		if ( !empty( $all_locations )) {
			unset($all_locations[""]);
			$events_by_locations  = Etn_Pro\Widgets\Event_Locations\Actions\Ajax_Action::instance()->get_location_assigned_evnets( $all_locations );
		}
		else{
			$events_by_locations  = array();
		}
		
// var_dump($events_by_locations);
		if ( !empty( $events_by_locations ) ) {
			ob_start();
				foreach ( $events_by_locations as $key => $location  ) {

						$location_direction = '';

						if ( !empty( $location ) ) {
								if( !empty( $location['events'] ) ) :
									foreach( $location['events'] as $index => $event) :
										$id = $event['event_id'];
										// $address        = $event['event_location']['address'];
										$location           = get_post_meta( $id, 'etn_event_location', true );
										$address            = ! empty( $location['address'] ) ? esc_attr( $location['address'] ) : ''; 
										$location_lat       = ! empty( $location['latitude'] ) ? esc_attr( $location['latitude'] ) : ''; 
										$location_lng       = ! empty( $location['longitude'] ) ? esc_attr( $location['longitude'] ) : ''; 
										$location_direction = '';
										if ( !empty( $location_lat ) && !empty( $location_lng ) ) {
												$location_direction = wp_kses(
												    '<a href="http://maps.google.com/maps?daddr=' . $location_lat . ',' . $location_lng . '" target="_blank">' . esc_html__( 'Get Directions', 'eventin-pro' ) . '</a>',
												    array(
												        'a' => array(
												            'href' => true,
												            'target' => true,
												        ),
												    )
												);
										}
										?>
											<div class='etn-location-item etn-location-item-<?php esc_attr_e($index+1, 'eventin-pro'); ?>'>
													<div class="etn-location-item-image">
															<a href="<?php echo esc_url( get_the_permalink( $event['event_id'] ) ); ?>"><img src="<?php echo esc_url( esc_url( get_the_post_thumbnail_url( $id ) ) ); ?>" alt="<?php echo esc_html( $address); ?>"></a>
													</div>
													<div class="etn-location-item-content">
															<h3 class="etn-location-item-name">
																	<a href="<?php echo esc_url( get_the_permalink( $event['event_id'] ) ); ?>" target="_blank">
																			<?php echo esc_html( $event['event_name'] ); ?>
																	</a>
															</h3>
															<p class="etn-location-item-address">
																	<svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M7.89994 10.1463C9.27879 10.1463 10.3966 9.02855 10.3966 7.6497C10.3966 6.27085 9.27879 5.15308 7.89994 5.15308C6.5211 5.15308 5.40332 6.27085 5.40332 7.6497C5.40332 9.02855 6.5211 10.1463 7.89994 10.1463Z" stroke="#5F6A78" stroke-width="1.5"/>
																	<path d="M1.19425 6.1933C2.77065 -0.736432 13.0372 -0.72843 14.6056 6.2013C15.5258 10.2663 12.9972 13.7072 10.7806 15.8357C9.17225 17.3881 6.62761 17.3881 5.01121 15.8357C2.80266 13.7072 0.274023 10.2583 1.19425 6.1933Z" stroke="#5F6A78" stroke-width="1.5"/>
																	</svg>
																	<?php echo esc_html( $address); ?>
															</p>
															<p class="etn-location-item-direction">
																	<?php echo $location_direction; ?>
															</p>
													</div>
											</div>
										<?php
									endforeach;

								endif;
						}
				}

				$locations_html_data = ob_get_clean();

		} else {
				$msg = esc_html__( 'No events found in this location', 'eventin-pro');
		}
		if ( !empty( $locations_html_data ) ) {
				$locations_html = "<div class='etn-location-item-wrapper'><h4 class='location-area-title'>";
				$locations_html .= esc_html__('Available Event Nearby:', 'eventin-pro');
				$locations_html .=  "</h4>";
				$locations_html .= $locations_html_data;
				$locations_html .= "</div>";
		}
?>
<div class="etn_loc_address_wrap">
    <div class="etn_loc_form">
        <input id="etn_loc_address" class="etn_loc_address" type="text" name="etn_loc_address" value="<?php echo esc_attr( $default_address ); ?>" placeholder="<?php echo esc_html__('Enter address here', 'eventin-pro'); ?>">
        <!-- search result -->
        <div class="near_location"></div>
        <a href="#" id="etn_loc_my_position" class="etn_loc_my_position">
						<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M10 16.75C13.7279 16.75 16.75 13.7279 16.75 10C16.75 6.27208 13.7279 3.25 10 3.25C6.27208 3.25 3.25 6.27208 3.25 10C3.25 13.7279 6.27208 16.75 10 16.75Z" stroke="#DA1212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M9.9998 12.7C11.491 12.7 12.6998 11.4912 12.6998 10C12.6998 8.50888 11.491 7.30005 9.9998 7.30005C8.50864 7.30005 7.2998 8.50888 7.2998 10C7.2998 11.4912 8.50864 12.7 9.9998 12.7Z" stroke="#DA1212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M10 2.8V1" stroke="#DA1212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M2.8 10H1" stroke="#DA1212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M10 17.2V19" stroke="#DA1212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M17.2002 10H19.0002" stroke="#DA1212" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>

            <?php echo esc_html__('Find me', 'eventin-pro'); ?>
        </a>
        <div class="etn_button_wrapper">
            <button aria-label="<?php echo esc_html__('Search location button', 'eventin-pro'); ?>" class="button button-success etn_loc_address_search">
								<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M8.6 16.2C12.7974 16.2 16.2 12.7974 16.2 8.6C16.2 4.40264 12.7974 1 8.6 1C4.40264 1 1 4.40264 1 8.6C1 12.7974 4.40264 16.2 8.6 16.2Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M17.0004 16.9999L15.4004 15.3999" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
            </button>
        </div>
    </div>
</div>

<div class="etn_map_and_result_wrapper etn_map_loading">
		<div class="etn-location-result"><?php echo $locations_html; ?></div>
		<div class="etn-front-map" data-lat="<?php echo esc_attr( $location_latitude ); ?>" data-long="<?php echo esc_attr( $location_longitude ); ?>" data-zoom="14" data-radius="25"  data-redirect_url="<?php echo esc_url( $redirect_url ); ?>">
			<div id="etn-front-map-container"></div>
		</div>
</div>

<div class="etn_loader_wrapper">
	<div class="loder-dot dot-a"></div>
	<div class="loder-dot dot-b"></div>
	<div class="loder-dot dot-c"></div>
	<div class="loder-dot dot-d"></div>
	<div class="loder-dot dot-e"></div>
	<div class="loder-dot dot-f"></div>
	<div class="loder-dot dot-g"></div>
	<div class="loder-dot dot-h"></div>
</div>
