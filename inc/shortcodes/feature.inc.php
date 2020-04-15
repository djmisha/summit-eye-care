<?php
add_shortcode('feature' , 'sc__feature');
function sc__feature( $atts , $content = null ){
	extract( shortcode_atts( array(
		'name'	=> '',

	), $atts , 'feature' ) );
		ob_start();

?>
		<div class="page-feature">
			<h1><?php the_field('feature_header'); ?></h1>
			<?php the_field('feature_text'); ?>
		</div>
<?php
		$output = ob_get_contents();
		ob_end_clean();
	return $output;
}
