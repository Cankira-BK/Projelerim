<?php
    $depo = $this->coupon['depo'];
?>
<div class="content clearfix" id="wt_refpoint">
    <div id="account" class="mCSB_container row-fluid ">
        <ul id="accountNav" class="span3">
            <li><a href="<?=URI::get_path('nav/characters')?>" class="btn-sideitem "><i class="icon-users"></i><span>Karakterlerim</span></a></li>
            <li><a href="<?=URI::get_path('nav/log')?>" class="btn-sideitem "><i class="icon-basket"></i><span>Satın aldıklarım</span></a></li>
            <li><a href="<?=URI::get_path('nav/depo')?>" class="btn-sideitem "><i class="icon-stack"><div class="badge"><?=$depo?></div></i><span>Eşya Depom</span></a></li>
            <li><a href="<?=URI::get_path('nav/coupon')?>" class="btn-sideitem btn-sideitem-active"><i class="icon-barcode"></i><span>Kodu kullan</span></a></li>
        </ul>

        <!--Testing purposes -->
        <script type="text/javascript">
            zs.data.ttip = {
                defaultPosition: 'right',
                attribute: 'tooltip-content',
                delay:500
            }
        </script>     <div id="accountContent" class="span11 redeem-code">
            <h2>Kodu kullan</h2>
            <div class="scrollable_container">
                <div class="inside_scrollable_container">
                    <div class="contrast-box clearfix">
                        <div class="grey-box">
                            <p class="code-info">İkramiyeni kazanmak için kodunu gir. Sonra bir onay alacaksın ve maceran için kullanıma açılan tüm nesnelerin görüntülenecek.</p>
                            <img class="code-avatar" src="//gf2.geo.gfsrv.net/cdnd4/5fe5c2229accf4c9beb278c2d25bf9.png">


                            <label class="code-label">Kodun:</label>
                            <form action="<?=URI::get_path('nav/controlCoupon')?>" method="post">
                            <input type="text" name="code" id="code" class="span7" size="30" placeholder="Kodunu gir" />
                            <button class="btn-default span3 " type="submit" id="submitCode">Kullan</button>
                            </form>
                            <div id="ajaxresult"></div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
    </script>                </div>
<!-- /content -->
