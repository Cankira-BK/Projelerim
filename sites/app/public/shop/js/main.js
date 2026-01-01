var zs = zs || {}; // global zshop object
zs.data = zs.data || {};
zs.data.dir = 'ltr';

(function (wd, doc) {
    var w, h;
    w = wd.innerWidth || doc.documentElement.clientWidth;
    h = wd.innerHeight || doc.documentElement.clientHeight;
    var screenSize = {w: w, h: h};
    var compareW = 801
    if (screenSize.w > 0 && screenSize.w < compareW) {
        $(document).ready(function() {
            $('body').addClass('small');
        });
        zs.module.small =  true;
    }
})(window, document);

zs.data.currencies = {"1":{"image":"https://i.hizliresim.com/kXPQ1m.png","loca":"Ejderha Paras\u0131","info":"Ejderha Paras\u0131 ger\u00e7ek parayla sat\u0131n al\u0131n\u0131r. Metin2 web sitesine giri\u015f yap\u0131p \"EP y\u00fckle\" butonunu t\u0131kla. Nesne Market'ten \"Ejderha Paras\u0131 al\" butonuyla da se\u00e7eneklere ula\u015f\u0131rs\u0131n."},"2":{"image":"\/\/gf3.geo.gfsrv.net\/cdn82\/aa9089464e87d3f71036ac9ed97346.png","loca":"Ejderha Markas\u0131","info":"Nesne Market'te yapt\u0131\u011f\u0131n her al\u0131\u015fveri\u015f i\u00e7in hesab\u0131na belli bir miktar Ejderha Markas\u0131 gider. Ne kadar Ejderha Markas\u0131 alaca\u011f\u0131na dair bilgiye d\u00fckkan\u0131n ayr\u0131nt\u0131l\u0131 g\u00f6r\u00fcn\u00fcm\u00fcnden bakabilirsin. Her yeni kaydolan hesaba ekstradan be\u015f Ejderha Markas\u0131 verilir."}};
zs.data.selectedCurrency = '1';

$(document).ready(function() {
    if ($('ul.currency_status li.selected-currency').size() == 0) {
        $('ul.currency_status li').first().click();
    }
});