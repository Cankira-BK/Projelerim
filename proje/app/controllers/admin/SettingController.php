<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4.02.2017
 * Time: 20:50
 */
use Controller\IN_Controller;
class Setting extends IN_Controller
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
	public function index()
	{
		if($_POST){
			$this->view->key = $this->model->key();
		}
		$this->view->render('setting/index',1);
	}
	public function index2(){
		if ($_POST){
			$this->view->db = $this->model->db();
		}
		$this->view->render('setting/index2',1);
	}
	public function site(){
		$this->view->site = $this->model->site();
		$this->view->render('setting/site');
	}
	public function siteedit(){
		if($_POST){
			$this->model->siteedit();
		}
	}
	public function logoedit(){
		if ($_FILES){
			$this->helper(['upload']);
			$this->model->logoedit();
		}
	}
	public function slotcash()
	{
		if ($_POST)
			$this->model->slotcash();
	}

	public function shoprecaptcha()
	{
		if ($_POST)
			$this->model->shoprecaptcha();
	}
	public function langedit()
	{
		if ($_POST)
			$this->model->langedit();
	}
	public function mail()
	{
		$this->view->render('setting/mail');
	}
	public function testmail()
	{
		if ($_POST)
		{
			$this->helper(['mail']);
			$this->model->testmail();
		}
	}
	public function mailedit()
	{
		if ($_POST)
			$this->model->mailedit();
	}
	public function link()
	{
		$this->view->render('setting/link');
	}
	public function linkedit()
	{
		if ($_POST)
			$this->model->linkedit();
	}
	public function linkedit2()
	{
		if ($_POST)
			$this->model->linkedit2();
	}
	public function linkedit3()
	{
		if ($_POST)
			$this->model->linkedit3();
	}
	public function linkedit4()
	{
		if ($_POST)
			$this->model->linkedit4();
	}
	public function captcha()
	{
		$this->view->render('setting/captcha');
	}
	public function captchaedit()
	{
		if ($_POST)
			$this->model->captchaedit();
	}
	public function payreks()
	{
		$this->view->render('setting/payreks');
	}
	public function payreksedit()
	{
		if ($_POST)
			$this->model->payreksedit();
	}
	public function payreksedit2()
	{
		if ($_POST)
			$this->model->payreksedit2();
	}
	public function paywant()
	{
		$this->view->render('setting/paywant');
	}
	public function paywantedit()
	{
		if ($_POST)
			$this->model->paywantedit();
	}
	public function paytr()
	{
		$this->view->render('setting/paytr');
	}
	public function paytredit()
	{
		if ($_POST)
			$this->model->paytredit();
	}
	public function itemci()
	{
		$this->view->render('setting/itemci');
	}
	public function itemciedit()
	{
		if ($_POST)
			$this->model->itemciedit();
	}
	public function counter()
	{
		$this->view->counter = $this->model->counter();
		$this->view->render('setting/counter');
	}
	public function onlineedit()
	{
		if ($_POST)
			$this->model->onlineedit();
	}
	public function todayedit()
	{
		if ($_POST)
			$this->model->todayedit();
	}
	public function accountedit()
	{
		if ($_POST)
			$this->model->accountedit();
	}
	public function playeredit()
	{
		if ($_POST)
			$this->model->playeredit();
	}
	public function pazaredit()
	{
		if ($_POST)
			$this->model->pazaredit();
	}
	public function pazaredit2()
	{
		if ($_POST)
			$this->model->pazaredit2();
	}
	public function socket()
	{
		$this->view->render('setting/socket');
	}
	public function socketedit()
	{
		if ($_POST)
			$this->model->socketedit();
	}
	public function socketedit2()
	{
		if ($_POST)
			$this->model->socketedit2();
	}
	public function epprice()
	{
		$this->view->all = $this->model->epprice();
		$this->view->render('setting/epprice');
	}
	public function eppriceadd()
	{
		if ($_POST)
			$this->model->eppriceadd();
	}
	public function epdelete($arg)
	{
		if($arg == null)
			$this->view->render('error/index',1);
		else {
			$this->view->data = $this->model->epdelete($arg);
		}
	}
	public function online()
	{
		$this->view->online = $this->model->online();
		$this->view->render('setting/online');
	}
	public function wheel()
	{
		$this->view->render('setting/wheel');
	}
	public function wheeledit()
	{
		if ($_POST)
			$this->model->wheeledit();
	}
	public function shop()
	{
		$this->view->render('setting/shop');
	}
	public function shopedit()
	{
		if ($_POST)
			$this->model->shopedit();
	}
	public function shopedit1()
	{
		if ($_POST)
			$this->model->shopedit1();
	}
	public function shopedit2()
	{
		if ($_POST)
			$this->model->shopedit2();
	}
	public function ticket()
	{
		$this->view->title = $this->model->ticket();
		$this->view->render('setting/ticket');
	}
	public function ticketedit()
	{
		if ($_POST)
			$this->model->ticketedit();
	}
	public function ticketcategory()
	{
		if ($_POST)
			$this->model->ticketcategory();
	}
	public function ticketdelete($arg = null)
	{
		if ($arg === null)
			$this->view->render('error/index',1);
		else
			$this->model->ticketdelete($arg);
	}
	public function kasagame()
	{
		$this->view->render('setting/kasagame');
	}
	public function kasagameedit()
	{
		if ($_POST)
			$this->model->kasagameedit();
	}
	public function sanalpay()
	{
		$this->view->render('setting/sanalpay');
	}
	public function sanalpayedit()
	{
		if ($_POST)
			$this->model->sanalpayedit();
	}
	public function itemsultan()
	{
		$this->view->render('setting/itemsultan');
	}
	public function itemsultanedit()
	{
		if ($_POST)
			$this->model->itemsultanedit();
	}
	public function oyunalisverisi()
	{
		$this->view->render('setting/oyunalisverisi');
	}
	public function oyunalisverisiedit()
	{
		if ($_POST)
			$this->model->oyunalisverisiedit();
	}
	public function footeredit()
	{
		if ($_POST)
			$this->model->footeredit();
	}
	public function freesell()
	{
		if ($_POST)
			$this->model->freesell();
	}
}