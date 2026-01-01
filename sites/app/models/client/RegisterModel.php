<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 10.03.2017
     * Time: 13:49
     */
    use Model\IN_Model;

    class RegisterModel extends IN_Model
    {
        public function sample()
        {
        }

        public function aktive()
        {
            Session::init();
            $redirectLogin = Session::get('redirectLogin');
            $getInfo = $this->gdb->select('id,email')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('login' => $redirectLogin))->get()[0];
            $aid = $getInfo['id'];
            $getMail = $getInfo['email'];
            $arg = $this->generateRandomString(6);
            $token = $this->hash->create('md5', $arg . $aid . $redirectLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
            $link = URI::get_path('profile/aktiveresponse/' . $arg . '&token=' . $token);
            $text = "Sayın <b>$redirectLogin</b>, sistemimizden mail aktivasyon isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda mail aktivasyonunuz gerçekleşecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Mail aktivasyonu için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
            $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Mail Aktivasyonu", $getMail, $text);
            $date = date('Y-m-d H:i:s');
            $this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '5'), array('id' => $aid));
        }

        public function login()
        {
            $data = $this->filter->mainFilter($_POST['data']);
            if ($data == false) {
                $result['result'] = false;
            } else {
                $control = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('login' => $data))->count();
                if ($control > 0) {
                    $result['result'] = false;
                } else {
                    $result['result'] = true;
                }
            }
            echo json_encode($result);
        }

        public function control()
        {
            Session::init();
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                date_default_timezone_set('Europe/Istanbul');
                if (!$captchaRes['success']) {
					die(json_encode(["type"=>"danger","message"=>"Recaptcha doğrulaması gerçekleşmedi. Lütfen tekrar deneyiniz.","redirect"=>"".URL."register/index"]));
                }
            }
			if ($recaptcha == 2)
			{
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['h-captcha-response'];
                date_default_timezone_set('Europe/Istanbul');
				$data = array(
					  'secret' => $secret,
					  'response' => $captcha
				  );
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
                if (!$responseData->success) {
					die(json_encode(["type"=>"danger","message"=>"Recaptcha doğrulaması gerçekleşmedi. Lütfen tekrar deneyiniz.","redirect"=>"".URL."register/index"]));
                }
            }
            $login = $this->filter->mainFilter($_POST['login']);
            $password = $this->filter->passwordFilter($_POST['password']);
            $password2 = $this->filter->passwordFilter($_POST['password2']);
            $email = $this->filter->mailFilter($_POST['email']);
            $name = $this->filter->wordFilter($_POST['name']);
            $ksk = $this->filter->numberFilter($_POST['ksk']);
            $phone = $this->filter->numberFilter($_POST['phone']);
			if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1")
            	$findMe = $this->filter->numberFilter($_POST['findme']);
			if (\StaticDatabase\StaticDatabase::systems('pin_durum') == 0) 
			{
				if ($login == false || $password == false || $password2 == false || $email == false || $name == false || $ksk == false) {
					die(json_encode(["type"=>"danger","message"=>"Lütfen bilgilerinizi kontrol edin. Sistem Türkçe Karakterleri Desteklemez.","redirect"=>false]));
				} elseif ($login == '' || $password == '' || $password2 == '' || $email == '' || $name == '' || $ksk == '') {
					die(json_encode(["type"=>"danger","message"=>"Tüm alanları doldurmalısınız.","redirect"=>false]));
				} else {
					$control = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('login' => $login))->count();
					if ($control > 0) {
						die(json_encode(["type"=>"danger","message"=>"Kullanıcı adı kullanımda.","redirect"=>false]));
					} elseif ($password != $password2) {
						die(json_encode(["type"=>"danger","message"=>"Şifreler uyuşmuyor.","redirect"=>false]));
					} elseif (strlen($login) < 6) {
						die(json_encode(["type"=>"danger","message"=>"Kullanıcı adı 6 haneden küçük olamaz.","redirect"=>false]));
					} elseif (strlen($ksk) != 7) {
						die(json_encode(["type"=>"danger","message"=>"Karakter silme kodu 7 haneli olmalıdır.","redirect"=>false]));
					}
					else 
					{
						$now = date("Y-m-d H:i:s");
						$ip = $this->GetIP();
						$this->gdb->sql("INSERT INTO ".ACCOUNT_DB_NAME.".account (login,password,real_name,social_id,email,create_time,phone1,ip,mailaktive) VALUES (?,PASSWORD(?),?,?,?,?,?,?,?)",[$login,$password,$name,$ksk,$email,$now,$phone,$ip,'0']);
			
						//FindMe
						if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1")
						{
							$controlFindMe = $this->db->select('id,total')->table('findme_list')->where(['id'=>$findMe])->get();
							$totalFindMe = intval($controlFindMe[0]["total"]) + 1;
							$this->db->update('findme_list', ['total' => $totalFindMe], ['id' => $findMe]);
						}
						//FindMe
						//Gift
						if (\StaticDatabase\StaticDatabase::settings('register_gift_status') === "1")
						{
							$giftEP = \StaticDatabase\StaticDatabase::settings('register_gift_count');
							$cash = CASH;
							$this->gdb->sql("UPDATE account SET $cash = $cash + $giftEP WHERE login = ?",[$login]);
						}
						//Gift

						//Drop
						if (\StaticDatabase\StaticDatabase::settings('register_drop_status') === "1")
						{
							$dropData = [
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								$login
							];
							$this->gdb->sql("UPDATE account SET gold_expire = ?, silver_expire = ?, safebox_expire = ?,autoloot_expire = ?, fish_mind_expire = ?, marriage_fast_expire = ?, money_drop_rate_expire = ? WHERE login = ?",$dropData);
						}
						//Drop
						Session::set('cError', 'OK');
						die(json_encode(["type"=>"success","message"=>"Kayıt başarıyla tamamlandı.","redirect"=>"".URL."register"]));
					}
				}
			}
			if (\StaticDatabase\StaticDatabase::systems('pin_durum') == 1) 
			{
				$pin = $this->filter->passwordFilter($_POST['pin']);
				if ($login == false || $password == false || $password2 == false || $email == false || $name == false || $ksk == false || $pin == false) {
					die(json_encode(["type"=>"danger","message"=>"Lütfen bilgilerinizi kontrol edin. Sistem Türkçe Karakterleri Desteklemez.","redirect"=>false]));
				} elseif ($login == '' || $password == '' || $password2 == '' || $email == '' || $name == '' || $ksk == '' || $pin == '') {
					die(json_encode(["type"=>"danger","message"=>"Tüm alanları doldurmalısınız.","redirect"=>false]));
				} else {
					$control = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('login' => $login))->count();
					if ($control > 0) {
						die(json_encode(["type"=>"danger","message"=>"Kullanıcı adı kullanımda.","redirect"=>false]));
					} elseif ($password != $password2) {
						die(json_encode(["type"=>"danger","message"=>"Şifreler uyuşmuyor.","redirect"=>false]));
					} elseif (strlen($login) < 6) {
						die(json_encode(["type"=>"danger","message"=>"Kullanıcı adı 6 haneden küçük olamaz.","redirect"=>false]));
					} elseif (strlen($ksk) != 7) {
						die(json_encode(["type"=>"danger","message"=>"Karakter silme kodu 7 haneli olmalıdır.","redirect"=>false]));
					}  elseif (strlen($pin) != \StaticDatabase\StaticDatabase::systems('pin_adet')) {
						die(json_encode(["type"=>"danger","message"=>"Hatalı PIN girdiniz!","redirect"=>false]));
					} 
					else 
					{
						$now = date("Y-m-d H:i:s");
						$ip = $this->GetIP();
						$pinColumn = \StaticDatabase\StaticDatabase::systems('pin_sutun');
						$this->gdb->sql("INSERT INTO ".ACCOUNT_DB_NAME.".account (login,password,real_name,social_id,email,create_time,phone1,ip,mailaktive,$pinColumn) VALUES (?,PASSWORD(?),?,?,?,?,?,?,?,?)",[$login,$password,$name,$ksk,$email,$now,$phone,$ip,'0',$pin]);
						//FindMe
						if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1")
						{
							$controlFindMe = $this->db->select('id,total')->table('findme_list')->where(['id'=>$findMe])->get();
							$totalFindMe = intval($controlFindMe[0]["total"]) + 1;
							$this->db->update('findme_list', ['total' => $totalFindMe], ['id' => $findMe]);
						}
						//FindMe
						//Gift
						if (\StaticDatabase\StaticDatabase::settings('register_gift_status') === "1")
						{
							$giftEP = \StaticDatabase\StaticDatabase::settings('register_gift_count');
							$cash = CASH;
							$this->gdb->sql("UPDATE account SET $cash = $cash + $giftEP WHERE login = ?",[$login]);
						}
						//Gift

						//Drop
						if (\StaticDatabase\StaticDatabase::settings('register_drop_status') === "1")
						{
							$dropData = [
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								date("Y-m-d H:i:s", strtotime("+5 year")),
								$login
							];
							$this->gdb->sql("UPDATE account SET gold_expire = ?, silver_expire = ?, safebox_expire = ?,autoloot_expire = ?, fish_mind_expire = ?, marriage_fast_expire = ?, money_drop_rate_expire = ? WHERE login = ?",$dropData);
						}
						//Drop
						Session::set('cError', 'OK');
						die(json_encode(["type"=>"success","message"=>"Kayıt başarıyla tamamlandı.","redirect"=>"".URL."register"]));
					}
				}
			}
        }

        public function GetIP()
        {
            if (getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            } elseif (getenv("HTTP_X_FORWARDED_FOR")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
                if (strstr($ip, ',')) {
                    $tmp = explode(',', $ip);
                    $ip = trim($tmp[0]);
                }
            } else {
                $ip = getenv("REMOTE_ADDR");
            }
            return $ip;
        }
        public function generateRandomString($length = 10)
        {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
    }