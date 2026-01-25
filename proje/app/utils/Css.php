<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 4.02.2017
     * Time: 13:44
     */
    class Css {

        public static function get(){
            $url = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
            $url = rtrim($url,'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            if($url[0] == ADMIN){
                if(empty($url[1])){
                    $file = 'app/public/admin/base/css/index/index.php';
                    if(file_exists($file)){
                        require $file;
                    }else{
                        return false;
                    }
                }else{
                    if(empty($url[2])){
                        $fileJS = 'app/public/admin/base/css/' . $url[1] . '/index.php';
                        if(file_exists($fileJS)){
                            require $fileJS;
                        }else{
                            return false;
                        }
                    }else{
                        $fileJS = 'app/public/admin/base/css/' . $url[1] . '/' . $url[2] .'.php';
                        if(file_exists($fileJS)){
                            require $fileJS;
                        }else{
                            return false;
                        }
                    }
                }
            }elseif ($url[0] == MUTUAL){
                if(empty($url[1])){
                    $file = 'app/public/mutual/base/css/index/index.php';
                    if(file_exists($file)){
                        require $file;
                    }else{
                        return false;
                    }
                }else{
                    if(empty($url[2])){
                        $fileJS = 'app/public/mutual/base/css/' . $url[1] . '/index.php';
                        if(file_exists($fileJS)){
                            require $fileJS;
                        }else{
                            return false;
                        }
                    }else{
                        $fileJS = 'app/public/mutual/base/css/' . $url[1] . '/' . $url[2] .'.php';
                        if(file_exists($fileJS)){
                            require $fileJS;
                        }else{
                            return false;
                        }
                    }
                }
            }
        }
    }