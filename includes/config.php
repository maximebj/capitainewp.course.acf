<?php 

// Prise en charge des images mises en avant
add_theme_support( 'post-thumbnails' );

// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

// Menus
register_nav_menus( array(
  'main' => __( 'Main menu', 'capitaine' ),
) );


// Script et styles
function capitaine_assets() {

  wp_enqueue_style( 'capitaine', get_stylesheet_uri(), array(), '1.0' );

  wp_deregister_script( 'jquery' );
  wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, '3.3.1', true );

  // Charger notre script
  wp_enqueue_script( 'capitaine', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'capitaine_assets' );