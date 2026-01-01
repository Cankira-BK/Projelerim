<main class="content">
  <section class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <div class="box registration-form">
            <h2><?=$lng[25]?></h2>
            <div class="panel-body">
				<?php if (isset($aid)):?>
					<?php
					echo Client::alert('error',$lng[74]);
					?>
				<?php else:?>
				<?php
				Session::init();
				$cError = Session::get('cError');
				if($cError == 'recaptcha'){
					echo Client::alert('error',$lng[75]);
					Session::set('cError',false);
				}elseif($cError == 'filter'){
					echo Client::alert('error',$lng[76]);
					Session::set('cError',false);
				}elseif($cError == 'empty'){
					echo Client::alert('error',$lng[76]);
					Session::set('cError',false);
				} elseif($cError == 'error'){
					echo Client::alert('error',$lng[76]);
					Session::set('cError',false);
				} elseif($cError == 'time'){
					$now = date('i');
					$residual = Session::get('residual');
					$kalan = $now - $residual;
					$kalans = 10 - $kalan;
					echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
					Session::set('cError',false);
				} elseif($cError == 'OK'){
					echo Client::alert('success',$lng[80]);
					Session::set('cError',false);
				}
				?>
                <form action="<?=URI::get_path('recuperare/control')?>" method="POST" class="form-horizontal" id="RecuperareNotifyOGs">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[22]?> </label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="login" id="login" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[78]?></label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="email" id="email" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[24]?></label>
                        <div class="col-sm-6">
							<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-danger btn-block" style="margin-top: 10px;"> <?=$lng[79]?></button>
                        </div>
                    </div>
                </form>
				<?php endif;?>
            </div>
        </div>
        </div>
      </div>
    </div>
  </section>
</main>