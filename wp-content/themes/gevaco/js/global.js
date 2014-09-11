

require.config({
	baseUrl: "/wp-content/themes/gevaco/js",
	paths: {
		jquery: "//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min",
		"picker": "vendor/Picker/jquery.fs.picker",
		"domReady": "vendor/domready/ready.min",
		"magnific-popup": "vendor/magnific-popup/dist/jquery.magnific-popup.min"
	},
	shim: {
		"picker": ["jquery"],
		"magnific-popup": ["jquery"]
	}
});

// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

require(['jquery', 'picker', 'magnific-popup'], function($, picker, popup, validation) {
	// "use strict";

	var gevaco = {
		init: function() {
			$('.no-js').removeClass('no-js');
			gevaco.focusInput();
			gevaco.dressPickers();
			gevaco.dressGallery();
			gevaco.dressMobileNav();
		},

		dressMobileNav: function() {
			$('.mobile-trigger a.trigger, .nav-container .close').click(function(e){
				e.preventDefault();
				$('.nav-container, .mobile-trigger').slideToggle();
			});
		},

		dressGallery: function() {
			$('.gallery-wrapper').magnificPopup({
			  delegate: 'a',
			  type: 'image',
			  gallery:{
					enabled:true,
					preload: [0,2],
					tCounter:'',
					navigateByImgClick: true
			  },
			  tLoading: ''
			});
		},

		focusInput: function() {
			$('input[type="text"], input[type="tel"], input[type="email"], textarea').on('focus', function() {
		    $(this).closest('.form-item').addClass('focus');
		  }).on('blur', function() {
		    $(this).closest('.form-item').removeClass('focus');
		  });
		},

		dressPickers: function() {
			$("input[type=radio], input[type=checkbox]").picker();
		}
	};

	// Trigger actions when DOM is ready
	require(['domReady'], function (domReady) {
	  domReady(function () {
			$(gevaco.init);
	  });
	});
});