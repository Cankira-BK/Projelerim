<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 5.03.2017
     * Time: 05:40
     */
    use Controller\IN_Controller;

    class Media extends IN_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function add(){
        	$this->helper(['filter']);
            if ($_POST)
            	$this->model->add();
        }
    }