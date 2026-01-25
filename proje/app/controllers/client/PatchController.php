<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 26.02.2017
     * Time: 16:41
     */
    use Controller\IN_Controller;

    class Patch extends IN_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function index(){
            URI::redirect('index');
        }
        public function view($arg = null)
        {
            if ($arg == null){
                $this->view->render('error/index');
            }else{
                $this->view->view = $this->model->view($arg);
                $this->view->render('patch/view');
            }
        }
    }