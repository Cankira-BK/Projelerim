<main class="content fontSizeOnUc">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[176]?> </center>
        </div>
        <div class="panel-body no-padding">
			<?php if (\StaticDatabase\StaticDatabase::settings('player_rank_status') == "0"):?>
				<?php  echo Client::alert('error',"Oyuncu sıralaması şuanda kapalı!");?>
			<?php else:?>
                <table class="table table-monster siralama">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td><?=$lng[67]?></td>
                        <td><?=$lng[68]?></td>
                        <td class="hidden-xs"><?=$lng[48]?></td>
                        <td class="hidden-xs"><?=$lng[69]?></td>
                        <td class="hidden-xs"><?=$lng[33]?></td>
                        <td class="hidden-xs"><?=$lng[41]?></td>
                    </tr>
                    </thead>
                    <tbody>
					<?php Cache::open('players');?>
					<?php if (Cache::check('players')):?>
						<?php foreach ($this->views['data'] as $key=>$row):?>
                            <tr class="renk-purple">
                                <td>
									<?php if ($key === 0):?>
                                        <img src="<?=URI::public_path('assets/images/top-one-icon.png')?>">
									<?php elseif ($key === 1):?>
                                        <img src="<?=URI::public_path('assets/images/top-two-icon.png')?>">
									<?php elseif ($key === 2):?>
                                        <img src="<?=URI::public_path('assets/images/top-three-icon.png')?>">
									<?php else:?>
										<?= ($key+1) ?>
									<?php endif;?>
                                </td>
                                <td><a rel="nofollow" href="<?=URI::get_path('detail/player/'.$row['name'])?>" title="<?=Functions::jobName($row['job'])?>"><?=$row['name']?></a></td>
                                <td><?=$row['level']?></td>
                                <td class="hidden-xs">
                                    <img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
                                </td>
                                <td class="hidden-xs">
									<?php if ($row['guild_name'] != null):?>
                                        <a href="<?=URI::get_path('detail/guild/'.$row['guild_name'])?>"><?=$row['guild_name'];?></a>
									<?php else:?>
                                        <b style="color: #8b303d"><?=$lng[70]?></b>
									<?php endif;?>
                                </td>
                                <td class="hidden-xs">
                                    <img src="<?=URL.'data/chrs/small/'.$row['job'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
                                </td>
                                <td class="hidden-xs">
                                    <img class="class-portrait" src="<?=URL.'data/chrs/small/'.Functions::playerOnlineStatus($row['last_play']).'.png'?>"/>
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
</main>