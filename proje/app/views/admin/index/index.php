<?php
    $dashboard = $this->dashboard;
    $red = $dashboard['countRed']['count'];
    $yellow = $dashboard['countYellow']['count'];
    $blue = $dashboard['countBlue']['count'];
    $warrior = $dashboard['countWarrior']['count'];
    $ninja = $dashboard['countNinja']['count'];
    $sura = $dashboard['countSura']['count'];
    $shaman = $dashboard['countShaman']['count'];
    $lycan = $dashboard['countLycan']['count'];
    $epPrice = $dashboard['epPrice'];
	$itemciPrice = $dashboard['ItemciPrice'];
    function convertEp($epList,$ep,$type)
    {
        $result = "";
        if ($type == "itemci")
		    $commission = \StaticDatabase\StaticDatabase::settings('itemci_commission');
        else
			$commission = \StaticDatabase\StaticDatabase::settings('teckcard_commission');
        foreach ($epList as $key=>$row)
        {
            if ($row['ep'] == $ep)
                $result = intval($row['tl']) - (intval($row['tl']) * intval($commission) / 100);
        }
        return $result;
    }
?>
<div class="row">

    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"1a") == true):?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup"
                              data-value="<?= $dashboard['countOnlinePlayer']['count'] ?>"><?= $dashboard['countOnlinePlayer']['count'] ?></span>
                        <small class="font-green-sharp">Kişi</small>
                    </h3>
                    <small>Aktif Oyuncu</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
                </div>
            </div>
        </div>
    </div>
	<?php Cache::open("admin_player_statistic");?>
	<?php if (Cache::check("admin_player_statistic")):?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup"
                              data-value="<?= $dashboard['totalAccount']['count'] ?>"><?= $dashboard['totalAccount']['count'] ?></span>
                        <small class="font-green-sharp">Kişi</small>
                    </h3>
                    <small>Toplam Hesap</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup"
                              data-value="<?= $dashboard['countActive']['count'] ?>"><?= $dashboard['countActive']['count'] ?></span>
                        <small class="font-green-sharp">Kişi</small>
                    </h3>
                    <small>Aktif Hesap</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <?php if (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
						<span data-counter="counterup"
                              data-value="<?= $dashboard['countBanned']['count']+$dashboard['countBannedHwid']['count'] ?>"><?= $dashboard['countBanned']['count']+$dashboard['countBannedHwid']['count'] ?></span>
                        <?php else:?>
						<span data-counter="counterup"
                              data-value="<?= $dashboard['countBanned']['count'] ?>"><?= $dashboard['countBanned']['count'] ?></span>
						<?php endif;?>
						<small class="font-green-sharp">Kişi</small>
                    </h3>
                    <small>Banlı Hesap</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup"
                              data-value="<?= $dashboard['countCharacter']['count'] ?>"><?= $dashboard['countCharacter']['count'] ?></span>
                        <small class="font-green-sharp">Kişi</small>
                    </h3>
                    <small>Toplam Karakter</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup"
                              data-value="<?= $dashboard['countOfflineShop']['count'] ?>"><?= $dashboard['countOfflineShop']['count'] ?></span>
                        <small class="font-green-sharp">Adet</small>
                    </h3>
                    <small>Aktif Pazar</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup"
                              data-value="<?= $dashboard['countToday']['count'] ?>"><?= $dashboard['countToday']['count'] ?></span>
                        <small class="font-green-sharp">Kişi</small>
                    </h3>
                    <small>Günlük Kayıt</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup"
                              data-value="<?= $dashboard['countGuild']['count'] ?>"><?= $dashboard['countGuild']['count'] ?></span>
                        <small class="font-green-sharp">Adet</small>
                    </h3>
                    <small>Toplam Lonca</small>
                </div>
                <div class="icon">
                    <i class="icon-pie-chart"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
	<?php Cache::close("admin_player_statistic");?>
    <?php endif;?>

    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"1b") == true):?>
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption ">
                    <span class="caption-subject font-dark bold uppercase">Bayrak Diagramı</span>
                </div>
            </div>
            <div class="portlet-body">
                <div id="dashboard_amchart_4" class="CSSAnimationChart"></div>
            </div>
        </div>
    </div>
	<?php endif;?>

    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"1c") == true):?>
    <div class="col-lg-6 col-xs-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption ">
                    <span class="caption-subject font-dark bold uppercase">Karakter Diagramı</span>
                </div>
            </div>
            <div class="portlet-body">
                <div id="dashboard_amchart_5" class="CSSAnimationChart"></div>
            </div>
        </div>
    </div>
    <?php endif;?>

    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"1d") == true):?>
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bubble font-dark hide"></i>
                        <span class="caption-subject font-hide bold uppercase">Günlük Satış İstatistikleri</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-3">
                            <!--begin: widget 1-1 -->
                            <div class="mt-widget-1">
                                <div class="mt-img">
                                    <img src="<?=URL.'data/upload/paywant.png'?>" width="150px;"> </div>
                                <div class="mt-body">
                                    <h3 class="mt-username">PAYWANT</h3>
                                    <p class="mt-user-title"> Günlük Paywant kazanç miktarı </p>
                                    <div class="mt-stats">
                                        <div class="btn-group btn-group btn-group-justified">
                                            <a href="javascript:;" class="btn font-blue">
                                                <i class="icon-bag"></i> <?php if ($dashboard['countPaywant'] != null){echo $dashboard['countPaywant'];}else{ echo '0';}?> TL</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: widget 1-1 -->
                        </div>
						<div class="col-md-3">
                            <!--begin: widget 1-1 -->
                            <div class="mt-widget-1">
                                <div class="mt-img">
                                    <img src="<?=URL.'data/upload/kasagame.png'?>" width="150px;"> </div>
                                <div class="mt-body">
                                    <h3 class="mt-username">KASAGAME</h3>
                                    <p class="mt-user-title"> Günlük KasaGame kazanç miktarı </p>
                                    <div class="mt-stats">
                                        <div class="btn-group btn-group btn-group-justified">
                                            <a href="javascript:;" class="btn font-blue">
                                                <i class="icon-bag"></i> <?php if ($dashboard['countKasaGame'] != null){echo $dashboard['countKasaGame'];}else{ echo '0';}?> TL</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: widget 1-1 -->
                        </div>
						<div class="col-md-3">
                            <!--begin: widget 1-1 -->
                            <div class="mt-widget-1">
                                <div class="mt-img">
                                    <img src="<?=URL.'data/upload/payreks2.png'?>" width="150px;"> </div>
                                <div class="mt-body">
                                    <h3 class="mt-username">PAYREKS</h3>
                                    <p class="mt-user-title"> Günlük Payreks kazanç miktarı </p>
                                    <div class="mt-stats">
                                        <div class="btn-group btn-group btn-group-justified">
                                            <a href="javascript:;" class="btn font-blue">
                                                <i class="icon-bag"></i> <?php if ($dashboard['countPayreks'] != null){echo $dashboard['countPayreks'];}else{ echo '0';}?> TL</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: widget 1-1 -->
                        </div>
                        <div class="col-md-3">
                            <!--begin: widget 1-3 -->
                            <div class="mt-widget-1">
                                <div class="mt-img">
                                    <img src="<?=URL.'data/upload/itemci.png'?>" width="150px;"> </div>
                                <div class="mt-body">
                                    <h3 class="mt-username">E-Pin</h3>
                                    <p class="mt-user-title"> Günlük Epin kazanç miktarı </p>
                                    <div class="mt-stats">
                                        <div class="btn-group btn-group btn-group-justified">
                                            <?php
                                            $itemci = null;
                                            foreach ($dashboard['countEpin'] as $row){
                                                $itemci += convertEp($itemciPrice,$row['gain'],"itemci");
                                            }
											$itemci = ($itemci == null) ? 0 : $itemci
                                            ?>
                                            <a href="javascript:;" class="btn font-blue">
                                                <i class="icon-bag"></i> <?= $itemci?> TL </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: widget 1-3 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--        Total Kazanç-->
        <div class="col-lg-12 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-bubble font-dark hide"></i>
						<?php
						$itemci15 = null;
						foreach ($dashboard['getTotalEpin'] as $row){
							$itemci15 += convertEp($itemciPrice,$row['gain'],"itemci");
						}
						$itemci15 = ($itemci15 == null) ? 0 : $itemci15
						?>
                        <span class="caption-subject font-hide bold uppercase">Toplam Satış İstatistikleri (<font color="red"><?php echo $dashboard['getTotalPaywant']+$dashboard['getTotalKasaGame']+$dashboard['getTotalPayreks']+$itemci15; ?> TL</font>)</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-3">
                            <!--begin: widget 1-1 -->
                            <div class="mt-widget-1">
                                <div class="mt-img">
                                    <img src="<?=URL.'data/upload/paywant.png'?>" width="150px;"> </div>
                                <div class="mt-body">
                                    <h3 class="mt-username">PAYWANT</h3>
                                    <p class="mt-user-title"> Toplam Paywant kazanç miktarı </p>
                                    <div class="mt-stats">
                                        <div class="btn-group btn-group btn-group-justified">
                                            <a href="javascript:;" class="btn font-blue">
                                                <i class="icon-bag"></i> <?php if ($dashboard['getTotalPaywant'] != null){echo $dashboard['getTotalPaywant'];}else{ echo '0';}?> TL</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: widget 1-1 -->
                        </div>
						<div class="col-md-3">
                            <!--begin: widget 1-1 -->
                            <div class="mt-widget-1">
                                <div class="mt-img">
                                    <img src="<?=URL.'data/upload/kasagame.png'?>" width="150px;"> </div>
                                <div class="mt-body">
                                    <h3 class="mt-username">KASAGAME</h3>
                                    <p class="mt-user-title"> Toplam KasaGame kazanç miktarı </p>
                                    <div class="mt-stats">
                                        <div class="btn-group btn-group btn-group-justified">
                                            <a href="javascript:;" class="btn font-blue">
                                                <i class="icon-bag"></i> <?php if ($dashboard['getTotalKasaGame'] != null){echo $dashboard['getTotalKasaGame'];}else{ echo '0';}?> TL</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: widget 1-1 -->
                        </div>
						<div class="col-md-3">
                            <!--begin: widget 1-1 -->
                            <div class="mt-widget-1">
                                <div class="mt-img">
                                    <img src="<?=URL.'data/upload/payreks2.png'?>" width="150px;"> </div>
                                <div class="mt-body">
                                    <h3 class="mt-username">PAYREKS</h3>
                                    <p class="mt-user-title"> Toplam Payreks kazanç miktarı </p>
                                    <div class="mt-stats">
                                        <div class="btn-group btn-group btn-group-justified">
                                            <a href="javascript:;" class="btn font-blue">
                                                <i class="icon-bag"></i> <?php if ($dashboard['getTotalPayreks'] != null){echo $dashboard['getTotalPayreks'];}else{ echo '0';}?> TL</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: widget 1-1 -->
                        </div>
                        <div class="col-md-3">
                            <!--begin: widget 1-3 -->
                            <div class="mt-widget-1">
                                <div class="mt-img">
                                    <img src="<?=URL.'data/upload/itemci.png'?>" width="150px;"> </div>
                                <div class="mt-body">
                                    <h3 class="mt-username">E-Pin</h3>
                                    <p class="mt-user-title"> Toplam Epin kazanç miktarı </p>
                                    <div class="mt-stats">
                                        <div class="btn-group btn-group btn-group-justified">
											<?php
											$itemci1 = null;
											foreach ($dashboard['getTotalEpin'] as $row){
												$itemci1 += convertEp($itemciPrice,$row['gain'],"itemci");
											}
											$itemci1 = ($itemci1 == null) ? 0 : $itemci1
											?>
                                            <a href="javascript:;" class="btn font-blue">
                                                <i class="icon-bag"></i> <?= $itemci1?> TL </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: widget 1-3 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"1e") == true):?>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Channel Boot Log</span>
                        <span class="caption-helper">Son 10 Kayıt</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                            <tr class="uppercase">
                                <th> # </th>
                                <th> Kanal </th>
                                <th> Kanal Adı </th>
                                <th> Tarih </th>
                            </tr>
                            </thead>
                            <?php foreach ($dashboard['coreLog'] as $key=>$row):?>
                                <tr>
                                    <td> <?=$key+1;?> </td>
                                    <td> <?=$row['channel']?> </td>
                                    <td> <?=$row['hostname']?> </td>
                                    <td>
                                        <?=Functions::zaman($row['time']);?>
                                    </td>
                                </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>
    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"1f") == true):?>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-dark bold uppercase">Command Log</span>
                        <span class="caption-helper">Son 10 Kayıt</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                            <tr class="uppercase">
                                <th> # </th>
                                <th> Adı </th>
                                <th> Komut </th>
                                <th> İp </th>
                                <th> Tarih </th>
                            </tr>
                            </thead>
                            <?php foreach ($dashboard['commandLog'] as $key=>$row):?>
                                <tr>
                                    <td> <?=$key+1;?> </td>
                                    <td> <?=$row['username']?> </td>
                                    <td> <?=Functions::utf8(Functions::replace_tr(substr($row['command'], 0, 15)));?> </td>
                                    <td> <?=$row['ip']?> </td>
                                    <td><?=Functions::zaman($row['date']);?></td>
                                </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif;?>

</div>