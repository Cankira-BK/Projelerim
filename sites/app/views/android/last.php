<?php if ($urlLang[1] != 'register' && $urlLang[1] != 'login' && $urlLang[1] != 'recuperare'):?>
<div class="snap-drawer snap-drawer-right">
<div class="sidebar-header">
<p><img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" class="responsive-image"></p>
</div>
<?php if (isset($_SESSION['aid'])):?>
<ul class="sidebar-navigation">
<li>
<a href="#" class="sidebar-close"><center><?=$lng[94]?></center></a>
</li>
</ul>
<ul class="sidebar-navigation full-bottom">
 <li>
<a href="<?=URI::get_path('profile/password')?>"><i class="fa fa-lock"></i><em><?=$lng[95]?></em></a>
</li>
<li>
<a href="<?=URI::get_path('profile/email')?>"><i class="fa fa-envelope"></i><em><?=$lng[96]?></em></a>
</li>
<li>
<a href="<?=URI::get_path('profile/depo')?>"><i class="fa fa-archive"></i><em><?=$lng[97]?></em></a>
</li>
<li>
<a href="<?=URI::get_path('profile/ksk')?>"><i class="fa fa-eraser"></i><em><?=$lng[98]?></em></a>
</li>
<li>
<a href="<?=URI::get_path('profile/save')?>"><i class="fa fa-bug"></i><em><?=$lng[99]?></em></a>
</li>
<?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
<li>
<a href="<?=URI::get_path('profile/pin')?>"><i class="fa fa-key"></i><em><?=$lng[100]?></em></a>
</li>
<?php endif;?>
<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
<li>
<a href="<?=URI::get_path('profile/iks')?>"><i class="fa fa-shield"></i><em><?=$lng[101]?></em></a>
</li>
<?php endif;?>
<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
<li>
<a href="<?=URI::get_path('profile/hgs')?>"><i class="fa fa-shield"></i><em><?=$lng[102]?></em></a>
</li>
<?php endif;?>
<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
<li>
<a href="<?=URI::get_path('profile/kgs')?>"><i class="fa fa-shield"></i><em><?=$lng[103]?></em></a>
</li>
<?php endif;?>
<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
<li>
<a href="<?=URI::get_path('profile/gpc')?>"><i class="fa fa-unlock"></i><em><?=$lng[104]?></em></a>
</li>
<?php endif;?>

<li>
<a href="<?=URI::get_path('login/logout')?>"><i class="fa fa-sign-out"></i><em><?=$lng[105]?></em></a>
</li>
</ul>
<?php else:?>
<ul class="sidebar-navigation">
<li>
<a href="#" class="sidebar-close"><center><?=$lng[14]?></center></a>
</li>
</ul>
<div class="sidebar-form">
<form action="<?=URI::get_path('login/control')?>" method="POST" class="contactForm">
<fieldset>
<div class="formFieldWrap">
<input type="text" name="login" placeholder="<?=$lng[15]?>" class="contactField requiredField" maxlength="45" required>
</div>
<div class="formFieldWrap">
<input type="password" name="password" placeholder="<?=$lng[16]?>" class="contactField requiredField" maxlength="64" required>
</div>
<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
<div class="formFieldWrap">
<input type="password" name="pin" placeholder="<?=$lng[17]?>" class="contactField requiredField" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required>
</div>
<?php endif;?>
<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') >= 1) {?>
<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "1"): ?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="g-recaptcha" data-theme="light" style="transform:scale(0.90);-webkit-transform:scale(0.90);transform-origin:0 0;-webkit-transform-origin:0 0;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
<?php endif;?>
<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') === "2"): ?>
<script src='https://hcaptcha.com/1/api.js'></script>
<div class="h-captcha" data-theme="light" style="transform:scale(0.90);-webkit-transform:scale(0.90);transform-origin:0 0;-webkit-transform-origin:0 0;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
<?php endif;?>
<?php }?>
<div class="formSubmitButtonErrorsWrap">
<input type="submit" class="buttonWrap button button-green contactSubmitButton" value="<?=$lng[18]?>" />
</div>
</fieldset>
</form>
<ul class="sidebar-navigation">
<li>
<a href="<?=URI::get_path('recuperare')?>"><i class="fa fa-lock"></i><em><?=$lng[19]?></em></a>
</li>
<li>
<a href="<?=URI::get_path('recuperare/account')?>"><i class="fa fa-user"></i><em><?=$lng[20]?></em></a>
</li>
<li>
<a href="<?=URI::get_path('recuperare/pin')?>"><i class="fa fa-key"></i><em><?=$lng[21]?></em></a>
</li>
</ul>
</div>
</div>
<?php endif;?>
</div>
</div>
<?php endif;?>

<div id="content" class="snap-content">
<div class="header material-box">
<a href="#" class="header-nav-left open-left"><i class="fa fa-navicon"></i></a>
<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - <?= \StaticDatabase\StaticDatabase::settings('slogan')?>
<?php if ($urlLang[1] != 'register' && $urlLang[1] != 'login' && $urlLang[1] != 'recuperare'):?>
<a href="#" class="header-nav-right open-right"><i class="fa fa-user"></i></a>
<?php endif;?>
</div>