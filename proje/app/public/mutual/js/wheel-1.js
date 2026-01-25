function animateReward(a) {
    $("#pos" + a).css("z-index", 15).animate({
        width: "+=60",
        height: "+=60",
        top: "-=30",
        left: "-=30"
    }, 200).animate({
        width: "-=40",
        height: "-=40",
        top: "+=20",
        left: "+=20"
    }, 300).animate({
        width: "+=30",
        height: "+=30",
        top: "-=15",
        left: "-=15"
    }, 300).animate({
        width: "-=20",
        height: "-=20",
        top: "+=10",
        left: "+=10"
    }, 400).animate({
        width: "+=10",
        height: "+=10",
        top: "-=5",
        left: "-=5"
    }, 400)
}

function fancyBox(b) {
    $.fancybox({
        tpl: {
            closeBtn: '<button title="Close" class="fancybox-item fancybox-close btn-default" href="javascript:;"></button>'
        },
        href: b,
        autoDimensions: false,
        width: 340,
        height: "auto",
        overlayOpacity: 0.6,
        showCloseButton: true,
        enableEscapeButton: false,
        hideOnOverlayClick: false,
        hideOnContentClick: false,
        padding: 10,
        beforeShow: function() {}
    });
    var a = $(".carousell-reward").data("royalSlider");
    if (a !== null) {

    }
}

function nextStage(a) {
    var b = $("#key-" + a),
        h = $(".wheel-stages span.current"),
        e = h.attr("data-class"),
        j = wl.dir == "left" ? parseInt(b.position().right) : parseInt(b.position().left),
        d = parseInt(b.position().top),
        f = -h.width() / 2 - $(".wheel-keys").width() / 3,
        c = -h.width() / 2 - $(".wheel-keys").width() / 3,
        i = wl.topStg + h.position().top,
        g = b.clone().appendTo(".wheel-keys").addClass("k-" + e);
    if (wl.dir == "left" && $("html").hasClass("lt-ie7")) {
        b.css("z-index", 6).animate({
            top: d - b.height() / 2
        }, 800, "linear", function() {
            b.hide("slow");
            g.removeClass("k-" + e)
        })
    } else {
        if (wl.dir == "left") {
            b.css("z-index", 6).animate({
                right: j - b.width() / 2,
                top: d - b.height() / 2
            }, 800, "easeOutCirc").animate({
                right: c,
                top: i
            }, 400, "easeOutCirc").animate({
                opacity: 0,
                height: h.height() / 2,
                width: h.width() / 2
            }, 300, "linear", function() {
                h.addClass(e);
                h.addClass("hit");
                b.hide();
                g.removeClass("k-" + e)
            })
        } else {
            b.css("z-index", 6).animate({
                left: j - b.width() / 2,
                top: d - b.height() / 2
            }, 800, "easeOutCirc").animate({
                left: f,
                top: i
            }, 400, "easeOutCirc").animate({
                opacity: 0,
                height: h.height() / 2,
                width: h.width() / 2
            }, 300, "linear", function() {
                h.addClass(e);
                h.addClass("hit");
                b.hide();
                g.removeClass("k-" + e)
            })
        }
    }
}

function removeStages(a) {
    $(".stg").find("span").removeClass("stg-" + a);
    $(".star-" + a).removeClass("current");
    $(".star-" + (a - 1)).addClass("current")
}

function selectCurrentTab(a) {
    if (a.length != 0) {
        var b = a.attr("id").replace("stage-", "");
        $('#wheel-special-stage a[href="#stg-' + b + '"]').tab("show").trigger("click")
    }
}

function setStages() {
    var b = $("#wheel-stages"),
        d = $(".wheel-stages").height() + 25,
        c,
        a;
    if (d < c) {
        a = c - d;
        if (a > (Math.round(c * 10 / 100))) {
            b.css("bottom", -a);
            wl.topStg = a
        }
    } else {
        wl.topStg = 0
    }
    b.mCustomScrollbar("scrollTo", "#stage-" + wl.lvl);
    b.removeClass("stg-hidden")
}

function showStages() {
    wl.currentStg = $(".hit").length;
    wl.stgCount = $(".stg-" + wl.lvl).length
}

function showReward(a) {
    $.fancybox({
        href: a,
        autoDimensions: false,
        tpl: {
            closeBtn: '<button title="Close" class="fancybox-item fancybox-close btn-default" href="javascript:;"></button>'
        },
        width: 340,
        minHeight: 260,
        maxHeight: 600,
        height: "auto",
        overlayOpacity: 0.6,
        showCloseButton: true,
        enableEscapeButton: false,
        hideOnOverlayClick: false,
        hideOnContentClick: false,
        padding: 10,
        onComplete: function() {
            zs.fn.initScrollerItems("#fancybox-sonuc .scrollable-container", false);
            $("#fancybox-outer").addClass("fancybox-outer-wheel")
        },
        beforeClose: function() {
            $("#fancybox-outer").removeClass("fancybox-outer-wheel");
            window.location.href = wl.url
        }
    });
    zs.fn.initScrollerItems("#fancybox-sonuc .scrollable-container", false);
    $(".faq").click(function() {
        $("#wheel-faq").slideToggle("slow");
        $("#cark-sonuc").slideToggle("slow")
    })
}

function start(c, b) {
    c.preventDefault();
    var a = b.attr("href");
    wl.doTeaser = true;
    $(".teaser").fadeOut(200);
    $("#spinButton").fadeOut(500, function() {
        window.location = a
    })
}

function teaser(a, e) {
    if (wl.doTeaser) {
        if (e > 16) {
            if (!wl.usePrespin) {
                a++
            }
            e = 1
        }
        if (a > 3) {
            a = 1
        }
        var d = 0,
            c = 0,
            b;
        $("#teaser" + a).find(".wheel-item-" + e).each(function() {
            c = parseInt($(this).css("top"));
            d = parseInt($(this).css("left"));
            b = $(this).css("max-width");
            $(this).css({
                height: 0,
                width: 0,
                display: "block",
                left: d + 20,
                top: c + 20
            }).animate({
                width: "+=" + b,
                height: "+=" + b,
                top: "-=20",
                left: "-=20"
            }, 400).delay(800).animate({
                width: "-=" + b,
                height: "-=" + b,
                top: "+=20",
                left: "+=20"
            }, 400, function() {
                $(this).css({
                    left: d,
                    top: c
                })
            })
        });
        setTimeout(function() {
            teaser(a, (e + 1))
        }, 200)
    }
}
$(document).ready(function() {
    $("#wheel-stages .lvl").on("click", function() {
        fancyBox("#wheel-special-stage");
        selectCurrentTab($(this));
        $(".tab-content .carousell-reward").royalSlider("updateSliderSize", true)
    });
    $("#wheel-prices").on("click",function(){showRewardsPanel();selectCurrentTab($(".lvl.current"))});
    $("#wheel-special-stage .heading-tab").on("click", function() {
        var a = $(this).attr("href").replace("#stg-", "");
        $(".tab-content>.tab-pane").css("display", "none");
        $("#stg-" + a).css("display", "block");
        if (a != 3)
            $("#stg-3").css("display", "none");

        $(".carousell-reward").royalSlider("updateSliderSize", true)
    });
    $(".wheel-help").click(function() {
        fancyBox("#fancybox-help")
    });
});
var wl = {};
wl.doTeaser = true;
setStages();
$('.wheel-over').click(function () {location.href = $(this).attr('href');});
$('#spinButton').click(function (event) {start(event, $(this));});
$('#wheel-stages .ttip').tipTip({delay: zs.data.ttip.delay, fadeIn: zs.data.ttip.fadeIn, defaultPosition: wl.dir, attribute: zs.data.ttip.attribute, maxWidth: zs.data.ttip.maxWidth});
setTimeout(function () {teaser(1, 1);}, 1000);