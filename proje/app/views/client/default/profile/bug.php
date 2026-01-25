<?php
$char = $this->character;
$randomKey = Functions::generateRandomString();
Session::set('bug_key',$randomKey);
?>
<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[106]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
					<?php $count = count($char);?>
					<?php if ($count == 0):?>
						<?=Functions::alert('warning',$lng[107]);?>
					<?php else:?>
						<?php foreach ($char as $row):?>
							<?php $bugHash = md5($row['name'].$randomKey);?>
                            <div id="profileBox" class="player-table">
                                <div class="player-row">
                                    <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                                    <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$row['name']?></span></center><br>
                                    <center><span><?=$lng[109]?> : <?=Functions::map($row['map_index']);?></span></center>
                                    <a href="<?=URI::get_path('profile/saved/'.$row['name'].'/'.$bugHash);?>" class="center-block"><input type="button" class="btn" style="margin-top: 10px;margin-right: auto;margin-left: auto;display: block;" value="<?=$lng[110]?>"></a>
                                </div>
                            </div>
						<?php endforeach;?>
					<?php endif;?>
                </div>
            </div>
        </div
    </div>
</div>
</div>