<div class="container material-box">
<div class="one-half-responsive2">
<h4><?=$lng[96]?></h4>
<?php if($this->response['result'] == false): ?>
	<?php echo Functions::AndroidErrorMessage('error',$lng[86]);?>
<?php elseif ($this->response['result'] == true):?>
<?php echo Functions::AndroidErrorMessage('info',$lng[171]);?>
<div class="container no-bottom">
<div class="contact-form no-bottom">


<form action="<?=URI::get_path('profile/emailchange3')?>" method="POST" class="contactForm">
<fieldset>

<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[118]?></b>:</label>
	<input type="password" name="password" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[146]?></b>:</label>
	<input type="text" name="newmail" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[147]?></b>:</label>
	<input type="text" name="newmail2" class="contactField requiredField" required autocomplete="off" />
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
<input type="submit" class="buttonWrap button button-green contactSubmitButton" value="<?=$lng[96]?>" />
</div>
</fieldset>
</form>
</div>
</div>
<?php endif;?>
</div>
</div>