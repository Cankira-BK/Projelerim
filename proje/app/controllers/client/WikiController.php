<?php
    /**
     * Created by PhpStorm.
     * User: m2-di
     * Date: 26.02.2017
     * Time: 16:41
     */
    use Controller\IN_Controller;

    class Wiki extends IN_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
            $this->view->render('wiki/index');
        }
		public function mob_drop()
        {
            $this->view->result = $this->model->mob_drop();
            $this->view->render('wiki/mob_drop');
        }
		public function special_item()
        {
            $this->view->result = $this->model->special_item();
            $this->view->render('wiki/special_item');
        }
		public function game_system()
        {
            $this->view->result = $this->model->game_system();
            $this->view->render('wiki/game_system');
        }
		public function game_npcs()
        {
            $this->view->result = $this->model->game_npcs();
            $this->view->render('wiki/game_npcs');
        }
		public function item_upgrade()
        {
            $this->view->result = $this->model->item_upgrade();
            $this->view->render('wiki/item_upgrade');
        }
		public function game_events()
        {
            $this->view->result = $this->model->game_events();
            $this->view->render('wiki/game_events');
        }
        public function view($arg = null)
        {
            if ($arg == null){
                $this->view->render('error/index');
            }else{
                $this->view->view = $this->model->view($arg);
                $this->view->render('wiki/view');
            }
        }
    }