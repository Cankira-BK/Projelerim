<div class="row">
    <div class="col-md-9 normal-content">
        <div class="col-md-12 no-padding-all">
            <center><h3><?=$lng[25]?></h3></center>
            <h2 class="brackets"></h2>
        </div>
    <div class="col-md-12">
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
            <form class="form-horizontal" action="<?=URI::get_path('recuperare/control')?>" id="RecuperareNotifyOGs" method="post" >
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[22]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control grunge" name="login" id="login" required/>
                        <i class="fa fa-user form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[78]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control grunge" name="email" id="email" required/>
                        <i class="fa fa-envelope form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[24]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-inline col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-grunge"><?=$lng[79]?></button>
                    </div>
                </div>
            </form>
        <?php endif;?>
    </div>
</div>