<?php 
  get_header();
  if( have_posts() ) : while( have_posts() ) : the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <?php the_post_thumbnail( 'gallery-thumb' ); ?>

  <div class="wp-content"><?php the_content(); ?></div>


  <h2>Ces agences proposent des voyages vers cette destination</h2>
  
  <?php
    $agencies = get_posts( array(
      'post_type' => 'agence', // Le CPT agence
      'meta_query' => array(
        array(
          'key' => 'destinations', // Nom du champ relationnel
          'value' => '"' . get_the_ID() . '"', // recherche exacte de l'ID
          'compare' => 'LIKE'
        )
      )
    ));

    if( $agencies ): 
  ?>
    <ul class="agencies">
      <?php foreach( $agencies as $agency ): ?>
        <li class="agencies__logo">
          <a href="<?php echo get_permalink( $agency->ID ); ?>">
            <?php echo get_the_post_thumbnail( $agency->ID, 'large' ); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
      
<?php 
  endwhile; endif;
  get_footer(); 
?>