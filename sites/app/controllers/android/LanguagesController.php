<?php
    /**
     * Created by PhpStorm.
     * User: Oğuzcan GÖKMEN
     * Date: 7.04.2017
     * Time: 16:54
     */
    use Controller\IN_Controller;

    class Languages extends IN_Controller
	{
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
		{
			URI::redirect('index');
		}
        public function select($arg = null)
		{
			if ($arg === null) {
				$this->view->render('index');
			} else {
				$this->helper(['filter']);
				$this->model->index($arg);
			}
		}
    }