<?php
function add_theme_scripts() {
    wp_enqueue_style( 'animate.css', get_template_directory_uri() . '/css/animate.css', array(), '1.1', 'all');
    wp_enqueue_style( 'flexslider.css', get_template_directory_uri() . '/css/flexslider.css', array(), '1.1', 'all');
    wp_enqueue_style( 'icomoon.css', get_template_directory_uri() . '/css/icomoon.css', array(), '1.1', 'all');
    wp_enqueue_style( 'magnific-popup.css', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1.1', 'all');
    wp_enqueue_style( 'bootstrap.min.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.1', 'all');
    wp_enqueue_style( 'style.css', get_template_directory_uri() . '/css/style.css', array(), '1.1', 'all');
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );
 ?>
