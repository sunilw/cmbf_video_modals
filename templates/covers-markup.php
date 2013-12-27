<?php

//
// this loop creates our links
//

$args = array(
  'post_type' => 'videos',
  'posts_per_page' => 10
) ;

$my_query = new WP_Query($args) ;


if ($my_query->have_posts()) : ?>
<?php $count = 1  ?>
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
?>
