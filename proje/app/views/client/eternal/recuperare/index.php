<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <h2 class="head"><?=$lng[25]?></h2>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="left">
						<?php if (isset($aid)):?>
							<?php
							echo Functions::alert('error',$lng[74]);
							?>
						<?php else:?>
						<?php
						Session::init();
						$cError = Session::get('cError');
						if($cError == 'recaptcha'){
							echo Functions::alert('error',$lng[75]);
							Session::set('cError',false);
						}elseif($cError == 'filter'){
							echo Functions::alert('error',$lng[76]);
							Session::set('cError',false);
						}elseif($cError == 'empty'){
							echo Functions::alert('error',$lng[76]);
							Session::set('cError',false);
						} elseif($cError == 'error'){
							echo Functions::alert('error',$lng[76]);
							Session::set('cError',false);
						} elseif($cError == 'time'){
							$now = date('i');
							$residual = Session::get('residual');
							$kalan = $now - $residual;
							$kalans = 10 - $kalan;
							echo Functions::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
							Session::set('cError',false);
						} elseif($cError == 'OK'){
							echo Functions::alert('success',$lng[80]);
							Session::set('cError',false);
						}
						?>
                    </div>
                </div>
                <form action="<?=URI::get_path('recuperare/control')?>" id="RecuperareNotifyOGs" method="post" accept-charset="utf-8" class="page_form">
                    <table style="width:500px;">
                        <tr>
                            <td><label for="account_id"><?=$lng[22]?> :</label></td>
                            <td>
                                <span class="warfg_input" style=""><input type="text" name="login" value="" placeholder="<?=$lng[22]?>"></span>

                            </td>
                        </tr>
                        <tr>
                            <td><label for="account_password"><?=$lng[78]?> :</label></td>
                            <td>
                                <span class="warfg_input" style=""><input type="text" name="email" value="" placeholder="<?=$lng[78]?>"></span>
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
                                <span class="warfg_btn"><input type="submit" name="login_submit" value="<?=$lng[79]?>"></span>
                            </td>
                        </tr>
                    </table>
                </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>