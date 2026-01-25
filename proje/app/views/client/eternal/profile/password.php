<?php
    $ban = $this->password;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;
?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <h2 class="head"><?=$lng[141]?><a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a></h2>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="left">
						<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
							<?=Functions::alert('error',$lng[113]); ?>
						<?php endif;?>
						<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
						<?php
						Session::init();
						$cError = Session::get('cError');
						if($cError == 'recaptcha'){
							echo Functions::alert('error',$lng[115]);
							Session::set('cError',false);
						}elseif($cError == 'filter'){
							echo Functions::alert('error',$lng[160]);
							Session::set('cError',false);
						}elseif($cError == 'empty'){
							echo Functions::alert('error',$lng[160]);
							Session::set('cError',false);
						}elseif($cError == 'wrong'){
							echo Functions::alert('error',$lng[161]);
							Session::set('cError',false);
						}elseif($cError == 'length'){
							echo Functions::alert('error',$lng[128]);
							Session::set('cError',false);
						}elseif($cError == 'length2'){
							echo Functions::alert('error',$lng[162]);
							Session::set('cError',false);
						}elseif($cError == 'same'){
							echo Functions::alert('error',$lng[163]);
							Session::set('cError',false);
						}elseif($cError == 'error'){
							echo Functions::alert('error',$lng[163]);
							Session::set('cError',false);
						}elseif($cError == 'OK'){
							echo Functions::alert('success',$lng[164]);
							Session::set('cError',false);
						}
						?>
                    </div>
                </div>
                <form action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="post" accept-charset="utf-8" class="page_form">
                    <table style="width:500px;">
                        <tr>
                            <td><label for="account_password"><?=$lng[165]?> :</label></td>
                            <td>
                                <span class="warfg_input" style=""><input type="password" name="oldpassword" maxlength="16" placeholder="<?=$lng[165]?>"></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="account_password"><?=$lng[166]?> :</label></td>
                            <td>
                                <span class="warfg_input" style=""><input type="password" name="newpassword" maxlength="16" placeholder="<?=$lng[166]?>"></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="account_password"><?=$lng[167]?> :</label></td>
                            <td>
                                <span class="warfg_input" style=""><input type="password" name="newpassword2" maxlength="16" placeholder="<?=$lng[167]?>"></span>
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
                                <span class="warfg_btn"><input type="submit" name="login_submit" value="<?=$lng[141]?>"></span>
                            </td>
                        </tr>
                    </table>
                </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>