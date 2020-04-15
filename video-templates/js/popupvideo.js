/* JQUERY */
(function($) {	
	$(function() {//doc.ready[shorthand] start	
		console.log('PopUp Video!');
		var heyjaxurl = rmvData.ajaxurl;
		$('.popup--video').click( function (e){
			e.preventDefault();
			//var ajxxurl = typeof(ajaxurl) != 'undefined' ? ajaxurl : e.href.split('?')[0].replace(document.location.protocol + '//' + document.location.hostname, "");
			var self = $(this);
			var videofile = self.attr('data-video-file'),
				videowidth = self.attr('data-video-width'),
				videoheight = self.attr('data-video-height'),
				videowrap = self.attr('data-video-wrap');
			$.ajax({
				url: heyjaxurl,
				type: 'get',
				data: {
					action: 'rmv_ajax__video',
					file : videofile,
					width : videowidth,
					height : videoheight,
					wrap   : videowrap
				},
			}).done(function( response ){
				$.fancybox({
					content : response,
					'autoCenter' : true,
					helpers: {
			    		overlay: {
			      			locked: false
			    		}
			  		},
				});
			});
			
		});
	});// end of doc.ready
})(jQuery);		