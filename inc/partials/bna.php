<?php
  $bg = get_sub_field('background_icon');
	$content = get_sub_field('content');
  $id = get_sub_field('id');
  // $category = get_sub_field('category');
?>

<section class="flexible-bna" id="<?php echo $id; ?>">
  <h2>Patient Results</h2>
  <?php //echo $content; ?>


 <?php if( have_rows('case') ): ?>
 	<div class="cases">
 	<?php while( have_rows('case') ): the_row();
 		$category = get_sub_field('category');
 		$patient = get_sub_field('patient');
 	?>

 		<?php echo do_shortcode( '[bnacase category="' . $category . '" patient="' . $patient . '" addtags="true"]' ) ?>

 	<?php endwhile; ?>
 	</div>
 <?php endif; ?>
 <div class="more"><a href="<?php bloginfo('url'); ?>/gallery/" class="button">View More Photos</a></div>


</section>