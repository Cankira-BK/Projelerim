<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1125px;">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[21]?></div>
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
                <form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[22]?> </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="login" id="login" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[23]?></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" id="password" maxlength="30">
                        </div>
                    </div>
					<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">PIN</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>">
                            </div>
                        </div>
					<?php endif;?>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[24]?></label>
                        <div class="col-sm-6">
							<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-giris" style="margin-top: 10px;"> <?=$lng[21]?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>