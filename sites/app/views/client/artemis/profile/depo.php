<?php
    $ban = $this->aktive;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>

<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1125px;">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[111]?></div>
            <div class="panel-body">
				<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
					<?=Client::alert('error',$lng[112]); ?>
				<?php endif;?>
				<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
				<?php if ($this->aktive['mailaktive'] == 0):?>
					<?=Client::alert('error',$lng[113])?>
                    <a href="<?=URI::get_path('profile/aktive')?>" ><button type="submit" class="center-block btn btn-grunge"><?=$lng[114]?></button></a>
				<?php else:?>
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
					echo Client::alert('success',$lng[117]);
					Session::set('cError',false);
				}elseif($cError == 'time'){
					$now = date('i');
					$residual = Session::get('residual');
					$kalan = $now - $residual;
					$kalans = 11 - $kalan;
					echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
					Session::set('cError',false);
				}else{
					echo Client::alert('info',$lng[118]);
				}
				?>
                <form action="<?=URI::get_path('profile/depochange')?>" method="POST" class="form-horizontal">
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
                            <button type="submit" class="btn btn-giris" style="margin-top: 10px;"> <?=$lng[119]?></button>
                        </div>
                    </div>
                </form>
					<?php endif;?>
				<?php endif;?>
            </div>
        </div>
    </div>
</div>