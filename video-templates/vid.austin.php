<?php
	/*
		RMV Template: Austin
	*/
	/*
		Edit according to the template/design
	*/
?>

<?php get_header()?>

<main class="interior">

<?php if(have_posts()) : while (have_posts()) : the_post();?>
	<article class="content">


    <section class="page-title">
        <h1><?php the_title();?></h1>
        <?php echo __salaciouscrumb(); ?>
    </section>

		<?php the_content(); ?>

		<div id="video-player" class="rmv-custom">
			<script type="text/template" id="video_tmpl">
				<?php /* underscore template */?>
			 	<?php get_template_part( 'video', 'templates/parts/videopreview' )?>
			</script>
			<script type="text/template" id="video_tmpl_yt">
				<?php /* underscore template */?>
			 	<?php get_template_part( 'video', 'templates/parts/youtubepreview' )?>
			</script>

			<div id="video-ph" class="video-ph">

			</div>
			<?php
			if(!defined('TMPL_PATH')):
				define('TMPL_PATH', get_template_directory_uri() );
			endif;
			if(!defined('DS')):
				define('DS', DIRECTORY_SEPARATOR);
			endif;

			$uploadpath = wp_upload_dir();
			$video_path = $uploadpath['baseurl'] . '/video/';
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
			if( file_exists( $termstabs = dirname(__FILE__) . '/parts/terms-tabs.php' ) && !empty($tax_terms)):
				include $termstabs;
			endif;

			/* video content */
			if( file_exists( $termsloop = dirname(__FILE__) . '/parts/terms-loop.php' ) && !empty($tax_terms)):
				include $termsloop;
			else:
				global $RMG_VIDEOS;
				$oldvideos = $RMG_VIDEOS;
				$videos = array();
				foreach ($oldvideos as $i => $val): $videos[$val['id']] = $val; endforeach;
				?>
				<div class="box vid-wrapper" style="display:none;">
					<?php
					foreach ($videos as $video):
						$filename = $video['video_file_name'];
						$img = $filename .'.jpg';
						?>
						<div class="vid-single" data-video-div-id="<?php echo $video['id'];?>">
							<?php
							$ytfile = $video['video_youtube_name'];
							$video__thumb = $video_path . $img;
							$ytfilepath = 'http://img.youtube.com/vi/';
							$video__thumb = (!empty($ytfile)) ? $ytfilepath . $ytfile . '/hqdefault.jpg' : $video__thumb ;
							?>
							<div class="vid-single-vid">
								<a class="video-link" data-video-id="<?php echo $video['id'];?>" href="#"><img class="yes-frame" src="<?php echo $video__thumb;?>" alt=""></a>
							</div>
							<div class="vid-title"><?php echo $video['video_name']; ?></div>
							<div class="vid-single-desc">
								<?php $vid_desc = $video['video_desc'];?>
								<?php echo apply_filters( 'the_content', $vid_desc );?>
								<p><a class="video-link button hidden-desktop visible-phone" data-video-id="<?php echo $video['id'];?>" href="#">View Video</a></p>
							</div>
						</div>
						<?php
					endforeach;
					?>
				</div>
				<?php

			endif;
			?>
		</div>


		<div class="written-testimonials">
			<?php if(have_rows('written_testimonials', 'option')): ?>
				<ul>
					<?php while(have_rows('written_testimonials', 'option')): the_row(); ?>
						<li>
							<h2><?php the_sub_field('title'); ?></h2>
							<div class="comment more"><?php the_sub_field('text'); ?></div>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>


		<?php edit_post_link( $link = __('<< EDIT >>'), $before = "<p>", $after ="</p>", $id ); ?>

	</article>
<?php endwhile; endif;?>

<?php get_sidebar()?>
</main>
<?php get_footer()?>