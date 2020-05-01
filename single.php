<?php get_header()?>
<main class="interior">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
	<article class="content">
		<p class="meta-data"><?php the_time('F j, Y');?></p>
		<h1><?php the_title(); ?></h1>
		<?php //the_post_thumbnail(); ?>
		<?php the_content();?>

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