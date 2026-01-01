<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 30.01.2017
     * Time: 11:18
     */
    use Controller\IN_Controller;

    class Wheel extends IN_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
        public function index()
        {
        	$this->helper(['hash']);
        	$this->view->all = $this->model->index();
        	if (count($this->view->all['items']) < 16)
        		$this->view->render('wheel/error');
        	elseif(\StaticDatabase\StaticDatabase::settings('wheel') != 1)
				$this->view->render('wheel/error_2');
			else
        		$this->view->render('wheel/index');
        }
        public function spin($arg = null){
			$this->helper(['hash','filter']);
        	if ($arg === null)
        		$this->view->render('error/index',1);
			else
			{
				$this->view->all = $this->model->spin($arg);
				if ($this->view->all['result'] === false)
					$this->view->render('error/index',1);
				else
					$this->view->render('wheel/spin');
			}
		}
		public function gift($arg = null, $arg1 = null)
		{
			$this->helper(['hash','filter']);
			if ($arg === null && $arg1 === null)
				$this->view->render('wheel/gift_error',1);
			else
			{
				$this->view->all = $this->model->gift($arg,$arg1);
				if ($this->view->all['result'] === false)
					$this->view->render('wheel/gift_error',1);
				else
					$this->view->render('wheel/gift_success',1);
			}
		}
		public function slot()
		{
			$this->view->render('wheel/slot');
		}
		public function slotControl()
		{
			if($_POST){
				$this->helper(['filter']);
				$this->model->slotControl();
			}
		}
		public function slotGiftControl()
		{
			if($_POST){
				$this->helper(['filter']);
				$this->model->slotGiftControl();
			}
		}
		public function slotGift()
		{
			if($_POST){
				$this->helper(['filter']);
				$this->model->slotGift();
			}
		}
        public function result($arg = null){
            if($_POST){
                $this->model->result($arg);
            }
        }
        public function information($arg){
            $this->view->information = $this->model->information($arg);
            $this->view->render('wheel/information');
        }
        public function not_cash()
		{
			$this->view->render('wheel/not_cash',1);
		}
    }