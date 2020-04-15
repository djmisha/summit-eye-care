<!-- Related Posts on Pages -->

<?php
  global $post;
  $custom_fields = get_post_custom($post->ID);
  if(isset($custom_fields['relatedMetaBox'])) {
    $my_custom_field = $custom_fields['relatedMetaBox'];
  }

  if (isset($my_custom_field )):
    echo '<div class="sidebar-block related-block">';
    foreach ( $my_custom_field as $key => $value )
    if (isset($my_custom_field)) {
      echo "<div class='hdng'>Related Posts</div>";
    }
    $args = array(
        'post_type' => 'post',
        'category__and' => array( $value ),
        'posts_per_page' => 3
    );
    // the query
    $the_query = new WP_Query( $args );
?>
    <ul>
    <?php if ( $the_query->have_posts() ) : ?>
      <!-- the loop -->
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <!-- <a href="<?php //the_permalink(); ?>">Read More</a> -->
        </li>
      <?php endwhile; ?>
      <!-- end of the loop -->
      <?php wp_reset_postdata(); ?>
    <?php else: endif; ?>
  </ul>
</div>
<?php endif; ?>
<!-- End Related Posts -->