define(function () {
    function translate_request() {
        document.getElementById('request-message').innerHTML =  this.getAttribute('data-form-message');
        document.getElementById('translate-request-input-name').setAttribute('placeholder', this.getAttribute('data-input-name'));
        document.getElementById('translate-request-input-email').setAttribute('placeholder', this.getAttribute('data-input-email'));
        document.getElementById('translate-request-submit').value = this.getAttribute('data-submit');

        document.getElementById('language-message-success').value = this.getAttribute('data-message-success');
        document.getElementById('language-message-error').value = this.getAttribute('data-message-error');

        document.getElementById('language-input').value = this.getAttribute('data-language');
        document.getElementById('translate-request-box').classList.add('animated', 'fadeInUp');
        document.getElementById('translate-request-box').style.display = 'block';
    }

    var elements = document.querySelectorAll('.request-translate');

    elements.forEach(function (item) {
        item.addEventListener('click', translate_request);
    });
});

