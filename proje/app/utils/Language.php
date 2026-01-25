<?php
    /**
     * Created by PhpStorm.
     * User: Oğuzcan GÖKMEN
     * Date: 7.04.2017
     * Time: 13:08
     */
    class Language {

        public static function get(){
            $url = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
            $url = rtrim($url,'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            @session_start();
            $language = $_SESSION['language'];
            if($url[0] != ADMIN || $url[0] != SHOP || $url[0] != MUTUAL || $url[0] != ANDROID){
                if(empty($url[1])){
                    include 'app/language/'.$language.'/master.php';
                    $file = 'app/language/'.$language.'/'.$url[0].'/index.php';
                    if(file_exists($file)){
                        include 'app/language/'.$language.'/'.$url[0].'/index.php';
                    }else{
                        return false;
                    }
                    include 'app/language/'.$language.'/footer.php';
                }else{
                    $file = 'app/language/'.$language.'/'.$url[0].'/'.$url[1].'.php';
                    if (file_exists($file)){
                        require 'app/language/'.$language.'/master.php';
                        require $file;
                        require 'app/language/'.$language.'/footer.php';
                    }else{
                        return false;
                    }
                }
            }
        }
    }