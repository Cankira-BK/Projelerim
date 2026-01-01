<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 25.02.2017
     * Time: 00:35
     */
    use Controller\IN_Controller;

    class Login extends IN_Controller {
        public function __construct()
        {
            parent::__construct();

        }
        public function index(){
            $this->helper(['captcha']);
            $this->model->index();
            $this->view->render('login/index');
        }
        public function control(){
            if($_POST){
                $this->helper(['captcha','filter','log']);
                $this->model->control();
            }else{
                URI::redirect('error');
            }
        }
        public function logout()
        {
            $this->helper(['log']);
            $this->model->logout();
        }
    }