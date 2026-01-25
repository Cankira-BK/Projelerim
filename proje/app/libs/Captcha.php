<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 1.01.2017
     * Time: 19:16
     */
    class Captcha  {
        public  $return;
        public  $captcha;
        public  $refresh;
        public  $script;

        public  function simple(){
            $this->captcha = '<br><center><img id="captcha" style="border:outset;" src="'.URL.'data/captcha/captcha.php'.'">';
            $this->refresh = '<img id="refresh" src="'.URL.'data/captcha/refresh.png'.'" alt="" style="width: 30px;"></center>';
            $this->script = "<script>$('#refresh').click(function () {
            var paths = window.location.pathname;
            var protocol = window.location.protocol;
            var host = window.location.host;
            var path = paths.split('/')[1];
            var url = protocol+'//'+host+'/'+path+'/';
            document.getElementById('captcha').src = '".URL."data/captcha/captcha.php';return false;});
            </script>";
            return $this;
        }

        public function google($siteKey){
            $this->captcha = "<script src='https://www.google.com/recaptcha/api.js'></script>";
            $this->refresh = null;
            $this->script = '<div class="g-recaptcha" data-theme="light" data-sitekey="'.$siteKey.'"></div>';
            return $this;
        }
		public function google_dark($siteKey){
            $this->captcha = "<script src='https://www.google.com/recaptcha/api.js'></script>";
            $this->refresh = null;
            $this->script = '<div class="g-recaptcha" data-theme="dark" data-sitekey="'.$siteKey.'"></div>';
            return $this;
        }
		public function google_mobile($siteKey){
            $this->captcha = "<script src='https://www.google.com/recaptcha/api.js'></script>";
            $this->refresh = null;
            $this->script = '<div class="g-recaptcha" data-theme="light" data-sitekey="'.$siteKey.'" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>';
            return $this;
        }
		public function hcaptcha($siteKey){
            $this->captcha = "<script src='https://hcaptcha.com/1/api.js' async defer></script>";
            $this->refresh = null;
            $this->script = '<div class="h-captcha" data-theme="light" data-sitekey="'.$siteKey.'"></div>';
            return $this;
        }
		public function hcaptcha_dark($siteKey){
            $this->captcha = "<script src='https://hcaptcha.com/1/api.js' async defer></script>";
            $this->refresh = null;
            $this->script = '<div class="h-captcha" data-theme="dark" data-sitekey="'.$siteKey.'"></div>';
            return $this;
        }
        public function call(){
            return $this->captcha.$this->refresh.$this->script;
        }

    }

