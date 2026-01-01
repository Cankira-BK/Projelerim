<?php
    use Model\IN_Model;
    class LoginModel extends IN_Model
    {
        public function __construct()
        {
            parent::__construct();
            $where = array('ip'=>$this->GetIP());
            $getIP = $this->db->select('ip')->table('ip_list')->where($where)->count();
        }
        public function check()
        {
            $reCaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
			if ($reCaptcha == 1) {
				$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
				$ip = $_SERVER['REMOTE_ADDR'];
				$captcha = filter_var($_POST['g-recaptcha-response'], FILTER_SANITIZE_STRING);
				$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
				$captchaRes = json_decode($rsp, true);
				date_default_timezone_set('Europe/Istanbul');
				if (!$captchaRes['success']) {
					$data['result'] = false;
					$data['message'] = "Lütfen robot olmadığınızı doğrulayın";
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
				if (!$responseData->success) 
				{
					$data['result'] = false;
					$data['message'] = "Lütfen robot olmadığınızı doğrulayın";
				}
			}
			$login = filter_var($_POST['login'],FILTER_SANITIZE_STRING);
            if (ADMINHASH == true){
				$password = $this->hash->create('md5',$_POST['password'],HASH_PASSWORD_KEY);
			}else{
				$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
			}
            if(empty($login) || empty($password)){
                $data['result'] = false;
                $data['message'] = "Tüm alanları doldurmalısınız";
            }else{
                $getUser = $this->db->select()->table('user')->where(array('login'=>$login,'password'=>$password));
                if($getUser->count() > 0){
                    $getUserInfo = $getUser->get()[0];
                    $userLogin = $getUserInfo['login'];
                    $userPermission = $getUserInfo['permission'];
                    $permissionString = $getUserInfo['permissionName'];
                    $permissionArray = explode('/',$permissionString);
                    $allPermission = $getUserInfo['allPermission'];
                    $allPermissionArray = explode('/',$allPermission);
                    $name = $getUserInfo['name'];
                    $id = $getUserInfo['id'];
                    Session::init();
                    Session::set('aLogin',$userLogin);
                    Session::set('aPermission',$userPermission);
                    Session::set('aPermissionArray',$permissionArray);
                    Session::set('allPermissionArray',$allPermissionArray);
                    Session::set('aName',$name);
                    Session::set('adId',$id);
                    Functions::setOn($_SESSION['adId']);
                    Functions::setAdminLog("Giriş Yaptı");
                    $data['result'] = true;
                }else{
                    $data['result'] = false;
                    $data['message'] = "Kullanıcı adı veya şifre hatalı";
                }
            }
            echo json_encode($data);
        }
        public function createkey()
        {
            $key = filter_var($_POST["key"],FILTER_SANITIZE_STRING);;
            if (empty($key)) {
                $data['result'] = false;
                $data['message'] = "Lütfen şifre alanını boş bırakmayınız";
            } else {
                $data['result'] = true;
                $hash = $this->hash->create('md5', $key, HASH_PASSWORD_KEY);
                $data['message'] = $hash;
            }
            echo json_encode($data);
        }
        public function GetIP()
        {
            if(getenv("HTTP_CLIENT_IP")) {
                $ip = getenv("HTTP_CLIENT_IP");
            } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
                if (strstr($ip, ',')) {
                    $tmp = explode (',', $ip);
                    $ip = trim($tmp[0]);
                }
            } else {
                $ip = getenv("REMOTE_ADDR");
            }
            return $ip;
        }
    }