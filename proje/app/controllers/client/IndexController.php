<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.12.2016
     * Time: 23:22
     */
use Controller\IN_Controller;

    class Index extends IN_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
            $this->view->result = $this->model->index();
			$this->view->render('index/index');
        }
        public function patch(){
            if ($_POST){
                $this->model->patch();
            }
        }
        public function patch2(){
            if ($_POST){
                $this->model->patch2();
            }
        }
    }