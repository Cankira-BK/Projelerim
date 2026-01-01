<?php
use Controller\IN_Controller;
class Proto extends IN_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['aLogin']) || !isset($_SESSION['adId']))
			die("Permission Denied!");
	}
	public function index()
	{
		$this->view->all = $this->model->index();
		$this->view->render('proto/index');
	}
	public function search()
	{
		if ($_POST)
		{
			$this->view->search = $this->model->search();
			$this->view->render('proto/search');
		}
		else
			$this->view->render('error/index',1);
	}
}