<?php
$char = $this->character;
$randomKey = Functions::generateRandomString();
Session::set('bug_key',$randomKey);
?>

<div class="container material-box">
<div class="sidebar-big">
<h4><?=$lng[123]?></h4>
<?php $count = count($char);?>
<?php if ($count == 0):?>
	<?=Functions::AndroidErrorMessage('warning',$lng[166]);?>
<?php else:?>
	<?php foreach ($char as $row):?>
		<?php $bugHash = md5($row['name'].$randomKey);?>
        <div id="profileBox" class="player-table">
            <div class="player-row">
                <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$row['name']?></span></center><br>
                <center><span><?=$lng[167]?> : <?=Functions::map($row['map_index']);?></span></center>
                <a href="<?=URI::get_path('profile/saved/'.$row['name'].'/'.$bugHash);?>" class="center-block"><button class="buttonWrap button button-green contactSubmitButton" style="margin-top: 10px;margin-right: auto;margin-left: auto;display: block;"><?=$lng[99]?></button></a>
            </div>
        </div>
	<?php endforeach;?>
<?php endif;?>
</div>
</div>
