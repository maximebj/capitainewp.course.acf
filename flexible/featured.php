<div class="menus__featured">
  <div class="menus__featured__pic">
    <?php 
      $image_id = get_sub_field( 'picture' );
      echo wp_get_attachment_image( $image_id, 'full' );
    ?>
  </div>
  <div class="menus__featured__name">
    <?php the_sub_field( 'name' ); ?>
  </div>
  <div class="menus__featured__price">
    <?php the_sub_field( 'price' ); ?>€
  </div>
</div>