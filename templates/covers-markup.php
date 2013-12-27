<?php

//
// this loop creates our links
// with the covers.
//

$args = array(
  'post_type' => 'videos',
  'posts_per_page' => 10
) ;

$my_query = new WP_Query($args) ;


if ($my_query->have_posts()) : ?>
<?php
global $post ;
$count = 1 ;
?>
<section id="videos">
  <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <article class="video-link">

      <div class="cover">
        <a
          id="video-link-<?php echo $count ; $count++ ;   ?>"
          class="cover-link"
          href="#"
          >
          <img src="<?php echo get_post_meta($post->ID, '_cmb_video_cover', true)  ?>"
               alt="#" />
        </a>
      </div> <!-- ENDS .cover -->

    </article> <!-- ENDS .video-link -->
  <?php endwhile; wp_reset_query() ?>
</section> <!-- ENDS #videos  -->
<?php
// end our first loop
endif;


//
// A new loop begins. The markup that follows should be hidden by default
// by our css.
// The html provides markup for our modals
//
?>
<div id="modal-link-container">
  <?php
  $args = array(
    'post_type' => 'videos'
  ) ;
  $my_query = new WP_Query($args) ;  ?>
  <?php if ($my_query->have_posts()) :    ?>
    <?php $count = 1 ;  ?>

    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
      <article id="modal-<?php echo $count ; $count++ ;   ?>"
               class="modal-window"
               >
        <div class="modal-close">
          <img src="<?php echo plugins_url()  ?>/video-modals/img/x.png" class="" alt="click to close modal" />
        </div>
        <h3><?php echo  get_post_meta($post->ID, '_cmb_video_title', true) ?> </h3>
        <div>
          <?php echo   get_post_meta($post->ID, '_cmb_video_link', true)  ?>
        </div>

      </article>
    <?php endwhile;
    // now we end our second loop
    endif;
    wp_reset_query() ;
    ?>
</div>  <!-- ENDS.modal-link-container -->
