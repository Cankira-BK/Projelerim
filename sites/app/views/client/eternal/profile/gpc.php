<?php
    $ban = $this->aktive;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;
?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <h2 class="head"><?=$lng[184]?><a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a></h2>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="left">
						<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
							<?=Functions::alert('error',$lng[112]); ?>
						<?php endif;?>
						<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
						<?php if ($this->aktive['mailaktive'] == 0):?>
							<?=Functions::alert('error',$lng[113])?>
                            <a href="<?=URI::get_path('profile/aktive')?>" ><button type="submit" class="center-block btn btn-grunge"><?=$lng[98]?></button></a>
						<?php else:?>
						<?php
						$cError = Session::get('cError');
						if($cError == 'recaptcha'){
							echo Functions::alert('error',$lng[115]);
							Session::set('cError',false);
						}elseif($cError == 'filter'){
							echo Functions::alert('error',$lng[101]);
							Session::set('cError',false);
						}elseif($cError == 'error'){
							echo Functions::alert('error',$lng[101]);
							Session::set('cError',false);
						}elseif($cError == 'OK'){
							echo Functions::alert('success',$lng[189]);
							Session::set('cError',false);
						}elseif($cError == 'time'){
							$now = date('i');
							$residual = Session::get('residual');
							$kalan = $now - $residual;
							$kalans = 11 - $kalan;
							echo Functions::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
							Session::set('cError',false);
						}else{
							echo Functions::alert('info',$lng[185]);
						}
						?>
                    </div>
                </div>
                <form action="<?=URI::get_path('profile/gpcchange')?>" method="post" accept-charset="utf-8" class="page_form">
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
                                <span class="warfg_btn"><input type="submit" name="login_submit" value="<?=$lng[186]?>"></span>
                            </td>
                        </tr>
                    </table>
                </form>
				<?php endif;?>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>