<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.12.2016
     * Time: 23:39
     */
    namespace Controller;
    use View\IN_View;
    use Helper\IN_Helper;
    class IN_Controller{
        public $helper;
        public $models;
        public $captcha = "captcha";
        public $form = "form";
        public function __construct()
        {
            $this->view = new IN_View();
//            $this->load = new IN_Helper();
        }
        public function loadClientModel($name){

            $path = 'app/models/client/'. $name . 'Model.php';

            if(file_exists($path)){
                require 'app/models/client/'. $name . 'Model.php';

                $modelName = $name . 'Model';
                $this->model = new $modelName();
                $this->models = $this->helper;
            }
        }
        public function loadAdminModel($name){

            $path = 'app/models/admin/'. $name . 'Model.php';

            if(file_exists($path)){
                require 'app/models/admin/'. $name . 'Model.php';

                $modelName = $name . 'Model';
                $this->model = new $modelName();
            }
        }
        public function loadShopModel($name){

            $path = 'app/models/shop/'. $name . 'Model.php';

            if(file_exists($path)){
                require 'app/models/shop/'. $name . 'Model.php';

                $modelName = $name . 'Model';
                $this->model = new $modelName();
            }
        }
        public function loadMutualModel($name){

            $path = 'app/models/mutual/'. $name . 'Model.php';

            if(file_exists($path)){
                require 'app/models/mutual/'. $name . 'Model.php';

                $modelName = $name . 'Model';
                $this->model = new $modelName();
            }
        }
        public function loadAndroidModel($name){

            $path = 'app/models/android/'. $name . 'Model.php';

            if(file_exists($path)){
                require 'app/models/android/'. $name . 'Model.php';

                $modelName = $name . 'Model';
                $this->model = new $modelName();
            }
        }
        public function helper($name){
            foreach ($name as $key=>$row){
                $helper = ucfirst($row);
                require 'app/libs/'.$helper.'.php';
                $this->model->$row = new $helper();
                $this->view->$row = new $helper();
            }
        }
    }