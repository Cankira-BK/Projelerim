<!DOCTYPE html>
<html>
<head>

    <!-- Meta start -->
    <meta charset="UTF-8">
    <meta name="robots" content="follow, index"/>
    <meta http-equiv="Content-Language" content="pl"/>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?=URL?>">
    <title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - <?= \StaticDatabase\StaticDatabase::settings('slogan')?></title>
    <!-- /meta start -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?=URL.'favicon.ico'?>" sizes="16x16" />
    <!-- /favicon -->

    <!-- Meta -->
    <meta name="keywords" content="metin2, <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>, emek, medium, metin, pvp server metin2"/>
    <meta name="description" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> pvp server Metin2 emek/zor."/>
    <!-- /meta -->

    <!-- OpenGraph tags (espec. Facebook) -->
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?=URL?>"/>
    <meta property="og:title" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - Metin2 PVP Server"/>
    <meta property="og:description" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>-Metin2 PVP Server. Uzun süre boyunca, hoş dengeli ve ilginç oyun sunuyoruz!"/>
    <meta property="og:image" content="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>"/>
    <!-- /openGraph tags -->

    <!-- Core stylesheet -->
    <link rel="stylesheet" href="<?=URI::public_path()?>admin/assets/style/css/icons/icomoon/style.css">
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>layout/assets/css/framework.min.css">
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>layout/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>layout/assets/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>layout/assets/css/animate.css">
    <link href="<?=URI::public_path('')?>layout/assets/css/fancybox.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:400,900">
    <!-- /core stylesheet -->

    <!-- Plugin stylesheet -->
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>layout/assets/plugins/pace/css/pace-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>layout/assets/plugins/niceSelect/css/nice-select.min.css">
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>layout/assets/plugins/froala/css/froala_style.min.css">
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>notify/css/notify.css">
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>notify/css/prettify.css">
    <!-- /plugin stylesheet -->

    <!-- JS -->
    <script src="<?=URI::public_path()?>layout/assets/js/jquery/jquery.min.js"></script>
    <script src="<?=URI::public_path()?>layout/assets/js/jquery/jquery-ui.min.js"></script>
    <script src="<?=URI::public_path()?>layout/assets/js/responsive.min.js"></script>
    <script src="<?=URI::public_path()?>layout/assets/js/framework.min.js"></script>
    <script type="text/javascript" src="<?=URI::public_path('')?>layout/assets/js/fancybox.js"></script>
    <!-- /js -->

    <!-- Plugins JS -->
    <script src="<?=URI::public_path()?>layout/assets/plugins/niceSelect/js/jquery.nice-select.min.js"></script>
    <script src="<?=URI::public_path()?>layout/assets/plugins/pace/js/pace.min.js"></script>
    <!-- /plugins JS -->
	<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?><script type="text/javascript">jQuery('.switcher .selected').click(function(){if (!(jQuery('.switcher .option').is(':visible'))){jQuery('.switcher .option').stop(true, true).delay(100).slideDown(500); jQuery('.switcher .selected a').toggleClass('open')}}); jQuery('.switcher .option').bind('mousewheel', function(e){var options=jQuery('.switcher .option'); if (options.is(':visible')) options.scrollTop(options.scrollTop() - e.originalEvent.wheelDelta); return false;}); jQuery('body').not('.switcher').mousedown(function(e){if (jQuery('.switcher .option').is(':visible') && e.target !=jQuery('.switcher .option').get(0)){jQuery('.switcher .option').stop(true, true).delay(100).slideUp(500); jQuery('.switcher .selected a').toggleClass('open')}}); </script> <li style="display:none" id="google_translate_element2"></li><script type="text/javascript">function googleTranslateElementInit2(){new google.translate.TranslateElement({pageLanguage: 'tr', autoDisplay: false}, 'google_translate_element2');}</script> <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script> <script type="text/javascript">function GTranslateGetCurrentLang(){var keyValue=document.cookie.match('(^|;) ?googtrans=([^;]*)(;|$)'); return keyValue ? keyValue[2].split('/')[2] : null;}function GTranslateFireEvent(element, event){try{if (document.createEventObject){var evt=document.createEventObject(); element.fireEvent('on' + event, evt)}else{var evt=document.createEvent('HTMLEvents'); evt.initEvent(event, true, true); element.dispatchEvent(evt)}}catch (e){}}function doGTranslate(lang_pair){if (lang_pair.value) lang_pair=lang_pair.value; if (lang_pair=='') return; var lang=lang_pair.split('|')[1]; if (GTranslateGetCurrentLang()==null && lang==lang_pair.split('|')[0]) return; var teCombo; var sel=document.getElementsByTagName('select'); for (var i=0; i < sel.length; i++) if (sel[i].className=='goog-te-combo') teCombo=sel[i]; if (document.getElementById('google_translate_element2')==null || document.getElementById('google_translate_element2').innerHTML.length==0 || teCombo.length==0 || teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)}, 500)}else{teCombo.value=lang; GTranslateFireEvent(teCombo, 'change'); GTranslateFireEvent(teCombo, 'change')}}if (GTranslateGetCurrentLang() !=null) jQuery(document).ready(function(){jQuery('div.switcher div.selected a').html(jQuery('div.switcher div.option').find('img[alt="' + GTranslateGetCurrentLang() + '"]').parent().html());}); </script> <style>#goog-gt-tt{display: none !important;}.goog-te-banner-frame{display: none !important;}.goog-te-menu-value:hover{text-decoration: none !important;}body{top: 0 !important;}#google_translate_element2{display: none !important;}</style><?php endif;?>
    <script type="text/javascript">
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
                    $('#fancybox-outer').css({'background': 'transparent url("<?=URI::public_path('')?>static/images/'+fancy_c+'.png") center center no-repeat'});
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
        });
    </script>
</head>
