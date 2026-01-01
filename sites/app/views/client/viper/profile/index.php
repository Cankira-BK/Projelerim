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
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[136]?>
            </center>
        </div>
        <div class="panel-body">
            <table height="30" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <th class="control-panel-left" width="184">Hesap Adı:</th>
                        <td class="control-panel-right" width="495"><?=$this->players['account']['login'];?></td>
                    </tr>
                    <tr>
                        <th class="control-panel-left" width="184">E-Posta Adresi:</th>
                        <td class="control-panel-right" width="495"><?=$this->players['account']['email'];?></td>
                    </tr>
                    <tr>
                        <th class="control-panel-left" width="184">Ejderha Parası:</th>
                        <td class="control-panel-right" width="495"><?=$this->players['account'][CASH];?></td>
                    </tr>
                    <tr>
                        <th class="control-panel-left" width="184">E.M Parası:</th>
                        <td class="control-panel-right" width="495"><?=$this->players['account'][MILEAGE];?></td>
                    </tr>
                    <tr>
                        <th class="control-panel-left" width="184">Telefon Numarası:</th>
                        <td class="control-panel-right" width="495"><?=$this->players['account']['phone1'];?></td>
                    </tr>

                </tbody>
            </table>
            <br>
			<?php if ($status == 'BLOCK'):?>
				<?=Client::alert('warning',$lng[137]); ?>
			<?php elseif ($availDt > $now):?>
				<?=Client::alert('warning',$lng[138]); ?>
                <div class="bg-light item-container" style="margin-bottom: 50px;">
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
            <br>
			<?php if ($status == 'OK' && $availDt <= $now):?>
                <h3><?=$lng[140]?></h3>
                <a class="button control-panel-button itemshop itemshop-btn iframe" href="<?=URL.SHOP?>"><?=$lng[147]?></a>
                <a class="button control-panel-button itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>"><?=$lng[146]?></a>
                <a class="button control-panel-button" href="<?=URI::get_path('profile/email')?>"><?=$lng[142]?></a>
                <a class="button control-panel-button" href="<?=URI::get_path('profile/password')?>"><?=$lng[141]?></a>
				<?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
					<a href="<?=URI::get_path('profile/pin')?>" class="button control-panel-button">Pin Değiştir</a>
				<?php endif;?>
				<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
					<a href="<?=URI::get_path('profile/iks')?>" class="button control-panel-button">İtem Kilit Değiştir</a>
				<?php endif;?>
				<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
					<a href="<?=URI::get_path('profile/hgs')?>" class="button control-panel-button">Hesap Kilit Değiştir</a>
				<?php endif;?>
				<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
					<a href="<?=URI::get_path('profile/kgs')?>" class="button control-panel-button">Karakter Kilit Değiştir</a>
				<?php endif;?>
				<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
					<a href="<?=URI::get_path('profile/gpc')?>" class="button control-panel-button">GüvenliPC Pasifleştir</a>
				<?php endif;?>
                <a class="button control-panel-button" href="<?=URI::get_path('profile/ksk')?>"><?=$lng[144]?></a>
                <a class="button control-panel-button" href="<?=URI::get_path('profile/depo')?>"><?=$lng[143]?></a>
                <a class="button control-panel-button" href="<?=URI::get_path('profile/save')?>"><?=$lng[145]?></a>
                <a class="button control-panel-button" href="<?=URI::get_path('login/logout')?>"><?=$lng[148]?></a>
			<?php else:?>
                <h3><?=$lng[149]?></h3>
                <center><h4><?=$this->players['ban']['why']?></h4></center><br>
				<?php if ($this->players['ban']['evidence'] != ''):?>
                    <h3><?=$lng[150]?></h3>
                    <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
				<?php endif;?>
			<?php endif;?>

            <h3><?=$lng[108]?></h3>
			<?php foreach ($this->players['player'] as $key=>$row):?>
                <a href="<?=URI::get_path("detail/player/".$row['name'])?>">
                    <div id="profileBox" class="player-table" style="float: left;width: 49%;background: #01010b url(<?=URI::public_path('assets/images/best-block-bg.png')?>) bottom right no-repeat;">
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
    </div>
</main>