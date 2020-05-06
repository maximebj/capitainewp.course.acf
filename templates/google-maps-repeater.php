<?php
/*
  Template Name: Champ Google Maps + Répéteur
*/

  get_header();
  if( have_posts() ) : while( have_posts() ) : the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="wp-content"><?php the_content(); ?></div>

  <?php if( have_rows('places') ): ?>
    <div class="acf-map">
      <?php 
        while ( have_rows('places') ) : the_row(); 
          $place = get_sub_field( 'place' );
          if( $place ): 
            $lat = esc_attr( $place['lat'] );
            $lng = esc_attr( $place['lng'] );
      ?>
        <div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>">
        </div>
      <?php 
          endif;
        endwhile; 
      ?>
    </div>
  <?php endif; ?>

<?php 
  endwhile; endif;
  get_footer(); 
?>