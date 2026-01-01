<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[98]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
					<?php if ($this->aktive == 1):?>
						<?=Functions::alert('info',$lng[99])?>
					<?php else:?>
					<?php
					Session::init();
					$cError = Session::get('cError');
					if($cError == 'recaptcha'){
						echo Functions::alert('error',$lng[100]);
						Session::set('cError',false);
					}elseif($cError == 'filter'){
						echo Functions::alert('error',$lng[101]);
						Session::set('cError',false);
					}elseif($cError == 'got'){
						echo Functions::alert('error','Daha önce depo şifresi değiştirme talebinde bulunmuşsunuz. Lütfen mail adresinizi kontrol ediniz.');
						Session::set('cError',false);
					}elseif($cError == 'OK'){
						echo Functions::alert('success',$lng[102]);
						Session::set('cError',false);
					}elseif($cError == 'time'){
						$now = date('i');
						$residual = Session::get('residual');
						$kalan = $now - $residual;
						$kalans = 11 - $kalan;
						echo Functions::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
						Session::set('cError',false);
					}else{
						echo Functions::alert('info',$lng[103]);
					}
					?>
                    <form action="<?=URI::get_path('profile/aktivechange')?>" method="post" id="BirForm">
                        <table border="0" align="center" width="100%">
                            <tbody>
                            <tr>
                                <td align="center"><label><?=$lng[23]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="password" type="password" maxlength="30">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[24]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
										<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 0) {echo $this->captcha->simple()->call(); echo '<br><input name="captcha" type="password">';}?>
										<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
										<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <br>
                                    <input type="submit" value="<?=$lng[104]?>">
                                    <div class="clear"></div>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
					<?php endif;?>
                </div>
            </div>
        </div
    </div>
</div>
</div>