<?php
    $ban = $this->password;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>
<div class="container material-box">
<div class="one-half-responsive2">
<h4><?=$lng[95]?></h4>
<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
	<?=Functions::AndroidErrorMessage('error',$lng[139]); ?>
<?php endif;?>
<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
<?php
Session::init();
$cError = Session::get('cError');
if($cError == 'recaptcha'){
	echo Functions::AndroidErrorMessage('error',$lng[115]);
	Session::set('cError',false);
}elseif($cError == 'filter'){
	echo Functions::AndroidErrorMessage('error',$lng[157]);
	Session::set('cError',false);
}elseif($cError == 'empty'){
	echo Functions::AndroidErrorMessage('error',$lng[157]);
	Session::set('cError',false);
}elseif($cError == 'wrong'){
	echo Functions::AndroidErrorMessage('error',$lng[158]);
	Session::set('cError',false);
}elseif($cError == 'length'){
	echo Functions::AndroidErrorMessage('error',$lng[150]);
	Session::set('cError',false);
}elseif($cError == 'length2'){
	echo Functions::AndroidErrorMessage('error',$lng[159]);
	Session::set('cError',false);
}elseif($cError == 'same'){
	echo Functions::AndroidErrorMessage('error',$lng[160]);
	Session::set('cError',false);
}elseif($cError == 'error'){
	echo Functions::AndroidErrorMessage('error',$lng[160]);
	Session::set('cError',false);
}elseif($cError == 'OK'){
	echo Functions::AndroidErrorMessage('success',$lng[161]);
	Session::set('cError',false);
}
?>
<div class="container no-bottom">
<div class="contact-form no-bottom">


<form action="<?=URI::get_path('profile/passwordchange')?>" method="POST" class="contactForm">
<fieldset>

<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[118]?></b>:</label>
	<input type="password" name="password" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[119]?></b>:</label>
	<input type="password" name="password" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[120]?></b>:</label>
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
<input type="submit" class="buttonWrap button button-green contactSubmitButton" value="<?=$lng[95]?>" />
</div>
</fieldset>
</form>
</div>
</div>
<?php endif;?>
</div>
</div>