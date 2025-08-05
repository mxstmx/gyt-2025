<?php

defined( 'ABSPATH' ) || exit;

global $wp;
$redirect_url = home_url( $wp->request );

$location            = get_post_meta( $single_event_id, 'etn_event_location', true );
$latitudes           = ! empty( $location['latitude'] ) ? $location['latitude'] : '';
$longitudes          = ! empty( $location['longitude'] ) ? $location['longitude'] : '';
$address             = ! empty( $location['address'] ) ? $location['address'] : '';
$google_map_switch   = etn_get_option( 'etn_googlemap_api' );
$google_map_api_key  = etn_get_option( 'google_api_key' );

?>
<?php if ( 
    $latitudes && 
    $longitudes && 
    'on' === $google_map_switch && 
    $google_map_api_key ): ?>
<h4 class="etn-locations-title">
    <?php 
    $location_title = apply_filters( 'etn_event_location_title', esc_html__('Venue Info', 'eventin-pro') ); 
    echo esc_html( $location_title );
    ?>
</h4>
<?php ob_start(); ?>
<div class='etn-single-location-item  etn-location-item'>
    <div class="etn-single-location-item-content">
        <p class="etn-location-item-address">
            <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.89994 10.1463C9.27879 10.1463 10.3966 9.02855 10.3966 7.6497C10.3966 6.27085 9.27879 5.15308 7.89994 5.15308C6.5211 5.15308 5.40332 6.27085 5.40332 7.6497C5.40332 9.02855 6.5211 10.1463 7.89994 10.1463Z" stroke="#5F6A78" stroke-width="1.5"/>
                <path d="M1.19425 6.1933C2.77065 -0.736432 13.0372 -0.72843 14.6056 6.2013C15.5258 10.2663 12.9972 13.7072 10.7806 15.8357C9.17225 17.3881 6.62761 17.3881 5.01121 15.8357C2.80266 13.7072 0.274023 10.2583 1.19425 6.1933Z" stroke="#5F6A78" stroke-width="1.5"/>
                </svg>
            <span class="etn-location-text"><?php echo esc_html( $address ); ?></span>
        </p>
        <a href="http://maps.google.com/maps?q=<?php echo esc_attr($latitudes); ?>,<?php echo esc_attr($longitudes); ?>" class="etn-btn etn-primary view-map-button" target="_blank"><?php echo esc_html__('View on Map', 'eventin-pro'); ?></a>
    </div>
</div>
                
<?php
$locations_html_data = ob_get_clean(); 

if ( ! empty( $locations_html_data ) ) {
    $locations_html = "<div class='etn-location-item-wrapper'>";
    $locations_html .= $locations_html_data;
    $locations_html .= "</div>";
}
?>

<div class="etn_single_event_map_and_result_wrapper etn_map_at_content">
    <div class="etn-location-result"><?php echo $locations_html; ?></div>
    <div 
        class="etn-front-map" 
        data-lat="<?php echo esc_attr( $latitudes ); ?>" 
        data-long="<?php echo esc_attr( $longitudes ); ?>" 
        data-zoom="16" 
        data-radius="25" 
        data-redirect_url="<?php echo esc_url( $redirect_url ); ?>"
    >
        <div id="etn-front-map-container"></div>
    </div>
</div>
<?php endif; ?>
