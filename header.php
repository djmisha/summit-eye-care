<!DOCTYPE html>

<html class="no-js" lang="en">
<?php
/*=================================================================
				  === Site Head: Meta, Fonts, Tracking etc. ===
=================================================================*/
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content=" maximum-scale=5.0, user-scalable=yes, width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<!-- Site Title -->
	<title><?php wp_title(""); ?></title>

	<!-- Device Check -->
	<script> /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)?(document.getElementsByTagName("html")[0].className+=" is--device",/iPad/i.test(navigator.userAgent)&&(document.getElementsByTagName("html")[0].className+=" is--ipad")):document.getElementsByTagName("html")[0].className+=" not--device";</script>


	<!-- Fonts -->
	<?php if(!is_404()): ?>
		<!-- Google Fonts -->
		<?php miniCSS::url( 'https://fonts.googleapis.com/css?family=Lato:300,400,400i,700' ); ?>
		<?php miniCSS::url( 'https://fonts.googleapis.com/css?family=EB+Garamond' ); ?>
		<?php miniCSS::url( 'https://fonts.googleapis.com/css?family=Cormorant+Garamond:500i' ); ?>
	<?php endif; ?>

	<!-- wp loads all css -->
	<?php wp_head()?>

	<?php // Setting up Google Analytics - could include more than just Google: Site settings > Admin
		$google_analytics = get_field( "google_analytics", 'option' );

		if(!empty($google_analytics)):
			echo $google_analytics;
		else:
			// Do nothing
		endif;
	?>

</head>

<body <?php body_class(); ?> >

	<a href="#skiptomaincontent" style="display:none;">Skip to main content</a>


	<header class="site-header <?php echo is_front_page() ? 'front-header' : 'int-header'; ?> has-webp"
		<?php header_images(); ?>
	>

		<!-- Nav Bar -->
		<div class="nav-bar">

			<!-- Menu Buttons -->
			<div class="menu-buttons">

				<!-- Menu Hamburger - Trigger -->
				<div class="menu-trigger">
					<div class="nav-hamburger">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
					</div>
					<div class="menu-button-text">Menu</div>
				</div>
				<!-- End Menu Hamburger - Trigger -->

				<!-- Menu Contact - Locations info Repeater -->
				<div class="menu-contact">

					<!-- Phone -->
					<div class="menu-phone">
						<?php
							$phone_number = get_field('phone', 'options');
							$tel_number = str_replace(array('.', ',', '-', '(', ')'), '' , $phone_number);
						?>

						<a href="tel:1<?php echo $tel_number; ?>" data-label="Header - Phone number" class="track-outbound">
							<span class="touch-button-icon"><?php inline_svg('icon-contact'); ?></span>
							<span class="touch-button-text">Contact Us</span>
						</a>

					</div>
					<!-- End Phone -->

					<!-- Location -->
					<div class="menu-location">

						<?php if(have_rows('office_location', 'option')): ?>
							<?php while(have_rows('office_location', 'option')): the_row(); ?>

								<a href="<?php the_sub_field('gmap'); ?>" target="_blank">
									<span class="touch-button-icon"><?php inline_svg('icon-directions'); ?></span>
									<span class="touch-button-text">Location</span>
								</a>

							<?php endwhile; ?>
						<?php endif; ?>

					</div>
					<!-- End Location -->

				</div>
				<!-- End Menu Contact - Locations info Repeater -->

			</div>
			<!-- End Menu Buttons -->

			<!-- Main Nav -->
			<nav>
				<?php wp_nav_menu( array(
					'menu' 		=> 'Main',
					'container_class' => 'menu-wrap',
					'menu_id'	=> 'menu-main',
					'menu_class' => 'main-menu',
				)); ?>
			</nav>
			<!-- Main Nav -->

		</div>
	  <!-- End Nav Bar  -->


	</header>
