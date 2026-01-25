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
<div class="title">
	<?=$lng[136]?>
</div>
<div class="news page">
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
    <div class="entry">
		<?php if ($status == 'OK' && $availDt <= $now):?>
            <table style="width:100%;margin: 0 auto;" class="tablesorter">
                <tbody>
                <tr>
                    <td style="width:50%;text-align: left;color: #c9aa71;"><?=$lng[22]?></td>
                    <td style="width:50%;text-align: left;"><?=$this->players['account']['login'];?></td>
                </tr>
                <tr style="height:15px;">
                    <td style="width:50%;text-align: left;color: #c9aa71;"><?=$lng[152]?></td>
                    <td style="width:50%;text-align: left;"><?=$this->players['account']['email'];?></td>
                </tr>
                <tr>
                    <td style="width:50%;text-align: left;color: #c9aa71;">Telefon</td>
                    <td style="width:50%;text-align: left;"><?=$this->players['account']['phone1'];?></td>
                </tr>
                <tr>
                    <td style="width:50%;text-align: left;color: #c9aa71;"><?=$lng[17]?></td>
                    <td style="width:50%;text-align: left;color: #83bb6d;text-shadow: 0px 0px 14px #83bb6d;"><?=$this->players['account'][CASH];?> <sup>EP</sup></td>
                </tr>
                <tr>
                    <td style="width:50%;text-align: left;color: #c9aa71;"><?=$lng[18]?></td>
                    <td style="width:50%;text-align: left;color: #83bb6d;text-shadow: 0px 0px 14px #83bb6d;"><?=$this->players['account'][MILEAGE];?> <sup>EM</sup></td>
                </tr>
                </tbody>
            </table>
		<?php else:?>
            <h3><?=$lng[149]?></h3>
            <center><h4><?=$this->players['ban']['why']?></h4></center><br>
			<?php if ($this->players['ban']['evidence'] != ''):?>
                <h3><?=$lng[150]?></h3>
                <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
			<?php endif;?>
		<?php endif;?>

        <br>

        <div class="kayip-buttonlar2-cp" style="margin-top: 10px;margin-bottom: 10px;">
            <a href="<?=URI::get_path('profile/password')?>">
                <button  class="btn"><?=$lng[141]?></button>
            </a>
            <a href="<?=URI::get_path('profile/email')?>" style="margin-left: 15px;">
                <button class="btn"><?=$lng[142]?></button>
            </a>
            <a href="<?=URI::get_path('profile/depo')?>" style="margin-left: 15px;">
                <button class="btn"><?=$lng[143]?></button>
            </a>
			<?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
                <a href="<?=URI::get_path('profile/pin')?>" style="margin-left: 15px;">
                    <button class="btn">PIN Değiştir</button>
                </a>
            <?php else:?>
                <a href="<?=URI::get_path('profile/aktive')?>" style="margin-left: 15px;">
                    <button class="btn"><?=$lng[98]?></button>
                </a>
			<?php endif;?>
        </div>
		<div class="kayip-buttonlar2-cp" style="margin-top: 10px;margin-bottom: 10px;">
			<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/iks')?>" style="margin-left: 15px;"><button class="btn">İtem Kilit Değiştir</button></a>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/hgs')?>" style="margin-left: 15px;"><button class="btn">Hesap Kilit Değiştir</button></a>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/kgs')?>" style="margin-left: 15px;"><button class="btn">Karakter Kilit Değiştir</button></a>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/gpc')?>" style="margin-left: 15px;"><button class="btn">GüvenliPC Pasifleştir</button></a>
			<?php endif;?>
        </div>
        <div class="kayip-buttonlar2-cp" style="margin-top: 10px;margin-bottom: 10px;">
            <a href="<?=URI::get_path('profile/ksk')?>">
                <button class="btn"><?=$lng[144]?></button>
            </a>
            <a href="<?=URL.SHOP?>" class="itemshop itemshop-btn iframe" style="margin-left: 15px;">
                <button class="btn"><?=$lng[147]?></button>
            </a>
            <a href="<?=URL.MUTUAL?>" class="itemshop itemshop-btn iframe" style="margin-left: 15px;">
                <button class="btn"><?=$lng[146]?></button>
            </a>
            <a href="<?=URI::get_path('login/logout')?>" style="margin-left: 15px;">
                <button class="btn"><?=$lng[148]?></button>
            </a>
        </div>

		<?php foreach ($this->players['player'] as $key=>$row):?>
            <a href="javascript:void(0)">
                <div id="profileBox" class="player-table detail-section">
                    <div class="player-row">
                        <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                        <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></span></center><br>
                        <center><span><?=$lng[33]?> : <?=Functions::jobName($row['job']);?></span></center>
                        <center><span><?=$lng[68]?> : <?=$row['level'];?></span></center>
                        <center><span><?=$lng[40]?> : <?=$row['playtime'];?> <?=$lng[42]?>.</span></center>
                        <center><span><?=$lng[39]?> : <?=$row['last_play'];?></span></center>
                    </div>
                </div>
            </a>
		<?php endforeach;?>
    </div>
</div>