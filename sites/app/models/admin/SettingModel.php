<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4.02.2017
 * Time: 21:29
 */
use Model\IN_Model;
class SettingModel extends IN_Model
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
	public function site()
	{
		return $this->db->select()->table('language')->get();
	}
	public function siteedit(){
		$title = $_POST['title'];
		$slogan = $_POST['slogan'];
		$cache = $_POST['cachetime'];
		$getTitle = \StaticDatabase\StaticDatabase::settings('oyun_adi');
		$getSlogan = \StaticDatabase\StaticDatabase::settings('slogan');
		$getCache = \StaticDatabase\StaticDatabase::settings('cachetime');
		if ($slogan == $getSlogan && $title == $getTitle && $cache == $getCache){
			$result['result'] = false;
		}else{
			$result['result'] = true;
			$this->db->update('settings',array('deger'=>$title),array('anahtar'=>'oyun_adi'));
			$this->db->update('settings',array('deger'=>$slogan),array('anahtar'=>'slogan'));
			$this->db->update('settings',array('deger'=>$cache),array('anahtar'=>'cachetime'));
			Functions::setAdminLog("Oyun Adı, Sloganı ve Cache Süresi Güncelledi");
		}
		echo json_encode($result);
	}
	public function counter()
	{
		$result['data'] = $this->gdb->sql("SELECT `TABLE_NAME` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = ? AND TABLE_TYPE = ?",[PLAYER_DB_NAME,'BASE TABLE']);
		return $result;
	}
	public function logoedit(){
		$up = $_FILES['logo']['name'];
		if ($up == ""){
			$result['result'] = false;
		}else{
			$upload = $this->upload->image_upload($_FILES['logo']);
			if ($upload["result"] === false)
				$result['result'] = false;
			else
			{
				$result['result'] = true;
				$result['data'] = $upload;
				$this->db->update('settings',array('deger'=>$upload['paths']),array('anahtar'=>'logo'));
				Functions::setAdminLog("Oyun Logosunu Değiştirdi");
			}
		}
		echo json_encode($result);
	}
	public function slotcash()
	{
		$status = isset($_POST['slot_cash_status']) ? $_POST['slot_cash_status'] : null;
		$slotCashCount = isset($_POST['slot_cash_count']) ? $_POST['slot_cash_count'] : null;
		$slotCashGift = isset($_POST['slot_cash_gift']) ? $_POST['slot_cash_gift'] : null;

		if ($status === null || $slotCashCount === null || $slotCashGift === null)
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		if ($slotCashCount < 3)
			die(json_encode(["result"=>false,"message"=>"Slot cash resim sayısı en az 3 olabilir!"]));

		if ($slotCashGift < 2)
			die(json_encode(["result"=>false,"message"=>"Slot cash hediye sayısı en az 2 olabilir!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'slot_cash_status']);
		$this->db->update('settings',['deger'=>$slotCashCount],['anahtar'=>'slot_cash_count']);
		$this->db->update('settings',['deger'=>$slotCashGift],['anahtar'=>'slot_cash_gift']);

		die(json_encode(["result"=>true,"message"=>"Slot Cash ayarları güncellendi!"]));
	}
	public function shoprecaptcha()
	{
		$status = isset($_POST['shop_recaptcha_status']) ? $_POST['shop_recaptcha_status'] : null;

		if ($status === null)
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'shop_recaptcha_status']);

		die(json_encode(["result"=>true,"message"=>"Recaptcha ayarı güncellendi!"]));
	}
	public function mailedit()
	{
		$host = $_POST['host'];
		$title = $_POST['title'];
		$mail = $_POST['mail'];
		$password = $_POST['password'];
		$port = $_POST['port'];
		$protocol = $_POST['protocol'];
		if ($host == '' || $mail == '' || $password == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$title],['anahtar'=>'smtp_from']);
			$this->db->update('settings',['deger'=>$host],['anahtar'=>'smtp_host']);
			$this->db->update('settings',['deger'=>$mail],['anahtar'=>'smtp_username']);
			$this->db->update('settings',['deger'=>$mail],['anahtar'=>'admin_mail']);
			$this->db->update('settings',['deger'=>$password],['anahtar'=>'smtp_password']);
			$this->db->update('settings',['deger'=>$port],['anahtar'=>'smtp_port']);
			$this->db->update('settings',['deger'=>$protocol],['anahtar'=>'smtp_secure']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function linkedit()
	{
		$landing = $_POST['landing'];
		$forum = $_POST['forum'];
		if ($landing == '' || $forum == '')
			$result['result'] = false;
		elseif ($landing !== null && $forum !== null){
			$this->db->update('settings',['deger'=>$landing],['anahtar'=>'tanitim']);
			$this->db->update('settings',['deger'=>$forum],['anahtar'=>'forum']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function linkedit2()
	{
		$facebook = $_POST['facebook'];
		$facebook_status = $_POST['facebook_status'];
		$facebook_news = $_POST['facebook_news'];
		if ($facebook == '' || $facebook_status == '' || $facebook_news == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$facebook],['anahtar'=>'facebook']);
			$this->db->update('settings',['deger'=>$facebook_status],['anahtar'=>'facebook_status']);
			$this->db->update('settings',['deger'=>$facebook_news],['anahtar'=>'facebook_like_status']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function linkedit3()
	{
		$youtube = $_POST['youtube'];
		$instagram = $_POST['instagram'];
		if ($youtube == '' && $instagram == '')
			$result['result'] = false;

		else
		{
			$this->db->update('settings',['deger'=>$youtube],['anahtar'=>'youtube']);
			$this->db->update('settings',['deger'=>$instagram],['anahtar'=>'instagram']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function linkedit4()
	{
		$discord = $_POST['discord'];
		$discord_status = $_POST['discord_status'];
		if ($discord == '' || $discord_status == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$discord],['anahtar'=>'discord']);
			$this->db->update('settings',['deger'=>$discord_status],['anahtar'=>'discord_status']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function captchaedit()
	{
		$status = $_POST['status'];
		$site = $_POST['site'];
		$secret = $_POST['secret'];
		if ($status == '' || $site == '' || $secret == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'recaptcha']);
			$this->db->update('settings',['deger'=>$site],['anahtar'=>'sitekey']);
			$this->db->update('settings',['deger'=>$secret],['anahtar'=>'secretkey']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function langedit()
	{
		$status = $_POST['status'];
		$coins = $_POST['lang'];
		if ($status == '' || $coins == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'multi_languages']);
			$this->db->update('settings',['deger'=>$coins],['anahtar'=>'default_language']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function paywantedit()
	{
		$status = $_POST['status'];
		$api = $_POST['api'];
		$secret = $_POST['secret'];
		if ($status == '' || $api == '' || $secret == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'paywant_status']);
			$this->db->update('settings',['deger'=>$api],['anahtar'=>'paywantKey']);
			$this->db->update('settings',['deger'=>$secret],['anahtar'=>'paywantSecret']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function paytredit()
	{
		$status = $_POST['status'];
		$payid = $_POST['payid'];
		$api = $_POST['token'];
		$salt = $_POST['salt'];
		if ($status == '' || $payid == '' || $api == '' || $salt == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'paytr_status']);
			$this->db->update('settings',['deger'=>$payid],['anahtar'=>'paytr_id']);
			$this->db->update('settings',['deger'=>$api],['anahtar'=>'paytr_key']);
			$this->db->update('settings',['deger'=>$salt],['anahtar'=>'paytr_salt']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function itemciedit()
	{
		$status = $_POST['status'];
		$api = $_POST['token'];
		$commission = $_POST['commission'];
		if ($status == '' || $api == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'itemci_status']);
			$this->db->update('settings',['deger'=>$api],['anahtar'=>'itemci_link']);
			$this->db->update('settings',['deger'=>$commission],['anahtar'=>'itemci_commission']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function onlineedit()
	{
		$status = $_POST['status'];
		$counter = $_POST['counter'];
		if ($status == '' || $counter == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'total_online_status']);
			$this->db->update('settings',['deger'=>$counter],['anahtar'=>'online']);
			Functions::deleteCache();
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function todayedit()
	{
		$status = $_POST['status'];
		$counter = $_POST['counter'];
		if ($status == '' || $counter == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'today_login_status']);
			$this->db->update('settings',['deger'=>$counter],['anahtar'=>'todaylogin']);
			Functions::deleteCache();
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function accountedit()
	{
		$status = $_POST['status'];
		$counter = $_POST['counter'];
		if ($status == '' || $counter == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'total_account_status']);
			$this->db->update('settings',['deger'=>$counter],['anahtar'=>'totalaccount']);
			Functions::deleteCache();
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function playeredit()
	{
		$status = $_POST['status'];
		$counter = $_POST['counter'];
		if ($status == '' || $counter == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'total_player_status']);
			$this->db->update('settings',['deger'=>$counter],['anahtar'=>'totalplayer']);
			Functions::deleteCache();
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function pazaredit()
	{
		$status = $_POST['status'];
		$counter = $_POST['counter'];
		if ($status == '' || $counter == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'active_pazar_status']);
			$this->db->update('settings',['deger'=>$counter],['anahtar'=>'activepazar']);
			Functions::deleteCache();
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function pazaredit2()
	{
		$offline_shop_npc = $_POST['offline_shop_npc'];
		$offline_shop_item = $_POST['offline_shop_item'];
		if ($offline_shop_npc == '' || $offline_shop_item == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$offline_shop_npc],['anahtar'=>'offline_shop_npc']);
			$this->db->update('settings',['deger'=>$offline_shop_item],['anahtar'=>'offline_shop_item']);
			Functions::deleteCache();
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function socketedit()
	{
		$status = $_POST['status'];
		$key = $_POST['key'];
		$ch1 = $_POST['ch1'];
		$ch2 = $_POST['ch2'];
		$ch3 = $_POST['ch3'];
		$ch4 = $_POST['ch4'];
		if ($status == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'socket_status']);
			$this->db->update('settings',['deger'=>$key],['anahtar'=>'serverResponse']);
			$this->db->update('settings',['deger'=>$ch1],['anahtar'=>'ch1_port']);
			$this->db->update('settings',['deger'=>$ch2],['anahtar'=>'ch2_port']);
			$this->db->update('settings',['deger'=>$ch3],['anahtar'=>'ch3_port']);
			$this->db->update('settings',['deger'=>$ch4],['anahtar'=>'ch4_port']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function socketedit2()
	{
		$status = $_POST['status'];
		if ($status == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'socket_status']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function epprice()
	{
		return $this->db->select()->table('ep_price')->get();
	}
	public function eppriceadd()
	{
		$ep = $_POST['ep'];
		$tl = $_POST['tl'];
		if ($ep == '' || $tl == '')
		{
			Session::set('changeOK',false);
			URI::redirect('setting/epprice');
		}
		else
		{
			$this->db->insert('ep_price',['ep'=>$ep,'tl'=>$tl]);
			Session::set('changeOK',true);
			URI::redirect('setting/epprice');
		}
	}
	public function epdelete($arg)
	{
		$this->db->delete('ep_price',['id'=>$arg]);
		Session::set('changeOK',true);
		URI::redirect('setting/epprice');
	}
	public function online()
	{
		if (StaticDatabase\StaticDatabase::settings('socket_status') == 1)
		{
			$ch1 = Functions::sendServer(false,"USER_COUNT","1");
			$ch2 = Functions::sendServer(false,"USER_COUNT","2");
			$ch3 = Functions::sendServer(false,"USER_COUNT","3");
			$ch4 = Functions::sendServer(false,"USER_COUNT","4");
			$return = ["ch1"=>$ch1,"ch2"=>$ch2,"ch3"=>$ch3,"ch4"=>$ch4];
		}
		else
		{
			$return = $this->gdb->sql("SELECT COUNT(id) as count FROM ".PLAYER_DB_NAME.".player WHERE DATE_SUB(NOW(), INTERVAL 60 MINUTE) < last_play;")[0];
		}
		return $return;
	}
	public function wheeledit()
	{
		$status = $_POST['status'];
		$coins = $_POST['coins'];
		if ($status == '' || $coins == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'wheel']);
			$this->db->update('settings',['deger'=>$coins],['anahtar'=>'wheelcoins']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function shopedit()
	{
		$status = $_POST['status'];
		$sas = $_POST['sas_key'];

		if ($status == '' || $sas == '' )
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'shop_status']);
			$this->db->update('settings',['deger'=>$sas],['anahtar'=>'gameKey']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function shopedit1()
	{
		$status = $_POST['status'];
		$sas = $_POST['sas_key'];

		if ($status == '' || $sas == '' )
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'happy_hour']);
			$this->db->update('settings',['deger'=>$sas],['anahtar'=>'happy_hour_discount']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function shopedit2()
	{
		$ep = $_POST['ep'];
		$em = $_POST['em'];
		if ($ep == '' || $em == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$ep],['anahtar'=>'cash']);
			$this->db->update('settings',['deger'=>$em],['anahtar'=>'mileage']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function ticket()
	{
		return $this->db->sql("SELECT * FROM ticket_title");
	}
	public function ticketedit()
	{
		$status = $_POST['status'];
		$mail_coins = $_POST['mail_status'];
		if ($status == '' || $mail_coins == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'ticket_status']);
			$this->db->update('settings',['deger'=>$mail_coins],['anahtar'=>'ticket_mail']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function ticketcategory()
	{
		$category = $_POST['ticket_category'];
		if ($category !== '')
		{
			$this->db->insert('ticket_title',['title'=>$category]);
		}
		URI::redirect('setting/ticket');
	}
	public function ticketdelete($arg)
	{
		$control = $this->db->select('id')->table('ticket_title')->where(['id'=>$arg])->count();
		if ($control > 0)
			$this->db->delete('ticket_title',['id'=>$arg],1);
		URI::redirect('setting/ticket');
	}
	public function kasagameedit()
	{
		$status = $_POST['status'];
		$api = $_POST['api'];
		$secret = $_POST['secret'];
		if ($status == '' || $api == '' || $secret == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'kasagame_status']);
			$this->db->update('settings',['deger'=>$api],['anahtar'=>'kasagame_merc_id']);
			$this->db->update('settings',['deger'=>$secret],['anahtar'=>'kasagame_api_key']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function sanalpayedit()
	{
		$status = $_POST['status'];
		$api = $_POST['api'];
		$secret = $_POST['secret'];
		if ($status == '' || $api == '' || $secret == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'sanalpay_status']);
			$this->db->update('settings',['deger'=>$api],['anahtar'=>'sanalpay_api']);
			$this->db->update('settings',['deger'=>$secret],['anahtar'=>'sanalpay_hash']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function payreksedit()
	{
		$status = $_POST['status'];
		$api = $_POST['api'];
		$secret = $_POST['secret'];
		if ($status == '' || $api == '' || $secret == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'payreks_status']);
			$this->db->update('settings',['deger'=>$api],['anahtar'=>'payreks_api']);
			$this->db->update('settings',['deger'=>$secret],['anahtar'=>'payreks_secret']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function payreksedit2()
	{
		$status = $_POST['status'];
		$token = $_POST['token'];
		if ($status == '' || $token == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'payreks_notification_status']);
			$this->db->update('settings',['deger'=>$token],['anahtar'=>'payreks_notification_token']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function itemsultanedit()
	{
		$status = $_POST['status'];
		$api = $_POST['token'];
		if ($status == '' || $api == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'itemsultan_status']);
			$this->db->update('settings',['deger'=>$api],['anahtar'=>'itemsultan_link']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	public function oyunalisverisiedit()
	{
		$status = $_POST['status'];
		$api = $_POST['token'];
		if ($status == '' || $api == '')
			$result['result'] = false;
		else
		{
			$this->db->update('settings',['deger'=>$status],['anahtar'=>'oyunalisverisi_status']);
			$this->db->update('settings',['deger'=>$api],['anahtar'=>'oyunalisverisi_link']);
			$result['result'] = true;
		}
		echo json_encode($result);
	}
	
	public function footeredit()
	{
		$status = $_POST['name'];
		$value1 = $_POST['link'];
		if ($status == '' || $value1 == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'footer_name']);
		$this->db->update('settings',['deger'=>$value1],['anahtar'=>'footer_link']);
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
	public function testmail()
	{
		$email = $_POST["email"];

		$sendMail = $this->mail->sendTest(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Test Mail", $email, "Test Mail");

		die(json_encode($sendMail));
	}
	public function freesell()
	{
		$status = filter_var($_POST['status'],FILTER_SANITIZE_STRING);
		if ($status == '')
			die(json_encode(["result"=>false,"message"=>"Lütfen tüm alanları doldurunuz!"]));

		$this->db->update('settings',['deger'=>$status],['anahtar'=>'free_sell_item']);
		die(json_encode(["result"=>true,"message"=>"Ayarlar güncellendi!"]));
	}
}