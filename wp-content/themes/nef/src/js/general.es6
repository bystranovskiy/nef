"use strict";

(function ($) {

    const $html = $("html");
    const $body = $("body");


    /**
     * Mobile menu toggle
     */

    $(document).ready(function () {
        $(".mobile-menu-toggle").on("click", function () {
            if ($html.hasClass("mobile-menu-opened")) {
                $html.removeClass("mobile-menu-opened");
                $(window).scrollTop($body.attr("data-pos"));
            } else {
                $body.attr("data-pos", $(window).scrollTop());
                $html.addClass("mobile-menu-opened");
            }
        })
    });

    /**
     * Search form reset button toggle
     */

    $(document).ready(function () {
        $(".search-form").each(function () {
            const $text = $(this).find("input[name='text']");
            const $cancel = $text.next(".icon-cancel");
            if ($text.val()) {
                $cancel.show();
            }
            $text.on("input", function (e) {
                if (e.target.value.length > 0) {
                    $cancel.fadeIn(300);
                } else {
                    $cancel.fadeOut(300);
                }
            })
        })


    });


    /**
     * Sticky header
     */

    let lastScrollTop = 0;
    $(window).on("load scroll", function (e) {
        const newScrollTop = Math.abs($(this).scrollTop());
        if (newScrollTop > 0) {
            $("header").addClass("sticky");
        } else {
            $("header").removeClass("sticky");
        }
        if (newScrollTop > lastScrollTop && newScrollTop > 200) {
            $("header").addClass("hidden");
        } else {
            $("header").removeClass("hidden");
        }
        lastScrollTop = newScrollTop;
    });


})(jQuery);