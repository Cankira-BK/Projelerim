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
				<?=$lng[153]?> </center>
        </div>
        <div class="panel-body">
			<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
					<?=Client::alert('error',$lng[112]); ?>
				<?php endif;?>
				<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
				<?php if ($this->aktive['mailaktive'] == 0):?>
					<?=Client::alert('error',$lng[113])?>
                    <a href="<?=URI::get_path('profile/aktive')?>" ><button type="submit" class="center-block btn btn-grunge"><?=$lng[98]?></button></a>
				<?php else:?>
				<?php
				$cError = Session::get('cError');
				if($cError == 'recaptcha'){
					echo Client::alert('error',$lng[115]);
					Session::set('cError',false);
				}elseif($cError == 'filter'){
					echo Client::alert('error',$lng[101]);
					Session::set('cError',false);
				}elseif($cError == 'error'){
					echo Client::alert('error',$lng[101]);
					Session::set('cError',false);
				}elseif($cError == 'OK'){
					echo Client::alert('success',$lng[154]);
					Session::set('cError',false);
				}elseif($cError == 'time'){
					$now = date('i');
					$residual = Session::get('residual');
					$kalan = $now - $residual;
					$kalans = 11 - $kalan;
					echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
					Session::set('cError',false);
				}else{
					echo Client::alert('info',$lng[155]);
				}
				?>
            <form action="<?=URI::get_path('profile/kskchange')?>" method="POST" class="page_form" autocomplete="off" >
                <label><?=$lng[23]?></label>
                <input id="password" type="password" class="form-control" name="password" placeholder="<?=$lng[23]?>">
                <br>
				<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                <br>
                <br>
                <div class="reg-buttons">
                    <center>
                        <button class="button-bg button-n" type="submit"><?=$lng[156]?></button>
                    </center>
                </div>
                <br>
            </form>
            <?php endif;?>
            <?php endif;?>
        </div>
    </div>
</main>