<?php
use Controller\IN_Controller;
class Ticket extends IN_Controller
{
	public function __construct()
	{
		parent::__construct();
		$sessionControl = isset($_SESSION['aId']) ? $_SESSION['aId'] : null;
		if (!$sessionControl)
			die("Permission Denied!");
	}

	public function unread()
	{
		$this->view->unread = $this->model->unread();
		$this->view->render('ticket/unread');
	}

	public function read()
	{
		$this->view->read = $this->model->read();
		$this->view->render('ticket/read');
	}

	public function lock()
	{
		$this->view->lock = $this->model->lock();
		$this->view->render('ticket/lock');
	}

	public function view($arg = null)
	{
		if ($arg == null)
			$this->view->render('error/index', 1);
		else {
			$this->view->view = $this->model->view($arg);
			$this->view->render('ticket/view');
		}
	}

	public function send($arg = null)
	{
		$this->helper(['mail', 'sablon', 'filter']);
		if ($arg == null)
			$this->view->render('error/index', 1);
		else
			$this->model->send($arg);
	}

	public function close($arg = null, $arg2 = null)
	{
		$this->helper(['filter']);
		if ($arg === null || $arg2 === null)
			$this->view->render('error/index', 1);
		else
			$this->model->close($arg, $arg2);
	}
}