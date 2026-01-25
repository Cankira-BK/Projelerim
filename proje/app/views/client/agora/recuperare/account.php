<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<div class="panel-heading"><h2 class="head"><?=$lng[73]?></h2></div>
            <div class="body">
                <div class="error-holder">
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
                </div>
                <form action="<?=URI::get_path('recuperare/control2')?>" method="post" accept-charset="utf-8" class="page_form" id="RecuperareNotifyOGs">
                    <div class="form-group">
						<label for="email" class="col-sm-3 control-label"><?=$lng[78]?></label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="email" id="email" placeholder="<?=$lng[78]?>">
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
							<button type="submit" name="login_submit" class="btn form-btn"><?=$lng[79]?></button>
						</div>
					</div>
                </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>