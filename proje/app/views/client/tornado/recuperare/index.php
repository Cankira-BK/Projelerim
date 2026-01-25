<div class="title">
	<?=$lng[25]?>
</div>
<div class="news page">
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
        <form action="<?=URI::get_path('recuperare/control')?>" id="RecuperareNotifyOGs" method="post" accept-charset="utf-8" class="page_form" autocomplete="off">
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="login" id="login" placeholder="<?=$lng[22]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="email" class="form-control" name="email" id="email" placeholder="<?=$lng[78]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[79]?></button>
                </div>
            </div>
        </form>
	<?php endif;?>
</div>