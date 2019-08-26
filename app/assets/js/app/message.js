define(function () {
    if (document.body.contains(document.getElementById('close-message-box'))){
        document.getElementById('close-message-box').addEventListener('click', function () {
            document.querySelector('.return-message-box').classList.add('close');
        });
    }
});
