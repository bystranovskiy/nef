import "../../scss/pages/single-innovation-cases.scss";

"use strict";

(function ($) {

    $(document).ready(function () {
        $(".post-agents-carousel").slick({
            slidesToScroll: 1,
            infinite: false,
            slidesToShow: 2,
            arrows: false,
            dots: true,
            swipe: true,
            swipeToSlide: true,
            draggable: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 720,
                    settings: {
                        slidesToShow: 1,
                    }
                }
            ]
        });
    })

})(jQuery);