$(document).ready(function () {

    // Initialize slick once
    if (!$('.strengh-ties').hasClass('slick-initialized')) {
        $('.strengh-ties').slick({
            dots: true,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 3000,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            pauseOnHover: false,
            pauseOnFocus: false
        });
    }

    // Stop autoplay when modal opens
    $('#joinAs').on('show.bs.modal', function () {
        $('.strengh-ties').slick('slickPause');
    });

    // Restart autoplay when modal closes
    $('#joinAs').on('hidden.bs.modal', function () {
        $('.strengh-ties').slick('slickPlay');
    });

});

AOS.init();
