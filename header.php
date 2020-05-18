<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <?php wp_head(); ?>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
</head>

<body <?php body_class( 'site' ); ?>>

  <?php wp_body_open(); ?>

  <?php if( get_field( 'banner', 'option' ) ): ?>
    <div class="site__banner"><?php the_field( 'banner', 'option' ); ?></div>
  <?php endif; ?>

  <header class="site__header" style='background-color: <?php the_field( 'header_color', 'option' ) ?>'>
    <div class="site__header__tel">Appelez-moi : <?php the_field( 'tel', 'option' ); ?></div>
    <a href="<?php echo home_url( '/' ); ?>">
      <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo">
    </a>

    <?php 
      wp_nav_menu( 
        array( 
          'theme_location' => 'main', 
          'container' => 'ul', 
          'menu_class' => 'site__header__menu' 
        ) 
      ); 
    ?>
  </header>

  <main class="site__content">