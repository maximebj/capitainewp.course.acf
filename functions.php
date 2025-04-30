<?php

# Clé d'API (pour la Google Maps)
define('CAPITAINE_GMAP_API_KEY', 'AIzaSyBp_sQ0r0ozy4v-SKxbbos0jc2TIo3AgWQ');

# Initialisation du thème
function capitaine_setup_theme()
{
  # Menus
  register_nav_menus(array(
    'main' => __('Main menu', 'capitaine'),
  ));

  # Activer les images mises en avant
  add_theme_support('post-thumbnails');
}
add_action('init', 'capitaine_setup_theme');




# Scripts et styles
function capitaine_assets()
{

  wp_enqueue_style('capitaine', get_stylesheet_uri(), array(), '1.0');

  wp_deregister_script('jquery');
  wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, '3.3.1', true);

  # Flexlider (pour le cours sur la galerie)
  wp_enqueue_script('flexslider', get_template_directory_uri() . '/lib/flexslider/jquery.flexslider-min.js', array('jquery'), '2.7.2', true);
  wp_enqueue_style('flexslider', get_template_directory_uri() . '/lib/flexslider/flexslider.css', array(), '2.7.2');

  # Charger notre script
  wp_enqueue_script('capitaine', get_template_directory_uri() . '/js/script.js', array('jquery', 'flexslider'), '1.0', true);

  # Google Maps
  if (
    is_page_template('templates/google-maps.php') or
    is_front_page() or
    is_page_template('templates/google-maps-repeater.php')
  ) {
    wp_enqueue_script('gmap', "https://maps.googleapis.com/maps/api/js?key=" . CAPITAINE_GMAP_API_KEY, array(), '1.0', true);
    wp_enqueue_script('capitaine-map', get_template_directory_uri() . '/js/map.js', array('gmap', 'jquery'), '1.0', true);
  }
}
add_action('wp_enqueue_scripts', 'capitaine_assets');




# Transmettre la clé à ACF (backend)
function capitaine_acf_google_map_api($api)
{
  $api['key'] = CAPITAINE_GMAP_API_KEY;
  return $api;
}
add_filter('acf/fields/google_map/api', 'capitaine_acf_google_map_api');




# Custom Post Types & Taxonomies
function capitaine_register_post_types()
{

  # Lieux (pour la Google Maps)
  $labels = array(
    'name' => 'Lieux',
    'menu_name' => 'Lieux'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_position' => 5,
    'menu_icon' => 'dashicons-location',
  );

  register_post_type('places', $args);


  # Agences (pour le champ Relationnel)
  $labels = array(
    'name' => 'Agences de voyage',
    'menu_name' => 'Agences'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_position' => 6,
    'menu_icon' => 'dashicons-store',
  );

  register_post_type('agence', $args);

  # Destinations (pour le champ Relationnel)
  $labels = array(
    'name' => 'Destinations',
    'menu_name' => 'Destinations'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_position' => 7,
    'menu_icon' => 'dashicons-palmtree',
  );

  register_post_type('destination', $args);

  # Annuaire (pour l'exemple ACF en front)
  $labels = array(
    'name' => 'Annuaire',
    'menu_name' => 'Annuaire'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_position' => 7,
    'menu_icon' => 'dashicons-id-alt',
  );

  register_post_type('annuaire', $args);

  # Jeux vidéos (pour l'exemple Hooks ACF)
  $labels = array(
    'name' => 'Jeux vidéo',
    'menu_name' => 'Jeux vidéo'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'show_in_rest' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_position' => 7,
    'menu_icon' => 'dashicons-games',
  );

  register_post_type('games', $args);
}
add_action('init', 'capitaine_register_post_types');


# Pages d'options
function capitaine_register_acf_options_pages()
{
  if (!function_exists('acf_add_options_page')) {
    return;
  }

  # Page d'options principale
  acf_add_options_page(array(
    'page_title'   => 'Options du thème',
    'menu_title'  => 'Options',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false,
    'position'    => 2
  ));

  # Sous-page pour les couleurs
  acf_add_options_sub_page(array(
    'page_title'   => 'Couleurs du thème',
    'menu_title'  => 'Couleurs',
    'parent_slug'  => 'theme-general-settings',
  ));
}
add_action('acf/init', 'capitaine_register_acf_options_pages');



# CSS dans l'interface d'administration
function capitaine_admin_style($hook)
{

  # var_dump( $hook );
  # var_dump( get_current_screen() );

  if ($hook == 'post.php') {
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/css/admin.css');
  }
}
add_action('admin_enqueue_scripts', 'capitaine_admin_style');




# Ajouter des Widgets (pour le cours Assigner des champs aux taxonomies et utilisateurs)
function capitaine_widgets_init()
{
  register_sidebar(array(
    'name'          => __('Main Sidebar', 'textdomain'),
    'id'            => 'sidebar-1',
    'description'   => __('Widgets in this area will be shown on all posts and pages.', 'textdomain'),
    'before_widget' => '<li id="%1$s" class="widget %2$s">',
    'after_widget'  => '</li>',
    'before_title'  => '<h2 class="widgettitle">',
    'after_title'   => '</h2>',
  ));
}
add_action('widgets_init', 'capitaine_widgets_init');




# Déclarer des blocs Gutenberg avec ACF
function capitaine_register_acf_block_types()
{
  register_block_type(__DIR__ . '/blocks/plugin');
  register_block_type(__DIR__ . '/blocks/recipe');
  register_block_type(__DIR__ . '/blocks/link-container');
}
add_action('init', 'capitaine_register_acf_block_types');



# Export JSON des champs ACF
function capitaine_acf_export_json($path)
{
  $path = get_stylesheet_directory() . '/acf-json';
  return $path;
}
add_filter('acf/settings/save_json', 'capitaine_acf_export_json');



# Hooks ACF

# Cas 1 : remplir dynamiquement les valeurs possibles d'un champ select
function capitaine_load_skills_choices($field)
{

  # On récupère la valeur du champ skills_list dans les options
  $values = get_field('skills_list', 'options');

  # On crée un tableau à partir des données : une ligne = une entrée
  $choices = explode("\r\n", $values);

  # On assigne les choix au champ
  $field['choices'] = $choices;

  # On retourne la donnée
  return $field;
}
add_filter('acf/load_field/name=skills', 'capitaine_load_skills_choices');

# Cas 2 : modifier la WP Query du champ relationnel afin de filtrer les résultats
function capitaine_filter_games_query($args, $field, $post_id)
{

  # On ajoute des arguments à la requête
  $args['meta_query'] = array(
    array(
      'key'      => 'score',
      'value'    => 16,
      'compare' => '>=',
    )
  );

  # On renvoit les arguments modifiés
  return $args;
}

add_filter('acf/fields/relationship/query/name=best_games', 'capitaine_filter_games_query', 10, 3);


# Cas 3 : on ajoute la note après le nom d'un jeu dans le champ
function add_score_to_game_name($text, $post, $field, $post_id)
{

  # On récupère la note
  $score = get_field('score', $post->ID);

  # On l'ajoute à la suite du nom
  $text = $text . " • " . $score . "<small>/20</small>";

  # On renvoit la valeur
  return $text;
}
add_filter('acf/fields/relationship/result/name=best_games',  'add_score_to_game_name', 10, 4);
