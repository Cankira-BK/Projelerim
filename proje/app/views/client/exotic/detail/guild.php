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
<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
			<?php Cache::open($guild['name']);?>
			<?php if (Cache::check($guild['name'])):?>
            <div class="content" style="text-align: center; padding-top: 30px; padding-bottom: 30px;">
                <div class="userback" style="text-align: left; display: inline-block;">
                    <ul class="kutu0" style="float: left;
    margin-left: 42px;
    margin-top: 96px;
    color: #584d45;
    font-size: 9pt;
    font-weight: bold;">
                        <li>
							<img src="<?=URL.'data/chrs/big/'.$guild['job'].'/'.portrait($guild['seviye']).'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>" style="width: 83px;"><br>
                        </li>
                    </ul>
                    <ul class="kutu1" style="margin-top: 60px;width: 237px;">
                        <li>
                            <span><?=$lng[46]?>:</span>
                            <p>
								<?=$guild['name']?>
                            </p>
                        </li>
                        <li>
                            <span><?=$lng[44]?>:</span>
                            <p>
								<?=$guild['baskan']?>
                            </p>
                        </li>
                        <li id="rank">
                            <span><?=$lng[47]?>:</span>
                            <p>
								<?=$guild['ladder_point']?>
                            </p>
                        </li>
                        <li>
                            <span>EXP:</span>
                            <p>
								<?=$guild['exp']?>
                            </p>
                        </li>
                        <li>
                            <span><?=$lng[48]?>:</span>
                            <p>
                                <img src="<?=URL.'data/flags/'.$guild['empire'].'.png';?>" style="width:30px;" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
                            </p>
                        </li>
                    </ul>
                    <ul class="kutu2" style="width: 200px;">
                        <li>
                            <span><?=$lng[19]?>:</span>
                            <p>
								<?=$guild['win']?>
                            </p>
                        </li>
                        <li>
                            <span><?=$lng[50]?>:</span>
                            <p>
								<?=$guild['draw']?>
                            </p>
                        </li>
                        <li>
                            <span><?=$lng[51]?>:</span>
                            <p>
								<?=$guild['loss']?>
                            </p>
                        </li>
                    </ul>
                    <div class="clear">
                    </div>
                </div>
            </div>
			<?php endif;?>
			<?php Cache::close($guild['name']);?>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>