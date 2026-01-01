<div class="title">
	<?=$lng[21]?>
</div>
<div class="news page">
    <?php
				$cError = Session::get('cError');
				if($cError == 'recaptcha'){
					echo Client::alert('error','Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.');
					Session::set('cError',false);
				}elseif($cError == 'filter'){
					echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
					Session::set('cError',false);
				}elseif($cError == 'empty'){
					echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
					Session::set('cError',false);
				} elseif($cError == 'error'){
					echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
					Session::set('cError',false);
				} elseif ($cError == 'OK') {
					echo Client::alert('success','Kayıt işlemi başarılı. Lütfen giriş yapınız!');
					Session::set('cError',false);
				}
				?>
	<form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST" class="page_form" autocomplete="off" >
        <div class="form-group">
            <div class="col-sm-12">
                <input type="text" class="form-control2" name="login" id="login" required placeholder="<?=$lng[22]?>"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <input type="password" class="form-control2" name="password" id="password" placeholder="<?=$lng[23]?>"/>
            </div>
        </div>
		<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="password" class="form-control2" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" placeholder="PIN"/>
                </div>
            </div>
		<?php endif;?>
        <div class="form-group">
            <div class="col-sm-12">
				<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[21]?></button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6" style="margin-left: 25%;">
                <a href="<?=URI::get_path('recuperare/index')?>" class="forum-title" style="float: right;margin-right: 25%">Şifremi Unuttum</a>
                <a href="<?=URI::get_path('recuperare/account')?>" class="forum-title" style="float: left">Kullanıcı Adımı Unuttum</a>
            </div>
        </div>
    </form>
</div>