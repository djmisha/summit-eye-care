<?php
add_shortcode('url' , 'sc__url');
function sc__url( $atts , $content = null ){
	extract( shortcode_atts( array(
		'attr'	=> '',

	), $atts , 'url' ) );
		ob_start();

		bloginfo('url');

		$output = ob_get_contents();
		ob_end_clean();
	return $output;
}