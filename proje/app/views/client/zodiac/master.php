<?php
$sId = Session::get('sId');
$urlLang = isset($_GET['url']) ? $_GET['url'] : null;
$urlLang = rtrim($urlLang,'/');
$urlLang = filter_var($urlLang,FILTER_SANITIZE_URL);
$urlLang = explode('/', $urlLang);

if($sId == null)
	Session::set('sId','site');

$aid = isset($_SESSION['aid']) ? $_SESSION['aid'] : null;
if (isset($aid))
{
	$avatar = isset($playerInfo[0]['job']) ? $playerInfo[0]['job'] : null;
	$getAin = \StaticGame\StaticGame::sql("SELECT ".CASH.",".MILEAGE." FROM account WHERE id = ?",[$aid])[0];
}

if (Cache::check('server_statistics')){
	if (\StaticDatabase\StaticDatabase::settings('total_online_status')){
		$getCount['totalOnline'] = Statistics::online();
	}

	if (\StaticDatabase\StaticDatabase::settings('total_player_status')){
		$getCount['totalPlayer'] = Statistics::player();
	}

	if (\StaticDatabase\StaticDatabase::settings('total_account_status')){
		$getCount['totalAccount'] = Statistics::account();
	}

	if (\StaticDatabase\StaticDatabase::settings('today_login_status')){
		$getCount['todayLogin'] = Statistics::todayLogin();
	}

	if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')){
		$getCount['activePazar'] = Statistics::offlineShop();
	}
}

if (Cache::check('player_ranking')){
	$result['topplayer'] = Statistics::topPlayer(5);
	$result['topguild'] =  Statistics::topGuild(5);
}
?>
<body><!-- Load Facebook SDK for JavaScript --><div id="fb-root"></div><script async defer crossorigin="anonymous" src="https://connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v9.0" nonce="ISXzHwuQ"></script><?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?>    <style>.languagepicker{background-color: #FFF; margin: 80px 0 0 0; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*46?>px;}</style>    <ul class="languagepicker roundborders large"><?=Translate::translateButton("html")?></ul><?php endif;?>
<div class="top-panel">
    <div class="top-panel-container">
        <ul class="menu">
            <li><a href="<?=URI::get_path('index')?>"><?=$lng[8];?></a></li>
            <li><a href="<?=URI::get_path('register')?>"><?=$lng[10];?></a></li>
            <li><a href="<?=URI::get_path('download')?>"><?=$lng[0];?></a></li>
            <li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[11];?></a></li>
            <li><a href="<?=URL.MUTUAL?>" class="itemshop itemshop-btn iframe"><?=$lng[13];?></a></li>
            <li><a href="<?=URL.SHOP?>" class="itemshop itemshop-btn iframe"><?=$lng[12];?></a></li>
            <li><a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>" target="_blank"><?=$lng[184];?></a></li>
        </ul>
        <div style="width: 330px">
			<?php if (isset($_SESSION['aid'])):?>
                <a href="<?=URI::get_path('profile')?>" class="button login" style="float: left;"><?=$lng[19];?></a>
                <a href="<?=URI::get_path('login/logout')?>" class="button login" style="float: left;"><?=$lng[148];?></a>
			<?php else:?>
                <a href="javascript:void(0);" onclick="openModal('loginModal')" class="button login" style="float: left;"><?=$lng[21];?></a>
                <a href="javascript:void(0);" onclick="openModal('registerModal')" class="button login" style="float: left">Hızlı Kayıt</a>
			<?php endif;?>
        </div>
    </div>
</div><!-- top-panel -->
<style>
    .logo-header .logo
    {
        display: block;
        margin-right: auto;
        margin-left: auto;
        width: <?=\StaticDatabase\StaticDatabase::settings('logo_width')?>;
        left: <?=\StaticDatabase\StaticDatabase::settings('logo_position_x')?>;
        right: 0;
        position: absolute;
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_filter')?>;
        margin-top: <?=\StaticDatabase\StaticDatabase::settings('logo_position_y')?>;
    }

    .logo:hover
    {
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_hover')?>;
    }
</style>
<div class="wrapper" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>" data-public="<?=URI::public_path()?>">
    <header class="header">
        <div class="logo-header">
            <a href="<?=URI::get_path('index')?>" class="bright logo"><img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" alt="Logo"></a>
        </div>
        <!-- animation -->
        <div class="ball">
        </div>
        <div class="light">
        </div>
        <div class="sparks sparks-1">
        </div>
        <div class="sparks sparks-2">
        </div>
        <div class="sparks sparks-3">
        </div>
    </header><!-- .header-->

    <div class="container">
        <main class="content">
            <div class="slider">
                <div class="next"> </div>
                <div class="prev"> </div>
                <div class="slides">
                    <div class="slide active" style="background-image: url(<?=URI::public_path('assets/images/slider-img.jpg')?>); ">
                    </div>
                    <div class="slide" style="background-image: url(<?=URI::public_path('assets/images/slider-img.jpg')?>); ">
                    </div>
                    <div class="slide" style="background-image: url(<?=URI::public_path('assets/images/slider-img.jpg')?>); ">
                    </div>
                </div>
                <div class="navigation">
                </div>
            </div><!-- slider -->
