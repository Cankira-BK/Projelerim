<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 10.03.2017
     * Time: 13:46
     */
    use Controller\IN_Controller;

    class Register extends IN_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function index(){
        Session::init();
        if (isset($_SESSION['aid'])){
            $this->view->render('error/permission');
        }else{
            $this->helper(['captcha','hash','mail']);
			$this->model->sample();
            $this->view->render('register/index');
        }
		}
		public function contract()
        {
            $this->view->render('register/contract');
        }
        public function login(){
            $this->helper(['filter']);
            $this->model->login();
        }
        public function control(){
            if ($_POST){
                $this->helper(['filter']);
                $this->model->control();
            }else{
                $this->view->render('error/permission');
            }
        }
        public function error(){
            $this->view->render('register/error');
        }
    }