<div class="container material-box">
<h4><?=$lng[64]?></h4>
<p><?=$lng[65]?></p>
<div class="tabs">
<?php if (\StaticDatabase\StaticDatabase::settings('player_rank_status') == "1"):?>
<a href="#" class="tab-but tab-but-1 tab-active"><?=$lng[66]?></a>
<?php endif;?>
<?php if (\StaticDatabase\StaticDatabase::settings('guild_rank_status') == "1"):?>
<a href="#" class="tab-but tab-but-2"><?=$lng[67]?></a>
<?php endif;?>
</div>
<div class="tab-content tab-content-1">
<?php if (\StaticDatabase\StaticDatabase::settings('player_rank_status') == "0"):?>
<?php  echo Functions::AndroidErrorMessage('error',$lng[74]);?>
<?php else:?>
<table cellspacing='0' class="table no">
<tr>
<th>#</th>
<th class="table-title"><?=$lng[68]?></th>
<th class="table-title"><?=$lng[69]?></th>
<th class="table-title"><?=$lng[70]?></th>
<th class="table-title"><?=$lng[71]?></th>
<th class="table-title"><?=$lng[72]?></th>
</tr>
<?php Cache::open('players_android');?>
<?php if (Cache::check('players_android')):?>
<?php foreach ($this->views['player'] as $key=>$row):?>
<tr>
<td><?=($key+1)?></td>
<td class="table-sub-title"><a><?=$row['name']?></a></td>
<td class="table-sub-title"><?=$row['level']?></td>
<td class="table-sub-title"><center><img src="<?=URL.'data/flags/'.$row['empire'].'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></center></td>
<td class="table-sub-title">
<?php if ($row['guild_name'] != null):?>
    <a href="<?=URI::get_path('detail/guild/'.$row['guild_name'])?>"><?=$row['guild_name'];?></a>
<?php else:?>
    <b style="color: #8b303d"><?=$lng[73]?></b>
<?php endif;?>
</td>
<td class="table-sub-title"><?=$row['playtime']?></td>
</tr>
<?php endforeach;?>
<?php endif;?>
<?php Cache::close('players_android');?>
</table>
<?php endif;?>
</div>

<div class="tab-content tab-content-2">
<?php if (\StaticDatabase\StaticDatabase::settings('guild_rank_status') == "0"):?>
<?php echo Functions::AndroidErrorMessage('error',$lng[78]);?>
<?php else:?>
<table cellspacing='0' class="table no">
<tr>
<th>#</th>
<th class="table-title"><?=$lng[68]?></th>
<th class="table-title"><?=$lng[75]?></th>
<th class="table-title"><?=$lng[70]?></th>
<th class="table-title"><?=$lng[76]?></th>
<th class="table-title"><?=$lng[77]?></th>
</tr>
<?php Cache::open('guilds_android');?>
<?php if (Cache::check('guilds_android')):?>
<?php foreach ($this->views['guild'] as $keys=>$rows):?>
<tr>
<td><?=($keys+1)?></td>
<td class="table-sub-title"><a><?=$rows['lonca']?></a></td>
<td class="table-sub-title"><?=$rows['ladder_point']?></td>
<td class="table-sub-title"><center><img src="<?=URL.'data/flags/'.$rows['bayrak'].'.png'?>" alt=""></center></td>
<td class="table-sub-title"><a><?=$rows['baskan'];?></a></td>
<td class="table-sub-title"><span class="text-highlight highlight-green"><?=$rows['win']?></span> | <span class="text-highlight highlight-dark"><?=$rows['draw']?></span> | <span class="text-highlight highlight-red"><?=$rows['loss']?></span></td>
</tr>
<?php endforeach;?>
<?php endif;?>
<?php Cache::close('guilds_android');?>
</table>
<?php endif;?>
</div>
</div>
