<?php 
  $recipe = get_field( 'recipe' );

  if( $recipe ): 
?> 
  <div class="recipe">
    <div class="recipe__image">
      <?php echo get_the_post_thumbnail( $recipe, 'large' ); ?>
    </div>
    <div class="recipe__content">
      <p class="recipe__title"><?php echo get_the_title( $recipe ); ?></p>
      <p><?php echo get_the_excerpt( $recipe ); ?></p>
      <p><a href="<?php echo get_the_permalink( $recipe ); ?>">Découvrir la recette</a></p>
    </div>
  </div>
<?php elseif( is_admin() ): ?>
  <div class="recipe">
    <em>Choisissez une recette dans la colonne de droite.</em>
  </div>
<?php endif; ?>