<?php get_header();?>

<main class="interior">

	<div class="gallery-content">
	<?php  echo rmg_archive_content(); ?>
	</div>
	<article class="content">
		<?php
		$cat_cpt = rmg_helpers::$category_cpt_name;
		$parent = new WP_Query(array(
		    'post_type' => $cat_cpt,
		    'post_parent' => 0,
		    'orderby' => 'menu_order',
		    'order' => 'ASC'
		));
		?>

		<?php if ( have_posts() ) : while ( $parent->have_posts() ) : $parent->the_post();?>


		<?php
			if(has_post_thumbnail()):
				$catBg = get_the_post_thumbnail_url( $post->ID);
			endif;
		 ?>
		<div class="gallery-section model_tag" style="background-image: url(<?php echo $catBg; ?>)">
		<h2><?php the_title();?></h2>
		<ul>
			<?php
				$cats = $rmg_cat::children( $post , array('orderby' => 'menu_order' , 'order' => 'ASC' ));//uses get_children , finds the cases & their images and attaches it to the $post object

				foreach ($cats as $cat => $post) {
					echo '<li>';
						echo '<a href="'.get_permalink($post->ID).'">' . get_the_title( $post->ID ) . '</a>';
					echo '</li>';
				}
			?>
		</ul>
		</div>
		<?php endwhile; endif;?>
	</article>
	<div class="gallery-vid">
	<?php echo do_shortcode('[video file="bna-tohelppatients" width="500"]'); ?>
	</div>
</main>

<?php get_footer();?>