/* globals grecaptcha, elemarjr_script */
define( [],function () {
    if( 'undefined' === typeof grecaptcha ) {
        return;
    }

    var forms = document.querySelectorAll( '.apply-recaptcha' );

    for (var i = 0; i < forms.length; i++) {
        forms[i].addEventListener( 'submit', function( e ) {
            /**
             * Add recaptcha token data to the form before the submit
             */
            var form = e.currentTarget;

            e.preventDefault();

            grecaptcha.execute( elemarjr_script.recaptcha_site_key, { action: 'form' } ).then( function( token ) {
                form.insertAdjacentHTML( 'beforeend', '<input type="hidden" name="g-recaptcha-response" value="' + token + '" />' );
                form.submit();
            } );
        } );
    }
} );
