<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 13.03.2017
     * Time: 03:25
     */
    use Controller\IN_Controller;

    class Download extends IN_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function index(){
            $this->view->pack = $this->model->index();
            $this->view->render('download/index');
        }
    }