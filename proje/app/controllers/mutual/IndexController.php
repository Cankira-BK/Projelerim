<?php
use Controller\IN_Controller;
class Index extends IN_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->helper(['captcha']);
		$this->view->index = $this->model->index();
		$this->view->render('index/index');
	}

	public function create()
	{
		$this->helper(['filter', 'mail', 'sablon']);
		if ($_POST) {
			$this->model->create();
		} else
			URI::redirect('index');
	}
}