define(function () {
    function translate_request() {
        document.getElementById('request-message').innerHTML = this.getAttribute('data-form-message');
        document.getElementById('translate-request-input-name').setAttribute('placeholder', this.getAttribute('data-input-name'));
        document.getElementById('translate-request-input-email').setAttribute('placeholder', this.getAttribute('data-input-email'));
        document.getElementById('translate-request-submit').value = this.getAttribute('data-submit');

        document.getElementById('language-input').value = this.getAttribute('data-language');

        display_hide_translate_request_box('open');
    }

    var elements = document.querySelectorAll('.request-translate');

    elements.forEach(function (item) {
        item.addEventListener('click', translate_request);
    });

    document.querySelector('.btn-close-icon').addEventListener('click', function () {
        display_hide_translate_request_box('close');
    });

    function display_hide_translate_request_box(action) {
        var translate_request_box = document.getElementById('translate-request-box'),
            inverse_action = 'close';

        ('close' === action) && (inverse_action = 'open');

        translate_request_box.classList.remove(inverse_action);
        translate_request_box.classList.add(action);
    }
});
