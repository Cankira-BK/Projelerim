<?php
    $ban = $this->password;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;
?>
<div class="title">
	<?=$lng[141]?>
</div>
<div class="news page">
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
        <form action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="POST" class="page_form" autocomplete="off">
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="old_password" id="oldPassword" placeholder="<?=$lng[165]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="<?=$lng[166]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="re_password" id="rePassword" placeholder="<?=$lng[167]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[141]?></button>
                </div>
            </div>
        </form>
	<?php endif;?>
</div>