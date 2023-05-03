import "../../scss/pages/page-nefologism.scss";

"use strict";

(function ($) {

    $(document).ready(function () {

        $(".nef-group-title").on("click", function () {
            if ($(this).parent(".nef-group").hasClass("active")) {
                $(this).next(".nef-items-list").find(".nef-item").removeClass("active").find(".nef-item-description").slideUp(300);
            }
            $(this).parent(".nef-group").toggleClass("active");
            $(this).next(".nef-items-list").slideToggle(300);

        });

        $(".nef-item-title").on("click", function () {
            $(this).parent(".nef-item").toggleClass("active");
            $(this).next(".nef-item-description").slideToggle(300);
        });

        const $form = $("#nef-search-form");
        const $submit = $("#nef-submit");
        const $reset = $("#nef-reset");
        const $nothing_found = $("#nothing-found");

        $form.on("submit", function (e) {
            e.preventDefault();
            const values = $(this).serializeArray();
            const text = values[0]["value"];
            if (text.length > 2) {
                $(".nef-item, .nef-group").removeClass("active");
                $(".nef-item, .nef-group, .nef-items-list, .nef-item-description").hide();
                $(".nef-item-title").each(function () {
                    if ($(this).text().toLowerCase().includes(text.toLowerCase())) {
                        $(this).next(".nef-item-description").show();
                        $(this).parent(".nef-item").addClass("active").show();
                        $(this).closest(".nef-items-list").show();
                        $(this).closest(".nef-group").addClass("active").fadeIn(300)
                    }
                });
                if ($(".nef-group:visible").length === 0) {
                    $nothing_found.fadeIn(300);
                } else {
                    $nothing_found.hide();
                }
            } else {
                $(this).addClass("not-valid");
            }
        }).on("input", "#nef-text", function (e) {
            const length = e.target.value.length;
            if (length > 2) {
                $form.removeClass("not-valid");
                $submit.removeAttr("disabled");
            } else {
                $form.addClass("not-valid");
                $submit.attr("disabled", true);
            }
            if (length === 0) {
                $form.removeClass("not-valid");
                $(".nef-item, .nef-group").fadeIn(300);
                $reset.fadeOut(300);
                $nothing_found.hide();
            } else {
                $reset.fadeIn(300);
            }
        }).on("reset", function (e) {
            $form.removeClass("not-valid");
            $submit.attr("disabled", true);
            $reset.fadeOut(300);
            $(".nef-item, .nef-group, .nef-items-list, .nef-item-description").hide();
            $(".nef-item, .nef-group").removeClass("active").fadeIn(300);
            $nothing_found.hide();
        })

    })

})(jQuery);