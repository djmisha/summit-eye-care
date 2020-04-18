	<footer class="site-footer">

		<section class="upper-footer">

		

		<?php if(!is_page(array('contact', 'contact-us'))): ?>
		<div class="footer-contact-form">
			<?php //echo do_shortcode( '[seaforms name="footer-contact"]' ); ?>
		</div>
		<?php endif; ?>

		
			<div class="footer-locations-wrapper">

				<div class="locations-info-wrapper">
					<div class="footer-logo"><?php echo inline_svg('logo'); ?></div>
					
					<?php if( have_rows('locations', 'option')): ?>

						<ul class="f-locations">

						<?php while( have_rows('locations', 'option')): the_row();
							$locationName = get_sub_field('locationName');
							$tag = get_sub_field('location_tag');
							$street = get_sub_field('street');
							$suite = get_sub_field('suite');
							$city = get_sub_field('city');
							$state = get_sub_field('state');
							$zip = get_sub_field('zip');
				    		$phone = get_sub_field('phone');
							$tel = str_replace(array('.', ',', '-', '(', ')', ' '), '' , $phone);
							$map = get_sub_field('map');
							$gmb = get_sub_field('gmb');
						?>

							<li>

								<!-- <div><i class="fas fa-map-marker-alt"></i></div> -->

								<div>

									<?php
										// phone
										if($phone) echo '<div class="phone">
										<a href="tel:+1' . $tel . '">' . $phone . '</a></div>';

										// Tag
										if($tag) echo '<div class="tag">' . $tag . '</div>';

										// Directions wrap open
										if($gmb) echo '<div class="directions"><a href="' . $gmb . '" target="_blank" rel="nofollow noopener" data-label="Footer Contact - Address" class="track-outbound">';

											// locationName
											if($locationName) echo '<div class="name">' . $locationName . '</div>';
											


											// Address
											if( $street ) {
												echo '<div class="street">' . $street;
												if ($suite) echo ', ' . $suite;
												echo '</div>'; // Street Address
											}
											if( $city ) echo ' <div class="city">' . $city . ', ' . $state . ' ' . $zip . '</div>'; // City, State Zip
											// End Address

										if($gmb) echo '</a></div>';
										// Directions wrap close/end
									?>

								</div>

							</li>

						<?php endwhile; ?>
						</ul>
					<?php endif; ?>

					<?php if( have_rows('social_buttons', 'option')): ?>

						<div class="f-social">

						<?php
							while( have_rows('social_buttons', 'option')): the_row();
								$icon = get_sub_field('social_icon');
								$name = get_sub_field('social_name');
								$link = get_sub_field('social_link');

								if( $name ) echo '<a href="' . $link . '" aria-label="' . $name . '" rel="nofollow noopener" target="_blank">' . $icon . '<span>' . $name . '</span></a>';

							endwhile;
						?>

						</div>

					<?php endif; ?>
				</div>
			
				<div class="footer-map">
					<?php if( have_rows('locations', 'option')): ?>
						<?php while( have_rows('locations', 'option')): the_row(); $gmb = get_sub_field('gmb'); ?> 
							<a href="<?php echo $gmb; ?>" aria-label="Map"></a>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>

			</div>
			
		</section>


		<section class="lower-footer">

			<div class="copyright">Copyright &copy; <?php echo date("Y"); ?> <?bloginfo('title');?>. All rights reserved | <a href="<?php bloginfo('url'); ?>/privacy-policy">Privacy Policy</a> | <a href="<?php bloginfo('url'); ?>/sitemap/" title="Sitemap">Sitemap</a></div>

			<div class="sig"><a href="<?php the_field('portfolio_link', 'option'); ?>" target="_blank" rel="noopener"><?php the_field('portfolio_label', 'option'); ?></a> by
			<a href="https://www.silvragency.com/" target="_blank" rel="noopener" aria-label="Silvr Agency">SILVR <?php echo inline_svg('sig-logo'); ?></a></div>

		</section>


		<?php
		// Sticky Contact 
		// if(!is_page(array('contact', 'contact-us'))) {
		// 	$stickyContact = get_field('sticky_contact', 'options');
		// 	if( $stickyContact ) echo '<section class="sticky-contact">' . $stickyContact . '</section>';
		// }
		?>

		<!--  NEEDS LINKS --><!-- FIX WITH TOP SECTION -->
		<div class="sticky-contact">
			<a href="" class="sticky-schedule"><span>Schedule a Consultation</span></a>
			<a href="" class="sticky-phone-icon"></a>
			<div class="split-line"></div>
		</div>

	</footer>

	<?php wp_footer();?>


<?php if($_SERVER['SERVER_NAME'] == 'gandola-eye.local'): ?>
	<script id="__bs_script__">//<![CDATA[
	    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.26.7'><\/script>".replace("HOST", location.hostname));
	//]]></script>
	<?php endif; ?>

</body>
</html>