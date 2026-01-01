<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 28.12.2016
     * Time: 20:34
     */
    class URI{
        protected static $admin = ADMIN;
        protected static $shop = SHOP;
        protected static $mutual = MUTUAL;
        protected static $client = CLIENT;
        protected static $home = HOMEPAGE;
        protected static $android = ANDROID;
        protected static $site_url = URL;

        private static $_url = null;

        private static function _getUrl(){
            self::$_url = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
            self::$_url = rtrim(self::$_url,'/');
            self::$_url = filter_var(self::$_url,FILTER_SANITIZE_URL);
            self::$_url = explode('/',self::$_url);
            return self::$_url;
        }
        public static function public_path($arg=null){
            $url = self::_getUrl();
            $site_url = self::$site_url;
            if ($url[0] == self::$admin)
                return $site_url.'app/public/admin/'.$arg;
            elseif($url[0] == self::$shop)
                return $site_url.'app/public/shop/'.$arg;
            elseif ($url[0] == self::$mutual)
                return $site_url.'app/public/mutual/'.$arg;
            elseif ($url[0] == self::$android)
				return $site_url.'app/public/android/'.$arg;
			elseif ($url[0] == "panel")
				return $site_url.'app/public/client/'.self::$client.'/'.$arg;
            else
				return $site_url.'app/public/client/'.self::$client.'/'.$arg;

        }
		public static function home_patch($arg=null){
            $url = self::_getUrl();
            $site_url = self::$site_url;
            return $site_url.'app/public/home/'.self::$home.'/'.$arg;

        }
        public static function redirect($arg=null,$time = 0){
            $url = self::_getUrl();
            $site_url = self::$site_url;
            if($time == 0){
                if ($url[0] == self::$admin)
                    $redirect = $site_url.self::$admin.'/'.$arg;
                elseif($url[0] == self::$shop)
                    $redirect = $site_url.self::$shop.'/'.$arg;
                elseif ($url[0] == self::$mutual)
                    $redirect = $site_url.self::$mutual.'/'.$arg;
                elseif ($url[0] == self::$android)
					$redirect = $site_url.self::$android.'/'.$arg;
				elseif ($url[0] == "panel")
					$redirect = $site_url.'panel/'.$arg;
                else
					$redirect = $site_url.$arg;

                echo '<script>window.location = "'.$redirect.'";</script>';
            }else{
                if($url[0] != self::$admin && $url[0] != self::$shop && $url[0] != self::$mutual) {
                    $redirect = $site_url.$arg;
                }elseif ($url[0] == self::$admin){
                    $redirect = $site_url.self::$admin.'/'.$arg;
                }elseif($url[0] == self::$shop){
                    $redirect = $site_url.self::$shop.'/'.$arg;
                }elseif ($url[0] == self::$mutual){
                    $redirect = $site_url.self::$mutual.'/'.$arg;
                }elseif ($url[0] == "panel"){
                    $redirect = $site_url.'panel/'.$arg;
                }
                echo '<script>setTimeout(function() {
                        window.location = "'.$redirect.'";
                        },2);</script>';
            }
        }
        public static function get_path($arg=null){
            $url = self::_getUrl();
            $site_url = self::$site_url;
            if ($url[0] == self::$admin)
                return $site_url.self::$admin.'/'.$arg;
            elseif($url[0] == self::$shop)
                return $site_url.self::$shop.'/'.$arg;
            elseif ($url[0] == self::$mutual)
                return $site_url.self::$mutual.'/'.$arg;
            elseif ($url[0] == self::$android)
				return $site_url.self::$android.'/'.$arg;
			elseif ($url[0] == "panel")
				return $site_url.'panel/'.$arg;
            else
				return $site_url.$arg;
        }
		public static function get_index($arg=null){
            $url = self::_getUrl();
            $site_url = self::$site_url;
            return $site_url.'panel/'.$arg;
        }
    }