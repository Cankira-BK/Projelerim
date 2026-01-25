<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[21]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
					<?php
					$cError = Session::get('cError');
					if($cError == 'recaptcha'){
						echo Client::alert('error','Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.');
						Session::set('cError',false);
					}elseif($cError == 'filter'){
						echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
						Session::set('cError',false);
					}elseif($cError == 'empty'){
						echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
						Session::set('cError',false);
					} elseif($cError == 'error'){
						echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
						Session::set('cError',false);
					} elseif ($cError == 'OK') {
						echo Client::alert('success','Kayıt işlemi başarılı. Lütfen giriş yapınız!');
						Session::set('cError',false);
					}
					?>
                    <form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="post" id="BirForm">
                        <table border="0" align="center" width="100%">
                            <tbody>
                            <tr>
                                <td align="center"><label><?=$lng[22]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="login" type="text" value=""></label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[23]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="password" type="password">
                                    </label>
                                </td>
                            </tr>
							<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                <tr>
                                    <td align="center"><label>PIN :<span style="color:darkred;text-shadow:none;">*</span><br>
                                            <input name="pin" type="password" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>">
                                        </label>
                                    </td>
                                </tr>
							<?php endif;?>
                            <tr>
                                <td align="center"><label><?=$lng[24]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
										<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <br>
                                    <input type="submit" value="<?=$lng[21]?>">
                                    <div class="clear"></div>
                                    <br>
                                    <a href="<?=URI::get_path('recuperare')?>" class="sifreunuttum"><?=$lng[25]?></a> <br>
                                    <a href="<?=URI::get_path('recuperare/account')?>" class="sifreunuttum"><?=$lng[26]?></a><br>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div
    </div>
    </div>
</div>