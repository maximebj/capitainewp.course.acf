<?php if( have_rows( 'dishes' ) ): ?>
  <div class="menus__dishes">
    <?php while( have_rows( 'dishes' ) ): the_row(); ?>

    <div class="menus__dishes__row">
      <div class="menus__dishes__name"><?php the_sub_field( 'name' ); ?></div>
      <div class="menus__dishes__ingredients"><?php the_sub_field( 'ingredients' ); ?></div>
      <div class="menus__dishes__price"><?php the_sub_field( 'price' ); ?>€</div>
    </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>