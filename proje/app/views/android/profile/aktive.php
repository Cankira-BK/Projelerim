<div class="container material-box">
<div class="one-half-responsive2">
<h4><?=$lng[178]?></h4>
<?php if ($this->aktive == 1):?>
	<?=Functions::AndroidErrorMessage('info',$lng[174])?>
<?php else:?>
<?php
Session::init();
$cError = Session::get('cError');
if($cError == 'recaptcha'){
	echo Functions::AndroidErrorMessage('error',$lng[39]);
	Session::set('cError',false);
}elseif($cError == 'filter'){
	echo Functions::AndroidErrorMessage('error',$lng[153]);
	Session::set('cError',false);
}elseif($cError == 'got'){
	echo Functions::AndroidErrorMessage('error',$lng[177]);
	Session::set('cError',false);
}elseif($cError == 'OK'){
	echo Functions::AndroidErrorMessage('success',$lng[175]);
	Session::set('cError',false);
}elseif($cError == 'time'){
	$now = date('i');
	$residual = Session::get('residual');
	$kalan = $now - $residual;
	$kalans = 11 - $kalan;
	echo Functions::AndroidErrorMessage('error',"".$lng[82]." : $kalans ".$lng[83]."");
	Session::set('cError',false);
}else{
	echo Functions::AndroidErrorMessage('info',$lng[176]);
}
?>
<div class="container no-bottom">
<div class="contact-form no-bottom">


<form action="<?=URI::get_path('profile/aktivechange')?>" method="POST" class="contactForm">
<fieldset>

<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[118]?></b>:</label>
	<input type="password" name="password" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[51]?></b>:</label>
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
</div>
<br>
<div class="formSubmitButtonErrorsWrap">
<input type="submit" class="buttonWrap button button-green contactSubmitButton" value="<?=$lng[179]?>" />
</div>
</fieldset>
</form>
</div>
</div>
<?php endif;?>
</div>
</div>