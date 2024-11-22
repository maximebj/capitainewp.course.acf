<?php 
  get_header();
  if( have_posts() ) : while( have_posts() ) : the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <?php the_post_thumbnail( 'gallery-thumb' ); ?>

  <div class="wp-content"><?php the_content(); ?></div>


  <h2>Ces agences proposent des voyages vers cette destination</h2>
  
  <?php
    $args = array(
      'post_type' => 'agence', # Le CPT agence
      'meta_query' => array(
        array(
          'key' => 'destinations', # Nom du champ relationnel
          'value' => '"' . get_the_ID() . '"', # recherche exacte de l'ID
          'compare' => 'LIKE'
        )
      )
    );

    $agencies = new WP_Query( $args );
    if( $agencies->have_posts() ): 
  ?>
    <ul class="agencies">
      <?php while( $agencies->have_posts() ): $agencies->the_post(); ?>
        <li class="agencies__logo">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'large' ); ?>
          </a>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php 
    endif;
    wp_reset_postdata(); 
  ?>
      
<?php 
  endwhile; endif;
  get_footer(); 
?>