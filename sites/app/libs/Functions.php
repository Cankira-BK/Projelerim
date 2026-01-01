<?php

class Functions
{
	public static function utf8($char)
	{
		return mb_convert_encoding($char, "UTF-8", "ISO-8859-9");
	}

	public static function latin1($char)
	{
		return mb_convert_encoding($char, "ISO-8859-9", "UTF-8");
	}

	public static function gameIn($arg)
	{
		if ($arg == 'taslar') {
			$data = array(
				'0' => 'Taş Yok',
				'1' => 'Taş Slotu Aktif',
				'28430' => 'Kavrama Taşı +4',
				'28431' => 'Öldürücü Darbe Taşı +4',
				'28432' => 'Soğutma Taşı +4',
				'28433' => 'Şavaşçıdan Koruyan Taş +4',
				'28434' => 'Ninjadan Koruyan Taş +4',
				'28435' => 'Suradan Koruyan Taş +4',
				'28436' => 'Şamandan Koruyan Taş +4',
				'28437' => 'Canavardan Koruyan Taş +4',
				'28438' => 'Korunma Taşı +4',
				'28439' => 'Kurnazlık Taşı +4',
				'28440' => 'Sihir Taşı +4',
				'28441' => 'Yaşam Taşı +4',
				'28442' => 'Savunma Taşı +4',
				'28443' => 'Hız Taşı +4'
			);
		} elseif ($arg == 'efsunlar') {
			$data = array(
				'0' => 'Efsun Yok',
				'1' => 'Max HP +',
				'2' => 'Max SP +',
				'3' => 'Yasam Enerjisi +',
				'4' => 'Zeka +',
				'5' => 'Guc +',
				'6' => 'ceviklik +',
				'7' => 'Saldiri Hizi +',
				'8' => 'Hareket Hizi +',
				'9' => 'Buyu Hizi',
				'10' => 'HP uretimi %',
				'11' => 'SP uretimi %',
				'12' => 'Zehirleme Degisimi %',
				'13' => 'Sersemletme Degisimi %',
				'14' => 'Yavaslik Degisimi %',
				'15' => 'Kritik Vurus sansi %',
				'16' => 'Delici Vurus sansi %',
				'17' => 'Yari insanlara Karsi Guclu %',
				'18' => 'Hayvanlara Karsi Guclu %',
				'19' => 'Orklara Karsi Guclu %',
				'20' => 'Mistiklere Karsi Guclu %',
				'21' => 'Ölumsuzlere Karsi Guclu %',
				'22' => 'seytanlara Karsi Guclu %',
				'23' => 'Hasar HP Tarafindan Emilicek %',
				'24' => 'Hasar SP Tarafindan Emilicek %',
				'25' => 'Dusmanin Spsini calma Sansi %',
				'26' => 'Vurus Yapildiginda Spyi geri calma %',
				'27' => 'Beden Karsisindaki Ataklarin Bloklanmasi %',
				'28' => 'Oklardan Korunma sansi %',
				'29' => 'Kilic Savunmasi %',
				'30' => 'cift-El Savunmasi %',
				'31' => 'Bicak Savunmasi %',
				'32' => 'can Savunmasi %',
				'33' => 'Yelpaze Savunmasi %',
				'34' => 'Oka Karsi Dayaniklilik %',
				'35' => 'Atese Karsi Dayaniklilik %',
				'36' => 'Simgeye Karsi Dayaniklilik %',
				'37' => 'Buyuye Karsi Dayaniklilik %',
				'38' => 'Ruzgar Dayanikliligi %',
				'39' => 'Vucut Darbesini Yansitma sansi %',
				'40' => 'Lanet Yansitilmasi %',
				'41' => 'Zehre Karsi Koyma %',
				'42' => 'Sp Yuklenmesi Degisti',
				'43' => 'Yang Dusme sansi %',
				'44' => 'Yang Dusme sansi %',
				'45' => 'Esya Dusme sansi %',
				'46' => 'Trank effekt zuwachs %',
				'47' => 'HP Yuklenmesi Degisti %',
				'48' => 'Sersemletme Karsisinda Bagisiklik %',
				'49' => 'Yavaslatma Karsisinda Bagisiklik %',
				'50' => 'imun gegen Sturzen',
				'52' => 'Bogenreichweite +',
				'53' => 'Saldiri Degeri +',
				'54' => 'Savunma +',
				'55' => 'Buyulu Saldiri Degeri +',
				'56' => 'Buyulu Savunma +',
				'58' => 'Max Dayaniklilik +',
				'59' => 'Savascilara Karsi Guclu %',
				'60' => 'Ninjalara Karsi Guclu %',
				'61' => 'Suralara Karsi Guclu %',
				'62' => 'samanlara Karsi Guclu %',
				'63' => 'Canavarlara Karsi Guclu %',
				'64' => 'Saldiri Degeri +',
				'65' => 'Savunma +',
				'66' => 'EXP +?%',
				'67' => 'Dropchance [Gegenstände]',
				'68' => 'Dropchance [Gold]',
				'71' => 'Beceri Hasari %',
				'72' => 'Ortalama Zarar %',
				'73' => 'Widerstand gegen Fertigkeitsschaden',
				'74' => 'durchschn. Schadenswiderstand',
				'76' => 'iCafe exp-bonus',
				'77' => 'iCafe Chance auf erbeuten von gegenständen',
				'78' => 'Savasci Saldirilarina Karsi Savunma %',
				'79' => 'Ninja Saldirilarina Karsi Savunma %',
				'80' => 'Sura Saldirilarina Karsi Savunma %',
				'81' => 'saman Saldirilarina Karsi Savunma %',
				'82' => 'Enerji +',
				'83' => 'Savunma +',
				'84' => 'Kostüm Bonusu %',
				'85' => 'Büyü Saldırı +',
				'86' => 'Büyü Saldırı / Yakın Dövüş Saldırı +',
				'87' => 'Buz Direnci +',
				'88' => 'Dünya Direnci +',
				'89' => 'Karanlık Direnci +',
				'90' => 'Kritik Vuruş Direnci +',
				'91' => 'Delici Vuruş Direnci +',
				'92' => 'Kanama Saldırısı +',
				'93' => 'Kanama Direnci +',
				'94' => 'Lycanlara Karşı Güçlü +',
				'95' => 'Lycanlara Karşı Savunma +',
				'96' => 'Pençelere Karşı Savunma +',
				'97' => 'Büyü Bozma %',
				'98' => 'Kılıç Savunması +',
				'99' => 'Çiftel Savunması +',
				'100' => 'Hançer Savunması +',
				'101' => 'Çan Savunması +',
				'102' => 'Yelpaze Savunması +',
				'103' => 'Ok Savunması +',
				'104' => 'Şimşeklerin Gücü +',
				'105' => 'Ateşin Gücü +',
				'106' => 'Buzun Gücü +',
				'107' => 'Rüzgarın Gücü +',
				'108' => 'Toprağın Gücü +',
				'109' => 'Karanlığın Gücü +',
				'110' => 'Yar. İns. Sal. Sav. Şansı %',
				'111' => 'Metin Taşlarına Karşı Güçlü %',
				'112' => 'Patronlara Karşı Güçlü %'
			);
		}
		return $data;
	}

	public static function replace_tr($text)
	{
		$text = trim($text);
		$search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', '?');
		$replace = array('c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', 'i');
		$new_text = str_replace($search, $replace, $text);
		return $new_text;
	}

	public static function alert($type,$text){
		if($type == 'success'){
			return '<div id="validation"><span class="success"><p>'.$text.'</p></span></div>';
		}elseif ($type == 'error'){
			return '<div id="validation"><span class="error"><p>'.$text.'</p></span></div>';
		}elseif ($type == 'info'){
			return '<div id="validation"><span class="warning"><p>'.$text.'</p></span></div>';
		}elseif ($type == 'warning'){
			return '<div class="alert alert-warning">'.$text.'</div>';
		}
	}
	
	public static function alert_admin($type,$text){
		if($type == 'success'){
			return '<div class="alert alert-success"><strong><center>'.$text.'</center></strong></div>';
		}elseif ($type == 'error'){
			return '<div class="alert alert-danger"><strong><center>'.$text.'</center></strong></div>';
		}elseif ($type == 'info'){
			return '<div class="alert alert-info"><strong><center>'.$text.'</center></strong></div>';
		}elseif ($type == 'warning'){
			return '<div class="alert alert-warning"><strong><center>'.$text.'</center></strong></div>';
		}
	}

	public static function online()
	{
		$getOnline = \StaticGame\StaticGame::sql("SELECT COUNT(*) as count FROM ".PLAYER_DB_NAME.".player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;");
		$count = $getOnline[0]['count'];
		if ($count == '0') {
			$newCount = $count;
		} else {
			$getFake = \StaticDatabase\StaticDatabase::settings('online');
			$newCount = $count + $getFake;
		}
		return $newCount;
	}

	public static function zaman($zaman)
	{
		$onceBol = explode(" ", $zaman);
		$gay = explode("-", $onceBol[0]);
		$sds = explode(":", $onceBol[1]);
		$zaman = mktime($sds[0], $sds[1], $sds[2], $gay[1], $gay[2], $gay[0]);
		$zaman_farki = time() - $zaman;
		$saniye = $zaman_farki;
		$dakika = round($zaman_farki / 60);
		$saat = round($zaman_farki / 3600);
		$gun = round($zaman_farki / 86400);
		$hafta = round($zaman_farki / 604800);
		$ay = round($zaman_farki / 2419200);
		$yil = round($zaman_farki / 29030400);
		if ($saniye < 60) {
			if ($saniye == 0) {
				return "Az Önce";
			} else {
				return 'Yaklaşık ' . $saniye . ' saniye önce';
			}
		} else if ($dakika < 60) {
			return 'Yaklaşık ' . $dakika . ' dakika önce';
		} else if ($saat < 24) {
			return 'Yaklaşık ' . $saat . ' saat önce';
		} else if ($gun < 7) {
			return 'Yaklaşık ' . $gun . ' gün önce';
		} else if ($hafta < 4) {
			return 'Yaklaşık ' . $hafta . ' hafta önce';
		} else if ($ay < 12) {
			return 'Yaklaşık ' . $ay . ' ay önce';
		} else {
			return 'Yaklaşık ' . $yil . ' yıl önce';
		}
	}
	
	public static function convertToHoursMins($time, $format = '%d:%s') 
	{
		settype($time, 'integer');
		if ($time < 0 || $time >= 1440) {
			return;
		}
		$hours = floor($time/60);
		$minutes = $time%60;
		if ($minutes < 10) {
			$minutes = '0' . $minutes;
		}
		return sprintf($format, $hours, $minutes);
	}
	
	public static function convertSecToStr($secs)
	{
		$output = '';
		if($secs >= 86400) {
			$days = floor($secs/86400);
			$secs = $secs%86400;
			$output = $days.' Gün';
			if($days != 1) $output .= '';
			if($secs > 0) $output .= ', ';
			}
		if($secs>=3600){
			$hours = floor($secs/3600);
			$secs = $secs%3600;
			$output .= $hours.' Saat';
			if($hours != 1) $output .= '';
			if($secs > 0) $output .= ', ';
			}
		if($secs>=60){
			$minutes = floor($secs/60);
			$secs = $secs%60;
			$output .= $minutes.' Dakika';
			if($minutes != 1) $output .= '';
			if($secs > 0) $output .= ', ';
			}
		$output .= $secs.' Saniye';
		if($secs != 1) $output .= '';
		return $output;
	}
	
	public static function convertTimeMinutes($time, $format = '%02d Saat %02d Dakika')
	{
		if ($time < 1) {
			return;
		}
		$hours = floor($time / 60);
		$minutes = ($time % 60);
		return sprintf($format, $hours, $minutes);
	}
	
	public static function prettyDateTime1($dateTime)
	{
		$explodeDateTime = explode(" ",$dateTime);
		$date = $explodeDateTime[0];
		$time = $explodeDateTime[1];
		$explodeDate = explode("-",$date);
		$day = $explodeDate[2];
		$month = $explodeDate[1];
		$year = $explodeDate[0];
		$explodeTime = explode(":",$time);
		$hour = $explodeTime[0];
		$minute = $explodeTime[1];

		return $day.".".$month.".".$year." ".$hour.":".$minute;
	}

	public static function find_url($string)
	{
		$pattern_preg1 = '#(^|\s)(www|WWW)\.([^\s<>\.]+)\.([^\s\n<>]+)#sm';
		$replace_preg1 = '\\1<a href="http://\\2.\\3.\\4" target="_blank" class="link">\\2.\\3.\\4</a>';
		$pattern_preg2 = '#(^|[^\"=\]]{1})(http|HTTP|ftp)(s|S)?://([^\s<>\.]+)\.([^\s<>]+)#sm';
		$replace_preg2 = '\\1<a href="\\2\\3://\\4.\\5" target="_blank" class="link">\\2\\3://\\4.\\5</a>';
		$string = preg_replace($pattern_preg1, $replace_preg1, $string);
		$string = preg_replace($pattern_preg2, $replace_preg2, $string);
		return $string;
	}

	public static function map($map)
	{
		if ($map == "1") {
			return "Yongan";
		} else if ($map == "3") {
			return "Jayang";
		} else if ($map == "4") {
			return "Jungrang";
		} else if ($map == "5") {
			return "Shinsoo - Hasun Dong";
		} else if ($map == "21") {
			return "Joan";
		} else if ($map == "23") {
			return "Bokjung";
		} else if ($map == "24") {
			return "Waryong";
		} else if ($map == "25") {
			return "Chunjo - Hasun Dong";
		} else if ($map == "41") {
			return "Pyungmo";
		} else if ($map == "43") {
			return "Bakra";
		} else if ($map == "44") {
			return "İmha";
		} else if ($map == "45") {
			return "Jinno - Hasun Dong";
		} else if ($map == "61") {
			return "Sohan Dağı";
		} else if ($map == "62") {
			return "Doyum Paper";
		} else if ($map == "63") {
			return "Yongbi Çölü";
		} else if ($map == "64") {
			return "Seuyong Vadisi";
		} else if ($map == "65") {
			return "Hwang Tapınağı";
		} else if ($map == "66") {
			return "Gumsan Kulesi";
		} else if ($map == "67") {
			return "Lungsam - Hayalet Orman";
		} else if ($map == "68") {
			return "Lungsam - Kızıl Orman";
		} else if ($map == "69") {
			return "Yılan Vadisi";
		} else if ($map == "70") {
			return "Devler Diyarı";
		} else if ($map == "71") {
			return "Kuahklo Dong";
		} else if ($map == "72") {
			return "Sürgün Mağarası";
		} else if ($map == "73") {
			return "Sürgün Mağarası";
		} else if ($map == "74") {
			return "Sohan Dağı";
		} else if ($map == "75") {
			return "Hwang Tapınağı";
		} else if ($map == "77") {
			return "Doyum Paper";
		} else if ($map == "78") {
			return "Seuyong Vadisi";
		} else if ($map == "79") {
			return "Sürgün Mağarası";
		} else if ($map == "81") {
			return "Nihah Salonu";
		} else if ($map == "100") {
			return "Alan";
		} else if ($map == "103") {
			return "T 01";
		} else if ($map == "104") {
			return "Örümcek Zindanı";
		} else if ($map == "105") {
			return "T 02";
		} else if ($map == "107") {
			return "Örümcek Zindanı";
		} else if ($map == "108") {
			return "Örümcek Zindanı";
		} else if ($map == "109") {
			return "Örümcek Zindanı";
		} else if ($map == "110") {
			return "T 03";
		} else if ($map == "111") {
			return "T 04";
		} else if ($map == "112") {
			return "Düello Haritası";
		} else if ($map == "113") {
			return "Ox Haritası";
		} else if ($map == "114") {
			return "Sungzi";
		} else if ($map == "118") {
			return "Sungzi";
		} else if ($map == "119") {
			return "Sungzi";
		} else if ($map == "120") {
			return "Sungzi";
		} else if ($map == "121") {
			return "Sungzi";
		} else if ($map == "122") {
			return "Sungzi";
		} else if ($map == "123") {
			return "Sungzi";
		} else if ($map == "124") {
			return "Sungzi";
		} else if ($map == "125") {
			return "Sungzi";
		} else if ($map == "126") {
			return "Sungzi";
		} else if ($map == "127") {
			return "Sungzi";
		} else if ($map == "128") {
			return "Sungzi";
		} else if ($map == "181") {
			return "3 Yol";
		} else if ($map == "182") {
			return "3 Yol";
		} else if ($map == "183") {
			return "3 Yol";
		} else if ($map == "184") {
			return "Buz Mağarası";
		} else if ($map == "185") {
			return "Esrarengiz Arena";
		} else if ($map == "186") {
			return "Gizemli Arena";
		} else if ($map == "187") {
			return "Sürgün Mağarası";
		} else if ($map == "188") {
			return "Fabrika";
		} else if ($map == "189") {
			return "Kristal Zindan";
		} else if ($map == "200") {
			return "Etkinlik Bölgesi";
		} else if ($map == "201") {
			return "Voba Adası";
		} else if ($map == "208") {
			return "Mavi Ejderha Odası";
		} else if ($map == "209") {
			return "Barones Odası";
		} else if ($map == "211") {
			return "Örümcek Zindanı";
		} else if ($map == "216") {
			return "Devils Catacomb";
		} else if ($map == "217") {
			return "Örümcek Zindanı 3. Kat";
		} else if ($map == "218") {
			return "İmparatorluk Savaşı";
		} else if ($map == "219") {
			return "Etkinlik Bölgesi";
		} else if ($map == "226") {
			return "Maden Bölgesi";
		} else if ($map == "244") {
			return "Su Zindanı";
		} else if ($map == "245") {
			return "Nephir Zindanı";
		} else if ($map == "301") {
			return "Ejderha Ateşi Burnu";
		} else if ($map == "302") {
			return "Gautama Uçurumu";
		} else if ($map == "303") {
			return "Nefrit Körfezi";
		} else if ($map == "304") {
			return "Yıldırım Dağları";
		} else if ($map == "312") {
			return "At Yarışı";
		} else if ($map == "351") {
			return "Kırmızı Ejderha Kalesi";
		} else if ($map == "352") {
			return "Nemere'nin Gözetleme Kulesi";
		} else if ($map == "353") {
			return "Eğitim Dövüşü Arenası";
		} else if ($map == "354") {
			return "İmparatorluk Savaşı";
		} else if ($map == "355") {
			return "Gemi Savaşı";
		} else if ($map == "400") {
			return "Gnol Adası";
		} else if ($map == "401") {
			return "Minotauros Adası";
		} else if ($map == "402") {
			return "Teador Glade";
		} else if ($map == "500") {
			return "Ronark Bölgesi";
		} else {
			return "Belli Değil";
		}
	}
	
	public static function oxoyun($type){
        if($type == '1'){
            return 'Mobil Ödeme';
        }elseif ($type == '2'){
            return 'Kredi Kartı (Gpay)';
        }elseif ($type == '3'){
            return 'Banka Havalesi';
        }elseif ($type == '6'){
            return 'OxOyun Elektonik Kod';
		}elseif ($type == '9'){
            return 'Gpay E-Cüzdan';
		}elseif ($type == '10'){
            return 'OxOyun E-Cüzdan';
		}elseif ($type == '11'){
            return 'Kredi Kartı (Wirecard)';
		}elseif ($type == '12'){
            return 'ininal (Gpay)';
		}else{
			return "Belli Değil";
        }
    }
	
	public static function paywant($type){
        if($type == '1'){
            return 'Mobil Ödeme';
        }elseif ($type == '2'){
            return 'Kredi Kartı/Banka Kartı';
		}elseif ($type == '3'){
            return 'Havale/EFT/ATM';
		}else{
			return "Belli Değil";
        }
    }
	
	public static function npc_type($type){
        if($type == '0'){
            return 'Yang Market';
        }elseif ($type == '1'){
            return 'EP Market';
		}elseif ($type == '2'){
            return 'EM Market';
		}elseif ($type == '3'){
            return 'Derece Market';
		}elseif ($type == '4'){
            return 'Won Market';
		}elseif ($type == '5'){
            return 'Eşya Market';
		}elseif ($type == '6'){
            return 'Metin Gaya Market';
		}elseif ($type == '7'){
            return 'Boss Gaya Market';
		}elseif ($type == '99'){
            return 'Mob Drop';
		}else{
			return "Belli Değil";
        }
    }

	public static function jobName($value)
	{
		if ($value == 0 || $value == 4) {
			return 'Savaşçı';
		} elseif ($value == 1 || $value == 5) {
			return 'Ninja';
		} elseif ($value == 2 || $value == 6) {
			return 'Sura';
		} elseif ($value == 3 || $value == 7) {
			return 'Şaman';
		} elseif ($value == 8) {
			return 'Lycan';
		}
	}
	
	public static function shopTypeConvert($value)
	{
		if($value == 1){
			return 'Normal Ürün';
		}elseif ($value == 2){
			return 'İndirimli Ürün';
		}elseif ($value == 3){
			return 'Marka Ürünü';
		}elseif ($value == 4){
			return 'Kader Çarkı';
		}
	}
	
	public static function ozel_sifre_method( $string, $action = 'e' )
	{
		$secret_key = 'MMOVAKTI_GELDI';
		$secret_iv = 'MARKET_GIRIS_YAP';
	 
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
		if( $action == 'e' ) {
			$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
		}
		else if( $action == 'd' ){
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
		}
	 
		return $output;
	}
	
	public static function satir_parcala($str, $l = 100, $e = "\r\n") {
		$tmp = array_chunk(preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $l);
		$str = "";
		foreach ($tmp as $t) {$str .= join("", $t) . $e;}
		return $str;
	}
	
	public static function item_adi_goster($vnum)
	{
		$getName = \StaticGame\StaticGame::sql("SELECT locale_name FROM ".PLAYER_DB_NAME.".item_proto WHERE vnum = '$vnum'");
		$VnumForName = $getName[0]['locale_name'];
		return mb_convert_encoding($VnumForName, "UTF-8", "ISO-8859-9");
	}
	
	public static function karakter_adi_goster($id)
	{
		$getName = \StaticGame\StaticGame::sql("SELECT name FROM ".PLAYER_DB_NAME.".player WHERE id = '$id'");
		$VnumForName = $getName[0]['name'];
		return mb_convert_encoding($VnumForName, "UTF-8", "ISO-8859-9");
	}
	
	public static function hesap_adi_goster($id)
	{
		$getName = \StaticGame\StaticGame::sql("SELECT login FROM ".ACCOUNT_DB_NAME.".account WHERE id = '$id'");
		$VnumForName = $getName[0]['login'];
		return mb_convert_encoding($VnumForName, "UTF-8", "ISO-8859-9");
	}

	public static function turkce_karakter($char)
	{
		return mb_convert_encoding($char, "UTF-8", "ISO-8859-9");
	}

	public static function big5ToUtf($char)
	{
		return mb_convert_encoding($char, "UTF-8", "BIG5");
	}

	public static function logConvert($type)
	{
		if ($type == 0)
			$result = 'Çıkış';
		elseif ($type == 1)
			$result = 'Giriş';

		return $result;
	}

	public static function flagName($value)
	{
		if ($value == 1)
			$data = ['red', 'Shinsoo'];
		elseif ($value == 2)
			$data = ['yellow', 'Chunjo'];
		else
			$data = ['blue', 'Jinno'];
		return $data;

	}

	public static function bracket()
	{
		return '<div class="col-md-12"> <h2 class="header-2" style="text-align: center;text-shadow: 0 0 3px #c17373;padding-bottom: 2px;background: url(' . URI::public_path('media/images/calc-divider.jpg') . ') 50% 100% no-repeat;"></h2></div>';
	}

	public static function sendServer($text, $type = "NOTICE", $port = "1")
	{
		if (\StaticDatabase\StaticDatabase::settings('socket_status') == 1) 
		{
			set_time_limit(0);
			if (!function_exists("socket_create")) {
				$return['function'] = false;
				$return['connect'] = false;
				$return['data'] = false;
			} else {
				$return['function'] = true;
				$serverIP = \StaticDatabase\StaticDatabase::settings('ip');
				$serverResponse = \StaticDatabase\StaticDatabase::settings('serverResponse');
				$PortS = \StaticDatabase\StaticDatabase::settings('ch' . $port . '_port');
				$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
				if ($socket < 0)
					$return = ['data' => "Geçersiz Socket Tanımı", 'connect' => false, "function" => true];
				else {
					$socketConnect = @socket_connect($socket, $serverIP, $PortS);
					if ($socketConnect == false)
						$return = ['connect' => false, "data" => "Bağlantı Başarısız", "function" => true];
					else {
						$return['connect'] = true;
						if ($type == "NOTICE")
							$command = "NOTICE $text";
						elseif ($text == false)
							$command = "$type";
						else
							$command = "$type $text";

						$command = iconv("UTF-8", "WINDOWS-1254//TRANSLIT", $command);

						$query2 = "\x40$serverResponse\x0A";
						$query_size2 = strlen($query2);
						socket_write($socket, $query2, $query_size2);
						socket_recv($socket, $result2, 256, 0);
						$query = "\x40" . $command . "\x0A";
						$query_size = strlen($query);
						$query_result = socket_write($socket, $query, $query_size);
						if ($query_result < 0)
							$return['data'] = socket_strerror($query_result);
						else {
							socket_recv($socket, $result2, 256, 0);
							if ($result2 == "OK")
								$return['data'] = "OK";
							else {
								if ($text == false && $type == "USER_COUNT")
									$return['data'] = explode(" ", $result2)[0];
								else
									$return['data'] = $result2;
							}
						}
					}
				}
				socket_close($socket);
			}
			return $return;
		}
		if (\StaticDatabase\StaticDatabase::settings('socket_status') == 2) 
		{
			set_time_limit(0);
			$serverIP = \StaticDatabase\StaticDatabase::settings('ip');
			$serverResponse = \StaticDatabase\StaticDatabase::settings('serverResponse');
			$PortS = \StaticDatabase\StaticDatabase::settings('ch' . $port . '_port');
			$command = "$type $text";
			$command2 = iconv("UTF-8", "WINDOWS-1254//TRANSLIT", $command);
			$api = new GameConnector($serverIP, $PortS);
			$api->Send($serverResponse); // p2p şifre
			$api->Send("$command2"); // Komut
			$apiBuf = substr($api->GetBuffer(), 0, -1);

			if(empty($apiBuf))
			{
				$return = ['connect' => false, "data" => "Bağlantı Başarısız", "function" => true];
			}
			else 
			{
				$return['connect'] = true;

				if($apiBuf=="UNKNOWN")
					$return['data'] = "NO";
				else
					$return['data'] = "OK";
			}
		}
		
		if (\StaticDatabase\StaticDatabase::settings('socket_status') == 0)
			return false;
	}
	
	public static function check_ports($ip, $portt) 
	{
		$fp = @fsockopen($ip, $portt, $errno, $errstr, 0.1);
		if (!$fp) {
			return false;
		} else {
			fclose($fp);
			return true;
		}
	}

	public static function checkPermission($array = array(), $value)
	{
		if (in_array($value, $array)) {
			return true;
		} else {
			URI::redirect('errors/permission');
		}
	}

	public static function checkPermissionMenu($array = array(), $value)
	{
		if (in_array($value, $array)) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function checkAdminLogin()
	{
		if (isset($_SESSION['aLogin']) && isset($_SESSION['adId']) && $_SESSION['aLoginToken'] === md5(\StaticDatabase\StaticDatabase::settings('passwordkey')))
			return true;
		else
			return false;
	}

	public static function getUrl()
	{
		$url = isset($_GET['url']) ? filter_var($_GET['url'], FILTER_SANITIZE_URL) : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$_url = explode('/', $url);
		return $_url;
	}

	public static function setOn($id)
	{
		date_default_timezone_set('Asia/Bahrain');
		$now = date('Y-m-d H:i:s');
		$setOn = \StaticDatabase\StaticDatabase::init()->prepare("UPDATE user SET last_login = :last_login WHERE id = :id");
		$setOn->execute(array(':last_login' => $now, ':id' => $id));
	}

	public static function setAdminLog($content)
	{
		$id = Session::get('adId');
		$name = Session::get('aName');
		date_default_timezone_set('Asia/Bahrain');
		$now = date('Y-m-d H:i:s');
		$setLog = \StaticDatabase\StaticDatabase::init()->prepare("INSERT INTO admin_log (user_id,user_name,content,date) VALUES (?,?,?,?)");
		$setLog->execute(array($id, $name, $content, $now));
	}

	public static function allPermission()
	{
		$data = array(
			'Anasayfa' => array(
				'İstatistikler' => '1a',
				'Bayrak Diagramı' => '1b',
				'Karakter Diagramı' => '1c',
				'Satış İstatistikleri' => '1d',
				'Channel Bot Log' => '1e',
				'Command Log' => '1f'
			),
			'Market Yönetimi' => [
				'Eşya Ekle' => '3',
				'Eşya Listesi' => '4',
				'Çark Eşya Ekle' => '5',
				'Çark Eşya Listesi' => '6',
				'Kategori Ekle' => '7',
				'Kategori Listesi' => '8',
				'Bonus Ekle' => '86',
				'Bonus Listesi' => '87'
			],
			'Kupon Yönetimi' => [
				'Kupon Oluştur' => '10',
				'Kullanılmış Kuponlar' => '11',
				'Kullanılmamış Kuponlar' => '12'
			],
			'Ticket Yönetimi' => [
				'Yanıtlanmış Ticketlar' => '14',
				'Yanıtlanmamış Ticketlar' => '15'
			],
			'Ayarlar' => [
				'Online Sayısı' => '17',
				'Genel Ayarlar' => '18',
				'Database Ayarları' => '19',
				'Market Ayarları' => '20',
				'Çark Ayarları' => '21',
				'Mail Ayarları' => '22',
				'Link Ayarları' => '23',
				'Sayaç Ayarları' => '24',
				'Recaptcha Ayarları' => '26',
				'Sistem Ayarları' => '27',
				'PayTR Ayarları' => '28',
				'İtemci Ayarları' => '29',
				'EP-TL Ayarları' => '30',
				'Ticket Ayarları' => '31',
				'KasaGame Ayarları' => '32',
				'SanalPay Ayarları' => '33',
				'Paywant Ayarları' => '34',
				'Payreks Ayarları' => '35',
				'İtem Sultan Ayarları' => '36',
				'Oyun Alışverişi Ayarları' => '37'
			],
			'Hesap Yönetimi' => [
				'Hesap Oluştur' => '39',
				'Epi Olan Hesaplar' => '40',
				'Aktif GüvenliPC' => '41',
				'Tüm Hesaplar' => '42',
				'Banlı Hesaplar' => '43'
			],
			'Event İşlemleri' => [
				'Event Aç' => '45',
				'Event Planla' => '46',
				'Event Listesi' => '47'
			],
			'Yönetici Ayarları' => [
				'Yönetici Oluştur' => '49',
				'Yöentici Listesi' => '50'
			],
			'Socket İşlemleri' => [
				'Dropları Aç' => '52',
				'DC Atma' => '53',
				'Chat Ban' => '54',
				'Oyun İçi Duyuru' => '55',
				'Müzik Yönetimi' => '56'
			],
			'Log Kayıtları' => [
				'Market Logları' => '58',
				'Ban Logları' => '59',
				'HWID Ban Logları' => '60',
				'Paywant Logları' => '61',
				'Payreks Logları' => '62',
				'KasaGame Logları' => '63'
			],
			'Haber Yönetimi' => [
				'Haber Ekle' => '65',
				'Haber Listesi' => '66',
				'Market Haber Ekle' => '67',
				'Market Haber Listesi' => '68'
			],
			'Pack Yönetimi' => [
				'Pack Ekle' => '70',
				'Pack Listesi' => '71'
			],
			'Site Yönetimi' => [
				'Tema Seçimi' => '73',
				'Logo Yönetimi' => '74',
				'Güvenlik Ayarları' => '75',
				'Discord Ayarları' => '76',
				'Tawk.To Ayarları' => '77',
				'Sıralama Ayarları' => '78',
				'Kayıt Ayarları' => '79',
				'Tanıtım Sayfası İşlemleri' => '80',
				'Bakım Sayfası Yönetimi' => '81',
				'Market Yedek İşlemleri' => '82',
				'CloudFlare API Yönetimi' => '83'
			]
		);
		return $data;
	}

	public static function checkAllPermission($array = array(), $value)
	{
		if (in_array($value, $array))
			return true;
		else
			return false;

	}

	public static function deleteCache()
	{
		$folder = explode("/index.php", $_SERVER['SCRIPT_FILENAME'])[0] . '/data/cache';
		$dir = scandir($folder);
		foreach ($dir as $file) {
			clearstatcache();
			if (is_file($folder . '/' . $file))
				unlink($folder . '/' . $file);
		}
	}

	public static function secondsToDay($seconds)
	{
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('Süre : %a gün');
	}

	public static function itemToPng($vnum)
	{
		if ($file = fopen("data/items/item_list.txt", "r")) {
			$itemVnum = null;
			while (!feof($file)) {
				$line = fgets($file);
				$exp = explode('	', $line);
				if ($exp[0] === $vnum)
					return self::replaceSpace($exp[1]);
			}
		}
	}
	
	public static function itemToDesc($vnum)
	{
		if ($file = fopen("data/items/item_desc.txt", "r")) {
			$itemVnum = null;
			while (!feof($file)) {
				$line = fgets($file);
				$exp = explode('	', $line);
				if ($exp[0] === $vnum)
					return self::replaceSpace($exp[2]);
			}
		}
	}
	
	public static function itemToNames($vnum)
	{
		if ($file = fopen("data/items/item_names.txt", "r")) {
			$itemVnum = null;
			while (!feof($file)) {
				$line = fgets($file);
				$exp = explode('	', $line);
				if ($exp[0] === $vnum)
					return self::replaceSpace($exp[1]);
			}
		}
	}
	
	public static function mobToNames($vnum)
	{
		if ($file = fopen("data/mobs/mob_names.txt", "r")) {
			$mobVnum = null;
			while (!feof($file)) {
				$line = fgets($file);
				$exp = explode('	', $line);
				if ($exp[0] === $vnum)
					return self::replaceSpace($exp[1]);
			}
		}
	}
	
	public static function systemToNames($vnum)
	{
		if ($file = fopen("data/wiki/system_names.txt", "r")) {
			$systemVnum = null;
			while (!feof($file)) {
				$line = fgets($file);
				$exp = explode('	', $line);
				if ($exp[0] === $vnum)
					return self::replaceSpace($exp[1]);
			}
		}
	}
	
	public static function MASGSM($Url, $body = null)
	{
		$API_KEY = "uaIyXScFjXolF3NlZHqYz6iZSWEjNure9b32UpDy5qbM";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',"Authorization: Key {$API_KEY}"));
		if($body):
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		endif;
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	private static function replaceSpace($string)
	{
		$string = preg_replace("/\s+/", " ", $string);
		$string = trim($string);
		return $string;
	}

	public static function eventList()
	{
		return ["ayisigi", "futboltopu", "paskalya", "kostum", "okey", "sertifika", "kuzeykutusu", "oyma_tas", "gen_drop", "pet_event", "beceri_event", "ramazan", "hallowen", "kids_day_quiz", "esrarengiz_sandik", "gizemli_sandik", "word_event_drop", "corap", "donusumkuresi", "alignment_event", "defend_and_destroy", "auto_event_source"];
	}
	
	public static function eventListName($eventname)
	{
			$data = array(
				'ayisigi' => 'Ayışığı Etkinliği',
				'futboltopu' => 'Futbol Topu Etkinliği',
				'paskalya' => 'Paskalya Etkinliği',
				'kostum' => 'Kostüm Etkinliği',
				'okey' => 'Okey Etkinliği',
				'sertifika' => 'Sertifika Etkinliği',
				'kuzeykutusu' => 'Kuzey Kutusu Etkinliği',
				'oyma_tas' => 'Oyma Taş Etkinliği',
				'gen_drop' => 'Altıgen Hediye Paketi Etkinliği',
				'pet_event' => 'Yavrucuk Kutusu Etkinliği',
				'beceri_event' => 'Beceri Kitabı Etkinliği',
				'ramazan' => 'Ramazan Simit Etkinliği',
				'hallowen' => 'Cadılar Bayramı Etkinliği',
				'kids_day_quiz' => 'Bulmaca Kutusu Etkinliği',
				'esrarengiz_sandik' => 'Esrarengiz Sandık Etkinliği',
				'gizemli_sandik' => 'Gizemli Sandık Etkinliği',
				'word_event_drop' => 'Kelime Etkinliği',
				'corap' => 'Çorap Etkinliği',
				'donusumkuresi' => 'Dönüşüm Küresi Etkinliği',
				'alignment_event' => 'Derece Etkinliği',
				'defend_and_destroy' => 'Savun ve Yoket Etkinliği',
				'auto_event_source' => 'Otomatik Etkinlikler',
			);
			return isset($data[$eventname]) ? $data[$eventname] : false;
	}

	public static function item_proto($arg)
	{
		if ($file = fopen("data/items/item_proto.txt", "r")) {
			$itemDesc = null;
			while (!feof($file)) {
				$line = fgets($file);
				$exp = explode('	', $line);
				if ($exp[0] === $arg)
					$itemDesc .= $exp[1];
			}
			fclose($file);
			$data = $itemDesc;
		} else
			$data = "Eşya bulunamadı";
		return $data;
	}
	public static function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public static function generateRandomInteger($length = 10)
	{
		$characters = '123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public static function generateNumberString($length = 10) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	public static function item_attr($type,$subtype)
	{
		if ($type === "1")
		{
			if ($subtype >= "0" && $subtype <= "5")
				return "weapon";
			else
				return "other";
		}
		elseif ($type === "2" && $subtype === "0")
			return "body";
		elseif ($type === "2" && $subtype === "1")
			return "head";
		elseif ($type === "2" && $subtype === "2")
			return "shield";
		elseif ($type === "2" && $subtype === "3")
			return "wrist";
		elseif ($type === "2" && $subtype === "4")
			return "foots";
		elseif ($type === "2" && $subtype === "5")
			return "neck";
		elseif ($type === "2" && $subtype === "6")
			return "ear";
		elseif ($type === "16" && $subtype === "34")
			return "costume_pet";
		elseif ($type === "16" && $subtype === "35")
			return "costume_pendant";
		elseif ($type === "28" && $subtype === "0")
			return "costume_body";
		elseif ($type === "28" && $subtype === "1")
			return "costume_hair";
		elseif ($type === "28" && $subtype === "2")
			return "costume_weapon";
		elseif ($type === "28" && $subtype === "3")
			return "costume_mount";
		elseif ($type === "28" && $subtype === "4")
			return "costume_acce";
		elseif ($type === "28" && $subtype === "5")
			return "costume_aura";
		else
			return "other";
	}
	public static function item_attr_name($apply)
	{
			$data = array(
				'0' => 'Efsun Yok',
				'MAX_HP' => ['1','Max HP'],
				'MAX_SP' => ['2','Max SP'],
				'CON' => ['3','Canlılık'],
				'INT' => ['4','Zeka'],
				'STR' => ['5','Güç'],
				'DEX' => ['6','Çeviklik'],
				'ATT_SPEED' => ['7','Saldiri Hızı'],
				'MOV_SPEED' => ['8','Hareket Hızı'],
				'CAST_SPEED' => ['9','Büyü Hızı'],
				'HP_REGEN' => ['10','HP Üretimi'],
				'SP_REGEN' => ['11','SP Üretimi'],
				'POISON_PCT' => ['12','Zehirleme Şansı'],
				'STUN_PCT' => ['13','Sersemletme Şansı'],
				'SLOW_PCT' => ['14','Yavaşlatma Şansı'],
				'CRITICAL_PCT' => ['15','Kritik Vuruş Şansı'],
				'PENETRATE_PCT' => ['16','Delici Vuruş Şansı'],
				'ATTBONUS_HUMAN' => ['17','Yarı İnsanlara Karşı Güçlü'],
				'ATTBONUS_ANIMAL' => ['18','Hayvanlara Karşı Güçlü'],
				'ATTBONUS_ORC' => ['19','Orklara Karşı Güçlü'],
				'ATTBONUS_MILGYO' => ['20','Mistiklere Karşı Güçlü'],
				'ATTBONUS_UNDEAD' => ['21','Ölümsüzlere Karşı Güçlü'],
				'ATTBONUS_DEVIL' => ['22','Şeytanlara Karşı Güçlü'],
				'STEAL_HP' => ['23','Hasar HP Tarafından Emilecek'],
				'STEAL_SP' => ['24','Hasar SP Tarafindan Emilicek'],
				'MANA_BURN_PCT' => ['25','Düşmanin SP Çalma Şansı'],
				'BLOCK' => ['27','Beden Karşısındaki Ataklari Bloklama'],
				'DODGE' => ['28','Oklardan Korunma Şansı'],
				'RESIST_SWORD' => ['29','Kılıç Savunması'],
				'RESIST_TWOHAND' => ['30','Çift El Savunması'],
				'RESIST_DAGGER' => ['31','Bıçak Savunması'],
				'RESIST_BELL' => ['32','Çan Savunması'],
				'RESIST_FAN' => ['33','Yelpaze Savunması'],
				'RESIST_BOW' => ['34','Oka Karşı Dayanıklılık'],
				'RESIST_FIRE' => ['35','Ateşe Karşı Dayanıklılık'],
				'RESIST_MAGIC' => ['37','Büyüye Karşı Dayanıklılık'],
				'REFLECT_MELEE' => ['39','Vucut Darbesini Yansıtma Şansı'],
				'POISON_REDUCE' => ['41','Zehire Karşı Koyma Şansı'],
				'EXP_DOUBLE_BONUS' => ['43','EXP Bonus Şansı'],
				'GOLD_DOUBLE_BONUS' => ['44','Yang Düşme Şansı'],
				'ITEM_DROP_BONUS' => ['45','Eşya Düşme Şansı'],
				'IMMUNE_STUN' => ['48','Sersemliğe Karşı Bağışıklılık'],
				'IMMUNE_SLOW' => ['49','Yavaşlatmaya Karşı Bağımlılık'],
				'ATT_GRADE_BONUS' => ['53','Saldırı Değeri'],
				'DEF_GRADE' => ['83','Savunma Değeri'],
				'BLEEDING_PCT' => ['92','Kanama Saldırısı'],
				'BLEEDING_REDUCE' => ['93','Kanama Direnci'],
				'ATTBONUS_WOLFMAN' => ['94','Lycanlara Karşı Güçlü'],
				'RESIST_WOLFMAN' => ['95','Lycanlara Karşı Savunma'],
				'RESIST_CLAW' => ['96','Pençelere Karşı Savunma'],
				'ATTBONUS_ELEC' => ['104','Şimşeklerin Gücü'],
				'ATTBONUS_FIRE' => ['105','Ateşin Gücü'],
				'ATTBONUS_ICE' => ['106','Buzun Gücü'],
				'ATTBONUS_WIND' => ['107','Rüzgarın Gücü'],
				'ATTBONUS_EARTH' => ['108','Toprağın Gücü'],
				'ATTBONUS_DARK' => ['109','Karanlığın Gücü'],
				'RESIST_HUMAN' => ['110','Yar. İns. Sal. Sav. Şansı'],
				'ATTBONUS_STONE' => ['111','Metin Taşlarına Karşı Güçlü'],
				'ATTBONUS_BOSS' => ['112','Patronlara Karşı Güçlü'],
			);
			return isset($data[$apply]) ? $data[$apply] : false;
	}
	
	public static function url_get_contents ($url) {
		if (function_exists('curl_exec')){
			$conn = curl_init($url);
			curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
			curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
			$url_get_contents_data = (curl_exec($conn));
			curl_close($conn);
		}elseif(function_exists('file_get_contents')){
			$url_get_contents_data = file_get_contents($url);
		}elseif(function_exists('fopen') && function_exists('stream_get_contents')){
			$handle = fopen ($url, "r");
			$url_get_contents_data = stream_get_contents($handle);
		}else{
			$url_get_contents_data = false;
		}
		return $url_get_contents_data;
	}
	
	private static function curl($url,$data)
	{
		$_ch = curl_init($url);
		curl_setopt($_ch, CURLOPT_CUSTOMREQUEST, "POST");
		if (is_array($data))
			curl_setopt($_ch, CURLOPT_POSTFIELDS, http_build_query($data));

		$agent = "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US) AppleWebKit/534.7 (KHTML, like Gecko) Chrome/7.0.517.44 Safari/534.7";
		curl_setopt($_ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($_ch,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($_ch,CURLOPT_USERAGENT,$agent);
		curl_setopt($_ch, CURLOPT_REFERER, $_SERVER["SERVER_NAME"]);
		curl_setopt($_ch,CURLOPT_CONNECTTIMEOUT, 0);
		curl_setopt($_ch,CURLOPT_TIMEOUT, 30);
		$exec = curl_exec($_ch);
		if(curl_errno($_ch))
			$result = ["state"=>false,"return"=>curl_error($_ch)];
		else
			$result = ["state"=>true,"return"=>$exec];
		curl_close($_ch);

		return $result;
	}
	
	private static function getDirContents($dir, &$results = array()) {
		$files = scandir($dir);

		foreach ($files as $key => $value) {
			$path = realpath($dir . DIRECTORY_SEPARATOR . $value);
			if (!is_dir($path)) {
				$results[] = $path;
			} else if ($value != "." && $value != "..") {
				self::getDirContents($path, $results);
				$results[] = $path;
			}
		}

		return $results;
	}
	
	public static function scanCSX()
	{
		$updateCheck = \StaticDatabase\StaticDatabase::settings('scan_csx');
		$now = time();

		if ($now > $updateCheck)
		{
			$updateTime = $now + 21600;
			$updateCheckTime = \StaticDatabase\StaticDatabase::init()->prepare("UPDATE settings SET deger = '$updateTime' WHERE anahtar = 'scan_csx'");
			$updateCheckTime->execute();

			$scanDataFolder = self::getDirContents('data');
			$scanClientPublicFolder = self::getDirContents('app/public/client');
			$scanAdminPublicFolder = self::getDirContents('app/public/admin');
			$scanShopPublicFolder = self::getDirContents('app/public/shop');
			$scanMutualPublicFolder = self::getDirContents('app/public/mutual');

			foreach ($scanDataFolder as $row)
			{
				$dataFolder = explode('data',$row);
				if (isset($dataFolder[1]))
				{
					$extension = explode('.',$dataFolder[1]);
					if (isset($extension[1]))
					{
						if ($extension[1] === "php")
						{
							unlink($row);
						}
					}
				}
			}

			foreach ($scanClientPublicFolder as $row)
			{
				$publicFolder = explode('client',$row);
				if (isset($publicFolder[1]))
				{
					$extension = explode('.',$publicFolder[1]);
					if (isset($extension[1]))
					{
						if ($extension[1] === "php")
						{
							unlink($row);
						}
					}
				}
			}
			
			foreach ($scanAdminPublicFolder as $row)
			{
				$publicFolder = explode('admin',$row);
				if (isset($publicFolder[1]))
				{
					if (!strpos($row, "base"))
					{
						$extension = explode('.',$publicFolder[1]);
						if (isset($extension[1]))
						{
							if ($extension[1] === "php")
								unlink($row);
						}
					}
				}
			}

			foreach ($scanShopPublicFolder as $row)
			{
				$publicFolder = explode('shop',$row);
				if (isset($publicFolder[1]))
				{
					$extension = explode('.',$publicFolder[1]);
					if (isset($extension[1]))
					{
						if ($extension[1] === "php")
						{
							unlink($row);
						}
					}
				}
			}

			foreach ($scanMutualPublicFolder as $row)
			{
				$publicFolder = explode('mutual',$row);
				if (isset($publicFolder[1]))
				{
					$extension = explode('.',$publicFolder[1]);
					if (isset($extension[1]))
					{
						if ($extension[1] === "php")
						{
							unlink($row);
						}
					}
				}
			}
		}
	}
	
	public static function AndroidErrorMessage($type, $text)
	{
		if ($type == 'success') {
			return '<div class="static-notification-green tap-dismiss-notification"><p class="center-text capitalize">' . $text . '</p></div><br>';
		} elseif ($type == 'error') {
			return '<div class="static-notification-red tap-dismiss-notification"><p class="center-text capitalize">' . $text . '</p></div><br>';
		} elseif ($type == 'info') {
			return '<div class="static-notification-blue tap-dismiss-notification no-bottom"><p class="center-text capitalize">' . $text . '</p></div><br>';
		} elseif ($type == 'warning') {
			return '<div class="static-notification-yellow tap-dismiss-notification"><p class="center-text capitalize">' . $text . '</p></div><br>';
		}
	}
	
	public static function IsFileExists($link)
	{
		if ($link == null)
		{
			return "<img src='data/extra/resimYok.jpg'>";
		}
		else
		{
			if (file_exists($link)) {return "<img src='$link'>";}
			else {return "<img src='data/extra/resimYok.jpg'>";}
		}
	}
	
	public static function HttpLinkRemove($link)
	{
		$gelen = array("http://", "https://", "www.");
		$degisen = array("", "", "");
		$yenideger = str_replace($gelen, $degisen, $link);
		return $yenideger;
	}
	
	public static function playerOnlineStatus($date)
	{
		$lastDate= date("Y-m-d H:i:s", strtotime('-30 minutes'));;
		return ($lastDate > $date) ? "off" : "on";
	}
	
	public static function playerPortrait($level)
    {
        if ($level < 26)
            return '1';
        elseif ($level < 34)
            return '26';
        elseif ($level < 42)
            return '34';
        elseif ($level < 48)
            return '42';
        elseif ($level < 54)
            return '48';
        elseif ($level < 61)
            return '54';
        elseif ($level < 70)
            return '61';
        elseif ($level < 90)
            return '70';
        elseif ($level >= 90)
            return '90';
    }
}
