<div class="title">
	<?=$lng[98]?>
</div>
<div class="news page">
	<?php if ($this->aktive == 1):?>
					<?=Client::alert('info',$lng[99])?>
				<?php else:?>
				<?php
				Session::init();
				$cError = Session::get('cError');
				if($cError == 'recaptcha'){
					echo Client::alert('error',$lng[100]);
					Session::set('cError',false);
				}elseif($cError == 'filter'){
					echo Client::alert('error',$lng[101]);
					Session::set('cError',false);
				}elseif($cError == 'got'){
					echo Client::alert('error','Daha önce depo şifresi değiştirme talebinde bulunmuşsunuz. Lütfen mail adresinizi kontrol ediniz.');
					Session::set('cError',false);
				}elseif($cError == 'OK'){
					echo Client::alert('success',$lng[102]);
					Session::set('cError',false);
				}elseif($cError == 'time'){
					$now = date('i');
					$residual = Session::get('residual');
					$kalan = $now - $residual;
					$kalans = 11 - $kalan;
					echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
					Session::set('cError',false);
				}else{
					echo Client::alert('info',$lng[103]);
				}
				?>
        <form action="<?=URI::get_path('profile/aktivechange')?>" method="post" accept-charset="utf-8" class="page_form">
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" id="password" class="form-control" name="password" placeholder="<?=$lng[23]?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[104]?></button>
                </div>
            </div>
        </form>
	<?php endif;?>
</div>