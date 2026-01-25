<main class="content">
  <section class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <div class="box registration-form">
            <h2><?=$lng[21]?></h2>
            <div class="panel-body">
				<?php
				$cError = Session::get('cError');
				if ($cError == 'OK') {
					echo Client::alert('success','Kayıt işlemi başarılı. Lütfen giriş yapınız!');
					Session::set('cError',false);
				}
				?>
                <form action="<?=URI::get_path('login/control')?>" method="POST" class="form-horizontal" id="LoginNotifyOGs">
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
                            <button type="submit" class="btn btn-danger btn-block" style="margin-top: 10px;"> <?=$lng[21]?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
      </div>
    </div>
  </section>
</main>