// define the WordPress jQuery as a module
if (typeof jQuery === 'function') {
    define('jquery', function() {
        return jQuery;
    });
}

// start the application
require([
    'app/animation',
    'app/font',
    'app/hero',
    'app/image-bg',
    'app/menu',
    'app/newsletter',
    'app/post-list',
    'app/scroll-button',
    'app/row',
    'app/indexes',
    'app/site-footer',
    'app/site-header',
    'app/site-navigation',
    'app/site-search',
    'app/testimonial',
    'app/translate-request',
    'app/message'
], function() {
    setTimeout(function() {
        jQuery( window ).trigger('resize');
    }, 300);
});
