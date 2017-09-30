<?php
/**
 * WordPress Bootstrap Pagination
 */

function wp_bootstrap_pagination($args = array())
{

	$defaults = array(
		'range' => 4,
		'custom_query' => FALSE,
		'previous_string' => __('Newer', 'bootstrap4'),
		'next_string' => __('Older', 'bootstrap4'),
		'before_output' => '<nav class="blog-pagination">',
		'after_output' => '</nav>'
	);

	$args = wp_parse_args(
		$args,
		apply_filters('wp_bootstrap_pagination_defaults', $defaults)
	);

	$args['range'] = (int)$args['range'] - 1;
	if (!$args['custom_query'])
		$args['custom_query'] = @$GLOBALS['wp_query'];
	$count = (int)$args['custom_query']->max_num_pages;
	$page = intval(get_query_var('paged'));

	if ($count <= 1)
		return FALSE;

	if (!$page)
		$page = 1;

	$echo = '';
	$previous = intval($page) - 1;
	$previous = esc_attr(get_pagenum_link($previous));
	if ($previous && (1 != $page))
		$echo .= '<a class="btn btn-outline-primary" href="' . $previous . '">' . $args['previous_string'] . '</a> ';
	$next = intval($page) + 1;
	$next = esc_attr(get_pagenum_link($next));
	if ($next && ($count != $page))
		$echo .= '<a class="btn btn-outline-primary" href="' . $next . '">' . $args['next_string'] . '</a>';
	if (isset($echo))
		echo $args['before_output'] . $echo . $args['after_output'];
}
