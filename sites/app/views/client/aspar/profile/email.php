<?php
    $ban = $this->aktive;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>
<div class="col-md-9"><div class="col-md-12 no-padding">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[122]?></div>
            <div class="panel-body">
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
							echo Client::alert('success',$lng[123]);
							Session::set('cError',false);
						} elseif($cError == 'OK3'){
							echo Client::alert('success',$lng[124]);
							Session::set('cError',false);
						}elseif($cError == 'time'){
							$now = date('i');
							$residual = Session::get('residual');
							$kalan = $now - $residual;
							$kalans = 11 - $kalan;
							echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
							Session::set('cError',false);
						}else{
							echo Client::alert('info',$lng[125]);
						}
				?>
                <form action="<?=URI::get_path('profile/emailchange2')?>" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[23]?></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" id="password" maxlength="30">
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
                            <button type="submit" class="btn btn-giris" style="margin-top: 10px;"> <?=$lng[122]?></button>
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
                <form action="<?=URI::get_path('profile/emailchange')?>" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[23]?></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" id="password" maxlength="30" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[133]?></label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="newmail" id="newmail" maxlength="60" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[134]?></label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="newmail2" id="newmail2" maxlength="60" required autocomplete="off">
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
                            <button type="submit" class="btn btn-giris" style="margin-top: 10px;"> <?=$lng[122]?></button>
                        </div>
                    </div>
                </form>
					<?php endif; ?>
				<?php endif;?>
            </div>
        </div>
    </div>
</div>