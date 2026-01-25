<div class="title">
	<?=$lng[176]?>
</div>
<div class="news page">
    <div  style="margin-left:10px;margin-bottom:20px;text-align: center;">
        <a href="javascript:void(0);">
            <button class="btn btn-giris"><?=$lng[176]?></button>
        </a>
        <a href="<?=URI::get_path('ranked/guild')?>">
            <button class="btn btn-giris"><?=$lng[177]?></button>
        </a>
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
                <th><?=$lng[33]?></th>
                <th><?=$lng[41]?></th>
            </tr>
            </thead>
            <tbody>
			<?php Cache::open('players');?>
			<?php if (Cache::check('players')):?>
				<?php foreach ($this->views['data'] as $key=>$row):?>
                    <tr>
                        <td><?=($key+1)?></td>
                        <td><a rel="nofollow" href="<?=URI::get_path('detail/player/'.$row['name'])?>" title="<?=Functions::jobName($row['job'])?>"><?=$row['name']?></a></td>
                        <td><?=$row['level']?></td>
                        <td><img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></td>
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