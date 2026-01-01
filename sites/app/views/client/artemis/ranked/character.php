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

<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1125px;">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[65]?>
            </div>
            <div class="panel-body no-padding">
				<?php if (\StaticDatabase\StaticDatabase::settings('player_rank_status') == "0"):?>
					<?php  echo Client::alert('error',"Oyuncu sıralaması şuanda kapalı!");?>
				<?php else:?>
                    <table class="table table-hermes">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td style="text-align:left;"><?=$lng[67]?></td>
                            <td class="hidden-xs"><?=$lng[68]?></td>
                            <td><?=$lng[48]?></td>
                            <td class="hidden-xs"><?=$lng[69]?></td>
                            <td class="hidden-xs"><?=$lng[40]?></td>
                        </tr>
                        </thead>
                        <tbody>
						<?php Cache::open('players');?>
						<?php if (Cache::check('players')):?>
							<?php foreach ($this->views['data'] as $key=>$row):?>
                                <tr>
                                    <td><?=($key+1)?></td>
                                    <td style="text-align:left;"><a href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></td>
                                    <td class="hidden-xs"><?=$row['level']?></td>
                                    <td><img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></td>
                                    <td class="hidden-xs">
										<?php if ($row['guild_name'] != null):?>
                                            <a href="<?=URI::get_path('detail/guild/'.$row['guild_name'])?>"><?=$row['guild_name'];?></a>
										<?php else:?>
                                            <b style="color: #8b303d"><?=$lng[70]?></b>
										<?php endif;?>
                                    </td>
                                    <td class="hidden-xs"><?=$row['playtime']?></td>
                                </tr>
							<?php endforeach;?>
						<?php endif;?>
						<?php Cache::close('players');?>
                        </tbody>
                    </table>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
