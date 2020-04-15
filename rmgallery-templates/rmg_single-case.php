<?php get_header();?>


<section class="single-case-content">
	<div class="back-btn">
		<a href="<?php bloginfo('url'); ?>/gallery" class="button">Back to Gallery</a>
		<div class="gallery-nav">
		<?php
		/**
		* accepts an array
		* keys : 'class' , 'title' , 'hash'
		* if 'title' key is not present then default will be
		* - prev : &laquo; Previous
		* - next : Next &raquo;
		*/

		$rmg_case::prev( array(
		    'class' => 'button button-rmg button-gallery-prev' ,
		    'title'  => ' ') );

		$rmg_case::next( array(
		    'class' => 'button button-rmg button-gallery-next' ,
		    'title' => ' ') );
		?>
		</div>
	</div>

<?php $category_title =  get_the_title($post->in_cat_ID); ?>

	<section class="case-wrap">
		<h2><?php the_title(); ?></h2>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
					<div class="img-wrap">
					<?php foreach ( $post->rmg_case_imgs as $img ): ?>
						<div class="before-img img-frame"><img class="first" src="<?php echo $rmg_case::get_image($img['before_image_path']); ?>" alt="" />
							<div class="bna-label">Before</div>
						</div>
						<div class="after-img img-frame"><img src="<?php echo $rmg_case::get_image($img['after_image_path']); ?>" alt="" />
							<div class="bna-label">After</div>
						</div>

					<?php endforeach; ?>
					</div>
					<?php if(!empty(the_content())): ?>
					<div class="details-hdng">Details:</div>
					<div class="patient-details"><?php the_content();?></div>
					<?php endif; ?>
				<?php endwhile; endif;?>

	</section>
	</section>


<?php get_footer();?>