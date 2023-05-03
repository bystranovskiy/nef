import "../../scss/sections/section-nef-faq.scss";

"use strict";

(function ($) {

    $(document).ready(function () {
        $(".faq-question").on("click", function () {
            $(this).toggleClass("active").next(".faq-answer").slideToggle(300);
        })
    })

})(jQuery);