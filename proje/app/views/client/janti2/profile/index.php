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
                Kontrol Paneli </center>
        </div>
        <div class="panel-body">
            <table height="30" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <th class="kontrolPaneliBilgiSol" width="184">Hesap Adı:</th>
                        <td class="kontrolPaneliBilgiSag" width="495"><?=$this->players['account']['login'];?></td>
                    </tr>
                    <tr>
                        <th class="kontrolPaneliBilgiSol" width="184">E-Posta Adresi:</th>
                        <td class="kontrolPaneliBilgiSag" width="495"><?=$this->players['account']['email'];?></td>
                    </tr>
                    <tr>
                        <th class="kontrolPaneliBilgiSol" width="184">Ejderha Parası:</th>
                        <td class="kontrolPaneliBilgiSag" width="495"><?=$this->players['account'][CASH];?></td>
                    </tr>
                    <tr>
                        <th class="kontrolPaneliBilgiSol" width="184">E.M Parası:</th>
                        <td class="kontrolPaneliBilgiSag" width="495"><?=$this->players['account'][MILEAGE];?></td>
                    </tr>
                    <tr>
                        <th class="kontrolPaneliBilgiSol" width="184">Telefon Numarası:</th>
                        <td class="kontrolPaneliBilgiSag" width="495"><?=$this->players['account']['phone1'];?></td>
                    </tr>

                </tbody>
            </table>
            <br>
            <a class="button kontrolPaneliGenislik" href="<?=URL.SHOP?>" class="btn btn-giris itemshop itemshop-btn iframe">Market</a>
            <a class="button kontrolPaneliGenislik" href="<?=URL.MUTUAL?>" class="btn btn-giris itemshop itemshop-btn iframe">Destek Sistemi</a>
            <a class="button kontrolPaneliGenislik" href="<?=URI::get_path('profile/email')?>">E-Posta Değiştir</a>
            <a class="button kontrolPaneliGenislik" href="<?=URI::get_path('profile/password')?>">Şifre Değiştir</a>
            <a class="button kontrolPaneliGenislik" href=<?=URI::get_path('profile/ksk')?>">Karakter Silme Şifresi Değiştir</a>
            <a class="button kontrolPaneliGenislik" href="<?=URI::get_path('profile/depo')?>">Depo Şifre İste</a>
			<?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/pin')?>" class="button kontrolPaneliGenislik">Pin Değiştir</a>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/iks')?>" class="button kontrolPaneliGenislik">İtem Kilit Değiştir</a>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/hgs')?>" class="button kontrolPaneliGenislik">Hesap Kilit Değiştir</a>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/kgs')?>" class="button kontrolPaneliGenislik">Karakter Kilit Değiştir</a>
			<?php endif;?>
			<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
				<a href="<?=URI::get_path('profile/gpc')?>" class="button kontrolPaneliGenislik">GüvenliPC Pasifleştir</a>
			<?php endif;?>
            <a class="button kontrolPaneliGenislik" href="<?=URI::get_path('login/logout')?>">Çıkış Yap</a>
        </div>
    </div>
</main>