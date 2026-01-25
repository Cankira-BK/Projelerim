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
    <style>.languagepicker{background-color: #FFF; margin: 80px 0 0 0; display: inline-block; padding: 0; height: 40px; overflow: hidden; transition: all .3s ease; vertical-align: top; float: left; position: fixed; right: 0px; z-index: 999;}.languagepicker:hover{/* don't forget the 1px border */ height: 81px;}.languagepicker a{color: #000; text-decoration: none;}.languagepicker li{display: block; padding: 0px 10px; line-height: 40px; border-top: 1px solid #EEE;}.languagepicker li:hover{background-color: #EEE;}.languagepicker a:first-child li{border: none; background: #FFF !important;}.roundborders{-webkit-border-top-left-radius: 5px; -webkit-border-bottom-left-radius: 5px; -moz-border-radius-topleft: 5px; -moz-border-radius-bottomleft: 5px; border-top-left-radius: 5px; border-bottom-left-radius: 5px;}.large:hover{height: <?=Translate::translateButton("count")*42?>px;}</style>
    <ul class="languagepicker roundborders large"><?=Translate::translateButton("html")?></ul>
<?php endif;?>
<div class="container-fluid icerik">
	<div class="container">
		<div class="row">
			<div class="ust">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<!-- Bootstrap Menü Barı Mobilde Görünecek Kısım -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>

						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav navbar-left">
								<li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?> <span>homepage</span></a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lng[172]?> <span>game</span></a>
									<ul class="dropdown-menu">

										<li><a href="<?=URI::get_path('download')?>"><?=$lng[0]?></a></li>
										<li><a href="<?=URI::get_path('register')?>"><?=$lng[10]?></a></li>
									</ul>
								</li>

							</ul>
							<ul class="nav navbar-nav navbar-right">

								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lng[11]?> <span>Ranking</span></a>
									<ul class="dropdown-menu">
										<li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[65]?></a></li>
										<li><a href="<?=URI::get_path('ranked/guild')?>"><?=$lng[66]?></a></li>
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$lng[173]?> <span>community</span></a>
									<ul class="dropdown-menu">
										<li><a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><?=$lng[146]?></a></li>
										<li><a target="_blank" href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>"><?=$lng[14]?></a></li>
										<li><a target="_blank" href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">Facebook</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</nav>
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
                <a href="<?=URI::get_path('index')?>" class="logo-header">
                    <img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" class="logo">
                </a>
				<?php Cache::open('online_statistics');?>
				<?php if (Cache::check('online_statistics')):?>
				<div class="onlineoyuncu">
					<span><b><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></b> <?=$lng[174]?></span>
				</div>
				<?php endif;?>
				<?php Cache::close('online_statistics');?>
			</div>

			<div class="col-md-3">
				<div class="col-md-12 no-padding">
					<a href="<?=URI::get_path('download')?>">
						<div class="oyunindir_btn">
							<?=$lng[0]?><small><?=$lng[176]?></small>
						</div></a>
				</div>
				<?php if (isset($_SESSION['aid'])):?>
					<div class="col-md-12 no-padding">
						<div class="panel panel-kucuk">
							<div class="panel-heading"><?=$lng[181]?></div>
							<div class="panel-body">
								<?=$lng[182]?> , <?=Session::get('cLogin')?><br>

								<table class="UyePanelTablo">
									<tr>
										<td><?=$lng[17]?></td>
										<td><?=$getAin[CASH]?></td>
									</tr>
									<tr>
										<td><?=$lng[18]?></td>
										<td><?=$getAin[MILEAGE]?></td>
									</tr>
								</table>
								<a href="<?=URI::get_path('profile')?>" class="btn btn-uyepanel btn-block"><?=$lng[9]?></a>
                                <a href="<?=URL.SHOP?>" class="btn btn-uyepanel btn-block itemshop itemshop-btn iframe"><?=$lng[147]?></a>
								<a href="<?=URL.MUTUAL?>" class="itemshop itemshop-btn iframe btn btn-uyepanel btn-block"><?=$lng[146]?></a><br>
								<a href="<?=URI::get_path('login/logout')?>" class="btn btn-uyepanel btn-block"><?=$lng[148]?></a>
							</div>
						</div>
					</div>
				<?php else:?>
					<?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare'):?>
						<div class="col-md-12 no-padding">
							<div class="panel panel-kucuk">
								<div class="panel-heading"><?=$lng[21]?></div>
								<div class="panel-body">
									<form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST" onkeypress="return event.keyCode != 13;">
										<div class="form-group">
											<label for="HesapAdi" class="giris-label"><?=$lng[22]?></label>
											<div class="input-group">
												<span class="input-group-addon giris-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
												<input type="text" class="form-control giris-input" name="login" placeholder="<?=$lng[22]?>" aria-describedby="basic-addon1" required="">
											</div>
										</div>
										<div class="form-group">
											<label for="HesapSifre" class="giris-label"><?=$lng[23]?></label>
											<div class="input-group">
												<span class="input-group-addon giris-addon" id="basic-addon2"><i class="glyphicon glyphicon-lock"></i></span>
												<input type="password" class="form-control giris-input" name="password" placeholder="<?=$lng[23]?>" aria-describedby="basic-addon2" required="">
											</div>
										</div>
										<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                            <div class="form-group">
                                                <label for="HesapSifre" class="giris-label">PIN</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon giris-addon" id="basic-addon2"><i class="glyphicon glyphicon-lock"></i></span>
                                                    <input type="password" class="form-control giris-input" name="pin" placeholder="PIN" aria-describedby="basic-addon2" required="" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>">
                                                </div>
                                            </div>
										<?php endif;?>
										<div class="modal fade" id="GirisGuvenlik" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
														<h4 class="modal-title" id="myModalLabel"><?=$lng[179]?></h4>
													</div>
													<div class="modal-body">
														<center>
															<?=$lng[180]?><br><br>
															<center>
																<div style="width: 304px; height: 78px;">
																	<script src='https://www.google.com/recaptcha/api.js'></script>
																	<div class="g-recaptcha rc-anchor-dark" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
																</div>
															</center>
														</center>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal"><?=$lng[177]?></button>
														<button type="submit" class="btn btn-giris"><?=$lng[178]?></button>
													</div>
												</div>
											</div>
										</div>
										<button type="button" data-toggle="modal" data-target="#GirisGuvenlik" class="btn btn-giris btn-block"><?=$lng[21]?></button>
									</form>
									<div class="kayip-buttonlar">
										<a href="<?=URI::get_path('recuperare')?>"><?=$lng[25]?></a><br>
										<a href="<?=URI::get_path('recuperare/account')?>"><?=$lng[26]?></a>
									</div>
								</div>
							</div>
						</div>
					<?php endif;?>
				<?php endif;?>
				<?php Cache::open('player_ranking');?>
				<?php if (Cache::check('player_ranking')):?>
				<div class="col-md-12 no-padding">
					<div class="panel panel-kucuk">
						<div class="panel-heading"><?=$lng[65]?>
							<i class="glyphicon glyphicon-user cache-bilgi" data-toggle="tooltip" data-placement="right"></i>
						</div>
						<div class="panel-body no-padding">

							<!-- Bu veri önbellekten gösterilmektedir. -->
							<table class="table table-siralama">
								<thead>
								<tr>
									<td>#</td>
									<td><?=$lng['35']?></td>
									<td style="text-align:center;"><?=$lng['68']?></td>
								</tr>
								</thead>
								<?php if (count($result['topplayer']) != 0):?>
								<tbody>
								<?php foreach ($result['topplayer'] as $key=>$row):?>
								<?php if ($key % 2 == 0):?>
										<tr>
											<td><?=$key+1?></td>
											<td><a href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></td>
											<td style="text-align:center;"><?=$row['level']?> Lv</td>
										</tr>
								<?php else:?>
										<tr class="odd">
											<td><?=$key+1?></td>
											<td><a href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></td>
											<td style="text-align:center;"><?=$row['level']?> Lv</td>
										</tr>
								<?php endif;?>
								<?php endforeach;?>
								<?php else:?>
									<tr>
										<td>#</td>
										<td><a href="javascript:void(0)"><?=$lng[28]?></a></td>
									</tr>
								<?php endif;?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-12 no-padding">
					<div class="panel panel-kucuk">
						<div class="panel-heading"><?=$lng[66]?>
							<i class="glyphicon glyphicon-user cache-bilgi" data-toggle="tooltip" data-placement="right"></i>
						</div>
						<div class="panel-body no-padding">

							<!-- Bu veri önbellekten gösterilmektedir. -->
							<table class="table table-siralama">
								<thead>
								<tr>
									<td>#</td>
									<td><?=$lng[46]?></td>
									<td style="text-align:center;"><?=$lng[47]?></td>
								</tr>
								</thead>
								<tbody>
								<?php if (count($result['topguild']) != 0):?>
								<?php foreach ($result['topguild'] as $key=>$row):?>
								<?php if ($key % 2 == 0):?>
											<tr>
												<td><?=$key+1?></td>
												<td><a href="<?=URI::get_path('detail/guild/'.$row['name'])?>"><?=$row['name']?></a></td>
												<td style="text-align:center;"><?=$row['ladder_point']?></td>
											</tr>
								<?php else:?>

									<tr class="odd">
										<td><?=$key+1?></td>
										<td><a href="<?=URI::get_path('detail/guild/'.$row['name'])?>"><?=$row['name']?></a></td>
										<td style="text-align:center;"><?=$row['ladder_point']?></td>
									</tr>
								<?php endif;?>
								<?php endforeach;?>
								<?php else:?>
									<tr>
										<td>#</td>
										<td><a href="javascript:void(0)"><?=$lng[31]?></a></td>
									</tr>
								<?php endif;?>
								</tbody>
							</table>
							<!-- Ön bellek gösterimi burada sona ermektedir. -->
						</div>
					</div>
				</div>
				<?php endif;?>
				<?php Cache::close('player_ranking')?>
			</div>