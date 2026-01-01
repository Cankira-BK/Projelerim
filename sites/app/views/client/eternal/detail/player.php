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
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <h2 class="head"><?=$lng[32]?></h2>
            <div class="body">
                <div class="warfg_account">
                    <section id="ucp_top">
						<?php Cache::open($this->player['name']);?>
						<?php if (Cache::check($this->player['name'])):?>
                            <section id="ucp_info" style="padding-right:15px;padding-left:15px;width: 100%;">
                                <aside>
                                    <table width="100%">
                                        <tbody>
                                        <tr>
                                            <td width="40%"><?=$lng[35]?> :</td>
                                            <td width="50%" class="wheat"><?=$this->player['name']?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><?=$lng[68]?> :</td>
                                            <td width="50%" class="wheat"><?=$this->player['level']?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><?=$lng[37]?> :</td>
                                            <td width="50%" class="wheat"><?=Functions::flagName($this->player['empire'])[1]?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><?=$lng[66]?> :</td>
                                            <td width="50%" class="wheat"><?php if ($this->player['lonca'] == null){echo 'Yok';}else{echo $this->player['lonca'];}?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </aside>
                                <aside>
                                    <table width="100%">
                                        <tbody>
                                        <tr>
                                            <td width="40%"><?=$lng[39]?> :</td>
                                            <td width="50%" class="wheat"><?=Functions::zaman($this->player['last_play'])?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><?=$lng[40]?> :</td>
                                            <td width="50%" class="wheat"><?=$this->player['playtime']?> <?=$lng[42]?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><?=$lng[41]?> :</td>
                                            <td width="50%" class="wheat"><img src="<?=URL.'data/chrs/small/'.playerStat($this->player['last_play']).'.png'?>" style="width: 12px;" alt=""></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </aside>
                                <aside>
                                    <div class="leader" style="margin-left: 80px;">
                                        <h3><?=$lng[33]?></a></h3>
                                        <img src="<?=URL.'data/chrs/big/'.$this->player['job'].'/'.portrait($this->player['level']).'.png'?>" style="width:100px">
                                    </div>
                                </aside>
                            </section>
						<?php endif;?>
						<?php Cache::close($this->player['name']);?>
                        <div class="clear"></div>
                    </section>
                </div>
            </div>
        </article>
    </div>
</aside>