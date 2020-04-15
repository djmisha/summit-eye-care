<aside>

<?php if(get_post_type() == 'post'): ?>
		<div class="sidebar-block blog-block">
			<div class="sb-inside">
				<div class="hdng"><span class="button">Categories</span></div>
				<ul>
					<?php wp_list_categories( array(
						'title_li' 	=> '',
						'depth'		=> 1,
						// 'exclude'	=> 26
					) ); ?>
				</ul>

			</div>
		</div>

		<div class="sidebar-block blog-block">
	 		<div class="sb-inside">
				<div class="hdng"><span class="button">Archives</span></div>
				<ul class="list-items">
					 <?php  wp_get_archives( array(
						'type'            => 'yearly',
						'limit'           => '',
						'before'          => '',
						'after'           => '',
						'show_post_count' => false,
						'echo'            => 1,
						'order'           => 'DESC'
					)); ?>
				</ul>

			</div>
		</div>
<?php else: ?>

	<!-- Sidebar Button Links -->

	<?php if( have_rows('sb_buttons', 'option')): ?>
		<ul class="sidebar-buttons">
		<?php while( have_rows('sb_buttons', 'option')): the_row();
			$linkLabel = get_sub_field('label');
			$linkUrl = get_sub_field('link');
			$jumpLink = get_sub_field('jumplink');
			$image = get_sub_field('image');

			$uriparts = clean_uri();
			$uriparts = array_filter($uriparts);
			$uriparts = array_values($uriparts);


	?>


		<?php if(!empty($linkLabel) ): ?>

			<?php if(basename($linkUrl) != array_pop($uriparts)): ?>
				<li>
				<?php if(!empty($image) ): ?>
					<img src="<?php echo $image; ?>" alt="">
				<?php endif; ?>
				<a href="<?php echo $linkUrl ?><?php if(!empty($jumpLink) ): ?>#<?php echo $jumpLink; ?><?php endif; ?>" class="btn-sidebar"><?php echo $linkLabel; ?></a></li>
			<?php endif; ?>
		<?php endif; ?>
	<?php endwhile; ?>
	</ul>
<?php endif; ?>



<!-- SB Gallery -->
<?php if(!this_is('gallery-child' || 'gallery')): ?>
<div class="sidebar-block sb-gallery">
	<div class="hdng">Smile Transformations</div>
	<div class="subhdng">View Real Patient Before &amp; Afters</div>
	<?php the_field('sb_gallery', 'option'); ?>
	<div class="gallery-button">
		<a href="<?php bloginfo('url'); ?>/gallery/" class="button">Smile Gallery</a>
	</div>
	<?php if(!is_page('testimonials')): ?>
	<div class="gallery-button">
		<a href="<?php bloginfo('url'); ?>/testimonials/" class="button">Testimonial</a>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>

<!-- ending the blog conditional -->
<?php endif; ?>

<!-- Quick Contact -->

<?php if(!is_page('contact-us')): ?>
<div class="sidebar-block">
	<div class="hdng">Make an Appointment</div>
	<div class="subhdng">Contact Us to Get Started</div>
	<?php echo do_shortcode('[seaforms name="quick-contact"]'); ?>
</div>
<?php endif; ?>


<!-- Social -->

<div class="sidebar-block sb-social">

	<?php
	  $phone_number = get_field('phone', 'options');
	  $tel_number = str_replace(array('.', ',', '-', '(', ')'), '' , $phone_number);
	?>
	<div class="sb-call"><span>Call</span> <a href="tel:1<?php echo $tel_number; ?>"><?php echo $phone_number; ?></a></div>

<?php if(have_rows('office_location', 'option')): ?>
	<?php while(have_rows('office_location', 'option')): the_row(); ?>
		<div class="sb-visit"><span>Visit</span>
			<?php the_sub_field('street'); ?>, <br><?php the_sub_field('suite'); ?>
			<a href="<?php the_sub_field('gmap'); ?>" target="_blank">Get Directions</a>
		</div>
	<?php endwhile; ?>
<?php endif; ?>


	<?php if( have_rows('social_buttons', 'option')): ?>
		<?php while( have_rows('social_buttons', 'option')): the_row();
			$icon = get_sub_field('social_icon');
			$link = get_sub_field('social_link');
		?>

			<?php if(!empty($icon) ): ?>
				<a href="<?php echo $link ?>" target="_blank"><?php echo $icon; ?></a>
			<?php endif; ?>

		<?php endwhile; ?>
	<?php endif; ?>


</div>


<!-- Categories -->
	<?php if( get_post_type() == 'post'): ?>

	<?php endif; ?>
<!-- End Categories -->



<?	wp_reset_postdata(); ?>


</aside>
