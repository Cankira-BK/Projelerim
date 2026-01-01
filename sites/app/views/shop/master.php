<?php
$aId = Session::get('aId');
$getAccountInfo = \StaticGame\StaticGame::sql("SELECT ".CASH.",".MILEAGE." FROM account WHERE id = ?",[$aId]);
$aInfo = $getAccountInfo[0];
$coins = $aInfo[CASH];
$emCoins = $aInfo[MILEAGE];

$pId = Session::get('pId');
$getPlayerInfo = \StaticGame\StaticGame::sql("SELECT name,job FROM ".PLAYER_DB_NAME.".player WHERE id = ?",[$pId]);
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
            <a href="<?=URI::get_path('buy/index')?>">
                <?php if (\StaticDatabase\StaticDatabase::settings('happy_hour')):?>
                    <button class="btn-price premium">
                        <img class="ttip" tooltip-content="Ejderha Parası" src="<?=URI::public_path('images/coins.png');?>"/>
                        <span class="premium-name">EP SATIN AL (+%<?=\StaticDatabase\StaticDatabase::settings('happy_hour_discount')?>)</span>
                    </button>
                <?php else:?>
                    <button class="btn-price premium">
                        <img class="ttip" tooltip-content="Ejderha Parası" src="<?=URI::public_path('images/coins.png');?>"/>
                        <span class="premium-name">EP SATIN AL</span>
                    </button>
                <?php endif;?>
            </a>
            <ul class="currency_status currency-amount-2">
                <li data-currency="1">
                    <span class="ttip" tooltip-content="Ejderha Parası">
                        <span class="block-price">
                            <img src="<?=URI::public_path('images/coins.png');?>" width="16" height="16" alt="Ejderha Parası"/>
                            <span id="balances1" class="end-price" data-currency="<?=$coins?>"><?=$coins?></span>
                        </span>
                    </span>
                </li>
                <li data-currency="2">
                    <span class="ttip" tooltip-content="Ejderha Markası">
                        <span class="block-price">
                            <img src="<?=URI::public_path('images/em_coins.png');?>" width="16" height="16" alt="Ejderha Markası" />
                            <span id="balances2" class="end-price" data-currency="<?=$emCoins?>"><?=$emCoins?></span>
                        </span>
                    </span>
                </li>
            </ul>
            <button id="showRightPush" class="account-push" ><i class="icon-menu2"></i></button>
        </div>
    </div><!-- header -->
    <div id="contentContainer">
        <nav id="slideMenu" class="clearfix">
            <h2><i class="icon-user"></i> Oyuncu bilgisi</h2>
            <div class="account-infos">
                <img class="avatar" height="45" width="45" src="<?=URI::public_path('images/chrs/'.$pJob.'.png')?>" alt="" />
                <span class="buy-for">Alışveriş ettiğin hesap:</span>
                <p class="selected-player">
                    İsim : <?=$cLogin?><br>
                    Sunucu: <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>
                </p>
            </div>

            <ul class="nav nav-tabs nav-stacked">
                <li>
                    <a class="btn-sideitem"  href="<?=URI::get_path('nav/characters')?>"><i class="icon-users"></i> Karakterlerim</a>
                </li>
                <li>
                    <a class="btn-sideitem"  href="<?=URI::get_path('nav/log')?>"><i class="icon-basket"></i> Satın aldıklarım</a>
                </li>
                <li>
                    <a class="btn-sideitem"  href="<?=URI::get_path('nav/depo')?>"><i class="icon-stack"></i> Eşya Depom</a>
                </li>
                <li>
                    <a class="btn-sideitem"  href="<?=URI::get_path('nav/coupon')?>"><i class="icon-barcode"></i> Kodu kullan</a>
                </li>
            </ul>
            <?php if (\StaticDatabase\StaticDatabase::settings('wheel') == 1):?>
                <h2><i class="icon-smile"></i> Macera ve eğlence</h2>
                <ul class="nav nav-tabs nav-stacked">
                    <li>
                        <a class="btn-sideitem" id="Xmas2017" href="<?=URI::get_path('wheel')?>">
                            <i class="zicon-wheel"></i>
                            <span>Çark</span>
                        </a>
                    </li>
					<?php if (\StaticDatabase\StaticDatabase::settings('slot_cash_status') === "1"):?>
					<li>
						<a class="btn-sideitem" id="Xmas2017" href="<?=URI::get_path('wheel/slot')?>">
							<i class="zicon-slotcash"></i>
							<span>Slot Cash</span>
						</a>
					</li>
					<?php endif;?>
                </ul>
            <?php endif;?>
            <h2> Destek Sistemi</h2>
            <ul class="nav nav-tabs nav-stacked">
                <li>
                    <a class="btn-sideitem" id="Xmas2017" href="<?=URL.MUTUAL?>">
                        <i class="zicon-pandora"></i>
                        <span>Destek
							<?php if (intval($getTicketC) > 0):?>
                                <span class="w3-badge"><?=$getTicketC?></span>
							<?php endif;?></span>
                    </a>
                </li>
            </ul>
        </nav>
        <div id="navigation" class="navbar">
            <div class="container">
				<?php
				$firstMainCategory = \StaticDatabase\StaticDatabase::init()->prepare("SELECT id FROM shop_menu WHERE mainmenu = 0 LIMIT 1");
				$firstMainCategory->execute();
				?>
                <!-- Be sure to leave the brand out there if you want it shown -->
                <ul class="nav nav-tabs  search">
					<?php $_url[2] = isset($_url[2]) ? $_url[2] : null; ?>
                    <li class="<?php if($_url[1] == 'index' || $_url[1] == null){echo 'active'; } ?>">
                        <a class="btn-navitem icon-home <?php if($_url[1] == 'index' || $_url[1] == null){echo 'btn-navitem-active'; } ?>"  href="<?=URI::get_path('index')?>"></a>
                    </li>
                    <li class="<?php if($_url[1] == 'product'){echo 'active'; } ?>">
                        <a href="<?=URI::get_path('product/views/'.$firstMainCategory->fetch(PDO::FETCH_ASSOC)['id'])?>" title="" class="btn-navitem  <?php if($_url[1] == 'product' && $_url[2] != 'discount' && $_url[2] != 'em'){echo 'btn-navitem-active'; } ?>">Tüm ürünler</a>
                    </li>
                    <li>
                        <a href="<?=URI::get_path('product/discount')?>" title="" class="btn-navitem <?php if($_url[2] == 'discount'){echo 'btn-navitem-active'; } ?>">En Çok Satanlar</a>
                    </li>
					<?php if($emCounts>0):?>
                        <li>
                            <a href="<?=URI::get_path('product/em')?>" title="" class="btn-navitem <?php if($_url[2] == 'em'){echo 'btn-navitem-active'; } ?>">Marka Ürünler</a>
                        </li>
					<?php endif;?>
                    <?php if (\StaticDatabase\StaticDatabase::settings('wheel') == 1):?>
                        <li class="special-category">
                            <a href="<?=URI::get_path('wheel')?>" title="" class="btn-navitem <?php if($_url[1] == 'wheel'){echo 'btn-navitem-active'; } ?>">Çark</a>
                        </li>
                    <?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('slot_cash_status') === "1"):?>
                        <li class="special-category">
                            <a href="<?=URI::get_path('wheel/slot')?>" title="" class="btn-navitem <?php if($_url[1] == 'wheel' && $_url[2] == 'slot'){echo 'btn-navitem-active'; } ?>">Slot Cash</a>
                        </li>
					<?php endif;?>
                </ul>
                <!-- SEARCH FORM -->
				<?php $searchToken = hash_hmac('md5',$aId.$pId,'inpinos')?>
                <div id="searchBar" class="input-append">
                    <i class="icon-search"></i>
                    <form method="post" action="<?=URI::get_path('search/index')?>">
                        <input type="hidden" name="__token" value="<?=$searchToken?>">
                        <input name="searchString" class="search-input span2" type="text" placeholder="Arama terimi" value="">
                        <button class="btn-default btn-search"  type="submit">Ara</button>
                    </form>
                </div>
                <div class="nav-collapse collapse">

                </div>
            </div>
        </div>