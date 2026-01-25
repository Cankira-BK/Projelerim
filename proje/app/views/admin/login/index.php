<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | Login Admin Panel</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path()?>global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path()?>global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path()?>global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=URI::public_path()?>global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="<?=URI::public_path()?>global/plugins/jquery-notific8/jquery.notific8.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?=URI::public_path()?>global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?=URI::public_path()?>global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="<?=URI::public_path()?>pages/css/login-4.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="<?=URI::get_path('login')?>" /> </head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="<?=URI::get_path('login')?>">
        <img src="<?=URI::public_path()?>layouts/layout/img/logo.png"/>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<?php  Session::init(); ?>
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form id="loginForm" class="login-form" action="<?=URI::get_path('login/check')?>" method="post">
        <h3 class="form-title">Hesabınıza Giriş Yapın</h3>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Kullanıcı Adı</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Kullanıcı Adı" name="login" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Şifre</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Şifre" name="password" /> </div>
        </div>
		<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') >= 1) {?>
        <div class="form-group">
            <?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {?>
                <script src='https://www.google.com/recaptcha/api.js'></script>
                <div class="g-recaptcha" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
			<?php }?>
			<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {?>
				<script src='https://hcaptcha.com/1/api.js'></script>
				<div class="h-captcha" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
			<?php }?>
        </div>
        <?php }?>
        <div class="form-actions">
            <button type="submit" class="btn green btn-block"> Giriş Yap </button>
        </div>
        <div class="form-group">
            <div class="input-icon">
                <img id="loginLoading" src="" alt="" class="img-responsive center-block">
            </div>
        </div>
		<?php if (ADMINHASH == true) {?>
        <div class="create-account" style="border-top: 1px solid #eee;padding-top: 10px;margin-top: 15px;">
                <a href="javascript:;" id="register-btn" class="btn red btn-circle"> Şifre Oluştur </a>
        </div>
		<?php }?>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <form id="createKey" class="register-form" action="<?=URI::get_path('login/createkey');?>" method="post">
        <h3>Şifre Oluştur</h3>
        <p> Sistemde md5,sha1 vs. gibi şifreleme sistemleri kullanılmamıştır. Kendine has bir şifreleme sistemi mevcuttur. Bunun için bu bölümde şifre oluşturup , oluşan şifreyi kopyalayıp veritabanın da gerekli yere yapıştırarak kullanabilirsiniz. </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" maxlength="16" placeholder="Şifre Oluştur" name="key"/>
                    <button id="trash" type="button" class="btn red fa fa-trash pull-right" style="margin-top: -34px;"></button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label id="passKey" style="color: darkred"></label>
            <div id="register_tnc_error"> </div>
        </div>
        <div class="form-actions">
            <button id="register-back-btn" type="button" class="btn red"> Geri </button>
            <button type="submit" class="btn green pull-right"> Şifre Oluştur </button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright"> 2020 &copy; <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?> </a></div>
<!-- END COPYRIGHT -->
<script src="<?=URI::public_path()?>global/plugins/respond.min.js"></script>
<script src="<?=URI::public_path()?>global/plugins/excanvas.min.js"></script>
<script src="<?=URI::public_path()?>global/plugins/ie8.fix.min.js"></script>
<!-- BEGIN CORE PLUGINS -->
<script src="<?=URI::public_path()?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=URI::public_path()?>global/plugins/jquery-notific8/jquery.notific8.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>pages/scripts/ui-notific8.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?=URI::public_path()?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=URI::public_path()?>pages/scripts/login-4.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>pages/scripts/login-main.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
<script>
    $('#loginForm').submit(function (event) {
        event.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();
        $.ajax({
            url: url,
            dataType: 'json',
            type: 'post',
            data: data,
            processData: false,
            success: function(result){
                if(result.result == false){
                    noty("Hata",result.message,"ruby");
                }else if(result.result == true){
                    var image = "<?=URI::public_path('pages/media/pages/loading.gif')?>";
                    $('#loginLoading').attr('src',image);
                    setTimeout(function () {
                        window.location.href = "<?= URI::get_path('index');?>";
                    },1500);
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    });
</script>
</body>

</html>
