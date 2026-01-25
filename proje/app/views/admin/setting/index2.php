<?php
    @error_reporting(0);
    error_reporting(E_ALL ^ E_NOTICE);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="#1 selling multi-purpose bootstrap admin theme sold in themeforest marketplace packed with angularjs, material design, rtl support with over thausands of templates and ui elements and plugins to power any type of web applications including saas and admin dashboards. Preview page of Theme #1 for "
          name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path('')?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path('')?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path('')?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path('')?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?=URI::public_path('')?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?=URI::public_path('')?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?=URI::public_path('')?>pages/css/lock.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="">
<div class="page-lock">
    <?php
        if($_POST){
            $db = $this->db;
            if($db['result'] == false){
                echo '<script>alert("Lütfen Tüm Bilgileri Eksiksiz Giriniz");</script>';
            }elseif($db['result'] == true){
                $data = $db['data'];
                echo '<script>alert("İp Adresi : '.$data[0].'");</script>';
                echo '<script>alert("User : '.$data[1].'");</script>';
                echo '<script>alert("SQL Şifre : '.$data[2].'");</script>';
                echo '<script>alert("SSH Şifre : '.$data[3].'");</script>';
                URI::redirect('index');
            }
        }
    ?>
    <div class="page-logo">
        <a class="brand" href="index.html">
            <img src="<?=URI::public_path('')?>pages/img/logo-big.png" alt="logo" /> </a>
    </div>
    <div class="page-body">
        <div class="lock-head"> Oyun Database Bilgilerinizi Girin </div>
        <div class="lock-body">

            <form class="lock-form pull-left" action="<?=URI::get_path('setting/index2')?>" method="post">
                <div class="form-group">
                    <input class="form-control placeholder-no-fix"  style="width: 290px;" type="text" autocomplete="off" placeholder="İp Adresi (123.123.123.123)" name="ip" />
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix"  style="width: 290px;" type="text" autocomplete="off" placeholder="User (root)" name="user" />
                </div>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix"  style="width: 290px;" type="text" autocomplete="off" placeholder="SQL Password" name="password" />
                </div>
				<div class="form-group">
                    <input class="form-control placeholder-no-fix"  style="width: 290px;" type="text" autocomplete="off" placeholder="SSH Password" name="password2" />
                </div>
                <div class="form-actions">
                    <button type="submit"  style="width: 290px;" class="btn red uppercase">Kayıt Et</button>
                </div>
            </form>
        </div>
        <div class="lock-bottom">
            <span style="color: white">Bu bilgiler özel şifreleme sistemiyle host'un databasesine kayıt edilir.</span>
            <span style="color: white">Bu sistem database güvenliğiniz içindir.</span><br>
            <span style="color: white">Bilgilerinizi yanlış girdiğiniz takdirde market sistemi çalışmaz.</span>
        </div>
    </div>
    <div class="page-footer-custom"> 2020 &copy; <?=\StaticDatabase\StaticDatabase::settings('footer_name')?>. Admin Dashboard Template. </div>
</div>
<!--[if lt IE 9]>
<script src="<?=URI::public_path('')?>global/plugins/respond.min.js"></script>
<script src="<?=URI::public_path('')?>global/plugins/excanvas.min.js"></script>
<script src="<?=URI::public_path('')?>global/plugins/ie8.fix.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?=URI::public_path('')?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?=URI::public_path('')?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=URI::public_path('')?>pages/scripts/lock.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>