<?php
$ban = $this->aktive;
$availDt = strtotime($ban['availDt']);
$now = time();
$fark = $availDt - $now;

?>
<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="padding-left:20px; padding-right:20px;">
                <span class="title"><?=$lng[122]?></span>
                <!-- register -->
                <div class="store-activity">
                    <div class="container_3 account-wide" align="center">
                        <p style="padding: 20px;">
                            <!-- FORMS -->
                        </p>
						<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
							<?=Client::alert('error',$lng[112]); ?>
						<?php endif;?>
						<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
							<?php if ($this->aktive['mailaktive'] == 1):?>
								<?php
								$cError = Session::get('cError');
								if($cError == 'recaptcha'){
									echo Client::alert('error',$lng[115]);
									Session::set('cError',false);
								}elseif($cError == 'filter'){
									echo Client::alert('error',$lng[116]);
									Session::set('cError',false);
								}elseif($cError == 'error'){
									echo Client::alert('error',$lng[116]);
									Session::set('cError',false);
								}elseif($cError == 'OK'){
									echo Client::alert('success',$lng[124]);
									Session::set('cError',false);
								} elseif($cError == 'OK3'){
									echo Client::alert('success',$lng[125]);
									Session::set('cError',false);
								}elseif($cError == 'time'){
									$now = date('i');
									$residual = Session::get('residual');
									$kalan = $now - $residual;
									$kalans = 11 - $kalan;
									echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
									Session::set('cError',false);
								}else{
									echo Client::alert('info',$lng[126]);
								}
								?>
                                <form action="<?=URI::get_path('profile/emailchange2')?>" method="POST">
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
                                            <input type="submit" value="<?=$lng[122]?>" class="wbuttons wbuttons-bt" AutoCompleteType="None" />
                                        </div>
                                    </div>
                                </form>
							<?php else:?>
								<?php
								$cError = Session::get('cError');
								if($cError == 'recaptcha'){
									echo Client::alert('error',$lng[115]);
									Session::set('cError',false);
								}elseif($cError == 'filter'){
									echo Client::alert('error',$lng[126]);
									Session::set('cError',false);
								}elseif($cError == 'empty'){
									echo Client::alert('error',$lng[126]);
									Session::set('cError',false);
								}elseif($cError == 'wrong'){
									echo Client::alert('error',$lng[127]);
									Session::set('cError',false);
								}elseif($cError == 'length'){
									echo Client::alert('error',$lng[128]);
									Session::set('cError',false);
								}elseif($cError == 'length2'){
									echo Client::alert('error',$lng[129]);
									Session::set('cError',false);
								}elseif($cError == 'format'){
									echo Client::alert('error',$lng[130]);
									Session::set('cError',false);
								}elseif($cError == 'error'){
									echo Client::alert('error',$lng[131]);
									Session::set('cError',false);
								}elseif($cError == 'OK'){
									echo Client::alert('success',$lng[132]);
									Session::set('cError',false);
								}
								?>
                                <form action="<?=URI::get_path('profile/emailchange')?>" method="POST">
                                    <div class="seperator"></div>
                                    <div class="row">
                                        <label for="register-username"><?=$lng[23]?>:</label>
                                        <input type="password" id="password" name="password" maxlength="20" required>
                                    </div>
                                    <div class="row">
                                        <label for="register-username"><?=$lng[133]?>:</label>
                                        <input type="text" class="form-control grunge" name="newmail" id="newmail" required/>
                                    </div>
                                    <div class="row">
                                        <label for="register-username"><?=$lng[134]?>:</label>
                                        <input type="text" class="form-control grunge" name="newmail2" id="newmail2" required/>
                                    </div>
                                    <div class="seperator"></div>
                                    <div class="row">
										<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </div>
                                    <div class="row" style="margin-top: 30px;">
                                        <div class="wbuttons wbuttons-buttonBorder">
                                            <input type="submit" value="<?=$lng[122]?>" class="wbuttons wbuttons-bt" AutoCompleteType="None" />
                                        </div>
                                    </div>
                                </form>
							<?php endif;?>
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