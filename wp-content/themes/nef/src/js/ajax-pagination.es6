"use strict";

(function ($) {

    $(document).ready(function () {
        $(".ajax-pagination .nav-links .page-numbers").removeAttr("href");
        let paged = 1;

        $(".ajax-pagination").on("click", ".nav-links a.page-numbers", function (e) {
            e.preventDefault();

            const $container = e.delegateTarget;

            if (!$(e.target).hasClass("next") && !$(e.target).hasClass("prev")) {
                paged = parseInt($(e.target).text());
            }
            if ($(e.target).hasClass("next")) {
                paged++;
            }
            if ($(e.target).hasClass("prev")) {
                paged--;
            }
            ajax_pagination(paged, $container);
        })
    });

    function ajax_pagination(paged, container) {
        $(container).addClass("loading");
        const index = $(container).data("index");
        const args = queryArgs[index];
        console.log(args);
        $.ajax({
            url: ajaxMeta.ajaxurl,
            type: "post",
            data: {
                action: "ajax_pagination",
                "paged": paged,
                "query_args": args,
            },
            success: function (data) {
                const $data = $(data);
                if ($data.length) {
                    $data.css("display", "none");
                    $(container).removeClass("loading").empty().append($data.fadeIn());
                    $(container).find(".nav-links .page-numbers").removeAttr("href");
                } else {
                    console.log("error");
                }
            }
        });
        return false;
    }

})(jQuery);