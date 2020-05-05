<?php
/*
  Template Name: Champ Google Maps
*/

  get_header();
  if( have_posts() ) : while( have_posts() ) : the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="wp-content"><?php the_content(); ?></div>


<?php 
  endwhile; endif;
  get_footer(); 
?>