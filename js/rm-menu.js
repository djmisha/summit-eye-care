// /******************************/
// 	/*           RM Menu          */
// 	/******************************/



// $tablet = 768;
// $desktop = 1010;


// //RM Menu


// 	//Insert Nav Dropdown Button
// 	$("<span class=\"nav-dropdown-button\"><span class=\"dropdown-arrow\"></span></span>").insertAfter(".menu-item-has-children > a");

// 	//Insert Close Button
// 	$("<span class=\"close-menu\">Close Menu</span>").insertAfter(".main-menu > .menu-item:last-of-type");

// 	//Add/Remove Off-Canvas Menu Classes
// 	var slideRightRemoveClass = true;
// 		$(".menu-trigger").click(function () {
// 			$("body").toggleClass('menu-is-open');
// 			var el = $(this);
// 			slideRightRemoveClass = false;

// 			//console.log(el.parent().next());

// 		});

// 		$(".menu-wrap").click(function() {
// 			slideRightRemoveClass = false;
// 		});

// 		$("html, .close-menu").click(function () {
// 			if (slideRightRemoveClass) {
// 				$("body").removeClass('menu-is-open');
// 			}
// 			slideRightRemoveClass = true;
// 		});

// 		//Make the mobile menu work when switching between sizes
// 		$(window).on("load resize",function(e){
// 			if ($("html").hasClass("is--device") || $(window).width() < $desktop) {
// 				$(".menu-wrap").addClass("touch-menu");
// 				$(".menu-wrap").removeClass("hover-menu");
// 			}
// 			else{
// 				$("body").removeClass("menu-is-open");
// 				$(".menu-wrap").removeClass("touch-menu");
// 				$(".menu-wrap").addClass("hover-menu");
// 			}



// 			if ($("html").hasClass("is--device") || $(window).width() < $desktop) {

// 				//make dropdown button same height as #menu-main a
// 				$('.nav-dropdown-button').each(function(index, obj){
// 					var navDropdown = $(this).prev().outerHeight();
// 						// $(this).css({
// 						// 	'height': navDropdown + 'px'
// 						// });
// 				});

// // Removed because it was causing a problem on scroll
// 				// setTimeout(
// 				//   function()
// 				//   {
// 				//    	$('.touch-menu ul.sub-menu').hide();
// 				//   }, 500);
// 				//


// 				$('.touch-menu > .main-menu > li.menu-item-has-children > .nav-dropdown-button, .touch-menu .sub-menu > li.menu-item-has-children > .nav-dropdown-button').unbind('click');
// 				$('.touch-menu > .main-menu > li.menu-item-has-children > .nav-dropdown-button, .touch-menu .sub-menu > li.menu-item-has-children > .nav-dropdown-button').on('click' , function(e){
// 					e.preventDefault();
// 					var el = $(this);
// 					console.log(el);
// 					el.parent().toggleClass('sub-menu-open');
// 					// el.next().find('.sub-menu').slideToggle( 400 );
// 					el.next().slideToggle( 400 );
// 				});
// 			}
// 			else{
// 				$('.menu > li.menu-item-has-children > a, .menu .sub-menu > li.menu-item-has-children > a').unbind('click');
// 				$('ul.sub-menu, .menu').removeAttr('style');
// 			}
// 		});



// 	/******************************/
// 	/*         End RM Menu        */
// 	/******************************/