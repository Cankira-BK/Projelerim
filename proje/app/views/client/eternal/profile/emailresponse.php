<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <h2 class="head"><?=$lng[122]?><a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a></h2>
            <div class="body">
                <div class="bg-light">
					<?php if($this->response['result'] == false): ?>
						<?php echo Functions::alert('error',$lng[81]);?>
					<?php elseif ($this->response['result'] == true):?>
						<?php echo Functions::alert('info',$lng[135]);?>
                        <form action="<?=URI::get_path('profile/emailchange3')?>" method="post" accept-charset="utf-8" class="page_form">
                            <table style="width:500px;">
                                <tr>
                                    <td><label for="account_password"><?=$lng[23]?> :</label></td>
                                    <td>
                                        <span class="warfg_input" style=""><input type="password" name="password" value="" placeholder="<?=$lng[23]?>"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="account_password"><?=$lng[133]?> :</label></td>
                                    <td>
                                        <span class="warfg_input" style=""><input type="email" name="newmail" value="" placeholder="<?=$lng[133]?>"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="account_password"><?=$lng[134]?> :</label></td>
                                    <td>
                                        <span class="warfg_input" style=""><input type="email" name="newmail2" value="" placeholder="<?=$lng[134]?>"></span>
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
                                        <span class="warfg_btn"><input type="submit" name="login_submit" value="<?=$lng[122]?>"></span>
                                    </td>
                                </tr>
                            </table>
                        </form>
					<?php endif;?>
                </div>
            </div>
        </article>
    </div>
</aside>