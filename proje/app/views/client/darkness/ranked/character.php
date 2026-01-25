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

<div class="content_wrapper left">
    <div class="real_content">

        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[65]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
                    <center>
                        <a href="javascript:void(0)"><input type="button" value="<?=$lng[65]?>"></a>
                        <a href="<?=URI::get_path('ranked/guild')?>"><input type="button" value="<?=$lng[66]?>"></a>
                    </center>
                    <br>
					<?php if (\StaticDatabase\StaticDatabase::settings('player_rank_status') == "0"):?>
						<?php  echo Client::alert('error',"Oyuncu sıralaması şuanda kapalı!");?>
					<?php else:?>
                        <table class="topranking" cellspacing="1" cellpadding="0" style="line-height: 4">
                            <tbody><tr class="c0">
                                <td class="pname"><i>#</i></td>
                                <td class="pname"><i><?=$lng[67]?></i></td>
                                <td class="pname"><i><?=$lng[68]?></i></td>
                                <td class="pname"><i><?=$lng[48]?></i></td>
                                <td class="pname"><i><?=$lng[69]?></i></td>
                                <td class="pname"><i><?=$lng[40]?></i></td>
                            </tr>
							<?php Cache::open('players');?>
							<?php if (Cache::check('players')):?>
								<?php foreach ($this->views['data'] as $key=>$row):?>
                                    <tr class="c1">
                                        <td class="pname"><?=($key+1)?></td>
                                        <td class="pname"><a href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></td>
                                        <td class="pname"><?=$row['level']?></td>
                                        <td class="pname"><img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></td>
                                        <td class="pname">
											<?php if ($row['guild_name'] != null):?>
                                                <a href="<?=URI::get_path('detail/guild/'.$row['guild_name'])?>"><?=$row['guild_name'];?></a>
											<?php else:?>
                                                <b style="color: #8b303d"><?=$lng[70]?></b>
											<?php endif;?>
                                        </td>
                                        <td class="pname"><?=$row['playtime']?></td>
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

