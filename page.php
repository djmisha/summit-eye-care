<?php get_header()?>


<main class="interior">

<?php if(have_posts()) : while (have_posts()) : the_post();?>
	<article class="content" id="skiptomaincontent">

		<?php the_content(); ?>

		<div class="the-author">
			Authored by: <span><?php the_author(); ?></span>
		</div>


		<?php edit_post_link( $link = __('<< EDIT >>'), $before = "<p>", $after ="</p>", $id ); ?>

	</article>
<?php endwhile; endif;?>

<?php get_sidebar()?>
</main>

<?php get_footer()?>