<?php
use Controller\IN_Controller;
class Detail extends IN_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->view->render('error/index');
	}

	public function player($arg = null)
	{
		if ($arg == null) {
			$this->view->render('error/index');
		} else {
			$this->helper(['filter', 'hash']);
			$this->view->player = $this->model->player($arg);
			if ($this->view->player == false) {
				$this->view->render('error/index');
			} else {
				$this->view->render('detail/player');
			}
		}
	}

	public function guild($arg = null)
	{
		if ($arg == null) {
			$this->view->render('error/index');
		} else {
			$this->helper(['filter', 'hash']);
			$this->view->guild = $this->model->guild($arg);
			if ($this->view->guild == false) {
				$this->view->render('error/index');
			} else {
				$this->view->render('detail/guild');
			}
		}
	}
}