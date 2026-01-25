<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 31.01.2017
     * Time: 00:23
     */
    $item = $this->information['item'][0];
    ?>
<div id="contentContainer">
    <div class="content clearfix">

        <div id="error" class="contrast-box">
            <div class="dark-grey-box">
                <div><img src="<?=URL.$item['item_image'];?>" alt="" style="margin-left: auto;margin-right:auto;display: block;"></div>
                <center><h2><?=$item['item_name'];?></h2></center>
                <ul class="clearfix"></ul>
                <center><h3>Eşya Nesne Market Deponuza Eklenmiştir.</h3></center>
                <ul class="clearfix"></ul>
                    <center><h3>Kalan Ep Miktarı : <?=$coins?> EP</h3></center>
                <div class="btn_wrapper">
                    <a href="<?=URI::get_path('wheel')?>"><button class="btn-default" style="margin-left: auto;margin-right: auto;display: block;">Tekrar Oyna</button></a>
                </div>
            </div>
        </div>


    </div>
    <div id="overlayMask"></div>
</div><!-- close contentContainer -->
