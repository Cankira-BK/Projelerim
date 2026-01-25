<main class="content fontSizeOnUc">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[177]?> </center>
        </div>
        <div class="panel-body no-padding">
			<?php if (\StaticDatabase\StaticDatabase::settings('guild_rank_status') == "0"):?>
				<?php  echo Client::alert('error',"Lonca sıralaması şuanda kapalı!");?>
			<?php else:?>
                <table class="table table-monster siralama">
                    <thead>
                    <tr>
                        <td>#</td>
                        <td>Lonca Adı</td>
                        <td>Puan</td>
                        <td class="hidden-xs">Krallık</td>
                        <td class="hidden-xs">Kazanma</td>
                        <td class="hidden-xs">Beraberlik</td>
                        <td class="hidden-xs">Kaybetme</td>
                    </tr>
                    </thead>
                    <tbody>
					<?php Cache::open('guilds');?>
					<?php if (Cache::check('guilds')):?>
						<?php foreach ($this->views['data'] as $key=>$row):?>
                            <tr class="color-cyan">
                                <td>
                                    <?php if ($key === 0):?>
                                        <img src="<?=URI::public_path('assets/images/top-one-icon.png')?>">
                                    <?php elseif ($key === 1):?>
                                        <img src="<?=URI::public_path('assets/images/top-two-icon.png')?>">
                                    <?php elseif ($key === 2):?>
                                        <img src="<?=URI::public_path('assets/images/top-three-icon.png')?>">
                                    <?php else:?>
                                        <?=$key+1?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <a href="<?=URI::get_path('detail/guild/'.$row['lonca'])?>" title="<?=$row['lonca']?>"><?=$row['lonca']?></a>
                                </td>
                                <td><?=$row['ladder_point']?></td>
                                <td class="hidden-xs">
                                    <img src="<?=URL.'data/flags/'.$row['bayrak'].'.png'?>" alt="">
                                </td>
                                <td class="hidden-xs"><?=$row['win']?></td>
                                <td class="hidden-xs"><?=$row['draw']?></td>
                                <td class="hidden-xs"><?=$row['loss']?></td>
                            </tr>
						<?php endforeach;?>
					<?php endif;?>
					<?php Cache::close('guilds');?>
                    </tbody>
                </table>
            <?php endif;?>
        </div>
    </div>
</main>
