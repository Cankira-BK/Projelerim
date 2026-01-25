<?php
    $ban = $this->aktive;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <h2 class="head"><?=$lng[122]?><a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a></h2>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="left">
						<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
							<?=Functions::alert('error',$lng[112]); ?>
						<?php endif;?>
						<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
						<?php if ($this->aktive['mailaktive'] == 1):?>
						<?php
						$cError = Session::get('cError');
						if($cError == 'recaptcha'){
							echo Functions::alert('error',$lng[115]);
							Session::set('cError',false);
						}elseif($cError == 'filter'){
							echo Functions::alert('error',$lng[116]);
							Session::set('cError',false);
						}elseif($cError == 'error'){
							echo Functions::alert('error',$lng[116]);
							Session::set('cError',false);
						}elseif($cError == 'OK'){
							echo Functions::alert('success',$lng[123]);
							Session::set('cError',false);
						} elseif($cError == 'OK3'){
							echo Functions::alert('success',$lng[124]);
							Session::set('cError',false);
						}elseif($cError == 'time'){
							$now = date('i');
							$residual = Session::get('residual');
							$kalan = $now - $residual;
							$kalans = 11 - $kalan;
							echo Functions::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
							Session::set('cError',false);
						}else{
							echo Functions::alert('info',$lng[125]);
						}
						?>
                    </div>
                </div>
                <form action="<?=URI::get_path('profile/emailchange2')?>" method="post" accept-charset="utf-8" class="page_form">
                    <table style="width:500px;">
                        <tr>
                            <td><label for="account_password"><?=$lng[23]?> :</label></td>
                            <td>
                                <span class="warfg_input" style=""><input type="password" name="password" value="" placeholder="<?=$lng[23]?>"></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="account_password"><?=$lng[24]?> :</label></td>
                            <td>
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 0) {echo $this->captcha->simple()->call(); echo '<br><input name="captcha" type="password">';}?>
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <span class="warfg_btn"><input type="submit" name="login_submit" value="<?=$lng[122]?>"></span>
                            </td>
                        </tr>
                    </table>
                </form>
				<?php else:?>
					<?php
					$cError = Session::get('cError');
					if($cError == 'recaptcha'){
						echo Functions::alert('error',$lng[115]);
						Session::set('cError',false);
					}elseif($cError == 'filter'){
						echo Functions::alert('error',$lng[126]);
						Session::set('cError',false);
					}elseif($cError == 'empty'){
						echo Functions::alert('error',$lng[126]);
						Session::set('cError',false);
					}elseif($cError == 'wrong'){
						echo Functions::alert('error',$lng[127]);
						Session::set('cError',false);
					}elseif($cError == 'length'){
						echo Functions::alert('error',$lng[128]);
						Session::set('cError',false);
					}elseif($cError == 'length2'){
						echo Functions::alert('error',$lng[129]);
						Session::set('cError',false);
					}elseif($cError == 'format'){
						echo Functions::alert('error',$lng[130]);
						Session::set('cError',false);
					}elseif($cError == 'error'){
						echo Functions::alert('error',$lng[131]);
						Session::set('cError',false);
					}elseif($cError == 'OK'){
						echo Functions::alert('success',$lng[132]);
						Session::set('cError',false);
					}
					?>
                    <form action="<?=URI::get_path('profile/emailchange')?>" method="post" accept-charset="utf-8" class="page_form">
                        <table style="width:500px;">
                            <tr>
                                <td style="width: 150px;">
                                    <label class="register-input" for="register-email"><?=$lng[23]?>:</label>
                                </td>
                                <td>
                                    <input type="password" id="password" name="password" required>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 150px;">
                                    <label class="register-input" for="register-email"><?=$lng[133]?>:</label>
                                </td>
                                <td>
                                    <input type="email" class="form-control grunge" name="newmail" id="newmail" required/>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 150px;">
                                    <label class="register-input" for="register-email"><?=$lng[134]?>:</label>
                                </td>
                                <td>
                                    <input type="email" class="form-control grunge" name="newmail2" id="newmail2" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="register-input" for="register-email" style="margin-top: -23px;"><?=$lng[24]?>:</label>
                                </td>
                                <td>
									<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 0) {echo $this->captcha->simple()->call(); echo '<br><input name="captcha" type="password">';}?>
									<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
									<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <span class="warfg_btn"><input type="submit" name="login_submit" value="<?=$lng[122]?>"></span>
                                </td>
                            </tr>
                        </table>
                    </form>
				<?php endif; ?>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>