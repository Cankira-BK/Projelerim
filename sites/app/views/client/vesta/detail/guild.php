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

<div class="col-md-9"><div class="col-md-12 no-padding">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[43]?>
            </div>
			<?php Cache::open($guild['name']);?>
			<?php if (Cache::check($guild['name'])):?>
            <div class="panel-body no-padding">
                <div class="col-md-12">
                    <div class="karakter-icerik">
                        <table class="KarakterDetayTablo">

                            <tbody>

                            <tr>
                                <td><?=$lng[46]?></td>
                                <td><?=$guild['name']?></td>
                            </tr>
                            <tr>
                                <td><?=$lng[44]?></td>
                                <td><a href="<?=URI::get_path('detail/player/'.$guild['baskan'])?>"><?=$guild['baskan']?></a></td>
                            </tr>
                            <tr>
                                <td><?=$lng[48]?></td>
                                <td><div><img src="<?=URL.'data/flags/'.$guild['empire'].'.png';?>" style="width:30px;" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></div></td>
                            </tr>
                            <tr>
                                <td><?=$lng[47]?></td>
                                <td><?=$guild['ladder_point']?></td>
                            </tr>
                            <tr>
                                <td><?=$lng[49]?></td>
                                <td><?=$guild['win']?></td>
                            </tr>
                            <tr>
                                <td><?=$lng[51]?></td>
                                <td><?=$guild['loss']?></td>
                            </tr>
                            <tr>
                                <td><?=$lng[50]?></td>
                                <td><?=$guild['draw']?></td>
                            </tr>
                            </tbody></table>
                    </div>
                </div>
            </div>
			<?php endif;?>
			<?php Cache::close($guild['name']);?>
        </div>
    </div>
</div>

