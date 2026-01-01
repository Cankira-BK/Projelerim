<?php
use Controller\IN_Controller;
class Login extends IN_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->helper(['captcha']);
		$this->model->index();
		$this->view->render('login/index',true);
	}
	public function control()
	{
		$this->helper(['captcha','filter']);
		$this->model->control();
	}
}