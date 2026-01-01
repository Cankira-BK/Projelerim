<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4.02.2017
 * Time: 21:29
 */
use Model\IN_Model;
class SiteModel extends IN_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function key(){
		$key = $_POST['key'];
		if($key == ''){
			$result['result'] = false;
		}else{
			$result['result'] = true;
			$result['data'] = $key;
			$this->db->update('settings',array('deger'=>$key),array('anahtar'=>'dbkey_new'));
			Functions::setAdminLog("Oyun Database Keyini Güncelledi");
		}
		return $result;
	}
	public function db(){
		$ip = $_POST['ip'];
		$user = $_POST['user'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];
		$key = \StaticDatabase\StaticDatabase::settings('dbkey_new');
		if ($ip == '' || $user == '' || $password == '' || $password2 == ''){
			$result['result'] = false;
		}else{
			$result['result'] = true;
			$result['data'] = array($ip,$user,$password,$password2);
			$hashIp =$this->inEncode($ip,$key);
			$hashUser =$this->inEncode($user,$key);
			$hashPassword =$this->inEncode($password,$key);
			$SSHPassword =$this->inEncode($password2,$key);
			$this->db->update('settings',array('deger'=>$hashIp),array('anahtar'=>'ip'));
			$this->db->update('settings',array('deger'=>$hashUser),array('anahtar'=>'user'));
			$this->db->update('settings',array('deger'=>$hashPassword),array('anahtar'=>'password'));
			$this->db->update('settings',array('deger'=>$SSHPassword),array('anahtar'=>'sshpassword'));
			$this->db->update('settings',array('deger'=>\StaticDatabase\StaticDatabase::settings('dbkey_new')),array('anahtar'=>'dbkey'));
			$this->db->update('settings',array('deger'=>'0'),array('anahtar'=>'dbkey_new'));
			Functions::setAdminLog("Oyun Database Bilgilerini Güncelledi");
		}
		return $result;
	}
	public function inEncode($value,$key){
		$encode = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $value, MCRYPT_MODE_CBC, md5(md5($key))));
		return $encode;
	}
	public function themeselect(){
		$theme = $_POST['client'];
		$getTheme = \StaticDatabase\StaticDatabase::settings('client');
		if ($theme == $getTheme){
			echo '<script type="text/javascript">alert("Bir Hata Oluştu");</script>';
		}else{
			echo '<script type="text/javascript">alert("Güncelleme Başarılı");</script>';
			$this->db->update('settings',array('deger'=>$theme),array('anahtar'=>'client'));
			Cache::delete('all');
            Session::set('delete_cache',true);
			Functions::setAdminLog("Tema başarıyla değiştirildi");
		}
		echo '<meta http-equiv="refresh" content="0;URL='.URI::get_path('site/theme').'">';
	}
	public function rankedplayeredit()
	{
		$status = $_POST['status'];
		$value1 = $_POST['count'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'player_rank_status']);
		$this->db->update('settings',['deger'=>$value1],['anahtar'=>'player_rank']);
		Cache::delete('all');
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
	public function rankedguildedit()
	{
		$status = $_POST['status'];
		$value1 = $_POST['count'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'guild_rank_status']);
		$this->db->update('settings',['deger'=>$value1],['anahtar'=>'guild_rank']);
		Cache::delete('all');
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
	public function register()
	{
		return $this->db->sql("SELECT * FROM findme_list ORDER BY total DESC");
	}
	public function registeredit()
	{
		$status = $_POST['status'];
		if ($status == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'register_status']);
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
	public function findmeadd()
	{
		$findMe = $_POST['findme'];

		if ($findMe == '')
			URI::redirect('site/register');

		$this->db->insert('findme_list',['name'=>$findMe,'total'=>'0']);

		URI::redirect('site/register');
	}
	public function findmeedit()
	{
		$status = $_POST['status'];
		if ($status == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'findme_status']);
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
	public function findmedelete($arg)
	{
		$control = $this->db->select('id')->table('findme_list')->where(['id'=>$arg])->count();
		if ($control > 0)
			$this->db->delete('findme_list',['id'=>$arg],1);
		URI::redirect('site/register');
	}
	public function registerfix()
	{
		$fix = $_GET['fix'];
		if ($fix != 'ok')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$accountSQL = "";
		$query = \StaticGame\StaticGame::init()->prepare("DESCRIBE account");
		$query->execute();
		$table_names = $query->fetchAll(PDO::FETCH_COLUMN);
		if (!in_array("ip",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `ip` varchar(40) NOT NULL DEFAULT '0';\n";
		if (!in_array("mailaktive",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `mailaktive` int(11) NOT NULL DEFAULT '0';\n";
		if (!in_array("t_status",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `t_status` int(11) NOT NULL DEFAULT '0';\n";
		if (!in_array("t_key",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `t_key` varchar(255) NOT NULL DEFAULT '0';\n";
		if (!in_array("t_token",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `t_token` varchar(100) NOT NULL DEFAULT '0';\n";
		if (!in_array("t_type",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `t_type` int(11) NOT NULL DEFAULT '0';\n";
		if (!in_array("t_date",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `t_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00';\n";
		if (!in_array("ticket_ban",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `ticket_ban` int(1) NOT NULL DEFAULT '0';\n";
		if (!in_array("real_name",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `real_name` varchar(100) NOT NULL DEFAULT '0';\n";
		if (!in_array("phone1",$table_names))
			$accountSQL .= "ALTER TABLE `account` ADD `phone1` varchar(100) NOT NULL DEFAULT '0';\n";

		if ($accountSQL == "")
			die(json_encode(["result"=>false,"message"=>"Kayıtlarda herhangi bir sorun saptanmadı!"]));

		\StaticGame\StaticGame::init()->exec($accountSQL);
		die(json_encode(["result"=>true,"message"=>"Kayıt sorunu giderildi!"]));
	}
	public function supportedit()
	{
		$status = $_POST['status'];
		$value1 = $_POST['site_id'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'tawkto_status']);
		$this->db->update('settings',['deger'=>$value1],['anahtar'=>'tawkto_id']);
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
	public function registergift()
	{
		$status = filter_var($_POST['status'],FILTER_SANITIZE_STRING);
		$gift = filter_var($_POST['gift'],FILTER_SANITIZE_STRING);
		if ($status == '' || $gift == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'register_gift_status']);
		$this->db->update('settings',['deger'=>$gift],['anahtar'=>'register_gift_count']);
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
	public function registerdrop()
	{
		$status = filter_var($_POST['status'],FILTER_SANITIZE_STRING);
		if ($status == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'register_drop_status']);
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
	public function discordedit()
	{
		$status = $_POST['status'];
		$value1 = $_POST['site_id'];
		$value2 = $_POST['theme'];
		$value3 = $_POST['link'];
		if ($status == '' || $value1 == '' || $value2 == '' || $value3 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'discord_status']);
		$this->db->update('settings',['deger'=>$value1],['anahtar'=>'discord_id']);
		$this->db->update('settings',['deger'=>$value2],['anahtar'=>'discord_theme']);
		$this->db->update('settings',['deger'=>$value3],['anahtar'=>'discord_link']);
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
	public function securitytablelist()
	{
		$result['data'] = $this->gdb->sql("SELECT `TABLE_NAME` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_TYPE = ?",[ACCOUNT_DB_NAME,'BASE TABLE']);
		return $result;
	}
	public function pinedit()
	{
		$status = $_POST['pin_durum'];
		$value1 = $_POST['pin_sutun'];
		$value2 = $_POST['pin_adet'];
		if ($status == '' || $value1 == '' || $value2 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'pin_durum']);
		$this->db->update('systems',['deger'=>$value1],['anahtar'=>'pin_sutun']);
		$this->db->update('systems',['deger'=>$value2],['anahtar'=>'pin_adet']);
		die(json_encode(["result"=>true,"message"=>"Pin ayarları güncellendi!"]));
	}
	public function guvenlipcedit()
	{
		$status = $_POST['guvenlipc_durum'];
		$value1 = $_POST['guvenlipc_sutun'];
		$value2 = $_POST['guvenlipc_tablo1'];
		$value3 = $_POST['guvenlipc_tablo2'];
		if ($status == '' || $value1 == '' || $value2 == '' || $value3 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'guvenlipc_durum']);
		$this->db->update('systems',['deger'=>$value1],['anahtar'=>'guvenlipc_sutun']);
		$this->db->update('systems',['deger'=>$value2],['anahtar'=>'guvenlipc_tablo1']);
		$this->db->update('systems',['deger'=>$value3],['anahtar'=>'guvenlipc_tablo2']);
		die(json_encode(["result"=>true,"message"=>"GüvenliPC ayarları güncellendi!"]));
	}
	public function hesapkilitedit()
	{
		$status = $_POST['hesapkilit_durum'];
		$value1 = $_POST['hesapkilit_tablo'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'hesapkilit_durum']);
		$this->db->update('systems',['deger'=>$value1],['anahtar'=>'hesapkilit_tablo']);
		die(json_encode(["result"=>true,"message"=>"Hesap Kilit ayarları güncellendi!"]));
	}
	public function itemkilitedit()
	{
		$status = $_POST['itemkilit_durum'];
		$value1 = $_POST['itemkilit_sutun'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'itemkilit_durum']);
		$this->db->update('systems',['deger'=>$value1],['anahtar'=>'itemkilit_sutun']);
		die(json_encode(["result"=>true,"message"=>"İtem Kilit ayarları güncellendi!"]));
	}
	public function karakterkilitedit()
	{
		$status = $_POST['karakterkilit_durum'];
		$value1 = $_POST['karakterkilit_sutun'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('systems',['deger'=>$status],['anahtar'=>'karakterkilit_durum']);
		$this->db->update('systems',['deger'=>$value1],['anahtar'=>'karakterkilit_sutun']);
		die(json_encode(["result"=>true,"message"=>"Karakter Kilit ayarları güncellendi!"]));
	}
	public function logoupload()
	{
		$image = new Bulletproof\Image($_FILES);
		$image->setMime(["gif","png","jpeg","apng"])
			->setSize(100,5000000)
			->setLocation("data/upload");

		if ($image['logo'])
		{
			$uploadLogo = $image->upload();

			if (!$uploadLogo)
				die(json_encode(["result"=>false, "message"=>$image->getError()]));

			$uploadData = [
				"width" => $image->getWidth(),
				"height" => $image->getHeight(),
				"name" => $image->getName(),
				"mime" => $image->getMime(),
				"location" => $image->getLocation(),
				"size" => $image->getSize()
			];

			// Settings
			$logoFullName = $uploadData["name"].".".$uploadData["mime"];
			$logoFullPath = "data/upload/".$logoFullName;

			$uploadData["full_name"] = $logoFullName;
			$uploadData["full_path"] = $logoFullPath;

			$this->db->update('settings',array('deger'=>$logoFullPath),array('anahtar'=>'logo'));
			$this->db->update('settings',array('deger'=>$image->getWidth()."px"),array('anahtar'=>'logo_width'));
			$this->db->update('settings',array('deger'=>$image->getWidth()."px"),array('anahtar'=>'logo_default_width'));
			// Settings

			die(json_encode(["result"=>true,"message"=>"Logo yüklendi!","data"=>$uploadData]));
		}
	}
	public function logoedit()
	{
		$logoWidth = isset($_POST['logo_width']) ? $_POST['logo_width'] : null;
		$logoPositionX = isset($_POST['logo_position_x']) ? $_POST['logo_position_x'] : null;
		$logoPositionY = isset($_POST['logo_position_y']) ? $_POST['logo_position_y'] : null;
		$logoFilter = isset($_POST['logo_filter']) ? $_POST['logo_filter'] : null;
		$logoHover = isset($_POST['logo_hover']) ? $_POST['logo_hover'] : null;

		if ($logoWidth === null || $logoPositionX === null || $logoPositionY === null || $logoFilter === null || $logoHover === null)
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$logoWidth = ($logoWidth === "0") ? $logoWidth : $logoWidth."px";
		$logoPositionX = ($logoPositionX === "0") ? $logoPositionX : $logoPositionX."px";
		$logoPositionY = ($logoPositionY === "0") ? $logoPositionY : $logoPositionY."px";

		//Logo Width
		$this->db->update('settings',['deger'=>$logoWidth],['anahtar'=>'logo_width']);
		//Logo Width

		//Logo Position X
		$this->db->update('settings',['deger'=>$logoPositionX],['anahtar'=>'logo_position_x']);
		//Logo Position X

		//Logo Position Y
		$this->db->update('settings',['deger'=>$logoPositionY],['anahtar'=>'logo_position_y']);
		//Logo Position Y

		//Logo Filter
		$this->db->update('settings',['deger'=>$logoFilter],['anahtar'=>'logo_filter']);
		//Logo Filter

		//Logo Hover
		$this->db->update('settings',['deger'=>$logoHover],['anahtar'=>'logo_hover']);
		//Logo Hover

		die(json_encode(["result"=>true,"message"=>"Logo ayarları güncellendi!"]));
	}
	public function cloudedit()
	{
		$status = $_POST['cloud_status'];
		$value1 = $_POST['cloud_mail'];
		$value2 = $_POST['cloud_auth'];
		$value3 = Functions::HttpLinkRemove($_POST['cloud_dom']);
		if ($status == '' || $value1 == '' || $value2 == '' || $value3 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'cloud_status']);
		$this->db->update('settings',['deger'=>$value1],['anahtar'=>'cloud_mail']);
		$this->db->update('settings',['deger'=>$value2],['anahtar'=>'cloud_auth']);
		$this->db->update('settings',['deger'=>$value3],['anahtar'=>'cloud_dom']);
		die(json_encode(["result"=>true,"message"=>"CloudFlare ayarları güncellendi!"]));
	}
	public function careselect()
	{
		$status = $_POST['status'];
		$theme = $_POST['care'];
		$getTheme = \StaticDatabase\StaticDatabase::settings('caretheme');
		if ($theme == $getTheme){
			echo '<script type="text/javascript">alert("Bir Hata Oluştu");</script>';
		}else{
			echo '<script type="text/javascript">alert("Güncelleme Başarılı");</script>';
			$this->db->update('settings',array('deger'=>$status),array('anahtar'=>'maintenance'));
			$this->db->update('settings',array('deger'=>$theme),array('anahtar'=>'caretheme'));
			Cache::delete('all');
            Session::set('delete_cache',true);
			Functions::setAdminLog("Bakım durumu başarıyla değiştirildi");
		}
		echo '<meta http-equiv="refresh" content="0;URL='.URI::get_path('site/care').'">';
	}
	public function indexselect()
	{
		$status = $_POST['status'];
		$theme = $_POST['index'];
		$getTheme = \StaticDatabase\StaticDatabase::settings('homein');
		if ($theme == $getTheme){
			echo '<script type="text/javascript">alert("Bir Hata Oluştu");</script>';
		}else{
			echo '<script type="text/javascript">alert("Güncelleme Başarılı");</script>';
			$this->db->update('settings',array('deger'=>$status),array('anahtar'=>'indexhome'));
			$this->db->update('settings',array('deger'=>$theme),array('anahtar'=>'homein'));
			Cache::delete('all');
            Session::set('delete_cache',true);
			Functions::setAdminLog("Index başarıyla değiştirildi");
		}
		echo '<meta http-equiv="refresh" content="0;URL='.URI::get_path('site/siteindex').'">';
	}
	public function landing1list()
	{
		return $this->db->sql("SELECT * FROM index_basliklar ORDER BY kategori_id ASC");
	}
	public function landing1edit()
	{
		$findMe = $_POST['findme'];

		if ($findMe == '')
			URI::redirect('site/landing1');

		$this->db->insert('index_basliklar',['kategori_adi'=>$findMe]);

		URI::redirect('site/landing1');
	}
	public function landingdelete1($arg)
	{
		$control = $this->db->select('kategori_id')->table('index_basliklar')->where(['kategori_id'=>$arg])->count();
		if ($control > 0)
			$this->db->delete('index_basliklar',['kategori_id'=>$arg],1);
		URI::redirect('site/landing1');
	}
	public function landing2edit()
	{
		$ork = $_POST['ork'];
		$lanet = $_POST['lanet'];
		$seytan = $_POST['seytan'];
		$buz = $_POST['buz'];
		$zelkova = $_POST['zelkova'];
		$tug = $_POST['tug'];
		$krm = $_POST['krm'];
		$lider = $_POST['lider'];
		$kem = $_POST['kem'];
		$bilge = $_POST['bilge'];
		$orksayi = $_POST['orksayi'];
		$lanetsayi = $_POST['lanetsayi'];
		$seytansayi = $_POST['seytansayi'];
		$buzsayi = $_POST['buzsayi'];
		$zelkovasayi = $_POST['zelkovasayi'];
		$tugsayi = $_POST['tugsayi'];
		$krmsayi = $_POST['krmsayi'];
		$lidersayi = $_POST['lidersayi'];
		$kemsayi = $_POST['kemsayi'];
		$bilgesayi = $_POST['bilgesayi'];

		if ($ork == '' || $lanet == '' || $seytan == '' || $buz == '' || $zelkova == '' || $tug == '' || $krm == '' || $lider == '' || $kem == '' || $bilge == '')
			URI::redirect('site/landing2');

		$this->db->update('index_biyolog',array('ork'=>$ork,'lanet'=>$lanet,'seytan'=>$seytan,'buz'=>$buz,'zelkova'=>$zelkova,'tug'=>$tug,'krm'=>$krm,'lider'=>$lider,'kem'=>$kem,'bilge'=>$bilge,'orksayi'=>$orksayi,'lanetsayi'=>$lanetsayi,'seytansayi'=>$seytansayi,'buzsayi'=>$buzsayi,'zelkovasayi'=>$zelkovasayi,'tugsayi'=>$tugsayi,'krmsayi'=>$krmsayi,'lidersayi'=>$lidersayi,'kemsayi'=>$kemsayi,'bilgesayi'=>$bilgesayi),array('ayar_id'=>'1'));

		URI::redirect('site/landing2');
	}
	public function landing3edit()
	{
		$guczeka = $_POST['guczeka'];
		$guczeka2 = $_POST['guczeka2'];
		$guczeka3 = $_POST['guczeka3'];
		$maxhp = $_POST['maxhp'];
		$maxhp2 = $_POST['maxhp2'];
		$maxhp3 = $_POST['maxhp3'];
		$maxsp = $_POST['maxsp'];
		$maxsp2 = $_POST['maxsp2'];
		$maxsp3 = $_POST['maxsp3'];
		$shizi = $_POST['shizi'];
		$shizi2 = $_POST['shizi2'];
		$shizi3 = $_POST['shizi3'];
		$hhizi = $_POST['hhizi'];
		$hhizi2 = $_POST['hhizi2'];
		$hhizi3 = $_POST['hhizi3'];
		$bhizi = $_POST['bhizi'];
		$bhizi2 = $_POST['bhizi2'];
		$bhizi3 = $_POST['bhizi3'];
		$hpspuretimi = $_POST['hpspuretimi'];
		$hpspuretimi2 = $_POST['hpspuretimi2'];
		$hpspuretimi3 = $_POST['hpspuretimi3'];
		$zsy = $_POST['zsy'];
		$zsy2 = $_POST['zsy2'];
		$zsy3 = $_POST['zsy3'];
		$kritdel = $_POST['kritdel'];
		$kritdel2 = $_POST['kritdel2'];
		$kritdel3 = $_POST['kritdel3'];
		$yari = $_POST['yari'];
		$yari2 = $_POST['yari2'];
		$yari3 = $_POST['yari3'];
		$buyu = $_POST['buyu'];
		$buyu2 = $_POST['buyu2'];
		$buyu3 = $_POST['buyu3'];
		$misolumsuz = $_POST['misolumsuz'];
		$misolumsuz2 = $_POST['misolumsuz2'];
		$misolumsuz3 = $_POST['misolumsuz3'];
		$savunma = $_POST['savunma'];
		$savunma2 = $_POST['savunma2'];
		$savunma3 = $_POST['savunma3'];

		if ($_POST == '')
			URI::redirect('site/landing3');

		$this->db->update('index_efsun',array('guczeka'=>$guczeka,'guczeka2'=>$guczeka2,'guczeka3'=>$guczeka3,'maxhp'=>$maxhp,'maxhp2'=>$maxhp2,'maxhp3'=>$maxhp3,'maxsp'=>$maxsp,'maxsp2'=>$maxsp2,'maxsp3'=>$maxsp3,'shizi'=>$shizi,'shizi2'=>$shizi2,'shizi3'=>$shizi3,'hhizi'=>$hhizi,'hhizi2'=>$hhizi2,'hhizi3'=>$hhizi3,'bhizi'=>$bhizi,'bhizi2'=>$bhizi2,'bhizi3'=>$bhizi3,'hpspuretimi'=>$hpspuretimi,'hpspuretimi2'=>$hpspuretimi2,'hpspuretimi3'=>$hpspuretimi3,'zsy'=>$zsy,'zsy2'=>$zsy2,'zsy3'=>$zsy3,'kritdel'=>$kritdel,'kritdel2'=>$kritdel2,'kritdel3'=>$kritdel3,'yari'=>$yari,'yari2'=>$yari2,'yari3'=>$yari3,'buyu'=>$buyu,'buyu2'=>$buyu2,'buyu3'=>$buyu3,'misolumsuz'=>$misolumsuz,'misolumsuz2'=>$misolumsuz2,'misolumsuz3'=>$misolumsuz3,'savunma'=>$savunma,'savunma2'=>$savunma2,'savunma3'=>$savunma3),array('ayar_id'=>'1'));

		URI::redirect('site/landing3');
	}
	public function landing4list()
	{
		return $this->db->sql("SELECT * FROM index_market ORDER BY id ASC");
	}
	public function landing4edit()
	{
		if ($_POST == '')
			URI::redirect('site/landing4');

		$this->db->insert('index_market',['market_adi'=>$_POST['market_adi'],'market_resim'=>$_POST['market_resim']]);

		URI::redirect('site/landing4');
	}
	public function landingdelete4($arg)
	{
		$control = $this->db->select('id')->table('index_market')->where(['id'=>$arg])->count();
		if ($control > 0)
			$this->db->delete('index_market',['id'=>$arg],1);
		URI::redirect('site/landing4');
	}
	public function landing5list()
	{
		return $this->db->sql("SELECT * FROM index_detay ORDER BY konu_id ASC");
	}
	public function landing5edit()
	{
		if ($_POST == '')
			URI::redirect('site/landing5');

		$this->db->insert('index_detay',['konu_baslik'=>$_POST['konu_baslik'],'konu_bir'=>$_POST['konu_bir'],'konu_iki'=>$_POST['konu_iki'],'konu_uc'=>$_POST['konu_uc'],'konu_dort'=>$_POST['konu_dort'],'konu_resim'=>$_POST['konu_resim']]);

		URI::redirect('site/landing5');
	}
	public function landingdelete5($arg)
	{
		$control = $this->db->select('konu_id')->table('index_detay')->where(['konu_id'=>$arg])->count();
		if ($control > 0)
			$this->db->delete('index_detay',['konu_id'=>$arg],1);
		URI::redirect('site/landing5');
	}
}