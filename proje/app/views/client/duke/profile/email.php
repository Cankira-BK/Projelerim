<?php
    $ban = $this->aktive;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[122]?> </center>
        </div>
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
                <form action="<?=URI::get_path('profile/emailchange2')?>" method="POST" class="page_form" autocomplete="off">
                    <label><?=$lng[23]?></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="<?=$lng[23]?>">
                    <br>
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                    <br>
                    <br>
                    <div class="reg-buttons">
                        <center>
                            <button class="button-bg button-n" type="submit"><?=$lng[122]?></button>
                        </center>
                    </div>
                    <br>
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
                <form action="<?=URI::get_path('profile/emailchange')?>" method="POST" class="page_form" autocomplete="off" >
                    <label><?=$lng[23]?></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="<?=$lng[23]?>">

                    <label><?=$lng[133]?></label>
                    <input id="newMail" type="email" class="form-control" name="new_mail" placeholder="<?=$lng[133]?>">

                    <label><?=$lng[134]?></label>
                    <input id="reMail" type="email" class="form-control" name="re_mail" placeholder="<?=$lng[134]?>">
                    <br>
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                    <br>
                    <br>
                    <div class="reg-buttons">
                        <center>
                            <button class="button-bg button-n" type="submit"><?=$lng[122]?></button>
                        </center>
                    </div>
                </form>
			<?php endif;?>
			<?php endif;?>
        </div>
    </div>
</main>