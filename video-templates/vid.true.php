<?php
	/*
		RMV Template: True
	*/
	/*
		Edit according to the template/design
	*/ 
?>

<?php get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<article class="page type-page status-publish hentry">
				<div class="entry-content">
					TRUE
					<h4>Coming Soon</h4>
				</div>
			</article>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();