<div class="content clearfix" id="wt_refpoint">

    <div class="scrollable_container" style="margin-top: 30px;">
        <style>
            .center > a:hover, .center > a:active {
                text-decoration: none;
            }
            .center {
                display: flex;
                flex-wrap: wrap;
                width: 49%;
                float: left;
            }

            .amount {
                font-size: 14px;
                font-family: 'Concert One', cursive;
                padding: 5px;
            }

            table .tr-odd {
                background: rgba(165, 154, 114, 0.15);
            }
            .buy-box{
                background-image: url(<?= URI::public_path('images/ltr-box2.png') ?>);
                background-repeat: no-repeat;
                width: 385px;
                height: 67px;
            }
            .buy-box:hover {
                -ms-transform: scale(1.05);
                -moz-transform: scale(1.05);
                -webkit-transform: scale(1.05);
                -o-transform: scale(1.05);
                transform: scale(1.05);
            }
            .buy-box img{
                margin-left: auto;
                margin-right: auto;
                display: block;
                padding: 17px;
            }
        </style>
		
        <div class="inside_scrollable_container">
             <div class="center">
			
			
                <?php if (\StaticDatabase\StaticDatabase::settings('paywant_status')):?>
                    <a href="<?= URI::get_path('/buy/paywant#paywantModal') ?>" style="margin: 5px;">
                        <div class="buy-box">
                            <img src="<?= URI::public_path('images/paywant.png')?>" title="paywant">
                        </div>
                    </a>
                <?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('kasagame_status')):?>
                    <a href="<?=URI::get_path('buy/kasagame')?>" style="margin: 5px;">
                        <div class="buy-box">
                            <img src="<?= URI::public_path('images/kasagame.png')?>" title="kasagame">
                        </div>
                    </a>
                <?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('payreks_status')):?>
					<li class="has-subnavi2">
						<a class="btn-catitem-active" href="<?=URI::get_path('buy/payreks')?>">
							<img style="width: 82px;" src="<?=URI::public_path('images/payreks.png')?>" class="icon"></a>
					</li>
				<?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('itemci_status')):?>
                    <a id="itemci" href="<?=\StaticDatabase\StaticDatabase::settings('itemci_link')?>" target="_blank" style="margin: 5px;">
                        <div class="buy-box">
                            <img src="<?= URI::public_path('images/itemci.png') ?>" title="itemci">
                        </div>
                    </a>
				<?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('itemsultan_status')):?>
                    <a id="itemci" href="<?=\StaticDatabase\StaticDatabase::settings('itemsultan_link')?>" target="_blank" style="margin: 5px;">
                        <div class="buy-box">
                            <img src="<?= URI::public_path('images/itemsultan.png') ?>" title="itemsultan">
                        </div>
                    </a>
				<?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('oyunalisverisi_status')):?>
                    <a id="itemci" href="<?=\StaticDatabase\StaticDatabase::settings('oyunalisverisi_link')?>" target="_blank" style="margin: 5px;">
                        <div class="buy-box">
                            <img src="<?= URI::public_path('images/oyunalisveris_logo.png') ?>" title="oyunalisveris">
                        </div>
                    </a>
				<?php endif;?>
            </div>
            <table class="ep-list table table-hover" style="background:#eade9e repeat scroll 0 0/cover;width:33%;display: block;float: right;">
			<tbody>
                <?php if(\StaticDatabase\StaticDatabase::settings('happy_hour')):?>
                    <tr style="background: white;">
                        <th colspan="2">
                            <small style="display:block; text-align:center;color: red">
                                Mutlu Saatler Etkinliği kapsamında alacağınız ejderha parasına ek %<?=\StaticDatabase\StaticDatabase::settings('happy_hour_discount')?> ejderha parası hediye
                            </small>
                        </th>
                    </tr>
                <?php endif;?>
                <tr style="background: white;">
                    <th style="width: 50%;">
                        <center>TUTAR</center>
                    </th>
                    <th>
                        <center>EJDERHA PARASI</center>
                    </th>
                </tr>
				<?php foreach ($this->result['ep_price'] as $row): ?>
                    <tr>
                        <td>
                            <center><?= $row['tl'] ?> TL</center>
                        </td>
                        <td>
                            <center>
                                <?= $row['ep'] ?>
								<?php if(\StaticDatabase\StaticDatabase::settings('happy_hour')):?>
                                +
                                <?=ceil(intval($row['ep']) * intval(\StaticDatabase\StaticDatabase::settings('happy_hour_discount')) / 100);?>
								<?php endif;?>
                                EP
                            </center>
                        </td>
                    </tr>
				<?php endforeach; ?>
                <tr style="background: white;">
                    <th colspan="2">
                        <small style="display:block; text-align:center;">
                            Ödeme yöntemine göre fiyat ya da EP miktarı değişebilmektedir.
                        </small>
                    </th>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>