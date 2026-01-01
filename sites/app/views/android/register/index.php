<div class="container material-box">
<div class="one-half-responsive2">
<?php
$cError = Session::get('cError');
if($cError == 'recaptcha'){
	echo Functions::AndroidErrorMessage('error',$lng[39]);
	Session::set('cError',false);
}elseif($cError == 'filter'){
	echo Functions::AndroidErrorMessage('error',$lng[53]);
	Session::set('cError',false);
}elseif($cError == 'empty'){
	echo Functions::AndroidErrorMessage('error',$lng[54]);
	Session::set('cError',false);
}elseif($cError == 'control'){
	echo Functions::AndroidErrorMessage('error',$lng[55]);
	Session::set('cError',false);
}elseif($cError == 'password'){
	echo Functions::AndroidErrorMessage('error',$lng[56]);
	Session::set('cError',false);
}elseif($cError == 'login'){
	echo Functions::AndroidErrorMessage('error',$lng[57]);
	Session::set('cError',false);
}elseif($cError == 'ksk'){
	echo Functions::AndroidErrorMessage('error',$lng[58]);
	Session::set('cError',false);
}elseif($cError == 'phone'){
	echo Functions::AndroidErrorMessage('error',$lng[59]);
	Session::set('cError',false);
}elseif($cError == 'kgs'){
	echo Functions::AndroidErrorMessage('error',$lng[60]);
	Session::set('cError',false);
}elseif($cError == 'pin'){
	echo Functions::AndroidErrorMessage('error',$lng[61]);
	Session::set('cError',false);
}elseif($cError == 'database'){
	echo Functions::AndroidErrorMessage('error',$lng[62]);
	Session::set('cError',false);
}elseif($cError == 'OK'){
	Session::set('cError',false);
	Session::set('redirectRegister',true);
	$login = Session::get('redirectLogin');
	$password = Session::get('redirectPassword');
	$registerToken = $this->hash->create('md5',$login.$password,\StaticDatabase\StaticDatabase::settings('tokenkey'));
	URI::redirect("register/redirect&login=$login&password=$password&token=$registerToken");

}
?>
<h4><?=$lng[42]?></h4>

<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
	<?php echo Functions::AndroidErrorMessage('error',$lng[137]);?>
<?php else:?>
<?php echo Functions::AndroidErrorMessage('info',$lng[43]);?>
<?php echo Functions::AndroidErrorMessage('warning',$lng[44]);?>
<div class="container no-bottom">
<div class="contact-form no-bottom">


<form action="<?=URI::get_path('register/control')?>" method="POST" class="contactForm">
<fieldset>

<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[15]?></b>:</label>
	<input type="text" name="login" maxlength="45" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[16]?></b>:</label>
	<input type="password" name="password" maxlength="64" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[45]?></b>:</label>
	<input type="password" name="password2" maxlength="64" class="contactField requiredField" required autocomplete="off" />
</div>
<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[17]?></b>:</label>
	<input type="password" name="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" class="contactField requiredField" required autocomplete="off" />
</div>
<?php endif;?>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[46]?></b>:</label>
	<input type="email" name="email" maxlength="100" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[47]?></b>:</label>
	<input type="text" name="name" maxlength="30" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[48]?></b>:</label>
	<input type="text" name="ksk" maxlength="7" class="contactField requiredField" required autocomplete="off" />
</div>
<div class="formFieldWrap">
	<label class="field-title contactNameField"><b><?=$lng[49]?></b>:</label>
	<input type="number" name="phone" min="10" max="12" class="contactField requiredField" required autocomplete="off" />
</div>
<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
<div class="formFieldWrap">
	<?php
	$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
	$findMeList->execute();
	?>
    <label class="field-title contactNameField"><b><?=$lng[50]?> </b>:</label>
    <div class="col-sm-5">
        <select name="findme" class="contactField requiredField">
			<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
			<?php endforeach;?>
        </select>
    </div>
</div>
<?php endif;?>
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
<input type="submit" class="buttonWrap button button-green contactSubmitButton" value="<?=$lng[52]?>" />
</div>
</fieldset>
</form>
</div>
</div>
<?php endif;?>
</div>
</div>


