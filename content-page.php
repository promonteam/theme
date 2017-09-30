<div class="blog-post">
    <h2 class="blog-post-title"><?php the_title(); ?></h2>
    <p class="blog-post-meta"><?php the_time(get_option('date_format')); ?> <?php the_time(get_option('time_format')); ?>
        by <?php the_author_posts_link(); ?><?php if (has_category()) : ?> in <?php the_category(', '); ?><?php endif; ?>
		<?php the_tags('<br>' . __('Tags', 'bootstrap4') . ': <span class="tag tag-pill tag-primary">', '</span> <span class="tag tag-pill tag-primary">', '</span>'); ?></p>
	<?php if (has_post_thumbnail()) : ?>
        <img width="100%" src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>"/><br><br>
	<?php endif; ?>
	<?php the_content(); ?>
</div>
<?php comments_template(); ?>