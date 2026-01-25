<?php if (isset($aid)):?>
<div class="container material-box">
<div class="one-half-responsive2">
<h4><?=$lng[136]?></h4>
<?php echo Functions::AndroidErrorMessage('error',$lng[79]);?>
</div>
</div>
<?php else:?>
<div id="content" class="snap-content">
<div class="coverpage coverpage-bg1">
<div class="loginbox-wrapper">
<div class="loginbox">
<?php
$cError = Session::get('cError');
if($cError == 'recaptcha'){
	echo Functions::AndroidErrorMessage('error',$lng[39]);
	Session::set('cError',false);
}elseif($cError == 'filter'){
	echo Functions::AndroidErrorMessage('error',$lng[40]);
	Session::set('cError',false);
}elseif($cError == 'empty'){
	echo Functions::AndroidErrorMessage('error',$lng[40]);
	Session::set('cError',false);
} elseif($cError == 'error'){
	echo Functions::AndroidErrorMessage('error',$lng[40]);
	Session::set('cError',false);
} elseif ($cError == 'OK') {
	echo Functions::AndroidErrorMessage('success',$lng[41]);
	Session::set('cError',false);
} elseif (Session::get('redirectRegister') == true) {
	echo Functions::AndroidErrorMessage('success',$lng[63]);
	Session::set('redirectRegister',false);
}
?>
<h2 class="center-text"><?=$lng[14]?></h2>
<form action="<?=URI::get_path('login/control')?>" method="POST">
<input class="loginbox-username" type="text" name="login" placeholder="<?=$lng[15]?>" maxlength="45" required>
<input class="loginbox-password" type="password" name="password" placeholder="<?=$lng[16]?>" maxlength="64" required>
<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
<input class="loginbox-password" type="password" name="pin" placeholder="<?=$lng[17]?>" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required>
<?php endif;?>
<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') >= 1) {?>
<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "1"): ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="g-recaptcha" data-theme="light" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
<?php endif;?>
<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "2"): ?>
<script src='https://hcaptcha.com/1/api.js'></script>
<div class="h-captcha" data-theme="light" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
<?php endif;?>
<?php }?>
<input type="submit" class="button button-green" value="<?=$lng[18]?>" />
</form>
<em><?=$lng[37]?> <a href="<?=URI::get_path('register')?>"><?=$lng[38]?></a></em>
</div>
</div>
</div>
</div>
<?php endif;?>