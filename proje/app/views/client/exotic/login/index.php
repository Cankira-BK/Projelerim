<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="padding-left:20px; padding-right:20px;">
                <span class="title"><?=$lng[21]?></span>
                <div class="store-activity">
                    <div class="container_3 account-wide" align="center">
                        <p style="padding: 20px;">
                            <!-- FORMS -->
                        </p>
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
                        <form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST">
                            <div class="seperator"></div>
                            <div class="row">
                                <label for="register-username"><?=$lng[22]?>:</label>
                                <input type="text" class="form-control grunge" name="login" id="login" required maxlength="16" onkeypress="return textonly(event,'#login')"/>
                            </div>
                            <div class="row">
                                <label for="register-password"><?=$lng[23]?>:</label>
                                <input type="password" class="form-control grunge" name="password" id="pass"/>
                            </div>
							<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                <div class="row">
                                    <label for="register-password">PIN:</label>
                                    <input type="password" class="form-control grunge" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>"/>
                                </div>
							<?php endif;?>
                            <div class="seperator"></div>
                            <div class="row">
								<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="wbuttons wbuttons-buttonBorder">
                                    <input type="submit" value="<?=$lng[24]?>" class="wbuttons wbuttons-bt" AutoCompleteType="None" />
                                </div>
                            </div>
                        </form>
                        <br />
                        <br />
                        <br />
                        <!-- FORMS.End -->
                    </div>
                </div>
            </div>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>