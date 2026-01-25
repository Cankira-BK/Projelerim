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

<div class="col-md-9"><div class="col-md-12 no-padding">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[32]?>
            </div>
			<?php Cache::open($this->player['name']);?>
			<?php if (Cache::check($this->player['name'])):?>
            <div class="panel-body no-padding">
                <div class="col-md-3 no-padding">
                    <div class="karakter-bg karakter_<?=$this->player['job']?>"></div>
                </div>
                <div class="col-md-9">
                    <div class="karakter-icerik">
                        <table class="KarakterDetayTablo">
                            <tbody>

                            <tr>
                                <td><?=$lng[35]?></td>
                                <td><?=$this->player['name']?></td>
                            </tr>
                            <tr>
                                <td><?=$lng[68]?></td>
                                <td><?=$this->player['level']?></td>
                            </tr>
                            <tr>
                                <td><?=$lng[37]?></td>
                                <td><div><?=Functions::flagName($this->player['empire'])[1]?></div></td>
                            </tr>
                            <tr>
                                <td><?=$lng[40]?></td>
                                <td><?=$this->player['playtime']?> <?=$lng[42]?></td>
                            </tr>
                            <tr>
                                <td><?=$lng[38]?></td>
                                <td><a href="javascript:void(0)"><?php if ($this->player['lonca'] == null){echo 'Yok';}else{echo $this->player['lonca'];}?></a></td>
                            </tr>
                            <tr>
                                <td><?=$lng[39]?></td>
                                <td><?=Functions::zaman($this->player['last_play'])?></td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
			<?php endif;?>
			<?php Cache::close($this->player['name']);?>
        </div>
    </div>
</div>
