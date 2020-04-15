<?php
add_shortcode('memberships' , 'sc__memberships');
function sc__memberships( $atts , $content = null ){
	extract( shortcode_atts( array(
		'name'	=> '',

	), $atts , 'memberships' ) );
		ob_start();

?>
		<?php if( have_rows('memberships', 'option')): // start repeater ?>

			<div class="memberships-sc-wrap">

				<?php
					while( have_rows('memberships', 'option')): the_row();
					$membershipLogo = get_sub_field('logo');
					$membershipSVG = get_sub_field('name');

						if( $membershipLogo ) {
							echo '<img class="b-lazy" data-src="'. $membershipLogo["url"] .'" alt="'. $membershipLogo["alt"] .'" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==">';
						} else {
							echo inline_svg($membershipSVG);
						}

			 		endwhile;
			 	?>

			</div>

		<?php endif; // End Repeater

		$output = ob_get_contents();
		ob_end_clean();
	return $output;
}
