(function ($) {

    var logo = $('#logo'),
        search_header = $('#search-header'),
        sidebar_top = $('#sidebar-top');

    $(document).ready(function () {
        if ($(window).width() >= 768) {
            search_header.css('marginTop', ( ( (logo.height() + 60 ) / 2) - (search_header.height() / 2) ) + 'px');
            sidebar_top.css('marginTop', ( ( (logo.height() + 60 ) / 2) - (sidebar_top.height() / 2) ) + 'px');
        }

        $('.tabs').fwTabs();
        $('.post_content').fitVids();

        // Slider
        $('#featured-posts').fwCarousel({
            autoPlay: _lightlyJS.slider.autoPlay,
            delay: _lightlyJS.slider.delay
        });
    });

    $(window).resize(function () {
        if ($(window).width() >= 768) {
            search_header.css('marginTop', ( ( (logo.height() + 60 ) / 2) - (search_header.height() / 2) ) + 'px');
            sidebar_top.css('marginTop', ( ( (logo.height() + 60 ) / 2) - (sidebar_top.height() / 2) ) + 'px');
        } else {
            search_header.css('marginTop', '0');
            sidebar_top.css('marginTop', '0');
        }
    });

})(jQuery);


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
 */
(function (w) {
    // This fix addresses an iOS bug, so return early if the UA claims it's something else.
    if (!( /iPhone|iPad|iPod/.test(navigator.platform) && navigator.userAgent.indexOf("AppleWebKit") > -1 )) {
        return;
    }

    var doc = w.document;

    if (!doc.querySelector) {
        return;
    }

    var meta = doc.querySelector("meta[name=viewport]"),
        initialContent = meta && meta.getAttribute("content"),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
        x, y, z, aig;

    if (!meta) {
        return;
    }

    function restoreZoom() {
        meta.setAttribute("content", enabledZoom);
        enabled = true;
    }

    function disableZoom() {
        meta.setAttribute("content", disabledZoom);
        enabled = false;
    }

    function checkTilt(e) {
        aig = e.accelerationIncludingGravity;
        x = Math.abs(aig.x);
        y = Math.abs(aig.y);
        z = Math.abs(aig.z);

        // If portrait orientation and in one of the danger zones
        if (!w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) )) {
            if (enabled) {
                disableZoom();
            }
        }
        else if (!enabled) {
            restoreZoom();
        }
    }

    w.addEventListener("orientationchange", restoreZoom, false);
    w.addEventListener("devicemotion", checkTilt, false);

})(window);


(function ($) {

    $.fn.fwTabs = function (options) {
        var settings = $.extend({}, $.fn.fwTabs.defaults, options);
        var active = 0;
        var tabs = $(this);

        $('.nav-tab li', tabs).click(function () {
            idx = $(this).index();
            if (idx == $('.nav-tab li.tab-active', tabs).index()) return false;
            startTab(tabs, idx);
            return false;
        });

        function startTab(tabs, idx) {
            $('.active', tabs).fadeOut().removeClass('active').addClass('hide');
            $('.tab-content', tabs).eq(idx).removeClass('hide').addClass('active').fadeIn();
            $('li.tab-active', tabs).removeClass('tab-active');
            $('.nav-tab li', tabs).eq(idx).addClass('tab-active');
        }

        function resizeTab(tabs) {
            $('.nav-tab li', tabs).css({'padding-left': '0px', 'padding-right': '0px'});
            total = tabs.width();
            firstTab = $('.nav-tab li', tabs).eq(0).width();
            secondTab = $('.nav-tab li', tabs).eq(1).width() - 1;
            thirdTab = $('.nav-tab li', tabs).eq(2).width() - 1;
            totalTab = firstTab + secondTab + thirdTab;
            thePad = ( total - totalTab ) / 6;
        }
    };

})(jQuery);