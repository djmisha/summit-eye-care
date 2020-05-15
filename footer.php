	<footer class="site-footer">

	    <section class="upper-footer">

	        <?php if(!is_page(array('contact', 'contact-us'))): ?>
	        <div class="footer-contact-form">
	            <span class="headline">Request a Consultation</span>
	            <?php echo do_shortcode( '[aform name="contact-us"]' ); ?>
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
							$applink = Get_bloginfo('url') .'/contact-us/';

						?>

	                    <li>


	                        <div>

	                            <?php
										// phone
										if($phone) echo '<div class="phone">
										<a href="tel:+1' . $tel . '">' . $phone . '</a></div>';

										// Tag
										if($tag) echo '<div class="tag"><a href="' . $applink . '">' . $tag . '</a></div>';

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
	                <a href="<?php echo $gmb; ?>" aria-label="Map" target="_blank" rel="nofollow noopener"></a>
	                <?php endwhile; ?>
	                <?php endif; ?>
	            </div>

	        </div>

	    </section>


	    <section class="lower-footer">

	        <div class="copyright">Copyright &copy; <?php echo date("Y"); ?>
	            <?bloginfo('title');?>. All rights reserved | <a href="<?php bloginfo('url'); ?>/privacy-policy">Privacy
	                Policy</a> | <a href="<?php bloginfo('url'); ?>/sitemap/" title="Sitemap">Sitemap</a></div>

	        <div class="sig">
	            <a href="https://www.silvragency.com/website-design-and-development/" target="_blank"
	                rel="nofollow noopener">Design</a> and
	            <a href="https://www.silvragency.com/digital-marketing/" target="_blank"
	                rel="nofollow noopener">Marketing</a>
	            by
	            <a href="https://www.silvragency.com/" target="_blank" rel="nofollow noopener"
	                aria-label="Silvr Agency">SILVR <?php echo inline_svg('sig-logo'); ?></a>
	        </div>

	    </section>


	    <?php // Sticky Button
		if(!is_page(array('contact', 'contact-us'))) { ?>
	    <div class="sticky-contact">
	        <?php if(have_rows('locations', 'option')): ?>
	        <?php while(have_rows('locations', 'option')): the_row();
		    		$phone = get_sub_field('phone');
					$tel = str_replace(array('.', ',', '-', '(', ')', ' '), '' , $phone);
					$map = get_sub_field('map');
					$gmb = get_sub_field('gmb');
					$applink = Get_bloginfo('url') .'/contact-us/';
				?>
	        <a href="<?php echo $applink; ?>" class="sticky-schedule"><span>Schedule a Consultation</span></a>
	        <a href="tel:+1<?php echo $tel; ?>" class="sticky-phone-icon"></a>
	        <div class="split-line"></div>
	        <?php endwhile; ?>
	        <?php endif; ?>
	    </div>
	    <?php } ?>

	</footer>

	<?php wp_footer();?>


	<?php if($_SERVER['SERVER_NAME'] == 'gandola-eye.local'): ?>
	<script id="__bs_script__">
//<![CDATA[
document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.26.7'><\/script>".replace(
    "HOST", location.hostname));
//]]>
	</script>
	<?php endif; ?>

	</body>

	</html>