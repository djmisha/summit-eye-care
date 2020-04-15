<?php get_header();?>

	<section class="back-btn">
		<a href="<?php bloginfo('url'); ?>/gallery" class="button">Back to Gallery</a>
	</section>
	<section class="cat-intro">
		<p>Please select each individual patient for a more descriptive history.</p>
	</section>

			<?php
				$cats = $rmg_cat::children( $post , array('orderby' => 'menu_order' , 'order' => 'ASC' ));
				//uses get_children , finds the cases & their images and attaches it to the $post object

				foreach ($cats as $cat => $post) {
					echo '<section class="gal-title"><h2>';
						// echo '<a href="'.get_permalink($post->ID).'">' . get_the_title( $post->ID ) . '</a>';
						echo get_the_title( $post->ID );

					echo '</h2></section>';

echo '<section class="gallery-cat-wrap">';
					$limit = 2;// could probably set this as an wp option
					foreach ($post->cases as $key => $value) {
						$case_link = $rmg_case::make_case_link(array('position' => $value['position'] , 'category_id' => $post->ID));
						$case_name = $rmg_case::make_case_name(array('position' => $value['position']));
						$case_content = $rmg_case::make_case_name(array('position' => $value['post_content']));

						$case_content = str_replace('Patient ', '', $case_content);


						echo '<div class="bna-group">';
						$i = 0;//required
						echo '<h3>'.  $case_name .'</h3>';

						echo '<div class="img-set">';
						foreach ($value['rmg_case_imgs'] as $img) {

							// if(!array_search('front', $img)){ continue; } // if the view_name does not equal 'front' then it will skip it till it finds one that does have that view_name


								if(!empty($img['before_image_path'])){
									echo '<a href="' . $case_link . '" class="before-link"><img class="before-img b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="'.$rmg_case::get_image($img['before_image_path'], 'medium') .'" alt=""></a>';
								}

								if(!empty($img['after_image_path'])){
									echo '<a href="' . $case_link . '" class="after-link"><img class="after-img b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="'.$rmg_case::get_image($img['after_image_path'], 'medium') .'" alt=""></a>';
								}

								if($i == $limit) break; // if for whatever reason we have more than one front

								$i++;

						}//end of img loop

					// hover overlay

								echo '</div>';

								//  if (!empty($case_content)) {

								// echo '<div class="details-hdng">Details:</div><div class="patient-details">' .  $case_content . '</div>';
								// }
								// hover overlay
								echo '<a href="' . $case_link . '" class="hover-overlay">Enlarge</a>';
							echo '</div>';
					}
							echo '</section>';

				}

			?>

<?php get_footer();?>
