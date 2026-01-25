<?php
    $depos = $this->depo['depos'];
    $server = StaticDatabase\StaticDatabase::settings('oyun_adi');
    $depo = $this->depo['depo'];
?>
<div class="content clearfix" id="wt_refpoint">
    <div id="account" class="mCSB_container row-fluid">
        <ul id="accountNav" class="span3">
            <li>
                <a href="<?=URI::get_path('nav/characters')?>"
                   class="btn-sideitem"><i class="icon-users"></i><span>Karakterlerim</span></a>
            </li>
            <li>
                <a href="<?=URI::get_path('nav/log')?>"
                   class="btn-sideitem"><i class="icon-basket"></i><span>Satın aldıklarım</span></a>
            </li>
            <li>
                <a href="<?=URI::get_path('nav/depo')?>"
                   class="btn-sideitem  btn-sideitem-active"><i class="icon-stack">
                        <div class="badge"><?=$depo?></div>
                    </i><span>Eşya Depom</span></a>
            </li>
            <li>
                <a href="<?=URI::get_path('nav/coupon')?>"
                   class="btn-sideitem "><i class="icon-barcode"></i><span>Kodu kullan</span></a>
            </li>
        </ul>

        <!--Testing purposes -->
        <script type="text/javascript">
            zs.data.ttip = {
                defaultPosition: 'right',
                attribute: 'tooltip-content',
                delay: 500
            }
        </script>
        <div id="accountContent" class="span11 players">
            <h2>Eşya Depom (<?=$depo?>)</h2>
            <div class="scrollable_container">
                <div class="inside_scrollable_container">
                        <?php if($depo == 0): ?>
                            <h3>Nesne marketinde hiç eşyan yok.</h3>
                        <?php else:?>
                            <ul class="character_list clearfix playerSelection">
                            <?php foreach ($depos as $key=>$row):?>
                                <li  style="width: 148px;" id="img" class="no-margin" data-server-name="<?=$server;?>" title="<?=Functions::turkce_karakter($row['locale_name']);?>">
                                    <div class="inner_box clearfix" style="height: 97px;">
                                        <img src="<?=URL.'data/items/'.Functions::itemToPng($row['vnum']);?>" onerror="this.src='<?=URL.'data/items/60001.png'?>'" alt="<?=Functions::turkce_karakter($row['locale_name']);?>"/>
										<p style="text-align: center">
                                            <strong><?=Functions::turkce_karakter($row['locale_name']);?></strong>
                                        </p>
									</div>
                                </li>
                            <?php endforeach;?>
                    </ul>
                        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content -->
