<?php

load_theme_textdomain('bootstrap4', TEMPLATEPATH . '/languages');

if (current_user_can('contributor') && !current_user_can('upload_files'))
	add_action('admin_init', 'allow_contributor_uploads');

function allow_contributor_uploads()
{
	$contributor = get_role('contributor');
	$contributor->add_cap('upload_files');
}

add_theme_support('post-thumbnails');

add_theme_support('title-tag');

if (!function_exists('_wp_render_title_tag')) {
	function bootstrap4_theme_slug_render_title()
	{ ?>
        <title><?php wp_title('-', true, 'right'); ?></title>
		<?php
	}

	add_action('wp_head', 'bootstrap4_theme_slug_render_title');
}

function bs4_custom_new_menu()
{
	register_nav_menu('primary', __('Primary Menu'));
}

add_action('init', 'bs4_custom_new_menu');

wp_enqueue_style('style', get_stylesheet_uri());

require_once('features/wp_bootstrap_pagination.php');

function bootstrap4_widgets_init()
{
	register_sidebar(array(
		'name' => 'Widget Sidebar',
		'id' => 'home_right_1',
		'before_widget' => '<div class="sidebar-module">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

add_action('widgets_init', 'bootstrap4_widgets_init');

require_once(get_template_directory() . "/widgets/recent_posts.php");
require_once(get_template_directory() . "/widgets/nav_menu.php");

function bootstrap4_widget_registration()
{
	unregister_widget('WP_Widget_Recent_Posts');
	register_widget('My_Recent_Posts_Widget');
	unregister_widget('WP_Nav_Menu_Widget');
	register_widget('My_Nav_Menu_Widget');
}

add_action('widgets_init', 'bootstrap4_widget_registration');

add_theme_support('infinite-scroll', array(
	'type' => 'scroll',
	'container' => 'blog-posts',
	'footer' => false,
));

function bootstrap4_estimated_reading_time()
{
	$post = get_post();
	$words = str_word_count(strip_tags($post->post_content));
	$minutes = floor($words / 120);
	$seconds = floor($words % 120 / (120 / 60));
	if (1 <= $minutes) {
		$estimated_time = $minutes . ' ' . ($minutes == 1 ? __('minute', 'bootstrap4') : __('minutes', 'bootstrap4')) . ' ' . $seconds . ' ' . ($seconds == 1 ? __('second', 'bootstrap4') : __('seconds', 'bootstrap4'));
	} else {
		$estimated_time = $seconds . ' ' . ($seconds == 1 ? __('second', 'bootstrap4') : __('seconds', 'bootstrap4'));
	}
	echo __('Reading time', 'bootstrap4') . ": " . $estimated_time;
}

function bootstrap4_timediff()
{
	printf(esc_html__('%s ago', 'bootstrap4'), human_time_diff(get_the_time('U'), current_time('timestamp')));
}

// Add settings to theme customizer
function bootstrap4_customize_register($wp_customize)
{
	$wp_customize->add_setting('disqus_id', array(
		'default' => ''
	));
	$wp_customize->add_section('bs4_section', array(
		'title' => __('Theme Settings', 'bootstrap4'),
		'priority' => 30,
	));
	$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'disqus_id',
			array(
				'label' => __('Disqus ID', 'bootstrap4'),
				'section' => 'bs4_section',
				'settings' => 'disqus_id',
				'type' => 'text'
			)
		)
	);
}

add_action('customize_register', 'bootstrap4_customize_register');

// Disqus
function disqus_identifier()
{
	echo get_post()->ID . ' ' . get_post()->guid;
}