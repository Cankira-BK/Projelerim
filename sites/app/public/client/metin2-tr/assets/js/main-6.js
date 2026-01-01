$(document).ready(function () {
    jQuery.fn.exists = function () {
        return jQuery(this).length > 0
    };
    var o = $(".tabcontrols");
    var l = o.find("li");
    var b = l.find("a");
    var m = o.parent();
    var n = m.find(".tab");
    if (b.length != n.length) {
        throw"tabcontrol - number of controls don't match with number of tabs!"
    }
    b.each(function (p) {
        $(this).on("click", function (q) {
            q.preventDefault();
            q.stopPropagation();
            c(p)
        })
    });

    function c(p) {
        l.removeClass("selected");
        $(l.get(p)).addClass("selected");
        n.removeClass("selected");
        $(n.get(p)).addClass("selected")
    }

    if ($(".nav-box-btn-2").length) {
        $(".nav-box-btn-2").wrapInner('<div id="resizing-box"></div>');
        $("#resizing-box").css("position", "absolute");
        var k = parseInt($(".nav-box-btn").css("font-size"));
        while ($(".nav-box-btn-2").width() <= $("#resizing-box").width()) {
            $(".nav-box-btn").css("font-size", --k + "px")
        }
        $(".nav-box-btn-2").html($("#resizing-box").text())
    }
    if ($(".secondary > aside > h2").length) {
        $(".secondary > aside > h2").wrapInner('<div class="resizing-box"></div>');
        $(".resizing-box").css("position", "absolute");
        k = parseInt($(".secondary > aside > h2").css("font-size"));
        while ($(".secondary > aside > h2").width() < g($(".resizing-box")) && k > 0) {
            $(".secondary > aside > h2").css("font-size", --k + "px")
        }
        $(".secondary > aside > h2").each(function () {
            $(this).html($(this).text())
        })
    }

    function g(q) {
        var p = 0;
        q.each(function () {
            var r = $(this).width();
            p = (r > p ? r : p)
        });
        return p
    }

    function a(r) {
        var p = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.$!;:-_#";
        for (var q = 0; q < r.length; q++) {
        }
        return true
    }

    function f(v, r) {
        var t = 0;
        var p = 100;
        var q = 7;
        var w = p / q;
        var u = "0123456789";
        if (e(v, u)) {
            t++
        }
        u = "abcdefghijklmnopqrstuvwxyz";
        if (e(v, u)) {
            t++
        }
        u = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if (e(v, u)) {
            t++
        }
        if (v.length < 6) {
            t = 0
        }
        if (v.length >= 6) {
            t++
        }
        if (v.length >= 8) {
            t++
        }
        if (v.length >= 10) {
            t++
        }
        var s = t * w;
        if (s > p) {
            s = p
        }
        return Math.ceil(s)
    }

    function e(p, q) {
        for (i = 0; i < p.length; i++) {
            if (q.indexOf(p.charAt(i)) > -1) {
                return true
            }
        }
        return false
    }

    $("input[type=password], input[type=text], textarea").filter(".autoclear").each(function () {
        var p = this.value;
        $(this).focus(function () {
            if ($(this).attr("readonly")) {
                $(this).select();
                return
            }
            if (this.value == p) {
                this.value = ""
            }
        });
        $(this).blur(function () {
            if (this.value == "") {
                this.value = p
            }
        })
    });
    $("#registerForm").validationEngine({validationEventTriggers: "keyup blur", inlineValidation: true});
    $("#loginForm, #pwlostForm, #changepwForm, #emailChangeForm, #resendactivForm, #lostPasswordCodeForm, #recruitMailForm, #creationForm, #captchaForm").validationEngine({
        validationEventTriggers: "blur",
        inlineValidation: true
    });
    $("#registerForm input").on("keyup click", function () {
        if (!$.validationEngine.loadValidation(this)) {
            if (!$(this).parent().has(".valid-check").length) {
                $(this).after('<div class="valid-check"></div>')
            }
        } else {
            $(this).parent().find(".valid-check").remove()
        }
    });
    $("#registerForm #ignoreTransferCode").change(function () {
        if ($("#ignoreTransferCode:checked").length) {
            $("#transfercode-register-area").hide();
            $("#transfercode").removeClass("validate[required]");
            $(".transfercodeformError").fadeOut(150, function () {
                $(this).remove()
            })
        } else {
            $("#transfercode-register-area").show();
            $("#transfercode").addClass("validate[required]")
        }
    });
    var d = function () {
        $("#checkerror label").toggleClass("green")
    };
    if ($("#tac:checked").length) {
        d()
    }
    $("#tac").click(d);
    var j = "";
    var h = 8;
    $("#password, #newPassword").keyup(function () {
        $("#validChar").text("");
        var p = $(this).val();
        if (!a(p)) {
            $("#validChar").text($("#txtInvalidChar").text());
            return
        }
        if (p.length >= 8) {
            $("#securePwd .valid-icon").removeClass("invalid");
            $("#securePwd").closest(".formError").addClass("valid")
        } else {
            $("#securePwd .valid-icon").addClass("invalid");
            $("#securePwd").closest(".formError").removeClass("valid")
        }
        j = f($(this).val(), h);
        if (j) {
            $("#securePwdBar").css({width: j + "%"});
            if (j > 69) {
                $("#securePwd #securePwdBar").css("background-position", "0 -39px")
            } else {
                if (j > 41) {
                    $("#securePwd #securePwdBar").css("background-position", "0 -26px")
                } else {
                    if (j < 41) {
                        $("#securePwd #securePwdBar").css("background-position", "0px 0px !important")
                    } else {
                        $("#securePwd #securePwdBar").css("background-position", "0px 0px")
                    }
                }
            }
        } else {
            $("#securePwdBar").css({width: 0});
            $("#securePwd .valid-icon").addClass("invalid")
        }
        if ((j > 49) && (p.length < 5)) {
            $("#securePwdBar").css({width: "48px", "background-position": "0px 0px"})
        }
    });
    $("#submitBtn").click(function () {
        var p = $(this).parent().validationEngine({returnIsValid: true});
        if (p == true) {
        }
    });
    $("a#single_image").fancybox();
    $("a#popupChar").fancybox({
        autoDimensions: false,
        width: 300,
        height: 200,
        padding: 0,
        scrolling: "no",
        overlayColor: "#000",
        overlayOpacity: 0.8,
        overlayShow: true,
        hideOnContentClick: true
    })
});

function showScreenshots(b) {
    b = parseInt(b);
    var a = "/cdn/img/screenshots/";
    Slimbox.open([[a + "screenshot-gallery-1.jpg", ""], [a + "screenshot-gallery-2.jpg", ""], [a + "screenshot-gallery-3.jpg", ""], [a + "screenshot-gallery-4.jpg", ""], [a + "screenshot-gallery-5.jpg", ""], [a + "screenshot-gallery-6.jpg", ""], [a + "screenshot-gallery-7.jpg", ""], [a + "screenshot-gallery-8.jpg", ""]], b)
}

function showIndexScreenshots(b) {
    b = parseInt(b);
    var a = "/cdn/img/screenshots/";
    Slimbox.open([[a + "screenshot-index-1.jpg", ""], [a + "screenshot-index-2.jpg", ""], [a + "screenshot-index-3.jpg", ""], [a + "screenshot-index-4.jpg", ""]], b)
}

function showWallpapers(a) {
    a = parseInt(a);
    var b = "/cdn/img/wallpapers/";
    Slimbox.open([[b + "wallpaper-1.jpg", ""], [b + "wallpaper-2.jpg", ""], [b + "wallpaper-3.jpg", ""], [b + "wallpaper-4.jpg", ""], [b + "wallpaper-5.jpg", ""], [b + "wallpaper-6.jpg", ""], [b + "wallpaper-7.jpg", ""], [b + "wallpaper-8.jpg", ""]], a)
}

function submitEnter(c, b) {
    var a;
    if (window.event) {
        a = window.event.keyCode
    } else {
        if (c) {
            a = c.which
        } else {
            return true
        }
    }
    if (a == 13) {
        document.forms[b].submit();
        return false
    } else {
        return true
    }
}

function setCookie(c, d, a) {
    var b = new Date();
    b.setDate(b.getDate() + a);
    document.cookie = c + "=" + escape(d) + "; path=/; expires=" + b.toGMTString() + ";"
};

var mmoActive_select = null;

function mmoInitSelect() {
    if (!document.getElementById) return false;
    document.getElementById('mmonetbar').style.display = 'block';
    document.getElementById('mmoGame').style.display = 'block';
    document.getElementById('mmoFocus').onkeyup = function (e) {
        mmo_selid = mmoActive_select.id.replace('mmoOptionsDiv', '');
        var e = e || window.event;
        if (e.keyCode) var thecode = e.keyCode; else if (e.which) var thecode = e.which;
        mmoSelectMe(mmo_selid, thecode);
    }
}

function mmoSelectMe(selid, thecode) {
    var mmolist = document.getElementById('mmoList' + selid);
    var mmoitems = mmolist.getElementsByTagName('li');
    switch (thecode) {
        case 13:
            mmoShowOptions(selid);
            window.location = mmoActive_select.url;
            break;
        case 38:
            mmoActive_select.activeit.className = '';
            var minus = ((mmoActive_select.activeid - 1) <= 0) ? '0' : (mmoActive_select.activeid - 1);
            mmoActive_select = mmoSetActive(selid, minus);
            break;
        case 40:
            mmoActive_select.activeit.className = '';
            var plus = ((mmoActive_select.activeid + 1) >= mmoitems.length) ? (mmoitems.length - 1) : (mmoActive_select.activeid + 1);
            mmoActive_select = mmoSetActive(selid, plus);
            break;
        default:
            thecode = String.fromCharCode(thecode);
            var found = false;
            for (var i = 0; i < mmoitems.length; i++) {
                var _a = mmoitems[i].getElementsByTagName('a');
                if (navigator.appName.indexOf("Explorer") > -1) {
                }
                else {
                    txtContent = _a[0].textContent;
                }
                if (!found && (thecode.toLowerCase() == txtContent.charAt(0).toLowerCase())) {
                    mmoActive_select.activeit.className = '';
                    mmoActive_select = mmoSetActive(selid, i);
                    found = true;
                }
            }
            break;
    }
}

function mmoSetActive(selid, itemid) {
    mmoActive_select = null;
    var mmolist = document.getElementById('mmoList' + selid);
    var mmoitems = mmolist.getElementsByTagName('li');
    mmoActive_select = document.getElementById('mmoOptionsDiv' + selid);
    ;mmoActive_select.selid = selid;
    if (itemid != undefined) {
        var _a = mmoitems[itemid].getElementsByTagName('a');
        var textVar = document.getElementById("mmoMySelectText" + selid);
        textVar.innerHTML = _a[0].innerHTML;
        if (selid == 1) textVar.className = _a[0].className;
        mmoitems[itemid].className = 'mmoActive';
    }
    for (var i = 0; i < mmoitems.length; i++) {
        if (mmoitems[i].className == 'mmoActive') {
            mmoActive_select.activeit = mmoitems[i];
            mmoActive_select.activeid = i;
            mmoActive_select.url = (mmoitems[i].getElementsByTagName('a')) ? mmoitems[i].getElementsByTagName('a')[0].href : null;
        }
    }
    return mmoActive_select;
}

function mmoShowOptions(g) {
    var _elem = document.getElementById("mmoOptionsDiv" + g);
    if ((mmoActive_select) && (mmoActive_select != _elem)) {
        mmoActive_select.className = "mmoOptionsDivInvisible";
        document.getElementById('mmonetbar').focus();
    }
    if (_elem.className == "mmoOptionsDivInvisible") {
        document.getElementById('mmoFocus').focus();
        mmoActive_select = mmoSetActive(g);
        if (document.documentElement) {
            document.documentElement.onclick = mmoHideOptions;
        } else {
            window.onclick = mmoHideOptions;
        }
        _elem.className = "mmoOptionsDivVisible";
    } else if (_elem.className == "mmoOptionsDivVisible") {
        _elem.className = "mmoOptionsDivInvisible";
        document.getElementById('mmonetbar').focus();
    }
}

function mmoHideOptions(e) {
    if (mmoActive_select) {
        if (!e) e = window.event;
        var _target = (e.target || e.srcElement);
        if ((_target.id.indexOf('mmoOptionsDiv') != -1)) return false;
        if (mmoisElementBefore(_target, 'mmoSelectArea') == 0 && (mmoisElementBefore(_target, 'mmoOptionsDiv') == 0)) {
            mmoActive_select.className = "mmoOptionsDivInvisible";
            mmoActive_select = null;
        }
    } else {
        if (document.documentElement) document.documentElement.onclick = function () {
        }; else window.onclick = null;
    }
}

function mmoisElementBefore(_el, _class) {
    var _parent = _el;
    do _parent = _parent.parentNode; while (_parent && (_parent.className != null) && (_parent.className.indexOf(_class) == -1))
    return (_parent.className && (_parent.className.indexOf(_class) != -1)) ? 1 : 0;
}

var ua = navigator.userAgent.toLowerCase();
var ie6browser = ((ua.indexOf("msie 6") > -1) && (ua.indexOf("opera") < 0)) ? true : false;

function highlight(el, mod) {
    if (ie6browser) {
        if (mod == 1 && !el.className.match(/highlight/)) el.className = el.className + ' highlight'; else if (mod == 0) el.className = el.className.replace(/highlight/g, '');
    }
}

var mmoToggleDisplay = {
    init: function (wrapper) {
        var wrapper = document.getElementById(wrapper);
        if (!wrapper) return;
        var headline = wrapper.getElementsByTagName("h4")[0], link = headline.getElementsByTagName("a")[0];
        if (link.className.indexOf("gameCountZero") != -1) return false;
        var panel = document.getElementById(link.hash.substr(1));
        mmoToggleDisplay.hidePanel(panel, link);
        link.onclick = function (e) {
            mmoToggleDisplay.loadImages();
            mmoToggleDisplay.toggle(this, panel);
            return false;
        };
        mmoToggleDisplay.outerClick(wrapper, link, panel);
        var timeoutID = null, delay = 8000;
        wrapper.onmouseout = function (e) {
            if (!e) {
                var e = window.event;
            }
            var reltg = (e.relatedTarget) ? e.relatedTarget : e.toElement;
            if (reltg == wrapper || mmoToggleDisplay.isChildOf(reltg, wrapper)) {
                return;
            }
            timeoutID = setTimeout(function () {
                mmoToggleDisplay.hidePanel(panel, link);
            }, delay);
        };
        wrapper.onmouseover = function (e) {
            if (timeoutID) {
                clearTimeout(timeoutID);
            }
        };
    }, isChildOf: function (child, parent) {
        while (child && child != parent) {
            child = child.parentNode;
        }
        if (child == parent) {
            return true;
        } else {
            return false;
        }
    }, hidePanel: function (panel, link) {
        panel.style.display = "none";
        link.className = "toggleHidden";
    }, toggle: function (link, panel) {
        panel.style.display = panel.style.display == "none" ? "block" : "none";
        link.className = link.className == "toggleHidden" ? "" : "toggleHidden";
    }, outerClick: function (wrapper, link, panel) {
        document.body.onclick = function (e) {
            if (!e) {
                e = window.event
            }
            ;
            if (!(mmoToggleDisplay.isChildOf((e.target || e.srcElement), wrapper)) && panel.style.display != "none") {
                mmoToggleDisplay.toggle(link, panel);
            }
        }
    }, loadImages: function () {
        var script = document.createElement("script");
        script.type = "text/javascript";
        var jsonGameData_browser = '{"ogame":"\/\/gf3.geo.gfsrv.net\/cdnb0\/c20f48341425976269d3a264db260a.png","ikariam":"\/\/gf1.geo.gfsrv.net\/cdnfb\/468d7d51b2103198945d3f644169b7.png","battleknight":"\/\/gf3.geo.gfsrv.net\/cdn88\/1078f8c8b702f6c00bd80540a15de4.png","gladiatus":"\/\/gf2.geo.gfsrv.net\/cdn1d\/0da04cb94431ecf8cba6cc17d07ced.png","bitefight":"\/\/gf1.geo.gfsrv.net\/cdn3f\/d53efd82d430eaa71b708336af9624.png","kingsage":"\/\/gf1.geo.gfsrv.net\/cdncd\/48d4d41c64ce8cd6d180828935ef80.png","legend":"\/\/gf1.geo.gfsrv.net\/cdn96\/a18e9b9eb3b66c3a2c17b7bcd55ab4.png","wildguns":"\/\/gf1.geo.gfsrv.net\/cdn9d\/8ca347af6831c0d9d8228b7c9c1dde.png"}',
            jsonGameData_client = '{"aion":"\/\/gf2.geo.gfsrv.net\/cdn4a\/4f37528c695fc83298d672d7554592.jpg","nostale":"\/\/gf1.geo.gfsrv.net\/cdn9a\/0ccbc48b79644be8a8a66305040f94.jpg","skill":"\/\/gf1.geo.gfsrv.net\/cdn0f\/de38feac821f0ca33363c3c2e98d19.jpg","4story":"\/\/gf1.geo.gfsrv.net\/cdn9f\/35e42e0330b32d00feda51fefb72cd.png"}',
            jsonGameData_featured = '{"soulworker":"\/\/gf1.geo.gfsrv.net\/cdn6d\/8c0be44a2280e1fb5f6c7031e9c090.teaser"}';
        script.text = '';
        script.text += ' mmoToggleDisplay.callback(' + jsonGameData_featured + ', "featured");';
        script.text += ' mmoToggleDisplay.callback(' + jsonGameData_client + ', "client");';
        script.text += 'mmoToggleDisplay.callback(' + jsonGameData_browser + ', "browser");';
        document.getElementsByTagName("head")[0].appendChild(script);
        mmoToggleDisplay.loadImages = function () {
        };
    }, callback: function (data, gamesCat) {
        for (var gameName in data) {
            var gameSpan = document.getElementById("gameImgTarget_" + gameName);
            if (!gameSpan) {
                return false;
            }
            var gameImg = document.createElement("img");
            gameImg.src = "" + data[gameName];
            gameImg.alt = "";
            gameSpan.appendChild(gameImg);
        }
    }
}