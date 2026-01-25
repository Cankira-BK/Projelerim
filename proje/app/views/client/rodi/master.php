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

if (isset($aid)) {
	$getAin = Statistics::getCashAndMileage($aid);
}

if (Cache::check('server_statistics')){
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

if (Cache::check('online_statistics')){
	if (\StaticDatabase\StaticDatabase::settings('total_online_status')){
		$getCount['totalOnline'] = Statistics::online();
	}
}

if (Cache::check('player_ranking')){
	$result['topplayer'] = Statistics::topPlayer(5);
	$result['topguild'] =  Statistics::topGuild(5);
}
?>
<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?>
    <style>.languagepicker{background-color: #FFF; margin: 120px 0 0 0; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.languagepicker li img{margin-top: 7px;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*45?>px;}</style>
    <ul class="languagepicker roundborders large"><?=Translate::translateButton("html")?></ul>
<?php endif;?>
<div class="top-panel">
    <div class="wrap">
        <div class="login-panel">
			<?php if (isset($_SESSION['aid'])):?>
                <a href="<?=URI::get_path('profile')?>" class="button">HESABIM</a>
                <a href="login/logout" class="button button-bg">HIZLI ÇIKIŞ</a>
			<?php else:?>
                <a href="javascript:void(0)" onclick="loginModal()" class="button button-bg">GİRİŞ</a>
                <a href="javascript:void(0)" onclick="registerModal()" class="button button-bg">HIZLI KAYIT</a>
			<?php endif;?>

        </div>
		<?php Cache::open('online_statistics');?>
		<?php if (Cache::check('online_statistics')):?>
			<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
                <div class="top-panel-status">
                    Aktif Oyuncu: <span class="progress-bar-bg"><span id="progressBar" class="progress-bar" style="width: 0.0066666666666667%;"></span></span> <span class="online-users"><i class="user-icon"></i> <span id="onlineCount"><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></span> </span>
                </div>
			<?php endif;?>
		<?php endif;?>
		<?php Cache::close('online_statistics')?>
        <div class="top-menu">
            <ul>
                <li>
                    <a href="<?=URI::get_path('index')?>">Anasayfa</a>
                </li>
                <li><a href="<?=URI::get_path('register')?>"><?=$lng[10]?></a></li>
                <li><a href="<?=URI::get_path('download')?>"><?=$lng[0]?></a></li>
                <li>
                    <a href="#">Sıralama</a>
                    <ul>
                        <li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[176]?></a></li>
                        <li><a href="<?=URI::get_path('ranked/guild')?>"><?=$lng[177]?></a></li>
                    </ul>
                </li>
                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><?=$lng[13]?></a></li>
                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[12]?></a></li>
                <li><a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>"><?=$lng[184]?></a></li>
                <li><a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>"><?=$lng[14]?></a></li>
            </ul>
        </div>
    </div>
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
        cursor: pointer;
    }

    .logo-header a:hover{
        filter: none!important;
    }

    .logo:hover
    {
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_hover')?>;
    }
</style>

<div class="wrapper" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>" data-public="<?=URI::public_path()?>">
    <header class="header">
        <div class="logo-header">
            <a href="<?=URI::get_path('index')?>">
                <img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" alt="" class="logo">
            </a>
        </div>
        <div class="glare-red glare"></div>
        <div class="glare-blue glare"></div>
        <div class="glare-yellow"></div>
        <div class="light"></div>
    </header>
    <div class="container">
        <aside class="left-sidebar">
            <a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>" class="hero-guides-block">
                <div class="block-info">
                    <span>OYUN TANITIMI</span>
                    Oyunumuz hakkında<br>daha fazla ve detaylı bilgi<br>için tanıtım sayfamıza <br> göz atabilirsiniz.
                </div>
            </a>
            <div class="rankings-block">
                <div class="sidebar-title sidebar-title-light">
                    <a href="<?=URI::get_path('ranked/player')?>">+ Tüm liste</a>
                    Oyuncu Sıralaması <br>
                </div>
                <div class="rankings">
                    <div class="rankings-title">
                        <div class="rank-number">#</div> <div class="rank-name">Karakter adı</div> <div class="rank-lvl">Seviye</div>
                    </div>
					<?php Cache::open('player_ranking');?>
					<?php if (Cache::check('player_ranking')):?>
						<?php if (count($result['topplayer']) != 0):?>
							<?php foreach ($result['topplayer'] as $key=>$row):?>
                                <a title="<?=$row['name']?>" class="rankings-title-block">
                                    <div class="rank-number"><?=$key+1?></div> <div class="rank-name"><?=$row['name']?></div> <div class="rank-lvl"><span class="purple"><?=$row['level']?> Lv.</span></div>
                                </a>
							<?php endforeach;?>
						<?php endif;?>
					<?php endif;?>
					<?php Cache::close('player_ranking')?>
                </div>
            </div>
            <div class="top-guilds-block">
                <div class="sidebar-title sidebar-title-dark">
                    <a href="<?=URI::get_path('ranked/guild')?>">+ Tüm liste</a>
                    Lonca Sıralaması </div>
                <div class="top-guilds">
                    <div class="rankings-title">
                        <div class="guild-img">#</div> <div class="clan-team">Lonca Adı</div> <div class="points">Puan</div>
                    </div>
					<?php Cache::open('guild_ranking');?>
					<?php if (Cache::check('guild_ranking')):?>
						<?php if (count($result['topguild']) != 0):?>
							<?php foreach ($result['topguild'] as $key2=>$row2):?>
                                <div class="guilds">
                                    <div class="rank-number"><?=$key2+1?></div>
                                    <div class="clan-team">
                                        <a href="<?=URI::get_path('detail/guild/'.$row2['name'])?>" class="clan-team-name"><?=$row2['name']?></a>
                                    </div>
                                    <div class="points">
										<?=$row2["ladder_point"];?>
                                    </div>
                                </div>
							<?php endforeach;?>
						<?php endif;?>
					<?php endif;?>
					<?php Cache::close('guild_ranking')?>
                </div>
            </div>
        </aside>