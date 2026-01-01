<?php
use Controller\IN_Controller;
class Management extends IN_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['aLogin']) || !isset($_SESSION['adId']))
			die("Permission Denied!");
		else {
		Session::init();
		$permissionArray = Session::get('aPermissionArray');
		Functions::checkPermission($permissionArray,Functions::getUrl()[1]);
		Functions::setOn($_SESSION['adId']);
		}
	}
	
	public function themedownload()
	{
		if ($_POST)
			$this->model->themedownload();
	}

	public function shop_backup()
	{
		$this->helper(['captcha']);
		$this->view->all = $this->model->shop_backup();
		$this->view->render('management/shop_backup');
	}

	public function shop_export()
	{
		$this->model->shop_export();
	}

	public function shop_download()
	{
		$this->model->shop_download();
	}

	public function shop_import()
	{
		if ($_POST)
		{
			$this->model->shop_import();
		}
	}
	public function licence()
	{
		$this->view->all = $this->model->licence();
		$this->view->render('management/licence');
	}
	public function game_systems()
	{
		$this->view->render('management/game_systems');
	}
	public function chequewonedit()
	{
		if ($_POST)
			$this->model->chequewonedit();
	}
	public function metingayaedit()
	{
		if ($_POST)
			$this->model->metingayaedit();
	}
	public function bossgayaedit()
	{
		if ($_POST)
			$this->model->bossgayaedit();
	}
	public function npedit()
	{
		if ($_POST)
			$this->model->npedit();
	}
	public function rebirthedit()
	{
		if ($_POST)
			$this->model->rebirthedit();
	}
	public function rutbeedit()
	{
		if ($_POST)
			$this->model->rutbeedit();
	}

}