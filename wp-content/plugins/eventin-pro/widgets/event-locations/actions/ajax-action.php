<?php

namespace Etn_Pro\Widgets\Event_Locations\Actions;

use Etn_Pro\Traits\Singleton;

defined( 'ABSPATH' ) || exit;
use WP_Query;
/**
* Handle ajax request
*/
class Ajax_Action {

	use Singleton;

	/**
		* Fire ajax hook.
	*/
	public function init() {
		$callback = array( 'get_events_by_location' );
		if ( ! empty( $callback ) ) {
			foreach ( $callback as $key => $value ) {
					add_action( 'wp_ajax_'.$value ,array( $this , $value ) );
					add_action( 'wp_ajax_nopriv_'.$value ,array( $this , $value ) );
			}
		}
	}

	/**
	 * Get all event by location.
	 * Find all location filtered to lat, lng, radius
	 *
	 * @return array
	 */
  public function get_events_by_location() {
			if ( ! wp_verify_nonce( $_POST['security'], 'location_map_nonce' ) ) {
					$msg = esc_html__( 'Nonce is not valid! Please try again.', 'eventin-pro' );

					$response = array(
							'status_code'   => 403,
							'message'       => array( $msg ),
							'data'          => array(),
						);

					wp_send_json_error( $response );

			} else {
					$lat            = floatval( $_POST['lat'] );
					$lng            = floatval( $_POST['lng'] );
					$radius         = absint( $_POST['radius'] );
					$limit          = absint( $_POST['limit'] );
					$redirect_url   = esc_url_raw( $_POST['redirect_url'] );
					$all_locations  = $this->query_all_locations( $lat, $lng, $radius );

					$locations_html      = '';
					$locations_html_data = array();
					$all_events_lat_lng  = [];
					$msg = esc_html__( 'ok', 'eventin-pro' );

					if ( !empty( $all_locations ) ) {
							$loc_index = 0;
							foreach ( $all_locations as $key => $id ) {

								if ( $key >= $limit ) {
									break;
								}
								$location           = get_post_meta( $id, 'etn_event_location', true );
								$address            = ! empty( $location['address'] ) ? esc_attr( $location['address'] ) : ''; 
								$email              = get_term_meta( $id, 'location_email', true );
								$location_lat       = ! empty( $location['latitude'] ) ? esc_attr( $location['latitude'] ) : ''; 
								$location_lng       = ! empty( $location['longitude'] ) ? esc_attr( $location['longitude'] ) : ''; 
								$location_url       = $redirect_url . '?location=' . $id;
								$location_direction = '';
								if ( !empty( $location_lat ) && !empty( $location_lng ) ) {
										$location_direction = '<a href="http://maps.google.com/maps?saddr=' . $lat. ',' . $lng . '&daddr=' . $location_lat . ',' . $location_lng . '" target="_blank">' . esc_html__( 'Get Directions', 'eventin-pro' ) . '</a>';
								}

									if ( ! empty( $id ) && file_exists( ETN_PRO_DIR . "/widgets/event-locations/actions/location-markup.php" ) ) {
											$event = $id;
											ob_start();
											include ETN_PRO_DIR . "/widgets/event-locations/actions/location-markup.php";
											$locations_html_data[$loc_index] = ob_get_clean();

											$all_events_lat_lng[$loc_index] = [
												'lat' => $location_lat,
												'lng' => $location_lng,
											];
											$loc_index++;
									}
							}


					} else {
							$msg = "<p class='location-not-found'>";
							$msg .=  esc_html__( 'No event found in this location. Please try another location', 'eventin-pro');
							$msg .= "</p>";
					}

					if ( !empty( $locations_html_data ) ) {
							$locations_html = "<div class='etn-location-item-wrapper'><h4 class='location-area-title'>";
							$locations_html .= esc_html__( 'Nearby Events:', 'eventin-pro' );
							$locations_html .=  "</h4>";
							$locations_html .= join( '', $locations_html_data );;
							$locations_html .= "</div>";
					}

					$response = [
							'status_code'   => 200,
							'message'       => [ $msg ],
							'data'          => [
									'locations'             => $all_locations,
									'locations_html'        => $locations_html,
									'locations_html_data'   => $locations_html_data,
									'all_events_lat_lng'    => $all_events_lat_lng,
							]
					];
					wp_send_json_success( $response );
			}

			exit;
	}

	/**
	 * helper function to db query to get locations
	 *
	 * @param [float] $lat
	 * @param [float] $lng
	 * @param [int] $radius
	 * @return array
	 */
		public function query_all_locations( $lat, $lng, $radius ) {
			global $wpdb;
		
			// Define the latitude and longitude range
			$lat_min = $lat - 2;
			$lat_max = $lat + 2;
			$lng_min = $lng - 2;
			$lng_max = $lng + 2;
		
			// Fetch all published 'etn' post type IDs that have 'etn_event_location'
			$args = [
				'post_type'  => 'etn',
				'post_status' => 'publish',
				'meta_query' => [
					[
						'key'     => 'etn_event_location',
						'compare' => 'EXISTS',
					],
				],
				'fields' => 'ids',
				'posts_per_page' => -1
			];
		
			$query = new WP_Query( $args );
			$filtered_post_ids = [];
		
			// Filter posts based on latitude and longitude values
			foreach ( $query->posts as $post_id ) {
				$location = get_post_meta($post_id, 'etn_event_location', true);
		
				if ( is_array( $location ) && ! empty( $location['latitude'] ) && ! empty( $location['longitude'] ) ) {
					// Check if latitude and longitude are within the range
					if ($location['latitude'] >= $lat_min && $location['latitude'] <= $lat_max &&
						$location['longitude'] >= $lng_min && $location['longitude'] <= $lng_max) {
						$filtered_post_ids[] = $post_id;
					}
				}
			}
		
			return $filtered_post_ids;
		}

	/**
	* Get all events by location
	** Abandoned function: only kept to check if it's used in any theme or plugin
	* The function is deprecated from Eventin PRO release 4.0.22
	*/
	public function get_evenst_by_loication( $locations ) {
		$result_data = array();
		if ( ! empty( $locations ) ) {
			foreach ( $locations as $index => $value ) {
				$term_id = is_object( $value ) ? $value->term_id : $index;
				if ( is_object( $value ) ) {
					$term_id    = $value->term_id;
					$term_name  = $value->name;
				}
				else{
					$term_id    = $index;
					$term_name  = $value;
				}


				$args = array(
					'post_type' => 'etn',
					'tax_query' => array(
						array(
									'taxonomy'  => 'etn_location',
									'field'     => 'term_id',
									'terms'     => $term_id,
							),
						),
					);

				$get_events = get_posts( $args );

				if ( count( $get_events )>0 ) {
					$events_by_location = array();
					foreach ( $get_events as $key => $event ){
						$events_by_location[ $key ][ 'event_id' ]     = $event->ID;
						$events_by_location[ $key ][ 'event_name' ]   = $event->post_title;
					}

					$result_data[ $index ][ 'events' ] = $events_by_location;
				}
				else{
					$result_data[ $index ][ 'events' ] = array();
				}
				$result_data[ $index ][ 'location_id' ]   = $term_id;
				$result_data[ $index ][ 'location_name' ] = $term_name;
			}

		}

		return $result_data;
	}

	/**
	* Get all events by location
	*/
	public function get_location_assigned_evnets( $locations ) {

		$result_data = array();
		if ( ! empty( $locations ) ) {
			foreach ( $locations as $index => $value ) {
				$args = array(
					'post_type' => 'etn',
					'meta_query' => array(
				        array(
				            'key'     => 'etn_event_location',
				            'value'   => '"' . $value . '"',
				            'compare' => 'LIKE',
				        ),
				    ),
				);

				$get_events = get_posts( $args );

				if ( count( $get_events )>0 ) {
					$events_by_location = array();
					foreach ( $get_events as $key => $event ){
						$events_by_location[ $key ][ 'event_id' ]     = $event->ID;
						$events_by_location[ $key ][ 'event_name' ]   = $event->post_title;
						$events_by_location[ $key ][ 'event_location' ]   = $event->etn_event_location;
					}

					$result_data[ $index ][ 'events' ] = $events_by_location;
				}
				else{
					$result_data[ $index ][ 'events' ] = array();
				}
				$result_data[ $index ][ 'location_id' ]   = $index;
				$result_data[ $index ][ 'location_name' ] = $value;
			}

		}

		return $result_data;
	}

}
