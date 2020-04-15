	<footer class="site-footer">

		<!-- Upper Footer -->
		<section class="upper-footer">

		<!-- Contact Form -->
		<?php if(!is_page(array('contact', 'contact-us'))): ?>
		<div class="footer-contact-form">
			<?php echo do_shortcode( '[seaforms name="footer-contact"]' ); ?>
		</div>
		<?php endif; ?>


			<!-- Locations Repeater -->
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

					<!-- Each Location -->
					<li>

						<!-- Map Icon -->
						<div><i class="fas fa-map-marker-alt"></i></div>

						<!-- Location Info Wrap -->
						<div>

							<?php
								// Directions wrap open
								if($gmb) echo '<div class="directions"><a href="' . $gmb . '" target="_blank" rel="nofollow noopener" data-label="Footer Contact - Address" class="track-outbound">';

									// locationName
									if($locationName) echo '<div class="name">' . $locationName . '</div>';

									// Tag
									if($tag) echo '<div class="tag">' . $tag . '</div>';

									// Address
									if( $street ) {
										echo '<div class="street">' . $street;
										if ($suite) echo ', Suite #' . $suite;
										echo '</div>'; // Street Address
									}
									if( $city ) echo ' <div class="city">' . $city . ', ' . $state . ' ' . $zip . '</div>'; // City, State Zip
									// End Address

								if($gmb) echo '</a></div>';
								// Directions wrap close/end
							?>

						</div>
						<!-- End Location Info Wrap -->

					</li>
					<!-- End Each Location -->

				<?php endwhile; ?>
				</ul>
			<?php endif; ?>
			<!-- End Locations Repeater -->

			<!-- Footer Social Repeater -->
			<?php if( have_rows('social_buttons', 'option')): ?>

				<div class="f-social">

				<?php
					while( have_rows('social_buttons', 'option')): the_row();
						$icon = get_sub_field('social_icon');
						$name = get_sub_field('social_name');
						$link = get_sub_field('social_link');

						if( $name ) echo '<a href="' . $link . '" aria-label="' . $name . '" rel="nofollow noopener" target="_blank">' . $icon . '</a>';

					endwhile;
				?>

				</div>

			<?php endif; ?>
			<!-- End Footer Social Repeater -->

			

		</section>
		<!-- End of Upper Footer -->


		<!-- Lower Footer -->
		<section class="lower-footer">

			


			<!-- Footer Nav -->
		<!-- 	<div class="footer-nav">
				<?php //wp_nav_menu(array('menu' => 'Main'));?>
			</div> -->
			<!-- End Footer Nav -->


			<!-- Copyright Info -->
			<div class="copyright">Copyright &copy; <?php echo date("Y"); ?> <?bloginfo('title');?>. All rights reserved | <a href="<?php bloginfo('url'); ?>/privacy-policy">Privacy Policy</a> | <a href="<?php bloginfo('url'); ?>/sitemap/" title="Sitemap">Sitemap</a></div>
			<!-- End Copyright Info -->


			<!-- Sig -->
			<div class="rm-sig"><a href="<?php the_field('portfolio_link', 'option'); ?>" target="_blank" rel="noopener"><?php the_field('portfolio_label', 'option'); ?></a> by
			<a href="https://www.silvragency.com/" target="_blank" rel="noopener" aria-label="Silvr Agency"><?php //echo inline_svg('rm-logo'); ?></a></div>
			<!-- End Sig -->

		</section>
		<!-- End of Lower Footer -->


		<?php
		// Sticky Contact 
		if(!is_page(array('contact', 'contact-us'))) {
			$stickyContact = get_field('sticky_contact', 'options');
			if( $stickyContact ) echo '<section class="sticky-contact">' . $stickyContact . '</section>';
		}
		/*=====  End of Sticky Contact  ======*/
		?>

	</footer>

	<!-- Enqueued JavaScript at the bottom for fast page loading -->
	<?php wp_footer();?>

<?php
	// if($_SERVER['SERVER_NAME'] == 'rosemontdev.com'):
		// $bsPort 					= 35732;
		// $browserSync 			= 'http://rosemontdev.com:'.$bsPort;
		// $browserSyncHdrs 		= @get_headers($browserSync);
		// if($browserSyncHdrs):
			?>
			<script id="__bs_script__">//<![CDATA[
			    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.26.7'><\/script>".replace("HOST", location.hostname));
			//]]></script>
			<?php
		// endif;
	// endif;
?>

</body>
</html>