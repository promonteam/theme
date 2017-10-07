<?php

define('PROMON_ROOT', get_template_directory_uri());

add_action('wp_enqueue_scripts', 'promon_styles');

/* Add css */
if (!function_exists('promon_styles')) {
    function promon_styles() {

        wp_enqueue_style("default_style", PROMON_ROOT . "/style.css");

    }

    add_action('wp_enqueue_scripts', 'promon_styles');
}