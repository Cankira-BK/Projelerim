<?php
$sId = Session::get('sId');
$urlLang = isset($_GET['url']) ? $_GET['url'] : null;
$urlLang = rtrim($urlLang,'/');
$urlLang = filter_var($urlLang,FILTER_SANITIZE_URL);
$urlLang = explode('/', $urlLang);
if ($sId == null) {
	Session::set('sId', 'site');
}
$aid = isset($_SESSION['aid']) ? $_SESSION['aid'] : null;
if (isset($aid)) {
	$avatar = isset($playerInfo[0]['job']) ? $playerInfo[0]['job'] : null;
	$getAin = \StaticGame\StaticGame::sql("SELECT ".CASH.','.MILEAGE." FROM account WHERE id = ?", [$aid])[0];
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
    <style>.languagepicker{background-color: #FFF; margin: 60px 0 0 0; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*42?>px;}</style>
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
<header class="main">
    <div class="container">
        <nav class="navbar navbar-default navbar-main" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="logo-container">
                        <a class="navbar-brand logo-header" href="<?= URI::get_path('index') ?>">
                            <img src="<?= URL . \StaticDatabase\StaticDatabase::settings('logo') ?>" alt="" class="logo">
                        </a>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a class="active" href="<?= URI::get_path('index') ?>"><?= $lng[8] ?></a></li>
						<?php if ($aid !== null): ?>
                            <li><a href="<?= URI::get_path('profile') ?>"><?= $lng[9] ?></a></li>
						<?php else: ?>
                            <li><a href="<?= URI::get_path('register'); ?>"><?= $lng[10] ?></a></li>
						<?php endif; ?>
                        <li><a href="<?= URI::get_path('download') ?>"><?= $lng[0] ?></a></li>
                        <li><a class="itemshop itemshop-btn iframe"
                               href="<?= URL . SHOP ?>"><?= $lng[12] ?></a></li>
                        <li><a href="<?= URI::get_path('ranked/player') ?>"><?= $lng[11] ?></a></li>
                        <li><a class="itemshop itemshop-btn iframe" href="<?= URL.MUTUAL?>"><?=$lng[13]?></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<div class="container page-container">
        <div class="row">
            <div class="col-md-9">
                <div class="bxslider">
                    <div>
                        <a href="<?php if (isset($_SESSION['aid'])) {
							echo "#";
						} else {
							echo URI::get_path('register');
						} ?>">
                            <img src="<?= URI::public_path('media/banners/slide-1.png') ?>"/>
                        </a>
                    </div>
                    <div>
                        <a href="<?= URI::get_path('download') ?>">
                            <img src="<?= URI::public_path('media/banners/slide-2.png') ?>"/>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 spot-right">
                <a href="<?= URI::get_path('download') ?>" class="download-button"><?=$lng['172']?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 sub-spot">
				<?php Cache::open('player_ranking'); ?>
				<?php if (Cache::check('player_ranking')): ?>
                <div class="col-md-3">
                    <div class="rank-tabs">
                        <ul id="myTab" class="nav nav-pills sub-spot-title-list">
                            <li class="sub-spot-title">
                                <h4><?=$lng[27]?></h4>
                            </li>
                        </ul>
                            <div id="rank-player" class="tab-content"
                                 style="min-height: 158px; position: static; zoom: 1;">
                                <div class="tab-pane active">
                                    <ul class="mini-rank list-group">
										<?php if (count($result['topplayer']) != 0): ?>
											<?php foreach ($result['topplayer'] as $key => $row): ?>
                                                <li class="list-group-item">
                                                        <span class="badge-rank rank-<?= $key + 1; ?>"><?= $key + 1; ?></span>
                                                        <span class="badge lv">Lv : <?= $row['level'] ?></span>
                                                        <span><a href="<?= URI::get_path('detail/player/' . $row['name']) ?>"><?= $row['name']; ?></a></span>
                                                </li>
											<?php endforeach; ?>
										<?php else: ?>
                                            <li class="list-group-item">
                                               <?=$lng[28]?>
                                            </li>
										<?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="rank-tabs">
                        <ul id="myTab" class="nav nav-pills sub-spot-title-list">
                            <li class="sub-spot-title">
                                <h4><?=$lng[30]?></h4>
                            </li>
                        </ul>
                            <div id="rank-guild" class="tab-content" style="min-height: 158px; position: static; zoom: 1;">
                                <div class="tab-pane active">
                                    <ul class="mini-rank list-group">
										<?php if (count($result['topguild']) != 0):?>
											<?php foreach ($result['topguild'] as $key=>$row):?>
                                                <li class="list-group-item">
                                                    <span class="badge-rank rank-<?=$key+1;?>"><?=$key+1;?></span>
                                                    <span class="badge lv"><?=$row['ladder_point']?></span>
                                                    <span><a href="<?=URI::get_path('detail/guild/'.$row['name'])?>"><?=$row['name'];?></a></span>
                                                </li>
											<?php endforeach;?>
										<?php else:?>
                                            <li class="list-group-item">
												<?=$lng[31]?>
                                            </li>
										<?php endif;?>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
				<?php endif; ?>
				<?php Cache::close('player_ranking') ?>
                <div class="col-md-3">
					<?php Cache::open('server_statistics');?>
					<?php if (Cache::check('server_statistics')):?>
                    <div class="unique-times">
                        <ul id="myTab" class="nav nav-pills sub-spot-title-list">
                            <li class="sub-spot-title">
                                <h4><?=$lng[2]?></h4>
                            </li>
                        </ul>
                        <div class="tab-content" style="min-height: 158px; position: static; zoom: 1;">
                        <ul class="times list-unstyled" id="last_unique">
							<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0):?>
							    <?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
                                <li>
                                    <span class="badge"><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></span>
                                    <span class="circle"></span>
                                    <span class="name"><?=$lng[3]?></span>
                                </li>
								<?php endif;?>
							    <?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
                                <li>
                                    <span class="badge"><?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></span>
                                    <span class="circle"></span>
                                    <span class="name"><?=$lng[4]?></span>
                                </li>
								<?php endif;?>
							    <?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
                                <li>
                                    <span class="badge"><?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></span>
                                    <span class="circle"></span>
                                    <span class="name"><?=$lng[5]?></span>
                                </li>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
                                    <li>
                                        <span class="badge"><?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></span>
                                        <span class="circle"></span>
                                        <span class="name"><?=$lng[6]?></span>
                                    </li>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
                                    <li>
                                        <span class="badge"><?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></span>
                                        <span class="circle"></span>
                                        <span class="name"><?=$lng[7]?></span>
                                    </li>
								<?php endif;?>
                            <li class="live">
                                <span class="badge">Online</span>
                                <span class="circle"></span>
                                <span class="name">Game Server</span>
                            </li>
                            <li class="live">
                                <span class="badge">Online</span>
                                <span class="circle"></span>
                                <span class="name">DB Server</span>
                            </li>
							<?php endif;?>
                        </ul>
                    </div>
                    </div>
					<?php endif;?>
					<?php Cache::close('server_statistics');?>
                </div>
                <div class="col-md-3">
					<?php if (isset($_SESSION['aid'])):?>
                        <div class="login-cont frame" style="margin-top: 10px;">
                            <div class="col-md-12 login-cont-profile">
                                <div class="col-xs-4 login-cont-avatar" style="background-image:url(<?=URI::public_path('media/images/default-avatar.png')?>);"></div>
                                <div class="col-xs-8 no-padding-right">
                                    <div class="dropdown dd-grunge">
                                        <a href="<?=URI::get_path('profile/index')?>"><h4><?=Session::get('cLogin');?></h4></a>
                                    </div>
                                    <p>
                                        <small><a href="<?=URI::get_path('login/logout');?>"><?=$lng[20]?><span class="glyphicon glyphicon-log-out"></span></a></small>
                                    </p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 text-muted">
                                <ul style="margin-left:-15px;">
                                    <li>
                                        <strong><?=$lng[17]?> :</strong>
                                        <span><?=$getAin[CASH];?></span>
                                    </li>
                                    <li>
                                        <strong><?=$lng[18]?> :</strong>
                                        <span><?=$getAin[MILEAGE];?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                            <ul>
                                <li><a href="<?=URI::get_path('profile/index');?>"><?=$lng[19]?></a></li>
                                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP.'/buy'?>"><?=$lng[173]?></a></li>
                                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[147]?></a></li>
                                <li><a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL.'/index';?>"><?=$lng[13]?></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
					<?php else:?>
                        <div class="login-cont frame" style="margin-bottom: 15px;">
							<?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare'):?>
                                <div class="frame-inner" style="margin: -1px;">
                                    <form method="post" action="<?=URI::get_path('login/control');?>" id="LoginNotifyOGs">
                                        <input type="hidden" name="action" value="login">
                                        <div class="form-group narrow">
                                            <input type="text" class="form-control grunge" id="login" name="login"
                                                   placeholder="<?=$lng[22]?>">
                                            <span class="endbtn"></span>
                                        </div>
                                        <div class="form-group narrow">
                                            <input type="password" class="form-control grunge" id="password" name="password"
                                                   placeholder="<?=$lng[23]?>">
                                        </div>
								        <?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                        <div class="form-group narrow">
                                            <input type="password" class="form-control grunge" id="pin" name="pin" placeholder="PIN" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>">
                                         </div>
                                        <?php endif;?>
                                        <div class="form-group narrow">
                                            <script src='https://www.google.com/recaptcha/api.js'></script>
                                            <div class="g-recaptcha" style="transform:scale(0.73);" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-grunge"><?=$lng[21]?></button>
                                    </form>
                                    <h5 class="login-reg-link">
                                        <a href="<?=URI::get_path('recuperare/index');?>">
                                            <span class="glyphicon glyphicon-chevron-right"></span> <?=$lng[25]?></a>
                                        <br>
                                        <a href="<?=URI::get_path('recuperare/account');?>">
                                            <span class="glyphicon glyphicon-chevron-right"></span> <?=$lng[26]?></a>
                                    </h5>
                                </div>
							<?php endif;?>
                        </div>
					<?php endif;?>
                </div>
            </div>
        </div>

