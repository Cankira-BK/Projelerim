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
		$this->view->model = $this->model->index();
		$this->view->render('index/index');
	}
}