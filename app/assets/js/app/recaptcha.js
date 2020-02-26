/* globals grecaptcha, elemarjr_script */
define([],function () {
    if( 'undefined' === typeof grecaptcha ) {
        return;
    }

    var form = document.querySelector('.form');

    /**
     * Add recaptcha token data to the form before the submit
     */
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        grecaptcha.execute(elemarjr_script.recaptcha_site_key, {action: 'form'}).then(function(token) {
            form.insertAdjacentHTML('beforeend', '<input type="hidden" name="g-recaptcha-response" value="' + token + '" />');
            form.submit();
        });
    });
});
