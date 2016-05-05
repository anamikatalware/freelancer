(function ( $ ) {

    $.fn.appendSimpleProgressBar = function( options ) {

        var settings = $.extend({
            background_box: "#EEE",
            background_bar: "green",
			width: "0"
        }, options );

		$(this).append('<div class="dioprogress_radius dioprogress_size_l dioprogress_padding">');
		$(this).find('div').css({
			background: settings.background_box
		});

		$(this).find('div').append('<div class="dioprogress_radius dioprogress_size_l"></div>');
        $(this).find('div').find('div').css({
			background: settings.background_bar,
			width: settings.width
		});

    };

    $.fn.appendSimpleXlProgressBar = function( options ) {

        var settings = $.extend({
            background_box: "#EEE",
            background_bar: "green",
            width: "0"
        }, options );

        $(this).append('<div class="dioprogress_radius dioprogress_size_xl dioprogress_padding">');
        $(this).find('div').css({
            background: settings.background_box
        });

        $(this).find('div').append('<div class="dioprogress_radius dioprogress_size_xl"></div>');
        $(this).find('div').find('div').css({
            background: settings.background_bar,
            width: settings.width
        });

    };

	$.fn.slow = function( options ) {

		var settings = $.extend({
			opacity: "1",
            width: "100"
		}, options );


		$(this).find('div').find('div').animate({
		        width: settings.width + '%',
		        opacity: settings.opacity
		    },
		    5000 ,
		    function() {
		        console.log( "test done!" );
		    }
		);


	};
    $.fn.fast = function( options ) {

        var settings = $.extend({
            opacity: "1",
            width: "100"
        }, options );


        $(this).find('div').find('div').animate({
                width: settings.width + '%',
                opacity: settings.opacity
            },
            1000 ,
            function() {
                console.log( "test done!" );
            }
        );


    };
}( jQuery ));
