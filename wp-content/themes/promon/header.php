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
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/stylesheets/bootstrap.min.css' ?>">
    <!-- Style sheet -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() . '/stylesheets/style.css' ?>">
    <!-- Java script-->
    <script src="<?php echo get_template_directory_uri() ?>/js/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/js/respond.min.js"></script>

    <?php wp_head(); ?>
</head>
