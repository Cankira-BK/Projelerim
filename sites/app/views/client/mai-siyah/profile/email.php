<?php
$ban = $this->aktive;
$availDt = strtotime($ban['availDt']);
$now = time();
$fark = $availDt - $now;

?>
<div class="col-md-9 normal-content">
    <div class="row">
        <ol class="breadcrumb grunge">
            <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
            <li class="active"><?=$lng[122]?></li>
        </ol>
    </div>
    <div class="col-md-12">
		<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
			<?=Client::alert('error',$lng[112]); ?>
		<?php endif;?>
		<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
		<?php if ($this->aktive['mailaktive'] == 1):?>
			<?php
			$cError = Session::get('cError');
			if($cError == 'recaptcha'){
				echo Client::alert('error',$lng[115]);
				Session::set('cError',false);
			}elseif($cError == 'filter'){
				echo Client::alert('error',$lng[116]);
				Session::set('cError',false);
			}elseif($cError == 'error'){
				echo Client::alert('error',$lng[116]);
				Session::set('cError',false);
			}elseif($cError == 'OK'){
				echo Client::alert('success',$lng[124]);
				Session::set('cError',false);
			} elseif($cError == 'OK3'){
				echo Client::alert('success',$lng[125]);
				Session::set('cError',false);
			}elseif($cError == 'time'){
				$now = date('i');
				$residual = Session::get('residual');
				$kalan = $now - $residual;
				$kalans = 11 - $kalan;
				echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
				Session::set('cError',false);
			}else{
				echo Client::alert('info',$lng[126]);
			}
			?>
            <form class="form-horizontal" action="<?=URI::get_path('profile/emailchange2')?>" method="post" >
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[23]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="password" class="form-control grunge" name="password" id="password"/>
                        <i class="fa fa-lock form-control-feedback"></i>
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
                        <button type="submit" class="btn btn-grunge"><?=$lng[122]?></button>
                    </div>
                </div>
            </form>
        <?php else:?>
				<?php
				$cError = Session::get('cError');
				if($cError == 'recaptcha'){
					echo Client::alert('error',$lng[115]);
					Session::set('cError',false);
				}elseif($cError == 'filter'){
					echo Client::alert('error',$lng[126]);
					Session::set('cError',false);
				}elseif($cError == 'empty'){
					echo Client::alert('error',$lng[126]);
					Session::set('cError',false);
				}elseif($cError == 'wrong'){
					echo Client::alert('error',$lng[127]);
					Session::set('cError',false);
				}elseif($cError == 'length'){
					echo Client::alert('error',$lng[128]);
					Session::set('cError',false);
				}elseif($cError == 'length2'){
					echo Client::alert('error',$lng[129]);
					Session::set('cError',false);
				}elseif($cError == 'format'){
					echo Client::alert('error',$lng[130]);
					Session::set('cError',false);
				}elseif($cError == 'error'){
					echo Client::alert('error',$lng[131]);
					Session::set('cError',false);
				}elseif($cError == 'OK'){
					echo Client::alert('success',$lng[132]);
					Session::set('cError',false);
				}
				?>
            <form class="form-horizontal" action="<?=URI::get_path('profile/emailchange')?>" method="post" >
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[23]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="password" class="form-control grunge" name="password" id="password" required/>
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[133]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="email" class="form-control grunge" name="newmail" id="newmail" required/>
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[134]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="email" class="form-control grunge" name="newmail2" id="newmail2" required/>
                        <i class="fa fa-lock form-control-feedback"></i>
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
                        <button type="submit" class="btn btn-grunge"><?=$lng[122]?></button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>