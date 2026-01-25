<div role="main">
    <div id="login" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2><?=$lng[25]?></h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <div class="trenner"></div>
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
                        <form name="loginForm" action="<?=URI::get_path('recuperare/control')?>" id="RecuperareNotifyOGs" method="POST">
                            <div>
                                <label for="login"><?=$lng[22]?>: *</label>
                                <input type="text" id="login" name="login"">
                            </div>
                            <div>
                                <label for="email"><?=$lng[78]?>: *</label>
                                <input type="text" id="email" name="email">
                            </div>
                            <div>
                                <label for="password"><?=$lng[24]?>: *</label>
                                <script src='https://www.google.com/recaptcha/api.js'></script>
                                <div class="g-recaptcha rc-anchor-dark" style="    transform: scale(0.90);margin-left: -17px;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
                            </div>
                            <input id="submitBtn" class="btn-big" type="submit" name="SubmitLoginForm" value="<?= $lng[79] ?>">
                        </form>
						<?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>