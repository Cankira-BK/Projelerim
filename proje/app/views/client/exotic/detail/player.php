<?php
function portrait($level)
{
	if ($level < 26) {
		return '1';
	} elseif ($level < 34) {
		return '26';
	} elseif ($level < 42) {
		return '34';
	} elseif ($level < 48) {
		return '42';
	} elseif ($level < 54) {
		return '48';
	} elseif ($level < 61) {
		return '54';
	} elseif ($level < 70) {
		return '61';
	} elseif ($level < 90) {
		return '70';
	} elseif ($level >= 90) {
		return '90';
	}
}

function jobName($value)
{
	if ($value == 0 || $value == 4) {
		return 'Savascı';
	} elseif ($value == 1 || $value == 5) {
		return 'Ninja';
	} elseif ($value == 2 || $value == 6) {
		return 'Sura';
	} elseif ($value == 3 || $value == 7) {
		return 'Şaman';
	} elseif ($value == 8) {
		return 'Lycan';
	}
}

function gifName($value)
{
	if ($value == 0 || $value == 4) {
		return 'barbarian';
	} elseif ($value == 1 || $value == 5) {
		return 'crusader';
	} elseif ($value == 2 || $value == 6) {
		return 'witch-doctor';
	} elseif ($value == 3 || $value == 7) {
		return 'wizard';
	}
}

function playerStat($date)
{
	$now = date('Y-m-d H:i:s', strtotime('-30 minutes'));
	if ($now > $date) {
		return 'off';
	} elseif ($now <= $date) {
		return 'on';
	}
}

?>
<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
			<?php Cache::open($this->player['name']);?>
			<?php if (Cache::check($this->player['name'])):?>
            <div class="content" style="text-align: center; padding-top: 30px; padding-bottom: 30px;">
                <div class="userback" style="text-align: left; display: inline-block;">
                    <ul class="kutu0" style="float: left;
    margin-left: 42px;
    margin-top: 96px;
    color: #584d45;
    font-size: 9pt;
    font-weight: bold;">
                        <li>
                            <img src="<?=URL.'data/chrs/big/'.$this->player['job'].'/'.portrait($this->player['level']).'.png'?>" class="player-img" style="width: 83px;"><br>
                        </li>
                    </ul>
                    <ul class="kutu1" style="margin-top: 60px;width: 237px;">
                        <li>
                            <span><?=$lng[67]?>:</span>
                            <p>
								<?=$this->player['name']?>
                            </p>
                        </li>
                        <li id="rank">
                            <span><?=$lng[36]?>:</span>
                            <p>
								<?=jobName($this->player['job'])?>
                            </p>
                        </li>
                        <li>
                            <span><?=$lng[37]?>:</span>
                            <p>
								<?=Functions::flagName($this->player['empire'])[1]?>
                            </p>
                        </li>
                        <li>
                            <span><?=$lng[38]?>:</span>
                            <p>
								<?php if ($this->player['lonca'] == null){echo 'Yok';}else{echo $this->player['lonca'];}?>
                            </p>
                        </li>
                        <li>
                            <span><?=$lng[39]?>:</span>
                            <p>
								<?=Functions::zaman($this->player['last_play'])?>
                            </p>
                        </li>
                    </ul>
                    <ul class="kutu2" style="width: 200px;">
                        <li>
                            <span><?=$lng[40]?>:</span>
                            <p>
								<?=$this->player['playtime']?> <?=$lng[42]?>
                            </p>
                        </li>
                        <li>
                            <span><?=$lng[41]?>:</span>
                            <p>
                                <img src="<?=URL.'data/chrs/small/'.playerStat($this->player['last_play']).'.png'?>" style="width: 12px;" alt="">
                            </p>
                        </li>
                        <li>
                            <span><?=$lng[68]?>:</span>
                            <p>
								<?=$this->player['level']?>
                            </p>
                        </li>
                        <li>
                            <span>Exp:</span>
                            <p>
								<?=$this->player['exp']?>
                            </p>
                        </li>
                    </ul>
                    <div class="clear">
                    </div>
                </div>
            </div>
			<?php endif;?>
			<?php Cache::close($this->player['name']);?>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>

