/*
    Custom JavaScript file.
*/
(function ($) {

    $(document).ready(function () {
        var amountScrolled = 200;

        // Animation for product tiles
        $('.tile.animated').hover(function () {
            $(this).addClass('animated pulse');
        }, function () {
            $(this).removeClass('animated pulse');
        });

        // Scroll to top function 
        $('.back-to-top').click(function (event) {
            event.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, 1000);
            return false;
        });

        // Animation for back-to-top button
        $(window).scroll(function () {
            if ($(window).scrollTop() > amountScrolled) {
                $('.back-to-top').slideDown();
            } else {
                $('.back-to-top').slideUp();
            }
        });

        // Smooth scroll for nav links
        $('.smooth').click(function () {
            $('html, body').animate({
                scrollTop: $($(this).attr('href')).offset().top
            }, 500);
            return false;
        });

        // Function for preventing default map behaviour
        $('#map').click(function () {
            $('#map iframe').css("pointer-events", "auto");
        });
        $('#map').mouseleave(function () {
            $('#map iframe').css("pointer-events", "none");
        });

        $(':checkbox').radiocheck();

    });

})(jQuery);
