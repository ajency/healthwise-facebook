/**
 * Theme functions file
 *
 * Contains handlers for navigation, accessibility, header sizing
 * footer widgets and Featured Content slider
 *
 */
( function( $ ) {
	var body    = $( 'body' ),
		_window = $( window );

	// Enable menu toggle for small screens.
	( function() {
		var nav = $( '#primary-navigation' ), button, menu;
		if ( ! nav ) {
			return;
		}

		button = nav.find( '.menu-toggle' );
		if ( ! button ) {
			return;
		}

		// Hide button if menu is missing or empty.
		menu = nav.find( '.nav-menu' );
		if ( ! menu || ! menu.children().length ) {
			button.hide();
			return;
		}

		$( '.menu-toggle' ).on( 'click.codium_light', function() {
			nav.toggleClass( 'toggled-on' );
		} );
	} )();

	

	$( function() {
		// Search toggle.
		$( '.search-toggle' ).on( 'click.codium_light', function( event ) {
			var that    = $( this ),
				wrapper = $( '.search-box-wrapper' );

			that.toggleClass( 'active' );
			wrapper.toggleClass( 'hide' );

			if ( that.is( '.active' ) || $( '.search-toggle .screen-reader-text' )[0] === event.target ) {
				wrapper.find( '.search-field' ).focus();
			}
		} );


		// Focus styles for menus.
		$( '.primary-navigation, .secondary-navigation' ).find( 'a' ).on( 'focus.codium_light blur.codium_light', function() {
			$( this ).parents().toggleClass( 'focus' );
		} );
	} );


} )( jQuery );
