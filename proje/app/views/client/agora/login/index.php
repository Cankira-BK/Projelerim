<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<div class="panel-heading"><?=$lng[21]?></div>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="left">
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
                    </div>
                </div>
                <form action="<?=URI::get_path('login/control')?>" method="POST" class="page_form" id="LoginNotifyOGs" autocomplete="off" >
                    <div class="form-group">
                        <label for="login" class="col-sm-3 control-label"><?=$lng[22]?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control2" name="login" id="login" required maxlength="16"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass" class="col-sm-3 control-label"><?=$lng[23]?></label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control2" name="password" id="pass"/>
                        </div>
                    </div>
					<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                        <div class="form-group">
                            <label for="pass" class="col-sm-3 control-label">PIN</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control2" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>"/>
                            </div>
                        </div>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') >= 1) {?>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"></label>
                        <div class="col-sm-12">
							<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
							<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
                        </div>
                    </div>
					<?php }?>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" name="login_submit" class="btn form-btn"><?=$lng[21]?></button>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
</aside>