<div class="landing-row"<?php if( $contain ) echo ' style="';
	if( $contain ) echo 'max-width: ' . $containWidth . '; margin: 0 auto;';
	if( $contain ) echo '"';
?>>

<?php $sections = get_field('sections'); ?>
<div class="landing-column landing-anchors-wrap" style="">
	<div class="landing-column-content">


			<?php the_sub_field('content'); ?>

		<ul class="landing-anchor-links">
		<?php foreach ($sections as $section) {
			$contents = $section['section_content'];

			if (is_array( $contents )) {
				foreach ($contents as $content) {
					$layouts = $content['acf_fc_layout'];

					if ($layouts == 'content_row') {
							$columns = $content['columns'];

							foreach ($columns as $column) {
								$id = $column['id'];
								$label = $column['anchor_list_label'];

								if( $label ) {
									echo '<li><a href="#' . $id . '">' . $label . '</a></li>';
								}
							}
					}
				}
			}
		}
		?>
		</ul>
	</div>
</div>


</div>