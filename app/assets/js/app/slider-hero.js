var slider = document.querySelector( '.slider' );
var slides = document.querySelectorAll( '.slider__item' );
var dots = document.querySelectorAll( '.slider__dots' );
var slidesLength = slides.length;
var timeout = 15000; // null or milliseconds
var slideIndex = 1;
var touchStartX = 0;
var touchEndX = 0;

function titleFontSize( element ) {
    var w = document.documentElement.clientWidth;
    var mt = -50;
    var fs = 120;
    if ( w < 992 ) {
        var l = element.querySelector( '.slider__content-title' ).innerHTML.length;
        fs = ( ( w / l ) + 5 ) < fs ? ( w / l ) + 5 : fs;
        mt = -( fs / 2 );
    }
    element.querySelector( '.slider__content-title' ).style.fontSize = fs + 'px';
    element.querySelector( '.slider__content-subtitle' ).style.marginTop = mt + 'px';
}

function displayWindowSize(){
    slides.forEach( titleFontSize );
}

function currentSlide( n ) {
    if ( n < 1 ) {
        n = slidesLength;
    } else if ( n > slidesLength ) {
        n = 1;
    }
    showSlides( slideIndex = n );
}

function autoPlay() {
    setInterval( function() {
        slideIndex++;
        currentSlide( slideIndex );
    }, timeout );
}

function handleGesure() {
    if ( touchEndX === touchStartX ) {
        return;
    }
    if ( touchEndX <= touchStartX ) {
        currentSlide( slideIndex + 1 );
    }
    if ( touchEndX >= touchStartX ) {
        currentSlide( slideIndex - 1 );
    }
}

function showSlides() {
    for ( var i = 0; i < slidesLength; i++ ) {
        slides[i].classList.remove( 'slider__item--active' );
        dots[i].classList.remove( 'slider__dots--active' );
    }
    slides[ slideIndex - 1 ].classList.add( 'slider__item--active' );
    dots[ slideIndex - 1 ].classList.add( 'slider__dots--active' );
}

if ( slides.length > 0 && null !== timeout ) {
    autoPlay();
}
if ( slides.length > 0 ) {
    showSlides( slideIndex );
    displayWindowSize();

    window.addEventListener( 'resize', displayWindowSize );

    slider.addEventListener( 'touchstart', function( event ) {
        touchStartX = event.changedTouches[0].screenX;
    }, false);

    slider.addEventListener( 'touchend', function( event ) {
        touchEndX = event.changedTouches[0].screenX;
        handleGesure();
    }, false);
}
