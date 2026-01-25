$(document).ready(function () {
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
            $('#fancybox-outer').css({'background': 'transparent url("'+$(".wrapper").data("public")+'static/images/'+fancy_c+'.png") center center no-repeat'});            $('#fancybox-close').css({
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

    var currentRank = "player";
    $('#left_arrow_ranking').click(function () {
        if (currentRank === "player")
        {
            document.getElementById('player_rank_text').style.display = "none";
            document.getElementById('player_rank_table').style.display = "none";
            $("#guild_rank_text").fadeIn();
            $("#guild_rank_table").fadeIn();
            currentRank = "guild";
        }
        else
        {
            document.getElementById('guild_rank_text').style.display = "none";
            document.getElementById('guild_rank_table').style.display = "none";
            $("#player_rank_text").fadeIn();
            $("#player_rank_table").fadeIn();
            currentRank = "player";
        }
    });
    $('#right_arrow_ranking').click(function () {
        if (currentRank === "player")
        {
            document.getElementById('player_rank_text').style.display = "none";
            document.getElementById('player_rank_table').style.display = "none";
            $("#guild_rank_text").fadeIn();
            $("#guild_rank_table").fadeIn();
            currentRank = "guild";
        }
        else
        {
            document.getElementById('guild_rank_text').style.display = "none";
            document.getElementById('guild_rank_table').style.display = "none";
            $("#player_rank_text").fadeIn();
            $("#player_rank_table").fadeIn();
            currentRank = "player";
        }
    });

    $(function() {
        $(window).scroll(function() {
            if($(this).scrollTop() != 0) {
                $('#toTop').fadeIn();
            } else {
                $('#toTop').fadeOut();
            }
        });
        $('#toTop').click(function() {
            $('body,html').animate({scrollTop:0},800);
        });
    });

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

    $('#registerPassword2').change(function () {
        var pass = $('#registerPassword').val();
        var pass2 = $(this).val();
        if(pass !== pass2){
            $('#registerPassword2').notify(
                "Şifreler uyuşmuyor !",
                { position:"right" }
            );
        }
    });

    $("#forgetPINForm").on("submit", function (event) {
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

    $("#pinChangeForm").on("submit", function (event) {
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

function numberOnly(e,id){
    var code;
    if (!e) var e = window.event;
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);
    var AllowRegex  = /^[\b0-9\s-]$/;
    if (AllowRegex.test(character)){
        return true;
    }else{
        $(id).notify(
            "Sadece rakam !",
            { position:"right" }
        );
        return false;
    }
}

var openModalLoad = 0;
function openModal(elem)
{
    if( !elem ) {
        return this;
    }

    if (elem === "registerModal")
    {
        if (openModalLoad === 0)
        {
            $('#recaptchaRegister').html('');

            $('#recaptchaRegister').each(function (i, captcha) {
                grecaptcha.render(captcha, {
                    'sitekey' : $(".wrapper").data("sitekey")
                });
            });
        }
    }

    if (elem === "loginModal")
    {
        if (openModalLoad === 0)
        {
            $('#recaptchaLogin').html('');

            $('#recaptchaLogin').each(function (i, captcha) {
                grecaptcha.render(captcha, {
                    'sitekey' : $(".wrapper").data("sitekey")
                });
            });
        }
    }

    openModalLoad = 1;
    var element = document.getElementById(elem);
    element.style.display = "block";
    element.style.visibility = "visible";
    element.style.opacity = "1";
    return false;
}

function closeModal(elem) {
    if( !elem ) {
        return this;
    }

    var element = document.getElementById(elem);
    element.style.display = "flex";
    element.style.visibility = "hidden";
    element.style.opacity = "0";
    return false;
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
                grecaptcha.reset();
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
                grecaptcha.reset();
            }
        }
    });
}