<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[73]?> </center>
        </div>
        <div class="panel-body">
            <div class="container_3 red wide fading-notification" align="center">
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
					echo Client::alert('success',$lng[77]);
					Session::set('cError',false);
				}
				?>
            </div>
            <form action="<?=URI::get_path('recuperare/control2')?>" id="RecuperareNotifyOGs" method="post" class="page_form" autocomplete="off">
                <label><?=$lng[78]?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="<?=$lng[78]?>">
                <br>
				<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                <br>
                <br>
                <div class="reg-buttons">
                    <center>
                        <button class="button-bg button-n" type="submit"><?=$lng[79]?></button>
                    </center>
                </div>
                <br>
            </form>
			<?php endif;?>
        </div>
    </div>
</main>