<?php
/*
  Template Name: Formulaire en front inscription
*/
  acf_form_head(); // Initialiser le formulaire ACF
  get_header();
  if( have_posts() ): while( have_posts() ): the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="wp-content"><?php the_content(); ?></div>

  <?php 
    $args = array(
      'post_id' => 'new_post', // On va créer une nouvelle publication
      'new_post' => array(
        'post_type'   => 'annuaire', // Enregistrer dans l'annuaire
        'post_status' => 'draft', // Enregistrer en brouillon
      ),
      'field_groups' => array( 329 ), // L'ID du post du groupe de champs
      'submit_value' => 'Valider mon inscription', // Intitulé du bouton
      'updated_message' => "Votre demande a bien été prise en compte.",
    );

    acf_form( $args ); // Afficher le formulaire
  ?>

<?php 
  endwhile; endif;
  get_footer(); 
?>