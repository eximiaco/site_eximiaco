jQuery( document ).ready( function() {

    // hide default avatar image
    jQuery( '.user-profile-picture' ).hide();

    /* WP Media Uploader */
    // var _orig_send_attachment = wp.media.editor.send.attachment;

    jQuery( '.profile-image' ).click( function() {

        var button = jQuery( this ),
            textbox_id = jQuery( this ).attr( 'data-id' ),
            image_id = jQuery( this ).attr( 'data-src' ),
            _profile_media = true;

        wp.media.editor.send.attachment = function( props, attachment ) {

            if ( _profile_media && ( attachment.type === 'image' ) ) {
                var current_element;

                if ( image_id.indexOf( ',' ) !== -1 ) {
                    image_id = image_id.split( ',' );
                    var $image_ids = '';
                    jQuery.each( image_id, function( key, value ) {
                        if ( $image_ids ) {
                            $image_ids = $image_ids + ',#' + value;

                        } else {
                            $image_ids = '#' + value;
                        }
                    } );

                    current_element = jQuery( $image_ids );
                } else {
                    current_element = jQuery( '#' + image_id );
                }

                jQuery( '#' + textbox_id ).val( attachment.id );
                current_element.attr( 'src', attachment.url ).show();
            } else {
                window.alert( 'Please select a valid image file' );
                return false;
            }
        };

        wp.media.editor.open( button );
        return false;
    } );

} );
