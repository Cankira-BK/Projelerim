<div role="main">
    <div id="login" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2><?=$lng[98]?></h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <div class="trenner"></div>
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
                        <form name="loginForm" action="<?=URI::get_path('profile/aktivechange')?>" method="POST">
                            <div>
                                <label for="password"><?=$lng[23]?>: *</label>
                                <input type="password" id="password" name="password" maxlength="32" value="">
                            </div>
                            <div>
                                <label for="password"><?=$lng[24]?>: *</label>
                                <script src='https://www.google.com/recaptcha/api.js'></script>
                                <div class="g-recaptcha rc-anchor-dark" style="    transform: scale(0.90);margin-left: -17px;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
                            </div>
                            <input id="submitBtn" class="btn-big" type="submit" name="SubmitLoginForm" value="<?= $lng[104] ?>">
                        </form>
						<?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>