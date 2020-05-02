<?php get_header(); ?>


<!-- Search Bar -->
<section class="search-bar">

	<!-- Category Dropdown -->
	<div class="cat-select">
		<div class="cat-options">Categories</div>
		<ul class="cats">

			<?php
			$postCategories = get_categories(array('parent'=> 0));
			foreach($postCategories as $postCategory): ?>

				<li>
					<a href="<?php bloginfo('url'); ?>/category/<?php echo $postCategory->slug; ?>/">
						<?php echo $postCategory->name; ?>
					</a>
				</li>

			<?php endforeach; ?>

		</ul>
	</div> <!--  End Category Dropdown -->

	<!-- Archive Dropdown -->
	<div class="cat-select">
		<div class="cat-options">Archive</div>
		<ul class="list-items cats">
			<?php wp_get_archives( array(
				'type'            => 'yearly',
				'limit'           => '',
				'before'          => '',
				'after'           => '',
				'show_post_count' => false,
				'echo'            => 1,
				'order'           => 'DESC'
			)); ?>
		</ul>
	</div> <!-- End Archive Dropdown -->

	<?php $cats = get_the_category();

	global $wp_query;

	?>

	<!-- Search Form -->
	<form action="<?php bloginfo('url'); ?>" id="search-form" method="get"><input type="text" placeholder="" name="s" id="s" class="search-input"><input type="submit" value="Search" class="button">
	</form>

</section> 
<!-- End Search Bar -->


<main class="interior">

	<article class="content">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>

			<article class="post-snippet">
				
				<?php if(!empty(get_the_post_thumbnail())): ?>
					<a href="<?php the_permalink(); ?>">
						<div class="thumb">
							<?php the_post_thumbnail(''); ?>
						</div>
					</a>
				<?php endif; ?>

				<div class="excerpt">
					<h2 class="blog-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
					<div class="the-time">
						<div>
							<?php the_time('M');?> 
						</div>
						<div class="the-date">
							<?php the_time('j');?> 
						</div>
					</div>

					<span class="the-cat">
						<?php the_category(', '); ?>
					</span>

					<?php //my_excerpt(30); ?>
				</div>

			</article>
		<?php endwhile; endif;?>

		<!-- <?php// posts_nav_link(); ?> -->
		<!-- Nav Buttons with classes. -->
		<div class="nav-links">
			<?php
			prevnext__modify( get_previous_posts_link() ,
				$attributes = array(
					'class' => 'button alignleft prev-blog-button',
				));

			prevnext__modify( get_next_posts_link() ,
				$attributes = array(
					'class' => 'button alignright next-blog-button',
				));
				?>
			</div> <!-- End Nav Buttons. -->
		</article>

		<?php get_sidebar(); ?>
	</main>



	<?php get_footer(); ?>