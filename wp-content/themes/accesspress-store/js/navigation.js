/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function() {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};
} )();

jQuery('.search-icon').click(function() {
	jQuery('.search-box').toggleClass('active');
});

jQuery('.search-box .close').click(function() {
	jQuery('.search-box').removeClass('active');
});
jQuery(document).ready(function() {
	//jQuery('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');
	jQuery(window).on('load', function() {

			var width = Math.max(window.innerWidth, document.documentElement.clientWidth);

        	 if (width && width <= 687) {
				jQuery('.menu-toggle,#site-navigation a').click(function() {
					jQuery('#site-navigation .menu-primary-container,#site-navigation div.menu').slideToggle();
				});
				jQuery(".store-menu ul li ul.sub-menu").hide();
	    	}
	});
				jQuery(window).resize(function(){
					var width = Math.max(window.innerWidth, document.documentElement.clientWidth);
					console.log(width);
					if (width && width <= 687) {
						jQuery(".store-menu ul li ul.sub-menu").hide();	
					}else{jQuery(".store-menu ul li ul.sub-menu").show();	}
				});
   jQuery('#site-navigation .menu-item-has-children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

   jQuery('#site-navigation .sub-toggle').click(function() {
      jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
      jQuery(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
   });
   
});	
/*
jQuery(function () {
	jQuery('.store-menu ul li').not(".store-menu ul li ul li").click(function(e){
		jQuery(".store-menu ul li ul").hide();
		jQuery(this).children('ul').stop().toggle();
		e.stopPropagation();
	});
	jQuery(".store-menu ul li ul li").click(function(e){
		$(this).children('ul').stop().toggle();
		e.stopPropagation();
	});
});

jQuery(document).click(function() {
	jQuery(".store-menu ul li ul").hide();
});*/