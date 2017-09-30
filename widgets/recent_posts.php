<?php

class My_Recent_Posts_Widget extends WP_Widget_Recent_Posts
{
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		if (empty($instance['number']) || !$number = absint($instance['number']))
			$number = 5;
		$r = new WP_Query(apply_filters('widget_posts_args', array('posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true)));
		if ($r->have_posts()) :
			echo $before_widget;
			if ($title) echo $before_title . $title . $after_title; ?>
			<?php while ($r->have_posts()) : $r->the_post(); ?>
            <br>
			<?php get_template_part('content', 'small'); ?>
		<?php endwhile; ?>
			<?php
			echo $after_widget;
			wp_reset_postdata();
		endif;
	}
}
