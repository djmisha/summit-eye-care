<?php get_header()?>

<!-- <section class="page-title">
  <h1><?php//the_title();?></h1>
  <?php //echo __salaciouscrumb(); ?>
</section>
 -->
<main class="interior">

<?php if(have_posts()) : while (have_posts()) : the_post();?>
	<article class="content" id="skiptomaincontent">

		<?php the_content(); ?>

		<?php edit_post_link( $link = __('<< EDIT >>'), $before = "<p>", $after ="</p>", $id ); ?>

	</article>
<?php endwhile; endif;?>

<?php get_sidebar()?>
</main>

<?php get_footer()?>