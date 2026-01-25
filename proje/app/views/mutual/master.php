<?php
$aId = Session::get('aId');
$getAccountInfo = \StaticGame\StaticGame::sql("SELECT ".CASH.",".MILEAGE." FROM account WHERE id = ?",[$aId]);
$aInfo = $getAccountInfo[0];
$coins = $aInfo[CASH];
$emCoins = $aInfo[MILEAGE];

$getPlayerInfo = \StaticGame\StaticGame::sql("SELECT name,job FROM ".PLAYER_DB_NAME.".player WHERE account_id = ?",[$aId]);
$pInfo = $getPlayerInfo[0];
$pName = $pInfo['name'];
$pJob = $pInfo['job'];
$urls = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
$urls = rtrim($urls, '/');
$urls = filter_var($urls, FILTER_SANITIZE_URL);
$_url = explode('/', $urls);
$emCount = \StaticDatabase\StaticDatabase::init()->prepare("SELECT id FROM items WHERE durum = :durum");
$emCount->execute(array(':durum'=>3));
$emCounts = $emCount->rowCount();
$_url[1] = isset($_url[1]) ? $_url[1] : null;
$getTicketCount = \StaticDatabase\StaticDatabase::init()->prepare("SELECT COUNT(id) as count FROM ticket_status WHERE accountid = :accountid AND status = :status");
$getTicketCount->execute([":accountid"=>$aId,":status"=>"0"]);
$getTicketC = $getTicketCount->fetch(PDO::FETCH_ASSOC)['count'];
?>
<body class="website">
<div id="page" class="row-fluid">
	<div id="header" class="header clearfix">
		<div class="span5  logo-block">
			<h1>
				<a style="background: url(<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>) 0 50% no-repeat;background-size: contain;" href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi');?></a>
			</h1>
			<div class="welcome">
				<i class="icon-user"></i><span><?=$cLogin?></span>
				<i class="icon-earth"></i><span><?=\StaticDatabase\StaticDatabase::settings('oyun_adi');?></span>
			</div>
		</div>
		<div class="span7 payment-block">
			<a href="<?=URI::get_path('index')?>">
				<button class="btn-price premium">
					<span class="premium-name">Ticket Oluştur</span>
				</button>
			</a>
			<button id="showRightPush" class="account-push" ><i class="icon-menu2"></i></button>
		</div>
	</div><!-- header -->
	<div id="contentContainer">
		<nav id="slideMenu" class="clearfix">
			<h2><i class="icon-user"></i> Oyuncu bilgisi</h2>
			<div class="account-infos">
				<img class="avatar" height="45" width="45" src="<?=URI::public_path('images/chrs/'.$pJob.'.png')?>" alt="" />
				<span class="buy-for">Giriş yapılan hesap:</span>
				<p class="selected-player">
					İsim : <?=$cLogin?><br>
					Sunucu : <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>
				</p>
			</div>

				<h2> Nesne Market</h2>
				<ul class="nav nav-tabs nav-stacked">
					<li>
						<a class="btn-sideitem" id="Xmas2017" href="<?=URL.SHOP?>">
							<i class="zicon-dailies"></i>
							<span>Nesne Market</span>
						</a>
					</li>
				</ul>
		</nav>
		<div id="navigation" class="navbar">

			<div class="container">
				<!-- Be sure to leave the brand out there if you want it shown -->
				<ul class="nav nav-tabs  search">
					<?php $_url[2] = isset($_url[2]) ? $_url[2] : null; ?>
					<li class="<?php if($_url[1] == 'index' || $_url[1] == null){echo 'active'; } ?>">
						<a class="btn-navitem icon-home <?php if($_url[1] == 'index' || $_url[1] == null){echo 'btn-navitem-active'; } ?>"  href="<?=URI::get_path('index')?>"></a>
					</li>
					<li class="<?php if($_url[1] == 'product'){echo 'active'; } ?>">
						<a href="<?=URI::get_path('ticket/read')?>" title="" class="btn-navitem  <?php if($_url[1] == 'ticket' && $_url[2] == 'read'){echo 'btn-navitem-active'; } ?>">
                            Yanıtlanmış Ticketler
                            <?php if (intval($getTicketC) > 0):?>
                                <span class="w3-badge"><?=$getTicketC?></span>
                            <?php endif;?>
                        </a>
					</li>
					<li>
						<a href="<?=URI::get_path('ticket/unread')?>" title="" class="btn-navitem <?php if($_url[1] == 'ticket' && $_url[2] == 'unread'){echo 'btn-navitem-active'; } ?>">Yanıtlanmamış Ticketler</a>
					</li>
					<li>
						<a href="<?=URI::get_path('ticket/lock')?>" title="" class="btn-navitem <?php if($_url[1] == 'ticket' && $_url[2] == 'lock'){echo 'btn-navitem-active'; } ?>">Kapatılmış Ticketlar</a>
					</li>
				</ul>
			</div>
		</div>