<div class="col-sm-3 offset-sm-1 blog-sidebar">
    <div class="sidebar-module">
        <b><a href="<?php echo get_home_url(); ?>">Home</a></b>
		<?php
		if (has_nav_menu('primary')) {
			$menu_name = 'primary';
			$locations = get_nav_menu_locations();
			$menu = wp_get_nav_menu_object($locations[$menu_name]);
			$menuitems = wp_get_nav_menu_items($menu->term_id);
			foreach ($menuitems as $item):
				$title = $item->title;
				$link = $item->url;
				echo '<br><b><a href="' . $link . '">' . $title . '</a></b>';
			endforeach;
		} ?>
    </div>
	<?php if (is_active_sidebar('home_right_1')) : ?>
		<?php dynamic_sidebar('home_right_1'); ?>
	<?php endif; ?>
</div>