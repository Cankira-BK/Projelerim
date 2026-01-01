<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 31.01.2017
     * Time: 11:22
     */
    $control = $this->control;
    ?>
<div id="contentContainer">
    <div class="content clearfix">
        <?php if ($control['result'] == false): ?>
            <div id="error" class="contrast-box">
                <div class="dark-grey-box">
                    <h2><i class="icon-info left"></i>Hata</h2>
                    <br>
                    <h3>Kupon Kodu Bulunamadı.</h3>
                    <ul class="clearfix">
                        <li>Bu pencereyi kapat ve tekrar dene</li>
                    </ul>
                    <div class="btn_wrapper">
                    </div>
                </div>
            </div>
        <?php elseif ($control['result'] == true):?>
            <div id="error" class="contrast-box">
                <div class="dark-grey-box">
                    <center><h2><i class="fa fa-check"></i>Başarılı</h2></center>
                    <ul class="clearfix"></ul>
                    <center><h3>Kupon EP Miktarı : <?=$control['coins']?> EP</h3></center>
                    <ul class="clearfix"></ul>
                    <?php if (\StaticDatabase\StaticDatabase::settings('happy_hour')):?>
                        <center><h3>Mutlu Saatler Kazancı (%<?=\StaticDatabase\StaticDatabase::settings('happy_hour_discount')?>) : <?=(intval($control['coins']) * intval(\StaticDatabase\StaticDatabase::settings('happy_hour_discount')) / 100)?> EP</h3></center>
                        <ul class="clearfix"></ul>
                    <?php endif;?>
                    <center><h3>Mevcut Ep Miktarı : <?=$coins?> EP</h3></center>
                    <div class="btn_wrapper">
                        <a href="<?=URI::get_path('index')?>"><button class="btn-default" style="margin-left: auto;margin-right: auto;display: block;">Anasayfa</button></a>
                    </div>
                </div>
            </div>
        <?php endif;?>

    </div>
    <div id="overlayMask"></div>
</div><!-- close contentContainer -->
