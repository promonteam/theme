<div>
	<?php if (has_post_thumbnail()) : ?>
        <img width="100%" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>"/><br>
	<?php endif; ?>
    <b><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></b>
    <br><?php bootstrap4_timediff(); ?>
</div>