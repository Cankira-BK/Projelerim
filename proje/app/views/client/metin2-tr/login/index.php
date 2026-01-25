<div role="main">
<div id="login" class="content content-last">
    <div class="content-bg">
        <div class="content-bg-bottom">
            <h2><?=$lng[21]?></h2>
            <div class="inner-form-border">
                <div class="inner-form-box">
                    <h3><a id="topwLost" href="<?=URI::get_path('recuperare')?>"
                           title="Şifreni mi unuttun?"><?=$lng[25]?></a><?=$lng[21]?></h3>
                    <div class="trenner"></div>
					<?php
					$cError = Session::get('cError');
					if ($cError == 'recaptcha') {
						echo Client::alert('error', 'Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.');
						Session::set('cError', false);
					} elseif ($cError == 'filter') {
						echo Client::alert('error', 'Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
						Session::set('cError', false);
					} elseif ($cError == 'empty') {
						echo Client::alert('error', 'Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
						Session::set('cError', false);
					} elseif ($cError == 'error') {
						echo Client::alert('error', 'Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
						Session::set('cError', false);
					} elseif ($cError == 'OK') {
						echo Client::alert('success', 'Kayıt işlemi başarılı. Lütfen giriş yapınız!');
						Session::set('cError', false);
					}
					?>
                    <form name="loginForm" action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST">
                        <div>
                            <label for="username"><?=$lng[22]?>: *</label>
                            <input type="text" id="login" name="login" maxlength="30" value="">
                        </div>
                        <div>
                            <label for="password"><?=$lng[23]?>: *</label>
                            <input type="password" id="password" name="password" maxlength="32" value="">
                        </div>
						<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                            <div>
                                <label for="password">PIN: *</label>
                                <input type="password" id="pin" name="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" value="">
                            </div>
						<?php endif;?>
                        <div>
                            <label for="password"><?=$lng[24]?>: *</label>
                            <script src='https://www.google.com/recaptcha/api.js'></script>
                            <div class="g-recaptcha rc-anchor-dark" style="    transform: scale(0.90);margin-left: -17px;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
                        </div>
                        <input id="submitBtn" class="btn-big" type="submit" name="SubmitLoginForm" value="<?= $lng[21] ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>