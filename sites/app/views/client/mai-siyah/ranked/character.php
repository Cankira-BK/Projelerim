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
<div class="row">
    <div class="col-md-9 normal-content">
        <div class="row">
            <div class="col-md-3">
                <div class="rank-img rank-img-menu">
                    <h3>Menu</h3>
                </div>
                <ul id="ranking-menu" class="rankings-nav" style="margin-top: 10px">
                    <li class="active"><a href="<?=URI::get_path('ranked/player')?>" data-type="playerrank"><span class="img char">p</span><span><?=$lng[65]?></span></a></li>
                    <li><a href="<?=URI::get_path('ranked/guild')?>" data-type="guildrank"><span class="img guild">g</span><span><?=$lng[66]?></span></a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="rank-img rank-img-chars">
                    <h3 id="ranking-title"><?=$lng[65]?></h3>
                </div>
                <div id="ajaxLoader">
                    <div id="ranking-result" style="margin-top: 18px;"><div class="container-tab rankings-cont">
							<?php if (\StaticDatabase\StaticDatabase::settings('player_rank_status') == "0"):?>
								<?php  echo Client::alert('error',"Oyuncu sıralaması şuanda kapalı!");?>
							<?php else:?>
                                <table class="table table-rankings">
                                    <thead>
                                    <tr>
                                        <td>#</td>
                                        <td><?=$lng[67]?></td>
                                        <td><?=$lng[36]?></td>
                                        <td><?=$lng[68]?></td>
                                        <td><?=$lng[37]?></td>
                                        <td><?=$lng[38]?></td>
                                        <td><?=$lng[40]?></td>
                                        <td><?=$lng[41]?></td>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php Cache::open('players');?>
									<?php if (Cache::check('players')):?>
										<?php foreach ($this->views['data'] as $key=>$row):?>
                                            <tr>
                                                <td><span class="badge-rank rank-<?=($key+1)?>"><?=($key+1)?></span></td>
                                                <td>
                                                    <a href="<?=URI::get_path('detail/player/'.$row['name'])?>" title="<?=jobName($row['job'])?>" rel="np" class="icon-profile link-first">
                                                        <span><?=$row['name']?></span>
                                                    </a>
                                                </td>
                                                <td><img class="class-portrait" src="<?=URL.'data/chrs/small/'.$row['job'].'.png'?>"/></td>
                                                <td><?=$row['level']?></td>
                                                <td><img class="class-portrait" src="<?=URL.'data/flags/'.$row['empire'].'.jpg'?>"/></td>
                                                <td>
													<?php if ($row['guild_name'] != null):?>
                                                        <strong class="battletag">
                                                            <a href="<?=URI::get_path('detail/guild/'.$row['guild_name'])?>" rel="np" class="icon-profile link-first">
                                                                <span><?=$row['guild_name'];?></span>
                                                            </a>
                                                        </strong>
													<?php else:?>
                                                        <span style="color: #8b303d"><?=$lng[70]?></span>
													<?php endif;?>
                                                </td>
                                                <td>
													<?=$row['playtime']?>
                                                </td>
                                                <td class="cell-CompletedTime">
													<?php if (playerStat($row['last_play']) == false):?>
                                                        <center><img class="class-portrait"
                                                                     src="<?=URL.'data/chrs/small/offline.png'?>"/></center>
													<?php elseif(playerStat($row['last_play']) == true):?>
                                                        <center><img class="class-portrait"
                                                                     src="<?=URL.'data/chrs/small/online.png'?>"/></center>
													<?php endif; ?>
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
    </div>