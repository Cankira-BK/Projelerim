<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.01.2017
     * Time: 14:46
     */
    use Controller\IN_Controller;

    class Product extends IN_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
            $this->view->render('error/index');
        }
        public function ajax($arg = null){
            if($arg == null){
                exit("404 NOT FOUND");
            }else{
                $this->helper(['hash']);
                $this->view->ajax = $this->model->ajax($arg);
                $this->view->render('product/ajax',1);
            }
        }
        public function ajaxem($arg = null){
            if($arg == null){
                exit("404 NOT FOUND");
            }else{
                $this->helper(['hash']);
                $this->view->ajaxem = $this->model->ajaxem($arg);
                $this->view->render('product/ajaxem',1);
            }
        }
        public function view($arg = null){
            $this->view->view = $this->model->view($arg);
            $this->view->render('product/view');
        }
        public function views($arg = null){
            $this->view->views = $this->model->views($arg);
            $this->view->render('product/views');
        }
        public function discount(){
            $this->view->discount = $this->model->discount();
            $this->view->render('product/discount');
        }
        public function em(){
            $this->view->em = $this->model->em();
            $this->view->render('product/em');
        }
        public function buy(){
            $this->helper(['hash']);
            $this->view->buy = $this->model->buy();
            $this->view->render('product/buy',1);
        }
		public function buy_faq(){
			$this->helper(['hash','filter']);
			if ($_POST)
				$this->view->buy = $this->model->buy_faq();
			//$this->view->render('product/buy',1);
		}
		public function select_faq()
		{
			$this->helper(['filter','hash']);
			if ($_POST)
				$this->model->select_faq();
		}
		public function faq_buy()
		{
			if (isset($_POST['result']) && isset($_POST['data']))
			{
				$this->view->buy = $this->model->faq_buy();
				$this->view->render('product/faq_buy',1);
			}
		}
        public function buyem(){
            $this->helper(['hash']);
            $this->view->buy = $this->model->buyem();
            $this->view->render('product/buyem',1);
        }
        public function price_change()
		{
			$this->helper(['filter']);
			if ($_POST)
				$this->model->price_change();
		}
		public function price_change2()
		{
			$this->helper(['filter','hash']);
			if ($_POST)
				$this->model->price_change2();
		}
    }