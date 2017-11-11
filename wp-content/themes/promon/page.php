<?php get_header(); ?>

<?php
$defaultBgImg = array("url" => "/wp-content/themes/promon/images/full_image_1.jpg");

$background_image = get_field('background_image');

if(empty($background_image)){
    $background_image = $defaultBgImg;
}
?>
		<section id="fh5co-hero" class="no-js-fullheight" style="background-image: url(<?php echo $background_image['url']; ?>" data-next="yes">
			<div class="fh5co-overlay"></div>
			<div class="container">
				<div class="fh5co-intro no-js-fullheight">
					<div class="fh5co-intro-text">

						<div class="fh5co-center-position">
							<h2 class="animate-box"><?php wp_title(); ?></h2>
							<h3 class="animate-box"><?php the_field('page_subheading'); ?></h3>

						</div>
					</div>
				</div>
			</div>
			<div class="fh5co-learn-more animate-box">
				<a href="#" class="scroll-btn">
					<span class="text">Explore more about us</span>
					<span class="arrow"><i class="icon-chevron-down"></i></span>
				</a>
			</div>
		</section>
		<!-- END #fh5co-hero -->


		<div id="fh5co-about">
			<div class="container">
        <?php
            while ( have_posts()) : the_post();
              the_content();

            endwhile;
         ?>
			</div>
		</div>

		<!-- END #fh5co-about -->
		<section id="fh5co-subscribe">
			<div class="container">

				<h3 class="animate-box"><label for="email">Subscribe to our newsletter</label></h3>
				<form action="#" method="post" class="animate-box">
					<i class="fh5co-icon icon-paper-plane"></i>
					<input type="email" class="form-control" placeholder="Enter your email" id="email" name="email">
					<input type="submit" value="Send" class="btn btn-primary">
				</form>

			</div>
		</section>
		<!-- END #fh5co-subscribe -->

		<?php get_footer(); ?>
