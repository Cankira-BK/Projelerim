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
		$getCount['activePazar'] = isset(\StaticGame\StaticGame::sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".$offline_shop_npc")[0]) ?  \StaticGame\StaticGame::sql("SELECT COUNT(owner_id) as count FROM ".PLAYER_DB_NAME.".$offline_shop_npc")[0] : 0;
	}
}

if (Cache::check('player_ranking')){
	$result['topplayer'] = \StaticGame\StaticGame::sql("SELECT player.name,player.level FROM ".PLAYER_DB_NAME.".player WHERE ".PLAYER_DB_NAME.".player.`name` NOT LIKE '[%]%' ORDER BY ".PLAYER_DB_NAME.".player.`level` DESC, ".PLAYER_DB_NAME.".player.playtime DESC, ".PLAYER_DB_NAME.".player.exp DESC LIMIT 0,5");
	$result['topguild'] =  \StaticGame\StaticGame::sql("SELECT * FROM ".PLAYER_DB_NAME.".guild ORDER BY ladder_point DESC LIMIT 0,5");
}
?>
<body>
<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?>
    <style>.languagepicker{background-color: #FFF; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; margin: 30px 0 0 0; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.languagepicker li img{margin-top: 7px;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*45?>px;}</style>
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
        position: relative;
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_filter')?>;
        top: <?=\StaticDatabase\StaticDatabase::settings('logo_position_y')?>;
    }

    .logo:hover
    {
        filter: <?=\StaticDatabase\StaticDatabase::settings('logo_hover')?>;
    }
</style>
<a href="<?=URI::get_path('index')?>" class="logo-header">
    <img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" class="logo">
</a>
<div id="main_wrapper">
	<div id="cloth">
		<div id="main_menu">
			<ul id="navigation">
				<a href="<?=URI::get_path('index')?>"><li id="home"></li></a>

				<a href="<?=URI::get_path('register')?>"><li id="regi"></li></a>
				<a href="<?=URI::get_path('download')?>"><li id="download"></li></a>
				<a href="<?=URI::get_path('ranked/player')?>"><li id="ranking"></li></a>
				<a href="<?=URL.MUTUAL?>" class="itemshop itemshop-btn iframe"><li id="teamspeak"></li></a>
				<a href="<?=URL.SHOP?>" class="itemshop itemshop-btn iframe" title="Nesne Market"><li id="eventcalendar"></li></a>
				<a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>" target="_blank"><li id="board"></li></a>
			</ul>
		</div>

		<?php if (isset($_SESSION['aid'])):?>
		<div id="login"><div id="loginbtn" style="background-image: url(<?=URI::public_path('assets/images/profilebtn.png')?>);"></div></div>
        <?php else:?>
            <div id="login"><div id="loginbtn" style="background-image: url(<?=URI::public_path('assets/images/loginbtn.png')?>);"></div></div>
		<?php endif;?>

		<div class="inner">
			<div id="slider"><img src="<?=URI::public_path('assets/images/slider/4.png')?>"></div>
		</div>

	</div>

	<div id="content_wrapper">
		<div id="content_main">
			<div class="inner_wrapper">

				<div class="content_wrapper right">
					<a href="<?=URI::get_path('download')?>">
						<div id="download_btn"></div>
					</a>
					<div class="real_content">
						<a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank"><div id="facebook_btn"></div></a>
					</div>

					<?php Cache::open('server_statistics');?>
					<?php if (Cache::check('server_statistics')):?>
					<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0):?>
					<div class="real_content">
						<div id="ServeurStats">
							<div class="headline"><span class="title"><?=$lng[2]?></span></div>
							<div class="inner_content">
								<div id="ServerStatus">
									<table class="topranking" cellspacing="1" cellpadding="0">
										<center>
											<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
											<tr class="c1">
												<td class="pname"><i><b><?=$lng[3]?> :</i></b></td> <td class="score"><font id="online_oyuncu"><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></font><br></td>
											</tr>
											<?php endif;?>
											<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
											<tr class="c2">
												<td class="pname"><i><b><?=$lng[4]?> :</i></b></td> <td class="score"><font id="rekor_online"><?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></font><br></td>
											</tr>
											<?php endif;?>
											<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
											<tr class="c1">
												<td class="pname"><i><b><?=$lng[5]?> :</i></b></td> <td class="score"><font id="toplam_kayit"><?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></font><br></td>
											</tr>
											<?php endif;?>
											<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
											<tr class="c2">
												<td class="pname"><i><b><?=$lng[6]?> :</i></b></td> <td class="score"><font id="toplam_karakter"><?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></font><br></td>
											</tr>
											<?php endif;?>
											<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
											<tr class="c1">
												<td class="pname"><i><b><?=$lng[7]?> :</i></b></td> <td class="score"><font id="toplam_lonca"><?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></font><br></td>
											</tr>
											<?php endif;?>
										</center>
									</table>
								</div>
							</div>
						</div>
					</div>
					<?php endif;?>
					<?php endif;?>
					<?php Cache::close('server_statistics');?>
					<?php Cache::open('player_ranking');?>
					<?php if (Cache::check('player_ranking')):?>
					<div class="real_content">
						<div class="headline"><span class="title"><?=$lng[11]?></span></div>
						<div class="inner_content">

							<table id="top-player" class="topranking" cellspacing="1" cellpadding="0">
								<tr class="c0">
									<td class="index"><i>#</i></td>
									<td class="pname"><i><?=$lng[67]?></i></td>
									<td class="score"><i><?=$lng[68]?></i></td>
								</tr>
								<?php if (count($result['topplayer']) != 0):?>
								    <?php foreach ($result['topplayer'] as $key=>$row):?>
								    <?php if ($key % 2 == 0):?>
                                            <tr class="c1">
                                                <td class="index"><?=$key+1?></td>
                                                <td class="pname"><a href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></td>
                                                <td class="score"><?=$row['level']?></td>
                                            </tr>
                                    <?php else:?>
                                            <tr class="c2">
                                                <td class="index"><?=$key+1?></td>
                                                <td class="pname"><a href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></td>
                                                <td class="score"><?=$row['level']?></td>
                                            </tr>
                                    <?php endif;?>
									<?php endforeach;?>
								<?php else:?>
                                    <tr class="c1">
                                        <td class="index"></td>
                                        <td class="pname"><?=$lng[28]?></td>
                                        <td class="score"></td>
                                    </tr>
								<?php endif;?>
							</table>
                            <table id="top-guild" class="topranking" cellspacing="1" cellpadding="0" style="display: none">
                                <tr class="c0">
                                    <td class="index"><i>#</i></td>
                                    <td class="pname"><i><?=$lng[67]?></i></td>
                                    <td class="score"><i><?=$lng[47]?></i></td>
                                </tr>
								<?php if (count($result['topguild']) != 0):?>
									<?php foreach ($result['topguild'] as $key=>$row):?>
										<?php if ($key % 2 == 0):?>
                                            <tr class="c1">
                                                <td class="index"><?=$key+1?></td>
                                                <td class="pname"><a href="<?=URI::get_path('detail/guild/'.$row['name'])?>"><?=$row['name']?></a></td>
                                                <td class="score"><?=$row['level']?></td>
                                            </tr>
										<?php else:?>
                                            <tr class="c2">
                                                <td class="index"><?=$key+1?></td>
                                                <td class="pname"><a href="<?=URI::get_path('detail/guild/'.$row['name'])?>"><?=$row['name']?></a></td>
                                                <td class="score"><?=$row['ladder_point']?></td>
                                            </tr>
										<?php endif;?>
									<?php endforeach;?>
								<?php else:?>
                                    <tr class="c1">
                                        <td class="index"></td>
                                        <td class="pname"><?=$lng[31]?></td>
                                        <td class="score"></td>
                                    </tr>
								<?php endif;?>
                            </table>
                            <br>
							<center>
								<a id="player-btn" href="javascript:void(0)"><input type="button" value="<?=$lng[172]?>"></a>
								<a id="guild-btn" href="javascript:void(0)"><input type="button" value="<?=$lng[38]?>"></a>
							</center>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<?php endif;?>
				<?php Cache::close('player_ranking')?>
                <script>
                    var topNumber = 0;
                    $('#player-btn').click(function () {
                        if (topNumber !== 0)
                        {
                            document.getElementById('top-guild').style.display = "none";
                            $('#top-player').fadeIn("slow");
                            topNumber = 0;
                        }
                    });
                    $('#guild-btn').click(function () {
                        if (topNumber !== 1)
                        {
                            document.getElementById('top-player').style.display = "none";
                            $('#top-guild').fadeIn("slow");
                            topNumber = 1;
                        }
                    });
                </script>