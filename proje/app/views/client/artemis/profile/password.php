<?php
    $ban = $this->password;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;
?>
<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1125px;">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[141]?></div>
            <div class="panel-body">
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
                <form action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[165]?></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="oldpassword" id="oldpassword" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[166]?></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="newpassword" id="newpassword" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[167]?></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="newpassword2" id="newpassword2" maxlength="30">
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
                            <button type="submit" class="btn btn-giris" style="margin-top: 10px;"> <?=$lng[141]?></button>
                        </div>
                    </div>
                </form>
				<?php endif;?>
            </div>
        </div>
    </div>
</div>