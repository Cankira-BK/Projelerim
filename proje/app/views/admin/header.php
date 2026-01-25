<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link rel="icon" href="<?=URL.'favicon.ico'?>" type="image/x-icon" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path('')?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path('')?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path('')?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path('')?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <?=Css::get().PHP_EOL;?>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?=URI::public_path('')?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?=URI::public_path('')?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?=URI::public_path('')?>layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path('')?>layouts/layout/css/themes/nightdark.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="<?=URI::public_path('')?>layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path('')?>global/css/buttons.css"/>
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path('')?>global/css/animate.css"/>
    <!-- BEGIN PROGGRES -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
<!--    <script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>-->
<!--    <script src="--><?//=URI::public_path('progress.js')?><!--"></script>-->
<!--    <link rel="stylesheet" href="--><?//=URI::public_path('progress.css')?><!--">-->
    <script
            src="https://code.jquery.com/jquery-2.1.4.min.js"
            integrity="sha256-8WqyJLuWKRBVhxXIL1jBDD7SDxU936oZkCnxQbWwJVw="
            crossorigin="anonymous"></script>    <!-- END PROGRESS-->
    <script type="text/javascript" src="<?=URI::public_path('')?>global/scripts/jquery.noty.packaged.min.js"></script>
    <script type="text/javascript" src="<?=URI::public_path('')?>global/scripts/noty.js"></script>
</head>
<!-- END HEAD -->
