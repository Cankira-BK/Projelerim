$(document).ready(function () {
    $('.bxslider').bxSlider({
        mode: 'fade',
        auto: true,
        infiniteLoop: true,
        useCSS: false,
        pager: false
    });
    $('.slider1').bxSlider({
        nextSelector: '#slider-next',
        prevSelector: '#slider-prev',
        slideWidth: 92,
        minSlides: 2,
        maxSlides: 5,
        moveSlides: 1,
        slideMargin: 11,
        nextText: '',
        prevText: '',
        auto: true,
        pause: 3000
    });
    var fancybox_css = {
        'outer': {'background': null},
        'close': {'background_image': null, 'height': null, 'right': null, 'top': null, 'width': null}
    };
    var x = screen.width;
    if (x <= 768){
        document.getElementById('loginBox2').style.marginTop = "15px";
    }
});