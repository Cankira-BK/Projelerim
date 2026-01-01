;
(function () {
    $.fn.customRadioCheck = function () {
        return this.each(function () {
            var $this = $(this);
            var $span = $('<span/>');
            $span.addClass('custom-' + ($this.is(':checkbox') ? 'check' : 'radio'));
            $this.is(':checked') && $span.addClass('checked');
            $span.insertAfter($this);
            $this.parent('label').addClass('custom-label').attr('onclick', '');
            $this.css({
                position: 'absolute',
                left: '-9999px'
            });
            $this.on({
                change: function () {
                    if ($this.is(':radio')) {
                        $(document).find('.custom-radio').removeClass('checked');
                    }
                    $span.toggleClass('checked', $this.is(':checked'));
                },
                focus: function () {
                    $span.addClass('focus');
                },
                blur: function () {
                    $span.removeClass('focus');
                }
            });
        });
    };
}());

function registerOpen() {
    var lx = 0;
    var ly = 0;
    lx = ($(window).width() / 2) - ($(".registerArea").width() / 2);
    ly = ($(window).height() / 2) - ($(".registerArea").height() / 2);
    $(".registerArea").css("left", lx + "px");
    $(".registerArea").css("top", ly + "px");
    $(".wopac").css("opacity", "0");
    $(".registerArea").css("opacity", "0");
    $(".wopac").show();
    $(".registerArea").show();
    $(".wopac").animate({
        opacity: 0.7
    }, 250);
    $(".registerArea").animate({
        opacity: 1
    }, 250);
    $(window).resize(function () {
        var lx = 0;
        var ly = 0;
        lx = ($(window).width() / 2) - ($(".registerArea").width() / 2);
        ly = ($(window).height() / 2) - ($(".registerArea").height() / 2);
        $(".registerArea").css("left", lx + "px");
        $(".registerArea").css("top", ly + "px");
    });
}

function registerClose() {
    $(".wopac").animate({
        opacity: 0
    }, 250, function () {
        $(".wopac").hide();
        $(".registerArea").hide();
    });
    $(".registerArea").animate({
        opacity: 0
    }, 250);
}
$(document).ready(function () {
    $("a[href='#login']").click(function () {
        registerOpen();
        return false;
    });
    $(".wopac").click(function () {
        registerClose();
    });
    $(document).keyup(function (e) {
        if (e.keyCode == 27) {
            registerClose();
        }
    });


    var tmrMenu;
    var tmrMenu2;
    $("#siralamalar").mouseenter(function (e) {
        clearTimeout(tmrMenu);
        var bx = $(this).position().left + ($(this).width() / 2);
        $(".submenu2").hide();
        $(".submenu").css("left", (bx - $(".submenu").width() / 2) + "px");
        $(".submenu").css("top", ($(this).position().top + $(this).height() - 15) + "px");
        $(".submenu").show();
        $(".submenu").animate({ opacity: 1 }, 100); 
    });
    $("#siralamalar").mouseleave(function () {
        tmrMenu = setTimeout(function () {
            $(".submenu").animate({ opacity: 0 }, 100, function () { $(".submenu").hide() } );
        }, 250);
    });

    $("#rehber").mouseenter(function (e) {
        clearTimeout(tmrMenu2);
        var bx = $(this).position().left + ($(this).width() / 2);
        $(".submenu").hide();
        $(".submenu2").css("left", (bx - $(".submenu2").width() / 2) + "px");
        $(".submenu2").css("top", ($(this).position().top + $(this).height() - 15) + "px");
        $(".submenu2").show();
        $(".submenu2").animate({ opacity: 1 }, 100);
    });
    $("#rehber").mouseleave(function () {
        tmrMenu2 = setTimeout(function () {
            $(".submenu2").animate({ opacity: 0 }, 100, function () { $(".submenu2").hide() });
        }, 250);
    });

    $(".submenu").mouseenter(function (e) {
        clearTimeout(tmrMenu);
    });
    $(".submenu").mouseleave(function (e) {
        tmrMenu = setTimeout(function () {
            $(".submenu").animate({ opacity: 0 }, 100, function () { $(".submenu").hide() });
        }, 250)
    });    $(".submenu2").mouseenter(function (e) {
        clearTimeout(tmrMenu2);
    });
    $(".submenu2").mouseleave(function (e) {
        tmrMenu2 = setTimeout(function () {
            $(".submenu2").animate({ opacity: 0 }, 100, function () { $(".submenu2").hide() });
        }, 250)
    });
});