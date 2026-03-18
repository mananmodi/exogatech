<?php

if ( ! function_exists( 'bridge_qode_child_theme_enqueue_scripts' ) ) {

	function bridge_qode_child_theme_enqueue_scripts() {
		wp_register_style('bridge-childstyle', get_stylesheet_directory_uri() . '/style.css');
		wp_enqueue_style('bridge-childstyle');

          // Enqueue custom.js file
        wp_register_script('bridge-child-custom-js', get_stylesheet_directory_uri() . '/custom.js', array('jquery'), null, true);
        wp_enqueue_script('bridge-child-custom-js');
	}

	add_action('wp_enqueue_scripts', 'bridge_qode_child_theme_enqueue_scripts', 11);
}

// Enqueue Slick Slider
function enqueue_slick_for_workshops() {
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_for_workshops');








