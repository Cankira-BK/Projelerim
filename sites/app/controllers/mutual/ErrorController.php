<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 27.12.2016
     * Time: 23:19
     */
    class Errors extends \Controller\IN_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $this->view->render('error/index',1);
    }
}