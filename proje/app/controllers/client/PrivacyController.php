<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.12.2016
     * Time: 23:22
     */
    use Controller\IN_Controller;

    class Privacy extends IN_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
            $this->view->render('privacy/index');
        }
    }