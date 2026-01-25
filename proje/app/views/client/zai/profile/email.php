<?php
    $ban = $this->aktive;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>
<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[122]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
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
						echo Client::alert('success',$lng[123]);
						Session::set('cError',false);
					} elseif($cError == 'OK3'){
						echo Client::alert('success',$lng[124]);
						Session::set('cError',false);
					}elseif($cError == 'time'){
						$now = date('i');
						$residual = Session::get('residual');
						$kalan = $now - $residual;
						$kalans = 11 - $kalan;
						echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
						Session::set('cError',false);
					}else{
						echo Client::alert('info',$lng[125]);
					}
					?>
                    <form action="<?=URI::get_path('profile/emailchange2')?>" method="post" id="BirForm">
                        <table border="0" align="center" width="100%">
                            <tbody>
                            <tr>
                                <td align="center"><label><?=$lng[23]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="password" type="password" maxlength="30" required autocomplete="off">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[24]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
										<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <br>
                                    <input type="submit" value="<?=$lng[122]?>">
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
                    <form action="<?=URI::get_path('profile/emailchange')?>" method="post" id="BirForm">
                        <table border="0" align="center" width="100%">
                            <tbody>
                            <tr>
                                <td align="center"><label><?=$lng[23]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="password" type="password" maxlength="30" required autocomplete="off">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[133]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="newmail" type="text" value="" maxlength="50" required autocomplete="off"></label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[134]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="newmail2" type="text" value="" maxlength="50" required autocomplete="off"></label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[24]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
										<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <br>
                                    <input type="submit" value="<?=$lng[122]?>">
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
						<?php endif; ?>
					<?php endif;?>
                </div>
            </div>
        </div
    </div>
</div>
</div>