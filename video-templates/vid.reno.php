<?php
	/*
		RMV Template: Reno
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

					<!-- START // REPLACE ABOVE THIS -->
					<div id="video-player" class="rmv-custom">
						<script type="text/template" id="video_tmpl">
								<?php /* underscore template */?>
								<?php get_template_part( 'video', 'templates/parts/video.view1' );?>
						</script>
						<?php
						if(!defined('TMPL_PATH')):
							define('TMPL_PATH', get_template_directory_uri() );
						endif;
						if(!defined('DS')):
							define('DS', DIRECTORY_SEPARATOR);
						endif;

						$video_path = rtrim( site_url() , DS ) . DS . 'wp-content/uploads/video/';
						$rmv_categories = get_post_meta($post->ID , '_video_categories' , true)?:array();
						$rmv_categories = array_filter($rmv_categories);

						$tax_terms = get_terms('video_category' , array(
							'hide_empty'	=> true,
							'order'			=> 'ASC',
							'include'		=> $rmv_categories
							));

						$video_args = array(
							'post_type' 		=> 'create_video',
								'posts_per_page'	=> '-1',/* GETS ALL videos */
								'orderby'			=> 'post_date',
							);
						/* tabs */
						?>
						<?php echo '<ul id="tabs" class="reset-m-p">';
							foreach ($tax_terms as $term):
								?>
									<li><a href="#tabs" id="<?php echo $term->slug;?>" class="button"><?php echo $term->name?></a></li>
								<?php
							endforeach;
						 echo '</ul>';
						/* tabs content */

						foreach ($tax_terms as $term):
							?>
							<div id="<?php echo $term->slug;?>" class="box vid-wrapper clearfix" style="display:none;">
							<?php
								$video_args['video_category'] = $term->slug;
								$posts = get_posts($video_args);
								$ii = 0;
								foreach ($posts as $post):
									$eo = ( ++$ii % 2 != 0 ) ? 'odd' : 'even';
									$filename = get_post_meta(  $post->ID , 'video_file_name', true );
									$img = $filename .'.jpg';
										$videopopup_q = array(
												'file'	=> $filename,
												'width'	=> '480',
												'height'	=> '270',
												'autoplay'	=> 'true',
												'wrap'		=> 'no'
											);
										$q = http_build_query($videopopup_q);
									?>
									<div class="vid-single <?php echo $eo;?> vid-<?php echo $post->ID;?>" data-video-div-id="<?php echo $post->ID;?>">

										<div class="vid-single-vid">
											<a class="video-link" data-video-id="<?php echo $post->ID;?>" href="<?php echo TMPL_PATH . '/video-popup.php?' . $q;?>"><img class="yes-frame" src="<?php echo $video_path . $img;?>" alt=""><span class="vid-ole">Watch Video</span></a>
											<div style="display:none;" class="single-vid-tmpl">

											</div>
										</div>
										<h3><?php echo get_post_meta( $post->ID, 'video_name', true ); ?></h3>
										<div class="vid-single-desc">
											<?php $vid_desc = get_post_meta( $post->ID , 'video_desc', true ); ?>
											<?php

												$ptrn = '~<(\w+)\b[^>]*>(.*?)</\1>\K|\ ~';
												$txt = preg_split($ptrn , $vid_desc );
												$max = count($txt);
												if( $max > 12){
													$text = array_slice( $txt, 0 , 12 );
													$text[] = '<span class="showme-text">... <a>Read More</a></span>';

													$text2 = array_slice( $txt, 12 , $max );
													array_unshift($text2, "<span class=\"show-textbox\">");
													$text2[] = "<br><span class=\"d-block text-right\"><a class=\"hide-text\">[ Close ]</a></span></span>";
													$text = array_merge($text , $text2);
												}
												else{
													$text = $txt;
													$text[] = "<br><span class=\"show-textbox\"><span class=\"d-block text-right\"><a class=\"hide-text\">[ Close ]</a></span></span>";
												}
											?>

											<?php echo apply_filters( 'the_content', join(' ', $text ) );?>

										</div>
										<p style="display:none;" class="text-center hidden-desktop"><a class="video-link video-fancybox fancybox.ajax container-full button" data-video-id="<?php echo $post->ID;?>" href="<?php echo TMPL_PATH . '/video-popup.php?' . $q;?>">View Video</a></p>
									</div>
									<?php
								endforeach;
								?>
							</div>
							<?php
						endforeach;
						?>
					</div>
					<!-- /#video-player / END / REPLACE BELOW THIS-->

				</div>
			</article>
		</div><!-- #content -->
	</div><!-- #primary -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();