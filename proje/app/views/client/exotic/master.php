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
    $securityKey = \StaticDatabase\StaticDatabase::settings('gamekey');
    if (isset($aid)){
        $playerInfo = \StaticGame\StaticGame::sql("SELECT id,job FROM player.player WHERE account_id = ?",[$aid]);
        $pid = isset($playerInfo[0]['id']) ? $playerInfo[0]['id'] : null;
        $avatar = isset($playerInfo[0]['job']) ? $playerInfo[0]['job'] : null;
        $sas = md5($pid.$aid.$securityKey);
        $getAin = \StaticGame\StaticGame::sql("SELECT ".CASH.",".MILEAGE." FROM account WHERE id = ?",[$aid])[0];
    }

    if (Cache::check('server_statistics')){
        if (\StaticDatabase\StaticDatabase::settings('total_online_status'))
		$getCount['totalOnline'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM player.player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;")[0];

		if (\StaticDatabase\StaticDatabase::settings('total_account_status'))
		$getCount['totalAccount'] = \StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM account.account WHERE status = ?",['OK'])[0];

		if (\StaticDatabase\StaticDatabase::settings('active_pazar_status'))
		{
			$offline_shop_npc = \StaticDatabase\StaticDatabase::settings('offline_shop_npc');
			$getOfflineShop = \StaticGame\StaticGame::sql("SELECT COUNT(name) as count FROM player.$offline_shop_npc")[0];
			$getCount['activePazar'] = isset($getOfflineShop) ?  $getOfflineShop : 0;
		}
    }
    if (Cache::check('player_ranking')){
	    $result['topplayer'] = \StaticGame\StaticGame::sql("SELECT player.name,player.level FROM player.player WHERE player.player.`name` NOT LIKE '[%]%' ORDER BY player.player.`level` DESC, player.player.playtime DESC, player.player.exp DESC LIMIT 0,5");
	    $result['topguild'] =  \StaticGame\StaticGame::sql("SELECT * FROM player.guild ORDER BY ladder_point DESC LIMIT 0,5");
    }
?>
<body>
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v9.0" nonce="ISXzHwuQ"></script>

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
        margin-bottom: 100px;
    }

    .logo:hover
    {
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_hover')?>;
    }
</style>
<div id="wcenter">
	<div class="wheader">
		<div class="headBack headBack-headBack">
			<div class='headBack headBack-progressValue' style='width:80%'></div>
			<a class='headBack headBack-dButton' href="<?=URI::get_path('download')?>"></a>
			<?php Cache::open('server_statistics');?>
			<?php if (Cache::check('server_statistics')):?>
				<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0):?>
					<div class='onlinecount'>
					<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
						ONLINE : <span class='rakam'><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></span>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
						| <?=$lng[172]?> : <span class='rakam'><?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></span>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
						| <?=$lng[173]?> : <span class='rakam'><?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></span>
					<?php endif;?>
			</div>
				<?php endif;?>
			<?php endif;?>
			<?php Cache::close('server_statistics');?>
		</div>
	</div>
    <a href="<?=URI::get_path('index')?>" class="logo-header">
        <img src="<?= \StaticDatabase\StaticDatabase::settings('logo'); ?>" alt="" class="logo">
    </a>
	<div class="userMenu userMenu-userPanel">

		<?php if (isset($_SESSION['aid'])):?>
        <div class="loginPanelData">
            <div style="float: left; width: 200px;">
                <span class="wellcomeuser"><?=$lng[174]?>, </span><span class="name"><?=$_SESSION['cLogin'];?></span>
            </div>
            <a class="wbuttons wbuttons-btHesabim" style="float: left;" href="<?=URI::get_path('profile')?>"></a>
            <a class="wbuttons wbuttons-btCikis" style="float: left;" href="<?=URI::get_path('login/logout')?>"></a>
            <div style="clear: both"></div>
        </div>
		<?php else:?>
		<div class="loginPanelButtons">
			<div class="wbuttons wbuttons-buttonBorder">
				<a href="#login" class="wbuttons wbuttons-bt" href="#login"><?=$lng[21]?></a>
			</div>
			<div class="wbuttons wbuttons-buttonBorder">
				<a href="<?=URI::get_path('register')?>" class="wbuttons wbuttons-bt"><?=$lng[10]?></a>
			</div>
			<div class="clear"></div>
		</div>
		<?php endif;?>


		<ul class="usermenus">
			<li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
			<li><a href="#" id="siralamalar"><?=$lng[11]?></a>
				<div class="submenu">
					<div class="submenutop"></div>
					<div class="submenucenter">
						<ul>
							<li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[65]?></a></li>
							<li><a href="<?=URI::get_path('ranked/guild')?>"><?=$lng[66]?></a></li>
						</ul>
					</div>
					<div class="submenubottom"></div>
				</div></li>
			<?php if (isset($_SESSION['aid'])):?>
                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>?pid=<?=$pid?>&sas=<?=$sas?>&sid=1"><?=$lng[12]?><br /></a></li>
			<?php else:?>
                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[12]?><br /></a></li>
			<?php endif;?>
			<li><a href="#" id="rehber"><?=$lng[13]?></a>
				<div class="submenu2">
					<div class="submenutop"></div>
					<div class="submenucenter">
						<ul>
							<li><a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><?=$lng[13]?></a></li>
							<li><a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>" target="_blank"><?=$lng[14]?></a></li>
                            <?php if (\StaticDatabase\StaticDatabase::settings('facebook')):?>
                                <li><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank">FACEBOOK</a></li>
							<?php endif;?>
						</ul>
					</div>
					<div class="submenubottom"></div>
				</div>
			</li>
		</ul>
		<div class="SliderContent">

			<div id='wowslider-container2'>
				<div class='ws_images'>
					<ul>
						<li><a href='#'>
								<img src='<?=URI::public_path()?>assets/sliders/1.png' alt='' title='-' id='wows0' /></a></li>
						<li><a href='#'>
								<img src='<?=URI::public_path()?>assets/sliders/2.png' alt='' title='-' id='wows1' /></a></li>
						<li><a href='#'>
								<img src='<?=URI::public_path()?>assets/sliders/3.png' alt='' title='-' id='wows2' /></a></li>
					</ul>
				</div>
			</div>
			<script type='text/javascript'>
                $(document).ready(function () {
                    $('#wowslider-container2').wowSlider({
                        effect: 'brick',
                        prev: '',
                        next: '',
                        duration: 5000,
                        delay: 3000,
                        width: 835,
                        height: 180,
                        autoPlay: true,
                        stopOnHover: false,
                        loop: false,
                        bullets: true,
                        caption: true,
                        controls: true,
                        logo: 'engine1/loading.gif',
                        images: 0
                    });
                });
			</script>

		</div>

	</div>
	<div class="wcontent">
