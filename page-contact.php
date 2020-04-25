<?php
	// Template Name: Contact
?>
<?php get_header()?>

<main class="interior">

<?php if(have_posts()) : while (have_posts()) : the_post();?>

	<article class="contact-content">
		<!-- Left Column. Houses the form and any other text  -->
		<div class="contact-form">
			<?php the_content(); ?>
		</div>

		<!-- Right Column. Houses the map, contact info, and hours -->
		<div class="office-info">
			<h2>Location</h2>

			<?php if(have_rows('locations', 'option')): ?>
				<?php while(have_rows('locations', 'option')): the_row();
					$location = get_sub_field('location_name');
					$street = get_sub_field('street');
					$suite = get_sub_field('suite');
					$city = get_sub_field('city');
					$state = get_sub_field('state');
					$zip = get_sub_field('zip');
					$map = get_sub_field('map');
					$gmb = get_sub_field('gmb');
					$phone = get_sub_field('phone');
					$tel = str_replace(array('.', ',', ' ', '-', '(', ')'), '' , $phone);
				?>

				<!-- Map iframe -->
				<?php if( $map ) echo '<div class="gmaps">' . $map . "</div>"; ?>

				<div class="contact-information">
					<address class="location-details">
						<?php
							if( $location ) echo '<span class="practice">' . $location . '</span>'; // Practice Name
							if( $street ) {
								echo '<span class="street">' . $street; // Street Address
								if ( $suite ) echo ', Suite #' . $suite; // Optional Suite Number
								echo '</span>';
							}
							if( $city ) echo '<span class="city">' . $city . ', ' . $state . ' ' . $zip . '</span>'; // City, State Zip
							if( $phone ) echo '<a href="tel:+1' . $tel . '">' . $phone . '</a>'; // Phone Number

						?>
					</address>

					<?php if( have_rows('location_hours', 'option') ): ?>
						<div class="location-hours">
							<strong>Office Hours</strong>
							<?php while( have_rows('location_hours', 'option') ): the_row();
								$day = get_sub_field('day');
								$hours = get_sub_field('hours');
							?>

								<div class="hours-each">
									<?php
										if( $day ) echo '<div class="day">' . $day;
										if( $hours ) {
											echo ':</div><div class="hours">' . $hours . '</div>';
										} else {
											echo '</div>';
										}
									?>
								</div>

						<?php endwhile; ?>
						</div>
					<?php endif; // end Hours Repeater?>


				</div>

				<?php endwhile; ?>
			<?php endif; // end Locations Repeater?>

		</div>
	</article>
<?php endwhile; endif;?>
</main>
<?php get_footer()?>