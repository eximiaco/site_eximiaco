define(function () {
    var singlePost = document.querySelector( '.single-post' );
    var singleBliki = document.querySelector( '.single-bliki' );
    if ( singlePost === undefined || singlePost === null || singleBliki === undefined || singleBliki === null ) {

        // When the user scrolls the page, execute myFunction
        window.onscroll = function() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrolled = (winScroll / height) * 100;

            if( scrolled > 1) {
                document.getElementById('myBar1').style.width = '100%';
                document.getElementById('myBar2').style.width = scrolled + '%';
            } else {
                document.getElementById('myBar1').style.width = '0%';
            }
        };
    }
});
