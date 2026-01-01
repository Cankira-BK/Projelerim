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
<div role="main">
    <div id="register" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <div class="administration-inner-content">
                    <div class="input-data-box">
                        <h4><?=$lng[136]?></h4>
						<?php if ($status == 'BLOCK'):?>
							<?=Client::alert('warning',$lng[137]); ?>
                            <h3><?=$lng[149]?></h3>
                            <center><h4><?=$this->players['ban']['why']?></h4></center><br>
							<?php if ($this->players['ban']['evidence'] != ''):?>
                            <h3><?=$lng[150]?></h3>
                            <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
						<?php endif;?>
						<?php elseif ($availDt > $now):?>
							<?=Client::alert('warning',$lng[138]); ?>
                            <div class="bg-light item-container">
                                <center><span id="say" style="font-weight: bold;font-size: 45px;"><?=$fark?></span><br> <?=$lng[139]?></center>
                            </div>
                            <h3><?=$lng[149]?></h3>
                            <center><h4><?=$this->players['ban']['why']?></h4></center><br>
						<?php if ($this->players['ban']['evidence'] != ''):?>
                            <h3><?=$lng[150]?></h3>
                            <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
						<?php endif;?>
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
                        <ul>
                            <li><?=$lng[23]?>: <br><b><?=$this->players['account']['login'];?></b></li>
                            <li><?=$lng[152]?>: <br><b><?=$this->players['account']['email'];?></b></li>
                            <li><?=$lng[97]?>: <br><b><?=$this->players['account']['phone1'];?></b></li>
                            <li><?=$lng[17]?>: <br><b><?=$this->players['account'][CASH];?></b></li>
                            <li><?=$lng[18]?>: <br><b><?=$this->players['account'][MILEAGE];?></b></li>
                        </ul>
                        <br>
                        <div class="administration-box"><a href="<?=URI::get_path('profile/password')?>" class="btn"><?=$lng[141]?></a>
                            <p><?=$lng[179]?></p>
                        </div>
                        <div class="administration-box"><a href="<?=URI::get_path('profile/email')?>" class="btn"><?=$lng[142]?></a>
                            <p><?=$lng[180]?></p>
                        </div>
                        <div class="administration-box"><a href="<?=URI::get_path('profile/depo')?>" class="btn"><?=$lng[143]?></a>
                            <p><?=$lng[181]?></p>
                        </div>
                        <div class="administration-box"><a href="<?=URI::get_path('profile/ksk')?>" class="btn"><?=$lng[144]?></a>
                            <p><?=$lng[182]?></p>
                        </div>
                        <div class="administration-box"><a href="<?=URI::get_path('profile/save')?>" class="btn"><?=$lng[145]?></a>
                            <p><?=$lng[183]?></p>
                        </div>
						<?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
							<div class="administration-box"><a href="<?=URI::get_path('profile/pin')?>" class="btn">Pin Değiştir</a></div>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
							<div class="administration-box"><a href="<?=URI::get_path('profile/iks')?>" class="btn">İtem Kilit Değiştir</a></div>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
							<div class="administration-box"><a href="<?=URI::get_path('profile/hgs')?>" class="btn">Hesap Kilit Değiştir</a></div>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
							<div class="administration-box"><a href="<?=URI::get_path('profile/kgs')?>" class="btn">Karakter Kilit Değiştir</a></div>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
							<div class="administration-box"><a href="<?=URI::get_path('profile/gpc')?>" class="btn">GüvenliPC Pasifleştir</a></div>
						<?php endif;?>
                        <div class="administration-box"><a class="btn itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[147]?></a>
                            <p><?=$lng[184]?></p>
                        </div>
                        <div class="administration-box"><a href="<?=URL.MUTUAL?>" class="btn itemshop itemshop-btn iframe"><?=$lng[146]?></a>
                            <p><?=$lng[185]?></p>
                        </div>
                        <div class="administration-box"><a href="<?=URI::get_path('login/logout')?>" class="btn"><?=$lng[148]?></a>
                            <p><?=$lng[186]?></p>
                        </div>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div></div>