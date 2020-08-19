var swiper;

/**
 * Manipulate header to show after load the font
 */
define( [ 'swiper/dist/js/swiper' ], function ( Swiper ) {
    swiper = new Swiper( '.swiper-container', {
        pagination: {
            el: '.swiper-pagination',
            type: 'fraction'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        slidesPerView: 3,
        spaceBetween: 0,
        breakpoints: {
            // when window width is >= 480px
            480: {
              slidesPerView: 1
            },
            // when window width is >= 768px
            768: {
              slidesPerView: 2
            },
            // when window width is >= 1190px
            1190: {
              slidesPerView: 3
            }
        }
    } );
});
