(function (d) {
    function a(g) {
        return new RegExp("(^|\\s+)" + g + "(\\s+|$)")
    }

    var c, e, f;
    if ("classList" in document.documentElement) {
        c = function (g, h) {
            return g.classList.contains(h)
        };
        e = function (g, h) {
            g.classList.add(h)
        };
        f = function (g, h) {
            g.classList.remove(h)
        }
    } else {
        c = function (g, h) {
            return a(h).test(g.className)
        };
        e = function (g, h) {
            if (!c(g, h)) {
                g.className = g.className + " " + h
            }
        };
        f = function (g, h) {
            g.className = g.className.replace(a(h), " ")
        }
    }

    function b(h, j) {
        var g = c(h, j) ? f : e;
        g(h, j)
    }

    d.classie = {hasClass: c, addClass: e, removeClass: f, toggleClass: b, has: c, add: e, remove: f, toggle: b}
})(window);
jQuery.fn.exists = function () {
    return jQuery(this).length > 0
};
var zs = zs || {};
zs.ev = zs.ev || {};
zs.fn = zs.fn || {};
zs.data = zs.data || {};
zs.module = zs.module || {};
zs.debug = zs.debug || false;
zs.fn.track = zs.fn.track || {};
zs.data.loca = zs.data.loca || {};
zs.data.directPurchaseEnabled = zs.data.directPurchaseEnabled || false;
zs.data.screen = getScreenDimensions();
zs.module.small = zs.module.small || false;
zs.data.textLimit = {core: 100, "4story": 90};
zs.data.ttip = zs.data.ttip || {};
zs.data.ttip = {delay: 400, defaultPosition: "bottom", fadeIn: 100, attribute: "tooltip-content", maxWidth: 300};

function getScreenDimensions() {
    if (window.innerWidth !== undefined && window.innerHeight !== undefined) {
        var a = window.innerWidth;
        var b = window.innerHeight
    } else {
        var a = document.documentElement.clientWidth;
        var b = document.documentElement.clientHeight
    }
    return {w: a, h: b}
}

function initFocusClear() {
    $("input[type=password], input[type=text], input[type=email], textarea").not("input[name=searchString]").each(function () {
        var a = this.value;
        $(this).focus(function () {
            if (this.value === a) {
                this.value = ""
            }
        });
        $(this).blur(function () {
            if (this.value === "") {
                this.value = a
            }
        })
    })
}

var BUY_BUTTONS_FLIPPED_ELEMENTS = [];

function showPriceArticle() {
    $(document).on("mouseenter mouseleave", "button.btn-price,a.btn-price,button.btn-buy,button.btn-buy", function (d) {
        var e = $(this);
        e.stop();
        if (d.type == "mouseenter" && e.hasClass("btn-price")) {
            for (var c = 0, b = BUY_BUTTONS_FLIPPED_ELEMENTS.length; c < b; c = c + 1) {
                _btnBuyMouseleave(BUY_BUTTONS_FLIPPED_ELEMENTS[c])
            }
            BUY_BUTTONS_FLIPPED_ELEMENTS = [];
            var a = _btnPriceMouseenter(e);
            if (a) {
                BUY_BUTTONS_FLIPPED_ELEMENTS.push(a)
            }
        } else {
            if (d.type == "mouseleave" && e.hasClass("btn-buy")) {
                _btnBuyMouseleave(e)
            }
        }
    })
}

function _btnPriceMouseenter(b) {
    if (b.data("nextBtn")) {
        b.hide();
        var a = b.data("nextBtn");
        a.show();
        return a
    } else {
        if (b.next(".btn-buy").length) {
            b.hide();
            var a = b.next(".btn-buy");
            a.show();
            b.data("nextBtn", a);
            return a
        }
    }
}

function _btnBuyMouseleave(b) {
    if (b.data("prevBtn")) {
        b.hide();
        b.data("prevBtn").show()
    } else {
        if (b.prev(".btn-price").length) {
            b.hide();
            var a = b.prev(".btn-price");
            a.show();
            b.data("prevBtn", a)
        }
    }
}

function dropDownArticle() {
    $(document).on("click", ".list-item .zs-dropdown .dropdown-toggle", function () {
        var a = zsDropdown($(this));
        a.onToggleMenu()
    }).on("click", ".list-item .zs-dropdown .dropdown-option", function () {
        var h = $(this), b = zsDropdown(h), e = h.closest(".list-item"), d = e.find(".end-price"),
            g = e.find(".btn-buy"), f = e.find(".zs-dropdown").find("button.dropdown-toggle");
        b.onClickOption(h);
        var c = getCategoryPurchaseLink(f.data("article-id"), f.data("category-id"), f.data("parent-category-id"), f.data("checksum"), "-1", b.getCurrentCount(), f.data("currency"), b.getCurrentPrice(), b.getCurrentPayback(), f.data("server"), f.data("player"), f.data("transaction-id"), f.data("zporig"), f.data("zpartpos"));
        var a = b.getCurrentPrice();
        if (zs.data.useCurrencyFormatter) {
            a = getFormattedCurrencyValue(a)
        }
    })
}

zs.fn.track.pageload = function () {
};
zs.fn.track.timePast = function (b) {
    zs.data.thisTime = (new Date()).getTime();
    var a = (zs.data.thisTime - zs.data.timeBefore) / 1000;
    if (b && console && console.log) {
        console.log(a)
    }
    return a
};
window.onload = function () {
    zs.fn.track.pageload()
};

function cardMargin() {
    $("ul.item-list.card").each(function (a, b) {
        $(b).find("li.shown").each(function (c, d) {
            if (c % 3 === 2) {
                $(d).addClass("last-in-line")
            }
        })
    });
    $("div.no-scroller").each(function (a, b) {
        $(b).find("div.list-item ").each(function (c, d) {
            if (c % 3 === 2) {
                $(d).addClass("last-in-line")
            }
        })
    });
    $(".list h3.subcategory li.shown").first().addClass("first-element")
}

function customScroll() {
    $(".content .scrollable_container").mCustomScrollbar("update")
}

function pseudoSelect(a) {
    a.find(".select-input a").click(function () {
        var c = a;
        var b = c.find(".select-input .account-infos").html().replace(/\s/g, "").replace(/data-[-_\w]+="[^"]*"/g, "");
        c.find(".select-option ul li").show().each(function () {
            if ($(this).find(".account-infos").html().replace(/\s/g, "").replace(/data-[-_\w]+="[^"]*"/g, "") === b) {
                $(this).hide();
                return false
            }
        });
        a.find(".select-option ul").toggle();
        a.find(".select-option ul").mCustomScrollbar()
    });
    a.find(".select-option ul li a").click(function (b) {
        if ($(this).closest(".pseudo-dropdown").hasClass("playerSelection")) {
            b.preventDefault();
            selectPlayer($(this), playerSelectDropdownChanged, closePseudoSelect)
        } else {
            if ($(this).closest(".pseudo-dropdown").hasClass("purchaseSelection")) {
                b.preventDefault();
                selectPlayerForPurchase($(this))
            } else {
                if ($(this).closest(".pseudo-dropdown").hasClass("distributionSelection")) {
                    b.preventDefault();
                    selectPlayerForDistribution($(this))
                } else {
                    if ($(this).closest(".pseudo-dropdown").hasClass("relationType")) {
                        b.preventDefault();
                        zs.fn.selectRecipientType($(this))
                    } else {
                        changePseudoSelect($(this))
                    }
                }
            }
        }
    });
    $(document).bind("click", function (c) {
        var b = $(c.target);
        if (!b.parents().hasClass("pseudo-dropdown")) {
            a.find(".select-option ul").hide()
        }
    })
}

function changePseudoSelect(b) {
    var g = b.find(".account-infos").html(), a = b.find(".account-infos p"), c = zs.data.currency || 1, e, d, f;
    b.closest(".pseudo-dropdown").find(".select-input .account-infos").html(g);
    closePseudoSelect(b);
    e = a.attr("data-server-id");
    d = a.attr("data-player-id");
    f = a.data("data-transaction-id");
    zs.fn.initPurchaseLink(false, false, c, e, d, f)
}

function closePseudoSelect(a) {
    a.closest(".select-option ul").hide()
}

function selectPlayer(e, d, f) {
    var c = e.attr("href") || e.data("url") || false;
    var b = e.data("serverId") || false;
    var a = e.data("playerId") || false;
    if (c === false || b === false || a === false) {
        if (f) {
            f(e)
        }
        return
    }
    $.ajax({
        type: "post", url: c, data: {serverId: b, playerId: a}, dataType: "json", success: function (g) {
            if (g === true) {
                if (d) {
                    d(e)
                }
            } else {
                if (f) {
                    f(e)
                }
            }
        }, error: function () {
            if (f) {
                f(e)
            }
        }
    })
}

function selectPlayerForPurchase(j) {
    var f = j.data("serverId") || false, d = j.data("playerId") || false, a = j.data("purchasingAllowed") || false,
        g = j.data("purchasingReason") || false, h = j.data("visibleReason") || false, b = (g) ? g : h,
        k = zs.data.loca.LOCA_BUY_NOW_BUTTON || "", e = zs.data.loca.LOCA_BUY_BUTTON || "", c, l;
    if (typeof b == "boolean") {
        b = ""
    }
    if (f === false || d === false) {
        closePseudoSelect(j)
    }
    if (typeof zs.fn.initPurchaseLink === "function") {
    }
    if (!zs.data.directPurchaseEnabled) {
        l = $("#buy .btn-price");
        c = $("#buy .btn-buy").hide();
        if (a) {
            c.hide();
            l.removeClass("btn-disabled ttip fancybox fancybox.ajax").html(e).prop("disabled", false).removeAttr("tooltip-content").show();
            $("#tiptip_holder").remove()
        } else {
            c.removeClass("fancybox fancybox.ajax").hide();
            l.addClass("btn-disabled ttip").html(zs.data.loca.LOCA_ITEM_NOT_AVAILABLE).attr("tooltip-content", b).show().tipTip({
                delay: 0,
                defaultPosition: "bottom",
                fadeIn: 100,
                attribute: "tooltip-content",
                maxWidth: 300
            })
        }
    } else {
        c = $("#buy .btn-buy");
        l = $("#buy .btn-price").hide();
        if (a) {
            c.removeClass("btn-disabled ttip").addClass("fancybox fancybox.ajax").html(k).attr("tooltip-content", "").prop("disabled", false).show();
            $("#tiptip_holder").remove()
        } else {
            c.removeClass("fancybox fancybox.ajax").addClass("btn-disabled ttip").html(zs.data.loca.LOCA_ITEM_NOT_AVAILABLE).attr("tooltip-content", b).show().tipTip({
                delay: 0,
                defaultPosition: "bottom",
                fadeIn: 100,
                attribute: "tooltip-content",
                maxWidth: 300
            })
        }
    }
    $("#buy .btn-disabled").click(function (m) {
        m.preventDefault();
        return
    });
    playerSelectDropdownChanged(j)
}

function selectPlayerForDistribution(c) {
    var b = c.data("serverId") || false;
    var a = c.data("playerId") || false;
    if (b === false || a === false) {
        closePseudoSelect(c)
    }
    if (typeof initDistributionLink === "function") {
        initDistributionLink(false, false, b, a)
    }
    changePseudoSelect(c)
}

zs.fn.selectRecipientType = function (c) {
    var b = c.find("p").data("recipientType") || -1;
    var a = false;
    if (!zs.data.directPurchaseEnabled) {
        $("#buy .btn-price, #buy .buy-btn-box").fadeIn();
        $("#buy .btn-buy").hide();
        $("#buy .btn-price").click(function () {
            $("#buy .btn-buy,#buy .buy-btn-box").css("display", "block");
            $("#buy .btn-price").hide()
        })
    }
    $(".character_list.gifting-list > li").show();
    if (b != -1) {
        $(".character_list.gifting-list > li").each(function () {
            if ($(this).data("recipientType") != b) {
                $(this).hide()
            } else {
                if (a === false) {
                    a = $(this)
                }
            }
        });
        if (typeof zs.fn.selectRecipient === "function") {
            if (a !== false) {
                zs.fn.selectRecipient(a);
                $("#buy button.btn").removeClass("btn-disabled");
                $("#buy button.btn").prop("disabled", false)
            } else {
                $("#buy button.btn").addClass("btn-disabled");
                $("#buy button.btn").prop("disabled", true)
            }
        }
    }
    changePseudoSelect(c)
};

function playerSelectDropdownChanged(a) {
    changePseudoSelect(a);
    setMatchingPlayerInList(a)
}

function playerSelectListChanged(a) {
    changeSelectedPlayerInList(a);
    setMatchingPlayerInDropdown(a);
    propagatePlayerSelection(a);
    window.location.href = window.location.href
}

function propagatePlayerSelection(a) {
    $("#slideMenu .account-infos p span.playerName").html(a.data("playerName"));
    $("#slideMenu .account-infos p span.serverName").html(a.data("serverName"))
}

function setMatchingPlayerInDropdown(a) {
    $(".pseudo-dropdown.playerSelection .select-option ul li a").each(function () {
        if ($(this).data("serverId") === a.data("serverId") && $(this).data("playerId") === a.data("playerId")) {
            changePseudoSelect($(this));
            return false
        }
    })
}

function setMatchingPlayerInList(a) {
    $(".character_list.playerSelection li").each(function () {
        if ($(this).data("serverId") === a.data("serverId") && $(this).data("playerId") === a.data("playerId")) {
            changeSelectedPlayerInList($(this));
            return false
        }
    })
}

function changeSelectedPlayerInList(a) {
    a.addClass("chosen").siblings().removeClass("chosen");
    a.find("span.checked").css("display", "block");
    a.siblings().find("span.checked").css("display", "none")
}

function getSelectedValue(a) {
    return $("#" + a).find(".select-input a span.value").html()
}

function calcCustomAmount(d) {
    var a = {price: -1, mileage: -1, payback: -1, paybackCurrency: -1, usedVariant: -1},
        b = zs.data.variants[zs.data.currency];
    var e = true;
    d = parseInt(d);
    for (var c in b) {
        c = parseInt(c);
        if (e) {
            e = false;
            if (isNaN(Math.round(d / c))) {
                if (console && console.log) {
                    console.log("returning " + a.price)
                }
                return a
            }
        }
        if (c <= d) {
            a.price = Math.ceil(b[c].price / c * d);
            a.mileage = Math.ceil(b[c].mileage / c * d);
            a.payback = Math.ceil(b[c].payback / c * d);
            a.paybackCurrency = b[c].paybackCurrency;
            a.volumeSaving = Math.floor(b[c].volumeSaving / c * d);
            a.usedVariant = c
        }
    }
    return a
}

function setDisabledBtn(d) {
    var c = $(d + " .btn-price"), a = $(d + " .btn-buy"), b = c.closest(d);
    if (!c.hasClass("btn-disabled")) {
        c.click(function () {
            var e = $(this).closest(".btn-buy-box");
            e.find(".btn-buy").css("display", "block").end().find(".btn-price").hide()
        });
        a.on("mouseleave", function () {
            var e = $(this).closest(".btn-buy-box");
            window.setTimeout(function () {
                e.find(".btn-price").show().end().find(".btn-buy").hide()
            }, 2000)
        })
    } else {
        b.find(".btn-price").attr("disabled", "disabled").removeClass("btn-price");
        a.remove()
    }
}

function initBtnPrice(d, b) {
    var c = calcCustomAmount(d);
    var e = c.price;
    var a = c.mileage;
    var f = Math.round((parseInt(e) / parseInt(d)));
    if (!b) {
        $("#buy .btn-price, #buy .buy-btn-box").fadeIn();
        $("#buy .btn-buy").hide();
        $("#buy .btn-price").click(function () {
            $("#buy .btn-buy,#buy .buy-btn-box").css("display", "block");
            $("#buy .btn-price").hide()
        })
    }
    $("#buy p span").html(e);
    $("#itemBuy p.bill_sum strong.bill_price").html(e);
    $("#purchaseLink").data("price", e);
    $("#purchaseLink").data("mileage", a);
    $("#itemBuy p.bill_sum strong.bill_amount").text(d);
    $(".unitCount").text(d);
    $("#itemBuy span.coin15px").text(f)
}

function initRoyalSlider(a, b) {
    $(a).royalSlider({
        autoScaleSlider: false,
        addActiveClass: true,
        controlNavigation: "none",
        arrowsNav: true,
        arrowsNavAutoHide: false,
        navigateByClick: false,
        loop: true,
        numImagesToPreload: 3,
        allowCSS3: false,
        controlsInside: false,
        fadeinLoadedSlide: false,
        visibleNearby: {
            enabled: true,
            centerArea: b,
            center: false,
            breakpoint: 0,
            breakpointCenterArea: 3,
            navigateByCenterClick: true
        }
    });
    $(a).css("visibility", "visible")
}

function scrollBottom() {
}

function setSelectedCurrency(d, c) {
    if (!zs.data.selectedCurrencyAction) {
        return
    }
    var a = $(c).attr("data-currency"),
        b = zs.data.selectedCurrencyAction.replace(/selectcurrency\/X/i, "selectcurrency/" + a);
    if ($(c).is(":checked")) {
        $.ajax({
            url: b, success: function () {
                window.location.href = window.location.href
            }
        })
    } else {
        d.preventDefault()
    }
}

function setSameHeight(a) {
    var b = 0;
    a.each(function () {
        b = Math.max(b, $(this).height())
    });
    if (b > 0) {
        a.each(function () {
            $(this).css("height", b + "px")
        })
    }
}

function replLocalize(d, c, e, b) {
    e = e || "{$", b = e || "$}";
    for (var a in c) {
        if (c[a]) {
            d = d.replace(new RegExp(e + a + b, "g"), c[a])
        } else {
            d.replace(new RegExp("%%" + a + "%%", "g"), "NO LOCAARG")
        }
    }
    return d
}

zs.fn.cutItemDesc = function (b, a) {
    a = zs.data.textLimit[zs.data.game] || a;
    $(b).each(function () {
        var e = $.trim($(this).html()), d = "";
        if (/<br\s*\/?>/i.test(e) && /â€¢/.test(e)) {
            var c = e.split(/<br\s*\/?>/i);
            while (i = c.shift()) {
                if ((d + i).length < a) {
                    d += (/â€¢/.test(i)) ? i.replace(/â€¢\s*/, "<li>") + "</li>" : i + "<br>"
                } else {
                }
            }
            if (!/<ul/.test(d) && /<li>/.test(d)) {
                d = "<ul>" + d + "</ul>"
            }
        } else {
            if (/â€¢/.test(e)) {
                d += "<ul>" + e.replace(/â€¢\s*/, "<li>") + "</li></ul>"
            } else {
                if (/<li/.test(e)) {
                    d = $.trim(e)
                } else {
                    d = ($.trim(e).length > a) ? $.trim(e).substr(0, a - 10) + "..." : $.trim(e)
                }
            }
        }
        $(this).html(d)
    })
};
zs.fn.cutItemListDesc = function (b, a) {
    $(this).text(function (c, d) {
        return ($.trim(d).length >= a) ? $.trim(d).substr(0, a) + "..." : d
    })
};
zs.fn.initScrollerItems = function (a, m, f) {
    var g = $(a), b, j, d, h, q, c, r, n, s, p, k, e;
    b = g.find(".mCSB_container");
    g.mCustomScrollbar({
        mouseWheelPixels: 200,
        cursorScroll: true,
        axis: "y",
        langDir: "rtl",
        callbacks: {
            onTotalScroll: function () {
            }, onTotalScrollOffset: 200
        }
    });
    if (null !== f && f != "undefined") {
        b.mCustomScrollbar("scrollTo", f, {scrollInertia: 0})
    }

    function l() {
        if (d <= c && b.position().top !== 0) {
            n = b.position().top > -g.height() ? "top" : b.position().top + g.height();
            g.mCustomScrollbar("scrollTo", n, {scrollInertia: q});
            s.css("height", e)
        } else {
            if (d >= (g.height() - c) && -(Math.floor(b.position().top - g.height())) !== b.height()) {
                g.mCustomScrollbar("scrollTo", b.position().top - g.height(), {scrollInertia: q});
                p.css("height", e)
            } else {
                g.mCustomScrollbar("stop");
                k.css("height", 0)
            }
        }
    }

    function o(u) {
        var t = 0;
        if (u.offsetParent) {
            t = u.offsetTop;
            while (u = u.offsetParent) {
                t += u.offsetTop
            }
        }
        return t
    }
};

function updateBalancesAjax() {
    if (!("data" in zs) || !("tokenUrl" in zs.data)) {
        return false
    }
    var a = zs.data.tokenUrl.replace("%controller_method%", "ajax/callback/getbalances");
    $.ajax({
        url: a, type: "get", dataType: "json", success: function (g) {
            if (typeof g != "object") {
                var l;
                try {
                    l = $.parseJSON(g)
                } catch (h) {
                    l = false
                }
            } else {
                l = g
            }
            if (!l || typeof l != "object") {
                return false
            }
            for (var f in l) {
                var c = l[f], e = $("#balances" + f), d = (zs.data.useCurrencyFormatter) ? function () {
                    formatCurrency(e)
                } : function () {
                };
                if (!e.length) {
                    continue
                }
                $("#balances" + f).attr("data-currency", c);
                var b = parseInt(e.text());
                var j = new countUp("balances" + f, b, c, 0, 3, {
                    useEasing: true,
                    useGrouping: true,
                    separator: "",
                    decimal: "",
                    prefix: "",
                    suffix: ""
                });
                j.start(d)
            }
        }
    })
}

function formatCurrency(a) {
    var c = a.attr("data-currency"), b = shortenValue(c, 6);
    a.text(b)
}

function getFormattedCurrencyValue(a) {
    return shortenValue(parseInt(a), 6)
}

function smallSearch() {
    var a = 130, c = $("body").hasClass("rtl"), b = $("#searchBar");
    if (c) {
        b.css("left", -67)
    } else {
        b.css("right", -67)
    }
    b.css("visibility", "visible");
    b.hover(function () {
        var f = $(this), e = setTimeout(function () {
            d(f, true, a)
        }, 500);
        f.data("timeout", e)
    }, function () {
        clearTimeout($(this).data("timeout"))
    });
    b.focusout(function () {
        if ($(this).find(".search-input").val().length === 0) {
            d($(this), false, "")
        }
    });

    function d(h, j, e) {
        if (c && $("html").hasClass("lt-ie7")) {
            if (zs.debug) {
                console.log("no active rtl + ie7")
            }
        } else {
            var f = h.find(".search-input"), g = h.find(".btn-search");
            if (j) {
                g.css({visibility: "visible"}).animate({opacity: 1}, 600);
                h.animate({left: c ? 0 : "initial", right: c ? "initial" : 0}, "slow");
                f.animate({width: e}, "slow", function () {
                    $(this).focus()
                })
            } else {
                h.animate({left: c ? -67 : "initial", right: c ? "initial" : -67}, "slow");
                f.animate({width: "0"}, "slow");
                g.css({visibility: "hidden"}).animate({opacity: 0}, 600)
            }
        }
    }
}

function teleshoppingCountdownTimer(a) {
    $(".teleshoppingTimer").text(formatTimeInterval(a[3], a[4], a[5], a[6]))
}

function formatTimeInterval(d, a, b, c) {
    d = (d > 0) ? d + zs.data.loca.LOCA_SHORTCUT_DAYS + " " : "";
    a = (a > 0) ? a + zs.data.loca.LOCA_SHORTCUT_HOUR + " " : "";
    b = (b > 0) ? b + zs.data.loca.LOCA_SHORTCUT_MINUTE + " " : "";
    c = (c > 0) ? c + zs.data.loca.LOCA_SHORTCUT_SECOND + " " : "";
    return d + a + b + c
}

zs.data.paymentFancyboxConfig = {
    title: false,
    width: 800,
    height: 602,
    tpl: {closeBtn: '<button title="Kapat" class="fancybox-item fancybox-close btn-default" href="javascript:;"></button>'},
    afterLoad: function (c) {
        var a;
        try {
            a = $.parseJSON(c.content)
        } catch (b) {
            a = false
        }
        if (a && a.reload === true) {
            window.location.href = window.location.href;
            return false
        }
        $(".cancel").click(function () {
            $.fancybox.close()
        });
        $(".fancybox-overlay").prop("id", "paymentOverlay");
        $(".fancybox-wrap").prop("id", "paymentOverlayWrap")
    },
    helpers: {overlay: {closeClick: false}}
};
var slideEvents = [];

function fireSlide(c) {
    return true;
}

$(document).ready(function () {
    IsIE7 = $("html").hasClass("lt-ie7");
    $("#header .currency_status [data-toggle=popover]").popover({
        html: true, content: function () {
            var c = $(this).attr("data-currency"), e = (c === zs.data.selectedCurrency) ? " checked " : "",
                g = replLocalize(zs.data.loca.saveAsDefaultCurrency, {currency: '<span class="currency-name">' + zs.data.currencies[c].loca + "</span>"}, "%", "%"),
                b = $('<input type="checkbox" class="float-left" name="favoriteCurrency" data-currency="' + c + '" ' + e + 'onclick="setSelectedCurrency(event, this)" />'),
                d = $('<div class="currency-text"/>').append(g).append("<p>" + zs.data.currencies[c].info + "</p>"),
                f = $("<div />").append(b).append(d);
            return f.html()
        }
    }).on("show.bs.popover", function () {
        $("#header .currency_status .popover-open").popover("hide").removeClass("popover-open");
        $(this).addClass("popover-open")
    }).on("hide.bs.popover", function () {
        $(this).removeClass("popover-open")
    });
    zs.fn.cutItemDesc(".item-text, .item-stats", 100);
    $("body").on("click", function (d) {
        if (!$(".popover-open").exists()) {
            return
        }
        var c = d.target || d.srcElement,
            f = ($(c).is("ul.currency_status li") || $(c).closest("ul.currency_status li").exists()),
            b = ($(c).is(".popover") || $(c).closest(".popover").exists());
        if (!f && !b) {
            $(".popover-open").popover("hide")
        }
    });
    initRoyalSlider(".carousell", zs.module.small ? 0.43 : 0.2999999);
    $("#prmoSlider.royalSlider").royalSlider({
        autoPlay: {enabled: true, pauseOnHover: false, delay: 5000},
        autoScaleSlider: false,
        arrowsNav: true,
        arrowsNavAutoHide: false,
        fadeinLoadedSlide: false,
        controlNavigationSpacing: 0,
        controlNavigation: "bullets",
        imageScaleMode: "none",
        imageAlignCenter: false,
        blockLoop: true,
        loop: true,
        navigateByClick: false,
        numImagesToPreload: 15,
        transitionType: "fade",
        keyboardNavEnabled: true,
        block: {delay: 400}
    });
    var a = $("#prmoSlider.royalSlider").data("royalSlider");
    if (null !== a) {
        a.ev.on("rsAfterSlideChange", function (b) {
            fireSlide($(a.currSlide.content).find(".bContainer"))
        })
    }
    if ($("#prmoSlider").exists() && a) {
        fireSlide($(a.slides[0].content).find(".bContainer"))
    }
    $(".cancel").click(function () {
        $.fancybox.close()
    });
    showPriceArticle();
    dropDownArticle();
    setDisabledBtn(".only-club");
    if ($("#prmoSlider").exists() && $("#prmoSlider .bContainer").length <= 1) {
        $(".rsBullets").hide()
    }
    customScroll();
    $(".pseudo-dropdown").each(function () {
        pseudoSelect($(this))
    });
    $("li.has-subnavi").hover(function () {
        $(this).addClass("active-cat")
    }, function () {
        $(this).removeClass("active-cat")
    });
    $("a.gift-link.ttip").on("click", function () {
        $(".ttip").mouseout()
    });
    cardMargin();
    initFocusClear();
    zs.data.fancyboxConfig = {
        title: false,
        tpl: {closeBtn: '<button title="Kapat" class="fancybox-item fancybox-close btn-default" href="javascript:;"></button>'},
        type: "ajax",
        afterLoad: function (b) {
            $(".cancel").click(function () {
                $.fancybox.close()
            })
        },
        beforeShow: function () {
            initRoyalSlider(".carousell", zs.module.small ? 0.49 : 0.44);
            $(".scrollable_container_fancy").mCustomScrollbar({theme: "dark"});
            if (!($("html").hasClass("lt-ie7"))) {
                zs.fn.initScrollerItems("#club-membership .scrollable_container", false)
            }
            if ($(".pseudo-dropdown.purchaseSelection").length > 0) {
                pseudoSelect($(".pseudo-dropdown.purchaseSelection"))
            }
            if ($(".pseudo-dropdown.distributionSelection").length > 0) {
                pseudoSelect($(".pseudo-dropdown.distributionSelection"))
            }
            if ($(".pseudo-dropdown.relationType").length > 0) {
                pseudoSelect($(".pseudo-dropdown.relationType"))
            }
        },
        beforeClose: function () {
            updateBalancesAjax();
            if ($("div.fancybox-overlay").hasClass("reload")) {
            }
        }
    };
    zs.data.fancyboxRewardsConfig = {
        tpl: {closeBtn: '<button title="Kapat" class="fancybox-item fancybox-close btn-default" href="javascript:;"></button>'},
        autoDimensions: false,
        width: 340,
        height: "auto",
        overlayOpacity: 0.6,
        showCloseButton: true,
        enableEscapeButton: false,
        hideOnOverlayClick: false,
        hideOnContentClick: false,
        padding: 10,
        beforeShow: function () {
            initRoyalSlider(".carousell-reward", zs.module.small ? 0.52 : 0.46)
        }
    };
    $("#character-selection  .scrollable_container").mCustomScrollbar();
    $(".character_list li.chosen , .character_list.gifting-list li.chosen").find("span.checked").css("display", "block");
    $(".character_list  li , .character_list.gifting-list li").click(function () {
        if ($(".character_list").hasClass("playerSelection")) {
            selectPlayer($(this), playerSelectListChanged)
        } else {
            changeSelectedPlayerInList($(this))
        }
    });
    $(".fancybox").fancybox({
        title: false,
        tpl: {closeBtn: '<button title="Kapat" class="fancybox-item fancybox-close btn-default" href="javascript:;"></button>'},
        afterLoad: function (d) {
            var b;
            try {
                b = $.parseJSON(d.content)
            } catch (c) {
                b = false
            }
            if (b && b.reload === true) {
                window.location.href = window.location.href;
                return false
            }
            $(".cancel").click(function () {
                $.fancybox.close()
            })
        },
        beforeShow: function () {
            initRoyalSlider(".carousell", zs.module.small ? 0.49 : 0.44);
            $(".scrollable_container_fancy").mCustomScrollbar({theme: "dark"});
            if (!($("html").hasClass("lt-ie7"))) {
                zs.fn.initScrollerItems("#club-membership .scrollable_container", false)
            }
            if ($(".pseudo-dropdown.purchaseSelection").length > 0) {
                pseudoSelect($(".pseudo-dropdown.purchaseSelection"))
            }
            if ($(".pseudo-dropdown.distributionSelection").length > 0) {
                pseudoSelect($(".pseudo-dropdown.distributionSelection"))
            }
            if ($(".pseudo-dropdown.relationType").length > 0) {
                pseudoSelect($(".pseudo-dropdown.relationType"))
            }
        },
        beforeClose: function () {
            if ($("div.fancybox-overlay").hasClass("reload")) {
                if ("CATEGORY_NAVIGATION_TARGET" in window && CATEGORY_NAVIGATION_TARGET) {
                    window.location.href = CATEGORY_NAVIGATION_TARGET
                } else {
                    window.location.href = window.location.href
                }
            }
        },
        afterShow: function () {
            var d = $("#item-fancybox").height(), b = $(".fancybox-inner").height(), c = $(window).height();
            if (c < d) {
                $("#item-fancybox").css("height", b + "px")
            }
            window.onresize = function (j) {
                var g = $(".fancybox-inner").height(), f = window.innerHeight || window.documentElement.clientHeight;
                if (f > d) {
                    $("#item-fancybox").css("height", d - 11 + "px")
                } else {
                    $("#item-fancybox").css("height", g + "px")
                }
            }
        }
    });
    $(".paymentfancybox").fancybox(zs.data.paymentFancyboxConfig);
    $(".loginfancybox").fancybox({
        title: false,
        width: zs.data.loginWindowWidth,
        height: zs.data.loginWindowHeight,
        fitToView: false,
        autoSize: false,
        autoDimensions: false,
        tpl: {closeBtn: '<button title="Kapat" class="fancybox-item fancybox-close btn-default" href="javascript:void(0);"></button>'},
        beforeLoad: function () {
            var b = $(this.element);
            $(window).on("message", function (d) {
                if (d.originalEvent.data == "reload") {
                    var e = b.data("redirect");
                    if (e.match(/\/ajax\/detail\/displayboxed\//)) {
                        location.href = e.replace(/\?/, "&").replace(/\/ajax\/detail\/displayboxed\//, "/main/start?detail=")
                    } else {
                        location.href = e
                    }
                } else {
                    if ((typeof d.originalEvent.data).toLowerCase() == "string" && d.originalEvent.data.substr(0, 7) == "reload:") {
                        var c = d.originalEvent.data.substr(7);
                        var e = b.data("redirect-token");
                        e = e.replace("-token-", c);
                        location.href = e
                    }
                }
                if (d.originalEvent.data == "close") {
                    $.fancybox.close()
                }
            })
        }
    });
    $(".vaultfancybox").fancybox({
        title: false,
        tpl: {closeBtn: '<button title="Kapat" class="fancybox-item fancybox-close btn-default" href="javascript:void(0);"></button>'},
        beforeLoad: function () {
        }
    });
    if (!($("html").hasClass("lt-ie7"))) {
        zs.fn.initScrollerItems(".content .scrollable_container", true, zs.data.scrollToId);
        $(".content .scrollable_container").addClass("rendered")
    }
    $(".search-input").keydown(function (b) {
        b = b || window.event;
        if (b.keyCode === 13 || b.which === 13) {
            $(".btn-search").click()
        }
    });
    if (zs.module.small) {
        smallSearch()
    }
    $("table > tbody > tr:odd").addClass("tr-odd");
    $("#overlayMask").on("click", function () {
        var b = zs.data.dir;
        if (b === "ltr") {
            $("#contentContainer").animate({right: "0"}, 500, function () {
            })
        } else {
            $("#contentContainer").animate({left: "0"}, 500, function () {
            })
        }
        $("#overlayMask").animate({opacity: "0"}, 500, function () {
            $(this).hide();
            $("#page").removeClass("slide_menu_active");
            $("#contentContainer").removeClass("open");
            $("#showRightPush").removeClass("active")
        })
    });
    $("#showRightPush").on("click", function () {
        var b = zs.data.dir;
        $(this).toggleClass("active");
        $("#page").toggleClass("slide_menu_active");
        $("#contentContainer").toggleClass("open");
        if ($("#contentContainer").hasClass("open")) {
            $("#overlayMask").show().animate({opacity: "0.7"}, 500, function () {
            });
            if (b === "ltr") {
                $("#contentContainer").animate({right: (!zs.module.small) ? "322px" : "280px"}, 500, function () {
                })
            } else {
                $("#contentContainer").animate({left: (!zs.module.small) ? "322px" : "280px"}, 500, function () {
                })
            }
        } else {
            if (b === "ltr") {
                $("#contentContainer").animate({right: "0"}, 500, function () {
                })
            } else {
                $("#contentContainer").animate({left: "0"}, 500, function () {
                })
            }
            $("#overlayMask").animate({opacity: "0"}, 500, function () {
                $(this).hide()
            })
        }
    });
    $("#prmoSlider").royalSlider("updateSliderSize", true);
    setSameHeight($("#accountContent .row-fluid .inner_box"));
    $(".ttip").tipTip(zs.data.ttip);
    if (zs.data.detailRedirect) {
        $.fancybox.open({href: zs.data.detailRedirect, title: false}, zs.data.fancyboxConfig)
    }
    if ($("#navigation .nav.search").width() >= 720) {
        $("#navigation").addClass("nav-long")
    }
    zs.autocompletecache = {};
    $("input.search-input").autocomplete({
        minLength: 3, delay: 300, messages: {
            noResults: "", results: function () {
            }
        }, select: function (b, c) {
            $('input[name="searchString"]').val(c.item.value);
            $(".btn-search").click()
        }, source: function (e, c) {
            var d = e.term.replace(/#/, "");
            if (d in zs.autocompletecache) {
                c(zs.autocompletecache[d]);
                return
            }
            var b = 12;
            if (zs.module.small) {
                b = 6
            }
            $.getJSON(zs.data.baseUrl + "ajax/callback/search/" + d + "/" + b + "/?__token=" + $("input[name=__token]").val(), {}, function (f) {
                zs.autocompletecache[d] = f;
                c(f)
            });
            $(".ui-helper-hidden-accessible").remove()
        }
    }).autocomplete("instance")._renderItem = function (b, c) {
        return $("<li>").append('<a><img class="ui-icon" src="' + c.image + '" />' + c.name + "</a>").appendTo(b)
    };
    $("#collection-bundles .img-wrapper").hover(function () {
        if (!IsIE7) {
            $(this).removeAttr("title")
        }
    });
    if ($(".aion #slideMenu .character-switch").length) {
        $(".aion #slideMenu .character-name").mouseover(function () {
            $(".aion #slideMenu .character-switch").toggle();
            $(".aion #slideMenu .text-switch").toggle()
        });
        $(".aion #slideMenu .character-switch").mouseout(function () {
            $(".aion #slideMenu .character-switch").toggle();
            $(".aion #slideMenu .text-switch").toggle()
        })
    } else {
        $(".aion #slideMenu .character-name").css("text-decoration", "none")
    }
});

function sortDepotitemsBy(e) {
    var d = document.querySelector("ul.item-list"), a = "", b, h = [], f = [];
    if (e == "time") {
        a = "data-sort-time"
    } else {
        if (e == "name_asc" || e == "name_desc") {
            a = "data-sort-name"
        }
    }
    if (!d) {
        return
    }
    if (IsIE7) {
        addQuerySelector(d)
    }
    b = d.querySelectorAll("li.depot-item");
    for (var c in b) {
        if (b[c].nodeType == 1) {
            h.push(b[c])
        }
    }
    h.sort(function (l, j) {
        var m = String(l.getAttribute(a)).toLowerCase(), k = String(j.getAttribute(a)).toLowerCase();
        if (m == k) {
            return 0
        }
        if (e == "name_asc") {
            return m > k ? 1 : -1
        } else {
            if (e == "name_desc") {
                return m > k ? -1 : 1
            } else {
                return m > k ? -1 : 1
            }
        }
    });
    for (c = 0; c < h.length; ++c) {
        d.appendChild(h[c]);
        var g = $(h[c]).find(".item-shortdesc").data("id");
        f.push(g)
    }
    saveSortOption(e, "depotitems", f)
}

function saveSortOption(d, a, c) {
}

function sortArticlesBy(h) {
    var l = "", m = document.querySelectorAll("ul.item-list"), c = [];
    if (h == "standardArticleSort") {
        l = "data-sort-sort"
    } else {
        if (h == "upNameArticleSort" || h == "downNameArticleSort") {
            l = "data-sort-name"
        } else {
            if (h == "upPriceArticleSort" || h == "downPriceArticleSort") {
                l = "data-sort-price"
            }
        }
    }
    for (var e = 0, f = m.length; e < f; e = e + 1) {
        var g = m[e];
        if (IsIE7) {
            addQuerySelector(g)
        }
        var k = g.querySelectorAll("li.list-item"), a = [];
        for (var d in k) {
            if (k[d].nodeType == 1) {
                a.push(k[d])
            }
        }
        a.sort(function (o, j) {
            var p = String(o.getAttribute(l)).toLowerCase(), n = String(j.getAttribute(l)).toLowerCase();
            if (p == n) {
                return 0
            }
            if (h == "upPriceArticleSort" || h == "downPriceArticleSort") {
                p = parseInt(p);
                n = parseInt(n)
            }
            if (h == "upNameArticleSort" || h == "upPriceArticleSort") {
                return p > n ? 1 : -1
            } else {
                if (h == "downNameArticleSort" || h == "downPriceArticleSort") {
                    return p > n ? -1 : 1
                } else {
                    return p > n ? 1 : -1
                }
            }
        });
        for (var d = 0; d < a.length; ++d) {
            g.appendChild(a[d]);
            var b = $(a[d]).find(".item-shortdesc").data("id");
            c.push(b)
        }
    }
    saveSortOption(h, "category", c);
}

function shortenValue(e, f) {
    var b = {k: 3, m: 6};
    e = Math.floor(e).toString();
    var d = "";
    var a = e;
    if (e.length > f) {
        for (var c in b) {
            a = Math.floor(e / Math.pow(10, b[c]));
            d = c;
            if (a.toString().length < f) {
                break
            }
        }
    }
    return locaNumberFormat(a, 0) + d
}

function locaNumberFormat(c, d) {
    if (typeof d === "undefined") {
        d = 0
    }
    var a = zs.data.loca.LOCA_DECIMALPOINT;
    var b = zs.data.loca.LOCA_THOUSANDSEPARATOR;
    return numberFormat(c, d, a, b)
}

function numberFormat(d, b, m, c) {
    var k = "";
    var l = d.toString();
    var h = l.indexOf("e");
    if (h > -1) {
        k = l.substring(h);
        d = parseFloat(l.substring(0, h))
    }
    if (b != null) {
        var n = Math.pow(10, b);
        d = Math.round(d * n) / n
    }
    var a = d < 0 ? "-" : "";
    var g = (d > 0 ? Math.floor(d) : Math.abs(Math.ceil(d))).toString();
    var e = d.toString().substring(g.length + a.length);
    m = m != null ? m : ".";
    e = b != null && b > 0 || e.length > 1 ? (m + e.substring(1)) : "";
    if (b != null && b > 0) {
        for (var f = e.length - 1, j = b; f < j; ++f) {
            e += "0"
        }
    }
    c = (c != m || e.length == 0) ? c : null;
    if (c != null && c != "") {
        for (var f = g.length - 3; f > 0; f -= 3) {
            g = g.substring(0, f) + c + g.substring(f)
        }
    }
    return a + g + e + k
}

function showRewardsPanel() {
    $(".rewards-panel").fadeIn(300);
    initRoyalSlider(".carousell-reward", zs.module.small ? 0.51 : 0.32);
    $(".tab-content .carousell-reward").royalSlider("updateSliderSize", true)
}

function hideRewardsPanel() {
    $(".rewards-panel").hide()
}

function loadRewardsPanel(b, a) {
    $.ajax({
        type: "get", data: {}, url: b, success: function (c) {
            a.append(c);
            showRewardsPanel();
            $(".rewards-panel .heading-tab").on("click", function () {
                var d = $($(this).attr("href"));
                $(".tab-content>.tab-pane").css("display", "none");
                d.css("display", "block");
                setTimeout(function () {
                    $(".rewards-panel .tab-content .carousell-reward").royalSlider("updateSliderSize", true)
                }, 1)
            });
            $(".tab-content .scrollable_container").mCustomScrollbar();
            $(".close-panel").click(function () {
                $(".rewards-panel").remove()
            })
        }
    })
}

var toi_OpenPayment = null;

function teraOpenPayment(c, b, f, e) {
    var d = function () {
        _tera_client_proxy_.invoke_menu(f)
    };
    var a = function () {
        _tera_client_proxy_.open_web_direct(c)
    };
    _openPaymentWithOverlay(c, b, d, a, e)
}

function aionOpenPayment(c, b, f, e) {
    if (f) {
        var d = function () {
            var g = zs.data.paymentFancyboxConfig;
            g.type = "iframe";
            $.fancybox.open({href: c}, g)
        };
        var a = d
    } else {
        var d = function () {
            AionObject.OpenSteamOverlay("")
        };
        var a = function () {
            AionObject.OpenExternalWeb(c)
        }
    }
    _openPaymentWithOverlay(c, b, d, a, e)
}

function _openPaymentWithOverlay(c, b, a, e, d) {
    if (b) {
        a()
    } else {
        e();
        if (zs.data.variable24) {
            _hhOpenSlider()
        }
    }
    if (b) {
        $("#steam-payment-overlay2").find(".premium-button, .club-button").hide();
        if (d) {
            $("#steam-payment-overlay2").find(".club-button").show();
            $("#steam-payment-overlay2").find(".premium-button").hide()
        } else {
            $("#steam-payment-overlay2").find(".premium-button").show();
            $("#steam-payment-overlay2").find(".club-button").hide()
        }
        $.fancybox.open(["#steam-payment-overlay"], {
            title: false,
            tpl: {closeBtn: ""},
            keys: {close: null},
            helpers: {overlay: {closeClick: true}},
            enableEscapeButton: false,
            beforeClose: function () {
                if (toi_OpenPayment) {
                    clearTimeout(toi_OpenPayment)
                }
            }
        });
        toi_OpenPayment = setTimeout(function () {
            if (typeof $.fancybox == "function") {
                $.fancybox.close()
            }
            _showSteamMessage2(d)
        }, 8000)
    }
}

function _showSteamMessage2(a) {
    $.fancybox.open(["#steam-payment-overlay2"], {
        title: false,
        tpl: {closeBtn: ""},
        keys: {close: null},
        helpers: {overlay: {closeClick: true}},
        enableEscapeButton: false,
        beforeClose: function () {
            if (toi_OpenPayment) {
                clearTimeout(toi_OpenPayment)
            }
        }
    });
    toi_OpenPayment = setTimeout(function () {
        if (typeof $.fancybox == "function") {
            $.fancybox.close()
        }
        _showSteamMessage3(a)
    }, 8000)
}

function _showSteamMessage3(a) {
    if (a) {
        $("#steam-payment-overlay3").find(".club-button").show();
        $("#steam-payment-overlay3").find(".premium-button").hide()
    } else {
        $("#steam-payment-overlay3").find(".premium-button").show();
        $("#steam-payment-overlay3").find(".club-button").hide()
    }
    $.fancybox.open(["#steam-payment-overlay3"], {
        title: false,
        tpl: {closeBtn: ""},
        keys: {close: null},
        helpers: {overlay: {closeClick: true}},
        enableEscapeButton: false,
        beforeClose: function () {
            if (toi_OpenPayment) {
                clearTimeout(toi_OpenPayment)
            }
        }
    });
    toi_OpenPayment = setTimeout(function () {
        if (typeof $.fancybox == "function") {
            $.fancybox.close();
            if (zs.data.variable24) {
                _hhOpenSlider()
            }
        }
    }, 8000)
}

function zsDropdown(g) {
    var e = {}, b = g.closest(".zs-dropdown"), f = $(window), c = b.find(".dropdown-menu"),
        a = b.find(".dropdown-selection");

    function d() {
        return c.height() > (f.height() - c.offset().top)
    }

    e.initEvents = $(function () {
        $(document).click(function () {
            e.closeMenu()
        });
        $(document).scroll(function () {
            e.closeMenu()
        })
    });
    e.closeMenu = function () {
        b.removeClass("open");
        c.css("position", "absolute");
        c.css("left", 0);
        c.css("top", 30)
    };
    e.onToggleMenu = function () {
        var h = (c.offset().left);
        var j = (c.offset().top);
        if (h != 0 && j != 0 && c.is(":visible")) {
            if (d()) {
                c.css("position", "fixed");
                c.css("top", -40 - c.height() + j + "px");
                c.css("left", h + "px")
            } else {
                c.css("position", "fixed");
                c.css("left", h + "px");
                c.css("top", j + "px")
            }
        } else {
            this.closeMenu()
        }
    };
    e.onClickOption = function (h) {
        this.setPrice(h.data("price"));
        this.setText(h.data("text"));
        this.setPayback(h.data("payback"));
        this.setCount(h.data("count"));
        this.closeMenu()
    };
    e.setPrice = function (h) {
        a.data("price", h)
    };
    e.getCurrentPrice = function () {
        return a.data("price")
    };
    e.setText = function (h) {
        a.text(h);
        a.data("text", h)
    };
    e.getCurrentText = function () {
        return a.data("text")
    };
    e.setPayback = function (h) {
        a.data("payback", h)
    };
    e.getCurrentPayback = function () {
        return a.data("payback")
    };
    e.setCount = function (h) {
        a.data("count", h)
    };
    e.getCurrentCount = function () {
        return a.data("count")
    };
    return e
}

function getCategoryPurchaseLink(c, e, f, l, n, j, m, k, g, d, p, o, h, b) {
    return true;
}

function removeTitleAttr(a) {
    a.attr("title")
}

function removeFrameLoading(a) {
    if (!a) {
        var a = $("body")
    }
    a.find(".loading-icon.frame-loading").remove()
}

function setIframeHeight(c, b) {
    if (!c.contentDocument) {
        return
    }
    if (!c.contentDocument.body) {
        return
    }
    var d = c.contentDocument.body;
    var a = Math.max(d.clientHeight, d.scrollHeight, d.offsetHeight, 0);
    if (b && typeof b == "number") {
        a += b
    }
    c.style.height = a + "px"
}

function setIframeHeightHandler() {
    $(window).on("message", function (d) {
        if (typeof(d.originalEvent.data).toLowerCase() != "string") {
            return
        }
        var c = d.originalEvent.data;
        if (c.indexOf(":") == -1) {
            return
        }
        var b = c.split(":");
        if (b.length != 2) {
            return
        }
        if (b[0] != "resizeFrameHeight") {
            return
        }
        var a = parseInt(b[1]);
        $("iframe").css("height", a + "px");
        $(".scrollable_container").mCustomScrollbar("update")
    })
}

function _hhOpenSlider() {
    if (!zs.data.variable24) {
        return
    }
    var a = zs.data.tokenUrl;
    a = a.replace("%controller_method%", "callback/getHHSlide");
    $.ajax({
        url: a, type: "get", success: function (c) {
            if (!c) {
                return
            }
            $("#hh-after-slide").remove();
            $("body").append(c);
            var b = {
                title: false,
                tpl: {closeBtn: '<button title="Kapat" class="fancybox-item fancybox-close btn-default" href="javascript:;" onclick="addFancyReloadClass()"></button>'},
                keys: {close: null},
                helpers: {overlay: {closeClick: false}},
                enableEscapeButton: false,
                beforeClose: function () {
                    $.ajax({
                        url: zs.data.tokenUrl.replace("%controller_method%", "callback/planRefreshAccountData"),
                        type: "get",
                        async: false,
                        success: function (d) {
                            if ($(".fancybox-overlay").hasClass("reload")) {
                                window.location.href = window.location.href
                            }
                        }
                    })
                }
            };
            $.fancybox.open(["#hh-after-slide"], b)
        }
    })
}

function addFancyReloadClass() {
    $(".fancybox-overlay").addClass("reload")
}

function styleSliderArrows() {
    $(".top-items").each(function (a, b) {
        if ($(b).is(":first-child") && $(b).hasClass("activeSlide")) {
            $("#prevSlide").fadeTo(0, 0.25);
            $("#prevSlide").css("cursor", "default")
        } else {
            $("#prevSlide").fadeTo(0, 1);
            $("#prevSlide").css("cursor", "pointer")
        }
        if ($(b).is(":last-child") && $(b).hasClass("activeSlide")) {
            $("#nextSlide").fadeTo(0, 0.25);
            $("#nextSlide").css("cursor", "default")
        } else {
            $("#nextSlide").fadeTo(0, 1);
            $("#nextSlide").css("cursor", "pointer")
        }
        if ($("#top-items-1").hasClass("activeSlide")) {
            $("#prevSlide").fadeTo(0, 0.25);
            $("#prevSlide").css("cursor", "default")
        }
    })
}

function showTopItems(b) {
    $("#prevSlide").click(showPreviousSlider);
    $("#nextSlide").click(showNextSlider);
    var a = $(".top-items");
    a.removeClass("activeSlide").hide();
    $("#top-items-" + b).addClass("activeSlide").show().siblings("div").hide();
    a.royalSlider("updateSliderSize", true);
    a.find("#slide_level").text(b);
    styleSliderArrows();
    $("#prevSlide").css("opacity", "0.25");
    initRoyalSlider(".top-items", zs.module.small ? 0.51 : 0.46);
    setTimeout(function () {
        $(".top-items").royalSlider("updateSliderSize", true)
    }, 100)
}

function showNextSlider() {
    _showTopItemsSlider("next")
}

function showPreviousSlider() {
    _showTopItemsSlider("prev")
}

function _showTopItemsSlider(e) {
    var b = $(".top-items");
    var d = $(".slider_con").find(".activeSlide");
    var a = e == "prev" ? d.prev() : d.next();
    a.addClass("activeSlide").show().siblings("div").removeClass("activeSlide").hide();
    var c = $(".slider_con").find(".activeSlide").data("level");
    $("#topItems").find("#slide_level").text(c);
    styleSliderArrows()
};