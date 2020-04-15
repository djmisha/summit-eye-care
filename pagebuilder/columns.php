<?php if( have_rows('columns')): ?>
	<div class="landing-row"<?php if( $contain ) echo ' style="';
		if( $contain ) echo 'max-width: ' . $containWidth . '; margin: 0 auto;';
		if( $contain ) echo '"';
	?>>
	<?php while( have_rows('columns')): the_row();
		$heading = get_sub_field('heading');
		$anchor = get_sub_field('anchor_list_label');
		$id = get_sub_field('id');
		$classes = get_sub_field('classes');
		$bgColor = get_sub_field('background_color');
		$bgImage = get_sub_field('background_image');
		$border = get_sub_field('border');
		$content = get_sub_field('content');
		$icon = get_sub_field('icon');
		$maxWidth = get_sub_field('max_width');
		$paddingTop = get_sub_field('padding_top');
		$paddingBottom = get_sub_field('padding_bottom');
		$width = false;
		if($maxWidth) {
			$width =  $maxWidth + 40 . 'px';
		}
	?>
		<div class="landing-column<?php if( $classes ) echo ' ' . $classes; ?><?php if( $border ) echo ' landing-border'; ?>"<?php if( $bgImage || $bgColor || $width ) echo ' style="';
			if( $bgImage ) echo 'background-image: url(' . $bgImage . ');';
			if( $bgColor ) echo 'background-color: ' . $bgColor . ';';
			if( $bgImage || $bgColor || $width ) echo '"'; ?><?php if( $id ) echo ' id="' . $id . '"'; ?>>
				<div class="landing-column-content"
				style="
				<?php
					// if( $maxWidth ) echo ' style="';
					if( $maxWidth ) echo 'max-width: ' . $width . '; margin: 0 auto;';
					if($paddingTop !== '') echo 'padding-top: ' . $paddingTop . 'px;';
					if($paddingBottom !== '') echo 'padding-bottom: ' . $paddingBottom . 'px;'
					// if( $maxWidth ) echo '"';
				?>">
					<?php if( $icon ) echo '<div class="landing-icon"><img src="' . $icon . '" alt="icon"></div>'; ?>
					<?php if( $heading ) echo '<h2>' . $heading . '</h2>'; ?>
					<?php if( $content ) echo '<div class="landing-content">' . $content . '</div>'; ?>
				</div>
		</div>
	<?php endwhile; ?>
	</div>
<?php endif; ?>