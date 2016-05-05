(function($) {
 "use strict";

$(document).ready(function($) {

	$('body').addClass('bg-cover');

	// Style Selector	
	$('#style-selector').animate({
		left: '-280px'
	});

	$('#style-selector a.close').click(function(e){
		e.preventDefault();
		var div = $('#style-selector');
		if (div.css('left') === '-280px') {
			$('#style-selector').animate({
				left: '0'
			});
			$(this).removeClass('icon-chevron-left');
			$(this).addClass('icon-chevron-right');
		} else {
			$('#style-selector').animate({
				left: '-280px'
			});
			$(this).removeClass('icon-chevron-right');
			$(this).addClass('icon-chevron-left');
		}
	})


	

});

})(jQuery);
