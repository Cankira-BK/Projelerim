<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="padding-left:20px; padding-right:20px;">
                <span class="title"><?=$lng[98]?></span>
                <!-- register -->
                <div class="store-activity">
                    <div class="container_3 account-wide" align="center">
                        <p style="padding: 20px;">
                            <!-- FORMS -->
                        </p>
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
                            <form action="<?=URI::get_path('profile/aktivechange')?>" method="POST">
                                <div class="seperator"></div>
                                <div class="row">
                                    <label for="register-username"><?=$lng[23]?>:</label>
                                    <input type="password" id="password" name="password" maxlength="20" placeholder="Şifre" required>
                                </div>
                                <div class="seperator"></div>
                                <div class="row">
									<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                </div>
                                <div class="row" style="margin-top: 30px;">
                                    <div class="wbuttons wbuttons-buttonBorder">
                                        <input type="submit" value="<?=$lng[104]?>" class="wbuttons wbuttons-bt" AutoCompleteType="None" />
                                    </div>
                                </div>
                            </form>
						<?php endif;?>
                        <br />
                        <br />
                        <br />
                        <!-- FORMS.End -->
                    </div>
                </div>
                <!-- register.End -->
            </div>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>