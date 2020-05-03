(function($) {

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		$('html').addClass('is--device');
		if(/iPad/i.test(navigator.userAgent)){
			$('html').addClass('is--ipad');
		}
	}
	else{
		$('html').addClass('not--device');
	}

	if (navigator.userAgent.match(/Mac/) && navigator.maxTouchPoints && navigator.maxTouchPoints > 2) {
		$('html').addClass('is--device');
		$('html').removeClass('not--device');
	}

	$(function() {//doc.ready[shorthand] start

		var $desktop = 1010;
		var $tablet = 768;
		var theme_path = rm_data.tmplDirUri;
		var site_path = rm_data.siteUrl;

		/* --------------------------------------------------
			Blazy
		-------------------------------------------------- */
			// var bLazy = new Blazy();



		/* --------------------------------------------------
			Fancybox
		-------------------------------------------------- */
			//Use data-attr.  ie: data-fancybox data-caption="My caption"

		/* --------------------------------------------------
			Owl Carousel
		-------------------------------------------------- */
			$('.home-rotator').owlCarousel({
				items:1,
				lazyLoad:true,
				loop:true,
				nav:false,
				dots:true,
				autoplay: true,
				autoplayTimeout: 7000,
				animateOut: 'fadeOut',
				autoHeight:true
			});


			$('.testi-slider').owlCarousel({
				items:1,
				lazyLoad:true,
				loop:true,
				nav:false,
				dots:true,
				autoplay: true,
				autoplayTimeout: 5000,
				smartSpeed:1200,
				autoHeight:true
			});
			

		/* --------------------------------------------------
			Wow
		-------------------------------------------------- */
			// new WOW().init();


		/* --------------------------------------------------
			Fancybox for WordPress Core Gallery
		-------------------------------------------------- */

		// Activate Fancy Box for WP Core Gallery

		$( ".gallery-icon a" ).attr( "data-fancybox", "gallery" );

		// Append the Caption

		$('dl.gallery-item').each( function(event) {
			var caption = $(this).find('dd').text();
			$(this).find('dt a').attr( "data-caption", caption );
		});

		/* --------------------------------------------------
			Parallax
		-------------------------------------------------- */


		$(window).on("load resize", function(e) {
				if ($("html").hasClass("is--device")) {
					if ($(".is-parallaxing").length > 0) {
						$(".will-parallax")
							.removeClass("is-parallaxing")
							.removeAttr("style");
					}
				} else {
					$(".will-parallax").addClass("parallax");
					$(".will-parallax").addClass("is-parallaxing");

					
					if ($(".parallax").hasClass("parallax")) {
						$(".will-parallax").waypoint(function() {
							$(".parallax-welcome").parallax("center", -0.3, true); 
							// $(".home-doctor-parallax").parallax("center", -0.4, true);
							// $(".home-reviews-parallax").parallax("center", -0.2, true);
							// $('.parallax-home-breast').parallax('center', -0.3, true , 'is-parallaxing');
							// $(".parallax-internal-header").parallax("center", -0.1, true);
						});
					}
				}
			});



		
		// makes the parallax elements
		function parallaxIt() {

		  // create variables
		  var $fwindow = $(window);
		  var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

		  // on window scroll event

		  // **** OLD VERSION ****
		  // $fwindow.on('scroll resize', function () {
		  // 	scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		  // });

		  // **** NEW VERSION ****
		  $fwindow.on('scroll resize', function () {
		    if ($(window).width() >= $desktop) {
		      scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		    } else {
		      scrollTop = 0;
		    }
		  });

		  // for each of content parallax element
		  $('.not--device [data-type="content"]').each(function (index, e) {
		    var $contentObj = $(this);
		    var fgOffset = parseInt($contentObj.offset().top);
		    var yPos;
		    var speed = ($contentObj.data('speed') || 1);

		    $fwindow.on('scroll resize', function () {
		      yPos = fgOffset - scrollTop / speed;

		      $contentObj.css('top', yPos);
		    });
		  });

		  // for each of background parallax element
		  $('.not--device [data-type="background"]').each(function () {
		    var $backgroundObj = $(this);
		    var bgOffset = parseInt($backgroundObj.offset().top);
		    var yPos;
		    var coords;
		    var speed = ($backgroundObj.data('speed') || 0);

		    $fwindow.on('scroll resize', function () {
		      yPos = - ((scrollTop - bgOffset) / speed);
		      coords = '50% ' + yPos + 'px';

		      if ($(window).width() >= $desktop) {
		          $backgroundObj.css({ backgroundPosition: coords });
		      } else {
		          $backgroundObj.css({ backgroundPosition: 'center' });
		      }
		    });
		  });

		  // triggers winodw scroll for refresh
		  $fwindow.trigger('scroll');
		}

		// **** NEW event listenter ****
		window.addEventListener('resize', parallaxIt());
		if ($(window).width() >= $desktop) {
		  parallaxIt();
		}


		/*===============================
		=             Menu            =
		===============================*/

		dupLocations = $('ul.header-locations').clone();
		dupLocations.removeClass('header-locations');
		dupLocations.addClass('nav-locations');
		dupLocations.appendTo('.main-menu');
		dupLocations.hide();

		function hideShowMobileLocations() {
			// if (duplicate.hasClass('nav-locations') === false) {
			// }
			// console.log(duplicate);
				// console.log(duplicate);
			if ($(window).width() < $desktop) {
				dupLocations.show();
			}
			else {
				dupLocations.hide();
			}
		};

		// duplicatedHeaderLocations();

		// Triggers
		$('.menu-trigger').click(function(){
			$(this).find('.nav-hamburger').toggleClass('open');
			$(this).find('.menu-button-text').toggleClass('open');
			hideShowMobileLocations();
		});

			//Add/Remove Off-Canvas Menu Classes
			var slideRightRemoveClass = true;

			$(".menu-trigger").click(function () {

				// $("body").toggleClass('menu-is-open');
				var el = $(this);
				slideRightRemoveClass = false;


				if ($('body').hasClass('menu-is-open') || $('body').hasClass('menu-is-closed')) {
					$('body').toggleClass('menu-is-open');
					$('body').toggleClass('menu-is-closed');

				} else {
					$('body').addClass('menu-is-open');
				}


			});

			$(".menu-wrap").click(function() {
				slideRightRemoveClass = false;
			});

			$("html, .close-menu").click(function () {
				if (slideRightRemoveClass) {
					$("body, .menu-trigger").removeClass('menu-is-open');
					$('.sub-menu-open').find('.sub-menu').slideUp();
					$('.nav-hamburger, .nav-dropdown-button').removeClass('open');
					$('.sub-menu-open').removeClass('sub-menu-open');
				}
				slideRightRemoveClass = true;
			});

			//Make the mobile menu work when switching between sizes
			function menuSwitcher()	{

				if ($("html").hasClass("is--device") || $(window).width() < $desktop) {
					$(".menu-wrap").addClass("touch-menu");
					$(".menu-wrap").removeClass("hover-menu");
				}
				else{
					$("body").removeClass("menu-is-open");
					$(".menu-wrap").removeClass("touch-menu");
					$(".menu-wrap").addClass("hover-menu");

					// kill = ;
					// console.log(kill);
					// $('.menu-wrap ul.header-locations').remove();
					// $('.menu-wrap ul.header-locations').empty();

					/*remove duplicate nav items*/

				}

				if ($("html").hasClass("is--device") || $(window).width() < $desktop) {
					$('.touch-menu > .main-menu > li.menu-item-has-children > .nav-dropdown-button, .touch-menu .sub-menu > li.menu-item-has-children > .nav-dropdown-button').unbind('click');
					$('.touch-menu > .main-menu > li.menu-item-has-children > .nav-dropdown-button, .touch-menu .sub-menu > li.menu-item-has-children > .nav-dropdown-button').on('click' , function(e){
						e.preventDefault();
						var el = $(this);
						console.log(el);
						el.parent().toggleClass('sub-menu-open');
						// el.next().find('.sub-menu').slideToggle( 400 );
						el.next().slideToggle( 400 );
					});
				}
				else{

					$('.menu > li.menu-item-has-children > a, .menu .sub-menu > li.menu-item-has-children > a').unbind('click');
					$('ul.sub-menu, .menu').removeAttr('style');
				}
			}

			menuSwitcher();

			$(window).on("resize", function(e){
				menuSwitcher();
				hideShowMobileLocations()
			});



			/*===========================================
			=            Sticky Contact Form            =
			===========================================*/

			// Sticky Contact Form
			const stickyContactBar = document.querySelector('footer .sticky-contact');
			if (stickyContactBar) {
				(function () {

					function makeSticky(item) {
						item.classList.add('make-sticky');
					}

					function removeSticky(item) {
						item.classList.remove('make-sticky');
					}

					function stickyFooter() {
						if (window.pageYOffset > 200) {
							makeSticky(stickyContactBar);
						} else {
							removeSticky(stickyContactBar);
						}
					}

					stickyFooter();
					window.addEventListener('scroll', stickyFooter);

				})()
			}

			/*=====  End of Sticky Contact Form  ======*/




			/*=====================================
			=            FAQ Shortcode            =
			=====================================*/


			if($('.faq-sc-wrap')) {
				$('.faq-sc-wrap ul li span.answer').hide();
				$('.faq-sc-wrap ul li').click(function() {
					$(this.lastElementChild).slideToggle();
					$(this.firstElementChild).toggleClass('active');
				});
			}


			/*================================================
			=            Blog Categories dropdown            =
			================================================*/
			

			$('.cat-options').on('click', function(event) {
				event.preventDefault();
				/* Act on the event */
				$(this).next().slideToggle();
				// console.log('click');
			});





		/*====================================================
		=            Background Images using webp            =
		====================================================*/

		// This script will only run on browsers that don't support webp
		// Any inline background image element must use the clase '.has-webp'

		// var noWebp = document.querySelector('.no-webp');
		// if( noWebp) {
		// 	var webpImage = document.querySelectorAll('.no-webp .has-webp');
		// 	webpImage.forEach(function(img) {
		// 		img.style.backgroundImage = img.style.backgroundImage.replace('webp', 'jpg');
		// 	});
		// }


		
		

		});// end of doc.ready

})(jQuery);

