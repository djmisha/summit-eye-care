<?php
	// Template Name: Home
?>
<?php get_header()?>


<div class="home-welcome">
	<div class="owl-carousel home-rotator">
		<?php if(have_rows('slide_show')): ?>
			<?php while(have_rows('slide_show')): the_row(); ?>
				<div class="slide" style="background-image: url('<?php the_sub_field('image'); ?>');">
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
	<div class="taglines">
		<span class="taglines-title"><?php the_field('headline'); ?></span>
		<span class="taglines-subtitle"><?php the_field('subheadline'); ?></span>
		<a href="<?php bloginfo('url'); ?>/contact/" class="button" rel="nofollow">Schedule a Consultation</a>
	</div>
</div>


<section class="home-whychoose">
	<p><?php the_field('about_headline'); ?></p>
	<div class="home-reasons">
		<?php if(have_rows('about_items')): ?>
				<?php while(have_rows('about_items')): the_row(); ?>
					<div class="reason">
						<img src="<?php the_sub_field('image'); ?>" alt="">
						<span class="headline"><?php the_sub_field('headline'); ?></span>
						<span class="subheadline"><?php the_sub_field('content'); ?></span>
						<a href="<?php the_sub_field('link'); ?>" class="button button-white" rel="nofollow"><?php the_sub_field('link_text'); ?></a>
					</div>
				<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>


<section class="home-surgery">
	<h2><?php the_field('surgery_headline'); ?></h2>
	<div class="surgery">
		<?php if(have_rows('surgery_items')): ?>
			<?php while(have_rows('surgery_items')): the_row(); ?>
				<div class="surgery-single">
					<div class="lines"></div>		
					<a href="<?php the_sub_field('link'); ?>"><img src="<?php the_sub_field('image'); ?>" alt="icon"></a>
					<a href="<?php the_sub_field('link'); ?>" rel="nofollow" class="button button-white"><?php the_sub_field('headline'); ?></a>
				</div> 	
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</section>


<section class="home-doctors">
	<h2>Our Doctors</h2>
	<div class="doctor">
		<div class="doc-pic">
			<img src="<?php bloginfo('template_directory'); ?>/images/doc-1.jpg" alt="">
		</div>
		<div class="doc-bio">
			<h3>John Vukich, M.D.</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Libero nunc consequat interdum varius sit amet mattis vulputate. Interdum consectetur libero id faucibus nisl. Tempor id eu nisl nunc mi. Aliquet sagittis id consectetur purus ut faucibus pulvinar. </p>
			<div class="doc-button">
				<a href="" rel="nofollow" class="button button-transparent">View Bio</a>
			</div>
		</div>
	</div>
	<div class="doctor">
		<div class="doc-pic">
			<img src="<?php bloginfo('template_directory'); ?>/images/doc-2.jpg" alt="">
		</div>
		<div class="doc-bio">
			<h3>John Vukich, M.D.</h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Libero nunc consequat interdum varius sit amet mattis vulputate. Interdum consectetur libero id faucibus nisl. Tempor id eu nisl nunc mi. Aliquet sagittis id consectetur purus ut faucibus pulvinar. </p>
			<div class="doc-button">
				<a href="" rel="nofollow" class="button button-transparent">View Bio</a>
			</div>
		</div>
	</div>
</section>



<section class="home-testis">
	<div class="owl-carousel testi-slider">
		<div class="testi-slider-squote">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Libero nunc consequat interdum varius sit amet mattis vulputate. Interdum consectetur libero id faucibus nisl.

			<strong>-Patient Name</strong>
		</div>
		<div class="testi-slider-squote">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Libero nunc consequat interdum varius sit amet mattis vulputate. Interdum consectetur libero id faucibus nisl.

			<strong>-Patient Name</strong>
		</div>
		<div class="testi-slider-squote">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Libero nunc consequat interdum varius sit amet mattis vulputate. Interdum consectetur libero id faucibus nisl.

			<strong>-Patient Name</strong>
		</div>
	</div>
</section>


<section class="home-with-image"></section>

<?php get_footer()?>