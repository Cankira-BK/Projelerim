<?php

class Buy extends \Controller\IN_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->view->result = $this->model->index();
		$this->view->render("buy/index");
	}
	public function paywant()
	{
		$this->view->paywant = $this->model->paywant();
		$this->view->render('buy/paywant');
	}
	public function kasagame()
	{
		$this->view->kasagame = $this->model->kasagame();
		$this->view->render('buy/kasagame');
	}
	public function sanalpay()
	{
		$this->view->sanalpay = $this->model->sanalpay();
		$this->view->render('buy/sanalpay');
	}
	public function payreks()
	{
		$this->view->payreks = $this->model->payreks();
		$this->view->render('buy/payreks');
	}

	public function paywant_notify($arg=null)
	{
		if ($arg === null)
			die("NULL");
		else
			$this->model->notify($arg);
	}
	public function sanalpay_notify($arg=null)
	{
		if ($arg === null)
			die("NULL");
		else
			$this->model->sanalpay_notify($arg);
	}
	public function payreks_notify($arg=null)
	{
		if ($arg === null)
			die("NULL");
		else
			$this->model->payreks_notify($arg);
	}
	public function paytr_notify($arg=null)
	{
		if ($arg === null)
			die("NULL");
		else
			$this->model->paytr_notify($arg);
	}
	public function kasagame_notify($arg=null)
	{
		if ($arg === null)
			die("NULL");
		else
			$this->model->kasagame_notify($arg);
	}
}