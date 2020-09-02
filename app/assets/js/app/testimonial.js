var swiper1;
var swiper2;

/**
 * Manipulate header to show after load the font
 */
define( [ 'swiper/dist/js/swiper' ], function ( Swiper ) {
    swiper1 = new Swiper( '.swiper-container.swiper1', {
      slidesPerView: 2,
      spaceBetween: 20,
      slidesPerPage: 1,
      navigation: {
        nextEl: '.swiper-button-next.next-swiper1',
        prevEl: '.swiper-button-prev.prev-swiper1'
      },
      autoplay: {
        delay: 10000,
        disableOnInteraction: false
      },
      breakpoints: {
        425: {
            slidesPerView: 2,
            spaceBetween: 0,
            slidesPerPage: 2
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 50,
            slidesPerPage: 4
        },
        1024: {
            slidesPerView: 5,
            spaceBetween: 50,
            slidesPerPage: 5
        },
        1440: {
            slidesPerView: 6,
            spaceBetween: 70,
            slidesPerPage: 6
        },
        2560: {
            slidesPerView: 6,
            spaceBetween: 70,
            slidesPerPage: 6
        }
      }
    });
    swiper2 = new Swiper( '.swiper-container.swiper2', {
        pagination: {
            el: '.swiper-pagination.pagination-swiper2',
            type: 'fraction'
        },
        navigation: {
            nextEl: '.swiper-button-next.next-swiper2',
            prevEl: '.swiper-button-prev.prev-swiper2'
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
            // when window width is >= 1024px
            1024: {
              slidesPerView: 2
            },
            // when window width is >= 1190px
            1190: {
                slidesPerView: 3
            }
        }
    } );
});
