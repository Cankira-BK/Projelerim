<?php
    /**
     * Created by PhpStorm.
     * User: workspace
     * Date: 01.11.2016
     * Time: 00:46
     */
    class Javascript {
        public static function get(){
            $url = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
            $url = rtrim($url,'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            if($url[0] == ADMIN){
                if(empty($url[1])){
                    $file = 'app/public/admin/base/js/index/index.php';
                    if(file_exists($file)){
                        require $file;
                    }else{
                        return false;
                    }
                }else{
                    if(empty($url[2])){
                        $fileJS = 'app/public/admin/base/js/' . $url[1] . '/index.php';
                        if(file_exists($fileJS)){
                            require $fileJS;
                        }else{
                            return false;
                        }
                    }else{
                        $fileJS = 'app/public/admin/base/js/' . $url[1] . '/' . $url[2] .'.php';
                        if(file_exists($fileJS)){
                            require $fileJS;
                        }else{
                            return false;
                        }
                    }
                }
            }elseif ($url[0] == MUTUAL){
                if(empty($url[1])){
                    $file = 'app/public/mutual/base/js/index/index.php';
                    if(file_exists($file)){
                        require $file;
                    }else{
                        return false;
                    }
                }else{
                    if(empty($url[2])){
                        $fileJS = 'app/public/mutual/base/js/' . $url[1] . '/index.php';
                        if(file_exists($fileJS)){
                            require $fileJS;
                        }else{
                            return false;
                        }
                    }else{
                        $fileJS = 'app/public/mutual/base/js/' . $url[1] . '/' . $url[2] .'.php';
                        if(file_exists($fileJS)){
                            require $fileJS;
                        }else{
                            return false;
                        }
                    }
                }
            }
        }
        public static function get2(){
            $url = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
            $url = rtrim($url,'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            if($url[0] == ADMIN){
                if(empty($url[1])){
                    $file = 'app/public/admin/base/js2/index/index.php';
                    if(file_exists($file)){
                        require $file;
                    }else{
                        return false;
                    }
                }else{
                    if(empty($url[2])){
                        $fileJS = 'app/public/admin/base/js2/' . $url[1] . '/index.php';
                        if(file_exists($fileJS)){
                            require $fileJS;
                        }else{
                            return false;
                        }
                    }else{
                        $fileJS = 'app/public/admin/base/js2/' . $url[1] . '/' . $url[2] .'.php';
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