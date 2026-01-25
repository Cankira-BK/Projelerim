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
<link rel="stylesheet" href="<?=URI::public_path()?>extra/css/account-panel.css"/>
<div class="panel panel-buyuk">
    <div class="panel-heading"><?=$lng[136]?> <a href="<?=URI::get_path('index')?>" class="back-to-account" title="Geri"></a></div>
    <div class="panel-body">
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
			<table style="width:100%;margin: 0 auto;" class="ranking-table">
				<thead>
					<tr class="main-tr">
						<th colspan="2">Hesap Bilgileri</th>
					</tr>
				</thead>
                <tbody>
					<tr>
                        <td style="width:50%;text-align: left;"><?=$lng[22]?></td>
                        <td style="width:50%;text-align: left;"><?=$this->players['account']['login'];?></td>
                    </tr>
                    <tr style="height:15px;">
                        <td style="width:50%;text-align: left;"><?=$lng[152]?></td>
                        <td style="width:50%;text-align: left;"><?=$this->players['account']['email'];?></td>
                    </tr>
                    <tr>
                        <td style="width:50%;text-align: left;">Telefon</td>
                        <td style="width:50%;text-align: left;"><?=$this->players['account']['phone1'];?></td>
                    </tr>
                    <tr>
                        <td style="width:50%;text-align: left;"><?=$lng[17]?></td>
                        <td style="width:50%;text-align: left;"><?=$this->players['account'][CASH];?> <sup>EP</sup></td>
                    </tr>
                    <tr>
                        <td style="width:50%;text-align: left;"><?=$lng[18]?></td>
                        <td style="width:50%;text-align: left;"><?=$this->players['account'][MILEAGE];?> <sup>EM</sup></td>
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
        </div>

		<br>

		<div class="kayip-buttonlar2-cp" style="display: block; min-height: 250px">
			<a href="<?=URI::get_path('profile/password')?>" class="btn btn-giris"><i class="glyphicon glyphicon-lock"></i> &nbsp; <?=$lng[141]?></a>
			<a href="<?=URI::get_path('profile/email')?>" class="btn btn-giris" ><i class="glyphicon glyphicon-envelope"></i> &nbsp; <?=$lng[142]?></a>
			<a href="<?=URI::get_path('profile/depo')?>" class="btn btn-giris" style="margin-left: 15px;"><i class="glyphicon glyphicon-folder-close"></i> &nbsp; <?=$lng[143]?></a>
			<a href="<?=URI::get_path('profile/save')?>" class="btn btn-giris"><i class="glyphicon glyphicon-hourglass"></i> &nbsp; <?=$lng[145]?></a>
			<a href="<?=URI::get_path('profile/ksk')?>" class="btn btn-giris" style="margin-left: 15px;"><i class="glyphicon glyphicon-folder-close"></i> &nbsp; <?=$lng[144]?></a>
			<?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>				<a href="<?=URI::get_path('profile/pin')?>" class="btn btn-giris" style="margin-left: 15px;"><i class="glyphicon glyphicon-folder-close"></i> &nbsp; Pin Değiştir</a>			<?php endif;?>			<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>				<a href="<?=URI::get_path('profile/iks')?>" class="btn btn-giris" style="margin-left: 15px;"><i class="glyphicon glyphicon-folder-close"></i> &nbsp; İtem Kilit Değiştir</a>			<?php endif;?>			<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>				<a href="<?=URI::get_path('profile/hgs')?>" class="btn btn-giris" style="margin-left: 15px;"><i class="glyphicon glyphicon-folder-close"></i> &nbsp; Hesap Kilit Değiştir</a>			<?php endif;?>			<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>				<a href="<?=URI::get_path('profile/kgs')?>" class="btn btn-giris" style="margin-left: 15px;"><i class="glyphicon glyphicon-folder-close"></i> &nbsp; Karakter Kilit Değiştir</a>			<?php endif;?>			<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>				<a href="<?=URI::get_path('profile/gpc')?>" class="btn btn-giris" style="margin-left: 15px;"><i class="glyphicon glyphicon-folder-close"></i> &nbsp; GüvenliPC Pasifleştir</a>			<?php endif;?>						<a href="<?=URL.SHOP?>" class="btn btn-giris itemshop itemshop-btn iframe"><i class="glyphicon glyphicon-lock"></i> &nbsp; <?=$lng[147]?></a>
			<a href="<?=URL.MUTUAL?>" class="btn btn-giris itemshop itemshop-btn iframe" style="margin-left: 15px;"><i class="glyphicon glyphicon-comment"></i> &nbsp; <?=$lng[146]?></a>
			<a href="<?=URI::get_path('login/logout')?>" class="btn btn-giris"><i class="glyphicon glyphicon-log-out"></i> &nbsp; <?=$lng[148]?></a>

		</div>

		<?php foreach ($this->players['player'] as $key=>$row):?>
			<a href="<?=URI::get_path("detail/player/".$row['name'])?>">
				<div id="profileBox" class="player-table detail-section" style="float: left;width: 50%;">
					<div class="player-row">
						<img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="display: block;margin-left: auto;margin-right: auto;">
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