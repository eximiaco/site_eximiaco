function translate_request(element,language)// jshint ignore:line
{

    document.getElementById('request-message').innerHTML =  element.getAttribute('data-form-message');
    document.getElementById('translate-request-input-name').setAttribute('placeholder', element.getAttribute('data-input-name'));
    document.getElementById('translate-request-input-email').setAttribute('placeholder', element.getAttribute('data-input-email'));
    document.getElementById('translate-request-submit').value = element.getAttribute('data-submit');

    document.getElementById('language-message-success').value = element.getAttribute('data-message-success');
    document.getElementById('language-message-error').value = element.getAttribute('data-message-error');

    document.getElementById('language-input').value = language;
    document.getElementById('translate-request-box').classList.add('animated', 'fadeInUp');
    document.getElementById('translate-request-box').style.display = 'block';

}
