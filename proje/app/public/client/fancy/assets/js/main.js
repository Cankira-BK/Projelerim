$(document).ready(function(){
    var screenSize = $(window).height();
    var compareW = 767;
    if (screenSize > 0 && screenSize < compareW) {
        var fancy_a = 740;
        var fancy_b = 550;
        var fancy_c = "ishopbg-small";
        var fancy_d = "13px";
        var fancy_e = "3px";
        var fancy_f = "13px";
        var fancy_g = 754;
        var fancy_h = 574;
        var fancy_i = 6;
        var fancy_j = 20;
    }
    else
    {
        var fancy_a = 1016;
        var fancy_b = 655;
        var fancy_c = "ishopbg";
        var fancy_d = "16px";
        var fancy_e = "7px";
        var fancy_f = "16px";
        var fancy_g = 1032;
        var fancy_h = 690;
        var fancy_i = 8;
        var fancy_j = 28;
    }
    var fancybox_css = {
        'outer': {'background': null},
        'close': {'background_image': null, 'height': null, 'right': null, 'top': null, 'width': null}
    };
    $('a.itemshop').fancybox({
        'autoDimensions': false,
        'width': fancy_a,
        'height': fancy_b,
        'padding': 0,
        'scrolling': 'yes',
        'overlayColor': '#000',
        'overlayOpacity': 0.8,
        'onStart': function () {
            fancybox_css.outer.background = $('#fancybox-outer').css('background');
            fancybox_css.close.background_image = $('#fancybox-close').css('background-image');
            fancybox_css.close.height = $('#fancybox-close').css('height');
            fancybox_css.close.right = $('#fancybox-close').css('right');
            fancybox_css.close.top = $('#fancybox-close').css('top');
            fancybox_css.close.width = $('#fancybox-close').css('width');
            $('#fancybox-outer').css({'background': 'transparent url("'+$(".wrapper").data("public")+'static/images/'+fancy_c+'.png") center center no-repeat'});
            $('#fancybox-close').css({
                'background-image': 'none',
                'cursor': 'pointer',
                'height': fancy_d,
                'right': '3px',
                'top': fancy_e,
                'width': fancy_f
            });
        },
        'onComplete': function () {
            $('#fancybox-inner').css({'top': fancy_j, 'left': fancy_i});
            $('#fancybox-wrap').css({'width': fancy_g, 'height': fancy_h});
        },
        'onClosed': function () {
            if (null != fancybox_css.outer.background) {
                $('#fancybox-outer').css('background', fancybox_css.outer.background);
            }
            if (null != fancybox_css.close.background_image) {
                $('#fancybox-close').css('background-image', fancybox_css.close.background_image);
            }
            if (null != fancybox_css.close.height) {
                $('#fancybox-close').css('height', fancybox_css.close.height);
            }
            if (null != fancybox_css.close.right) {
                $('#fancybox-close').css('right', fancybox_css.close.right);
            }
            if (null != fancybox_css.close.top) {
                $('#fancybox-close').css('top', fancybox_css.close.top);
            }
            if (null != fancybox_css.close.width) {
                $('#fancybox-close').css('width', fancybox_css.close.width);
            }
        }
    });

    $('.phone').mask('(500) 000-0000');

    var number =  parseInt($('#onlineCount').text());

    if (number > 100)
        setInterval(OnlinePlayerCounter, 1000);

    function OnlinePlayerCounter()
    {
        var data = {"total":number,"max":20000};
        data.total += Math.floor((Math.random() * 100) + 1);
        var percentCalc = (data.total+Math.floor((Math.random()) * 1500 + 1)) * 100 / data.max;

        if (percentCalc > 0)
        {
            document.getElementById("progressBar").style.width		= percentCalc + '%';
            document.getElementById("onlineCount").innerHTML	= data.total;
        }
    }

    $("#loginForm").on('submit', function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                if (response.result)
                    window.location.href = response.redirect;
                else
                {
                    errorNotify(response.message);
                    grecaptcha.reset();
                }
            }
        });
    });

    $("#registerForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                if (response.result)
                {
                    successNotify(response.message);
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    },2000)
                }
                else
                {
                    errorNotify(response.message);
                    grecaptcha.reset();
                }
            }
        });
    });

    $("#forgetPasswordForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });

    $("#forgetAccountForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });

    $("#mailActivationForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });

    $("#safeBoxPasswordForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });

    $("#emailChangeForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });

    $("#emailChangeForm2").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });

    $("#kskChangeForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });

    $("#passwordChangeForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });
});

var modalRegisterReCaptchaID = 0;
var modalLoginReCaptchaID = 0;

function registerModal() {
    new modal('#reg_modal');

    $('#recaptchaRegister').html('');

    $('#recaptchaRegister').each(function (i, captcha) {
        modalRegisterReCaptchaID = grecaptcha.render(captcha, {
            'sitekey' : $(".wrapper").data("sitekey")
        });
    });
}

function loginModal() {
    new modal('#login_modal');

    $('#recaptchaLogin').html('');

    $('#recaptchaLogin').each(function (i, captcha) {
        modalLoginReCaptchaID = grecaptcha.render(captcha, {
            'sitekey' : $(".wrapper").data("sitekey")
        });
    });
}

function loginFormFunction() {
    var url = $("#loginFormMaster").attr("action");
    var data = $("#loginFormMaster").serialize();

    $.ajax({
        url : url,
        type : 'POST',
        data : data,
        dataType : 'json',
        success : function (response) {
            if (response.result)
                window.location.href = response.redirect;
            else
            {
                errorNotify(response.message);
                grecaptcha.reset(modalLoginReCaptchaID);
            }
        }
    });
}

function registerFormFunction() {
    var url = $("#registerFormMaster").attr("action");
    var data = $("#registerFormMaster").serialize();

    $.ajax({
        url : url,
        type : 'POST',
        data : data,
        dataType : 'json',
        success : function (response) {
            if (response.result)
            {
                successNotify(response.message);
                setTimeout(function () {
                    window.location.href = response.redirect;
                },2000)
            }
            else
            {
                errorNotify(response.message);
                grecaptcha.reset(modalRegisterReCaptchaID);
            }
        }
    });
}

function DropDown(el) {
    this.dd = el;
    this.placeholder = this.dd.children('div');
    this.opts = this.dd.find('ul.dropdown > li');
    this.val = '';
    this.index = -1;
    this.initEvents();
}

DropDown.prototype = {
    initEvents : function() {
        var obj = this;
        obj.dd.on('click', function(event){
            $(this).toggleClass('active');
            return false;
        });
        obj.opts.on('click',function(){
            var opt = $(this);
            obj.val = opt.find('a').html();
            obj.index = opt.index();
            obj.placeholder.html(obj.val);
        });
    },
    getValue : function() {
        return this.val;
    },
    getIndex : function() {
        return this.index;
    }
};

$(function() {
    var dd = new DropDown( $('#dropdown-block') );
    $(document).click(function() {
        $('.dropdown-block').removeClass('active');
    });
});
$('.goLang a').on('click',function(){
    window.location.href = $(this).attr('href');
});

$(function() {
    var dd = new DropDown( $('#dropdown-block-b') );
    $(document).click(function() {
        $('.dropdown-block-b').removeClass('active');
    });
});
