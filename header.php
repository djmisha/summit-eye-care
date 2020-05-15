<!DOCTYPE html>

<html class="no-js" lang="en">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content=" maximum-scale=5.0, user-scalable=yes, width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <title><?php wp_title(""); ?></title>

    <?php if(!is_404()): ?>
    <link rel="stylesheet" href="https://use.typekit.net/gps6lee.css">
    <?php //miniCSS::url( 'https://fonts.googleapis.com/css?family=Lato:300,400,400i,700' ); ?>
    <?php endif; ?>

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

<body <?php body_class(); ?>>

    <a href="#skiptomaincontent" style="display:none;">Skip to main content</a>


    <header class="site-header <?php echo is_front_page() ? 'front-header' : 'int-header'; ?> has-webp">
        <div class="header-top">

            <div class="header-logo">
                <?php site_logo('logo.svg') ?>
            </div>

            <div class="header-locations">

                <?php if( have_rows('locations', 'option')): ?>

                <ul class="header-locations">

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
								if($tag) echo '<div class="tag"><a href="' . $applink . '">Appointments</a></div>';

								// Directions wrap open
								if($gmb) echo '<div class="directions"><a href="' . $gmb . '" target="_blank" rel="nofollow noopener" data-label="Header  Contact - Address" class="track-outbound">';

									// locationName
									if($locationName) echo '<div class="name">' . $locationName . '</div>';

									// Address
									if( $street ) {
										echo '<div class="street">' . $street;
										if ($suite) echo ', ' . $suite. ' ' . $city . ', ' . $state . ' ' . $zip;
										echo '</div>'; // Street Address
									}

								if($gmb) echo '</a></div>';
								// Directions wrap close/end
								?>
                        </div>
                    </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>
            </div>
            <?php // HEADER LOCATIONS END  ?>
        </div>

        <div class="nav-bar">
            <div class="nav-wrap">

                <div class="menu-buttons">

                    <div class="menu-trigger">
                        <div class="nav-hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="menu-button-text">Menu</div>
                    </div>

                    <div class="menu-contact">

                        <div class="menu-phone">
                            <?php
								$phone_number = get_field('phone', 'options');
								$tel_number = str_replace(array('.', ',', '-', '(', ')'), '' , $phone_number);
							?>

                            <a href="tel:1<?php echo $tel_number; ?>" data-label="Header - Phone number"
                                class="track-outbound">
                                <div class="touch-button-icon"><?php echo inline_svg('icon-phone'); ?></div>
                                <span class="touch-button-text">Contact Us</span>
                            </a>

                        </div>

                        <div class="menu-location">

                            <?php if(have_rows('locations', 'option')): ?>
                            <?php while(have_rows('locations', 'option')): the_row(); 
									$applink = Get_bloginfo('url') .'/contac-us/';


									?>

                            <a href="<?php echo $applink; ?>">
                                <div class="touch-button-icon"><?php echo inline_svg('icon-map'); ?></div>
                                <span class="touch-button-text">Location</span>
                            </a>

                            <?php endwhile; ?>
                            <?php endif; ?>

                        </div>

                    </div>

                </div>

                <nav>
                    <?php wp_nav_menu( array(
						'menu' 		=> 'Main',
						'container_class' => 'menu-wrap',
						'menu_id'	=> 'menu-main',
						'menu_class' => 'main-menu',
					)); ?>
                </nav>

            </div>

        </div>

    </header>


    <?php if (!is_front_page()) { ?>
    <div class="internal-header-images" <?php header_images() ?>>
        <section class="page-title">


            <?php if (is_search()): ?>
            <div class="headline">Search Results</div>
            <?php elseif (is_home() or is_archive()): ?>
            <h1>Vision News & Blog</h1>
            <?php elseif (is_single()): ?>
            <div class="headline">Vision News & Blog</div>
            <?php else: ?>
            <h1>
                <?the_title();?>
            </h1>
            <?php endif; ?>





            <div class="site-crumbs"><?php echo __salaciouscrumb(); ?></div>
        </section>
    </div>

    <? } ?>





    <?php  ?>