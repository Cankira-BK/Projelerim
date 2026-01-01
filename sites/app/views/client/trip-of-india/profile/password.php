<?php
    $ban = $this->password;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;
?>
<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[141]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
					<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
						<?=Client::alert('error',$lng[113]); ?>
					<?php endif;?>
					<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
					<?php
					Session::init();
					$cError = Session::get('cError');
					if($cError == 'recaptcha'){
						echo Client::alert('error',$lng[115]);
						Session::set('cError',false);
					}elseif($cError == 'filter'){
						echo Client::alert('error',$lng[160]);
						Session::set('cError',false);
					}elseif($cError == 'empty'){
						echo Client::alert('error',$lng[160]);
						Session::set('cError',false);
					}elseif($cError == 'wrong'){
						echo Client::alert('error',$lng[161]);
						Session::set('cError',false);
					}elseif($cError == 'length'){
						echo Client::alert('error',$lng[128]);
						Session::set('cError',false);
					}elseif($cError == 'length2'){
						echo Client::alert('error',$lng[162]);
						Session::set('cError',false);
					}elseif($cError == 'same'){
						echo Client::alert('error',$lng[163]);
						Session::set('cError',false);
					}elseif($cError == 'error'){
						echo Client::alert('error',$lng[163]);
						Session::set('cError',false);
					}elseif($cError == 'OK'){
						echo Client::alert('success',$lng[164]);
						Session::set('cError',false);
					}
					?>
                    <form action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="post" id="BirForm">
                        <table border="0" align="center" width="100%">
                            <tbody>
                            <tr>
                                <td align="center"><label><?=$lng[165]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="oldpassword" type="password" maxlength="30">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[166]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="newpassword" type="password" maxlength="30">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[167]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="newpassword2" type="password" maxlength="30">
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
                                    <input type="submit" value="<?=$lng[141]?>">
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