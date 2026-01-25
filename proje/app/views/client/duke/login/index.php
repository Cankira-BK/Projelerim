<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[21]?> </center>
        </div>
        <div class="panel-body">
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
			<form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST" autocomplete="off" class="form-template">
                <label><?=$lng[22]?></label>
                <input type="text" placeholder="<?=$lng[22]?>" name="login" id="login" maxlength="16" required>

                <label><?=$lng[23]?></label>
                <input type="password" placeholder="<?=$lng[23]?>" name="password" id="password" required>

				<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                    <label>PIN</label>
                    <input type="password" placeholder="PIN" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required>
				<?php endif;?>

                <label><?=$lng[24]?></label>
				<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>

                <br>
                <div class="reg-buttons">
                    <center>
                        <button class="button-bg button-n" type="submit" name="login_submit"><?=$lng[21]?></button>
                    </center>
                </div>
                <br>

            </form>
        </div>
    </div>
</main>