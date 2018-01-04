jQuery( document ).ready( function($) {

	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			  $('.scrollup').fadeIn();
		} else {
			  $('.scrollup').fadeOut();
		}
	});

	$('.scrollup').click(function () {
		  $("html, body").animate({
			  scrollTop: 0
		  }, 600);
		  return false;
	});

	// add submenu icons class in main menu (only for large resolution)
	if ( $(window).width() >= 800 ) {
	
		$('#navmain > div > ul > li:has("ul")').addClass('level-one-sub-menu');
		$('#navmain > div > ul li ul li:has("ul")').addClass('level-two-sub-menu');										
	}

	$('#navmain > div').on('click', function(e) {

		e.stopPropagation();

		// toggle main menu
		if ( $(window).width() < 800 ) {

			var parentOffset = $(this).parent().offset(); 
			
			var relY = e.pageY - parentOffset.top;
		
			if (relY < 36) {
			
				$('ul:first-child', this).toggle(400);
			}
		}
	});

	$("#navmain > div > ul li").mouseleave( function() {
		if ( $(window).width() >= 800 ) {
			$(this).children("ul").stop(true, true).css('display', 'block').slideUp(300);
		}
	});
	
	$("#navmain > div > ul li").mouseenter( function() {
		if ( $(window).width() >= 800 ) {

			var curMenuLi = $(this);
			$("#navmain > div > ul > ul:not(:contains('#" + curMenuLi.attr('id') + "')) ul").hide();
		
			$(this).children("ul").stop(true, true).css('display','none').slideDown(400);
		}
	});

	if (jQuery('#photostack').length > 0 && typeof Photostack == 'function') { 
	    new Photostack( document.getElementById( 'photostack' ), {
	        callback : function( item ) {
	        }
	    } );
	}

});
