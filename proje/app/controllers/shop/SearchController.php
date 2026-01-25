<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 3.02.2017
     * Time: 13:23
     */
    class Search extends \Controller\IN_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function index(){
            if ($_POST){
                $this->helper(['hash','filter']);
                $this->view->search = $this->model->search();
                $this->view->render("search/index");
            }
        }
    }