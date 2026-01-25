<div class="row">
<div class="col-md-9 normal-content">
    <div class="col-md-12 no-padding-all">
        <center><h3><?=$lng[0]?></h3></center>
        <h2 class="brackets"></h2>
    </div>
    <div class="col-md-12">
		<?php if ($this->pack == false):?>
            Sayfa Bulunamadı
		<?php else:?>
            <div id="ranking-result" style="margin-top: 18px;"><div class="container-tab rankings-cont">
                    <table class="table table-rankings">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td><?=$lng[52]?></td>
                            <td><?=$lng[53]?></td>
                            <td><?=$lng[54]?></td>
                            <td><?=$lng[55]?></td>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($this->pack as $key=>$row):?>
                            <tr>
                                <td><span class="badge-rank rank-10"><?=$key+1;?></span></td>
                                <td>
									<?=$row['name'];?>
                                </td>
                                <td><?=$row['size'];?></td>
                                <td><img src="<?=$row['image'];?>" width="80px;" alt=""></td>
                                <td>
                                    <a href="<?=$row['url']?>" target="_blank"><button type="submit" class="btn btn-grunge">İndİr</button></a>
                                </td>
                            </tr>
						<?php endforeach; ?>
                        </tbody>
                    </table>
                </div></div>
		<?php endif;?>
    </div>


    <div class="row">
        <div class="col-md-12 separator"></div>
    </div>
    <h3 class="page-subtitle"><span class="glyphicon glyphicon-chevron-right"></span> <?=$lng[56]?></h3>
    <div class="col-md-12 no-padding-all">
        <table class="table table-specs">
            <colgroup>
                <col width="99">
                <col width="*">
                <col width="262">
            </colgroup>
            <thead>
            <tr>
                <th class="first">
                    <div>Sınıflandırma<!--Classification--></div>
                </th>
                <th>
                    <div><?=$lng[57]?><!--Min. Specification--></div>
                </th>
                <th>
                    <div><?=$lng[59]?><!--Required Specification--></div>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>CPU</th>
                <td>Pentium 3 800MHz or higher<!--Pentium 3 800MHz or higher--></td>
                <td>Pentium 4 2.4GHz or higher<!--Pentium 4 2.4GHz or higher--></td>
            </tr>
            <tr>
                <th>RAM</th>
                <td>256MB</td>
                <td>512MB</td>
            </tr>
            <tr>
                <th>VGA</th>
                <td>3D speed over GeForce2 or ATI 9000<!--3D speed over GeForce2 or ATI 9000--></td>
                <td>3D speed over GeForce FX 5600 or ATI9500<!--3D speed over GeForce FX 5600 or ATI9500--></td>
            </tr>
            <tr>
                <th>SOUND<!--SOUND--></th>
                <td>DirectX 9.0c Compatibility card<!--DirectX 9.0c Compatibility card--></td>
                <td>DirectX 9.0c Compatibility card<!--DirectX 9.0c Compatibility card--></td>
            </tr>
            <tr>
                <th>HDD</th>
                <td>4GB or higher(including swap and temporary file)
                    <!--4GB or higher(including swap and temporary file)--></td>
                <td>4GB or higher(including swap and temporary file)
                    <!--4GB or higher(including swap and temporary file)--></td>
            </tr>
            <tr>
                <th>OS</th>
                <td>Windows XP</td>
                <td>Windows Vista, 7, 8, 10 (Or latest version from Microsoft Windows)</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
