<?php
/*
  Template Name: Champ Galerie
*/

  get_header();
  if( have_posts() ) : while( have_posts() ) : the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="wp-content"><?php the_content(); ?></div>

  <h2>La galerie simple</h2>

  ...

  <h2>Le diaporama</h2>

  ...

<?php 
  endwhile; endif;
  get_footer(); 
?>