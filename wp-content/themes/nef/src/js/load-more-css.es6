"use strict";

(function ($) {

    $(document).ready(function () {
        const hidden = function ($container) {
            return $container.children(".show-more-item:hidden");
        }
        $(".show-more-btn").on("click", function () {
            const $container = $(this).prev(".show-more-container");
            hidden($container).slice(0, $(this).data("next")).fadeIn()
            if (!hidden($container).length) {
                $(this).remove();
            }
        })
    });

})(jQuery);