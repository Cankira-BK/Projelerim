function successNotify(text) {
    $.notify(text, {align:"right", color: "#fff", background: "#20D67B"});
}

function errorNotify(text) {
    $.notify(text, {align:"right", color: "#fff", background: "#D44950"});
}

function textonly(e,id)
{
    var code;
    if (!e) var e = window.event;
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);
    var AllowRegex  = /^[\ba-zA-Z0-9\s-]$/;
    if (AllowRegex.test(character)){
        return true;
    }else{
        $(id).notify(
            "Sadece harf ve rakam",
            { position:"right" }
        );
        return false;
    }
}

function textonly2(e,id)
{
    var code;
    if (!e) var e = window.event;
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);
    var AllowRegex  = /^[\ba-z-A-ZÇİĞÖŞÜçığöşü\s-]$/;
    if (AllowRegex.test(character)){
        return true;
    }else{
        $(id).notify(
            "Sadece harf !",
            { position:"right" }
        );
        return false;
    }
}

function numberonly(e,id)
{
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