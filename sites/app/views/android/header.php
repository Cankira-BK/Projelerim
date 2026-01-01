<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimal-ui" />
<meta name="theme-color" content="#fff" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="keywords" content="metin2, <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>, emek, orta emek, metin, pvp server metin2"/>
<meta name="description" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> pvp server Metin2 emek/zor."/>

<meta property="og:type" content="article"/>
<meta property="og:url" content="<?=URL?>"/>
<meta property="og:title" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - Metin2 PVP Server"/>
<meta property="og:description" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>-<?=\StaticDatabase\StaticDatabase::settings('slogan')?>. Uzun süre boyunca, hoş dengeli ve ilginç oyun sunuyoruz!"/>
<meta property="og:image" content="<?=\StaticDatabase\StaticDatabase::settings('logo')?>"/>

<base href="<?=URL?>">
<title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - <?= \StaticDatabase\StaticDatabase::settings('slogan')?></title>

<link rel="icon" type="image/png" href="<?=URL?>favicon.ico" sizes="16x16" />
<link href="<?=URI::public_path('styles/framework.css');?>" rel="stylesheet" type="text/css">
<link href="<?=URI::public_path('styles/style.css');?>" rel="stylesheet" type="text/css">
<link href="<?=URI::public_path('styles/fancybox.css')?>" rel="stylesheet">
<link href="<?=URI::public_path('styles/owl.theme.css');?>" rel="stylesheet" type="text/css">
<link href="<?=URI::public_path('styles/swipebox.css');?>" rel="stylesheet" type="text/css">
<link href="<?=URI::public_path('styles/font-awesome.css');?>" rel="stylesheet" type="text/css">
<link href="<?=URI::public_path('styles/animate.css');?>" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?=URI::public_path('scripts/jquery.js');?>"></script>
<script type="text/javascript" src="<?=URI::public_path('scripts/fancybox.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('scripts/jqueryui.js');?>"></script>
<script type="text/javascript" src="<?=URI::public_path('scripts/framework.plugins.js');?>"></script>
<script type="text/javascript" src="<?=URI::public_path('scripts/custom.js');?>"></script>
</head>
<body>

<?php
$sId = Session::get('sId');
$urlLang = isset($_GET['url']) ? $_GET['url'] : null;
$urlLang = rtrim($urlLang,'/');
$urlLang = filter_var($urlLang,FILTER_SANITIZE_URL);
$urlLang = explode('/', $urlLang);
if($sId == null){
	Session::set('sId','site');
}
$aid = isset($_SESSION['aid']) ? $_SESSION['aid'] : null;
if (isset($aid)){
	$avatar = isset($playerInfo[0]['job']) ? $playerInfo[0]['job'] : null;
	$getAin = \StaticGame\StaticGame::sql("SELECT ".CASH.",".MILEAGE." FROM account WHERE id = ?",[$aid])[0];
}

if (Cache::check('server_statistics_android')){
	if (\StaticDatabase\StaticDatabase::settings('total_online_status')){
		$getCount['totalOnline'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM player.player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;")[0];
	}

	if (\StaticDatabase\StaticDatabase::settings('total_player_status')){
		$getCount['totalPlayer'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM player.player")[0];
	}

	if (\StaticDatabase\StaticDatabase::settings('total_account_status')){
		$getCount['totalAccount'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM account.account WHERE status = ?",['OK'])[0];
	}

	if (\StaticDatabase\StaticDatabase::settings('today_login_status')){
		$getCount['todayLogin'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM player.player WHERE last_play LIKE '%".date("Y-m-d")."%' ")[0];
	}

	if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')){
		$offline_shop_npc = \StaticDatabase\StaticDatabase::settings('offline_shop_npc');
		$getOfflineShop = \StaticGame\StaticGame::sql("SELECT COUNT(name) as count FROM player.$offline_shop_npc")[0];
		$getCount['activePazar'] = isset($getOfflineShop) ?  $getOfflineShop : 0;
	}
}
?>