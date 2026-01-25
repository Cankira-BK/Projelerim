<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 2.03.2017
     * Time: 03:08
     */
    use Controller\IN_Controller;

    class Ranked extends IN_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
            URI::redirect('ranked/player');
        }
        public function player()
        {
            $this->helper(['hash']);
            $this->view->views = $this->model->rankeds();
            $this->view->render('ranked/character');
        }
    }