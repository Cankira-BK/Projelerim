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
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading"><h2 class="head"><?=$lng[43]?></h2></div>
            <div class="body">
                <div class="warfg_account">
                    <section id="ucp_top">
						<?php Cache::open($guild['name']);?>
						<?php if (Cache::check($guild['name'])):?>
                        <section id="ucp_info" style="padding-right:15px;padding-left:15px;width: 100%;">
                            <aside class="detail-section">
                                <table width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="40%"><?=$lng[46]?> :</td>
                                        <td width="50%" class="wheat"><?=$guild['name']?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%"><?=$lng[47]?> :</td>
                                        <td width="50%" class="wheat"><?=$guild['ladder_point']?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%">EXP :</td>
                                        <td width="50%" class="wheat"><?=$guild['exp']?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%"><?=$lng[48]?> :</td>
                                        <td width="50%" class="wheat"><img src="<?=URL.'data/flags/'.$guild['empire'].'.png';?>" style="width:30px;" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </aside>
                            <aside class="detail-section">
                                <table width="100%">
                                    <tbody>
                                    <tr>
                                        <td width="40%"><?=$lng[49]?> :</td>
                                        <td width="50%" class="wheat"><?=$guild['win']?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%"><?=$lng[50]?> :</td>
                                        <td width="50%" class="wheat"><?=$guild['draw']?></td>
                                    </tr>
                                    <tr>
                                        <td width="40%"><?=$lng[51]?> :</td>
                                        <td width="50%" class="wheat"><?=$guild['loss']?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </aside>
                            <aside class="detail-section">
                                <div class="leader">
                                    <img src="<?=URL.'data/chrs/big/'.$guild['job'].'/'.portrait($guild['seviye']).'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
                                    <a href="<?=URI::get_path('detail/player/'.$guild['baskan'])?>"><?=$guild['baskan']?></a>
                                </div>
                            </aside>
                        </section>
                        <?php endif;?>
						<?php Cache::close($guild['name']);?>
                        <div class="clear"></div>
                    </section>
                </div>
            </div>
        </article>
    </div>
</aside>
