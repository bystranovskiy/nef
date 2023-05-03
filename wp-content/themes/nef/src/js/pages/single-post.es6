import "../../scss/pages/single-post.scss";
import {setCookie, getCookie, eraseCookie} from "../cookies.es6";

"use strict";

(function ($) {

    $(document).ready(function () {

        if (!getCookie("post-viewed") && !$("body").hasClass("logged-in")) {
            setCookie("post-viewed", true, "1", window.location.pathname);
        }

        const $clipboard = $("#clipboard-copy");
        const $tooltip = $clipboard.find(".tooltip");
        const text = $tooltip.text();
        const completed = $tooltip.data("completed");

        $clipboard.on("click", function () {
            const temp = $("<input>");
            $("body").append(temp);
            temp.val($(location).attr("href")).select();
            document.execCommand("copy");
            temp.remove();
            $tooltip.text(completed);
        }).on("mouseleave", function () {
            $tooltip.text(text);
        });


        const $post_rate = $(".post-rate");
        const rated = getCookie("post-rated");
        if (rated) {
            $post_rate.addClass("post-rated");
        } else {
            $post_rate.on("click", ".post-rate-item", function (e) {
                setCookie("post-rated", true, "1", window.location.pathname);
                const post_id = $(e.delegateTarget).data("post-id");
                const action = $(e.target).data("action");

                const ajaxurl = ajaxMeta.ajaxurl;
                $.ajax({
                    url: ajaxurl,
                    type: "post",
                    data: {
                        action: "post_rate",
                        "rate_action": action,
                        "post_id": post_id,
                    },
                    success: function (data) {
                        const $data = $(data);
                        if ($data.length) {
                            $data.addClass("post-rated");
                            $post_rate.parent().append($data);
                            $post_rate.remove();
                        } else {
                            console.log("error");
                        }
                    }
                });

            })
        }

    })

})(jQuery);