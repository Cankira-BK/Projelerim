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
<div class="main-panel panel-download">
    <div class="main-header">
		<?=$lng[32]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php Cache::open($this->player['name']);?>
                    <?php if (Cache::check($this->player['name'])):?>
                    <div class="bg-light item-container">
                        <div class="player-card">
                            <h3><?=$lng[33]?></h3>
                            <img src="<?=URL.'data/chrs/big/'.$this->player['job'].'/'.portrait($this->player['level']).'.png'?>" class="player-img"><br>
                            <span class="player-title"><i class="icon-power3 position-left"></i> <?=$this->player['level']?> Level</span>
                        </div>
                        <div class="player-info-card">
                            <span class="player-title"> <i class="icon-crown position-left"></i> <?=$this->player['exp']?></span>
                        </div>
                        <div class="player-informations">
                            <h3><?=$lng[34]?></h3>
                            <div class="player-table">
                                <div class="player-row">
                                    <strong><i class="icon-man position-left"></i> <?=$lng[35]?>:</strong>
                                    <span><?=$this->player['name']?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-height position-left"></i> <?=$lng[36]?>:</strong>
                                    <span><?=jobName($this->player['job'])?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-flag4 position-left"></i> <?=$lng[37]?>:</strong>
                                    <span><?=Functions::flagName($this->player['empire'])[1]?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-make-group position-left"></i> <?=$lng[38]?>:</strong>
                                    <span><?php if ($this->player['lonca'] == null){echo 'Yok';}else{echo $this->player['lonca'];}?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-watch2 position-left"></i> <?=$lng[39]?>:</strong>
                                    <span><?=Functions::zaman($this->player['last_play'])?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-watch position-left"></i> <?=$lng[40]?>:</strong>
                                    <span><span title="<?=$this->player['playtime']?>"><?=$this->player['playtime']?> <?=$lng[42]?></span></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-feed position-left"></i> <?=$lng[41]?>:</strong>
                                    <span><img src="<?=URL.'data/chrs/small/'.playerStat($this->player['last_play']).'.png'?>" style="width: 12px;" alt=""></span>
                                </div>

                            </div>
                        </div>
                        <div class="player-flag" style="background-color: rgba(84, 14, 14, 0.54);"></div>
                    </div>
                    <?php endif;?>
                    <?php Cache::close($this->player['name']);?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>