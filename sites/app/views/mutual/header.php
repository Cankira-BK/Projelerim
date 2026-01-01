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
	<title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=URL.'favicon.ico'?>">
	<link rel="stylesheet" href="<?=URI::public_path('css/bootstrap.min.css')?>" type="text/css" />
	<link rel="stylesheet" href="<?=URI::public_path('css/font-awesome.min.css')?>" type="text/css" />
	<link rel="stylesheet" id="gameStyle" href="<?=URI::public_path('css/style.min.css')?>" type="text/css" />
	<link rel="stylesheet" href="<?=URI::public_path('css/style.css')?>" type="text/css" />
	<link rel="stylesheet" href="<?=URI::public_path('css/perfect-scrollbar.css')?>" type="text/css" />

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
	<script type="text/javascript" src="<?=URI::public_path('js/perfect-scrollbar.js')?>"></script>
</head>