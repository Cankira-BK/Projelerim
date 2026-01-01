<?php
/**
 * Created by PhpStorm.
 * User: m2-di
 * Date: 25.02.2017
 * Time: 03:25
 */

use Model\IN_Model;

class LoginModel extends IN_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}

	public function control()
	{
		$reCaptcha = \StaticDatabase\StaticDatabase::settings('recaptcha');
		if ($reCaptcha == 1) {
			Session::init();
			$secret = \StaticDatabase\StaticDatabase::settings('secretkey');
			$ip = $_SERVER['REMOTE_ADDR'];
			$captcha = filter_var($_POST['g-recaptcha-response'], FILTER_SANITIZE_STRING);
			$rsp = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha&remoteip=$ip");
			$captchaRes = json_decode($rsp, true);
			date_default_timezone_set('Europe/Istanbul');
			if (!$captchaRes['success']) {
				die(json_encode(["type"=>"danger","message"=>"Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.","redirect"=>"".URL."login/index"]));
				exit();
			}
		}
		if ($reCaptcha == 2)
		{
			Session::init();
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
				die(json_encode(["type"=>"danger","message"=>"Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.","redirect"=>"".URL."login/index"]));
				exit;
			}
		}
		$login = $this->filter->mainFilter($_POST['login']);
		$password = $this->filter->passwordFilter($_POST['password']);
		if (\StaticDatabase\StaticDatabase::systems('pin_durum') == 0) 
		{
			if ($login == false || $password == false) {
				die(json_encode(["type"=>"danger","message"=>"Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.","redirect"=>"".URL."login/index"]));
			} elseif ($login == '' || $password == '') {
				die(json_encode(["type"=>"danger","message"=>"Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.","redirect"=>"".URL."login/index"]));
			} else {
				$check = $this->gdb->sql("SELECT login FROM account WHERE login = ?", [$login]);
				$sth = $this->gdb->sql("SELECT id,login,phone1 FROM account WHERE login = ? and password = PASSWORD(?)", [$login, $password]);
				if (count($check) <= 0) {
					die(json_encode(["type"=>"danger","message"=>"Böyle bir hesap bulunamadı, lütfen kontrol ederek tekrar deneyin.","redirect"=>"".URL."login/index"]));
				}elseif (count($sth) <= 0) {
					die(json_encode(["type"=>"danger","message"=>"Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.","redirect"=>"".URL."login/index"]));
				} else {
					$aInfo = $sth[0];
					$aid = $aInfo['id'];
					$cLogin = $aInfo['login'];

					Session::set('aid', $aid);
					Session::set('sId', 'site');
					Session::set('cLogin', $cLogin);
					$this->log->set('login', '1');
					die(json_encode(["type"=>"success","message"=>"Başarıyla giriş yapıldı, yönlendiriliyorsunuz.","redirect"=>"".URL."profile/index"]));
				}
			}
		}
		if (\StaticDatabase\StaticDatabase::systems('pin_durum') == 1) 
		{
			$pin = $this->filter->passwordFilter($_POST['pin']);
			if ($login == false || $password == false || $pin == false) {
				die(json_encode(["type"=>"danger","message"=>"Hatalı kullanıcı adı, şifre veya pin. Lütfen tekrar deneyiniz.","redirect"=>false]));
			} elseif ($login == '' || $password == '' || $pin == '') {
				die(json_encode(["type"=>"danger","message"=>"Hatalı kullanıcı adı, şifre veya pin. Lütfen tekrar deneyiniz.","redirect"=>false]));
			} else {
				$check = $this->gdb->sql("SELECT login FROM account WHERE login = ?", [$login]);
				$sth = $this->gdb->sql("SELECT id,login,phone1 FROM account WHERE login = ? and ".PINTABLE." = ? and password = PASSWORD(?)", [$login, $pin, $password]);
				if (count($check) <= 0) {
					die(json_encode(["type"=>"danger","message"=>"Böyle bir hesap bulunamadı, lütfen kontrol ederek tekrar deneyin.","redirect"=>false]));
				}elseif (count($sth) <= 0) {
					die(json_encode(["type"=>"danger","message"=>"Hatalı kullanıcı adı, şifre veya pin. Lütfen tekrar deneyiniz.","redirect"=>false]));
				} else {
					$aInfo = $sth[0];
					$aid = $aInfo['id'];
					$cLogin = $aInfo['login'];

					Session::set('aid', $aid);
					Session::set('sId', 'site');
					Session::set('cLogin', $cLogin);
					$this->log->set('login', '1');
					die(json_encode(["type"=>"success","message"=>"Başarıyla giriş yapıldı, yönlendiriliyorsunuz.","redirect"=>"".URL."profile/index"]));
				}
			}
		}
	}

	public function logout()
	{
		$this->log->set('login', '0');
		if (isset($_SESSION['aId']))
			unset($_SESSION['aId']);
		if (isset($_SESSION['pId']))
			unset($_SESSION['pId']);
		if (isset($_SESSION['shopLogin']))
			unset($_SESSION['shopLogin']);
		if (isset($_SESSION['sId']))
			unset($_SESSION['sId']);
		if (isset($_SESSION['aid']))
			unset($_SESSION['aid']);
		if (isset($_SESSION['cLogin']))
			unset($_SESSION['cLogin']);
		URI::redirect('index');
	}
}