<?php
    /**
     * Created by OGStudio.
     * User: Oğuzcan GÖKMEN
     * Date: 27.12.2009
     * Time: 23:07
     */
	error_reporting(0);
	set_time_limit(0);
    @ob_start();
    session_start();
    date_default_timezone_set('Asia/Bahrain');
    require 'app/vendor/autoload.php';
    $autoload = new Autoload();
    $autoload->init();
    $app = new Bootstrap();
    $app->init();

