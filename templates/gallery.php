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

  <?php 
    $images = get_field( 'gallery' );
    $size = 'gallery-thumb'; // (thumbnail, medium, large, full or custom size)
    
    if( $images ): 
  ?>
    <ul class="acf-gallery">
      <?php foreach( $images as $image_id ): ?>
        <li>
          <a href="<?php echo wp_get_attachment_url( $image_id ); ?>">
            <?php echo wp_get_attachment_image( $image_id, $size ); ?>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <h2>Le diaporama</h2>

  <?php 
    $images = get_field( 'slider' );
    if( $images ): 
      //var_dump($images); 
  ?>
    <div id="slider" class="flexslider">
      <ul class="slides">
        <?php foreach( $images as $image ): ?>
          <li>
            <a href="<?php echo esc_url( $image['url'] ); ?>">
              <img src="<?php echo esc_url( $image['sizes']['gallery-thumb'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
              <p><?php echo esc_html( $image['caption'] ); ?></p>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

<?php 
  endwhile; endif;
  get_footer(); 
?>