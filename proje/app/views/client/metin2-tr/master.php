<?php
$sId = Session::get('sId');
$urlLang = isset($_GET['url']) ? $_GET['url'] : null;
$urlLang = rtrim($urlLang, '/');
$urlLang = filter_var($urlLang, FILTER_SANITIZE_URL);
$urlLang = explode('/', $urlLang);
if ($sId == null) {
	Session::set('sId', 'site');
}
$aid = isset($_SESSION['aid']) ? $_SESSION['aid'] : null;
if (isset($aid)) {
	$avatar = isset($playerInfo[0]['job']) ? $playerInfo[0]['job'] : null;
	$getAin = \StaticGame\StaticGame::sql("SELECT " . CASH . "," . MILEAGE . " FROM account WHERE id = ?", [$aid])[0];
}

if (Cache::check('server_statistics')) {
	if (\StaticDatabase\StaticDatabase::settings('total_online_status')) {
		$getCount['totalOnline'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM player.player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;")[0];
	}

	if (\StaticDatabase\StaticDatabase::settings('total_player_status')) {
		$getCount['totalPlayer'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM player.player")[0];
	}

	if (\StaticDatabase\StaticDatabase::settings('total_account_status')) {
		$getCount['totalAccount'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM account.account WHERE status = ?", ['OK'])[0];
	}

	if (\StaticDatabase\StaticDatabase::settings('today_login_status')) {
		$getCount['todayLogin'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM player.player WHERE last_play LIKE '%" . date("Y-m-d") . "%' ")[0];
	}

	if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')) {
		$offline_shop_npc = \StaticDatabase\StaticDatabase::settings('offline_shop_npc');
		$getOfflineShop = \StaticGame\StaticGame::sql("SELECT COUNT(name) as count FROM player.$offline_shop_npc")[0];
		$getCount['activePazar'] = isset($getOfflineShop) ?  $getOfflineShop : 0;
	}
}

if (Cache::check('player_ranking')) {
	$result['topplayer'] = \StaticGame\StaticGame::sql("SELECT player.name,player.level FROM player.player WHERE player.player.`name` NOT LIKE '[%]%' ORDER BY player.player.`level` DESC, player.player.playtime DESC, player.player.exp DESC LIMIT 0,5");
	$result['topguild'] = \StaticGame\StaticGame::sql("SELECT * FROM player.guild ORDER BY ladder_point DESC LIMIT 0,5");
}
?>
<body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v9.0" nonce="ISXzHwuQ"></script>

<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?>
    <style>.languagepicker{background-color: #FFF; margin: 40px 0 0 0; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.languagepicker li img{margin-top: 7px;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*44?>px;}</style>
    <ul class="languagepicker roundborders large"><?=Translate::translateButton("html")?></ul>
<?php endif;?>
<div class="netbarslot">

    <!-- #MMO:NETBAR# -->
    <div id="pagefoldtarget"></div>

    <script type="text/javascript">
        var mmoCSS = ' ';
        var mmostyle = document.createElement('style');
        if (navigator.appName == "Microsoft Internet Explorer") {
            mmostyle.setAttribute("type", "text/css");
            mmostyle.styleSheet.cssText = mmoCSS;
        } else {
            var mmostyleTxt = document.createTextNode(mmoCSS);
            mmostyle.type = 'text/css';
            mmostyle.appendChild(mmostyleTxt);
        }
        document.getElementsByTagName('head')[0].appendChild(mmostyle);
    </script>


    <div id="mmonetbar" class="mmometin2">
        <script type="text/javascript">
        </script>
        <div id="mmoContent" class="mmosmallbar">


            <div id="mmoGame" class="mmoGame">
				<?php Cache::open('server_statistics'); ?>
				<?php if (Cache::check('server_statistics')): ?>
					<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0): ?>
						<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
                        <div class="mmoBoxLeft"></div>
                        <div class="mmoBoxMiddle">
                            <div id="mmoOnline">
                                <label><?=$lng[3]?> : <?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></label>
                            </div>
                        </div>
                        <div class="mmoBoxRight"></div>
                        <div class="mmo-breadcrumb"></div>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
                        <div class="mmoBoxLeft"></div>
                        <div class="mmoBoxMiddle">
                            <div id="mmoOnline">
                                <label><?=$lng[4]?> : <?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></label>
                            </div>
                        </div>
                        <div class="mmoBoxRight"></div>
                        <div class="mmo-breadcrumb"></div>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
                        <div class="mmoBoxLeft"></div>
                        <div class="mmoBoxMiddle">
                            <div id="mmoOnline">
                                <label><?=$lng[5]?> : <?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></label>
                            </div>
                        </div>
                        <div class="mmoBoxRight"></div>
                        <div class="mmo-breadcrumb"></div>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
                        <div class="mmoBoxLeft"></div>
                        <div class="mmoBoxMiddle">
                            <div id="mmoOnline">
                                <label><?=$lng[6]?> : <?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></label>
                            </div>
                        </div>
                        <div class="mmoBoxRight"></div>
                        <div class="mmo-breadcrumb"></div>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
                        <div class="mmoBoxLeft"></div>
                        <div class="mmoBoxMiddle">
                            <div id="mmoOnline">
                                <label><?=$lng[7]?> : <?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></label>
                            </div>
                        </div>
                        <div class="mmoBoxRight"></div>
						<?php endif;?>
					<?php endif; ?>
				<?php endif; ?>
				<?php Cache::close('server_statistics');?>
            </div>
            <input id="mmoFocus" type="text" size="5"/>
        </div><!-- /mmoContent -->
    </div><!-- /mmonetbar -->

    <!-- metin2/tr game 03.05.2018 11:42 -->
    <script type="text/javascript">
        mmoInitSelect();
        mmoToggleDisplay.init("mmoGamesOverviewPanel");
    </script>


    <!-- #/MMO:NETBAR# -->
</div>
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
        z-index: 10;
    }

    .logo:hover
    {
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_hover')?>;
    }
</style>
<a href="<?=URI::get_path('index')?>" class="logo-header">
    <img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" alt="" class="logo">
</a>
<header role="banner">
    <!-- header -->
	<?php if (isset($_SESSION['aid'])):?>

        <div class="ui container loggedin">
            <div class="userinfo">
                <div class="welcome-text-left">
					<?=$lng[173]?> <?=$_SESSION['cLogin']?>
                </div>
                <div class="right"><?=$getAin[CASH]?> <?=$lng[172]?></div>
                <div class="header-box-nav-container">
                    <ul class="header-box-nav-login">
                        <li class="stepdown">
                            <a href="<?=URI::get_path('profile')?>" class="nav-box-btn nav-box-btn-2"><?=$lng[9]?></a>
                        </li>
                        <li class="stepdown">
                            <a class="nav-box-btn nav-box-btn-1 itemshop itemshop-btn iframe" href="<?=URL.SHOP?>/buy"><?=$lng[174]?></a>
                        </li>
                        <li class="stepdown">
                            <a href="<?=URI::get_path('login/logout')?>" class="nav-box-btn nav-box-btn-4"><?=$lng[148]?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
	<?php else:?>
        <div class="ui container">
            <a class="playfree" role="button" href="<?=URI::get_path('register')?>"><?=$lng[175]?></a>
        </div>
	<?php endif;?>
</header>

<div class="container">

    <div role="navigation">
        <nav>
            <ul>
                <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>

                <li><a href="<?=URI::get_path('download')?>"><?=$lng[0]?></a>
				<?php if (isset($_SESSION['aid'])):?>
                <li><a href="<?=URI::get_path('profile')?>"><?=$lng[16]?></a></li>
				<?php else:?>
				<li><a href="<?=URI::get_path('register')?>"><?=$lng[10]?></a></li>
				<?php endif;?>

                <li><a href="javascript:void(0)"><?=$lng[11]?></a>
                    <ul>
                        <li><a href="<?=URI::get_path('ranked/player')?>">Oyuncu Sıralaması</a></li>
                        <li><a href="<?=URI::get_path('ranked/guild')?>">Lonca Sıralaması</a></li>
                    </ul>
                </li>
                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[12]?></a></li>

                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><?=$lng[13]?></a></li>

                <li><a href="javascript:void(0)"><?=$lng[176]?></a>
                    <ul>
                        <li><a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>" target="_blank"><?=$lng[14]?></a></li>
                        <li><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">Facebook</a></li>
                    </ul>
                </li>


            </ul>
        </nav>
    </div>


        <!-- content area -->




