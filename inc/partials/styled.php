  <?php
  	$hdng = get_sub_field('heading');
  	$bg = get_sub_field('background_image');
    $content = get_sub_field('content');
    $position = get_sub_field('text_position');
    $id = get_sub_field('id');
  ?>
  <!-- Styled Content -->
    <section class="flexible-styled" id="<?php echo $id; ?>" style="background-image: url(<?php echo $bg; ?>)" data-type="background" data-speed="4">
      <div class="featured-content" data-position="<?php echo $position; ?>">
      	<?php if( $hdng ) echo '<h2>'.$hdng.'</h2>'; ?>
				<?php echo $content; ?>
      </div>
    </section>
  <!-- End Styled Content -->