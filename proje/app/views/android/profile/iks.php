<?php
    $ban = $this->aktive;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>
<div class="container material-box">
<div class="one-half-responsive2">
<h4><?=$lng[101]?></h4>
<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
	<?=Functions::AndroidErrorMessage('error',$lng[139]); ?>
<?php endif;?>
<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
<?php if ($this->aktive['mailaktive'] == 0):?>
	<?=Functions::AndroidErrorMessage('error',$lng[140])?>
    <a href="<?=URI::get_path('profile/aktive')?>" ><button type="submit" class="center-block btn btn-grunge"><?=$lng[143]?></button></a>
<?php else:?>
<?php
$cError = Session::get('cError');
if($cError == 'recaptcha'){
	echo Functions::AndroidErrorMessage('error',$lng[39]);
	Session::set('cError',false);
}elseif($cError == 'filter'){
	echo Functions::AndroidErrorMessage('error',$lng[153]);
	Session::set('cError',false);
}elseif($cError == 'error'){
	echo Functions::AndroidErrorMessage('error',$lng[153]);
	Session::set('cError',false);
}elseif($cError == 'OK'){
	echo Functions::AndroidErrorMessage('success',$lng[197]);
	Session::set('cError',false);
}elseif($cError == 'time'){
	$now = date('i');
	$residual = Session::get('residual');
	$kalan = $now - $residual;
	$kalans = 11 - $kalan;
	echo Functions::AndroidErrorMessage('error',"".$lng[82]." : $kalans ".$lng[83]."");
	Session::set('cError',false);
}else{
	echo Functions::AndroidErrorMessage('info',$lng[128]);
}
?>
<div class="container no-bottom">
<div class="contact-form no-bottom">


<form action="<?=URI::get_path('profile/ikschange')?>" method="POST" class="contactForm">
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
<input type="submit" class="buttonWrap button button-green contactSubmitButton" value="<?=$lng[129]?>" />
</div>
</fieldset>
</form>
</div>
</div>
<?php endif;?>
<?php endif;?>
</div>
</div>