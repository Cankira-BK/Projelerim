<?php
/**
 * Created by PhpStorm.
 * User: m2-di
 * Date: 26.02.2017
 * Time: 20:25
 */
use Controller\IN_Controller;

class Profile extends IN_Controller {
	public function __construct()
	{
		parent::__construct();
		Session::init();
		$aid = Session::get('aid');
		if ($aid == null){
			$this->view->render('error/permission');
			exit();
		}
	}
	public function index(){
		$this->view->players = $this->model->index();
		$this->view->render('profile/index');
	}
	public function password()
	{
		$this->helper(['captcha']);
		$this->view->password = $this->model->password();
		$this->view->render('profile/password');
	}
	public function passwordchange(){
		if ($_POST){
			$this->helper(['filter','log']);
			$this->model->passwordchange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function email()
	{
		$this->helper(['captcha']);
		$this->view->aktive = $this->model->email();
		$this->view->render('profile/email');
	}
	public function emailchange()
	{
		if ($_POST){
			$this->helper(['filter','log']);
			$this->model->emailchange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function emailchange2()
	{
		if ($_POST){
			$this->helper(['filter','mail','hash','log']);
			$this->model->emailchange2();
		}else{
			$this->view->render('error/index');
		}
	}
	public function emailchange3()
	{
		if ($_POST){
			$this->helper(['filter','log']);
			$this->model->emailchange3();
		}else{
			$this->view->render('error/index');
		}
	}

	public function emailresponse($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['hash','mail','filter','captcha']);
			$this->view->response = $this->model->emailresponse($arg);
			$this->view->render('profile/emailresponse');
		}
	}
	public function depo()
	{
		$this->helper(['captcha']);
		$this->view->aktive = $this->model->depo();
		$this->view->render('profile/depo');
	}
	public function depochange()
	{
		if ($_POST){
			$this->helper(['filter','mail','hash','log']);
			$this->model->depochange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function deporesponse($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['hash','filter','log']);
			$this->view->response = $this->model->deporesponse($arg);
			$this->view->render('profile/deporesponse');
		}
	}

	public function ksk()
	{
		$this->helper(['captcha']);
		$this->view->aktive = $this->model->ksk();
		$this->view->render('profile/ksk');
	}
	public function kskchange()
	{
		if ($_POST){
			$this->helper(['filter','mail','hash','log']);
			$this->model->kskchange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function kskresponse($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['hash','filter','log']);
			$this->view->response = $this->model->kskresponse($arg);
			$this->view->render('profile/kskresponse');
		}
	}
	public function save()
	{
		$this->helper(['captcha']);
		$this->view->character = $this->model->bug();
		$this->view->render('profile/bug');
	}
	public function saved($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['filter','log']);
			$this->view->result = $this->model->saved($arg);
			$this->view->render('profile/saved');
		}
	}
	public function kgs()
	{
		$this->helper(['captcha']);
		$this->view->aktive = $this->model->kgs();
		$this->view->render('profile/kgs');
	}
	public function kgschange()
	{
		if ($_POST){
			$this->helper(['filter','mail','hash','log']);
			$this->model->kgschange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function kgsresponse($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['hash','mail','filter','log']);
			$this->view->response = $this->model->kgsresponse($arg);
			$this->view->render('profile/kgsresponse');
		}
	}
	public function aktive()
	{
		$this->helper(['captcha']);
		$this->view->aktive = $this->model->aktive();
		$this->view->render('profile/aktive');
	}
	public function aktivechange()
	{
		if ($_POST){
			$this->helper(['filter','mail','hash','log']);
			$this->model->aktivechange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function aktiveresponse($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['hash','mail','filter','log']);
			$this->view->response = $this->model->aktiveresponse($arg);
			$this->view->render('profile/aktiveresponse');
		}
	}
	public function aktivesupportrange()
	{
		if ($_POST){
			$this->model->depo2();
		}else{
			$this->view->render('profile/depo2');
		}
	}
	public function iks()
	{
		$this->helper(['captcha']);
		$this->view->aktive = $this->model->iks();
		$this->view->render('profile/iks');
	}
	public function ikschange()
	{
		if ($_POST){
			$this->helper(['filter','mail','hash','log']);
			$this->model->ikschange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function iksresponse($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['hash','mail','filter','log']);
			$this->view->response = $this->model->iksresponse($arg);
			$this->view->render('profile/iksresponse');
		}
	}
	public function pin()
	{
		$this->helper(['captcha']);
		$this->view->aktive = $this->model->pin();
		$this->view->render('profile/pin');
	}
	public function pinchange()
	{
		if ($_POST){
			$this->helper(['filter','mail','hash','log']);
			$this->model->pinchange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function pinresponse($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['hash','mail','filter','log']);
			$this->view->response = $this->model->pinresponse($arg);
			$this->view->render('profile/pinresponse');
		}
	}
	public function gpc()
	{
		$this->helper(['captcha']);
		$this->view->aktive = $this->model->gpc();
		$this->view->render('profile/gpc');
	}
	public function gpcchange()
	{
		if ($_POST){
			$this->helper(['filter','mail','hash','log']);
			$this->model->gpcchange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function gpcresponse($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['hash','filter','log']);
			$this->view->response = $this->model->gpcresponse($arg);
			$this->view->render('profile/gpcresponse');
		}
	}
	public function hgs()
	{
		$this->helper(['captcha']);
		$this->view->aktive = $this->model->hgs();
		$this->view->render('profile/hgs');
	}
	public function hgschange()
	{
		if ($_POST){
			$this->helper(['filter','mail','hash','log']);
			$this->model->hgschange();
		}else{
			$this->view->render('error/index');
		}
	}
	public function hgsresponse($arg = null)
	{
		if ($arg == null){
			$this->view->render('error/index');
		}else{
			$this->helper(['hash','filter','log']);
			$this->view->response = $this->model->hgsresponse($arg);
			$this->view->render('profile/hgsresponse');
		}
	}
	public function aktiveinfo()
	{
		$this->view->render('profile/aktiveinfo',1);
	}
}