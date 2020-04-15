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
			var bLazy = new Blazy();



		/* --------------------------------------------------
			Fancybox
		-------------------------------------------------- */
			//Use data-attr.  ie: data-fancybox data-caption="My caption"

		/* --------------------------------------------------
			Owl Carousel
		-------------------------------------------------- */
			// $('.owl-carousel').owlCarousel({
			// 	items:1,
			// 	lazyLoad:true,
			// 	loop:true,
			// 	nav:true,
			// 	dots:true,
			// 	autoplay: true,
			// 	autoplayTimeout: 5000,
			// });


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
		=            RM Menu            =
		===============================*/

		// Triggers
		$('.menu-trigger').click(function(){
			$(this).find('.nav-hamburger').toggleClass('open');
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
			});



		/* --------------------------------------------------
			Smooth Anchor Scrolling
		-------------------------------------------------- */

			var headerHeight = $(".site-header").height();

			$('a[href*="#"]')
			  // Remove links that don't actually link to anything
			  .not('[href="#"]')
			  .not('[href="#0"]')
			  .click(function(event) {
			    // On-page links
			    if (
			      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
			      &&
			      location.hostname == this.hostname
			    ) {
			      // Figure out element to scroll to
			      var target = $(this.hash);
			      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			      // Does a scroll target exist?
			      if (target.length) {
			        // Only prevent default if animation is actually gonna happen
			        event.preventDefault();
			        $('html, body').animate({
			          scrollTop: target.offset().top - headerHeight //May have to change the variable above to set the height to .nav-bar or whatever

			        }, 1000, function() {
			          // Callback after animation
			          // Must change focus!
			          var $target = $(target);
			          $target.focus();
			          if ($target.is(":focus")) { // Checking if the target was focused
			            return false;
			          } else {
			            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
			            $target.focus(); // Set focus again
			          };
			        });
			      }
			    }
			  });

		// Testimonials Show more content
		var showChar = 150;
		var ellipsestext = "...";
		var moretext = "Continue Reading";
		var lesstext = "Collapse";
		$('.more').each(function() {
			var content = $(this).html();

			if(content.length > showChar) {

				var c = content.substr(0, showChar);
				var h = content.substr(showChar, content.length - showChar);

				var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

				$(this).html(html);
			}

		});

		$(".morelink").click(function(){
			if($(this).hasClass("less")) {
				$(this).removeClass("less");
				$(this).html(moretext);
			} else {
				$(this).addClass("less");
				$(this).html(lesstext);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});



		$('.written-testimonials ul li:nth-of-type(n+4)').addClass('hidden');

		$('<a href="#" class="button load-more"><span>Show more patient testimonials</span></a>').appendTo('.written-testimonials');

		$('.load-more').on('click', function(event) {
			event.preventDefault();
			/* Act on the event */
			$('.written-testimonials ul li').removeClass('hidden');
			$('.load-more').addClass('hidden');
		});


		// Front page Smile tranformations
		function checkWidth() {
			var $window = $(window);
		  var windowsize = $window.width();
		  if (windowsize >= 1090) {
		  	// rearange footer on mobile
				$('.home-smile-trans-header').prependTo('.home-examples .transformations');
		  }
		  else {
		  	// rearange footer on mobile
				$('.home-smile-trans-header').prependTo('.home-examples');

		  }
		}
		// Execute on load
		checkWidth();
		// Bind event listener
		$(window).resize(checkWidth);


		// Blog Categories dropdown

		$('.cat-options').on('click', function(event) {
			event.preventDefault();
			/* Act on the event */
			$(this).next().slideToggle();
			console.log('click');
		});


		/*====================================================
		=            Background Images using webp            =
		====================================================*/

		// This script will only run on browsers that don't support webp
		// Any inline background image element must use the clase '.has-webp'

		var noWebp = document.querySelector('.no-webp');
		if( noWebp) {
			var webpImage = document.querySelectorAll('.no-webp .has-webp');
			webpImage.forEach(function(img) {
				img.style.backgroundImage = img.style.backgroundImage.replace('webp', 'jpg');
			});
		}


		/*======================================
		=            Gallery Pop Up            =
		======================================*/

		/* HEY THERE POPUP*/
			if( $('body.rmgallery-child').length ){
				//$.removeCookie('gallerypop', { path: '/' });
				if( $.cookie('gallerypop') == null ) {
						// var theme_path = rm_data.tmplDirUri;
						console.log(theme_path);
						$.fancybox.open({

							src: theme_path +'/popup.php',
							type: 'ajax',
							opts: {
								scrolling : 'no',
								transitionEffect : 'fade',
								modal : true,
								helpers : {
										overlay : {
												css : {
														'background' : 'rgba(0, 0, 0, 0.92)'
												}
										}
								},
								live : true,
								afterClose : function(){
										$.cookie('gallerypop', 'rmg', { expires: 1, path: '/' });
								}
							}
								// type: 'ajax',
								// href : theme_path +'/popup.php',
								// padding : 5,
								// scrolling : 'no',
								// transitionIn : 'fade',
								// transitionOut : 'fade',
								// modal : true,
								// helpers : {
								// 		overlay : {
								// 				css : {
								// 						'background' : 'rgba(0, 0, 0, 0.92)'
								// 				}
								// 		}
								// },
								// live : true,

						});
				}//end cookies check

			}

		});// end of doc.ready

})(jQuery);

/*================================================
=            Analytics click tracking            =
================================================*/

function trackOutboundLink( event ) {

	// prevent the default behavior
	event.preventDefault();

	// get necessary info
	var url		= this.href;
	var label	= this.dataset.label !== 'undefined' ? this.dataset.label : url; // Fallback to URL just in case no label was set. Safety first kids
	var target	= ( this.target !== '' && this.target == '_blank' ) ? 'new' : 'self';

	// Just making sure this exists
	if ( typeof gtag !== 'undefined' ) {

		gtag( 'event', 'click', {
			'event_category': 'outbound',
			'event_label': label,
			'transport_type': 'beacon',
			'event_callback': function(){
				if ( target == 'new' ) {
					window.open( url );
				} else {
					document.location = url
				}
			}
		} );

	} else { // trigger default behavior as fallback in case the gtag was omitted
		if ( target == 'new' ) {
			window.open( url );
		} else {
			document.location = url
		}

	}

} // end tarckOutboundLink()

// Grab all our links
var linksToTrack	= document.querySelectorAll('.track-outbound');

// Add click event to all of our tracked links
for ( var i = 0; i < linksToTrack.length; i++ ) {
	linksToTrack[i].addEventListener( 'click', trackOutboundLink, false );
}

/*=====  End of Analytics click tracking  ======*/


/*==================================================================
=           WYSIWYG YouTube Button - WP Editor                     =
==================================================================*/

const youTubeWraps = document.querySelectorAll('.ytvideo');

if (youTubeWraps.length > 0) {

  function loadAndPlayYouTube(e) {
    e.preventDefault;
    const id = this.getAttribute('id');
    this.classList.add('clicked');
    if (this.classList.contains('custom-placeholder')) {
      //Add responsive iframe styles
      this.classList.add('ytvideo');
    }

    this.innerHTML = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' + id + '?&autoplay=1" frameborder="0" allow="autoplay; accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    console.log(this);
  }

  youTubeWraps.forEach(function (youTubeWrap) {
    const ytId = youTubeWrap.getAttribute('id');

    if (youTubeWrap.innerHTML === 'Video Image Placeholder') {
      youTubeWrap.innerText = '';
      youTubeWrap.style.backgroundImage = 'url(https://i3.ytimg.com/vi/' + ytId + '/maxresdefault.jpg)';
    } else {
      youTubeWrap.classList.remove('ytvideo');
      youTubeWrap.classList.add('custom-placeholder');
    }

    youTubeWrap.addEventListener('click', loadAndPlayYouTube);
  });

}

/*=====  End of Add YouTube Button to WP Dashboard WYSIWYG  ======*/

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

