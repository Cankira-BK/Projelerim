<?php
use Controller\IN_Controller;
class Update extends IN_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!isset($_SESSION['aLogin']) || !isset($_SESSION['adId']))
            die("Permission Denied!");
    }
    public function index()
    {
        $this->view->render('update/index');
    }
    public function control()
    {
        if ($_POST)
            $this->model->control();
    }
    public function download()
    {
        if ($_POST)
            $this->model->download();
    }
}