<?php
// Enqueue child theme styles
function redmag_child_theme_styles() {
    wp_enqueue_style( 'redmag-child-theme', get_stylesheet_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'redmag_child_theme_styles', 1000 );
	