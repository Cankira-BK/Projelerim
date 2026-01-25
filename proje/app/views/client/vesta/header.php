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

	<link href="<?=URI::public_path('assets/css/bootstrap.min.css');?>" rel="stylesheet">
	<link href="<?=URI::public_path('assets/css/animate.css')?>" rel="stylesheet">
	<link href="<?=URI::public_path('assets/css/style.css')?>" rel="stylesheet">
    <link href="<?=URI::public_path('')?>assets/css/fancybox.css" rel="stylesheet" type="text/css" media="screen"/>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	
	<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?><script type="text/javascript">jQuery('.switcher .selected').click(function(){if (!(jQuery('.switcher .option').is(':visible'))){jQuery('.switcher .option').stop(true, true).delay(100).slideDown(500); jQuery('.switcher .selected a').toggleClass('open')}}); jQuery('.switcher .option').bind('mousewheel', function(e){var options=jQuery('.switcher .option'); if (options.is(':visible')) options.scrollTop(options.scrollTop() - e.originalEvent.wheelDelta); return false;}); jQuery('body').not('.switcher').mousedown(function(e){if (jQuery('.switcher .option').is(':visible') && e.target !=jQuery('.switcher .option').get(0)){jQuery('.switcher .option').stop(true, true).delay(100).slideUp(500); jQuery('.switcher .selected a').toggleClass('open')}}); </script> <li style="display:none" id="google_translate_element2"></li><script type="text/javascript">function googleTranslateElementInit2(){new google.translate.TranslateElement({pageLanguage: 'tr', autoDisplay: false}, 'google_translate_element2');}</script> <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script> <script type="text/javascript">function GTranslateGetCurrentLang(){var keyValue=document.cookie.match('(^|;) ?googtrans=([^;]*)(;|$)'); return keyValue ? keyValue[2].split('/')[2] : null;}function GTranslateFireEvent(element, event){try{if (document.createEventObject){var evt=document.createEventObject(); element.fireEvent('on' + event, evt)}else{var evt=document.createEvent('HTMLEvents'); evt.initEvent(event, true, true); element.dispatchEvent(evt)}}catch (e){}}function doGTranslate(lang_pair){if (lang_pair.value) lang_pair=lang_pair.value; if (lang_pair=='') return; var lang=lang_pair.split('|')[1]; if (GTranslateGetCurrentLang()==null && lang==lang_pair.split('|')[0]) return; var teCombo; var sel=document.getElementsByTagName('select'); for (var i=0; i < sel.length; i++) if (sel[i].className=='goog-te-combo') teCombo=sel[i]; if (document.getElementById('google_translate_element2')==null || document.getElementById('google_translate_element2').innerHTML.length==0 || teCombo.length==0 || teCombo.innerHTML.length==0){setTimeout(function(){doGTranslate(lang_pair)}, 500)}else{teCombo.value=lang; GTranslateFireEvent(teCombo, 'change'); GTranslateFireEvent(teCombo, 'change')}}if (GTranslateGetCurrentLang() !=null) jQuery(document).ready(function(){jQuery('div.switcher div.selected a').html(jQuery('div.switcher div.option').find('img[alt="' + GTranslateGetCurrentLang() + '"]').parent().html());}); </script> <style>#goog-gt-tt{display: none !important;}.goog-te-banner-frame{display: none !important;}.goog-te-menu-value:hover{text-decoration: none !important;}body{top: 0 !important;}#google_translate_element2{display: none !important;}</style><?php endif;?>
	
</head>
<body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v9.0" nonce="ISXzHwuQ"></script>
