<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[73]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
					<?php if (isset($aid)):?>
						<?php
						echo Client::alert('error',$lng[74]);
						?>
					<?php else:?>
					<?php
					Session::init();
					$cError = Session::get('cError');
					if($cError == 'recaptcha'){
						echo Client::alert('error',$lng[75]);
						Session::set('cError',false);
					}elseif($cError == 'filter'){
						echo Client::alert('error',$lng[76]);
						Session::set('cError',false);
					}elseif($cError == 'empty'){
						echo Client::alert('error',$lng[76]);
						Session::set('cError',false);
					} elseif($cError == 'error'){
						echo Client::alert('error',$lng[76]);
						Session::set('cError',false);
					} elseif($cError == 'time'){
						$now = date('i');
						$residual = Session::get('residual');
						$kalan = $now - $residual;
						$kalans = 10 - $kalan;
						echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
						Session::set('cError',false);
					} elseif($cError == 'OK'){
						echo Client::alert('success',$lng[77]);
						Session::set('cError',false);
					}
					?>
                    <form action="<?=URI::get_path('recuperare/control2')?>" id="RecuperareNotifyOGs" method="post" id="BirForm">
                        <table border="0" align="center" width="100%">
                            <tbody>
                            <tr>
                                <td align="center"><label><?=$lng[78]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="email" type="text" maxlength="30"></label>
                                </td>
                            </tr>
                            <tr>
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
                                    <input type="submit" value="<?=$lng[79]?>">
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