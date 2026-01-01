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
<div class="col-md-9 normal-content">
    <div class="row">
        <ol class="breadcrumb grunge">
            <li><a href="index.php">Anasayfa</a></li>
            <li class="active">Kontrol Paneli</li>
        </ol>
    </div>
	<?php if ($status == 'BLOCK'):?>
		<?=Client::alert('warning',$lng[137]); ?>
        <h3 style="text-align: center"><?=$lng[149]?></h3>
        <center><h4><?=$this->players['ban']['why']?></h4></center><br>
		<?php if ($this->players['ban']['evidence'] != ''):?>
        <h3 style="text-align: center"><?=$lng[150]?></h3>
        <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
	<?php endif;?>
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
        <span class="clear"><!-- --></span>
		<?=Functions::bracket();?>
        <center><h4>Kullanıcı Adı : <?=$this->players['account']['login'];?></h4></center>
		<?=Functions::bracket();?>
        <center><h4>Email : <?=$this->players['account']['email'];?></h4></center>
		<?=Functions::bracket();?>
        <center><h4>Telefon : <?=$this->players['account']['phone1'];?></h4></center>
		<?=Functions::bracket();?>
        <center><h4>Ep Miktarı : <?=$this->players['account']['cash'];?></h4></center>
		<?=Functions::bracket();?>
        <center><h4>Em Miktarı : <?=$this->players['account']['mileage'];?></h4></center>
		<?=Functions::bracket();?>
        <div class="col-md-6">
            <a href="<?=URI::get_path('profile/password')?>"><button class="btn btn-block btn-grunge"><?=$lng[141]?></button></a><br>
            <a href="<?=URI::get_path('profile/email')?>"><button class="btn btn-block btn-grunge"><?=$lng[142]?></button></a><br>
            <a href="<?=URI::get_path('profile/depo')?>"><button class="btn btn-block btn-grunge"><?=$lng[143]?></button></a><br>
            <a href="<?=URI::get_path('profile/ksk')?>"><button class="btn btn-block btn-grunge"><?=$lng[144]?></button></a><br>
            <a href="<?=URI::get_path('profile/save')?>"><button class="btn btn-block btn-grunge"><?=$lng[145]?></button></a><br>
            <?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/pin')?>" ><button class="btn btn-block btn-grunge">Pin Değiştir</button></a><br>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/iks')?>" ><button class="btn btn-block btn-grunge">İtem Kilit Değiştir</button></a><br>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/hgs')?>" ><button class="btn btn-block btn-grunge">Hesap Kilit Değiştir</button></a><br>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/kgs')?>" ><button class="btn btn-block btn-grunge">Karakter Kilit Değiştir</button></a><br>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/gpc')?>" ><button class="btn btn-block btn-grunge">GüvenliPC Pasifleştir</button></a><br>
			<?php endif;?>
			<a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><button class="btn btn-block btn-grunge"><?=$lng[147]?></button></a><br>
            <a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><button class="btn btn-block btn-grunge"><?=$lng[146]?></button></a><br>
            <a href="<?=URI::get_path('login/logout')?>"><button type="submit" class="btn btn-block btn-grunge"><?=$lng[148]?></button></a><br>
        </div>
        <div class="col-md-6">

			<?php foreach ($this->players['player'] as $key=>$row):?>
                <div class="login-cont frame">
                    <div class="frame-inner" style="padding:1px 15px 5px; ">
                        <div class="portrait-row">
                            <div class="col-md-5">
                                <a class="portrait-left-col" href="<?=URI::get_path("detail/player/".$row['name'])?>">
		                    <span class="icon-portrait icon-frame">
                                <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>">
			                    <span class="frame"></span>
		                    </span>
                                </a>
                            </div>
                            <div class="portrait-right-col">
                                <h3 class="header-3" style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></h3>
                                <strong><?=$lng[36]?> : </strong><strong><?=Functions::jobName($row['job']);?></strong><br>
								<?=$lng[68]?> : <strong><?=$row['level'];?></strong><br>
								<?=$lng[40]?> : <strong><?=$row['playtime'];?> <?=$lng[42]?></strong><br>
								<?=$lng[39]?> : <strong><?=Functions::zaman($row['last_play']);?></strong><br>
                            </div>
                            <span class="clear"><!-- --></span>
                        </div>
                    </div>
                </div>
			<?php endforeach;?>
        </div>
</div>