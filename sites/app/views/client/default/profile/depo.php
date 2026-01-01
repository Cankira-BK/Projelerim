<?php
    $ban = $this->aktive;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>

<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[111]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
					<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
						<?=Functions::alert('error',$lng[112]); ?>
					<?php endif;?>
					<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
					<?php if ($this->aktive['mailaktive'] == 0):?>
						<?=Functions::alert('error',$lng[113])?>
                            <a href="<?=URI::get_path('profile/aktive')?>" ><input type="submit" class="center-block btn btn-grunge" value="<?=$lng[98]?>" style="margin-right: auto;margin-left: auto;display: block"></a>
					<?php else:?>
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
						echo Functions::alert('success',$lng[117]);
						Session::set('cError',false);
					}elseif($cError == 'time'){
						$now = date('i');
						$residual = Session::get('residual');
						$kalan = $now - $residual;
						$kalans = 11 - $kalan;
						echo Functions::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
						Session::set('cError',false);
					}else{
						echo Functions::alert('info',$lng[118]);
					}
					?>
                    <form action="<?=URI::get_path('profile/depochange')?>" method="post" id="BirForm">
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
                                    <input type="submit" value="<?=$lng[119]?>">
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
					<?php endif;?>
                </div>
            </div>
        </div
    </div>
</div>
</div>