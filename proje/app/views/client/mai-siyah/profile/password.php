<?php
$ban = $this->password;
$availDt = strtotime($ban['availDt']);
$now = time();
$fark = $availDt - $now;
?>
<div class="col-md-9 normal-content">
    <div class="row">
        <ol class="breadcrumb grunge">
            <li><a href="<?=URI::get_path('index')?>">Anasayfa</a></li>
            <li class="active">Sifre Degistir</li>
        </ol>
    </div>
    <div class="col-md-12">
		<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
			<?=Client::alert('error',$lng[113]); ?>
		<?php endif;?>
		<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
		<?php
		Session::init();
		$cError = Session::get('cError');
		if($cError == 'recaptcha'){
			echo Client::alert('error',$lng[115]);
			Session::set('cError',false);
		}elseif($cError == 'filter'){
			echo Client::alert('error',$lng[160]);
			Session::set('cError',false);
		}elseif($cError == 'empty'){
			echo Client::alert('error',$lng[160]);
			Session::set('cError',false);
		}elseif($cError == 'wrong'){
			echo Client::alert('error',$lng[161]);
			Session::set('cError',false);
		}elseif($cError == 'length'){
			echo Client::alert('error',$lng[128]);
			Session::set('cError',false);
		}elseif($cError == 'length2'){
			echo Client::alert('error',$lng[162]);
			Session::set('cError',false);
		}elseif($cError == 'same'){
			echo Client::alert('error',$lng[163]);
			Session::set('cError',false);
		}elseif($cError == 'error'){
			echo Client::alert('error',$lng[163]);
			Session::set('cError',false);
		}elseif($cError == 'OK'){
			echo Client::alert('success',$lng[164]);
			Session::set('cError',false);
		}
		?>
        <form class="form-horizontal" action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="post" >
            <div class="form-group has-feedback">
                <label for="regpassword" class="col-sm-4 control-label"><?=$lng[165]?> <span
                        class="text-danger">*</span></label>

                <div class="col-sm-5">
                    <input type="password" class="form-control grunge" name="oldpassword" maxlength="16" required>
                    <i class="fa fa-lock form-control-feedback"></i>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="regpassword" class="col-sm-4 control-label"><?=$lng[166]?> <span
                        class="text-danger">*</span></label>

                <div class="col-sm-5">
                    <input type="password" class="form-control grunge" name="newpassword" maxlength="16" required>
                    <i class="fa fa-lock form-control-feedback"></i>
                </div>
            </div>
            <div class="form-group has-feedback">
                <label for="regpassword" class="col-sm-4 control-label"><?=$lng[167]?> <span
                        class="text-danger">*</span></label>

                <div class="col-sm-5">
                    <input type="password" class="form-control grunge" name="newpassword2" maxlength="16" required>
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
                    <button type="submit" class="btn btn-grunge"><?=$lng[141]?></button>
                </div>
            </div>
        </form>
		<?php endif;?>
    </div>
</div>