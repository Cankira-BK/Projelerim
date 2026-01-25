<!DOCTYPE html>
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9">
<![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - Nesne Market</title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=URL.'favicon.ico'?>">
	<link rel="stylesheet" href="<?=URI::public_path('css/bootstrap.min.css')?>" type="text/css" />
	<link rel="stylesheet" id="gameStyle" href="<?=URI::public_path('css/style.min.css')?>" type="text/css" />

	<script type="text/javascript">
        (function (wd, doc) {
            var w = wd.innerWidth || doc.documentElement.clientWidth;
            var h = wd.innerHeight || doc.documentElement.clientHeight;
            var screenSize = {w: w, h: h};
            var compareW = 801;
            if (screenSize.w > 0 && screenSize.w < compareW) {
                var cssTag = doc.createElement("link"),
                    cssFile = '<?=URI::public_path('css/responsive.min.css')?>';
                cssTag.setAttribute("id", "smallStyle");
                cssTag.setAttribute("rel", "stylesheet");
                cssTag.setAttribute("type", "text/css");
                cssTag.setAttribute("href", cssFile);
                doc.getElementsByTagName("head")[0].appendChild(cssTag);
            }
        })(window, document);
	</script>

	<!--[if lt IE 8]>
	<link rel="stylesheet" href="app/public/shop/css/ie-8-1.css" type="text/css" />
	<link rel="stylesheet" href="app/public/shop/css/ie-8-2.css" type="text/css" />
	<![endif]-->

	<!--[if IE 8]>
	<link rel="stylesheet" href="app/public/shop/css/ie-8-3.css" type="text/css" />
	<![endif]-->

	<script type="text/javascript" src="<?=URI::public_path('js/composer.js')?>"></script>
	<script type="text/javascript" src="<?=URI::public_path('js/helper.js')?>"></script>

	<!--[if lt IE 8]>
	<script type="text/javascript" src="app/public/shop/js/ie-8.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
	<script type="text/javascript" src="app/public/shop/js/ie-9.js"></script>
	<![endif]-->

	<script type="text/javascript" src="<?=URI::public_path('js/main.js')?>"></script>
	<style>
		.ticket-form
		{
			width: 30%;
			margin-top: 15%;
			margin-left: auto;
			margin-right: auto;
		}
		select
		{
			width: 100%!important;
			border-radius: 4px;
		}
		textarea {
			resize: none;
			width: 100%!important;
			padding: 10px;
			box-sizing: border-box;
		}
		.btn-ticket
		{
			width: 104%;
			margin-top: 8px;
		}
		input#login, input#password, input#pin
		{
			width: 100%!important;
		}
		#captcha
		{
			border: outset;
			width: 81px;
			/* padding: 5px; */
			margin-top: -9px;
			border-radius: 4px;
		}
		#refresh
		{
			width: 18px!important;
			margin-top: -10px;
		}
		.alert
		{
			width: 87%;
			margin-left: auto;
			margin-right: auto;
		}
	</style>
</head>
<body class="ingame metin2 tr">
<div id="page" class="row-fluid">
	<div id="header" class="header clearfix">
		<div class="span5">
			<h1>
				<a style="background: url(<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>) 0 50% no-repeat;background-size: contain;"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a>
			</h1>
		</div>
	</div><!-- header -->
	<div id="contentContainer">
		<div class="content clearfix">
			<div class="content clearfix" id="wt_refpoint">
				<div class="scrollable_container" style="margin-top: 30px;">
					<div class="inside_scrollable_container">
						<div class="center">
							<form id="loginForm" method="post" action="<?=URI::get_path('login/control')?>" class="ticket-form" autocomplete="off">
								<div id="errorLabel">
								</div>
								<!--USERNAME-->
								<input id="login" type="text" name="login" placeholder="Kullanıcı Adı" maxlength="16" required>
								<!--USERNAME-->
								<!--PASSWORD-->
								<input id="password" type="password" name="password" placeholder="Şifre" required>
								<!--PASSWORD-->
								<!--PIN-->
								<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
									<input id="pin" type="password" name="pin" placeholder="PIN" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required>
								<?php endif;?>
								<!--PIN-->
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "1"): ?>
									<script src='https://www.google.com/recaptcha/api.js'></script>
									<div class="g-recaptcha rc-anchor-blue" data-theme="light" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "2"): ?>
									<script src='https://hcaptcha.com/1/api.js'></script>
									<div class="h-captcha rc-anchor-blue" data-theme="light" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
								<?php endif;?>
								<button class="btn-default btn-ticket" type="submit">Giriş</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="overlayMask"></div>
	</div><!-- close contentContainer -->
</div>
<script>
	$("#loginForm").on('submit',function (e) {
		e.preventDefault();

		var url = $(this).attr('action');
		var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                console.log(response);
                if (response.result)
                {
                    window.location.href = response.login;
				}
				else
				{
				    document.getElementById('errorLabel').innerHTML = '<div class="alert alert-error">' + response.message + '</div>';
                    grecaptcha.reset();
				}
            }
        });
    })
</script>

</body>
</html>
