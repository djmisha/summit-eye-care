
<?php
// Template Name: Landing Page Builder
 ?>

<?php get_header()?>
<article <?php $header_bg = get_field('header_bg'); if($header_bg): ?>
		style="background-image: url('<?php echo $header_bg; ?>');background-repeat:no-repeat;"
	<?php endif; ?> class="page-full">

<!--
	<div class="page-heading">

	</div>
 -->

<?php if( have_rows('sections')): ?>
	<?php while( have_rows('sections')): the_row();
		$bgImage = get_sub_field('background_image');
		$bgColor = get_sub_field('background_color');
		// $contain = get_sub_field('contain');
		$contain = get_sub_field('contain_width');
		if($contain) {
			$containWidth = $contain + 40 . 'px';
		}
		$classes = get_sub_field('classes');
	?>

	<section class="landing-section<?php if( $classes ) echo ' ' . $classes; ?><?php if( $contain ) echo ' landing-contain'; ?>"<?php if( $bgImage || $bgColor ) echo ' style="';
		if( $bgImage ) echo 'background-image: url(' . $bgImage . ');';
		if( $bgColor ) echo 'background-color: ' . $bgColor . ';';
		if( $bgImage || $bgColor ) echo '"'; ?>>


		<!-- Flexible Content -->

		<!-- check if the flexible content field has rows of data -->
		<?php if( class_exists('acf') ): ?>

		<?php if( have_rows('section_content') ): ?>

		<!-- loop through the rows of data -->
		  <?php while ( have_rows('section_content') ) : the_row(); ?>

		    <?php if( get_row_layout() == 'content_row' ): ?>
		      <?php require  __DIR__ . '/pagebuilder/columns.php'; ?>

		    <?php elseif( get_row_layout() == 'anchor_links' ): ?>
		      <?php require  __DIR__ . '/pagebuilder/anchors.php'; ?>

				<?php endif; ?>
		  <?php endwhile; ?>
		<!-- no layouts found -->
		  <?php else : ?>
		    <section class="basic-content">
		      <?php the_content(); ?>
		    </section>
		  <?php endif; ?>

		<?php endif; ?>
		<!-- End Flexible Content-->

	</section>
	<?php endwhile; ?>
<?php endif; ?>
</article>
<?php get_footer()?>


