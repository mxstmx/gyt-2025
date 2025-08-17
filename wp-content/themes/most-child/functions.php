<?php
// Empfohlene Methode zum Laden von Child-Theme-Styles
add_action('wp_enqueue_scripts', 'load_child_theme_styles', 999);

function load_child_theme_styles() {
    wp_enqueue_style( 'child-theme-style', get_stylesheet_directory_uri() . '/style.css' );
}

// Erlaube das Hochladen von SVG-Dateien
function allow_svg_upload($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');

add_filter( 'etn_speaker_content_template_path', 'most_child_custom_speaker_template' );

function most_child_custom_speaker_template( $path ) {
    $custom = get_stylesheet_directory() . '/templates/speaker-grid.php';
    if ( file_exists( $custom ) ) {
        return $custom;
    }
    return $path;
}

add_action( 'after_setup_theme', function() {
    add_image_size( 'speaker-event', 1024, 512, true );
} );

add_action( 'init', function() {
    foreach ( get_post_types() as $post_type ) {
        if ( post_type_supports( $post_type, 'comments' ) ) {
            remove_post_type_support( $post_type, 'comments' );
            remove_post_type_support( $post_type, 'trackbacks' );
        }
    }
} );

add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );
add_filter( 'comments_array', '__return_empty_array', 10, 2 );
