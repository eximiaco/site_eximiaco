( function( $ ) {
	'use strict';

	window.onload = function() {
        var textareas = document.querySelectorAll( 'textarea[name^="description_"]' );

		for ( var i = 0; i < textareas.length; i++ ) {
			var textarea, id, options;

			textarea = textareas[ i ];
			textarea.setAttribute( 'id', textarea.getAttribute('name') );
			id = textarea.getAttribute( 'id' );
			options = {'quicktags':true,'tinymce':true};

            wp.editor.initialize( id, options );
		}

		setTimeout( function() {
            for ( var i = 0; i < textareas.length; i++ ) {
                var textarea, id, oldValue, newValue;

                textarea = textareas[ i ];

                // add padding bottom to description tinymce
                if( i < ( textareas.length - 1 ) ){
                    $( textarea ).closest('div[id^="wp-description"]').css('padding-bottom', '20px');
                }

				id = textarea.getAttribute( 'id' );
				oldValue = textarea.value;
				newValue = wp.editor.getContent( id );

				if ( oldValue === newValue ) {
                    continue;
				}

				textarea.value = newValue;
                $( textarea ).trigger( 'change' );

			}
		}, 500 );
	};
})( jQuery );
