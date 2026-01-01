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
<style>
    .player-table {
        background-color: rgba(250, 250, 250, .09);
        border: 1px solid rgba(103, 65, 55, .6);
        margin-bottom: 2%;
    }
    .player-table .player-row {
        background-color: rgba(48, 40, 32, 0.6);
        border-bottom: 1px solid rgba(103, 65, 55, .6);
        padding: 10px;
    }
    .panel-download .col-50 strong, .panel-player .player-info strong, .player-table .player-row strong {
        font-weight: 700;
    }
</style>
<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="padding-left:20px; padding-right:20px;">
                <span class="title"><?=$lng[136]?></span>
                <!-- register -->
                <div class="store-activity">
                    <div class="container_3 account-wide" align="center">
                        <p style="padding: 20px;">
                            <!-- FORMS -->
                        </p>
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
                                    <h3 style="color: #776255;margin-top: 27px;font-weight: bold;"><?=$lng[140]?></h3>
                                    <br>
                                    <!--                            <a href="--><?//=URI::get_path('profile/secure')?><!--"><button class="btn">Güvenli PC</button></a><br>-->
                                    <a href="<?=URI::get_path('profile/password')?>"><button class="wbuttons wbuttons-bt"><?=$lng[141]?></button></a><br>
                                    <a href="<?=URI::get_path('profile/email')?>"><button class="wbuttons wbuttons-bt"><?=$lng[142]?></button></a><br>
                                    <a href="<?=URI::get_path('profile/depo')?>"><button class="wbuttons wbuttons-bt"><?=$lng[143]?></button></a><br>
                                    <a href="<?=URI::get_path('profile/ksk')?>"><button class="wbuttons wbuttons-bt"><?=$lng[144]?></button></a><br>
                                    <a href="<?=URI::get_path('profile/save')?>"><button class="wbuttons wbuttons-bt"><?=$lng[145]?></button></a><br>
                                    <?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
										<a href="<?=URI::get_path('profile/pin')?>"><button class="wbuttons wbuttons-bt">Pin Değiştir</button></a>
									<?php endif;?>
									<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
										<a href="<?=URI::get_path('profile/iks')?>"><button class="wbuttons wbuttons-bt">İtem Kilit Değiştir</button></a>
									<?php endif;?>
									<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
										<a href="<?=URI::get_path('profile/hgs')?>"><button class="wbuttons wbuttons-bt">Hesap Kilit Değiştir</button></a>
									<?php endif;?>
									<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
										<a href="<?=URI::get_path('profile/kgs')?>"><button class="wbuttons wbuttons-bt">Karakter Kilit Değiştir</button></a>
									<?php endif;?>
									<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
										<a href="<?=URI::get_path('profile/gpc')?>"><button class="wbuttons wbuttons-bt">GüvenliPC Pasifleştir</button></a>
									<?php endif;?>
									<a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><button class="wbuttons wbuttons-bt"><?=$lng[146]?></button></a><br>
                                    <a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>?pid=<?=$pid?>&sas=<?=$sas?>&sid=1"><button class="wbuttons wbuttons-bt"><?=$lng[147]?></button></a><br>
                                    <a href="<?=URI::get_path('login/logout')?>"><button type="submit" class="wbuttons wbuttons-bt"><?=$lng[148]?></button></a><br><br>
								<?php else:?>
                                    <h3 style="color: #776255;margin-top: 27px;font-weight: bold;"><?=$lng[149]?></h3>
                                    <center><h4><?=$this->players['ban']['why']?></h4></center><br>
									<?php if ($this->players['ban']['evidence'] != ''):?>
                                        <h3><?=$lng[150]?></h3>
                                        <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
									<?php endif;?>
								<?php endif;?>
                                <h3 style="color: #776255;margin-top: 27px;font-weight: bold;"><?=$lng[151]?></h3><br>
                                <div class="player-table">
                                    <div class="player-row">
                                        <strong><i class="icon-man position-left"></i> <?=$lng[22]?>:</strong>
                                        <span><?=$this->players['account']['login'];?></span>
                                    </div>

                                    <div class="player-row">
                                        <strong><i class="icon-height position-left"></i> Email:</strong>
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
                                <h3 style="color: #776255;margin-top: 27px;font-weight: bold;">Karakterlerim</h3><br>
								<?php foreach ($this->players['player'] as $key=>$row):?>
                                    <a href="<?=URI::get_path("detail/player/".$row['name'])?>">
                                        <div id="profileBox" class="player-table" style="width: 49%;">
                                            <div class="player-row">
                                                <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                                                <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></span></center><br>
                                                <center><span><?=$lng[33]?> : <?=Functions::jobName($row['job']);?></span></center>
                                                <center><span><?=$lng[68]?> : <?=$row['level'];?></span></center>
                                                <center><span><?=$lng[40]?> : <?=$row['playtime'];?> <?=$lng[42]?></span></center>
                                                <center><span><?=$lng[39]?> : <?=Functions::zaman($row['last_play']);?></span></center>
                                            </div>
                                        </div>
                                    </a>
								<?php endforeach;?>
                            </div>
                            <div class="player-flag" style="background-color: rgba(84,14,14,0);"></div>
                        </div>
                        <br />
                        <br />
                        <br />
                        <!-- FORMS.End -->
                    </div>
                </div>
                <!-- register.End -->
            </div>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>