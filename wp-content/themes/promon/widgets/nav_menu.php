<?php

class My_Nav_Menu_Widget extends WP_Nav_Menu_Widget
{

	public function widget($args, $instance)
	{
		$instance['title'] = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];

		if (!empty($instance['title']))
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		$menuitems = wp_get_nav_menu_items($instance['nav_menu']);
		foreach ($menuitems as $item):
			$title = $item->title;
			$link = $item->url;
			echo '<br><a href="' . $link . '">' . $title . '</a>';
		endforeach;

		echo $args['after_widget'];
	}

}
