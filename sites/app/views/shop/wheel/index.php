<?php
$wheelCoins = \StaticDatabase\StaticDatabase::settings('wheelcoins');
$items = $this->all['items'];
if ($this->all['coins'] >= $wheelCoins)
{
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	Session::set('play_wheel',generateRandomString());
	$createToken = $this->hash->create('md5',Session::get('aId').Session::get('cLogin').$this->all['coins'],Session::get('play_wheel'));
	$startLink = URI::get_path('wheel/spin/'.$createToken);
}
$playLink = ($this->all['coins'] >= $wheelCoins) ? $startLink : URI::get_path('wheel/not_cash');
$fancyStatus = ($this->all['coins'] >= $wheelCoins) ? null : "fancybox fancybox.ajax";
?>
<script type="text/javascript">var dir = zs.data.dir || {};</script>
<script type="text/javascript" src="<?= URI::public_path('js/wheel-1.js') ?>"></script>
<link rel="stylesheet" id="gameStyle" href="<?= URI::public_path('css/wheel.min.css') ?>" type="text/css"/>
<style>

</style>
<div class="content clearfix" id="wt_refpoint">
    <div class="mg-breadcrumb-container row-fluid">
        <h2>
            <ul class="breadcrumb">
                <li>Çark</li>
            </ul>
        </h2>
        <a class="wheel-help minigames-help ttip" href="javascript:void(0)"><i class="icon-book"></i>Yardım ve bilgi</a>
    </div>
    <div id="wheel-game" class=" wheel lvl-1">
        <!-- Wheel Pause Overlay -->
        <!-- Wheel Stage -->
        <ul class="wheel-menu">
            <li>
                <!-- Tabs Menu -->
                <a id="wheel-prices" class="btn-navitem">
                    <!--  <i class="open-box"></i>-->
                    <span>Olası ödüller</span>
                </a>
            </li>
        </ul>
        <!--    </div>-->
        <!--    Wheel   -->
        <div id="wheel-container" class="span8">
            <div id="wheel" class="_wl-sprite clockwise">
                <!-- Keys Rendering -->
                <div class="wheel-keys">
                    <i id="key-3" class="key icon-key-wheel _wl-sprite"><i class="before"></i></i>
                    <i id="key-7" class="key icon-key-wheel _wl-sprite"><i class="before"></i></i>
                    <i id="key-11" class="key icon-key-wheel _wl-sprite"><i class="before"></i></i>
                    <i id="key-15" class="key icon-key-wheel _wl-sprite"><i class="before"></i></i>
                </div>
                <!-- Keys Rendering -->
                <div class="wheel-ring _wl-sprite"></div>
                <!-- Before Play  -->
                <div id="teaser1" class="teaser wheel-items">
					<?php $gift_1 = array();?>
					<?php for($i = 0; $i < 16; $i++):?>
						<?php
						$rand = rand(0,(count($items) - 1));
						array_push($gift_1,$items[$rand]);
						?>
                        <img class="wheel-item-<?=$i+1;?> teaser" src="<?=URL.$items[$rand]['item_image']?>" alt="">
					<?php endfor;?>
                </div>
                <div id="teaser2" class="teaser wheel-items">
					<?php $gift_2 = array();?>
					<?php for($i = 0; $i < 16; $i++):?>
						<?php
						$rand = rand(0,(count($items) - 1));
						array_push($gift_2,$items[$rand]);
						?>
                        <img class="wheel-item-<?=$i+1;?> teaser" src="<?=URL.$items[$rand]['item_image']?>" alt="">
					<?php endfor;?>
                </div>
                <div id="teaser3" class="teaser wheel-items">
					<?php $gift_3 = array();?>
					<?php for($i = 0; $i < 16; $i++):?>
						<?php
						$rand = rand(0,(count($items) - 1));
						array_push($gift_3,$items[$rand]);
						?>
                        <img class="wheel-item-<?=$i+1;?> teaser" src="<?=URL.$items[$rand]['item_image']?>" alt="">
					<?php endfor;?>
                </div>
                <!-- Play Button  -->
                <div id="wheel-spinner">
                    <div class="wheel-btn _wl-sprite ">
                        <a href="<?=$playLink?>" class="play <?=$fancyStatus?>">
                            <div id="spinButton">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td>
                                            Çevir!<br>(<?=$wheelCoins?>&nbsp;<img class="ttip" src="<?=URI::public_path('images/coins.png')?>">)
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Play Button-->
            </div>
        </div>
        <!--    Wheel Info  -->
        <div id="wheel-info" class="span2 small">
            <!--  Stage Info  -->
            <p>Çarkı yalnızca <?=$wheelCoins?> <img class="ttip" src="<?=URI::public_path('images/coins.png')?>"> karşılığında çevir!</p>
        </div>
        <!--   Fancybox -->
        <!-- Fancy Help -->
        <div id="fancybox-help" class="fancyboxContentContainer">
            <div id="wheel-help" class="contrast-box">
                <h2><i class="icon-info"></i>&nbsp;Yardım ve bilgi</h2>
                <div class="grey-box ">
                    <h3>Çark nedir?</h3>
                    <p>Kader Çarkı, çarkıfelek gibi işlev görür: Bir kere çevirmek için belirli bir miktar Ejder Parası ödenir (kazanılan Ejderha Markası otomatik olarak hesabına geçirilir). Çarkın ortasındaki "Çevir" yazılı butona bir kere tıkladığında çark dönmeye başlar. Dış alanlarda şimdi kazanabileceğin ödüller görüntülenir ve şansın kadere bırakılır. Çarkın durduğu yerdeki eşya da senin ödülün olur.</p>
                </div>
            </div>
        </div>

        <!-- Rewards Panel  -->
        <div id="wheel-special-stage" class="wheel-special-stage-articles mg-possible-rewards rewards-panel">
            <i title="Kapat" class="icon-close close-panel" onclick="hideRewardsPanel()"></i>
            <div class="contrast-box tabbable" >
                <h2 class="reward-title">Tüm ödüller</h2>
                <ul class="nav nav-tabs"  data-tabs="tabs">
                    <li class="active">
                        <a class="heading-tab" data-toggle="tab" href="#special-rewards">
                            Olası Ödüller
                        </a>
                    </li>

                </ul>
            </div>
            <div class="tab-content ">
                <!-- start special rewards -->
                <div class="tab-pane active scrollable_container mCustomScrollbar" id="special-rewards">
                    <div class="contrast-box" id="reward-1">
                        <div class="grey-box">
                            <h3 class="title-reward">1. Set Ödüllleri</h3>
                            <div class="carousell-reward-1   carousell-reward royalSlider rsNoDrag contentslider rsDefault visibleNearby card rsHorcard">
								<?php foreach ($gift_1 as $row):?>
                                    <div class="list-item quickbuy">
                                        <div class="contrast-box  item-box inner-content clearfix" >
                                            <div class="desc row-fluid">
                                                <div class="item-description">
                                                    <h4>
                                                        <a class="card-heading" title="<?=$row['item_name'];?>"><?=$row['item_name'];?></a>
                                                    </h4>
                                                    <div id="scrollTo10453213" class="item-shortdesc clearfix">
                                                        <a class="item-thumb">
                                                            <div class="item-thumb-container">
                                                                <div class="picture_wrapper_2">
                                                                    <img class=" item-thumb-63" src="<?=URL.$row['item_image'];?>" alt="<?=$row['item_name'];?>">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <span class="category-link"></span>
                                                        <div>
                                                            <p>
																<?=$row['description']?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    <div class="contrast-box" id="reward-2">
                        <div class="grey-box">
                            <h3 class="title-reward">2. Set Ödüllleri</h3>
                            <div class="carousell-reward-2   carousell-reward royalSlider rsNoDrag contentslider rsDefault visibleNearby card rsHorcard">
								<?php foreach ($gift_2 as $row):?>
                                    <div class="list-item quickbuy">
                                        <div class="contrast-box  item-box inner-content clearfix" >
                                            <div class="desc row-fluid">
                                                <div class="item-description">
                                                    <h4>
                                                        <a class="card-heading" title="<?=$row['item_name'];?>"><?=$row['item_name'];?></a>
                                                    </h4>
                                                    <div id="scrollTo10453213" class="item-shortdesc clearfix">
                                                        <a class="item-thumb">
                                                            <div class="item-thumb-container">
                                                                <div class="picture_wrapper_2">
                                                                    <img class=" item-thumb-63" src="<?=URL.$row['item_image'];?>" alt="<?=$row['item_name'];?>">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <span class="category-link"></span>
                                                        <div>
                                                            <p>
																<?=$row['description']?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    <div class="contrast-box" id="reward-3">
                        <div class="grey-box">
                            <h3 class="title-reward">3. Set Ödüllleri</h3>
                            <div class="carousell-reward-3 carousell-reward royalSlider rsNoDrag contentslider rsDefault visibleNearby card rsHorcard">
								<?php foreach ($gift_3 as $row):?>
                                    <div class="list-item quickbuy">
                                        <div class="contrast-box  item-box inner-content clearfix" >
                                            <div class="desc row-fluid">
                                                <div class="item-description">
                                                    <h4>
                                                        <a class="card-heading" title="<?=$row['item_name'];?>"><?=$row['item_name'];?></a>
                                                    </h4>
                                                    <div id="scrollTo10453213" class="item-shortdesc clearfix">
                                                        <a class="item-thumb">
                                                            <div class="item-thumb-container">
                                                                <div class="picture_wrapper_2">
                                                                    <img class=" item-thumb-63" src="<?=URL.$row['item_image'];?>" alt="<?=$row['item_name'];?>">
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <span class="category-link"></span>
                                                        <div>
                                                            <p>
																<?=$row['description']?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								<?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
