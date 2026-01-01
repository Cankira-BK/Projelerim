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
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<div class="panel-heading"><h2 class="head"><?=$lng[176]?></h2></div>
            <div class="body">
                <div  style="margin-left:10px;margin-bottom:20px;text-align: center;">
					<a href="javascript:void(0);"><button class="btn btn-giris"><?=$lng[176]?></button></a>
					<a href="<?=URI::get_path('ranked/guild')?>"><button class="btn btn-giris"><?=$lng[177]?></button></a>
                    <div class="ucp_divider"></div>
                </div>
				<?php if (\StaticDatabase\StaticDatabase::settings('player_rank_status') == "0"):?>
					<?php  echo Client::alert('error',"Oyuncu sıralaması şuanda kapalı!");?>
				<?php else:?>
                    <table id="large" cellspacing="0" class="tablesorter">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?=$lng[67]?></th>
                            <th><?=$lng[68]?></th>
                            <th><?=$lng[37]?></th>
                            <th><?=$lng[38]?></th>
                            <th><?=$lng[40]?></th>
                        </tr>
                        </thead>
                        <tbody>
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
                                            <b style="color: #8b303d">Yok</b>
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
        </article>
    </div>
</aside>