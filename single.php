<?php
  get_header();
  if (have_posts()) : while (have_posts()) : the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="wp-content"><?php the_content(); ?></div>

  <?php
  $posts = get_field('related');

  if ($posts) :
  ?>
    <h2>Vous aimerez aussi</h2>
    <ul class="related">
      <?php
      foreach ($posts as $post) : # Le nom $post est IMPORTANT
        setup_postdata($post); # Initialiser les données (comme la boucle WP)
      ?>
        <li class="related__post">
          <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('gallery-thumb'); ?>
            <h3><?php the_title(); ?></h3>
            <p>Préparation : <?php the_field('duration'); ?></p>
          </a>
        </li>
      <?php
      endforeach;
      wp_reset_postdata(); # IMPORTANT - réinitialise $post pour que le reste de la page fonctionne correctement
      ?>
    </ul>
  <?php endif; ?>

<?php
    endwhile;
  endif;
  get_footer();
?>