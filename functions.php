<?php 

// Clé d'API
define( 'CAPITAINE_GMAP_API_KEY', 'AIzaSyBAEgvP6uG-mq332hbWXjL1gifMIirvTDM' );


// Ajouter automatiquement le titre du site dans l'en-tête du site
add_theme_support( 'title-tag' );

// Menus
register_nav_menus( array(
  'main' => __( 'Main menu', 'capitaine' ),
) );




// Ajouter une taille d'image
add_image_size( 'gallery-thumb', 1200, 800, true );




// Scripts et styles
function capitaine_assets() {

  wp_enqueue_style( 'capitaine', get_stylesheet_uri(), array(), '1.0' );

  wp_deregister_script( 'jquery' );
  wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, '3.3.1', true );

  // Charger notre script
  wp_enqueue_script( 'capitaine', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '1.0', true );

  // Flexlider (pour le cours sur la galerie)
  wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/lib/flexslider/jquery.flexslider-min.js', array( 'jquery' ), '2.7.2', true );
  wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/lib/flexslider/flexslider.css', array(), '2.7.2' );

  // Google Maps
  if( 
    is_page_template( 'templates/google-maps.php' ) or 
    is_front_page() or 
    is_page_template( 'templates/google-maps-repeater.php' ) ) 
  {
    wp_enqueue_script( 'gmap', "https://maps.googleapis.com/maps/api/js?key=" . CAPITAINE_GMAP_API_KEY, array(), '1.0', true );
    wp_enqueue_script( 'capitaine-map', get_template_directory_uri() . '/js/map.js', array( 'gmap', 'jquery' ), '1.0', true );
  }

}
add_action( 'wp_enqueue_scripts', 'capitaine_assets' );




// Transmettre la clé à ACF (backend)
function capitaine_acf_google_map_api( $api ){
  $api['key'] = CAPITAINE_GMAP_API_KEY;
  return $api;
}
add_filter( 'acf/fields/google_map/api', 'capitaine_acf_google_map_api' );




// Custom Post Types & Taxonomies
function capitaine_register_post_types() {
  
  // Type de publication
  $labels = array(
    'name' => 'Lieux',
    'menu_name' => 'Lieux'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    'menu_position' => 5,
    'menu_icon' => 'dashicons-location',
  );

  register_post_type( 'places', $args );

}
add_action( 'init', 'capitaine_register_post_types' );