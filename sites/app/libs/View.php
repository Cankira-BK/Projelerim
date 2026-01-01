<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.12.2016
     * Time: 23:43
     */
    namespace View;
    class IN_View{
        private $_url;
        public $session;
        public function render($name,$noInclude = false){
            $this->_url = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
            $this->_url = rtrim($this->_url, '/');
            $this->_url = filter_var($this->_url,FILTER_SANITIZE_URL);
            $this->_url = explode('/', $this->_url);
            if ($this->_url[0] == ADMIN){
                if($noInclude == true){
                    require 'app/views/admin/' . $name .'.php';
                }else{
                    require 'app/views/admin/header.php';
                    require 'app/views/admin/master.php';
                    require 'app/views/admin/' . $name .'.php';
                    require 'app/views/admin/footer.php';
                }
            }elseif ($this->_url[0] == SHOP){
                if($noInclude == true){
                    if ($this->_url[1] == 'errors'){
                        require 'app/views/shop/' . $name .'.php';
                    }else{
                        require 'app/views/shop/control.php';
                        require 'app/views/shop/' . $name .'.php';
                    }
                }else{
                    require 'app/views/shop/control.php';
                    require 'app/views/shop/header.php';
                    require 'app/views/shop/master.php';
                    require 'app/views/shop/' . $name .'.php';
                    require 'app/views/shop/footer.php';
                }
            }elseif ($this->_url[0] == MUTUAL){
                if($noInclude == true){
                    if ($this->_url[1] == 'errors'){
                        require 'app/views/mutual/' . $name .'.php';
                    }else{
                        require 'app/views/mutual/control.php';
                        require 'app/views/mutual/' . $name .'.php';
                    }
                }else{
                    require 'app/views/mutual/control.php';
                    require 'app/views/mutual/header.php';
                    require 'app/views/mutual/master.php';
                    require 'app/views/mutual/' . $name .'.php';
                    require 'app/views/mutual/footer.php';
                }
            }
			elseif ($this->_url[0] == ANDROID)
			{
				if($noInclude == true){
					if ($this->_url[1] == 'errors'){
						require 'app/views/android/' . $name .'.php';
					}else{
						require 'app/views/android/control.php';
						require 'app/views/android/' . $name .'.php';
					}
				}else{
					require 'app/views/android/control.php';
                    require 'app/views/android/header.php';
                    require 'app/views/android/master.php';
                    require 'app/views/android/last.php';
                    require 'app/views/android/' . $name .'.php';
                    require 'app/views/android/footer.php';
                }
            }
			elseif ($this->_url[0] == "patcher")
			{
				if ($this->_url[1] == null)
					require 'app/views/patcher/Default/error.php';
				else
					require 'app/views/patcher/Default/' . $this->_url[1] .'.php';
            }
            else
            {
				if (\StaticDatabase\StaticDatabase::settings('maintenance') == 1) 
				{
					require 'app/views/care/'. CARETHEME .'/index.php';
				}
				else
				{
					if($noInclude == true)
					{
						require 'app/views/client/'. CLIENT .'/control.php';
						require 'app/views/client/'. CLIENT .'/'. $name . '.php';
					}
					else
					{
						require 'app/views/client/'. CLIENT .'/control.php';
						require 'app/views/client/'. CLIENT .'/header.php';
						require 'app/views/client/'. CLIENT .'/master.php';
						require 'app/views/client/'. CLIENT .'/'. $name . '.php';
						require 'app/views/client/'. CLIENT . '/last.php';
						require 'app/views/client/'. CLIENT .'/footer.php';
					}
				}
            }
        }
    }