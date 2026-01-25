<?php
use Controller\IN_Controller;
class Pack extends IN_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['aLogin']) || !isset($_SESSION['adId']))
			die("Permission Denied!");
		else
		{
			$permissionArray = Session::get('aPermissionArray');
			Functions::checkPermission($permissionArray,Functions::getUrl()[1]);
			Functions::setOn($_SESSION['adId']);
		}
	}
	public function add()
	{
		$this->view->render('pack/add');
	}
	public function create()
	{
		if ($_POST)
			$this->model->create();
	}
	public function liste()
	{
		$this->view->all = $this->model->liste();
		$this->view->render('pack/list');
	}
	public function delete($arg)
	{
		if ($arg == null ){
			$this->view->render('error/index',1);
		}else{
			$this->model->delete($arg);
		}
	}
}