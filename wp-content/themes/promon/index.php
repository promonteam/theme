<?php

get_header(); ?>

<!--
    INFO:
    Add 'boxed' class to body element to make the layout as boxed style.
    Example:
    <body class="boxed">
-->
<body>

<!-- Loader -->
<div class="fh5co-loader"></div>

<div id="fh5co-page">
    <section id="fh5co-header">
        <div class="container">
            <nav role="navigation">
                    <!--  lIJEVI MENI -->
                    <?php wp_nav_menu( array(
                       'theme_location' => 'header-menu',
                      'menu_class' => "pull-left left-menu " ) ); ?>


                      <!--  lOGO -->
                      <?php   if ( function_exists( 'the_custom_logo' ) ) {
                            //the_custom_logo();
                        }

                      $custom_logo_id = get_theme_mod( 'custom_logo' );
                      $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                      if ( has_custom_logo() ) {
                              echo '<h1 id="fh5co-logo">
                                        <a href="home">
                                                <img height="50" src="'. esc_url( $logo[0] ) .'" />
                                        </a>
                                     </h1>';
                      } else {
                              echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
                      }
                      ?>

                      <!--  DESNI MENI -->
                      <?php wp_nav_menu( array( 'theme_location' => 'user-menu',
                      'menu_class' => 'pull-right right-menu' ) ); ?>

            </nav>
        </div>
    </section>
    <!-- #fh5co-header -->

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

                <div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
                    <a href="<?php echo get_template_directory_uri() ?>/images/img_1.jpg" class="fh5co-project-item image-popup">
                        <img src="<?php echo get_template_directory_uri() ?>/images/img_1.jpg" alt="Image" class="img-responsive">
                        <div class="fh5co-text">
                            <h2>Beautiful Sunrise</h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
                    <a href="<?php echo get_template_directory_uri() ?>/images/img_2.jpg" class="fh5co-project-item image-popup">
                        <img src="<?php echo get_template_directory_uri() ?>/images/img_2.jpg" alt="Image" class="img-responsive">
                        <div class="fh5co-text">
                            <h2>Cute Little Dog</h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
                    <a href="<?php echo get_template_directory_uri() ?>/images/img_3.jpg" class="fh5co-project-item image-popup">
                        <img src="<?php echo get_template_directory_uri() ?>/images/img_3.jpg" alt="Image" class="img-responsive">
                        <div class="fh5co-text">
                            <h2>A Wooden Bridge</h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
                    <a href="<?php echo get_template_directory_uri() ?>/images/img_4.jpg" class="fh5co-project-item image-popup">
                        <img src="<?php echo get_template_directory_uri() ?>/images/img_4.jpg" alt="Image" class="img-responsive">
                        <div class="fh5co-text">
                            <h2>Puppy & I in the Farm</h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
                    <a href="<?php echo get_template_directory_uri() ?>/images/img_5.jpg" class="fh5co-project-item image-popup">
                        <img src="<?php echo get_template_directory_uri() ?>/images/img_5.jpg" alt="Image" class="img-responsive">
                        <div class="fh5co-text">
                            <h2>A Big Wave of the Blue Sea</h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
                    <a href="<?php echo get_template_directory_uri() ?>/images/img_6.jpg" class="fh5co-project-item image-popup">
                        <img src="<?php echo get_template_directory_uri() ?>/images/img_6.jpg" alt="Image" class="img-responsive">
                        <div class="fh5co-text">
                            <h2>Foggy Pine Trees</h2>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia..</p>
                        </div>
                    </a>
                </div>


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
                    <div class="fh5co-feature">
                        <div class="fh5co-icon">
                            <i class="icon-power"></i>
                        </div>
                        <h3>Best For Startup</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right .</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                    <div class="fh5co-feature">
                        <div class="fh5co-icon">
                            <i class="icon-flag2"></i>
                        </div>
                        <h3>Easy To Use</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right .</p>
                    </div>
                </div>
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                    <div class="fh5co-feature">
                        <div class="fh5co-icon">
                            <i class="icon-anchor"></i>
                        </div>
                        <h3>Robust In Mind</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right .</p>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                    <div class="fh5co-feature">
                        <div class="fh5co-icon">
                            <i class="icon-paragraph"></i>
                        </div>
                        <h3>Beautiful Typography</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right .</p>
                    </div>
                </div>
                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                    <div class="fh5co-feature">
                        <div class="fh5co-icon">
                            <i class="icon-umbrella"></i>
                        </div>
                        <h3>Eco Friendly</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right .</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 animate-box">
                    <div class="fh5co-feature">
                        <div class="fh5co-icon">
                            <i class="icon-toggle"></i>
                        </div>
                        <h3>Wide and Boxed</h3>
                        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right .</p>
                    </div>
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

    <footer id="fh5co-footer">
        <div class="container">
            <div class="row row-bottom-padded-md">
                <div class="col-md-3 col-sm-6 col-xs-12 animate-box">
                    <div class="fh5co-footer-widget">
                        <h3>Company</h3>
                        <ul class="fh5co-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Careers</a></li>
                            <li><a href="#">Feature Tour</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Team</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 animate-box">
                    <div class="fh5co-footer-widget">
                        <h3>Support</h3>
                        <ul class="fh5co-links">
                            <li><a href="#">Knowledge Base</a></li>
                            <li><a href="#">24/7 Call Support</a></li>
                            <li><a href="#">Video Demos</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 animate-box">
                    <div class="fh5co-footer-widget">
                        <h3>Contact Us</h3>
                        <p>
                            <a href="mailto:info@freehtml5.co">info@freehtml5.co</a> <br>
                            198 West 21th Street, <br>
                            Suite 721 New York NY 10016 <br>
                            <a href="tel:+123456789">+12 34  5677 89</a>
                        </p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 animate-box">
                    <div class="fh5co-footer-widget">
                        <h3>Follow Us</h3>
                        <ul class="fh5co-social">
                            <li><a href="#"><i class="icon-twitter"></i></a></li>
                            <li><a href="#"><i class="icon-facebook"></i></a></li>
                            <li><a href="#"><i class="icon-google-plus"></i></a></li>
                            <li><a href="#"><i class="icon-instagram"></i></a></li>
                            <li><a href="#"><i class="icon-youtube-play"></i></a></li>
                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <div class="fh5co-copyright animate-box">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="fh5co-left"><small>&copy; 2016 <a href="index.html">Guide</a> free html5. All Rights Reserved.</small></p>
                        <p class="fh5co-right"><small class="fh5co-right">Designed by <a href="http://freehtml5.co" target="_blank">FREEHTML5.co</a> Demo Images: <a href="http://unsplash.com" target="_blank">Unsplash</a></small></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- END #fh5co-footer -->
</div>
<!-- END #fh5co-page -->



<?php get_footer(); ?>
