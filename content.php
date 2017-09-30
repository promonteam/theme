<div class="blog-post">
    <h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p class="blog-post-meta"><?php the_time(get_option('date_format')); ?> <?php the_time(get_option('time_format')); ?> <?php _e('by', 'bootstrap4'); ?> <?php the_author_posts_link(); ?><?php if (has_category()) : ?> in <?php the_category(', '); ?><?php endif; ?>
        <br><?php bootstrap4_estimated_reading_time(); ?></p>
	<?php if (has_post_thumbnail()) : ?>
        <img width="100%" src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>"/><br><br>
	<?php endif; ?>
	<?php the_excerpt(); ?>
</div>