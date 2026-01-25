<?php
/**
 * Created by PhpStorm.
 * User: m2-di
 * Date: 26.02.2017
 * Time: 20:25
 */
use Controller\IN_Controller;

class Moderation extends IN_Controller {
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
		$this->view->render('moderation/index');
	}
}