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
<div class="main-panel panel-download">

    <div class="main-header">
		<?=$lng[65]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <div class="bg-dark">
                        <div class="col-50">
                            <a class="btn active" href="javascript:void(0);"><?=$lng[65]?></a>
                        </div>
                        <div class="col-50">
                            <a class="btn" href="<?=URI::get_path('ranked/guild')?>"><?=$lng[66]?></a>
                        </div>
                    </div>
                    <div class="bg-light ranking">
                        <?php if (\StaticDatabase\StaticDatabase::settings('player_rank_status') == "0"):?>
                            <?php  echo Client::alert('error',"Oyuncu sıralaması şuanda kapalı!");?>
                        <?php else:?>
                            <table>
                                <tbody>
                                <tr>
                                    <th>#</th>
                                    <th><?=$lng[67]?></th>
                                    <th><?=$lng[68]?></th>
                                    <th><?=$lng[48]?></th>
                                    <th><?=$lng[69]?></th>
                                    <th><?=$lng[40]?></th>
                                </tr>
								<?php Cache::open('players');?>
								<?php if (Cache::check('players')):?>
									<?php foreach ($this->views['data'] as $key=>$row):?>
                                        <tr>
                                            <td><?=($key+1)?></td>
                                            <td><a rel="nofollow" href="<?=URI::get_path('detail/player/'.$row['name'])?>" title="<?=jobName($row['job'])?>"><?=$row['name']?></a></td>
                                            <td><?=$row['level']?></td>
                                            <td><img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></td>
                                            <td>
												<?php if ($row['guild_name'] != null):?>
                                                    <a href="<?=URI::get_path('detail/guild/'.$row['guild_name'])?>"><?=$row['guild_name'];?></a>
												<?php else:?>
                                                    <b style="color: #8b303d"><?=$lng[70]?></b>
												<?php endif;?>
                                            </td>
                                            <td><?=$row['playtime']?></td>
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
    </div>
    <div class="main-bottom"></div>
</div>