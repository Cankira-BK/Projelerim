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

    if (Cache::check('server_statistics')){
        if (\StaticDatabase\StaticDatabase::settings('total_online_status')){
		$getCount['totalOnline'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;")[0];
		}

		if (\StaticDatabase\StaticDatabase::settings('total_player_status')){
		$getCount['totalPlayer'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".player")[0];
		}

		if (\StaticDatabase\StaticDatabase::settings('total_account_status')){
		$getCount['totalAccount'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM ".ACCOUNT_DB_NAME.".account WHERE status = ?",['OK'])[0];
		}

		if (\StaticDatabase\StaticDatabase::settings('today_login_status')){
        $getCount['todayLogin'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".player WHERE last_play LIKE '%".date("Y-m-d")."%' ")[0];
		}

		if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')){
			$offline_shop_npc = \StaticDatabase\StaticDatabase::settings('offline_shop_npc');
			$getCount['activePazar'] = isset(\StaticGame\StaticGame::sql("SELECT COUNT(owner_id) as count FROM ".PLAYER_DB_NAME.".$offline_shop_npc")[0]) ?  \StaticGame\StaticGame::sql("SELECT COUNT(owner_id) as count FROM ".PLAYER_DB_NAME.".$offline_shop_npc")[0] : 0;
		}
    }

    if (Cache::check('player_ranking')){
        $result['topplayer'] = \StaticGame\StaticGame::sql("SELECT player.name,player.level FROM ".PLAYER_DB_NAME.".player WHERE ".PLAYER_DB_NAME.".player.`name` NOT LIKE '[%]%' ORDER BY ".PLAYER_DB_NAME.".player.`level` DESC, ".PLAYER_DB_NAME.".player.playtime DESC, ".PLAYER_DB_NAME.".player.exp DESC LIMIT 0,5");
        $result['topguild'] =  \StaticGame\StaticGame::sql("SELECT * FROM ".PLAYER_DB_NAME.".guild ORDER BY ladder_point DESC LIMIT 0,5");
    }
?>
<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?>
    <style>.languagepicker{background-color: #FFF; margin: 60px 0 0 0; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.languagepicker li img{margin-top: 7px;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*45?>px;}</style>
    <ul class="languagepicker roundborders large"><?=Translate::translateButton("html")?></ul>
<?php endif;?>
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
<!-- Header -->
<header id="header">
    <!-- NAVIGATION -->
    <div class="holder">
        <ul class="top-navigation">
            <li>
                <a id="home" href="<?=URI::get_path('index')?>"></a>
            </li>
            <li>
                <a id="forums" href="<?=URI::get_path('download')?>"></a>
            </li>
            <li>
                <a id="changelogs" href="javascript:void(0)"></a>
                <div class="nddm-holder changelogs" style="margin-left: 20px;">
                    <div class="navi-dropdown">
                        <ul>
                            <li><a href="<?=URI::get_path('ranked/player')?>">Oyuncu Sıralaması</a></li>
                            <li><a href="<?=URI::get_path('ranked/guild')?>">Lonca Sıralaması</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            <li>
                <a class="itemshop itemshop-btn iframe" id="features" href="<?=URL.SHOP?>"></a>
            </li>
            <li>
                <a class="itemshop itemshop-btn iframe" id="media" href="<?=URL.MUTUAL?>"></a>
            </li>
            <li>
                <a id="warmory" target="blank" href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>"></a>
            </li>
        </ul>
        <div class="membership-holder">
            <div class="membership-bar">
                <?php if (isset($_SESSION['aid'])):?>
                    <!-- Logged in! -->
                    <div class="logged_in_info">
                        <span><a href="<?=URI::get_path('profile')?>"><?=$lng[9]?></a></span>
                        <span><a href="<?=URI::get_path('login/logout')?>"><?=$lng[20]?></a></span>
                    </div>
                <?php else: ?>
                    <!-- Not logged -->
                    <div class="notlogged_bar">
                        <a href="#" id="home_login" onclick="toggleLogin(event, this)"><?=$lng[21]?></a>
                        <a href="<?=URI::get_path('register')?>" id="home_register"><?=$lng[10]?></a>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>

    <a href="<?=URI::get_path('index')?>" class="logo-header">
            <img src="<?=\StaticDatabase\StaticDatabase::settings('logo')?>" class="logo" alt="">
    </a>
</header>
<!-- /header -->

<div id="popup_bg"></div>
<!-- confirm box -->
<div id="confirm" class="popup">
    <h1 class="popup_question" id="confirm_question">confirm</h1>
    <div class="popup_links">
        <a href="javascript:void(0)" class="popup_button" id="confirm_button"></a>
        <a href="javascript:void(0)" class="popup_hide" id="confirm_hide" onclick="UI.hidePopup()">Cancel
        </a>
        <div style="clear: both;"></div>
    </div>
</div>
<!-- alert box -->
<div id="alert" class="popup">
    <h1 class="popup_message" id="alert_message">message</h1>
    <div class="popup_links">
        <a href="javascript:void(0)" class="popup_button" id="alert_button">Ok</a>
        <div style="clear: both;"></div>
    </div>
</div>
<div class="main_b_holder">
    <!-- Important Notices.End -->
    <div id="content">
        <!-- BODY Content start here -->
