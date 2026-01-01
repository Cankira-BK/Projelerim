<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.05.2017
     * Time: 23:12
     */
    use Controller\IN_Controller;

    class Event extends IN_Controller {
        public function __construct()
        {
            parent::__construct();
        }
        public function index(){
            $this->view->render('event/index',1);
        }
		public function dynamic(){
			$this->view->events = $this->model->dynamic();
			$this->view->render('event/dynamic',1);
		}
        public function event()
        {
            if (isset($_GET['day']))
                $this->model->event();
            else{
                $this->view->render('error/index');
            }
        }
    }