<?php
$isBanned = $this->all["is_banned"];
$playerInfo = $this->all["player_info"];
$randomKey = Functions::generateRandomString(32);
Session::setHash(['bug_key'=>$randomKey]);
?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[98]?> </center>
        </div>
        <div class="panel-body">
			<?php if ($playerInfo->count <= 0):?>
				<?=Client::alert('warning',$lng[107]);?>
			<?php else:?>
				<?php foreach ($playerInfo->data as $player):?>
					<?php
					$bugHash = md5($row['name'].$randomKey);
					?>
                    <div id="profileBox" class="player-table detail-section" style="float: left;width: 49%;background: #01010b url(<?=URI::public_path('assets/images/best-block-bg.png')?>) bottom right no-repeat;">
                        <div class="player-row">
                            <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                            <center>
                                <span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></span>
                            </center>
                            <br>
                            <center><span><?=$lng[109]?> : <?=Functions::map($player->map_index);?></span></center>
                            <br>
                            <a href="<?=URI::get_path('profile/saved/'.$row['name'].'/'.$bugHash);?>">
                                <button type="submit" name="login_submit" class="btn form-btn" style="top: -4px; margin-right: auto;margin-left: auto;display: block;"><?=$lng[110]?></button>
                            </a>
                        </div>
                    </div>
				<?php endforeach;?>
			<?php endif;?>
        </div>
</main>