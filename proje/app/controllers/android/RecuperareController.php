<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 13.03.2017
     * Time: 12:42
     */
    use Controller\IN_Controller;

    class Recuperare extends IN_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
            $this->helper(['captcha']);
            $this->model->sample();
            $this->view->render('recuperare/index');
        }
        public function control()
        {
            if($_POST){
                $this->helper(['filter','mail','hash']);
                $this->model->control();
            }else{
                $this->view->render('error/index');
            }
        }
        public function response($arg = null)
        {
            if ($arg == null){
                $this->view->render('error/index');
            }else{
                $this->helper(['hash','filter','mail']);
                $this->view->response = $this->model->response($arg);
                $this->view->render('recuperare/response');
            }
        }
        public function account()
        {
            $this->helper(['captcha']);
            $this->model->sample();
            $this->view->render('recuperare/account');
        }
        public function control2()
        {
            if($_POST){
                $this->helper(['filter','mail','hash']);
                $this->model->control2();
            }else{
                $this->view->render('error/index');
            }
        }
        public function response2($arg = null)
        {
            if ($arg == null){
                $this->view->render('error/index');
            }else{
                $this->helper(['hash','filter','mail']);
                $this->view->response = $this->model->response2($arg);
                $this->view->render('recuperare/response2');
            }
        }
		public function pin()
        {
            $this->helper(['captcha']);
            $this->model->sample();
            $this->view->render('recuperare/pin');
        }
        public function control3()
        {
            if($_POST){
                $this->helper(['filter','mail','hash']);
                $this->model->control3();
            }else{
                $this->view->render('error/index');
            }
        }
        public function response3($arg = null)
        {
            if ($arg == null){
                $this->view->render('error/index');
            }else{
                $this->helper(['hash','filter','mail']);
                $this->view->response = $this->model->response3($arg);
                $this->view->render('recuperare/response3');
            }
        }
    }