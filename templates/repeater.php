<?php
/*
  Template Name: Champ Répéteur
*/

  get_header();
  if( have_posts() ): while( have_posts() ): the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="wp-content"><?php the_content(); ?></div>

  <?php if( have_rows( 'team' ) ): ?>
    <div class="team">
      <?php while( have_rows( 'team' ) ): the_row(); ?>
        <div class="team__member">
          <div class="team__member__pic">
            <?php   
              $image_id = get_sub_field( 'picture' );
              echo wp_get_attachment_image( $image_id, 'full' );
            ?>
          </div>
          <div class="team__member__data">
            <p class="team__member__name"><?php the_sub_field( 'name' ); ?></p>
            <p class="team__member__occupation"><?php the_sub_field( 'occupation' ); ?></p>
            <p class="team__member__phone"><?php the_sub_field( 'phone' ); ?></p>
            <p class="team__member__mail">
              <a href="mailto:<?php the_sub_field( 'mail' ); ?>"><?php the_sub_field( 'mail' ); ?></a></p>
          </div>
        </div> <!-- team__member -->
      <?php endwhile; ?>
    </div> <!-- team -->
  <?php endif; ?>


<?php 
  endwhile; endif;
  get_footer(); 
?>