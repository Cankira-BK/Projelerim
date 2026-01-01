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
                                    <th><?=$lng[33]?></th>
                                    <th><?=$lng[41]?></th>
                                </tr>
								<?php Cache::open('players');?>
								<?php if (Cache::check('players')):?>
									<?php foreach ($this->views['data'] as $key=>$row):?>
                                        <tr>
                                            <td><?=($key+1)?></td>
                                            <td><a rel="nofollow" href="<?=URI::get_path('detail/player/'.$row['name'])?>" title="<?=Functions::jobName($row['job'])?>"><?=$row['name']?></a></td>
                                            <td><?=$row['level']?></td>
                                            <td>
                                                <img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
                                            </td>
                                            <td>
												<?php if ($row['guild_name'] != null):?>
                                                    <a href="<?=URI::get_path('detail/guild/'.$row['guild_name'])?>"><?=$row['guild_name'];?></a>
												<?php else:?>
                                                    <b style="color: #8b303d"><?=$lng[70]?></b>
												<?php endif;?>
                                            </td>
                                            <td>
                                                <img src="<?=URL.'data/chrs/small/'.$row['job'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
                                            </td>
                                            <td>
                                                <center>
                                                    <img class="class-portrait" src="<?=URL.'data/chrs/small/'.Functions::playerOnlineStatus($row['last_play']).'.png'?>"/>
                                                </center>
                                            </td>
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