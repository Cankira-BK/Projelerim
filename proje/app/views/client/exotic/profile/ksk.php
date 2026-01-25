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
                <span class="title"><?=$lng[153]?></span>
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
                                <form action="<?=URI::get_path('profile/kskchange')?>" method="POST">
                                    <div class="seperator"></div>
                                    <div class="row">
                                        <label for="register-username"><?=$lng[23]?>:</label>
                                        <input type="password" id="password" name="password" maxlength="20" placeholder="<?=$lng[23]?>" required>
                                    </div>
                                    <div class="seperator"></div>
                                    <div class="row">
										<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </div>
                                    <div class="row" style="margin-top: 30px;">
                                        <div class="wbuttons wbuttons-buttonBorder">
                                            <input type="submit" value="<?=$lng[156]?>" class="wbuttons wbuttons-bt" AutoCompleteType="None" />
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