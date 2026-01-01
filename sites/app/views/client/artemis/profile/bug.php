<?php
$char = $this->character;
$randomKey = Functions::generateRandomString();
Session::set('bug_key',$randomKey);
?>
<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1125px;">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[106]?></div>
            <div class="panel-body">
				<?php $count = count($char);?>
				<?php if ($count == 0):?>
					<?=Client::alert('warning',$lng[107]);?>
				<?php else:?>
					<?php foreach ($char as $row):?>
						<?php $bugHash = md5($row['name'].$randomKey);?>
                        <div id="profileBox" class="player-table">
                            <div class="player-row">
                                <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                                <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$row['name']?></span></center><br>
                                <center><span><?=$lng[109]?> : <?=Functions::map($row['map_index']);?></span></center>
                                <a href="<?=URI::get_path('profile/saved/'.$row['name'].'/'.$bugHash);?>" class="center-block"><button class="btn" style="margin-top: 10px;margin-right: auto;margin-left: auto;display: block;"><?=$lng[110]?></button></a>
                            </div>
                        </div>
					<?php endforeach;?>
				<?php endif;?>
            </div>
        </div>
    </div>
</div>