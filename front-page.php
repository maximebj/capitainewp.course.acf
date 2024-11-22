<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();
?>

    <h1 class="site__heading"><?php the_title(); ?></h1>

    <div class="wp-content"><?php the_content(); ?></div>

    <div class="acf-map">
      <?php
      $args = array(
        'post_type' => 'places', # Slug de mon CPT Lieux
        'posts_per_page' => -1, # Tous les résultats
      );

      $my_query = new WP_Query($args);

      if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();

          $place = get_field('place');
          if ($place):
            $lat = esc_attr($place['lat']);
            $lng = esc_attr($place['lng']);
      ?>

            <div class="marker" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>">
              <h3><?php the_field('title'); ?></h3>
              <?php the_field('description'); ?>
            </div>
      <?php
          endif; # if $places

        endwhile; # WP query
      endif;
      wp_reset_postdata();
      ?>
    </div>

<?php
  endwhile;
endif;
get_footer();
?>