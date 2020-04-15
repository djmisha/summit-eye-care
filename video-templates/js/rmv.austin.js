/* JQUERY */
(function($) {	
	$(function() {//doc.ready[shorthand] start	
	
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

		//$.cookie('WhatTab') == null || $.cookie('WhatTab') != null // this always defaults to the first category
		if($.cookie('WhatTab') == null || $.cookie('WhatTab') != null){
			// GET THE FIRST ID FROM THE SLECTED TAB
			var FirstID = $('#tabs li:first a').attr('id');
			$('#tabs li:first a').addClass('selected');

			$('#tabs li:first a').parent().addClass('selected-li');

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
			       $('#' + REFID).parent().addClass('selected-li');

			       $('.box').hide();
			       $('#' + REFID + '.box').fadeIn('medium');
			       //alert('refresh ' + $.cookie('WhatTab'));

		}

		$('#tabs a').click(function (e){
				e.preventDefault();
			    var ID = $(this).attr('id');			
				$.cookie('WhatTab', null);
				// Set A Cookie
				   $.cookie('WhatTab', ID, { expires: 1 });
					if( $.cookie('WhatTab') == ID ) {
							$('#tabs a').removeClass('selected');
							$('#tabs a').parent().removeClass('selected-li');
							
							$(this).addClass('selected');
							$(this).parent().addClass('selected-li');
							$('.box').hide();
							$('#' + ID + '.box').fadeIn('medium');
							//alert('click ' + $.cookie('WhatTab'));
					}
					else {
							$('#tabs a').removeClass('selected');
							$('#tabs a').parent().removeClass('selected-li');
							
							$.cookie('WhatTab', null);
							//alert($.cookie('WhatTab', ID));
					}
				//console.log(ID);
				return false;
		});

		//console.log($.cookie('WhatTab'));
		
		// when backbone.js is enqueued it also enqueues underscore.js (used for templating)
		// no model present 
		// json data is rm_videodata is a localized script
		// json data is built in rmvideo/app/dispatcher.php -> video_json

		var vid = new Backbone.Collection( rm_videodata );
		
		var vidView = Backbone.View.extend({
			initialize: function(){
	            this.render();
	        },
			render: function(){
				//underscore templating
				var t = this,
				__template;
				if( typeof this.collection.attributes.video_youtube_name != 'undefined' &&  this.collection.attributes.video_youtube_name != ''){
					t.template = _.template( $('#video_tmpl_yt').html());
				}else{
					t.template = _.template( $('#video_tmpl').html());

				}
				__template = t.template(this.collection.attributes);
				
				return this.$el.html( __template );
			},
		});

		/* onload build from template using first video */
		if(REFID == undefined){
			first_vid = $('.vid-wrapper').find(">:first-child").attr('data-video-div-id');
		}
		else{
			first_vid = $('div#' + REFID ).find(">:first-child").attr('data-video-div-id');
		}

		collection = vid.get(first_vid);
		
		var video_view = new vidView({ 
				el: $("#video-ph"),
				collection : collection
			});

		/* WHEN CLICKED build from template */
		$(document).on('click','#video-player .video-link', function (e){
			e.preventDefault();
			var self = $(this);
				var id = self.attr('data-video-id');
				collection = vid.get(id);

			var video_view = new vidView({ 
				el: $("#video-ph"),
				collection : collection
			});
			//console.log(collection);
			

			/*
				ONLY for mobile devices or screens smaller than 680
			*/

			//if($(window).width() <= 680 ){
				var vid_cords = $('#video-ph').offset().top - 50;
				$('html, body').animate({
		            scrollTop: vid_cords - 130
		 		}, 750);	
			//}
			/* 
					Play after scroll :) // only works for desktop (ios no work-o)
	 			*/
			/* AUTO PLAY video when clicked on image */
			if( collection.video_youtube_name == "" ){
				setTimeout(function() {
	 				video = $('#video-ph video')[0];
					video.play();	
	 			}, 1500);
			}
			
			
		});//end


	});// end of doc.ready
})(jQuery);
console.log('austin is loaded! fully loaded! cheese , bacon , salsa and sour cream! now that\'s a meal :)');