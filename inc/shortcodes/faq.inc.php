<?php
add_shortcode('faq' , 'sc__faq');
function sc__faq( $atts , $content = null ){
	extract( shortcode_atts( array(
		'name'	=> '',

	), $atts , 'faq' ) );
		ob_start();

?>

			<div class="faq-sc-wrap full-width">
				<span class="headline"><?php the_field('headline'); ?></span>
				<?php if(have_rows('faq')): ?>
					<ul>
						<?php while(have_rows('faq')): the_row(); ?>
							<li>
								<span class="question"><?php the_sub_field('question'); ?></span>
								<span class="answer"><?php the_sub_field('answer'); ?></span>
							</li>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>


		<?php
		$output = ob_get_contents();
		ob_end_clean();
	return $output;
}
