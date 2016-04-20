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
});