<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 27.02.2017
     * Time: 19:16
     */
    use Model\IN_Model;

    class ProfileModel extends IN_Model
    {
        public function __construct()
        {
            parent::__construct();
            header('Content-Type: text/html; charset=utf-8');
        }
        public function password()
        {
            $aid = Session::get('aid');
            $getBan = $this->gdb->select('status,availDt')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
            $result['status'] = $getBan['status'];
            $result['availDt'] = $getBan['availDt'];
            return $result;
        }

        public function index()
        {
            Session::init();
            $aid = Session::get('aid');
            $getPlayers['account'] = $this->gdb->select('login,email,phone1,'.CASH.','.MILEAGE.',status,availDt')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
            $getPlayers['player'] = $this->gdb->select('name,job,level,playtime,last_play')->table(''.PLAYER_DB_NAME.'.player')->where(array('account_id' => $aid))->get();
            $getPlayers['aktivasyon'] = $this->gdb->select('mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
            $availDt = strtotime($getPlayers['account']['availDt']);
            $status = $getPlayers['account']['status'];
            $now = time();
            if ($status == 'BLOCK' || $availDt > $now) {
                $getPlayers['ban'] = $this->db->select('why,evidence')->table('ban_list')->where(array('account_id' => $aid))->get()[0];
            }
            return $getPlayers;
        }

        public function paywantAntiInjection($sql)
        {
            $sql = preg_replace(@sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/"), "", $sql);
            $sql = trim($sql);
            $sql = strip_tags($sql);
            $sql = addslashes($sql);
            return $sql;
        }

        public function passwordchange()
        {
           $reCaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
		   if ($reCaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    die(json_encode(["type"=>"danger","message"=>"Recaptcha doğrulaması gerçekleşmedi. Lütfen tekrar deneyiniz.","redirect"=>"".URL."profile/password"]));
                }
            }
			if ($reCaptcha == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
                    die(json_encode(["type"=>"danger","message"=>"Recaptcha doğrulaması gerçekleşmedi. Lütfen tekrar deneyiniz.","redirect"=>"".URL."profile/password"]));
				}
			}
            $oldPassword = $this->filter->passwordFilter($_POST['oldpassword']);
            $newPassword = $this->filter->passwordFilter($_POST['newpassword']);
            $newPassword2 = $this->filter->passwordFilter($_POST['newpassword2']);
            if ($oldPassword == false || $newPassword == false || $newPassword2 == false) {
                die(json_encode(["type"=>"danger","message"=>"Hatalı şifre girdiniz. Lütfen tekrar deneyiniz.","redirect"=>false]));
            } elseif ($oldPassword == "" || $newPassword == "" || $newPassword2 == "") {
                die(json_encode(["type"=>"danger","message"=>"Hatalı şifre girdiniz. Lütfen tekrar deneyiniz.","redirect"=>false]));
            } else {
                if ($newPassword != $newPassword2) {
					die(json_encode(["type"=>"danger","message"=>"Şifreler birbirleriyle uyuşmuyor. Lütfen tekrar deneyiniz.","redirect"=>false]));
                } elseif (strlen($newPassword) <= 6) {
					die(json_encode(["type"=>"danger","message"=>"7 Haneden küçük şifre giremezsiniz. Lütfen tekrar deneyiniz.","redirect"=>false]));
                } elseif (strlen($newPassword) > 16) {
					die(json_encode(["type"=>"danger","message"=>"16 Haneden büyük şifre giremezsiniz. Lütfen tekrar deneyiniz.","redirect"=>false]));
                } elseif ($oldPassword == $newPassword) {
					die(json_encode(["type"=>"danger","message"=>"Mevcut şifre ile yeni şifre aynı. Lütfen tekrar deneyiniz.","redirect"=>false]));
                } else {
                    $aid = Session::get('aid');
                    $getPassword = $this->gdb->sql("SELECT id FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$oldPassword]);
                    if (count($getPassword) <= 0) {
						die(json_encode(["type"=>"danger","message"=>"Mevcut şifre ile yeni şifre aynı. Lütfen tekrar deneyiniz.","redirect"=>false]));
                    } else {
                        $this->gdb->sql("UPDATE account SET password = PASSWORD(?) WHERE id = ?",[$newPassword,$aid]);
                        $this->log->set('player', '2', "$oldPassword şifresini $newPassword olarak güncelledi");
						die(json_encode(["type"=>"success","message"=>"Şifreniz başarıyla değiştirildi.","redirect"=>"".URL."profile/password"]));
                    }
                }
            }
        }

        public function emailchange()
        {
            if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('profile/email');
                    exit;
                }
            }
			if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/email');
					exit;
				}
			}
            $aid = Session::get('aid');
            $getAktive = $this->gdb->select('mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0]['mailaktive'];
            if ($getAktive == 1) {
                Session::set('cError', 'error');
                URI::redirect('profile/email');
            }

            $password = $this->filter->passwordFilter($_POST['password']);
            $newmail = $this->filter->mailFilter($_POST['newmail']);
            $newmail2 = $this->filter->mailFilter($_POST['newmail2']);
            if ($newmail == false || $newmail2 == false) {
                Session::set('cError', 'filter');
                URI::redirect('profile/email');
            } elseif ($password == "" || $newmail == "" || $newmail2 == "") {
                Session::set('cError', 'empty');
                URI::redirect('profile/email');
            } else {
                if ($newmail != $newmail2) {
                    Session::set('cError', 'wrong');
                    URI::redirect('profile/email');
                } elseif (strlen($newmail) <= 6) {
                    Session::set('cError', 'length');
                    URI::redirect('profile/email');
                } elseif (strlen($newmail) > 50) {
                    Session::set('cError', 'length2');
                    URI::redirect('profile/email');
                } else {
                    $getPassword = $this->gdb->sql("SELECT id,email FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
                    if (count($getPassword) <= 0) {
                        Session::set('cError', 'error');
                        URI::redirect('profile/email');
                    } else {
						$oldMail = $getPassword[0]['email'];
                        $this->gdb->update('account', array('email' => $newmail), array('id' => $aid));
                        $this->log->set('player', '3', "$oldMail mail adresini $newmail adresiyle güncelledi");
                        Session::set('cError', 'OK');
                        URI::redirect('profile/email');
                    }
                }
            }
        }

        public function emailchange3()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('profile/email');
                    exit;
                }
            }
			if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/email');
					exit;
				}
			}
            $aid = Session::get('aid');
            $getAktive = $this->gdb->select('mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0]['mailaktive'];
            if ($getAktive != 1) {
                Session::set('cError', 'error');
                URI::redirect('profile/email');
            }
            $password = $this->filter->passwordFilter($_POST['password']);
            $newmail = $this->filter->mailFilter($_POST['newmail']);
            $newmail2 = $this->filter->mailFilter($_POST['newmail2']);
            if ($newmail == false || $newmail2 == false) {
                Session::set('cError', 'filter');
                URI::redirect('profile/email');
            } elseif ($password == "" || $newmail == "" || $newmail2 == "") {
                Session::set('cError', 'empty');
                URI::redirect('profile/email');
            } else {
                if ($newmail != $newmail2) {
                    Session::set('cError', 'wrong');
                    URI::redirect('profile/email');
                } elseif (strlen($newmail) <= 6) {
                    Session::set('cError', 'length');
                    URI::redirect('profile/email');
                } elseif (strlen($newmail) > 50) {
                    Session::set('cError', 'length2');
                    URI::redirect('profile/email');
                } else {
					$getPassword = $this->gdb->sql("SELECT id,email FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
                    if (count($getPassword) <= 0) {
                        Session::set('cError', 'error');
                        URI::redirect('profile/email');
                    } else {
						$oldMail = $getPassword[0]['email'];
                        $this->gdb->update('account', array('email' => $newmail), array('id' => $aid));
                        $this->log->set('player', '5', "$oldMail mail adresini $newmail adresiyle güncelledi");
                        Session::set('cError', 'OK3');
                        URI::redirect('profile/email');
                    }
                }
            }
        }


        public function depochange()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('profile/depo');
                    exit;
                }
            }
			if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/depo');
					exit;
				}
			}
            date_default_timezone_set('Asia/Bahrain');
            $password = $this->filter->passwordFilter($_POST['password']);
            if ($password == false) {
                Session::set('cError', 'filter');
                URI::redirect('profile/depo');
            } else {
                $aid = Session::get('aid');
                $cLogin = Session::get('cLogin');
				$getPassword = $this->gdb->sql("SELECT id,email,t_status,t_date FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
                if (count($getPassword) <= 0) {
                    Session::set('cError', 'error');
                    URI::redirect('profile/depo');
                } else {
                    $getinfo = $getPassword[0];
                    $tDate = $getinfo['t_date'];
                    $now = date('Y-m-d H:i:s', strtotime('-10 minutes'));
                    $residual = $this->minute($tDate);
                    if ($now <= $tDate) {
                        Session::set('residual', $residual);
                        Session::set('cError', 'time');
                        URI::redirect('profile/depo');
                    } else {
                        $getMail = $getinfo['email'];
                        $arg = $this->generateRandomString(6);
                        $token = $this->hash->create('md5', $arg . $aid . $cLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
                        $link = URI::get_path('profile/deporesponse/' . $arg . '&token=' . $token);
                        $text = "Sayın <b>$cLogin</b>, sistemimizden depo şifresi isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda yeni depo şifreniz belirlenecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Depo şifrenizi değiştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                        $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Depo Şifresi Değişikliği", $getMail, $text);
                        $date = date('Y-m-d H:i:s');
                        $this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '1'), array('id' => $aid));
                        $this->log->set('player', '6', "depo şifresi değişikliği için $getMail adresine mail gönderildi");
                        Session::set('cError', 'OK');
                        URI::redirect('profile/depo');
                    }
                }
            }
        }

        public function deporesponse($arg)
        {
            Session::init();
            $arg2 = $this->filter->numberFilter($arg);
            if ($arg2 == false) {
                $result['result'] = false;
            } else {
                $aid = Session::get('aid');
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $getTokenSe = $this->gdb->select('t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid, 't_status' => '1', 't_key' => $arg2));
                if ($getTokenSe->count() <= 0) {
                    $result['result'] = false;
                } else {
                    $getTokenS = $getTokenSe->get()[0];
                    $getToken = isset($getTokenS['t_token']) ? $getTokenS['t_token'] : null;
                    $depo = $this->generateRandomString(6);
                    if ($token != $getToken) {
                        $result['result'] = false;
                    } else {
                        $tType = $getTokenS['t_type'];
                        if ($tType != 1) {
                            $result['result'] = false;
                        } else {
                            $control = $this->gdb->select('account_id')->table(''.PLAYER_DB_NAME.'.safebox')->where(array('account_id' => $aid))->count();
                            if ($control <= 0) {
                                $this->gdb->insert(''.PLAYER_DB_NAME.'.safebox', array('account_id' => $aid, 'size' => '5', 'password' => $depo, 'gold' => '0'));
                            } else {
                                $this->gdb->update(''.PLAYER_DB_NAME.'.safebox', array('password' => $depo), array('account_id' => $aid));
                            }
                            $this->gdb->update('account', array('t_status' => '0', 't_key' => '0', 't_token' => '0', 't_type' => '0'), array('id' => $aid));
                            $this->log->set('player', '7', "depo şifresi $depo olarak güncellendi");
                            $result['result'] = true;
                            $result['data'] = $depo;
                            return $result;
                        }
                    }
                }
            }
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

        public function kskchange()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('profile/ksk');
                    exit;
                }
            }
			if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/ksk');
					exit;
				}
			}
            date_default_timezone_set('Asia/Bahrain');
            $password = $this->filter->passwordFilter($_POST['password']);
            if ($password == false) {
                Session::set('cError', 'filter');
                URI::redirect('profile/ksk');
            } else {
                $aid = Session::get('aid');
                $cLogin = Session::get('cLogin');
				$getPassword = $this->gdb->sql("SELECT id,email,t_date FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
                if (count($getPassword) <= 0) {
                    Session::set('cError', 'error');
                    URI::redirect('profile/ksk');
                } else {
                    $getinfo = $getPassword[0];
                    $tDate = $getinfo['t_date'];
                    $now = date('Y-m-d H:i:s', strtotime('-10 minutes'));
                    $residual = $this->minute($tDate);
                    if ($now <= $tDate) {
                        Session::set('residual', $residual);
                        Session::set('cError', 'time');
                        URI::redirect('profile/ksk');
                    } else {
                        $getMail = $getinfo['email'];
                        $arg = $this->generateRandomString(6);
                        $token = $this->hash->create('md5', $arg . $aid . $cLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
                        $link = URI::get_path('profile/kskresponse/' . $arg . '&token=' . $token);
                        $text = "Sayın <b>$cLogin</b>, sistemimizden karakter silme şifresi isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda yeni karakter silme şifreniz belirlenecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Karakter silme şifrenizi değiştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                        $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Karakter Silme Şifresi Değişikliği", $getMail, $text);
                        $date = date('Y-m-d H:i:s');
                        $this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '2'), array('id' => $aid));
                        $this->log->set('player', '8', "karakter silme için $getMail adresine mail gönderildi");
                        Session::set('cError', 'OK');
                        URI::redirect('profile/ksk');
                    }
                }
            }
        }

        public function kskresponse($arg)
        {
            Session::init();
            $arg2 = $this->filter->numberFilter($arg);
            if ($arg2 == false) {
                $result['result'] = false;
            } else {
                $aid = Session::get('aid');
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $getTokenSe = $this->gdb->select('t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid, 't_status' => '1', 't_key' => $arg2));
                if ($getTokenSe->count() <= 0) {
                    $result['result'] = false;
                } else {
                    $getTokenS = $getTokenSe->get()[0];
                    $getToken = isset($getTokenS['t_token']) ? $getTokenS['t_token'] : null;
                    if ($token != $getToken) {
                        $result['result'] = false;
                    } else {
                        $tType = $getTokenS['t_type'];
                        if ($tType != 2) {
                            $result['result'] = false;
                        } else {
                            $ksk = $this->generateRandomString(7);
                            $this->gdb->update('account', array('social_id' => $ksk), array('id' => $aid));
                            $this->gdb->update('account', array('t_status' => '0', 't_key' => '0', 't_token' => '0', 't_type' => '0'), array('id' => $aid));
                            $this->log->set('player', '9', "karakter silme kodu $ksk olarak güncellendi");
                            $result['result'] = true;
                            $result['data'] = $ksk;
                            return $result;
                        }
                    }
                }
            }
        }

        public function bug()
        {
            Session::init();
            $aid = Session::get('aid');
            $getPlayer = $this->gdb->select('id,name,map_index,job')->table(''.PLAYER_DB_NAME.'.player')->where(array('account_id' => $aid))->get();
            return $getPlayer;
        }

        public function saved($arg)
        {
//            Session::init();
//            $aid = Session::get('aid');
//            $control = $this->gdb->select('account_id')->table(''.PLAYER_DB_NAME.'.player')->where(array('account_id' => $aid, 'id' => $arg))->count();
//            if ($control <= 0) {
//                $result['result'] = false;
//            } else {
//                $result['result'] = true;
//                $this->gdb->update(''.PLAYER_DB_NAME.'.player', array('exit_x' => '876288', 'exit_y' => '250466', 'exit_map_index' => '43', 'x' => '876288', 'y' => '250466', 'map_index' => '43'), array('id' => $arg));
//                $this->log->set('player', '16', "$arg id'li karakteri bugdan kurtarıldı");
//            }
            $result['result'] = true;
            return $result;
        }

        public function kgschange()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('profile/kgs');
                    exit;
                }
            }
			if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/kgs');
					exit;
				}
			}
            date_default_timezone_set('Asia/Bahrain');
            $password = $this->filter->passwordFilter($_POST['password']);
            if ($password == false) {
                Session::set('cError', 'filter');
                URI::redirect('profile/kgs');
            } else {
                $aid = Session::get('aid');
                $cLogin = Session::get('cLogin');
				$getPassword = $this->gdb->sql("SELECT id,email,t_date FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
				if (count($getPassword) <= 0) {
                    Session::set('cError', 'error');
                    URI::redirect('profile/kgs');
                } else {
                    $getinfo = $getPassword[0];
                    $tDate = $getinfo['t_date'];
                    $now = date('Y-m-d H:i:s', strtotime('-10 minutes'));
                    $residual = $this->minute($tDate);
                    if ($now <= $tDate) {
                        Session::set('residual', $residual);
                        Session::set('cError', 'time');
                        URI::redirect('profile/kgs');
                    } else {
                        $getMail = $getinfo['email'];
                        $arg = $this->generateRandomString(8);
                        $token = $this->hash->create('md5', $arg . $aid . $cLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
                        $link = URI::get_path('profile/kgsresponse/' . $arg . '&token=' . $token);
                        $text = "Sayın <b>$cLogin</b>, sistemimizden karakter güvenlik şifresi isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda yeni karakter güvenliksilme şifreniz belirlenecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Karakter güvenlik şifrenizi değiştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                        $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Karakter Güvenlik Şifresi Değişikliği", $getMail, $text);
                        $date = date('Y-m-d H:i:s');
                        $this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '3'), array('id' => $aid));
                        Session::set('cError', 'OK');
                        URI::redirect('profile/kgs');
                    }
                }
            }
        }

        public function kgsresponse($arg)
        {
            Session::init();
            $arg2 = $this->filter->numberFilter($arg);
            if ($arg2 == false) {
                $result['result'] = false;
            } else {
                $aid = Session::get('aid');
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $getTokenSe = $this->gdb->select('t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid, 't_status' => '1', 't_key' => $arg2));
                if ($getTokenSe->count() <= 0) {
                    $result['result'] = false;
                } else {
                    $getTokenS = $getTokenSe->get()[0];
                    $getToken = isset($getTokenS['t_token']) ? $getTokenS['t_token'] : null;
                    if ($token != $getToken) {
                        $result['result'] = false;
                    } else {
                        $tType = $getTokenS['t_type'];
                        if ($tType != 3) {
                            $result['result'] = false;
                        } else {
                            $kgs = $this->generateRandomString(6);
                            $sth = $this->gdb->select('login,email')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
                            $login = $sth['login'];
                            $email = $sth['email'];
                            $this->gdb->update('account', array(''.PLAYERLOCKTABLE.'' => $kgs), array('id' => $aid));
                            $this->gdb->update('account', array('t_status' => '0', 't_key' => '0', 't_token' => '0', 't_type' => '0'), array('id' => $aid));
                            $text = "Sayın <b>$login</b>, karakter güvenlik şifreniz başarıyla değiştirilmiştir. <br>  <b>NOT : Lütfen karakter güvenlik şifrenizi kimseyle paylaşmayınız. Unutmayın hiçbir yönetici sizden şifrenizi istemez.</b><br><br><br><a href='javascript:void(0);'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b> $kgs </b></button></a><br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                            $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yeni Karakter Güvenlik Şifreniz", $email, $text);
                            $result['result'] = true;
                            $result['data'] = $kgs;
                            return $result;
                        }
                    }
                }
            }
        }

        public function aktivechange()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('profile/aktive');
                    exit;
                }
            }
			if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/aktive');
					exit;
				}
			}
            date_default_timezone_set('Asia/Bahrain');
            $password = $this->filter->passwordFilter($_POST['password']);
            if ($password == false) {
                Session::set('cError', 'filter');
                URI::redirect('profile/aktive');
            } else {
                $aid = Session::get('aid');
                $cLogin = Session::get('cLogin');
				$getPassword = $this->gdb->sql("SELECT id,email,t_date FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
				if (count($getPassword) <= 0) {
                    Session::set('cError', 'error');
                    URI::redirect('profile/aktive');
                } else {
                    $getinfo = $getPassword[0];
                    $tDate = $getinfo['t_date'];
                    $now = date('Y-m-d H:i:s', strtotime('-10 minutes'));
                    $residual = $this->minute($tDate);
                    if ($now <= $tDate) {
                        Session::set('residual', $residual);
                        Session::set('cError', 'time');
                        URI::redirect('profile/aktive');
                    } else {
                        $getMail = $getinfo['email'];
                        $arg = $this->generateRandomString(6);
                        $token = $this->hash->create('md5', $arg . $aid . $cLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
                        $link = URI::get_path('profile/aktiveresponse/' . $arg . '&token=' . $token);
                        $text = "Sayın <b>$cLogin</b>, sistemimizden mail aktivasyon isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda mail aktivasyonunuz gerçekleşecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Mail aktivasyonu için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                        $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Mail Aktivasyonu", $getMail, $text);
                        $date = date('Y-m-d H:i:s');
                        $this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '5'), array('id' => $aid));
                        $this->log->set('player', '14', "mail aktivasyonu için $getMail adresine mail gönderildi");
                        Session::set('cError', 'OK');
                        URI::redirect('profile/aktive');
                    }
                }
            }
        }

        public function aktiveresponse($arg)
        {
            Session::init();
            $arg2 = $this->filter->numberFilter($arg);
            if ($arg2 == false) {
                $result['result'] = false;
            } else {
                $aid = Session::get('aid');
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $getTokenSe = $this->gdb->select('t_status,t_key,t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid, 't_status' => '1', 't_key' => $arg2))->get()[0];
                if (count($getTokenSe) <= 0) {
                    $result['result'] = false;
                } else {
                    $getToken = isset($getTokenSe['t_token']) ? $getTokenSe['t_token'] : null;
                    if ($token != $getToken) {
                        $result['result'] = false;
                    } else {
                        $tType = $getTokenSe['t_type'];
                        if ($tType != 5) {
                            $result['result'] = false;
                        } else {
                            $this->gdb->update('account', array('t_status' => '0', 't_key' => '0', 't_token' => '0', 't_type' => '0', 'mailaktive' => '1'), array('id' => $aid));
                            $this->log->set('player', '15', "mail aktivasyonu gerçekleştirildi");
                            $result['result'] = true;
                            return $result;
                        }
                    }
                }
            }
        }

        public function minute($time)
        {
            $onceBol = explode(" ", $time);
            $sds = explode(":", $onceBol[1]);
            return $sds[1];
        }

        public function aktive()
        {
            Session::init();
            $aid = Session::get('aid');
            return $this->gdb->select('mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0]['mailaktive'];
        }

        public function depo()
        {
            Session::init();
            $aid = Session::get('aid');
            return $this->gdb->select('status,availDt,mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];

        }

        public function ksk()
        {
            Session::init();
            $aid = Session::get('aid');
            return $this->gdb->select('status,availDt,mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
        }

        public function kgs()
        {
            Session::init();
            $aid = Session::get('aid');
            return $this->gdb->select('mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0]['mailaktive'];
        }

        public function email()
        {
            Session::init();
            $aid = Session::get('aid');
            return $this->gdb->select('status,availDt,mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
        }

        public function iks()
        {
            Session::init();
            $aid = Session::get('aid');
            return $this->gdb->select('mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0]['mailaktive'];
        }
		
		public function pin()
        {
            Session::init();
            $aid = Session::get('aid');
            return $this->gdb->select('mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0]['mailaktive'];
        }
		
		public function gpc()
        {
            Session::init();
            $aid = Session::get('aid');
            return $this->gdb->select('status,availDt,mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
        }
		
		public function hgs()
        {
            Session::init();
            $aid = Session::get('aid');
            return $this->gdb->select('status,availDt,mailaktive')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
        }

        public function emailchange2()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('profile/email');
                    exit;
                }
            }
			if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/email');
					exit;
				}
			}
            date_default_timezone_set('Asia/Bahrain');
            $password = $this->filter->passwordFilter($_POST['password']);
            if ($password == false) {
                Session::set('cError', 'filter');
                URI::redirect('profile/email');
            } else {
                $aid = Session::get('aid');
                $cLogin = Session::get('cLogin');
				$getPassword = $this->gdb->sql("SELECT id,email,t_date FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
				if (count($getPassword) <= 0) {
					Session::set('cError', 'error');
					URI::redirect('profile/aktive');
				} else {
					$getinfo = $getPassword[0];
                    $tDate = $getinfo['t_date'];
                    $now = date('Y-m-d H:i:s', strtotime('-10 minutes'));
                    $residual = $this->minute($tDate);
                    if ($now <= $tDate) {
                        Session::set('residual', $residual);
                        Session::set('cError', 'time');
                        URI::redirect('profile/email');
                    } else {
                        $getMail = $getinfo['email'];
                        $arg = $this->generateRandomString(8);
                        $token = $this->hash->create('md5', $arg . $aid . $cLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
                        $link = URI::get_path('profile/emailresponse/' . $arg . '&token=' . $token);
                        $text = "Sayın <b>$cLogin</b>, sistemimizden mail adresi değiştirme isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda yeni mail adresinizi girmeniz istenecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Mail adresinizi değiştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                        $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Mail Adresi Değişikliği", $getMail, $text);
                        $date = date('Y-m-d H:i:s');
                        $this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '6'), array('id' => $aid));
                        $this->log->set('player', '4', "mail adresi değişikliği için $getMail adresine mail gönderildi");
                        Session::set('cError', 'OK');
                        URI::redirect('profile/email');
                    }
                }
            }
        }

        public function emailresponse($arg)
        {
            Session::init();
            $arg2 = $this->filter->numberFilter($arg);
            if ($arg2 == false) {
                $result['result'] = false;
            } else {
                $aid = Session::get('aid');
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $getTokenSe = $this->gdb->select('t_status,t_key,t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid, 't_status' => '1', 't_key' => $arg2))->get()[0];
                if (count($getTokenSe) <= 0) {
                    $result['result'] = false;
                } else {
                    $getToken = isset($getTokenSe['t_token']) ? $getTokenSe['t_token'] : null;
                    if ($token != $getToken) {
                        $result['result'] = false;
                    } else {
                        $tType = $getTokenSe['t_type'];
                        if ($tType != 6) {
                            $result['result'] = false;
                        } else {
                            $this->gdb->update('account', array('t_status' => '0', 't_key' => '0', 't_token' => '0', 't_type' => '0'), array('id' => $aid));
                            $result['result'] = true;
                            return $result;
                        }
                    }
                }
            }
        }

        public function ikschange()
		{
			$recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
			if ($recaptcha == 1) 
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['g-recaptcha-response'];
				$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
				$captchaRes = json_decode($rsp, true);
				if (!$captchaRes['success']) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/iks');
					exit;
				}
			}
			if ($recaptcha == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) 
				{
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/iks');
					exit;
				}
			}
			date_default_timezone_set('Asia/Bahrain');
			$password = $this->filter->passwordFilter($_POST['password']);
			if ($password == false) {
				Session::set('cError', 'filter');
				URI::redirect('profile/iks');
				} 
				else 
				{
					$aid = Session::get('aid');
					$cLogin = Session::get('cLogin');
					$getPassword = $this->gdb->sql("SELECT id,email,t_date FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
					if (count($getPassword) <= 0) {
						Session::set('cError', 'error');
						URI::redirect('profile/aktive');
						} 
						else 
						{
							$getinfo = $getPassword[0];
							$tDate = $getinfo['t_date'];
							$now = date('Y-m-d H:i:s', strtotime('-10 minutes'));
							$residual = $this->minute($tDate);
							if ($now <= $tDate) {
								Session::set('residual', $residual);
								Session::set('cError', 'time');
								URI::redirect('profile/iks');
								} 
								else 
								{
									$getMail = $getinfo['email'];
									$arg = $this->generateRandomString(8);
									$token = $this->hash->create('md5', $arg . $aid . $cLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
									$link = URI::get_path('profile/iksresponse/' . $arg . '&token=' . $token);
									$text = "Sayın <b>$cLogin</b>, sistemimizden item kilitleme şifresi isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda yeni karakter item kilitleme şifreniz belirlenecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>İtem Kilitleme şifrenizi değiştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
									$this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " İtem Kilitleme Şifresi Değişikliği", $getMail, $text);
									$date = date('Y-m-d H:i:s');
									$this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '7'), array('id' => $aid));
									Session::set('cError', 'OK');
									URI::redirect('profile/iks');
								}
						}
				}
		}

        public function iksresponse($arg)
        {
            Session::init();
            $arg2 = $this->filter->numberFilter($arg);
            if ($arg2 == false) {
                $result['result'] = false;
            } else {
                $aid = Session::get('aid');
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $getTokenSe = $this->gdb->select('t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid, 't_status' => '1', 't_key' => $arg2));
                if ($getTokenSe->count() <= 0) {
                    $result['result'] = false;
                } else {
                    $getTokenS = $getTokenSe->get()[0];
                    $getToken = isset($getTokenS['t_token']) ? $getTokenS['t_token'] : null;
                    if ($token != $getToken) {
                        $result['result'] = false;
                    } else {
                        $tType = $getTokenS['t_type'];
                        if ($tType != 7) {
                            $result['result'] = false;
                        } else {
                            $kgs = $this->generateRandomString(4);
                            $sth = $this->gdb->select('login,email')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
                            $login = $sth['login'];
                            $email = $sth['email'];
                            $this->gdb->update('account', array(''.ITEMLOCKTABLE.'' => $kgs, 't_status' => '0', 't_key' => '0', 't_token' => '0', 't_type' => '0'), array('id' => $aid));
                            $text = "Sayın <b>$login</b>, item kilitleme şifreniz başarıyla değiştirilmiştir. <br>  <b>NOT : Lütfen item kilitleme şifrenizi kimseyle paylaşmayınız. Unutmayın hiçbir yönetici sizden şifrenizi istemez.</b><br><br><br><a href='javascript:void(0);'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b> $kgs </b></button></a><br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                            $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yeni İtem Kilitleme Şifreniz", $email, $text);
                            $result['result'] = true;
                            $result['data'] = $kgs;
                            return $result;
                        }
                    }
                }
            }
        }
		
		public function pinchange()
		{
			$recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
			if ($recaptcha == 1) 
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['g-recaptcha-response'];
				$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
				$captchaRes = json_decode($rsp, true);
				if (!$captchaRes['success']) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/pin');
					exit;
				}
			}
			if ($recaptcha == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) 
				{
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/pin');
					exit;
				}
			}
			date_default_timezone_set('Asia/Bahrain');
			$password = $this->filter->passwordFilter($_POST['password']);
			if ($password == false) {
				Session::set('cError', 'filter');
				URI::redirect('profile/pin');
				} 
				else 
				{
					$aid = Session::get('aid');
					$cLogin = Session::get('cLogin');
					$getPassword = $this->gdb->sql("SELECT id,email,t_date FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
					if (count($getPassword) <= 0) {
						Session::set('cError', 'error');
						URI::redirect('profile/aktive');
						} 
						else 
						{
							$getinfo = $getPassword[0];
							$tDate = $getinfo['t_date'];
							$now = date('Y-m-d H:i:s', strtotime('-10 minutes'));
							$residual = $this->minute($tDate);
							if ($now <= $tDate) {
								Session::set('residual', $residual);
								Session::set('cError', 'time');
								URI::redirect('profile/pin');
								} 
								else 
								{
									$getMail = $getinfo['email'];
									$arg = $this->generateRandomString(8);
									$token = $this->hash->create('md5', $arg . $aid . $cLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
									$link = URI::get_path('profile/pinresponse/' . $arg . '&token=' . $token);
									$text = "Sayın <b>$cLogin</b>, sistemimizden pin kodu isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda yeni pin kodunuz belirlenecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>İtem Kilitleme şifrenizi değiştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
									$this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Pin Kodu Değişikliği", $getMail, $text);
									$date = date('Y-m-d H:i:s');
									$this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '7'), array('id' => $aid));
									Session::set('cError', 'OK');
									URI::redirect('profile/pin');
								}
						}
				}
		}

        public function pinresponse($arg)
        {
            Session::init();
            $arg2 = $this->filter->numberFilter($arg);
            if ($arg2 == false) {
                $result['result'] = false;
            } else {
                $aid = Session::get('aid');
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $getTokenSe = $this->gdb->select('t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid, 't_status' => '1', 't_key' => $arg2));
                if ($getTokenSe->count() <= 0) {
                    $result['result'] = false;
                } else {
                    $getTokenS = $getTokenSe->get()[0];
                    $getToken = isset($getTokenS['t_token']) ? $getTokenS['t_token'] : null;
                    if ($token != $getToken) {
                        $result['result'] = false;
                    } else {
                        $tType = $getTokenS['t_type'];
                        if ($tType != 7) {
                            $result['result'] = false;
                        } else {
                            $kgs = $this->generateRandomString(\StaticDatabase\StaticDatabase::systems('pin_adet'));
                            $sth = $this->gdb->select('login,email')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
                            $login = $sth['login'];
                            $email = $sth['email'];
                            $this->gdb->update('account', array(''.PINTABLE.'' => $kgs, 't_status' => '0', 't_key' => '0', 't_token' => '0', 't_type' => '0'), array('id' => $aid));
                            $text = "Sayın <b>$login</b>, pin kodunuz başarıyla değiştirilmiştir. <br>  <b>NOT : Lütfen pin kodunuzu kimseyle paylaşmayınız. Unutmayın hiçbir yönetici sizden şifrenizi istemez.</b><br><br><br><a href='javascript:void(0);'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b> $kgs </b></button></a><br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                            $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yeni İtem Kilitleme Şifreniz", $email, $text);
                            $result['result'] = true;
                            $result['data'] = $kgs;
                            return $result;
                        }
                    }
                }
            }
        }
		
		public function gpcchange()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('profile/gpc');
                    exit;
                }
            }
			if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/gpc');
					exit;
				}
			}
            date_default_timezone_set('Asia/Bahrain');
            $password = $this->filter->passwordFilter($_POST['password']);
            if ($password == false) {
                Session::set('cError', 'filter');
                URI::redirect('profile/gpc');
            } else {
                $aid = Session::get('aid');
                $cLogin = Session::get('cLogin');
				$getPassword = $this->gdb->sql("SELECT id,email,t_date FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
                if (count($getPassword) <= 0) {
                    Session::set('cError', 'error');
                    URI::redirect('profile/gpc');
                } else {
                    $getinfo = $getPassword[0];
                    $tDate = $getinfo['t_date'];
                    $now = date('Y-m-d H:i:s', strtotime('-10 minutes'));
                    $residual = $this->minute($tDate);
                    if ($now <= $tDate) {
                        Session::set('residual', $residual);
                        Session::set('cError', 'time');
                        URI::redirect('profile/gpc');
                    } else {
                        $getMail = $getinfo['email'];
                        $arg = $this->generateRandomString(6);
                        $token = $this->hash->create('md5', $arg . $aid . $cLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
                        $link = URI::get_path('profile/gpcresponse/' . $arg . '&token=' . $token);
                        $text = "Sayın <b>$cLogin</b>, sistemimizden güvenli bilgisayar pasifleştirme isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda güvenli bilgisayar durumunuz pasifleştirilecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Güvenli Bilgisayar pasifleştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                        $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Güvenli Bilgisayar Pasifleştirme İsteği", $getMail, $text);
                        $date = date('Y-m-d H:i:s');
                        $this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '2'), array('id' => $aid));
                        $this->log->set('player', '8', "güvenli bilgisayar için $getMail adresine mail gönderildi");
                        Session::set('cError', 'OK');
                        URI::redirect('profile/gpc');
                    }
                }
            }
        }

        public function gpcresponse($arg)
        {
            Session::init();
            $arg2 = $this->filter->numberFilter($arg);
            if ($arg2 == false) {
                $result['result'] = false;
            } else {
                $aid = Session::get('aid');
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $getTokenSe = $this->gdb->select('t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid, 't_status' => '1', 't_key' => $arg2));
                if ($getTokenSe->count() <= 0) {
                    $result['result'] = false;
                } else {
                    $getTokenS = $getTokenSe->get()[0];
                    $getToken = isset($getTokenS['t_token']) ? $getTokenS['t_token'] : null;
                    if ($token != $getToken) {
                        $result['result'] = false;
                    } else {
                        $tType = $getTokenS['t_type'];
                        if ($tType != 2) {
                            $result['result'] = false;
                        } else {
                            $gpc = "0";
							$sth = $this->gdb->select('login')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid))->get()[0];
                            $login = $sth['login'];
                            $this->gdb->update(''.SECURITYPCTABLE1.'', array('acik' => $gpc), array('login' => $login));
                            $this->gdb->update('account', array('t_status' => '0', 't_key' => '0', 't_token' => '0', 't_type' => '0'), array('id' => $aid));
                            $this->log->set('player', '9', "güvenli bilgisayar durumu pasif olarak güncellendi");
                            $result['result'] = true;
                            $result['data'] = $gpc;
                            return $result;
                        }
                    }
                }
            }
        }
		
		public function hgschange()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1) {
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('profile/hgs');
                    exit;
                }
            }
			if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2)
			{
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = $_POST['h-captcha-response'];
				date_default_timezone_set('Europe/Istanbul');
				$data = array('secret' => $secret,'response' => $captcha);
				$verify = curl_init();
				curl_setopt($verify, CURLOPT_URL,   "https://hcaptcha.com/siteverify");
				curl_setopt($verify, CURLOPT_POST, true);
				curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
				curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
				$verifyResponse = curl_exec($verify);
				$responseData = json_decode($verifyResponse);
				if (!$responseData->success) {
					Session::set('cError', 'recaptcha');
					URI::redirect('profile/hgs');
					exit;
				}
			}
            date_default_timezone_set('Asia/Bahrain');
            $password = $this->filter->passwordFilter($_POST['password']);
            if ($password == false) {
                Session::set('cError', 'filter');
                URI::redirect('profile/hgs');
            } else {
                $aid = Session::get('aid');
                $cLogin = Session::get('cLogin');
				$getPassword = $this->gdb->sql("SELECT id,email,t_date FROM account WHERE id = ? AND password = PASSWORD(?)",[$aid,$password]);
                if (count($getPassword) <= 0) {
                    Session::set('cError', 'error');
                    URI::redirect('profile/hgs');
                } else {
                    $getinfo = $getPassword[0];
                    $tDate = $getinfo['t_date'];
                    $now = date('Y-m-d H:i:s', strtotime('-10 minutes'));
                    $residual = $this->minute($tDate);
                    if ($now <= $tDate) {
                        Session::set('residual', $residual);
                        Session::set('cError', 'time');
                        URI::redirect('profile/hgs');
                    } else {
                        $getMail = $getinfo['email'];
                        $arg = $this->generateRandomString(6);
                        $token = $this->hash->create('md5', $arg . $aid . $cLogin, \StaticDatabase\StaticDatabase::settings('tokenkey'));
                        $link = URI::get_path('profile/hgsresponse/' . $arg . '&token=' . $token);
                        $text = "Sayın <b>$cLogin</b>, sistemimizden hesap kilit pasifleştirme isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda hesap kilit durumunuz pasifleştirilecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Hesap Kilit pasifleştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>" . \StaticDatabase\StaticDatabase::settings('oyun_adi') . " Yönetimi</b><br><br><br>";
                        $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi') . " Hesap Kilit Pasifleştirme İsteği", $getMail, $text);
                        $date = date('Y-m-d H:i:s');
                        $this->gdb->update('account', array('t_status' => '1', 't_key' => $arg, 't_token' => $token, 't_date' => $date, 't_type' => '2'), array('id' => $aid));
                        $this->log->set('player', '8', "hesap kilit için $getMail adresine mail gönderildi");
                        Session::set('cError', 'OK');
                        URI::redirect('profile/hgs');
                    }
                }
            }
        }

        public function hgsresponse($arg)
        {
            Session::init();
            $arg2 = $this->filter->numberFilter($arg);
            if ($arg2 == false) {
                $result['result'] = false;
            } else {
                $aid = Session::get('aid');
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                $getTokenSe = $this->gdb->select('t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('id' => $aid, 't_status' => '1', 't_key' => $arg2));
                if ($getTokenSe->count() <= 0) {
                    $result['result'] = false;
                } else {
                    $getTokenS = $getTokenSe->get()[0];
                    $getToken = isset($getTokenS['t_token']) ? $getTokenS['t_token'] : null;
                    if ($token != $getToken) {
                        $result['result'] = false;
                    } else {
                        $tType = $getTokenS['t_type'];
                        if ($tType != 2) {
                            $result['result'] = false;
                        } else {
                            $hgs = "0";
                            $this->gdb->update(''.ACCOUNTLOCKTABLE.'', array('size' => $hgs), array('login' => $aid));
                            $this->gdb->update('account', array('t_status' => '0', 't_key' => '0', 't_token' => '0', 't_type' => '0'), array('id' => $aid));
                            $this->log->set('player', '9', "hesap kilit durumu pasif olarak güncellendi");
                            $result['result'] = true;
                            $result['data'] = $hgs;
                            return $result;
                        }
                    }
                }
            }
        }

    }