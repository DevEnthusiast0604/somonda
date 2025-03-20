$(document).ready(function () {

    $('.color.color-1').click(function (e) {
        e.preventDefault();
        $('.colors .color').removeClass('active');
        $('.colors .color.color-1').addClass('active');

        $('.bxslider li.active').removeClass('active');
        $('.phone.green').addClass('active');


    });

    $('.color.color-2').click(function (e) {
        e.preventDefault();
        $('.colors .color').removeClass('active');
        $('.colors .color.color-2').addClass('active');

        $('.bxslider li.active').removeClass('active');
        $('.phone.grey').addClass('active');


    });

    $('.color.color-3').click(function (e) {
        e.preventDefault();
        $('.colors .color').removeClass('active');
        $('.colors .color.color-3').addClass('active');

        $('.bxslider li.active').removeClass('active');
        $('.phone.black').addClass('active');


    });

    $('.color.color-4').click(function (e) {
        e.preventDefault();
        $('.colors .color').removeClass('active');
        $('.colors .color.color-4').addClass('active');

        $('.bxslider li.active').removeClass('active');
        $('.phone.white').addClass('active');


    });

    $('.color.color-5').click(function (e) {
        e.preventDefault();
        $('.colors .color').removeClass('active');
        $('.colors .color.color-5').addClass('active');

        $('.bxslider li.active').removeClass('active');
        $('.phone.gold').addClass('active');


    });

});