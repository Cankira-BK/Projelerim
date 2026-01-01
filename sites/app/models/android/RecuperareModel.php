<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 13.03.2017
     * Time: 12:44
     */
    use Model\IN_Model;

    class RecuperareModel extends IN_Model
    {
        public function sample(){}
        public function control()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1){
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                date_default_timezone_set('Europe/Istanbul');
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('recuperare/index');
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
					URI::redirect('recuperare/index');
					exit;
				}
			}

                $login = $this->filter->mainFilter($_POST['login']);
                $email = $this->filter->mailFilter($_POST['email']);
                if($login == '' || $email == ''){
                    Session::set('cError', 'empty');
                    URI::redirect('recuperare/index');
                }elseif ($login == false || $email == false){
                    Session::set('cError', 'filter');
                    URI::redirect('recuperare/index');
                }else{
                    @$control = $this->gdb->select('login,email,t_date')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('login'=>$login,'email'=>$email))->get()[0];
                    if (count($control) <= 0){
                        Session::set('cError', 'error');
                        URI::redirect('recuperare/index');
                    }else{
                        $tDate = $control['t_date'];
                        $now = date('Y-m-d H:i:s', strtotime('-10 minutes') );
                        $residual = $this->minute($tDate);
                        if ($now <= $tDate){
                            Session::set('residual',$residual);
                            Session::set('cError', 'time');
                            URI::redirect('recuperare/index');
                        }else{
                            $arg = $this->generateRandomString(8);
                            $token = $this->hash->create('md5',$arg.$login.$email,\StaticDatabase\StaticDatabase::settings('tokenkey'));
                            $link = URI::get_path('recuperare/response/'.$arg.'&token='.$token);
                            $text = "Sayın <b>$login</b>, sistemimizden şifre değişikliği isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda yeni şifreniz belirlenecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Şifrenizi değiştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>".\StaticDatabase\StaticDatabase::settings('oyun_adi')." Yönetimi</b><br><br><br>";
                            $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi')." Hesap Şifresi Değişikliği",$email,$text);
                            $date = date('Y-m-d H:i:s');
                            $this->gdb->update('account',array('t_status'=>'1','t_key'=>$arg,'t_token'=>$token,'t_date'=>$date,'t_type'=>'4'),array('login'=>$login,'email'=>$email));
                            Session::set('cError', 'OK');
                            URI::redirect('recuperare/index');
                        }
                    }
                }
        }
        public function control2()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1){
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                date_default_timezone_set('Europe/Istanbul');
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('recuperare/account');
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
					URI::redirect('recuperare/account');
					exit;
				}
			}
                $email = $this->filter->mailFilter($_POST['email']);
                if($email == ''){
                    Session::set('cError', 'empty');
                    URI::redirect('recuperare/account');
                }elseif ($email == false){
                    Session::set('cError', 'filter');
                    URI::redirect('recuperare/account');
                }else{
                    $control = $this->gdb->select('login,email,t_date')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('email'=>$email))->get()[0];
                    if (count($control) <= 0){
                        Session::set('cError', 'error');
                        URI::redirect('recuperare/account');
                    }else{
                        $tDate = $control['t_date'];
                        $now = date('Y-m-d H:i:s', strtotime('-10 minutes') );
                        $residual = $this->minute($tDate);
                        if ($now <= $tDate){
                            Session::set('residual',$residual);
                            Session::set('cError', 'time');
                            URI::redirect('recuperare/account');
                        }else{
                            $arg = $this->generateRandomString(8);
                            $token = $this->hash->create('md5',$arg.$email,\StaticDatabase\StaticDatabase::settings('tokenkey'));
                            $link = URI::get_path('recuperare/response2/'.$arg.'&token='.$token);
                            $text = "Sayın <b>Kullanıcı</b>, sistemimizden hesap adı isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda yeni şifreniz belirlenecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Şifrenizi değiştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>".\StaticDatabase\StaticDatabase::settings('oyun_adi')." Yönetimi</b><br><br><br>";
                            $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi')." Hesap Adınız",$email,$text);
                            $date = date('Y-m-d H:i:s');
                            $this->gdb->update('account',array('t_status'=>'1','t_key'=>$arg,'t_token'=>$token,'t_date'=>$date,'t_type'=>'16'),array('email'=>$email));
                            Session::set('cError', 'OK');
                            URI::redirect('recuperare/account');
                        }
                    }
                }
        }
		public function control3()
        {
            $recaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
            if ($recaptcha == 1){
                $secret = \StaticDatabase\StaticDatabase::settings('secretkey');
                $ip = $_SERVER['REMOTE_ADDR'];
                $captcha = $_POST['g-recaptcha-response'];
                $rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
                $captchaRes = json_decode($rsp, true);
                date_default_timezone_set('Europe/Istanbul');
                if (!$captchaRes['success']) {
                    Session::set('cError', 'recaptcha');
                    URI::redirect('recuperare/index');
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
					URI::redirect('recuperare/pin');
					exit;
				}
			}

                $login = $this->filter->mainFilter($_POST['login']);
                $email = $this->filter->mailFilter($_POST['email']);
                if($login == '' || $email == ''){
                    Session::set('cError', 'empty');
                    URI::redirect('recuperare/pin');
                }elseif ($login == false || $email == false){
                    Session::set('cError', 'filter');
                    URI::redirect('recuperare/pin');
                }else{
                    @$control = $this->gdb->select('login,email,t_date')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('login'=>$login,'email'=>$email))->get()[0];
                    if (count($control) <= 0){
                        Session::set('cError', 'error');
                        URI::redirect('recuperare/pin');
                    }else{
                        $tDate = $control['t_date'];
                        $now = date('Y-m-d H:i:s', strtotime('-10 minutes') );
                        $residual = $this->minute($tDate);
                        if ($now <= $tDate){
                            Session::set('residual',$residual);
                            Session::set('cError', 'time');
                            URI::redirect('recuperare/pin');
                        }else{
                            $arg = $this->generateRandomString(8);
                            $token = $this->hash->create('md5',$arg.$login.$email,\StaticDatabase\StaticDatabase::settings('tokenkey'));
                            $link = URI::get_path('recuperare/response3/'.$arg.'&token='.$token);
                            $text = "Sayın <b>$login</b>, sistemimizden pin kodu değişikliği isteminde bulundunuz. <br> Aşağıdaki linki tıkladığınızda yeni şifreniz belirlenecektir.<br> Lütfen adımları takip ediniz. <br><b>NOT : Lütfen browser'ınızda sayfamız giriş yapılı şekilde bu linke tıklayınız. Ve aynı browser'dan aşağıdaki linke gidiniz.</b><br><br><br><a href='$link'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b>Şifrenizi değiştirmek için buraya tıklayınız. </b></button></a><br><br>Url olarak : $link<br><br><br> <b>".\StaticDatabase\StaticDatabase::settings('oyun_adi')." Yönetimi</b><br><br><br>";
                            $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi')." Pin Şifresi Değişikliği",$email,$text);
                            $date = date('Y-m-d H:i:s');
                            $this->gdb->update('account',array('t_status'=>'1','t_key'=>$arg,'t_token'=>$token,'t_date'=>$date,'t_type'=>'4'),array('login'=>$login,'email'=>$email));
                            Session::set('cError', 'OK');
                            URI::redirect('recuperare/pin');
                        }
                    }
                }
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
        public function minute($time)
        {
            $onceBol = explode(" ", $time);
            $sds = explode(":", $onceBol[1]);
            return $sds[1];
        }
        public function response($arg)
        {
            $key = $this->filter->numberFilter($arg);
            if($key == false){
                $result['result'] = false;
            }else{
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                if (empty($token)){
                    $result['result'] = false;
                }else{
                    $control = $this->gdb->select('login,email,t_status,t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('t_key'=>$key));
                    if($control->count() <= 0){
                        $result['result'] = false;
                    }else{
                        $info = $control->get()[0];
                        $login = $info['login'];
                        $email = $info['email'];
                        $t_status = $info['t_status'];
                        $t_token = $info['t_token'];
                        $tType = $info['t_type'];
                        $getToken = $this->hash->create('md5',$key.$login.$email,\StaticDatabase\StaticDatabase::settings('tokenkey'));
                        if($t_status == 0){
                            $result['result'] = false;
                        }elseif ($t_token == null){
                            $result['result'] = false;
                        }elseif ($t_token != $getToken){
                            $result['result'] = false;
                        }else{
                            if($tType != 4){
                                $result['result'] = false;
                            }else{
                                $result['result'] = true;
                                $newPass = $this->randomPassword();
                                $result['data'] = $newPass;
                                $text = "Sayın <b>$login</b>, şifreniz başarıyla değiştirilmiştir. <br>  <b>NOT : Lütfen şifrenizi kimseyle paylaşmayınız. Unutmayın hiçbir yönetici sizden şifrenizi istemez.</b><br><br><br><a href='javascript:void(0);'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b> $newPass </b></button></a><br><br><br> <b>".\StaticDatabase\StaticDatabase::settings('oyun_adi')." Yönetimi</b><br><br><br>";
                                $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi')." Yeni Şifreniz",$email,$text);
                                $this->gdb->sql("UPDATE account SET password = PASSWORD(?),t_status = ?,t_key = ?, t_token = ? WHERE login = ? AND email = ?",[$newPass,'0','0','0',$login,$email]);

                            }
                        }
                    }
                }
            }
            return $result;
        }
        public function response2($arg)
        {
            $key = $this->filter->numberFilter($arg);
            if($key == false){
                $result['result'] = false;
            }else{
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                if (empty($token)){
                    $result['result'] = false;
                }else {
                    $control = $this->gdb->select('login,email,t_status,t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('t_key'=>$key));
                    if($control->count() <= 0){
                        $result['result'] = false;
                    }else{
                        $info = $control->get()[0];
                        $login = $info['login'];
                        $email = $info['email'];
                        $t_status = $info['t_status'];
                        $t_token = $info['t_token'];
                        $tType = $info['t_type'];
                        $getToken = $this->hash->create('md5',$key.$email,\StaticDatabase\StaticDatabase::settings('tokenkey'));
                        if($t_status == 0){
                            $result['result'] = false;
                        }elseif ($t_token == null){
                            $result['result'] = false;
                        }elseif ($t_token != $getToken){
                            $result['result'] = false;
                        }else{
                            if($tType != 16){
                                $result['result'] = false;
                            }else{
                                $result['result'] = true;
                                $result['data'] = $login;
                                $this->gdb->sql("UPDATE account SET t_status = ?,t_key = ?, t_token = ? WHERE login = ? AND email = ?",['0','0','0',$login,$email]);
                            }
                        }
                    }
                }
            }
            return $result;
        }
		public function response3($arg)
        {
            $key = $this->filter->numberFilter($arg);
            if($key == false){
                $result['result'] = false;
            }else{
                $token = filter_var($_GET['token'],FILTER_SANITIZE_URL);
                if (empty($token)){
                    $result['result'] = false;
                }else{
                    $control = $this->gdb->select('login,email,t_status,t_token,t_type')->table(''.ACCOUNT_DB_NAME.'.account')->where(array('t_key'=>$key));
                    if($control->count() <= 0){
                        $result['result'] = false;
                    }else{
                        $info = $control->get()[0];
                        $login = $info['login'];
                        $email = $info['email'];
                        $t_status = $info['t_status'];
                        $t_token = $info['t_token'];
                        $tType = $info['t_type'];
                        $getToken = $this->hash->create('md5',$key.$login.$email,\StaticDatabase\StaticDatabase::settings('tokenkey'));
                        if($t_status == 0){
                            $result['result'] = false;
                        }elseif ($t_token == null){
                            $result['result'] = false;
                        }elseif ($t_token != $getToken){
                            $result['result'] = false;
                        }else{
                            if($tType != 4){
                                $result['result'] = false;
                            }else{
                                $result['result'] = true;
                                $newPass = $this->randomPassword2(\StaticDatabase\StaticDatabase::systems('pin_adet'));
                                $result['data'] = $newPass;
                                $text = "Sayın <b>$login</b>, pin kodunuz başarıyla değiştirilmiştir. <br>  <b>NOT : Lütfen pin kodunuzu kimseyle paylaşmayınız. Unutmayın hiçbir yönetici sizden pin kodunuzu istemez.</b><br><br><br><a href='javascript:void(0);'><button style='background-color: #1AB2E8; width: 350px; padding: 0; height: 50px; border-radius: 7px;border: none;'><b> $newPass </b></button></a><br><br><br> <b>".\StaticDatabase\StaticDatabase::settings('oyun_adi')." Yönetimi</b><br><br><br>";
                                $this->mail->send(\StaticDatabase\StaticDatabase::settings('oyun_adi')." Yeni Pin Kodunuz",$email,$text);
                                $this->gdb->sql("UPDATE account SET ".PINTABLE." = ?,t_status = ?,t_key = ?, t_token = ? WHERE login = ? AND email = ?",[$newPass,'0','0','0',$login,$email]);

                            }
                        }
                    }
                }
            }
            return $result;
        }
        function randomPassword()
		{
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }
		function randomPassword2($limit)
		{
            $alphabet = '123456789';
            $pass = array(); //remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
            for ($i = 0; $i < $limit; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            return implode($pass); //turn the array into a string
        }
    }