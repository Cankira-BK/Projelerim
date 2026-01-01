<?php
$account = $this->players['account'];
$status = $account['status'];
$availDt = strtotime($account['availDt']);
$now = time();
$fark = $availDt - $now;
    function find_url($string){
//"www."
        $pattern_preg1 = '#(^|\s)(www|WWW)\.([^\s<>\.]+)\.([^\s\n<>]+)#sm';
        $replace_preg1 = '\\1<a href="http://\\2.\\3.\\4" target="_blank" class="link">\\2.\\3.\\4</a>';

//"http://"
        $pattern_preg2 = '#(^|[^\"=\]]{1})(http|HTTP|ftp)(s|S)?://([^\s<>\.]+)\.([^\s<>]+)#sm';
        $replace_preg2 = '\\1<a href="\\2\\3://\\4.\\5" target="_blank" class="link">\\2\\3://\\4.\\5</a>';

        $string = preg_replace($pattern_preg1, $replace_preg1, $string);
        $string = preg_replace($pattern_preg2, $replace_preg2, $string);

        return $string;
    }

?>
<div class="main-panel panel-download">
    <div class="main-header">
        <?=$lng[136]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if ($status == 'BLOCK'):?>
                        <?=Client::alert('warning',$lng[137]); ?>
                    <?php elseif ($availDt > $now):?>
                        <?=Client::alert('warning',$lng[138]); ?>
                    <div class="bg-light item-container">
                        <center><span id="say" style="font-weight: bold;font-size: 45px;"><?=$fark?></span><br> <?=$lng[139]?></center>
                    </div>
                        <script type="text/javascript">
                            var saniye = <?=$fark+1?>;
                            function bak()
                            {
                                if(saniye != 0)
                                {
                                    saniye = saniye - 1;
                                    document.getElementById("say").innerHTML = saniye;
                                    setTimeout(bak, 1000);
                                }
                            }
                            window.onload=bak;
                        </script>
                    <?php endif;?>
                    <div class="bg-light item-container">
                        <div class="player-flag" style="background-color: rgba(84,14,14,0);"></div>
                        <div class="player-informations">
                            <?php if ($status == 'OK' && $availDt <= $now):?>
                            <h3><?=$lng[140]?></h3>
                            <a href="<?=URI::get_path('profile/password')?>"><button class="btn"><?=$lng[141]?></button></a><br>
                            <a href="<?=URI::get_path('profile/email')?>"><button class="btn btn-block btn-grunge"><?=$lng[142]?></button></a><br>
                            <a href="<?=URI::get_path('profile/depo')?>"><button class="btn btn-block btn-grunge"><?=$lng[143]?></button></a><br>
                            <a href="<?=URI::get_path('profile/ksk')?>"><button class="btn btn-block btn-grunge"><?=$lng[144]?></button></a><br>
                            <a href="<?=URI::get_path('profile/save')?>"><button class="btn btn-block btn-grunge"><?=$lng[145]?></button></a><br>
                            <?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
								<a href="<?=URI::get_path('profile/pin')?>"><button class="btn btn-block btn-grunge">Pin Değiştir</button></a><br>
							<?php endif;?>
							<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
								<a href="<?=URI::get_path('profile/iks')?>"><button class="btn btn-block btn-grunge">İtem Kilit Değiştir</button></a><br>
							<?php endif;?>
							<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
								<a href="<?=URI::get_path('profile/hgs')?>"><button class="btn btn-block btn-grunge">Hesap Kilit Değiştir</button></a><br>
							<?php endif;?>
							<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
								<a href="<?=URI::get_path('profile/kgs')?>"><button class="btn btn-block btn-grunge">Karakter Kilit Değiştir</button></a><br>
							<?php endif;?>
							<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
								<a href="<?=URI::get_path('profile/gpc')?>"><button class="btn btn-block btn-grunge">GüvenliPC Pasifleştir</button></a><br>
							<?php endif;?>
							<a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><button class="btn btn-block btn-grunge"><?=$lng[147]?></button></a><br>
                            <a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>" target="_blank"><button class="btn btn-block btn-grunge"><?=$lng[146]?></button></a><br>
                            <a href="<?=URI::get_path('login/logout')?>"><button type="submit" class="btn btn-block btn-grunge"><?=$lng[148]?></button></a><br><br>
                            <?php else:?>
                                <h3><?=$lng[149]?></h3>
                                <center><h4><?=$this->players['ban']['why']?></h4></center><br>
                                <?php if ($this->players['ban']['evidence'] != ''):?>
                                    <h3><?=$lng[150]?></h3>
                                    <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
                                <?php endif;?>
                            <?php endif;?>
                            <h3><?=$lng[151]?></h3>
                            <div class="player-table">
                                <div class="player-row">
                                    <strong><i class="icon-man position-left"></i> <?=$lng[23]?>:</strong>
                                    <span><?=$this->players['account']['login'];?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-height position-left"></i> <?=$lng[152]?>:</strong>
                                    <span><?=$this->players['account']['email'];?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-phone position-left"></i> <?=$lng[97]?>:</strong>
                                    <span><?=$this->players['account']['phone1'];?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-cash position-left"></i> <?=$lng[17]?>:</strong>
                                    <span><?=$this->players['account'][CASH];?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-cash2 position-left"></i> <?=$lng[18]?>:</strong>
                                    <span><?=$this->players['account'][MILEAGE];?></span>
                                </div>
                            </div>
                            <h3><?=$lng[108]?></h3>
                                <?php foreach ($this->players['player'] as $key=>$row):?>
                                    <a href="<?=URI::get_path("detail/player/".$row['name'])?>">
                            <div id="profileBox" class="player-table" style="float: left;width: 49%;">
                                <div class="player-row">
                                    <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                                    <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></span></center><br>
                                    <center><span><?=$lng[33]?> : <?=Functions::jobName($row['job']);?></span></center>
                                    <center><span><?=$lng[68]?> : <?=$row['level'];?></span></center>
                                    <center><span><?=$lng[40]?> : <?=$row['playtime'];?> <?=$lng[42]?>.</span></center>
                                    <center><span><?=$lng[39]?> : <?=Functions::zaman($row['last_play']);?></span></center>
                                </div>
                            </div>
                                    </a>
                                <?php endforeach;?>
                        </div>
                        <div class="player-flag" style="background-color: rgba(84,14,14,0);"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>