<?php 

// Clé d'API (pour la Google Maps)
define( 'CAPITAINE_GMAP_API_KEY', 'AIzaSyBAEgvP6uG-mq332hbWXjL1gifMIirvTDM' );

// Configurations de base du thème
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

// Menus
register_nav_menus( array(
  'main' => __( 'Main menu', 'capitaine' ),
) );




// Ajouter une taille d'image
set_post_thumbnail_size( 600, 0, false );
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
  
  // Lieux (pour la Google Maps)
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


  // Agences (pour le champ Relationnel)
  $labels = array(
    'name' => 'Agences de voyage',
    'menu_name' => 'Agences'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    'menu_position' => 6,
    'menu_icon' => 'dashicons-store',
  );

  register_post_type( 'agence', $args );

  // Destinations (pour le champ Relationnel)
  $labels = array(
    'name' => 'Destinations',
    'menu_name' => 'Destinations'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    'menu_position' => 7,
    'menu_icon' => 'dashicons-palmtree',
  );

  register_post_type( 'destination', $args );

  // Annuaire (pour l'exemple ACF en front)
  $labels = array(
    'name' => 'Annuaire',
    'menu_name' => 'Annuaire'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    'menu_position' => 7,
    'menu_icon' => 'dashicons-id-alt',
  );

  register_post_type( 'annuaire', $args );

}
add_action( 'init', 'capitaine_register_post_types' );




// Pages d'options
if( function_exists( 'acf_add_options_page' ) ) {
	
	acf_add_options_page( array(
		'page_title' 	=> 'Options du thème',
		'menu_title'	=> 'Options',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
    'position'    => 2
	) );
	
	acf_add_options_sub_page( array(
		'page_title' 	=> 'Couleurs du thème',
		'menu_title'	=> 'Couleurs',
		'parent_slug'	=> 'theme-general-settings',
	) );
	
}




// CSS dans l'interface d'administration
function capitaine_admin_style( $hook ) {
  
  // var_dump( $hook );
  // var_dump( get_current_screen() );

  if( $hook == 'post.php' ) {
    wp_enqueue_style( 'admin-styles', get_template_directory_uri() . '/css/admin.css' );
  }

}
add_action( 'admin_enqueue_scripts', 'capitaine_admin_style' );




// Ajouter des Widgets (pour le cours Assigner des champs aux taxonomies et utilisateurs)
function capitaine_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Main Sidebar', 'textdomain' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
  ) );
}
add_action( 'widgets_init', 'capitaine_widgets_init' );




// Déclarer des blocs Gutenberg avec ACF
function capitaine_register_acf_block_types() {

  acf_register_block_type( array(
    'name'              => 'plugin',
    'title'             => 'Extension',
    'description'       => "Présentation d'une extension WordPress",
    'render_template'   => 'blocks/plugin.php',
    'category'          => 'formatting', // common, formatting, layout, widgets, embed
    'icon'              => 'admin-plugins', // https://developer.wordpress.org/resource/dashicons/
    'keywords'          => array( 'plugin', 'extension', 'add-on' ),
    'enqueue_assets'    => function() {
      wp_enqueue_style( 'capitaine-blocks', get_template_directory_uri() . '/css/blocks.css' );
    }
  ) );
  
  acf_register_block_type( array(
    'name'              => 'recipe',
    'title'             => 'Recette',
    'description'       => "Aperçu d'une recette",
    'render_template'   => 'blocks/recipe.php',
    'category'          => 'common',
    'icon'              => 'carrot',
    'keywords'          => array(),
    'enqueue_assets'    => function() {
      wp_enqueue_style( 'capitaine-blocks', get_template_directory_uri() . '/css/blocks.css' );
    }
  ) );
}

add_action( 'acf/init', 'capitaine_register_acf_block_types' );




// Export JSON des champs ACF
function capitaine_acf_export_json( $path ) {
  $path = get_stylesheet_directory() . '/acf-json';
  return $path;
}
add_filter( 'acf/settings/save_json', 'capitaine_acf_export_json' );