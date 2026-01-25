<?php
/**
 * Created by PhpStorm.
 * User: Oğuzcan GÖKMEN
 * Date: 24.03.2017
 * Time: 12:05
 */
use Controller\IN_Controller;
class Account extends IN_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['aLogin']) || !isset($_SESSION['adId']))
			die("Permission Denied!");
		else
			Functions::setOn($_SESSION['adId']);
	}
	public function create()
	{
		if($_POST){
			$this->helper(['filter']);
			$this->model->create();
		}else{
			$this->view->render('account/create');
		}
	}
	public function account($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index',1);
		}else{
			$this->helper(['filter']);
			$this->view->info = $this->model->account($arg);
			$this->view->render('account/account');
		}
	}
	public function deleteitem($arg = null){
		if ($arg == null){
			$this->view->render('error/index',1);
		}else{
			$this->helper(['filter']);
			$this->model->deleteitem($arg);
		}
	}
	public function deleteitem1($arg = null){
		if ($arg == null){
			$this->view->render('error/index',1);
		}else{
			$this->helper(['filter']);
			$this->model->deleteitem1($arg);
		}
	}
	public function change()
	{
		if ($_POST) {
			$this->model->change();
		}else{
			$this->view->render('error/index',1);
		}
	}
	public function ban($arg = null)
	{
		if ($arg == null) {
			$this->view->render('error/index',1);
		}else{
			$this->view->ban = $this->model->ban($arg);
			$this->view->render('account/ban');
		}
	}
	public function banned($arg = null){
		$this->helper(['mail']);
		$this->model->banned($arg);
	}
	public function banned2($arg = null){
		$this->helper(['mail']);
		$this->model->banned2($arg);
	}
	public function banned3($arg = null){
		$this->helper(['mail']);
		$this->model->banned3($arg);
	}
	public function search()
	{
		if ($_POST){
			$this->helper(['filter']);
			$this->view->search = $this->model->search();
			$this->view->render('account/search');
		}else{
			$this->view->render('error/index',1);
		}
	}
	public function searchmac()
	{
		if ($_POST){
			$this->helper(['filter']);
			$this->view->searchmac = $this->model->searchmac();
			$this->view->render('account/searchmac');
		}else{
			$this->view->render('error/index',1);
		}
	}
	public function allaccountlist($arg)
	{
		if ($arg == null) {
			$this->view->render('error/index',1);
		}else{
			$this->view->allaccountlist = $this->model->allaccountlist($arg);
			$this->view->render('account/allaccountlist');
		}
	}
	public function oldpass($arg)
	{
		if($arg == null){
			$this->view->render('error/index',1);
		}else{
			$this->model->oldpass($arg);
		}
	}
	public function openban($arg = null)
	{
		if($arg == null)
			$this->view->render('error/index',1);
		else {
			$this->helper(['filter']);
			$this->model->openban($arg);
		}
	}
	public function openhwidban($arg = null)
	{
		if($arg == null)
			$this->view->render('error/index',1);
		else {
			$this->helper(['filter']);
			$this->model->openhwidban($arg);
		}
	}
	public function gpcstop($arg = null)
	{
		if($arg == null)
			$this->view->render('error/index',1);
		else {
			$this->helper(['filter']);
			$this->model->gpcstop($arg);
		}
	}
	public function gotep()
	{
		$this->view->ep = $this->model->gotep();
		$this->view->render('account/gotep');
	}
	public function epdelete($arg=null)
	{
		if($arg == null){
			$this->view->render('error/index',1);
		}else{
			$this->model->epdelete($arg);
		}
	}
	public function addep($arg = null)
	{
		if($arg == null)
			$this->view->render('error/index',1);
		else {
			$this->view->data = $this->model->addep($arg);
			$this->view->render('account/addep');
		}
	}
	public function addedep()
	{
		if ($_POST)
			$this->model->addedep();
	}
	
	public function alllist()
	{
		$this->view->all = $this->model->alllist();
		$this->view->render('account/alllist');
	}

	public function banlist()
	{
		$this->view->all = $this->model->banlist();
		$this->view->render('account/banlist');
	}
}