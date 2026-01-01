<div class="container material-box">
<div class="one-half-responsive2">
<?php
Session::init();
$cError = Session::get('cError');
if($cError == 'recaptcha'){
	echo Functions::AndroidErrorMessage('error',$lng[39]);
	Session::set('cError',false);
}elseif($cError == 'filter'){
	echo Functions::AndroidErrorMessage('error',$lng[81]);
	Session::set('cError',false);
}elseif($cError == 'empty'){
	echo Functions::AndroidErrorMessage('error',$lng[81]);
	Session::set('cError',false);
} elseif($cError == 'error'){
	echo Functions::AndroidErrorMessage('error',$lng[81]);
	Session::set('cError',false);
} elseif($cError == 'time'){
	$now = date('i');
	$residual = Session::get('residual');
	$kalan = $now - $residual;
	$kalans = 10 - $kalan;
	echo Functions::AndroidErrorMessage('warning'," ".$lng[82]." : $kalans ".$lng[83]);
	Session::set('cError',false);
} elseif($cError == 'OK'){
	echo Functions::AndroidErrorMessage('success',$lng[85]);
	Session::set('cError',false);
}
?>
<h4><?=$lng[20]?></h4>

<div class="container no-bottom">
<div class="contact-form no-bottom">

<?php if (isset($aid)):?>
<?php echo Functions::AndroidErrorMessage('error',$lng[79]);?>
<?php else:?>
<form action="<?=URI::get_path('recuperare/control2')?>" method="POST" class="contactForm">
<fieldset>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[46]?></b>:</label>
	<input type="email" name="email" maxlength="100" class="contactField requiredField" required autocomplete="off" />
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
<input type="submit" class="buttonWrap button button-green contactSubmitButton" value="<?=$lng[80]?>" />
</div>
</fieldset>
</form>
<?php endif;?>
</div>
</div>
</div>
</div>
