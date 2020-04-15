/* JQUERY */
(function($) {	
	$(function() {//doc.ready[shorthand] start	
		var original_title = $('title').text();
		/* for when theres only one category */
		if( $('.box').length == 1){
			$('.box').show();
			var FirstID = $('#tabs li a').attr('id');
			$.cookie('WhatTab', FirstID, { expires: 1 });
		}
		else{
			$('.box:first').show();
		}	
		
		// WHEN I ARRIVE SET A COOKIE FOR THE FIRST SELECTED TAB

		if($.cookie('WhatTab') == null){
			// GET THE FIRST ID FROM THE SLECTED TAB
			var FirstID = $('#tabs li:first a').attr('id');
			$('#tabs li:first a').addClass('selected');

			// SET COOKIE
			$.cookie('WhatTab', FirstID, { expires: 1 });
			var REFID = $.cookie('WhatTab');
			//alert($.cookie('WhatTab'));

		}
		// IF IT EXISIT  OR REFRESH PAGE SET COOKIE TO CURRENT COOKIE VALUE
		else if ( $.cookie('WhatTab') != null ) {
				var FirstID = $('#tabs li:first a').attr('id');
				var REFID = $.cookie('WhatTab');
			       //console.log( REFID );
			       $('#' + REFID).addClass('selected');
			       $('.box').hide();
			       $('#' + REFID + '.box').fadeIn('medium');
			       //alert('refresh ' + $.cookie('WhatTab'));

		}

		$('#tabs a').click(function (e){
				e.preventDefault();
			    var ID = $(this).attr('id');			
				if( $('video').length ){
					$('title').html(original_title);
					$('.box .vid-single').removeClass('show__text');
					$('.box .single-vid-tmpl').html('');
					$('.box .video-link').show();	
				}

				$.cookie('WhatTab', null);
				// Set A Cookie
				   $.cookie('WhatTab', ID, { expires: 1 });
					if($.cookie('WhatTab') == ID) {
							$('#tabs a').removeClass('selected');
							$(this).addClass('selected');
							$('.box').hide();
							$('#' + ID + '.box').fadeIn('medium');
							//alert('click ' + $.cookie('WhatTab'));
					}
					else {
							$('#tabs a').removeClass('selected');
							$.cookie('WhatTab', null);
							//alert($.cookie('WhatTab', ID));
					}
				//console.log(ID);
				return false;
		});
		
		// when backbone.js is enqueued it also enqueues underscore.js (used for templating)
		// no model present 
		// json data is built through php/wordpress/function and is attached to this script through WPs localized script hook
		// json data is rm_videodata (function in functions.php)

		var vid = new Backbone.Collection( rm_videodata );
		/* backbone view that renders the video */
		var vidView = Backbone.View.extend({
			initialize: function(){
	            this.render();
	        },
			render: function(){
				//underscore templating
				var t = this,
				__template;
				t.template = _.template( $('#video_tmpl').html());
				__template = t.template(this.collection.attributes);
				return this.$el.html( __template );
			},
		});

		$('.vid-single span.showme-text a , .vid-single a.hide-text').click(function(){
			var parent = $(this).parents('.box .vid-single');
			var id = parent.attr('data-video-div-id');
			var	collection = vid.get(id);
			var videoTmpl = $('.vid-' + id + ' .single-vid-tmpl');
			var videoPH = $('.vid-' + id + ' .video-link');

				if( parent.hasClass('show__text') ){
					$('title').html(original_title);
					parent.removeClass('show__text');
					$('.box .single-vid-tmpl').html('');
					$('.box .video-link').show();
				}
				else{
					$('title').html(original_title);
					$('.box .vid-single').removeClass('show__text');
					parent.addClass('show__text');
					
					$('title').html(original_title);
					$('title').append( ' | &#9658; ' + collection.attributes.title);
					
					var video_view = new vidView({ 
						el: videoTmpl,
						collection : collection
					});
					videoPH.hide();
					videoTmpl.fadeIn();		
					
				}
		});


		/* WHEN CLICKED build from template */
		
		$(document).on('click','.video-link', function (e){
			e.preventDefault();
			var self = $(this);
			var id = self.attr('data-video-id');
			var parent = $(this).parents('.box .vid-single');
			
			var videoTmpl = $('.vid-' + id + ' .single-vid-tmpl');
			var videoPH = $('.vid-' + id + ' .video-link');
			
			var	collection = vid.get(id);
			$('title').html(original_title);
			$('title').append( ' | &#9658; ' + collection.attributes.title);
			
			$('.box .vid-single').removeClass('show__text');
			parent.addClass('show__text');

			$('.box .single-vid-tmpl').html('');
			$('.box .video-link').show();
			var video_view = new vidView({ 
				el: videoTmpl,
				collection : collection
			});
			videoPH.hide();
			videoTmpl.fadeIn();			
			

			/*
				ONLY for mobile devices or screens smaller than 680
			*/

			// if($(window).width() <= 680 ){
			// 	var vid_cords = $('#video-ph').offset().top;
			// 	$('html, body').animate({
		 //            scrollTop: vid_cords - 130
		 // 		}, 750);
		 // 			/* 
			// 			Play after scroll :) // only works for desktop (ios no work-o)
		 // 			*/
			// }
			/* AUTO PLAY video when clicked on image */
			// setTimeout(function() {
	 	// 		video = $('#video-ph video')[0];
			// 	video.play();	
	 	// 	}, 1500);
			
		});//end

	});// end of doc.ready
})(jQuery);
console.log('reno is loaded');