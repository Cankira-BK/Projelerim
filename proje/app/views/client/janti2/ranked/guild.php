<?php
    function jobName($value){
        if ($value == 0 || $value == 4){
            return 'Savaşçı';
        }elseif ($value == 1 || $value == 5){
            return 'Ninja';
        }elseif ($value == 2 || $value == 6){
            return 'Sura';
        }elseif ($value == 3 || $value == 7){
            return 'Şaman';
        }elseif ($value == 8){
            return 'Lycan';
        }
    }
    function playerStat($date){
        $now = date( 'Y-m-d H:i:s', strtotime('-30 minutes'));
        if ($now > $date){
            return false;
        }elseif ($now <= $date){
            return true;
        }
    }

?>
<main class="content fontSizeOnUc">
<div class="panel panel-buyuk">
<div class="panel-heading">
<center>
<?=$lng[177]?> </center>
</div>
<div class="panel-body no-padding">
<table class="table table-monster siralama">
<thead>
<tr>
<td>#</td>
<td>Lonca Adı</td>
<td>Seviye</td>
<td>Puan</td>
<td class="hidden-xs">Krallık</td>
<td class="hidden-xs">Kazanma</td>
<td class="hidden-xs">Beraberlik</td>
<td class="hidden-xs">Kaybetme</td>
</tr>
</thead>
<tbody>
						<?php Cache::open('guilds');?>
						<?php if (Cache::check('guilds')):?>
							<?php foreach ($this->views['data'] as $key=>$row):?>
<tr class="renk-purple">
<td><?=($key+1)?></td>
<td><?=$row['lonca']?></td>
<td><?=$row['level']?></td>
<td><?=$row['ladder_point']?></td>
<td class="hidden-xs"><img src="<?=URL.'data/flags/'.$row['bayrak'].'.png'?>" alt=""></td>
<td class="hidden-xs"><?=$row['win']?></td>
<td class="hidden-xs"><?=$row['draw']?></td>
<td class="hidden-xs"><?=$row['loss']?></td>
</tr>
							<?php endforeach;?>
						<?php endif;?>
						<?php Cache::close('guilds');?>
</tbody>
</table>
</div>
</div>
</main>
