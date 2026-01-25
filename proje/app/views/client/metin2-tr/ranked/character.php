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
<div role="main" id="highscore">
<div class="content content-last">
    <div class="content-bg">
        <div class="content-bg-bottom">
            <h2><?=$lng[65]?></h2>
            <div class="ranks-inner-content"><br>
                <div class="ranks-nav prev prev-top">&nbsp;</div>

                <div class="ranks-nav next next-top"><a href="javascript:void(0)"></a></div>
                <br class="clearfloat">
                <div class="bg-dark">
                    <div class="col-50">
                        <a class="btn active" href="javascript:void(0);" style="float: left;margin-right: 50px;margin-left: 50px;margin-bottom: 15px;margin-top: 15px;"><?=$lng[65]?></a>
                    </div>
                    <div class="col-50">
                        <a class="btn" href="<?=URI::get_path('ranked/guild')?>" style="float: left;margin-right: 50px;margin-left: 50px;margin-bottom: 15px;margin-top: 15px;"><?=$lng[66]?></a>
                    </div>
                </div>
                <br>
                <br>
                <br>
				<?php if (\StaticDatabase\StaticDatabase::settings('player_rank_status') == "0"):?>
					<?php  echo Client::alert('error',"Oyuncu sıralaması şuanda kapalı!");?>
				<?php else:?>
                    <table border="0" style="table-layout:fixed">
                        <thead>
                        <tr>
                            <th class="rank-th-1"><?=$lng[178]?></th>
                            <th class="rank-th-2"><?=$lng[35]?></th>
                            <th class="rank-th-3"><?=$lng[37]?></th>
                            <th class="rank-th-4"><?=$lng[68]?></th>
                            <th class="rank-th-5"><?=$lng[69]?></th>
                        </tr>
                        </thead>
                        <tbody>
						<?php Cache::open('players');?>
						<?php if (Cache::check('players')):?>
							<?php foreach ($this->views['data'] as $key=>$row):?>
								<?php if ($key % 2 == 0):?>
                                    <tr class="rankfirst zebra">
                                        <td class="rank-td-1-1"><?=($key+1)?></td>
                                        <td class="rank-td-1-2"><?=$row['name']?></td>
                                        <td class="rank-td-1-3"><img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" width="34" alt="Chunjo Krallığı" title="Chunjo Krallığı"></td>
                                        <td class="rank-td-1-4"><?=$row['level']?></td>
                                        <td class="rank-td-1-5"><?=$row['guild_name'];?></td>
                                    </tr>
								<?php else:?>
                                    <tr>
                                        <td class="rank-td-1-1"><?=($key+1)?></td>
                                        <td class="rank-td-1-2"><?=$row['name']?></td>
                                        <td class="rank-td-1-3"><img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" width="34" alt="Chunjo Krallığı" title="Chunjo Krallığı"></td>
                                        <td class="rank-td-1-4"><?=$row['level']?></td>
                                        <td class="rank-td-1-5"><?=$row['guild_name'];?></td>
                                    </tr>
								<?php endif;?>
							<?php endforeach;?>
						<?php endif;?>
						<?php Cache::close('players');?>
                        </tbody>
                    </table>
                <?php endif;?>
                <div class="clearfloat"></div>
                <div class="box-foot"></div>
            </div>
        </div>
    </div>
</div>
</div>