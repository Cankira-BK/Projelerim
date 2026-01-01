<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="text-align: center; padding-top: 30px; padding-bottom: 30px;">
                <span class="title"><?=$lng[73]?></span>
                <!-- register -->
                <div class="store-activity">
                    <div class="container_3 account-wide" align="center">
                        <p style="padding: 20px;">
                            <!-- FORMS -->
                        </p>
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
                            <form action="<?=URI::get_path('recuperare/control2')?>" id="RecuperareNotifyOGs" method="POST">
                                <div class="seperator"></div>
                                <div class="row">
                                    <label for="register-username"><?=$lng[78]?>:</label>
                                    <input type="text" id="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="seperator"></div>
                                <div class="row">
									<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                </div>
                                <div class="row" style="margin-top: 30px;">
                                    <div class="wbuttons wbuttons-buttonBorder">
                                        <input type="submit" value="<?=$lng[79]?>" class="wbuttons wbuttons-bt" AutoCompleteType="None" />
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