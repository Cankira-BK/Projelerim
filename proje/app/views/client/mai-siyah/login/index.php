<div class="row">
    <div class="col-md-9 normal-content">
        <div class="col-md-12 no-padding-all">
            <center><h3><?=$lng[21]?></h3></center>
            <h2 class="brackets"></h2>
        </div>
    <?php if (isset($aid)):?>
        <div class="col-md-12">
            <?php
                echo Client::alert('error','Zaten giriş yaptığınız için bu alana giremezsiniz !');
            ?>
        </div>
    <?php else:?>
    <div class="col-md-12">
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
        <form class="form-horizontal" action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="post" >
            <div class="form-group has-feedback">
                <label class="col-sm-4 control-label"><?=$lng[22]?> <span
                            class="text-danger">*</span></label>

                <div class="col-sm-5">
                    <input type="text" class="form-control grunge" name="login" id="login"/>
                    <i class="fa fa-user form-control-feedback"></i>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="regpassword" class="col-sm-4 control-label"><?=$lng[23]?> <span
                            class="text-danger">*</span></label>

                <div class="col-sm-5">
                    <input type="password" class="form-control grunge" name="password" id="password"/>
                    <i class="fa fa-lock form-control-feedback"></i>
                </div>
            </div>
			<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label">PIN <span
                                class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="password" class="form-control grunge" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>"/>
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                </div>
			<?php endif;?>
            <div class="form-group has-feedback">
                <label for="regpassword" class="col-sm-4 control-label"><?=$lng[24]?> <span
                            class="text-danger">*</span></label>

                <div class="col-sm-5">
                    <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="row">
                <div class="form-inline col-sm-offset-4 col-sm-8">
                    <button type="submit" class="btn btn-grunge"><?=$lng[21]?></button>
                </div>
            </div>
        </form>
    </div>
    <?php endif;?>
</div>