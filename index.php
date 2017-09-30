<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#0275d8">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/css/bootstrap.min.css' ?>">
	<?php wp_head(); ?>
</head>
<body>
<div class="blog">
	<?php get_header(); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 blog-main">
				<?php if (is_category()) : ?>
                    <h2 class="blog-category-title"><?php single_cat_title(); ?></h2>
				<?php elseif (is_archive()) : ?>
                    <h2 class="blog-category-title"><?php the_archive_title(); ?></h2>
				<?php endif; ?>
				<?php if (have_posts()) : ?>
					<?php if (is_single()) : while (have_posts()) : the_post();
						get_template_part('content', 'single');
					endwhile; ?>
					<?php elseif (is_page()) : while (have_posts()) : the_post();
						get_template_part('content', 'page');
					endwhile; ?>
					<?php else: ?>
                        <div id="blog-posts">
							<?php while (have_posts()) : the_post();
								get_template_part('content');
							endwhile; ?>
                        </div>
						<?php get_template_part('partials/pagination'); ?>
					<?php endif; ?>
				<?php else :
					get_template_part('partials/nothingfound');
				endif; ?>
            </div>
			<?php get_sidebar(); ?>
        </div>
    </div>
	<?php get_footer(); ?>
    <script src="<?php echo get_template_directory_uri() . '/js/bootstrap.min.js' ?>"></script>
</div>
</body>
</html>