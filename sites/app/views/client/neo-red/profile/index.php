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
<div class="col-md-9"><div class="col-md-12 no-padding">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[136]?></div>
            <div class="panel-body">
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
                    <h3><?=$lng[149]?></h3>
                    <center><h4><?=$this->players['ban']['why']?></h4></center><br>
				<?php if ($this->players['ban']['evidence'] != ''):?>
                    <h3><?=$lng[150]?></h3>
                    <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
				<?php endif;?>
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
                <div class="col-md-6">
                    <div class="list-group">
                        <a href="<?=URI::get_path('profile/password')?>" class="list-group-item"><?=$lng[141]?></a>
                        <a href="<?=URI::get_path('profile/email')?>" class="list-group-item"><?=$lng[142]?></a>
                        <a href="<?=URI::get_path('profile/depo')?>" class="list-group-item"><?=$lng[143]?></a>
                        <a href="<?=URI::get_path('profile/ksk')?>" class="list-group-item"><?=$lng[144]?></a>
                        <a href="<?=URI::get_path('profile/save')?>" class="list-group-item"><?=$lng[145]?></a>
                        <?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/pin')?>" class="list-group-item">Pin Değiştir</a>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/iks')?>" class="list-group-item">İtem Kilit Değiştir</a>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/hgs')?>" class="list-group-item">Hesap Kilit Değiştir</a>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/kgs')?>" class="list-group-item">Karakter Kilit Değiştir</a>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/gpc')?>" class="list-group-item">GüvenliPC Pasifleştir</a>
						<?php endif;?>
						<a href="<?=URL.SHOP?>" class="list-group-item itemshop itemshop-btn iframe"><?=$lng[147]?></a>
                        <a href="<?=URL.MUTUAL?>" class="list-group-item itemshop itemshop-btn iframe"><?=$lng[146]?></a>
                        <a href="<?=URI::get_path('login/logout')?>" class="list-group-item"><?=$lng[148]?></a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="list-group">
                        <div class="list-group-item"><b><?=$lng[23]?> :</b> <?=$this->players['account']['login'];?></div>
                        <div class="list-group-item"><b><?=$lng[152]?> :</b> <?=$this->players['account']['email'];?> </div>
                        <div class="list-group-item"><b><?=$lng[97]?> :</b> <?=$this->players['account']['phone1'];?></div>
                        <div class="list-group-item"><b><?=$lng[17]?> :</b> <?=$this->players['account'][CASH];?></div>
                        <div class="list-group-item"><b><?=$lng[18]?> :</b> <?=$this->players['account'][MILEAGE];?></div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>