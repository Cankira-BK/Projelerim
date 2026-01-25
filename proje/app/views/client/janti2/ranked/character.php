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
               <?=$lng[176]?> </center>
        </div>
        <div class="panel-body no-padding">
            <table class="table table-monster siralama">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Karakter Adı</td>
                        <td>Seviye</td>
                        <td class="hidden-xs">Lonca</td>
                        <td class="hidden-xs">Oyun Süresi</td>
                        <td class="hidden-xs">Krallık</td>
                    </tr>
                </thead>
                <tbody>
										<?php Cache::open('players');?>
						<?php if (Cache::check('players')):?>
							<?php foreach ($this->views['data'] as $key=>$row):?>
                    <tr class="renk-purple">
                        <td><?=($key+1)?></td>
                        <td><?=$row['name']?></td>
                        <td><?=$row['level']?></td>
						<?php if ($row['guild_name'] != null):?>
                        <td class="hidden-xs"><?=$row['guild_name'];?></td>
						<?php else:?>
						<td class="hidden-xs">YOK</td>
						<?php endif;?>
                        <td class="hidden-xs"><?=$row['playtime']?></td>
                        <td class="hidden-xs"><img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></td>
                    </tr>
							<?php endforeach;?>
						<?php endif;?>
						<?php Cache::close('players');?>
                </tbody>
            </table>
        </div>
    </div>
</main>