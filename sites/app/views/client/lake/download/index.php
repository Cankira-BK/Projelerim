<?php
$packList = $this->all;
?>
<div class="title">
	<?=$lng[0]?>
</div>
<div class="news page">
    <table class="sidebar_rank">
        <thead>
        <tr>
            <th><?=$lng[52]?></th>
            <th><?=$lng[53]?></th>
            <th><?=$lng[54]?></th>
            <th><?=$lng[55]?></th>
        </tr>
        </thead>
        <tbody>
		<?php foreach ($this->pack as $key => $row):?>
            <tr>
                <td><?=$row['name'];?></td>
                <td><?=$pack->size;?></td>
                <td>
                    <a href="<?=$row['url']?>" target="_blank">
                        <img src="<?=$pack->image?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>" width="70px;">
                    </a>
                </td>
                <td>
                    <a href="<?=$row['url']?>" target="_blank" class="green-button" style="padding: 3px;margin-right: 15px;"><?=$lng[175]?></a>
                </td>
            </tr>
		<?php endforeach;?>
        </tbody>
    </table>
    <br>
    <div class="bg-light">
        <h3><?=$lng[56]?></h3>
        <div class="col-50 central">
            <strong class="wheat"><?=$lng[57]?></strong><br><br>
            <strong><?=$lng[58]?>:</strong> Windows Vista, 7<br>
            <strong>CPU:</strong> Pentium 3 800MHz or higher<br>
            <strong>RAM:</strong> 256MB<br>
            <strong>VGA:</strong> 3D GeForce2 or ATI 9000<br>
            <strong>HDD:</strong> 1,5 GB<br><br>
        </div>
        <div class="col-50 central">
            <strong class="wheat"><?=$lng[59]?></strong><br><br>
            <strong><?=$lng[58]?>:</strong> Windows Vista, 7<br>
            <strong>CPU:</strong> Pentium 4 2.4GHz or higher<br>
            <strong>RAM:</strong> 512MB<br>
            <strong>VGA:</strong> 3D GeForce FX 5600 or ATI9500<br>
            <strong>HDD:</strong> 2 GB<br><br>
        </div>
    </div>
</div>