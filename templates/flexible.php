<?php
/*
  Template Name: Champ Flexible
*/

  get_header();
  if( have_posts() ) : while( have_posts() ) : the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="wp-content"><?php the_content(); ?></div>

  <?php if( have_rows( 'menus' ) ): ?>
    <div class="menus">
      <?php 
        while ( have_rows( 'menus' ) ) : the_row(); 
          get_template_part( 'flexible/' . get_row_layout() );
        endwhile;
      ?>
    </div> <!-- menus -->
  <?php endif; ?>

<?php 
  endwhile; endif;
  get_footer(); 
?>