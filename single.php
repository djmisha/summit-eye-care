<?php get_header()?>
<main class="interior">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
	<article class="content">
	<?php 
		$u_time = get_the_time('U'); 
		$u_modified_time = get_the_modified_time('U'); 
		echo "<p class=\"meta-data\">Last Updated: <span> "; 
		the_modified_time('F jS, Y'); 
		echo " at "; 
		the_modified_time(); 
		echo "</span></p> "; 
	?>


		<h1><?php the_title(); ?></h1>
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
		<?php //the_post_thumbnail(); ?>
		<div class="the-content">
			
		<?php the_content();?>
		</div>

		<?php edit_post_link( $link = __('<< EDIT >>'), $before = "<p>", $after ="</p>", $id ); ?>
		<?php
			prevnext__modify( get_previous_post_link('%link', 'Previous Post') ,
				$attributes = array(
					'class' => 'button alignleft prev-blog-button',
				));
		 ?>
		<?php
			prevnext__modify( get_next_post_link('%link', 'Next Post') ,
				$attributes = array(
					'class' => 'button alignright next-blog-button',
					));
		?>
	</article>
<?php endwhile; endif;?>

</main>
<?php get_footer()?>