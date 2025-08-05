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
