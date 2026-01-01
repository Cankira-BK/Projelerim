var controlKey = "";
var rouletteType = null;
var duration = randomIntFromInterval(3,6);
var rouletteValue0 = "";
var rouletteValue1 = "";
var rouletteValue2 = "";

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

$(".wheel-help").click(function() {
    fancyBox("#fancybox-help")
});

var option0 = {
    speed : Math.floor(Math.random() * (20 - 10 + 1) + 10),
    duration : duration,
    stopImageNumber : -1,
    stopCallback : function($stopElm) {
        setTimeout(function () {
            const element0 = document.querySelector('.roulette0 .roulette-inner');
            const translate0 = element0.style.transform;

            const element1 = document.querySelector('.roulette1 .roulette-inner');
            const translate1 = element1.style.transform;

            const element2 = document.querySelector('.roulette2 .roulette-inner');
            const translate2 = element2.style.transform;

            var dataSet = document.getElementById('slotCash').dataset;
            var url = dataSet.slot_gift_control;
            var data = {
                hash:controlKey,
                roulette:rouletteType,
                roulette0:splitRoulette(translate0),
                roulette1:splitRoulette(translate1),
                roulette2:splitRoulette(translate2)
            };

            $.ajax({
                url : url,
                type : 'POST',
                data : data,
                dataType : 'json',
                success : function (response) {
                    rouletteValue0 = splitRoulette(translate0);
                    rouletteValue1 = splitRoulette(translate1);
                    rouletteValue2 = splitRoulette(translate2);

                    if (response.cash >= 100)
                    {
                        $('#startRouletteBtn0').attr("disabled",false);
                        $('#startRouletteBtn1').attr("disabled",false);
                        $('#startRouletteBtn2').attr("disabled",false);
                        $('#startRouletteBtn3').attr("disabled",false);
                        $('#startRouletteBtn4').attr("disabled",false);
                    }

                    if (response.cash >= 50 && response.cash < 100)
                    {
                        $('#startRouletteBtn0').attr("disabled",false);
                        $('#startRouletteBtn1').attr("disabled",false);
                        $('#startRouletteBtn2').attr("disabled",false);
                        $('#startRouletteBtn3').attr("disabled",false);
                    }

                    if (response.cash >= 25 && response.cash < 50)
                    {
                        $('#startRouletteBtn0').attr("disabled",false);
                        $('#startRouletteBtn1').attr("disabled",false);
                        $('#startRouletteBtn2').attr("disabled",false);
                    }

                    if (response.cash >= 10 && response.cash < 25)
                    {
                        $('#startRouletteBtn0').attr("disabled",false);
                        $('#startRouletteBtn1').attr("disabled",false);
                    }

                    if (response.cash >= 5 && response.cash < 10)
                    {
                        $('#startRouletteBtn0').attr("disabled",false);
                    }

                    if (response.cash < 5)
                    {
                        $('#startRouletteBtn0').css("display","none");
                        $('#startRouletteBtn1').css("display","none");
                        $('#startRouletteBtn2').css("display","none");
                        $('#startRouletteBtn3').css("display","none");
                        $('#startRouletteBtn4').css("display","none");
                        $('#slotPrice').fadeIn();
                    }

                    if (response.result)
                    {
                        controlKey = response.hash;
                        $("#giftCash").text(response.gift);
                        fancyBox("#fancyBoxGift");
                    }
                    else
                    {
                        $("#slotRunText").text("Üzgünüm kaybettiniz...");
                    }
                }
            });
        },1700);
    }
};

var option1 = {
    speed : Math.floor(Math.random() * (20 - 10 + 1) + 10),
    duration : duration,
    stopImageNumber : -1
};

var option2 = {
    speed : Math.floor(Math.random() * (20 - 10 + 1) + 10),
    duration : duration,
    stopImageNumber : -1
};

var roulette0 = $('div.roulette0').roulette(option0);
var roulette1 = $('div.roulette1').roulette(option1);
var roulette2 = $('div.roulette2').roulette(option2);

function Roulette0() {
    fancyBox("#fancyBoxRoulette0");
}

function Roulette1() {
    fancyBox("#fancyBoxRoulette1");
}

function Roulette2() {
    fancyBox("#fancyBoxRoulette2");
}

function Roulette3() {
    fancyBox("#fancyBoxRoulette3");
}

function Roulette4() {
    fancyBox("#fancyBoxRoulette4");
}

function getGift(giftURL) {
    var url = giftURL;
    var data = {
        hash:controlKey,
        roulette:rouletteType,
        cash:$("#giftCash").text(),
        roulette0:rouletteValue0,
        roulette1:rouletteValue1,
        roulette2:rouletteValue2
    };

    $.ajax({
        url : url,
        type : 'POST',
        data : data,
        dataType : 'json',
        success : function (response) {
            $.fancybox.close();
            $("#slotRunText").text("Slot Cash Oyna");
            if (response.result)
            {
                $("#balances1").text(response.cash);

                if (response.cash >= 100)
                {
                    $('#startRouletteBtn0').attr("disabled",false);
                    $('#startRouletteBtn1').attr("disabled",false);
                    $('#startRouletteBtn2').attr("disabled",false);
                    $('#startRouletteBtn3').attr("disabled",false);
                    $('#startRouletteBtn4').attr("disabled",false);
                }

                if (response.cash >= 50 && response.cash < 100)
                {
                    $('#startRouletteBtn0').attr("disabled",false);
                    $('#startRouletteBtn1').attr("disabled",false);
                    $('#startRouletteBtn2').attr("disabled",false);
                    $('#startRouletteBtn3').attr("disabled",false);
                }

                if (response.cash >= 25 && response.cash < 50)
                {
                    $('#startRouletteBtn0').attr("disabled",false);
                    $('#startRouletteBtn1').attr("disabled",false);
                    $('#startRouletteBtn2').attr("disabled",false);
                }

                if (response.cash >= 10 && response.cash < 25)
                {
                    $('#startRouletteBtn0').attr("disabled",false);
                    $('#startRouletteBtn1').attr("disabled",false);
                }

                if (response.cash >= 5 && response.cash < 10)
                {
                    $('#startRouletteBtn0').attr("disabled",false);
                }

                if (response.cash < 5)
                {
                    $('#startRouletteBtn0').css("display","none");
                    $('#startRouletteBtn1').css("display","none");
                    $('#startRouletteBtn2').css("display","none");
                    $('#startRouletteBtn3').css("display","none");
                    $('#startRouletteBtn4').css("display","none");
                    $('#slotPrice').fadeIn();
                }

            }
        }
    });
}

function startRoulette0() {
    $.fancybox.close();

    var dataSet = document.getElementById('slotCash').dataset;
    var url = dataSet.control;
    var data = {type:"0"};
    $.ajax({
        url : url,
        type : 'POST',
        data : data,
        dataType : 'json',
        success : function (response) {
            if (response.result)
            {
                controlKey = response.hash;
                rouletteType = 0;
                $("#balances1").text(response.cash);
                startRoulette();
            }
        }
    });
}

function startRoulette() {
    $("#slotRunText").text("Slot Cash dönüyor...");
    $('#startRouletteBtn0').attr("disabled",true);
    $('#startRouletteBtn1').attr("disabled",true);
    $('#startRouletteBtn2').attr("disabled",true);
    $('#startRouletteBtn3').attr("disabled",true);
    $('#startRouletteBtn4').attr("disabled",true);

    roulette0.roulette('start');
    roulette1.roulette('start');
    roulette2.roulette('start');
}

function startRoulette1() {
    $.fancybox.close();

    var dataSet = document.getElementById('slotCash').dataset;
    var url = dataSet.control;
    var data = {type:"1"};
    $.ajax({
        url : url,
        type : 'POST',
        data : data,
        dataType : 'json',
        success : function (response) {
            if (response.result)
            {
                controlKey = response.hash;
                rouletteType = 1;
                $("#balances1").text(response.cash);
                startRoulette();
            }
        }
    });
}

function startRoulette2() {
    $.fancybox.close();

    var dataSet = document.getElementById('slotCash').dataset;
    var url = dataSet.control;
    var data = {type:"2"};
    $.ajax({
        url : url,
        type : 'POST',
        data : data,
        dataType : 'json',
        success : function (response) {
            if (response.result)
            {
                controlKey = response.hash;
                rouletteType = 2;
                $("#balances1").text(response.cash);
                startRoulette();
            }
        }
    });
}

function startRoulette3() {
    $.fancybox.close();

    var dataSet = document.getElementById('slotCash').dataset;
    var url = dataSet.control;
    var data = {type:"3"};
    $.ajax({
        url : url,
        type : 'POST',
        data : data,
        dataType : 'json',
        success : function (response) {
            if (response.result)
            {
                controlKey = response.hash;
                rouletteType = 3;
                $("#balances1").text(response.cash);
                startRoulette();
            }
        }
    });
}

function startRoulette4() {
    $.fancybox.close();

    var dataSet = document.getElementById('slotCash').dataset;
    var url = dataSet.control;
    var data = {type:"4"};
    $.ajax({
        url : url,
        type : 'POST',
        data : data,
        dataType : 'json',
        success : function (response) {
            if (response.result)
            {
                controlKey = response.hash;
                rouletteType = 4;
                $("#balances1").text(response.cash);
                startRoulette();
            }
        }
    });
}
function mySplit(str, ch) {
    var pos, start = 0, result = [];
    while ((pos = str.indexOf(ch, start)) != -1) {
        result.push(str.substring(start, pos));
        start = pos + 1;
    }
    result.push(str.substr(start));
    return(result);
}

function splitRoulette(result) {
    var re = mySplit(result, ", ")[1];
    re = mySplit(re, "px)")[0];
    return parseInt(re);
}

function randomIntFromInterval(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
}