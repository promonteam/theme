<?php
function add_theme_scripts() {
    // wp_enqueue_style( 'animate.css', get_template_directory_uri() . '/css/animate.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'flexslider.css', get_template_directory_uri() . '/css/flexslider.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'icomoon.css', get_template_directory_uri() . '/css/icomoon.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'magnific-popup.css', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'bootstrap.min.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.1', 'all');
    // wp_enqueue_style( 'style.css', get_template_directory_uri() . '/css/style.css', array(), '1.1', 'all');
}

// REGISTRING NAVIGATION MENU
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'extra-menu' => __( 'Extra Menu' ),
      'user-menu' => __('User Menu'),
      'footer-company' => __('Company Menu'),
      'footer-support' => __('Support Menu'),
    )
  );
}
add_action( 'init', 'register_my_menus' );

// CUSTOM LOGO FUNCTION
function themename_custom_logo_setup() {
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),

    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

//WIDGETS LOCATION
function wpb_init_widgets($id){
  register_sidebar(array(
    'name' => 'Box1',
    'id' => 'box1',
    'before_widget' => '<div class="fh5co-feature">',
    'after_widget' => '</div>',
    'before_title'=> '<h3>',
    'after_title' => '</h3>',
  ));

  register_sidebar(array(
    'name' => 'Box2',
    'id' => 'box2',
    'before_widget' => '<div class="fh5co-feature">',
    'after_widget' => '</div>',
    'before_title'=> '<h3>',
    'after_title' => '</h3>',
  ));

  register_sidebar(array(
    'name' => 'Box3',
    'id' => 'box3',
    'before_widget' => '<div class="fh5co-feature">',
    'after_widget' => '</div>',
    'before_title'=> '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => 'Box4',
    'id' => 'box4',
    'before_widget' => '<div class="fh5co-feature">',
    'after_widget' => '</div>',
    'before_title'=> '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => 'Box5',
    'id' => 'box5',
    'before_widget' => '<div class="fh5co-feature">',
    'after_widget' => '</div>',
    'before_title'=> '<h3>',
    'after_title' => '</h3>',
  ));
  register_sidebar(array(
    'name' => 'Box6',
    'id' => 'box6',
    'before_widget' => '<div class="fh5co-feature">',
    'after_widget' => '</div>',
    'before_title'=> '<h3>',
    'after_title' => '</h3>',
  ));
}

add_action('widgets_init','wpb_init_widgets');

add_theme_support('post-thumbnails');
