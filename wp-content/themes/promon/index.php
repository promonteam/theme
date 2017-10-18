<?php

get_header(); ?>

    <section id="fh5co-hero" class="js-fullheight" style="background-image: url(<?php echo get_template_directory_uri() ?>/images/hero_bg.jpg);" data-next="yes">
        <div class="fh5co-overlay"></div>
        <div class="container">
            <div class="fh5co-intro js-fullheight">
                <div class="fh5co-intro-text">
                    <!--
                        INFO:
                        Change the class to 'fh5co-right-position' or 'fh5co-center-position' to change the layout position
                        Example:
                        <div class="fh5co-right-position">
                    -->
                    <div class="fh5co-left-position">
                        <h2 class="animate-box">Create Awesome Things for Better Web</h2>
                        <p class="animate-box"><a href="https://vimeo.com/channels/staffpicks/93951774" class="btn btn-outline popup-vimeo btn-video"><i class="icon-play2"></i> Watch video</a> <a href="http://freehtml5.co" target="_blank" class="btn btn-primary">Visit FREEHTML5.co</a></p>
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


    <section id="fh5co-projects">
        <div class="container">
            <div class="row row-bottom-padded-md">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2 class="fh5co-lead animate-box">Our Products</h2>
                    <p class="fh5co-sub-lead animate-box">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                </div>
            </div>

            <div class="row">
               <?php
                $args = array(
                  'post_type' => 'post'
                );
                $post_query = new WP_Query($args);
                if($post_query->have_posts() ) {
                  while($post_query->have_posts() ) {
                    $post_query->the_post();
                ?>
                <div class="col-md-4 col-sm-12 col-xxs-12 animate-box">

                    <a href="<?php the_post_thumbnail_url('large');?>" class="fh5co-project-item image-popup">
                        <img width="100%" src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>"/>
                        <div class="fh5co-text">
                          <h2><?php the_title(); ?></h2>
                          <?php the_content(); ?>
                        </div>
                    </a>
                </div>
                <?php
                      }
                  }
                ?>
            </div>
        </div>
    </section>
    <!-- END #fh5co-projects -->

    <section id="fh5co-features">
        <div class="container">
            <div class="row text-center row-bottom-padded-md">
                <div class="col-md-8 col-md-offset-2">
                    <figure class="fh5co-devices animate-box"><img src="<?php echo get_template_directory_uri() ?>/images/img_devices.png" alt="Free HTML5 Bootstrap Template" class="img-responsive"></figure>
                    <h2 class="fh5co-lead animate-box">Perfect Display in All Devices</h2>
                    <p class="fh5co-sub-lead animate-box">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                        <?php if(is_active_sidebar('box1')): ?>
                        <?php dynamic_sidebar('box1'); ?>
                        <?php endif; ?>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                        <?php if(is_active_sidebar('box2')): ?>
                        <?php dynamic_sidebar('box2'); ?>
                        <?php endif; ?>
                </div>
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                        <?php if(is_active_sidebar('box3')): ?>
                        <?php dynamic_sidebar('box3'); ?>
                        <?php endif; ?>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                        <?php if(is_active_sidebar('box4')): ?>
                        <?php dynamic_sidebar('box4'); ?>
                        <?php endif; ?>
                </div>
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                        <?php if(is_active_sidebar('box5')): ?>
                        <?php dynamic_sidebar('box5'); ?>
                        <?php endif; ?>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                        <?php if(is_active_sidebar('box6')): ?>
                        <?php dynamic_sidebar('box6'); ?>
                        <?php endif; ?>
                </div>
                <div class="clearfix visible-sm-block"></div>
            </div>
        </div>
    </section>

    <!-- END #fh5co-features -->


    <section id="fh5co-features-2">
        <div class="container">
            <div class="col-md-6 col-md-push-6">
                <figure class="fh5co-feature-image animate-box">
                    <img src="<?php echo get_template_directory_uri() ?>/images/macbook.png" alt="Free HTML5 Bootstrap Template by FREEHTML5.co">
                </figure>
            </div>
            <div class="col-md-6 col-md-pull-6">
                <span class="fh5co-label animate-box">See Features</span>
                <h2 class="fh5co-lead animate-box">Superb Features</h2>
                <div class="fh5co-feature">
                    <div class="fh5co-icon animate-box"><i class="icon-check2"></i></div>
                    <div class="fh5co-text animate-box">
                        <h3>Beautiful Typography</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                    </div>
                </div>
                <div class="fh5co-feature">
                    <div class="fh5co-icon animate-box"><i class="icon-check2"></i></div>
                    <div class="fh5co-text animate-box">
                        <h3>Eco Friendly</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                    </div>
                </div>
                <div class="fh5co-feature">
                    <div class="fh5co-icon animate-box"><i class="icon-check2"></i></div>
                    <div class="fh5co-text animate-box">
                        <h3>Wide and Boxed</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
                    </div>
                </div>

                <div class="fh5co-btn-action animate-box">
                    <a href="#" class="btn btn-primary btn-cta">More Features</a>
                </div>

            </div>
        </div>
    </section>
    <!-- END #fh5co-features-2 -->

    <section id="fh5co-testimonials">
        <div class="container">
            <div class="row row-bottom-padded-sm">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="fh5co-label animate-box">Testimonials</div>
                    <h2 class="fh5co-lead animate-box">Join the 1 Million Users using Our Products </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center animate-box">
                    <div class="flexslider">
                        <ul class="slides">
                            <li>
                                <blockquote>
                                    <p>&ldquo;Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn’t really do it, they just saw something. It seemed obvious to them after a while.&rdquo;</p>
                                    <p><cite>&mdash; Steve Jobs</cite></p>
                                </blockquote>
                            </li>
                            <li>
                                <blockquote>
                                    <p>&ldquo;I think design would be better if designers were much more skeptical about its applications. If you believe in the potency of your craft, where you choose to dole it out is not something to take lightly.&rdquo;</p>
                                    <p><cite>&mdash; Frank Chimero</cite></p>
                                </blockquote>
                            </li>
                            <li>
                                <blockquote>
                                    <p>&ldquo;Design must be functional and functionality must be translated into visual aesthetics, without any reliance on gimmicks that have to be explained.&rdquo;</p>
                                    <p><cite>&mdash; Ferdinand A. Porsche</cite></p>
                                </blockquote>
                            </li>
                        </ul>
                    </div>
                    <div class="flexslider-controls">
                        <ol class="flex-control-nav">
                            <li class="animate-box"><img src="<?php echo get_template_directory_uri() ?>/images/person4.jpg" alt="Free HTML5 Bootstrap Template by FREEHTML5.co"></li>
                            <li class="animate-box"><img src="<?php echo get_template_directory_uri() ?>/images/person2.jpg" alt="Free HTML5 Bootstrap Template by FREEHTML5.co"></li>
                            <li class="animate-box"><img src="<?php echo get_template_directory_uri() ?>/images/person3.jpg" alt="Free HTML5 Bootstrap Template by FREEHTML5.co"></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END #fh5co-testimonials -->

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
