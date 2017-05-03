(function($) {

    $('.slider').each(function(i) {
        var className = '.slider' + i;
        $(this).addClass('slider' + i);

        var dots          = $(className).data('dots');
        var autoPlay      = $(className).data('auto-play');
        var speed         = $(className).data('play-speed');

        $(className).slick({
            dots: dots,
            autoplay: autoPlay,
            autoplaySpeed: 1000,
            speed: speed,
            slidesToShow: 1,
            prevArrow: '<i class="slider__button slider__button--prev fa fa-arrow-left" aria-hidden="true"></i>',
            nextArrow: '<i class="slider__button slider__button--next fa fa-arrow-right" aria-hidden="true"></i>'
        });
    });




})(jQuery);
