<?php
/* terms loop START */
foreach ($tax_terms as $term): 

	$slug = preg_replace('/(\d-)/i', '', $term->slug);
	?>
	<div id="<?php echo $slug;?>" class="box vid-wrapper" style="display:none;">
	<?php
		$video_args['video_category'] = $term->slug;
		$posts = get_posts($video_args);
		foreach ($posts as $post):
			$filename = get_post_meta(  $post->ID , 'video_file_name', true );
			$img = $filename .'.jpg';
			?>
			<div class="vid-single" data-video-div-id="<?php echo $post->ID;?>">
				<?php 
				$ytfile = get_post_meta( get_the_ID(), 'video_youtube_name', true )?:'';
				$video__thumb = $video_path . $img;
				$ytfilepath = 'http://img.youtube.com/vi/';
				$video__thumb = (!empty($ytfile)) ? $ytfilepath . $ytfile . '/hqdefault.jpg' : $video__thumb ;
				?>
				<div class="vid-single-vid">
					<a class="video-link" data-video-id="<?php echo $post->ID;?>" href="#"><img class="yes-frame" src="<?php echo $video__thumb;?>" alt=""></a>
				</div>
				<h3><?php echo get_post_meta( $post->ID, 'video_name', true ); ?></h3>
				<div class="vid-single-desc">
					<?php $vid_desc = get_post_meta( $post->ID , 'video_desc', true ); ?>
					<?php echo apply_filters( 'the_content', $vid_desc );?>
					<p><a class="video-link button hidden-desktop visible-phone" data-video-id="<?php echo $post->ID;?>" href="#">View Video</a></p>
				</div>
			</div>
			<?php
		endforeach;
		?>
	</div>
	<?php 
endforeach;
/* terms loop END */