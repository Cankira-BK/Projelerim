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
            <h2 class="head"><?=$lng[177]?></h2>
            <div class="body">
                <div  style="margin-left:10px;margin-bottom:20px;text-align: center;">
                    <a href="<?=URI::get_path('ranked/player')?>"  class="nice_button ">Oyuncu Sıralaması</a>
                    <a href="javascript:void(0);"  class="nice_button ">Lonca Sıralaması</a>
                    <div class="ucp_divider"></div>
                </div>
				<?php if (\StaticDatabase\StaticDatabase::settings('guild_rank_status') == "0"):?>
					<?php  echo Client::alert('error',"Lonca sıralaması şuanda kapalı!");?>
				<?php else:?>
                    <table id="large" cellspacing="0" class="tablesorter">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?=$lng[67]?></th>
                        <th><?=$lng[71]?></th>
                        <th><?=$lng[37]?></th>
                        <th><?=$lng[44]?></th>
                        <th><?=$lng[72]?></th>
                    </tr>
                    </thead>
                    <tbody>
					<?php Cache::open('guilds');?>
					<?php if (Cache::check('guilds')):?>
						<?php foreach ($this->views['data'] as $key=>$row):?>
                            <tr>
                                <td><?=($key+1)?></td>
                                <td><a href="<?=URI::get_path('detail/guild/'.$row['lonca'])?>" title="<?=$row['lonca']?>"><?=$row['lonca']?></a></td>
                                <td><?=$row['ladder_point']?></td>
                                <td><img src="<?=URL.'data/flags/'.$row['bayrak'].'.png'?>" alt=""></td>
                                <td><a rel="nofollow" href="<?=URI::get_path('detail/player/'.$row['baskan'])?>"><?=$row['baskan'];?></a></td>
                                <td><span class="label label-green"><?=$row['win']?></span> | <span class="label label-draw"><?=$row['draw']?></span> | <span class="label label-red"><?=$row['loss']?></span></td>
                            </tr>
						<?php endforeach;?>
					<?php endif;?>
					<?php Cache::close('guilds');?>
                    </tbody>
                </table>
                <?php endif;?>
            </div>
        </article>
    </div>
</aside>
