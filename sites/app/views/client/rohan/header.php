<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="<?=URL?>">
  <title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - <?= \StaticDatabase\StaticDatabase::settings('slogan')?> </title>
  <meta name="generator" content="VipHosting" />
  <meta name="keywords" content="metin2, <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>, emek, medium, metin, pvp server metin2"/>
  <meta name="description" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> pvp server Metin2 emek/zor."/>
  <meta name="robots" content="index,follow" />
  <meta name="copyright" content="Copyright © 2020 <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Global" />
  <meta name="language" content="Turkish" />
  <meta property="og:locale" content="tr_TR" />
  <meta property="og:type" content="article"/>
  <meta property="og:url" content="<?=URL?>"/>
  <meta property="og:title" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - Metin2 PVP Server"/>
  <meta property="og:description" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>-Metin2 PVP Server. Uzun süre boyunca, hoş dengeli ve ilginç oyun sunuyoruz!"/>
  <meta property="og:image" content="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="<?=URI::public_path('')?>/assets/Theme/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?=URI::public_path('')?>/assets/Theme/css/swiper.min.css" rel="stylesheet" type="text/css">
  <link href="<?=URI::public_path('')?>/assets/Theme/css/style.css" rel="stylesheet" type="text/css">
  <link href="<?=URI::public_path('')?>/assets/Theme/css/custom.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css">
  <link href="<?=URI::public_path('')?>/assets/Theme/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="<?=URI::public_path('')?>/assets/Theme/default/css/jquery.growl.css" rel="stylesheet" type="text/css">
  <link href="<?=URI::public_path('')?>/assets/Theme/css/mobile-style.css" rel="stylesheet" type="text/css">
  <link href="<?=URI::public_path('')?>/assets/css/fancybox.css" rel="stylesheet">
  <link href="<?=URI::public_path('')?>/assets/css/ek.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?=URI::public_path()?>main/css/extra.css"/>
  <link rel="shortcut icon" sizes="16x16 32x32" href="<?=URL.'favicon.ico'?>">

  <?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?><script type="text/javascript">jQuery('.switcher .selected').click(function(){if (!(jQuery('.switcher .option').is(':visible'))){jQuery('.switcher .option').stop(true, true).delay(100).slideDown(500); jQuery('.switcher .selected a').toggleClass('open')}}); jQuery('.switcher .option').bind('mousewheel', function(e){var options=jQuery('.switcher .option'); if (options.is(':visible')) options.scrollTop(options.scrollTop() - e.originalEvent.wheelDelta); return false;}); jQuery('body').not('.switcher').mousedown(function(e){if (jQuery('.switcher .option').is(':visible') && e.target !=jQuery('.switcher .option').get(0)){jQuery('.switcher .option').stop(true, true).delay(100).slideUp(500); jQuery('.switcher .selected a').toggleClass('open')}}); </script> <li style="display:none" id="google_translate_element2"></li><script type="text/javascript">function googleTranslateElementInit2(){new google.translate.TranslateElement({pageLanguage: 'tr', autoDisplay: false}, 'google_translate_element2');}</script> <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script> <script type="text/javascript">function GTranslateGetCurrentLang(){var keyValue=document.cookie.match('(^|;) ?googtrans=([^;]*)(;|$)'); return keyValue ? keyValue[2].split('/')[2] : null;}function GTranslateFireEvent(element, event){try{if (document.createEventObject){var evt=document.createEventObject(); element.fireEvent('on' + event, evt)}else{var evt=document.createEvent('HTMLEvents'); evt.initEvent(event, true, true); element.dispatchEvent(evt)}}catch (e){}}function doGTranslate(lang_pair){if (lang_pair.value) lang_pair=lang_pair.value; if (lang_pair=='') return; var lang=lang_pair.split('|')[1]; if (GTranslateGetCurrentLang()==null && lang==lang_pair.split('|')[0]) return; var teCombo; var sel=document.getElementsByTagName('select'); for (var i=0; i < sel.length; i++) if (sel[i].className=='goog-te-combo') teCombo=sel[i]; if (document.getElementById('google_translate_element2')==null || document.getElementById('google_translate_element2').innerHTML.length==0 || teCombo.length==0 || teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)}, 500)}else{teCombo.value=lang; GTranslateFireEvent(teCombo, 'change'); GTranslateFireEvent(teCombo, 'change')}}if (GTranslateGetCurrentLang() !=null) jQuery(document).ready(function(){jQuery('div.switcher div.selected a').html(jQuery('div.switcher div.option').find('img[alt="' + GTranslateGetCurrentLang() + '"]').parent().html());}); </script> <style>#goog-gt-tt{display: none !important;}.goog-te-banner-frame{display: none !important;}.goog-te-menu-value:hover{text-decoration: none !important;}body{top: 0 !important;}#google_translate_element2{display: none !important;}</style><?php endif;?>

</head>
<body data-url="<?=URL?>">
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v9.0" nonce="ISXzHwuQ"></script>

<?php if (\StaticDatabase\StaticDatabase::settings('facebook_like_status')):?>
<div class="fbBoard fbBoard2" id="facebookLike">
        <center>
            <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">
                <div class="facebook-like">
                    <img src="<?=URI::public_path('main/images/face.png')?>" alt="">
                    <a href="javascript:void(0)" onclick="document.getElementById('facebookLike').style.display='none';" style="display:block;width:23px;height:23px;margin:0px;padding:0px;border:none;background-color:transparent;position:absolute;top:23px;right:70px;-webkit-border-radius: 12px;border-radius: 12px;"></a>
                    <iframe src="https://www.facebook.com/plugins/like.php?href=<?=\StaticDatabase\StaticDatabase::settings('facebook')?>&amp;send=false&amp;layout=button_count&amp;width=120&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=segoe+ui&amp;height=30&amp;appId=515295435153698" scrolling="no" frameborder="0" style="position:absolute;bottom:82px;right:104px;border:none; overflow:hidden; width:98px; height:21px;" allowtransparency="true"></iframe>
                </div>
            </a>
        </center>
</div>
<?php endif;?>