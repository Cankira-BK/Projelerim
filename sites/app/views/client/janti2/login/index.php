
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
                <?=$lng[21]?> </center>
        </div>
		<style>
		.alert {

			color:white;
		}
		</style>
		            <center >
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
						?> </center>
        <form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST" autocomplete="off" class="form-template">
            <label>Kullanıcı Adı</label>
            <input type="text" placeholder="Hesap Adı (5-15 Karakter Arasında)" name="login" minlength="5" maxlength="15" required="">
            <label>Şifre</label>
            <input type="password" placeholder="Şifre (8-15 Karakter Arasında)" name="password" id="pass">
			<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
            <label>Pin</label>
            <input type="password" placeholder="Pin Şifre (4-4 Karakter Arasında)" name="pin" id="pass">
			<?php endif;?>
            <br>
            <div class="reg-buttons">
                <center>
                    <button class="button-bg button-n" type="submit" name="login_submit"><?=$lng[21]?></button>
                </center>
            </div>
            <br>
            <br>

        </form>
    </div>
</main>