<?php
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
            <center><h3><?=$lng[32]?></h3></center>
            <h2 class="brackets"></h2>
        </div>
	<?php Cache::open($this->player['name']);?>
	<?php if (Cache::check($this->player['name'])):?>
    <div class="col-md-8">
        <div class="equipment-icons" style="float: none;">
            <center><strong><?=$lng[35]?> : <?=$this->player['name']?></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[68]?> : <?=$this->player['level']?></strong></center>
            <?=Functions::bracket()?>
            <center><strong>EXP : <?=$this->player['exp']?></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[40]?> : <?=$this->player['playtime']?> <?=$lng[42]?></strong></center>
            <?=Functions::bracket()?>
            <center><strong><img src="<?=URL.'data/flags/'.$this->player['empire'].'.jpg';?>" alt=""></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[38]?> : <?php if ($this->player['lonca'] == null){echo 'Yok';}else{echo $this->player['lonca'];}?></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[39]?> : <?=Functions::zaman($this->player['last_play'])?></strong></center>
            <?=Functions::bracket()?>
            <center><strong><?=$lng[109]?> : <?=Functions::map($this->player['map_index'])?></strong></center>
            <?=Functions::bracket()?>
            <center><strong></strong> <div><img src="<?=URL.'data/chrs/small/'.playerStat($this->player['last_play']).'.png'?>" alt=""></div></center>
        </div>
    </div>
    <div class="col-md-4">
        <div class="login-cont frame">
            <div class="frame-inner">
                <div class="char-img">
                    <img style="width:210px" src="<?=URL.'data/chrs/big/'.$this->player['job'].'/'.portrait($this->player['level']).'.png'?>" alt="" >
                    <div class="shadow"></div>
                </div>

            </div>
        </div>
    </div>
	<?php endif;?>
	<?php Cache::close($this->player['name']);?>
</div>