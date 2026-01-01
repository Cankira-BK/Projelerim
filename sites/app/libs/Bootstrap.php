<?php

class Bootstrap
{
    private $_url = NULL;
    private $_controller = NULL;

    public function init()
    {
        #$this->Lisans_Kontrol_OGS("http://lisanskontrol.com");
		$this->_getUrl();
        if ($this->_url[0] == ADMIN) 
		{
            $adminUrl = isset($this->_url[1]) ? $this->_url[1] : NULL;
            if ($adminUrl == NULL) {
                URI::redirect("index");
                exit;
            }
			
            if (empty($this->_url[1])) {
                $this->_loadDefaultAdminController();
                return false;
            }
			
            $this->_loadExistingAdminController();
            $this->_callControllerAdminMethod();
        } 
		else 
		{
            if ($this->_url[0] == SHOP) 
			{
                if (empty($this->_url[1])) {
                    $this->_loadDefaultShopController();
                    return false;
                }

                $this->_loadExistingShopController();
                $this->_callControllerShopMethod();
            } 
			else 
			{
                if ($this->_url[0] == MUTUAL) {
                    $mutualUrl = isset($this->_url[1]) ? $this->_url[1] : NULL;
                    if ($mutualUrl == NULL) {
                        URI::redirect("index");
                        exit;
                    }
					
                    if (empty($this->_url[1])) {
                        $this->_loadDefaultMutualController();
                        return false;
                    }

                    $this->_loadExistingMutualController();
                    $this->_callControllerMutualMethod();
                } 
				else 
				{
                    if ($this->_url[0] == ANDROID) {
                        if (empty($this->_url[1])) {
                            $this->_loadDefaultAndroidController();
                            return false;
                        }

                        $this->_loadExistingAndroidController();
                        $this->_callControllerAndroidMethod();
                    } 
					elseif ($this->_url[0] == "panel" && \StaticDatabase\StaticDatabase::settings('indexhome') == 1)
					{
                        $this->IsMobileCheck($this->_url[1]);
						if (empty($this->_url[1])) {
                            $this->_loadDefaultClientController();
                            return false;
                        }

                        $this->_loadExistingClientController2();
                        $this->_callControllerClientMethod2();
                    }
					else 
					{
						$clientUrl = isset($this->_url[0]) ? $this->_url[0] : NULL;
                        $this->IsMobileCheck($clientUrl);
                        if ($clientUrl == NULL) {
                            URI::redirect("index");
                            exit;
                        }

                        if (empty($this->_url[0])) {
                            $this->_loadDefaultClientController();
                            return false;
                        }

                        $this->_loadExistingClientController();
                        $this->_callControllerClientMethod();
                    }
                }
            }
        }
    }

    private function _getUrl()
    {
        $url = isset($_GET["url"]) ? filter_var($_GET["url"], FILTER_SANITIZE_URL) : NULL;
        $url = rtrim($url, "/");
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode("/", $url);
    }

    private function _loadDefaultClientController()
    {
        require "app/controllers/client/IndexController.php";
        $this->_controller = new Index();
        $this->_controller->index();
        return false;
    }

    private function _loadDefaultAdminController()
    {
        require "app/controllers/admin/IndexController.php";
        $this->_controller = new index();
        $this->_controller->index();
        return false;

    }

    private function _loadDefaultShopController()
    {
        require "app/controllers/shop/IndexController.php";
        $this->_controller = new Index();
        $this->_controller->loadShopModel(ucfirst("index"));
        $this->_controller->index();
        return false;
    }

    private function _loadDefaultMutualController()
    {
        require "app/controllers/mutual/IndexController.php";
        $this->_controller = new Index();
        $this->_controller->index();
        return false;
    }

    private function _loadDefaultAndroidController()
    {
        require "app/controllers/android/IndexController.php";
        $this->_controller = new Index();
        $this->_controller->loadAndroidModel(ucfirst("index"));
        $this->_controller->index();
        return false;
    }

    private function _loadExistingClientController()
    {
        $fileClient = "app/controllers/client/" . ucfirst($this->_url[0]) . "Controller.php";
        if (file_exists($fileClient)) {
            require $fileClient;
            $this->_controller = new $this->_url[0]();
            $this->_controller->loadClientModel(ucfirst($this->_url[0]));
        } 
		else 
		{
            $this->_errorClient();
            return false;
        }
    }
	
	private function _loadExistingClientController2()
    {
        $fileClient = "app/controllers/client/" . ucfirst($this->_url[1]) . "Controller.php";
        if (file_exists($fileClient)) {
            require $fileClient;
            $this->_controller = new $this->_url[1]();
            $this->_controller->loadClientModel(ucfirst($this->_url[1]));
        } 
		else 
		{
            $this->_errorClient();
            return false;
        }
    }

    private function _loadExistingAdminController()
    {
        $fileAdmin = "app/controllers/admin/" . ucfirst($this->_url[1]) . "Controller.php";
        if (file_exists($fileAdmin)) {
            require $fileAdmin;
            $this->_controller = new $this->_url[1]();
            $this->_controller->loadAdminModel(ucfirst($this->_url[1]));
        } else {
            $this->_errorAdmin();
        }
    }

    private function _loadExistingShopController()
    {
        $fileShop = "app/controllers/shop/" . ucfirst($this->_url[1]) . "Controller.php";
        if (file_exists($fileShop)) {
            require $fileShop;
            $this->_controller = new $this->_url[1]();
            $this->_controller->loadShopModel(ucfirst($this->_url[1]));
        } else {
            $this->_errorShop();
        }
    }

    private function _loadExistingMutualController()
    {
        $fileMutual = "app/controllers/mutual/" . ucfirst($this->_url[1]) . "Controller.php";
        if (file_exists($fileMutual)) {
            require $fileMutual;
            $this->_controller = new $this->_url[1]();
            $this->_controller->loadMutualModel(ucfirst($this->_url[1]));
        } else {
            $this->_errorMutual();
        }
    }

    private function _loadExistingAndroidController()
    {
        $fileAndroid = "app/controllers/android/" . ucfirst($this->_url[1]) . "Controller.php";
        if (file_exists($fileAndroid)) {
            require $fileAndroid;
            $this->_controller = new $this->_url[1]();
            $this->_controller->loadAndroidModel(ucfirst($this->_url[1]));
        } else {
            $this->_errorAndroid();
        }
    }

    private function _callControllerClientMethod()
    {
        $length = count($this->_url);
        if (1 < $length && !method_exists($this->_controller, ucfirst($this->_url[1]))) {
            $this->_errorClient();
        }

        switch ($length) {
            case 5:
                $this->_controller->{ucfirst($this->_url[1])}(ucfirst($this->_url[2]), ucfirst($this->_url[3]), ucfirst($this->_url[4]));
                break;
            case 4:
                $this->_controller->{ucfirst($this->_url[1])}(ucfirst($this->_url[2]), ucfirst($this->_url[3]));
                break;
            case 3:
                $this->_controller->{ucfirst($this->_url[1])}(ucfirst($this->_url[2]));
                break;
            case 2:
                $this->_controller->{ucfirst($this->_url[1])}();
                break;
            default:
                $this->_controller->index();
                break;
        }
    }
	
	private function _callControllerClientMethod2()
    {
        $length = count($this->_url);
        if (2 < $length && !method_exists($this->_controller, ucfirst($this->_url[2]))) {
            $this->_errorClient();
        }

        switch ($length) {
            case 6:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]), ucfirst($this->_url[4]), $this->_url[5]);
                break;
            case 5:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]), ucfirst($this->_url[4]));
                break;
            case 4:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]));
                break;
            case 3:
                $this->_controller->{ucfirst($this->_url[2])}();
                break;
            case 2:
                $this->_controller->index();
                break;
        }
    }

    private function _callControllerAdminMethod()
    {
        $length = count($this->_url);
        if (2 < $length && !method_exists($this->_controller, ucfirst($this->_url[2]))) {
            $this->_errorAdmin();
        }
        switch ($length) {
            case 6:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]), ucfirst($this->_url[4]), $this->_url[5]);
                break;
            case 5:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]), ucfirst($this->_url[4]));
                break;
            case 4:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]));
                break;
            case 3:
                $this->_controller->{ucfirst($this->_url[2])}();
                break;
            case 2:
                $this->_controller->index();
                break;
        }
    }

    private function _callControllerShopMethod()
    {
        $length = count($this->_url);
        if (2 < $length && !method_exists($this->_controller, ucfirst($this->_url[2]))) {
            $this->_errorShop();
        }

        switch ($length) {
            case 6:
                $this->_controller->{ucfirst($this->_url[2])}($this->_url[3], $this->_url[4], $this->_url[5]);
                break;
            case 5:
                $this->_controller->{ucfirst($this->_url[2])}($this->_url[3], $this->_url[4]);
                break;
            case 4:
                $this->_controller->{ucfirst($this->_url[2])}($this->_url[3]);
                break;
            case 3:
                $this->_controller->{ucfirst($this->_url[2])}();
                break;
            case 2:
                $this->_controller->index();
                break;
        }
    }

    private function _callControllerMutualMethod()
    {
        $length = count($this->_url);
        if (2 < $length && !method_exists($this->_controller, ucfirst($this->_url[2]))) {
            $this->_errorMutual();
        }

        switch ($length) {
            case 6:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]), ucfirst($this->_url[4]), $this->_url[5]);
                break;
            case 5:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]), ucfirst($this->_url[4]));
                break;
            case 4:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]));
                break;
            case 3:
                $this->_controller->{ucfirst($this->_url[2])}();
                break;
            case 2:
                $this->_controller->index();
                break;
        }
    }

    private function _callControllerAndroidMethod()
    {
        $length = count($this->_url);
        if (2 < $length && !method_exists($this->_controller, ucfirst($this->_url[2]))) {
            $this->_errorAndroid();
        }

        switch ($length) {
            case 6:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]), ucfirst($this->_url[4]), $this->_url[5]);
                break;
            case 5:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]), ucfirst($this->_url[4]));
                break;
            case 4:
                $this->_controller->{ucfirst($this->_url[2])}(ucfirst($this->_url[3]));
                break;
            case 3:
                $this->_controller->{ucfirst($this->_url[2])}();
                break;
            case 2:
                $this->_controller->index();
                break;
        }
    }

    private function _errorClient()
    {
        require "app/controllers/client/ErrorController.php";
        $this->_controller = new Errors();
        $this->_controller->index();
        exit;
    }

    private function _errorAdmin()
    {
        require "app/controllers/admin/ErrorController.php";
        $this->_controller = new Errors();
        $this->_controller->index();
        exit;
    }

    private function _errorShop()
    {
        require "app/controllers/shop/ErrorController.php";
        $this->_controller = new Errors();
        $this->_controller->index();
        exit;
    }

    private function _errorMutual()
    {
        require "app/controllers/mutual/ErrorController.php";
        $this->_controller = new Errors();
        $this->_controller->index();
        exit;
    }

    private function _errorAndroid()
    {
        require "app/controllers/android/ErrorController.php";
        $this->_controller = new Errors();
        $this->_controller->index();
        exit;
    }
	
	private function IsMobileCheck($redirect)
	{
		$detect = new Mobile_Detect;
		if($detect->isMobile() || $detect->isTablet()){echo '<script>window.location = "'.URL.'android/'.$redirect.'";</script>';}
	}

    private function Domain_Base_URL_Ogren(){
		return sprintf(
			"%s://%s",
			isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
			$_SERVER['SERVER_NAME']
		);
	}

	private function Lisans_Curl_Kullan($url) {
		if (function_exists('curl_exec')){
			$conn = curl_init($url);
			curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
			curl_setopt($conn, CURLOPT_REFERER, $this->Domain_Base_URL_Ogren());
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

    private function curl($url, $post = false)
    {
        $user_agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; tr; rv:1.9.0.6) Gecko/2009011913 Firefox/3.0.6";
        if (!function_exists("curl_init")) {
            exit("Sorry cURL is not installed!");
        }
		
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    private function antiInjection($sql)
    {
        $sql = preg_replace(@sql_regcase("/(from|select|insert|delete|where|drop table|show tables|#|\\*|--|\\\\)/"), "", $sql);
        $sql = trim($sql);
        $sql = strip_tags($sql);
        $sql = addslashes($sql);
        return $sql;
    }

    private function timeEncode($value)
    {
        $encode = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5("zPcOjFD5CsyLVIfG"), $value, MCRYPT_MODE_CBC, md5(md5("zPcOjFD5CsyLVIfG"))));
        return $encode;
    }

    private function timeDecode($value)
    {
        $decode = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5("zPcOjFD5CsyLVIfG"), base64_decode($value), MCRYPT_MODE_CBC, md5(md5("zPcOjFD5CsyLVIfG"))), "");
        return $decode;
    }

    private function _getIP()
    {
        if (getenv("HTTP_CLIENT_IP")) {
            $ip = getenv("HTTP_CLIENT_IP");
        } else {
            if (getenv("HTTP_X_FORWARDED_FOR")) {
                $ip = getenv("HTTP_X_FORWARDED_FOR");
                if (strstr($ip, ",")) {
                    $tmp = explode(",", $ip);
                    $ip = trim($tmp[0]);
                }
            } else {
                $ip = getenv("REMOTE_ADDR");
            }
        }
        return $ip;
    }
}

?>