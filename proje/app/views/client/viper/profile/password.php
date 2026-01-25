<?php
    $ban = $this->password;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;
?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[141]?> </center>
        </div>
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
            <form action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="post" accept-charset="utf-8" class="page_form" autocomplete="off">
                <label><?=$lng[165]?></label>
                <input id="oldPassword" type="password" class="form-control" name="old_password" placeholder="<?=$lng[165]?>">

                <label><?=$lng[166]?></label>
                <input id="newPassword" type="password" class="form-control" name="new_password" placeholder="<?=$lng[166]?>">

                <label><?=$lng[167]?></label>
                <input id="rePassword" type="password" class="form-control" name="re_password" placeholder="<?=$lng[167]?>">
                <br>
				<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                <br>
                <br>
                <div class="reg-buttons">
                    <center>
                        <button class="button-bg button-n" type="submit"><?=$lng[141]?></button>
                    </center>
                </div>
                <br>
            </form>
			<?php endif;?>
        </div>
    </div>
</main>