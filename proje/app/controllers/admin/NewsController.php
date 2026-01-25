<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 07.10.2017
 * Time: 14:37
 */
use Controller\IN_Controller;
class News extends IN_Controller
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
		$this->view->render('news/add');
	}
	public function newscreate()
	{
		if ($_FILES){
			$this->helper(['upload']);
			$this->model->newscreate();
		}
	}
	public function liste()
	{
		$this->view->newslist = $this->model->newslist();
		$this->view->render('news/liste');
	}
	public function delete($arg = null)
	{
		if ($arg == null ){
			$this->view->render('error/index',1);
		}else{
			$this->model->delete($arg);
		}
	}
	public function shopadd()
	{
		$this->view->render('news/shopadd');
	}
	public function shopnewscreate()
	{
		if ($_POST)
			$this->model->shopnewscreate();
	}
	public function shopnewscreated()
	{
		if ($_POST)
			$this->model->shopnewscreated();
	}
	public function shopnewslist()
	{
		$this->view->all = $this->model->shopnewslist();
		$this->view->render('news/shoplist');
	}
	public function shopdelete($arg = null)
	{
		if ($arg == null ){
			$this->view->render('error/index',1);
		}else{
			$this->model->shopdelete($arg);
		}
	}
	
	public function patcheradd()
	{
		$this->view->render('news/patcheradd');
	}
	public function patchernewscreate()
	{
		if ($_POST)
			$this->model->patchernewscreate();
	}
	public function patcherslidercreate()
	{
		if ($_POST)
			$this->model->patcherslidercreate();
	}
	public function patcherlinkcreate()
	{
		if ($_POST)
			$this->model->patcherlinkcreate();
	}
	public function patchernewslist()
	{
		$this->view->patchernewslist = $this->model->patchernewslist();
		$this->view->patchersliderlist = $this->model->patchersliderlist();
		$this->view->patcherlinklist = $this->model->patcherlinklist();
		$this->view->render('news/patchernewslist');
	}
	public function patcherdelete($arg = null)
	{
		if ($arg == null ){
			$this->view->render('error/index',1);
		}else{
			$this->model->patcherdelete($arg);
		}
	}
}