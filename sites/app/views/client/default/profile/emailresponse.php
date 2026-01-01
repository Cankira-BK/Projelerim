<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[122]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
					<?php if($this->response['result'] == false): ?>
						<?php echo Functions::alert('error',$lng[81]);?>
					<?php elseif ($this->response['result'] == true):?>
					<?php echo Functions::alert('info',$lng[135]);?>
                        <form action="<?=URI::get_path('profile/emailchange3')?>" method="post" id="BirForm">
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
											<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 0) {echo $this->captcha->simple()->call(); echo '<br><input name="captcha" type="password">';}?>
											<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
											<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
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
					<?php endif;?>
                </div>
            </div>
        </div
    </div>
</div>
</div>