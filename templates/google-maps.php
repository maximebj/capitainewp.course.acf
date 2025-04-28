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
    $place = get_field( 'place' );

    if( $place ): 
      $lat = esc_attr( $place['lat'] );
      $lng = esc_attr( $place['lng'] );
      $zoom = esc_attr( $place['zoom'] );
  ?>
    <div class="acf-map" data-zoom="<?php echo $zoom; ?>">
      <div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>">
        <h3><?php the_field( 'title' ); ?></h3>
        <?php the_field( 'description' ); ?>
      </div>
    </div>
  <?php endif; ?>


<?php 
  endwhile; endif;
  get_footer(); 
?>