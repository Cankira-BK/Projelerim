<?php
$packList = $this->pack;
?>
<div class="main-panel panel-download">
    <div class="main-header">
		<?=$lng[0]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <div class="bg-light download">
                        <table>
                            <tbody>
                            <tr>
                                <th><center><?=$lng[52]?></center></th>
                                <th><center><?=$lng[53]?></center></th>
                                <th><center><?=$lng[54]?></center></th>
                                <th><center><?=$lng[55]?></center></th>
                            </tr>

                            <?php foreach ($packList as $pack):?>
									<tr>
                                    <td><center><?=$pack->name?></center></td>
                                    <td><center><?=$pack->size?></center></td>
                                    <td><img src="<?=$pack->image?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>" width="70px;"></td>
                                    <td><a href="<?=$pack->url?>" target="_blank" class="download-grey"></a></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-light">
                        <h3><?=$lng[56]?></h3>
                        <div class="col-50">
                            <strong><?=$lng[57]?></strong><br><br>
                            <strong><?=$lng[58]?>:</strong> Windows Vista, 7<br>
                            <strong>CPU:</strong> Pentium 3 800MHz or higher<br>
                            <strong>RAM:</strong> 256MB<br>
                            <strong>VGA:</strong> 3D GeForce2 or ATI 9000<br>
                            <strong>HDD:</strong> 1,5 GB<br><br>
                        </div>
                        <div class="col-50">
                            <strong><?=$lng[59]?></strong><br><br>
                            <strong><?=$lng[58]?>:</strong> Windows Vista, 7<br>
                            <strong>CPU:</strong> Pentium 4 2.4GHz or higher<br>
                            <strong>RAM:</strong> 512MB<br>
                            <strong>VGA:</strong> 3D GeForce FX 5600 or ATI9500<br>
                            <strong>HDD:</strong> 2 GB<br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>