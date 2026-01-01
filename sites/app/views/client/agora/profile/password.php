<?php
    $ban = $this->password;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;
?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading"><h2 class="head"><?=$lng[141]?><a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a></h2></div>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="center">
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
                    </div>
                </div>
                <form action="<?=URI::get_path('profile/passwordchange')?>" method="post" id="ProfileNotifyOGs" accept-charset="utf-8" class="page_form">
					<div class="form-group">
						<label for="oldpassword" class="col-sm-3 control-label"><?=$lng[165]?></label>
						<div class="col-sm-7">
							<input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="<?=$lng[165]?>">
						</div>
					</div>
					<div class="form-group">
						<label for="newpassword" class="col-sm-3 control-label"><?=$lng[166]?></label>
						<div class="col-sm-7">
							<input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="<?=$lng[166]?>">
						</div>
					</div>
					<div class="form-group">
						<label for="newpassword2" class="col-sm-3 control-label"><?=$lng[167]?></label>
						<div class="col-sm-7">
							<input type="password" class="form-control" name="newpassword2" id="newpassword2" placeholder="<?=$lng[167]?>">
						</div>
					</div>
					<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') >= 1) {?>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label"></label>
						<div class="col-sm-7">
							<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
							<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
						</div>
					</div>
					<?php }?>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<button type="submit" name="login_submit" class="btn form-btn"><?=$lng[141]?></button>
						</div>
					</div>
                </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>