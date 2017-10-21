<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
      <?php bloginfo('name'); echo " | " ?>
      <?php is_front_page()?bloginfo('description'):wp_title(); ?>
    </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <meta name="author" content="<?php bloginfo('admin'); ?>" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />



    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico">

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,600,400italic,700' rel='stylesheet' type='text/css'>

    <!-- Animate.css -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/stylesheets/animate.css' ?>">
    <!-- Flexslider -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/stylesheets/flexslider.css' ?>">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/stylesheets/icomoon.css' ?>">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/stylesheets/magnific-popup.css' ?>">
    <!-- Bootstrap  -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Style sheet -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/stylesheets/style.css' ?>">
    <!-- Java script-->
    <script src="<?php echo get_template_directory_uri() ?>/js/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/js/respond.min.js"></script>

    <?php wp_head(); ?>
</head>

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
                                        <a href="/">
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
