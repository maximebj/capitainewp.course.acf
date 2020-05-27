<?php
/*
  Template Name: Formulaire en front
*/
  acf_form_head(); // Initialiser le formulaire ACF
  get_header();
  if( have_posts() ): while( have_posts() ): the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="wp-content"><?php the_content(); ?></div>

  <p>Texte : <?php the_field( 'text' ); ?></p>
  <p>Éditeur : <?php the_field( 'editor' ); ?></p>
  <p>Couleur : <?php the_field( 'color' ); ?></p>

  <?php 
    if( current_user_can( 'publish_posts' ) ) { // Contrôle des rôles utilisateur
      acf_form(); // Le formulaire ACF
    }
  ?>

<?php 
  endwhile; endif;
  get_footer(); 
?>