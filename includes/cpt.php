<?php

// Custom Post Types & Taxonomies
function capitaine_register_post_types() {
  
  // Type de publication
  $labels = array(
    'name' => __( 'Lieux', 'capitaine' ),
    'menu_name' => __( 'Lieux', 'capitaine' )
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

  register_post_type( 'portfolio', $args );

}
add_action( 'init', 'capitaine_register_post_types' );