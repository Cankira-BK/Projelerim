<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 2.02.2017
     * Time: 12:17
     */
    use Model\IN_Model;

    class BuyModel extends IN_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
		{
			$result['ep_price'] = $this->db->select()->table('ep_price')->get();
			return $result;
		}
        public function paywant(){
            Session::init();
            $sId = Session::get('sId');
            return $sId;
        }
		public function kasagame(){
            Session::init();
            $sId = Session::get('sId');
            return $sId;
        }
        public function sanalpay()
		{
			Session::init();
			$sId = Session::get('sId');
			return $sId;
		}
		public function paytr(){
            Session::init();
            $sId = Session::get('sId');
            return $sId;
        }
		public function payreks()
		{
			$accountID = Session::get('aId');
			$getAccount = $this->gdb->select('id,login')->table('account')->where(['id'=>$accountID])->get()[0];

			if (count($getAccount) < 0)
				return ["result"=>false];

			$apiKey = \StaticDatabase\StaticDatabase::settings('payreks_api');
			$secretKey = \StaticDatabase\StaticDatabase::settings('payreks_secret');
			$encryptHash = $this->encoderHash($apiKey,$secretKey);
			$userID = $getAccount['id'];
			$userInfo = $getAccount['login'];
			$userIP = $this->getIPAddress();

			$postData = [
				"api_key" => $apiKey,
				"token" => $encryptHash,
				"return_type" => "json",
				"user_id" => $userID,
				"user_info" => $userInfo,
				"user_ip" => $userIP
			];

			$response = $this->curlReq("https://api.payreks.com/gateway",$postData);
			return ["result"=>true,"data"=>$response];
		}
		
        public function notify($arg){
            if($_POST){
				if ($arg !== \StaticDatabase\StaticDatabase::settings('paywant_token'))
					die("NULL");
                else
                {
					$SiparisID = $this->paywantAntiInjection($_POST["SiparisID"]);
					$ExtraData= $this->paywantAntiInjection($_POST["ExtraData"]);
					$UserID= $this->paywantAntiInjection($_POST["UserID"]);
					$ReturnData= $this->paywantAntiInjection($_POST["ReturnData"]);
					$Status= $this->paywantAntiInjection($_POST["Status"]);
					$OdemeKanali= $this->paywantAntiInjection($_POST["OdemeKanali"]);
					$OdemeTutari= $this->paywantAntiInjection($_POST["OdemeTutari"]);
					$NetKazanc= $this->paywantAntiInjection($_POST["NetKazanc"]);
					$Hash= filter_var($_POST["Hash"],FILTER_SANITIZE_STRING);
					$apiKey = \StaticDatabase\StaticDatabase::settings('paywantKey');
					$apiSecret = \StaticDatabase\StaticDatabase::settings('paywantSecret');
					if($SiparisID == "" || $ExtraData == "" || $UserID == "" || $ReturnData == "" || $Status == "" || $OdemeKanali == "" || $OdemeTutari == "" || $NetKazanc == "" || $Hash == "")
					{
						echo "eksik veri";
						exit();
					}else{
						$hashKontrol = base64_encode(hash_hmac('sha256',"$SiparisID|$ExtraData|$UserID|$ReturnData|$Status|$OdemeKanali|$OdemeTutari|$NetKazanc".$apiKey,$apiSecret,true));
						if($Hash != $hashKontrol){
							exit("hash hatali");
						}else{
							$kontrol = $this->gdb->select('id')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id'=>$UserID,'login'=>$ReturnData))->count();
							if($kontrol > 0){
								$kontrol2		= $this->db->select('ID')->table('api_paywant')->where(array('SiparisID'=>$SiparisID))->count();
								if ($kontrol2 > 0){
									// daha önce yükleme olmuş, işlem yapma "1 " döndür
									exit("OK");
								}else{
									$data = array(
										'SiparisID'=>$SiparisID,
										'UserID'=>$UserID,
										'ReturnData'=>$ReturnData,
										'Status'=>$Status,
										'OdemeKanali'=>$OdemeKanali,
										'OdemeTutari'=>$OdemeTutari,
										'NetKazanc'=>$NetKazanc,
										'ExtraData'=>$ExtraData,
										'Tarih'=>date("Y-m-d H:i:s")
									);
									$kayitGir = $this->db->query("INSERT INTO api_paywant (SiparisID,UserID,ReturnData,Status,OdemeKanali,OdemeTutari,NetKazanc,ExtraData,Tarih) VALUES 
							('$SiparisID','$UserID','$ReturnData','$Status','$OdemeKanali','$OdemeTutari','$NetKazanc','$ExtraData','".date("Y-m-d H:i:s")."')");
									if ($kayitGir){
										// log girildi kontrol yapıp yükleyelim
										if($Status  == "100"){
											if (\StaticDatabase\StaticDatabase::settings('happy_hour'))
												$ExtraData = ($ExtraData * intval(\StaticDatabase\StaticDatabase::settings('happy_hour_discount')) / 100) + $ExtraData;
											$yukle =  $this->gdb->query("UPDATE ".ACCOUNT_DB_NAME.".account SET ".CASH." = ".CASH." + $ExtraData  WHERE id='$UserID' and login='$ReturnData'");
											if($yukle){
												exit("OK");
											}else{
												exit("ep verilemedi");
											}
										}else{
											// 101 , ödeme iptal edildi
											exit("OK");
										}
									}else{
										// log girilmedi
										echo "log girilemedi";
									}
								}
							}else{
								echo "kullanici yok";
							}
						}
					}
				}
            }else{
                exit("post yok");
            }
        }

		public function sanalpay_notify($arg){
			if($_POST){
				if ($arg !== \StaticDatabase\StaticDatabase::settings('paywant_token'))
					die("NULL");
				else
				{
					$sunucuDurumu = $this->sanal_pay_post('status');
					if($sunucuDurumu == '2qmTWhx8tp1oCFqWfBKLrHwDgUrmtJUm') // 2qmTWhx8tp1oCFqWfBKLrHwDgUrmtJUm değiştirmeyiniz. Sunucu test anahtarıdır)
					{
						echo  "z75LfsKOYB3bHkynl8ySGkWm5DPpMjRC";
					}
					$postEdilebilirMi = $this->sanal_pay_post('postizin');
					if($postEdilebilirMi == 'true'){
						$apiKey = \StaticDatabase\StaticDatabase::settings('sanalpay_api');
						$hashKey = \StaticDatabase\StaticDatabase::settings('sanalpay_hash');
						$epMiktari = $this->sanal_pay_post('epmiktari');
						$userName = $this->sanal_pay_post('kullanici');
						$userId = $this->sanal_pay_post('kullaniciId');
						$hash = $this->sanal_pay_post('hash');
						$hashCode = base64_encode(hash_hmac('sha256', $apiKey.$hashKey.$userName.$userId.$epMiktari,$hashKey,true));
						if($hashCode != $hash){
							printf('Hash key hatalı');
						}
						else
						{
							$kullaniciKontrol = $this->gdb->prepare('SELECT id FROM '.ACCOUNT_DB_NAME.'.account WHERE login = ? && id = ?'); // örnek veritabanı değişkeni : $db
							$kullaniciKontrol->execute(array($userName, $userId));
							if($kullaniciKontrol->rowCount()){
								if (\StaticDatabase\StaticDatabase::settings('happy_hour'))
									$epMiktari = ($epMiktari * intval(\StaticDatabase\StaticDatabase::settings('happy_hour_discount')) / 100) + $epMiktari;
								$update = $this->gdb->prepare("UPDATE ".ACCOUNT_DB_NAME.".account SET ".CASH." = ".CASH." + ? WHERE login = ? && id = ?");  // örnek veritabanı değişkeni : $db
								$update->execute(array($epMiktari, $userName, $userId));
								if($update->errorInfo()[2] == false){
									$insertLogData = [
										'account_id' => $userId,
										'login' => $userName,
										'ep' => $epMiktari,
										'date_time' => date("Y-m-d H:i:s")
									];
									$this->db->insert('sanalpay_api',$insertLogData);
									echo 'OK';
								}
								else{
									echo 'Ürün kullanıcıya gönderilemedi';
								}
							}
							else{
								echo 'Böyle bir kullanıcı yok';
							}
						}
					}
				}
			}else{
				exit("post yok");
			}
		}

		public function payreks_notify($arg){
			if($_POST){
				if ($arg !== \StaticDatabase\StaticDatabase::settings('paywant_token'))
					die("NULL");
				else
				{
					$orderID = isset($_POST['order_id']) ? $this->payreksFilter($_POST['order_id']) : null;
					$credit = isset($_POST['credit']) ? $this->payreksFilter($_POST['credit']) : null;
					$userID = isset($_POST['user_id']) ? $this->payreksFilter($_POST['user_id']) : null;
					$userInfo = isset($_POST['user_info']) ? $this->payreksFilter($_POST['user_info']) : null;
					$payLabel = isset($_POST['pay_label']) ? $this->payreksFilter($_POST['pay_label']) : null;
					$totalPrice = isset($_POST['total_price']) ? $this->payreksFilter($_POST['total_price']) : null;
					$netPrice = isset($_POST['net_price']) ? $this->payreksFilter($_POST['net_price']) : null;
					$hash = isset($_POST['hash']) ? $this->payreksFilter($_POST['hash']) : null;

					if ($orderID === null || $credit === null || $userID === null || $userInfo === null || $payLabel === null || $totalPrice === null || $netPrice === null || $hash === null)
						die("missing value");

					if ($orderID === "" || $credit === "" || $userID === "" || $userInfo === "" || $payLabel === "" || $totalPrice === "" || $netPrice === "" || $hash === "")
						die("empty value");

					$apiKey = \StaticDatabase\StaticDatabase::settings('payreks_api');
					$secretKey = \StaticDatabase\StaticDatabase::settings('payreks_secret');
					$hashData = md5($orderID.$credit.$userID.$userInfo.$payLabel.$totalPrice.$netPrice.$apiKey);
					$hashCreate = $this->payreksHashCreate('sha256',$hashData,$secretKey);

					if ($hash !== $hashCreate)
						die("wrong hash");

					$controlUser = $this->gdb->select()->table('account')->where(['id'=>$userID,'login'=>$userInfo])->get();

					if (count($controlUser) <= 0)
						die("user not found");

					$logControl = $this->db->select('id')->table('payreks_log')->where(['order_id'=>$orderID])->count();

					if ($logControl > 0)
						die("order already have");

					if (\StaticDatabase\StaticDatabase::settings('happy_hour'))
						$credit = ($credit * intval(\StaticDatabase\StaticDatabase::settings('happy_hour_discount')) / 100) + $credit;

					$updateCreditCount = $controlUser[0][CASH] + $credit;
					$this->gdb->update('account',[CASH=>$updateCreditCount],["id"=>$userID,"login"=>$userInfo]);

					$this->db->insert('payreks_log',["order_id"=>$orderID,"user_id"=>$userID,"user_info"=>$userInfo,"credit"=>$credit,"pay_label"=>$payLabel,"net_price"=>$netPrice,"date_time"=>date("Y-m-d H:i:s")]);
					die("OK");
				}
			}else{
				exit("post yok");
			}
		}
        public function kasagame_notify($arg)
		{
			if($_POST)
			{
				if ($arg !== \StaticDatabase\StaticDatabase::settings('kasagame_merc_id'))
					die("NULL");
				else
				{
					$magaza_id=\StaticDatabase\StaticDatabase::settings('kasagame_merc_id');
					$api_sifre=\StaticDatabase\StaticDatabase::settings('kasagame_api_key');
					
					$callback_data = $_POST;
					$amount = $callback_data['amount']; // Sipariş tutarı
					$product_id = $callback_data['product_id']; // Ürün No.
					$order_id = $callback_data['order_id']; // Ürün No.
					$order_date = $callback_data['order_date']; //Sipariş tarihi
					$merchant_id = $callback_data['merchant_id']; //Mağaza No.
					$return_id = $callback_data['return_id']; //Kullanıcı Adı
					$return_id2 = $callback_data['return_id2'];
					$user_ip = $callback_data['user_ip']; //Ödeme yapan ip adresi
					$api_key = $callback_data['api_key']; //API Key
					$product_return = $callback_data['product_return']; //Ürüne ait dönen veri. 1 ise Vip, 2 ise vip+ ,3 svip , 4 svip+ , 5 uvip, 6 uvip+
					if ($merchant_id==$magaza_id && $api_key=$api_sifre)
					{
						if($order_id == "" || $return_id == "" || $amount == "" || $user_ip == "" || $product_id == "" || $product_return == "")
						{
							echo "eksik veri";
							exit();
						}
						else
						{
							$control = $this->gdb->select()->table(''.ACCOUNT_DB_NAME.'.account')->where(['login'=>$return_id])->get();
							if (count($control) > 0) {
								$control2 = $this->db->select()->table('api_kasagame')->where(['SiparisID'=>$order_id])->get();
								if (count($control2) > 0)
								{
									exit("OK");
								}
								else
								{
									$kayitGir = $this->db->query("INSERT INTO api_kasagame (SiparisID,Kullanici,Fiyat,EPMiktar,IPAdresi,Tarih,Durum) VALUES ('$order_id','$return_id','$amount','$product_return','$user_ip','".date("Y-m-d H:i:s")."','OK')");
									if ($kayitGir)
									{
										if (\StaticDatabase\StaticDatabase::settings('happy_hour'))
											$product_return = ($product_return * intval(\StaticDatabase\StaticDatabase::settings('happy_hour_discount')) / 100) + $product_return;
										$yukle =  $this->gdb->query("UPDATE ".ACCOUNT_DB_NAME.".account SET ".CASH." = ".CASH." + $product_return  WHERE login='$return_id'");
										if($yukle){exit("OK");}else{exit("ep verilemedi");}
									}
									else{echo "log girilemedi";}
								}
							}
							else {
								echo "kullanici yok";
								exit();
							}
						}
					}
				}
			}
			else{exit("post yok");}
		}
		public function paytr_notify($arg)
		{
			if($_POST)
			{
				if ($arg !== \StaticDatabase\StaticDatabase::settings('paytr_id'))
					die("NULL");
				else
				{
					$post = $this->paywantAntiInjection($_POST);
					$merchant_key 	= \StaticDatabase\StaticDatabase::settings('paytr_key');
					$merchant_salt	= \StaticDatabase\StaticDatabase::settings('paytr_salt');
					$hash = base64_encode( hash_hmac('sha256', $post['merchant_oid'].$merchant_salt.$post['status'].$post['total_amount'], $merchant_key, true) );
					if( $hash != $post['hash'] )
						die('PAYTR notification failed: bad hash');
					if( $post['status'] == 'success' ) 
					{
						$yuklebeni = $post['total_amount'];
						$kimimben  = $post['merchant_oid'];
						$durumne  = $post['status'];
						$ipadresi = $this->getIPAddress();
						$kayitGir = $this->db->query("INSERT INTO api_paytr (KullaniciID,EPMiktar,IPAdresi,Tarih,Durum) VALUES ('$kimimben','$yuklebeni','$ipadresi','".date("Y-m-d H:i:s")."','$durumne')");
						if ($kayitGir)
						{
							if (\StaticDatabase\StaticDatabase::settings('happy_hour'))
								$yuklebeni = ($yuklebeni * intval(\StaticDatabase\StaticDatabase::settings('happy_hour_discount')) / 100) + $yuklebeni;
							$yukle =  $this->gdb->query("UPDATE ".ACCOUNT_DB_NAME.".account SET ".CASH." = ".CASH." + $yuklebeni  WHERE id='$kimimben'");
							if($yukle){exit("OK");}else{exit("ep verilemedi");}
						}
						else{echo "log girilemedi";}
					}
					else {echo $post['failed_reason_msg'];}
				}
			}
			else{exit("post yok");}
		}
		
		private function payreksFilter($string)
		{
			$escapes = ["--",";","/*","*/","//","#","||","<","|","&",">","'",")","(","*","\""];
			$filterString = $string;
			foreach ($escapes as $row)
				$filterString = str_replace($row,"",$filterString);
			return $filterString;
		}

		private function payreksHashCreate($type, $data, $key)
		{
			$context = hash_init($type, HASH_HMAC, $key);
			hash_update($context, $data);
			return hash_final($context);
		}
        public function paywantAntiInjection($sql){
            $sql 			= preg_replace(@sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"),"",$sql);
            $sql 			= trim($sql);
            $sql 			= strip_tags($sql);
            $sql 			= addslashes($sql);
            return $sql;
        }
		private function encoderHash($data, $key)
		{
			$context = hash_init("sha256", HASH_HMAC, $key);
			hash_update($context, $data);
			$return = hash_final($context);
			$context2 = hash_init("md5", HASH_HMAC, $key);
			hash_update($context2, $return);
			return hash_final($context2);
		}

		private function curlReq($url,$data)
		{
			$_ch = curl_init($url);
			curl_setopt($_ch, CURLOPT_CUSTOMREQUEST, "POST");
			if (is_array($data))
				curl_setopt($_ch, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($_ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($_ch, CURLOPT_SSL_VERIFYPEER, false);
			$_output = curl_exec($_ch);
			curl_close($_ch);
			return $_output;
		}
		
		private function MaxEpin_Curl($url) 
		{
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Oxoyun-Api: v1'));
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			return $response;
		}
		
		private function curlPost($url, $params){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER , TRUE);
            curl_setopt($ch, CURLOPT_POST , TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                print curl_error($ch);
            } else {
                curl_close($ch);
            }
            return $result;
        }

		private function getIPAddress()	{
			if(getenv("HTTP_CLIENT_IP"))
				$ip = getenv("HTTP_CLIENT_IP");
			else if(getenv("HTTP_X_FORWARDED_FOR")){
				$ip = getenv("HTTP_X_FORWARDED_FOR");
				if (strstr($ip, ',')){
					$tmp = explode (',', $ip); $ip = trim($tmp[0]);
				}}
			else
				$ip = getenv("REMOTE_ADDR");
			return $ip;
		}

        private function full_url()
        {
            $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
            $sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
            $protocol = substr($sp, 0, strpos($sp, "/")) . $s;
            return $protocol . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
        }
        public function generateRandomString($length = 10) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
		public function sanal_pay_post($key, $default_value = false)
		{
			if (!isset($key) || empty($key) || !is_string($key))
				return false;
			$ret = (isset($_POST[$key]) ? $_POST[$key] : $default_value);

			if (is_string($ret) === true)
				$ret = urldecode(preg_replace('/((\%5C0+)|(\%00+))/i', '', urlencode($ret)));
			return !is_string($ret)? $ret : stripslashes($ret);
		}
    }