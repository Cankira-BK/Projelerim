<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.12.2016
     * Time: 23:19
     */
use Controller\IN_Controller;

    class Errors extends IN_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index(){
            $this->view->render('error/index');
        }
    }