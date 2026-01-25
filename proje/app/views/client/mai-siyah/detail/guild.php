<?php
$guild = $this->guild['info'];
function portrait($level)
{
	if ($level < 26){
		return '1';
	}elseif ($level < 34){
		return '26';
	}elseif ($level < 42){
		return '34';
	}elseif ($level < 48){
		return '42';
	}elseif ($level < 54){
		return '48';
	}elseif ($level < 61){
		return '54';
	}elseif ($level < 70){
		return '61';
	}elseif ($level < 90){
		return '70';
	}elseif ($level >= 90){
		return '90';
	}
}
function jobName($value){
	if ($value == 0 || $value == 4){
		return 'Savascı';
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
function gifName($value){
	if ($value == 0 || $value == 4){
		return 'barbarian';
	}elseif ($value == 1 || $value == 5){
		return 'crusader';
	}elseif ($value == 2 || $value == 6){
		return 'witch-doctor';
	}elseif ($value == 3 || $value == 7){
		return 'wizard';
	}
}
function playerStat($date){
	$now = date( 'Y-m-d H:i:s', strtotime('-30 minutes'));
	if ($now > $date){
		return 'off';
	}elseif ($now <= $date){
		return 'on';
	}
}
?>
<div class="row">
    <div class="col-md-9 normal-content">
        <div class="col-md-12 no-padding-all">
            <center><h3><?=$lng[43]?></h3></center>
            <h2 class="brackets"></h2>
        </div>
	<?php Cache::open($guild['name']);?>
	<?php if (Cache::check($guild['name'])):?>
    <div class="col-md-8">
        <div class="equipment-icons" style="float: none;">
            <center><strong><?=$lng[46]?> : <?=$guild['name']?></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[68]?> : <?=$guild['level']?></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[47]?> : <?=$guild['ladder_point']?></strong></center>
            <?=Functions::bracket()?>
            <center><strong>EXP : <?=$guild['exp']?></strong></center>
            <?=Functions::bracket()?>
            <center><strong><img src="<?=URL.'data/flags/'.$guild['empire'].'.jpg';?>" alt="MilasMt2"></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[176]?> : <span style="color: #00a8c6"><?=$this->guild['count'];?></span></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[49]?> : <span style="color: green"><?=$guild['win']?></span></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[50]?> : <span style="color: grey"><?=$guild['draw']?></span></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[51]?> : <span style="color: darkred"><?=$guild['loss']?></span></strong></center>
        </div>
    </div>
    <div class="col-md-4">
        <div class="login-cont frame">
            <div class="frame-inner">
                <a href="<?=URI::get_path('detail/player/'.$guild['baskan'])?>"><h2 class="char-title ch text-center"><?=$lng[44]?>: <?=$guild['baskan']?></h2></a>
                <div class="char-img">
                    <a href="<?=URI::get_path('detail/player/'.$guild['baskan'])?>"><img src="<?=URL.'data/chrs/big/'.$guild['job'].'/'.portrait($guild['seviye']).'.png'?>" alt="MilasMt2" style="width:210px"></a>
                    <div class="shadow"></div>
                </div>

            </div>
        </div>
    </div>
	<?php endif;?>
	<?php Cache::close($guild['name']);?>
</div>
