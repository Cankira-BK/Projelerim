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

if (Cache::check('online_statistics')){
		$getCount['totalOnline'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM player.player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;")[0];
}

if (Cache::check('player_ranking')){
	$result['topplayer'] = \StaticGame\StaticGame::sql("SELECT player.name,player.level FROM player.player WHERE player.player.`name` NOT LIKE '[%]%' ORDER BY player.player.`level` DESC, player.player.playtime DESC, player.player.exp DESC LIMIT 0,5");
	$result['topguild'] =  \StaticGame\StaticGame::sql("SELECT * FROM player.guild ORDER BY ladder_point DESC LIMIT 0,5");
}
?>
<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?>
    <style>.languagepicker{background-color: #FFF; margin: 10px 0 0 0; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.languagepicker li img{margin-top: 7px;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*45?>px;}</style>
    <ul class="languagepicker roundborders large"><?=Translate::translateButton("html")?></ul>
<?php endif;?>
<style>
    .logo-headers .logos
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

    .logo-headers a:hover{
        filter: none!important;
    }

    .logos:hover
    {
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_hover')?>;
    }
</style>
<div class="mobile-btn buttonDrop" data-class="topMen">
    <span></span>
    <span></span>
    <span></span>
  </div>
  <div class="topMenu">
    <div class="topMenu-wrapper">
      <ul>
        <li><a href="<?=URI::get_path('index')?>" class="active"><?=$lng[8]?></a></li>
        <li><a href="<?=URI::get_path('register')?>"><?=$lng[10]?></a></li>
        <li><a href="<?=URI::get_path('download')?>"><?=$lng[0]?></a></li>
        <li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[11]?></a></li>
        <li><a class="itemshop iframe" href="<?=URL.SHOP?>"><?=$lng[12]?></a></li>
        <li><a class="itemshop iframe" href="<?=URL.MUTUAL?>"><?=$lng[146]?></a></li>
        <li><a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>"><?=$lng[14]?></a></li>
        <li><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">Facebook</a></li>
      </ul>
    </div>
  </div>
  <div class="wrapper_web">
    <header class="header_web">
      <div class="logo-headers">
            <a href="<?=URI::get_path('index')?>">
                <img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" alt="" class="logos">
            </a>
        </div>
      <div class="sparks">
        <div class="spark-1"></div>
        <div class="spark-2"></div>
        <div class="spark-3"></div>
      </div>
      <div class="leaves">
        <div class="leaves-1"></div>
        <div class="leaves-2"></div>
        <div class="leaves-3"></div>
      </div>
    </header>
    <div class="container_web">
<aside class="left-sidebar sidebar">
  <div class="sidebarBlock sidebarBlockLogin">
		<?php if (isset($_SESSION['aid'])):?>
		<h2><?=$lng[181]?></h2>
		<hr>
		<a class="btn btn-danger" style="margin-bottom: 10px;width:99%;" href="<?=URI::get_path('profile')?>" class="btn btn-giris"><?=$lng[19]?></a>
        <a class="btn btn-danger itemshop iframe" style="margin-bottom: 10px;width:99%;" href="<?=URL.SHOP?>"><?=$lng[12]?></a>
		<a class="btn btn-danger" style="margin-bottom: 10px;width:99%;" href="<?=URI::get_path('login/logout')?>" class="btn btn-giris"><?=$lng[20]?></a>
		<?php else:?>
		<?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare'):?>
		<form class="form" action="<?=URI::get_path('login/control')?>" method="POST" id="LoginNotifyOGs">
        <h3><?=$lng[21]?></h3>
        <div class="formGroup login">
          <input type="text" placeholder="<?=$lng[22]?>" name="login" maxlength="45" required>
        </div>
        <div class="formGroup pass">
          <input type="password" placeholder="<?=$lng[23]?>" name="password" class="form-control" maxlength="64" required>
        </div>
        <?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
		<div class="formGroup pass">
          <input type="password" placeholder="Pin Kodu" name="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required>
        </div>
		<?php endif;?>
		<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "1"): ?>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<div class="g-recaptcha rc-anchor-blue" data-theme="dark" style="transform:scale(0.81);-webkit-transform:scale(0.81);transform-origin:0 0;-webkit-transform-origin:0 0;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
		<?php endif;?>
		<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "2"): ?>
		<script src='https://hcaptcha.com/1/api.js'></script>
		<div class="h-captcha rc-anchor-blue" data-theme="dark" style="transform:scale(0.81);-webkit-transform:scale(0.81);transform-origin:0 0;-webkit-transform-origin:0 0;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
		<?php endif;?>
        <div class="formGroup-button">
          <button class="cont button-border" type="submit" name="login_submit"><?=$lng[178]?></button>
        </div>
        <div class="formGroup-links flex-c-c">
          <a href="<?=URI::get_path('recuperare')?>"><?=$lng[25]?></a>
        </div>
                  <br>
          <div class="formGroup-links flex-c-c">
            <a href="<?=URI::get_path('recuperare/account')?>"><?=$lng[26]?></a>
          </div>
		</form>
      <?php else:?>
	  <a href="<?=URI::get_path('download')?>" class="download bright">ÜCRETSİZ İNDİR</a>
      <?php endif;?>
      <?php endif;?>
      </div>
	  <?php Cache::open('guild_ranking');?>
	  <?php if (Cache::check('guild_ranking')):?>
      <div class="sidebarBlock">
      <div class="sidebarTitle">
        <h2><?=$lng[66]?></h2> <span><a href="<?=URI::get_path('ranked/guild')?>">+ Tüm liste</a></span>
      </div>
              <div id="topPlayersGroup">
          <ul class="rank-list active top-block">
            <div id="collapseDEFAULT" class="panel-collapse collapse in">
              <div id="top_players_DEFAULT">
				<?php if (count($result['topguild']) != 0):?>
				<?php foreach ($result['topguild'] as $key=>$row):?>
				<li class="top-list">
					<span class="top-number"><?=$key+1?>.</span>
					<span class="top-name"><a href="<?=URI::get_path('detail/guild/'.$row['name'])?>"><?=$row['name']?></a></span>
					<span class="top-lvl"><?=$row['ladder_point']?></span>
				</li>
				<?php endforeach;?>
				<?php else:?>
				<li class="top-list">
					<span class="top-number">#</span>
					<span class="top-name"><a href="javascript:void(0)"><?=$lng[31]?></a></span>
					<span class="top-lvl"></span>
				</li>
				<?php endif;?>
                                  
                              </div>
            </div>
          </ul>
        </div>
      </div>
	  <?php endif;?>
	  <?php Cache::close('guild_ranking')?>
        </aside>