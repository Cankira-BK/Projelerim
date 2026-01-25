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
                    <li><a href="<?=URI::get_path('ranked/player')?>" data-type="playerrank"><span class="img char">p</span><span>Oyuncu Sıralaması</span></a></li>
                    <li class="active"><a href="<?=URI::get_path('ranked/guild')?>" data-type="guildrank"><span class="img guild">g</span><span>Lonca Sıralaması</span></a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="rank-img rank-img-chars">
                    <h3 id="ranking-title">Lonca Sıralaması</h3>
                </div>
                <div id="ajaxLoader">
                    <div id="ranking-result" style="margin-top: 18px;"><div class="container-tab rankings-cont">
						<?php if (\StaticDatabase\StaticDatabase::settings('guild_rank_status') == "0"):?>
                            <?php  echo Client::alert('error',"Lonca sıralaması şuanda kapalı!");?>
                        <?php else:?>
                            <table class="table table-rankings">
                                    <thead>
                                    <tr>
                                        <td>#</td>
                                        <td><?=$lng[46]?></td>
                                        <td><?=$lng[47]?></td>
                                        <td><?=$lng[48]?></td>
                                        <td><?=$lng[44]?></td>
                                        <td><?=$lng[49]?></td>
                                        <td><?=$lng[50]?></td>
                                        <td><?=$lng[51]?></td>
                                    </tr>
                                    </thead>
                                    <tbody>
									<?php Cache::open('guilds');?>
									<?php if (Cache::check('guilds')):?>
										<?php foreach ($this->views['data'] as $key=>$row):?>
                                            <tr>
                                                <td><span class="badge-rank rank-<?=($key+1)?>"><?=($key+1)?></span></td>
                                                <td>
                                                    <a href="<?=URI::get_path('detail/guild/'.$row['lonca'])?>" title="<?=$row['lonca']?>" rel="np" class="icon-profile link-first">
                                                        <center><span><?=$row['lonca']?></span></center>
                                                    </a>
                                                </td>
                                                <td><?=$row['ladder_point']?></td>
                                                <td><img class="class-portrait" src="<?=URL.'data/flags/'.$row['bayrak'].'.jpg'?>"/></td>
                                                <td><a href="<?=URI::get_path('detail/player/'.$row['baskan'])?>" rel="np" class="icon-profile link-first">
                                                        <center><span><?=$row['baskan'];?></span></center>
                                                    </a></td>
                                                <td><center style="color: green"><?=$row['win']?></center></td>
                                                <td>
                                                    <center><?=$row['draw']?></center>
                                                </td>
                                                <td class="cell-CompletedTime">
                                                    <center style="color: red"><?=$row['loss']?></center>
                                                </td>
                                            </tr>
										<?php endforeach;?>
									<?php endif;?>
									<?php Cache::close('guilds');?>
                                    </tbody>
                                </table>
                        <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
