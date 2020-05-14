<?php 
  get_header();
  if( have_posts() ) : while( have_posts() ) : the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="agency">
    <div class="agency__logo">
      <?php the_post_thumbnail( 'large' ); ?>
    </div>
    <div class="agency__description">
      <?php the_content(); ?>
    </div>
  </div>

  <?php 
    $posts = get_field( 'destinations' );

    if( $posts ): 
  ?>
    <h2>Nos destinations</h2>
    <ul class="destinations">
      <?php 
        foreach( $posts as $post ): // Le nom $post est IMPORTANT
          setup_postdata( $post ); // Initialiser les données (comme la boucle WP)
      ?>
        <li class="destinations__trip">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'gallery-thumb' ); ?>
            <h3><?php the_title(); ?></h3>
          </a>
        </li>
      <?php 
        endforeach; 
        wp_reset_postdata(); // IMPORTANT - réinitialise $post pour que le reste de la page fonctionne correctement
      ?>
    </ul>
  <?php endif; ?>


<?php 
  endwhile; endif;
  get_footer(); 
?>