<?php
class Nav extends \Controller\IN_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->view->render("nav/index");
	}

	public function characters()
	{
		$this->view->characters = $this->model->characters();
		$this->view->render("nav/characters");
	}

	public function log()
	{
		$this->view->log = $this->model->log();
		$this->view->render('nav/log');
	}

	public function depo()
	{
		$this->view->depo = $this->model->depo();
		$this->view->render('nav/depo');
	}

	public function coupon()
	{
		$this->view->coupon = $this->model->coupon();
		$this->view->render('nav/coupon');
	}

	public function controlCoupon()
	{
		if ($_POST) {
			$this->view->control = $this->model->control();
			$this->view->render('nav/control');
		} else {
			echo '<script>window.location = "' . URI::get_path('nav/coupon') . '";</script>';
		}
	}
}