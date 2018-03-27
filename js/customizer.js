/**
 * Theme Customizer enhancements for a better user experience.
 */

(function ($, api) {

    api('blogname', function (value) {
        value.bind(function (to) {
            $('.site-title').text(to);
        });
    });

    api('blogdescription', function (value) {
        value.bind(function (to) {
            $('.site-description').text(to);
        });
    });

    api('featured_slider_title', function (value) {
        value.bind(function (to) {
            $('#featured-posts .widgettitle span').text(to);
        });
    });

})(jQuery, wp.customize);
