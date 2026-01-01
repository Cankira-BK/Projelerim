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

	if (Cache::check('online_statistics')){
        if (\StaticDatabase\StaticDatabase::settings('total_online_status')){
		$getCount['totalOnline'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM player.player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;")[0];
		}
    }

    if (Cache::check('server_statistics')){
		if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')){
			$offline_shop_npc = \StaticDatabase\StaticDatabase::settings('offline_shop_npc');
			$getOfflineShop = \StaticGame\StaticGame::sql("SELECT COUNT(name) as count FROM player.$offline_shop_npc")[0];
			$getCount['activePazar'] = isset($getOfflineShop) ?  $getOfflineShop : 0;
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
    }

	if (Cache::check('player_ranking')){
        $result['topplayer'] = \StaticGame\StaticGame::sql("SELECT player.name,player.level FROM player.player WHERE player.player.`name` NOT LIKE '[%]%' ORDER BY player.player.`level` DESC, player.player.playtime DESC, player.player.exp DESC LIMIT 0,5");
    }

    if (Cache::check('guild_ranking')){
        $result['topguild'] =  \StaticGame\StaticGame::sql("SELECT * FROM player.guild ORDER BY ladder_point DESC LIMIT 0,5");
    }
?>
<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?>
    <style>.languagepicker{background-color: #FFF; margin: 100px 0 0 0; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.languagepicker li img{margin-top: 7px;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*45?>px;}</style>
    <ul class="languagepicker roundborders large"><?=Translate::translateButton("html")?></ul>
<?php endif;?>
<div id="exception"></div>
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
        top: <?=\StaticDatabase\StaticDatabase::settings('logo_position_y')?>;
    }

    .logo:hover
    {
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_hover')?>;
    }
</style>
				<!-- top-panel -->
				<div class="wrapper">
                    <header class="header">
                        <a href="<?=URI::get_path('index')?>">
                            <div class="logo-header">
                                <img src="<?=\StaticDatabase\StaticDatabase::settings('logo')?>" alt="Logo" class="logo">
                            </div>
                        </a>
                        <div class="menu-top">
                            <ul class="menu-top-left">
                                <li><a href="<?=URI::get_path('index')?>">Anasayfa</a></li>
                                <li><a href="<?=URI::get_path('download')?>"><?=$lng[0]?></a></li>
								<?php if (isset($_SESSION['aid'])):?>
                                    <li><a href="<?=URI::get_path('profile')?>"><?=$lng[19]?></a></li>
								<?php else:?>
                                    <li><a href="<?=URI::get_path('register')?>"><?=$lng[10]?></a></li>
								<?php endif;?>
                                <li><a>Sıralamalar</a>
                                    <ul>
                                        <li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[176]?></a></li>
                                        <li><a href="<?=URI::get_path('ranked/guild')?>"><?=$lng[177]?></a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="menu-top-right">
                                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><?=$lng[13]?></a></li>
                                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[12]?></a></li>
                                <li><a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>"><?=$lng[14]?></a></li>
                                <li><a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>"><?=$lng[184]?></a></li>
                            </ul>
							<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0):?>
							<?php Cache::open('online_statistics');?>
							<?php if (Cache::check('online_statistics')):?>
                            <div class="server-load">
                                <div>Online</div>
								<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
                                    <span><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></span>
								<?php endif;?>
                            </div>
							<?php endif;?>
								<?php Cache::close('online_statistics');?>
							<?php endif;?>
                        </div>
                    </header>
					<!-- .header-->
					<div class="container">
						<aside class="left-sidebar">
                            <a href="<?=URI::get_path('download')?>">
							    <div class="download-block"></div>
                            </a>
							<?php if (isset($_SESSION['aid'])):?>
							<div class="login-block p-block">
								<center style="line-height: 1.5;">
								<?=$lng[22]?> <b><?=Session::get('cLogin')?></b><br>
								<?=$lng[17]?> <b><?=$getAin[CASH]?> EP</b><br>
								<?=$lng[17]?> <b><?=$getAin[MILEAGE]?> EM</b>

								<div class="kayip-buttonlar2">
									<a href="<?=URI::get_path('profile')?>" class="btn btn-giris"><?=$lng[19]?></a><br>
									<a href="<?=URI::get_path('login/logout')?>" class="btn btn-giris"><?=$lng[20]?></a>
								</div>
							</center>
							</div>
							<?php else:?>
							<div class="login-block p-block">
								<form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="post" accept-charset="utf-8" onkeypress="return event.keyCode != 13;">
									<div class="login-block-title flex-center">
										<span><?=$lng[21]?></span> <a href="<?=URI::get_path('register')?>"> <?=$lng[185]?></a>
									</div>
									<p class="login-in" style="margin-bottom: 15px;"><input type="text" placeholder="<?=$lng[22]?>" value="" name="login" id="login_input" maxlength="16" autocomplete="off"/></p>
									<p class="password-in" style="margin-bottom: 15px;"><input type="password" placeholder="<?=$lng[23]?>" value="" name="password" id="password_input" maxlength="20" autocomplete="off"/></p>
									<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                        <p class="password-in" style="margin-bottom: 15px;"><input type="password" placeholder="PIN" value="" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" autocomplete="off"/></p>
									<?php endif;?>
                                    <div class="g-recaptcha rc-anchor-blue" data-theme="dark" style="transform:scale(0.81);-webkit-transform:scale(0.81);transform-origin:0 0;-webkit-transform-origin:0 0;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
									<div class="login-button">
										<button class="green-button" type="submit" name="login_submit"><?=$lng[21]?></button>
									</div>
                                    <a href="<?=URI::get_path('recuperare')?>" data-hasevent="1" style="float: right;position: relative;top: 4px;"><?=$lng[25]?></a>
                                    <a href="<?=URI::get_path('recuperare/account')?>" data-hasevent="1" style="float: right;position: relative;top: -22px;"><?=$lng[26]?></a>
								</form>
							</div>
							<?php endif;?>

							<div class="top-players-block light p-block">
								<div class="sidebar-title sidebar-top-title flex-center">
									<div class="title-t">
                                        <a href="<?=URI::get_path('ranked/player')?>"><span><?=$lng[176]?></span></a>
									</div>
                                    <div class="top-title-img"><span>TOP<b style="display: block;font-size: 30px;text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.4);">5</b></span></div>
                                </div>
								<!-- sidebar-title -->
								<div class="box-style2">
									<div class="entry">
										<div id="top_players">
											<table class="sidebar_rank" border="0">
												<tbody>
													<tr>
														<th>#</th>
														<th><?=$lng[35]?></th>
														<th><?=$lng[68]?></th>
													</tr>
													<?php Cache::open('player_ranking');?>
													<?php if (Cache::check('player_ranking')):?>
													<?php if (count($result['topplayer']) != 0):?>
													<?php foreach ($result['topplayer'] as $key=>$row):?>
													<tr>
													<td style="text-align:center;"><?=$key+1?></td>
													<td><a href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></td>
													<td><?=$row['level']?></td>
													</tr>
													<?php endforeach;?>
													<?php endif;?>
													<?php endif;?>
													<?php Cache::close('player_ranking')?>
												</tbody>
											</table>
										</div>
										<br/>
										<span style="float:right;margin-right:28px"></span>
									</div>
								</div>
							</div>
							<!-- top-players-block -->
							<div class="top-players-block light p-block">
								<div class="sidebar-title sidebar-top-title flex-center">
									<div class="title-t">
                                        <a href="<?=URI::get_path('ranked/guild')?>"><span><?=$lng[177]?></span></a>
									</div>
									<div class="top-title-img flag-icon-2"><span>TOP<b style="display: block;font-size: 30px;text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.4);">5</b></span></div>
								</div>
								<div class="box-style2">
									<div class="entry">
										<div id="top_guilds">
											<table class="sidebar_rank" border="0">
												<tbody>
													<tr>
														<th>#</th>
														<th><?=$lng[46]?></th>
														<th><?=$lng[71]?></th>
													</tr>
													<?php Cache::open('guild_ranking');?>
													<?php if (Cache::check('guild_ranking')):?>
													<?php if (count($result['topguild']) != 0):?>
													<?php foreach ($result['topguild'] as $key2=>$row2):?>
													<tr>
														<td><?=$key2+1?>.</td>
														<td><a href="<?=URI::get_path('detail/guild/'.$row2['name'])?>"><?=$row2['name']?></a></td>
														<td><?=$row2["ladder_point"];?></td>
													</tr>
													<?php endforeach;?>
													<?php endif;?>
													<?php endif;?>
													<?php Cache::close('guild_ranking')?>
												</tbody>
											</table>
										</div>
										<br/>
										<span style="float:right;margin-right:28px"></span>
									</div>
								</div>
							</div>
							<!-- media-block -->
						</aside>
						<!-- left-sidebar -->
						<main class="content">
							<div class="slider">
								<div class="next"> </div>
								<div class="prev"> </div>
								<div class="slides">
                                    <div class="slide active">
                                        <img src="<?=URI::public_path('asset/images/slider2-img.jpg')?>" alt="">
                                    </div>
									<div class="slide">
                                        <img src="<?=URI::public_path('asset/images/slider-img.jpg')?>" alt="">
									</div>
                                    <div class="slide">
                                        <img src="<?=URI::public_path('asset/images/slider1-img.jpg')?>" alt="">
                                    </div>
								</div>
								<div class="navigation">
								</div>
							</div>
							<style>
.YoutubeBlock {
    padding-left: 10px;
    padding-right: 10px;
    background: rgba(65, 78, 90, 0.16862745098039217);
    padding-top: 10px;
	padding-bottom: 14px;
}

.VideoBlok {
    width: calc(32% - 3px);
    display: inline-block;
    background-size: 130% !important;
    height: 135px;
    position: relative;
    margin-left: 5px;
    margin-right: 5px;
    border: 1px solid #394b5f;
    transition: 0.4s linear;
}

.VideoBlok:hover {
    background-size: 150% !important;
}

.VideoBlok baslik {
    position: absolute;
    width: 100%;
    bottom: 0px;
    text-align: center;
    background: #1e2e40;
    line-height: 30px;
    height: 30px;
    left: 0px;
    overflow: hidden;
    font-size: 10px;
}

.VideoBlok kanal {
    position: absolute;
    bottom: 30px;
    text-align: center;
    background: #273748;
    line-height: 19px;
    height: 19px;
    left: 0px;
    overflow: hidden;
    font-size: 10px;
    padding-left: 10px;
    padding-right: 10px;
    z-index: 123;
}

.VideoBlok a {
    display: block !important;
    width: 100%;
    height: 100%;
}

h1.YoutubeTitle {
    margin: 0px;
    line-height: 35px;
    padding-left: 20px;
    background: #090f1785;
    border-bottom: 1px solid #283440;
    font-size: 14px;
    color: #a7930e;
    text-transform: uppercase;
}

.YoutubeBlock p {
    padding: 3px;
    text-align: center;
    font-size: 11px;
    width: 100%;
    background: linear-gradient(to top left,#122740,#1e3f62,#415f96);
    margin-left: -10px;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
    color: #bbd3f7;
    margin-bottom: 12px;
    margin-top: -11px;
}
</style>