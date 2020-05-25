<?php
/*
  Template Name: Add-ons ACF
*/

  get_header();
  if( have_posts() ): while( have_posts() ): the_post();
?>

  <h1 class="site__heading"><?php the_title(); ?></h1>

  <div class="wp-content"><?php the_content(); ?></div>

  <p><?php the_field( 'icon' ); ?> Mon picto !</p>

  <?php 
    $table = get_field( 'table' );

    if ( ! empty ( $table ) ) {
      echo '<table border="0">';
      
      if ( ! empty( $table['caption'] ) ) {
        echo '<caption>' . $table['caption'] . '</caption>';
      }

      if ( ! empty( $table['header'] ) ) {
        echo '<thead>';
        echo '<tr>';
        foreach ( $table['header'] as $th ) {
          echo '<th>';
          echo $th['c'];
          echo '</th>';
        }
        echo '</tr>';
        echo '</thead>';
      }
      echo '<tbody>';
      foreach ( $table['body'] as $tr ) {
        echo '<tr>';
        foreach ( $tr as $td ) {
          echo '<td>';
          echo $td['c'];
          echo '</td>';
        }
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    }
  ?>

<?php 
  endwhile; endif;
  get_footer(); 
?>