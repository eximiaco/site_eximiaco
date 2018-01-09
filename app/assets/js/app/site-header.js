/**
 * Manipulate site header behavior
 */
define([],function () {
	/*
	 * Load the background header
	 */
	var $siteHeader = jQuery( '.site-header' ),
		bg = $siteHeader.data('bg'),
		$topHeader = jQuery( '.top-header-wrapper' ),
		headerStickyClass = 'top-header-wrapper__sticky'
		$body = jQuery( 'body' ),
		bodyStickyClass = 'sticky';

	if( '' !== bg ) {
    	$siteHeader.css( 'background-image', 'url("' + bg + '")' );
	}

	/*
	 * Hide the navigation when open the search
	 */
	jQuery( '.search-toggle' ).on( 'click', function() {
		jQuery( '.main-navigation' ).removeClass( 'toggled' );
	} );

	/*
	 * Hide the search when open the navigation
	 */
	jQuery( '.menu-toggle' ).on( 'click', function() {
		jQuery( '.site-search' ).removeClass( 'toggled' );
	} );

	jQuery( window )
		.on( 'scroll', function() {
			if( jQuery( this ).scrollTop() > 0 ) {
				$body.addClass( bodyStickyClass );
				$topHeader.addClass( headerStickyClass );
			} else {
				$body.removeClass( bodyStickyClass );
				$topHeader.removeClass( headerStickyClass );
			}
		} )
		.trigger( 'scroll' );
});