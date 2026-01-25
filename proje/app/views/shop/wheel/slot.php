<?php
$browser = new Browser();
?>
<?php if (\StaticDatabase\StaticDatabase::settings('slot_cash_status') != "1"):?>
    <link rel="stylesheet" id="gameStyle" href="<?= URI::public_path('css/wheel.min.css') ?>" type="text/css"/>
    <div class="content clearfix" id="wt_refpoint">
        <div class="mg-breadcrumb-container row-fluid">
            <h2>
                <ul class="breadcrumb">
                    <li>Çark</li>
                </ul>
            </h2>
        </div>
        <div id="wheel-game" class=" wheel lvl-1">
            <div id="error" class="contrast-box">
                <div class="dark-grey-box">
                    <h2><i class="icon-info left"></i>Hata</h2>
                    <br>
                    <h3>Slot Cash malesef aktif değil!</h3>
                    <div class="btn_wrapper">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif($browser->getBrowser() === "Internet Explorer"):?>
    <link rel="stylesheet" id="gameStyle" href="<?= URI::public_path('css/wheel.min.css') ?>" type="text/css"/>
    <div class="content clearfix" id="wt_refpoint">
        <div class="mg-breadcrumb-container row-fluid">
            <h2>
                <ul class="breadcrumb">
                    <li>Çark</li>
                </ul>
            </h2>
        </div>
        <div id="wheel-game" class=" wheel lvl-1">
            <div id="error" class="contrast-box">
                <div class="dark-grey-box">
                    <h2><i class="icon-info left"></i>Hata</h2>
                    <br>
                    <h3>Slot Cash'ı oyun içinden oynayamazsınız. Lütfen site üzerinden oynamayı deneyiniz!</h3>
                    <div class="btn_wrapper">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else:?>
    <link rel="stylesheet" id="gameStyle" href="<?= URI::public_path('css/wheel.min.css') ?>" type="text/css"/>
    <link rel="stylesheet" id="gameStyle" href="<?= URI::public_path('css/slot.min.css') ?>" type="text/css"/>
	<?php
	$slotCount = \StaticDatabase\StaticDatabase::settings('slot_cash_count');
	?>

    <div class="content clearfix" id="wt_refpoint">
        <div class="mg-breadcrumb-container row-fluid">
            <h2>
                <ul class="breadcrumb">
                    <li>Slot Cash</li>
                </ul>
            </h2>
            <a class="wheel-help minigames-help ttip" href="javascript:void(0)"><i class="icon-book"></i>Yardım ve bilgi</a>
        </div>
        <div id="wheel-game" class=" wheel lvl-1">
            <!-- Wheel Pause Overlay -->
            <!--    Wheel   -->
            <div id="wheel-container" class="span8">
				<?php for ($i = 1; $i < $slotCount; $i++):?>
                    <?php echo($i);?>
				<?php endfor;?>
                <div id="wheel" class="clockwise" style="width: 420px;">
                    <div style="display: block;height: 150px;margin-top: 100px;">
                        <img src="<?=URI::public_path('images/roulette/frame.png')?>" style="position: absolute;
    height: 160px;z-index: 10">
                        <div id="roulette0" class="roulette0">
							<?php for ($i = 1; $i < $slotCount; $i++):?>
                                <img src="<?=URI::public_path('')?>images/roulette/<?=$i?>.png"/>
							<?php endfor;?>
                        </div>
                        <div id="roulette1" class="roulette1">
							<?php for ($i = 1; $i < $slotCount; $i++):?>
                                <img src="<?=URI::public_path('')?>images/roulette/<?=$i?>.png"/>
							<?php endfor;?>
                        </div>
                        <div id="roulette2" class="roulette2">
							<?php for ($i = 1; $i < $slotCount; $i++):?>
                                <img src="<?=URI::public_path('')?>images/roulette/<?=$i?>.png"/>
							<?php endfor;?>
                        </div>
                    </div>

                    <div id="slotCash"
                         data-control="<?=URI::get_path('wheel/slotControl')?>"
                         data-slot_gift_control="<?=URI::get_path('wheel/slotGiftControl')?>"
                         class="play-slot-cash">
                        <p id="slotRunText">Slot Cash Oyna</p>
                    </div>

					<?php if ($coins >= 5):?>
						<?php if ($coins >= 5):?>
                            <!--5 EP-->
                            <button id="startRouletteBtn0" onclick="Roulette0()" class="btn-price btn-slot start-roulette">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">5 EP</span>
                            </button>
                            <!--5 EP-->
						<?php else:?>
                            <!--5 EP-->
                            <button id="startRouletteBtn0" class="btn-price btn-slot btn-passive">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">5 EP</span>
                            </button>
                            <!--5 EP-->
						<?php endif;?>

						<?php if ($coins >= 10):?>
                            <!--10 EP-->
                            <button id="startRouletteBtn1" onclick="Roulette1()" class="btn-price btn-slot start-roulette">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">10 EP</span>
                            </button>
                            <!--10 EP-->
						<?php else:?>
                            <!--10 EP-->
                            <button id="startRouletteBtn1" class="btn-price btn-slot btn-passive">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">10 EP</span>
                            </button>
                            <!--10 EP-->
						<?php endif;?>

						<?php if ($coins >= 25):?>
                            <!--25 EP-->
                            <button id="startRouletteBtn2" onclick="Roulette2()" class="btn-price btn-slot start-roulette">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">25 EP</span>
                            </button>
                            <!--25 EP-->
						<?php else:?>
                            <!--25 EP-->
                            <button id="startRouletteBtn2" class="btn-price btn-slot btn-passive">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">25 EP</span>
                            </button>
                            <!--25 EP-->
						<?php endif;?>

						<?php if ($coins >= 50):?>
                            <!--50 EP-->
                            <button id="startRouletteBtn3" onclick="Roulette3()" class="btn-price btn-slot start-roulette">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">50 EP</span>
                            </button>
                            <!--50 EP-->
						<?php else:?>
                            <!--50 EP-->
                            <button id="startRouletteBtn3" class="btn-price btn-slot btn-passive">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">50 EP</span>
                            </button>
                            <!--50 EP-->
						<?php endif;?>

						<?php if ($coins >= 100):?>
                            <!--100 EP-->
                            <button id="startRouletteBtn4" onclick="Roulette4()" class="btn-price btn-slot start-roulette">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">100 EP</span>
                            </button>
                            <!--100 EP-->
						<?php else:?>
                            <!--100 EP-->
                            <button id="startRouletteBtn4" class="btn-price btn-slot btn-passive">
                                <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                                <span class="slot-btn-text">100 EP</span>
                            </button>
                            <!--100 EP-->
						<?php endif;?>
					<?php endif;?>

                    <a href="<?=URI::get_path('buy/index')?>">
                        <button id="slotPrice" class="btn-price premium slot-price" style="display: <?=($coins < 5) ? "block" : "none";?>">
                            <img class="slot-cash" src="<?=URI::public_path('images/coins.png')?>">
                            <span class="premium-name">EP SATIN AL</span>
                        </button>
                    </a>
                </div>
            </div>
            <!--    Wheel Info  -->
            <div id="wheel-info" class="span2 small">
                <!--  Stage Info  -->
                <p>Slot cash'i kazandığınız takdirde çevirdiğiniz EP miktarının <?=\StaticDatabase\StaticDatabase::settings('slot_cash_gift')?> katı EP verir.</p>
            </div>
            <!--   Fancybox -->
            <div id="fancybox-help" class="fancyboxContentContainer">
                <div id="wheel-help" class="contrast-box">
                    <h2><i class="icon-info"></i>&nbsp;Yardım ve bilgi</h2>
                    <div class="grey-box ">
                        <h3>Slot Cash nedir?</h3>
                        <p>Slot Cash, mevcut <b>Ejderha Para</b>nızı katlayabileceğiniz bir oyundur. Yatırmak istediğiniz miktarı seçiniz. 3 resimde aynı geldiğinde oynadığınız tutar kadar size x<?=\StaticDatabase\StaticDatabase::settings('slot_cash_gift')?> <b>Ejderha Para</b>sı anında hesabınıza yatar.</p>
                    </div>
                </div>
            </div>

            <!--Play-->
            <div id="fancyBoxRoulette0" class="fancyboxContentContainer">
                <div id="wheel-help" class="contrast-box">
                    <div class="grey-box ">
                        <h3>5 EP karşılığında Slot Cash oynamak istiyor musunuz?</h3>
                        <button id="startRouletteBtn0" onclick="startRoulette0()" class="btn-price btn-slot start-roulette">
                            <span class="slot-btn-text">Evet</span>
                        </button>
                        <button class="btn-price btn-slot btn-close" onclick="$.fancybox.close();">
                            <span class="slot-btn-text">Hayır</span>
                        </button>
                    </div>
                </div>
            </div>

            <div id="fancyBoxRoulette1" class="fancyboxContentContainer">
                <div id="wheel-help" class="contrast-box">
                    <div class="grey-box ">
                        <h3>10 EP karşılığında Slot Cash oynamak istiyor musunuz?</h3>
                        <button id="startRouletteBtn1" onclick="startRoulette1()" class="btn-price btn-slot start-roulette">
                            <span class="slot-btn-text">Evet</span>
                        </button>
                        <button class="btn-price btn-slot btn-close" onclick="$.fancybox.close();">
                            <span class="slot-btn-text">Hayır</span>
                        </button>
                    </div>
                </div>
            </div>

            <div id="fancyBoxRoulette2" class="fancyboxContentContainer">
                <div id="wheel-help" class="contrast-box">
                    <div class="grey-box ">
                        <h3>25 EP karşılığında Slot Cash oynamak istiyor musunuz?</h3>
                        <button id="startRouletteBtn2" onclick="startRoulette2()" class="btn-price btn-slot start-roulette">
                            <span class="slot-btn-text">Evet</span>
                        </button>
                        <button class="btn-price btn-slot btn-close" onclick="$.fancybox.close();">
                            <span class="slot-btn-text">Hayır</span>
                        </button>
                    </div>
                </div>
            </div>

            <div id="fancyBoxRoulette3" class="fancyboxContentContainer">
                <div id="wheel-help" class="contrast-box">
                    <div class="grey-box ">
                        <h3>50 EP karşılığında Slot Cash oynamak istiyor musunuz?</h3>
                        <button id="startRouletteBtn3" onclick="startRoulette3()" class="btn-price btn-slot start-roulette">
                            <span class="slot-btn-text">Evet</span>
                        </button>
                        <button class="btn-price btn-slot btn-close" onclick="$.fancybox.close();">
                            <span class="slot-btn-text">Hayır</span>
                        </button>
                    </div>
                </div>
            </div>

            <div id="fancyBoxRoulette4" class="fancyboxContentContainer">
                <div id="wheel-help" class="contrast-box">
                    <div class="grey-box ">
                        <h3>100 EP karşılığında Slot Cash oynamak istiyor musunuz?</h3>
                        <button id="startRouletteBtn4" onclick="startRoulette4()" class="btn-price btn-slot start-roulette">
                            <span class="slot-btn-text">Evet</span>
                        </button>
                        <button class="btn-price btn-slot btn-close" onclick="$.fancybox.close();">
                            <span class="slot-btn-text">Hayır</span>
                        </button>
                    </div>
                </div>
            </div>
            <!--Play-->

            <div id="fancyBoxGift" class="fancyboxContentContainer">
                <div id="wheel-help" class="contrast-box">
                    <div class="grey-box ">
                        <h3>Tebrikler Slot Cash'den <span id="giftCash"></span> Ejderha Parası kazandınız!</h3>
                        <p>Ödülü almak için lütfen "Ödülü Al" butonuna tıklayınız. Aksi halde Ejderha Parası hesabınıza yüklenmeyecek!</p>
                        <button id="startRouletteBtn0" onclick="getGift('<?= URI::get_path('wheel/slotGift')?>')" class="btn-price btn-slot start-roulette">
                            <span class="slot-btn-text">Ödülü Al</span>
                        </button>
                    </div>
                </div>
            </div>
            <!--   Fancybox -->
        </div>
    </div>

    <script type="text/javascript" src="<?=URI::public_path('js/roulette.js')?>"></script>
    <script type="text/javascript" src="<?=URI::public_path('js/roulette3.js')?>"></script>
<?php endif;?>