<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="padding-left:20px; padding-right:20px;">
                <span class="title"><?=$lng[122]?></span>
                <!-- register -->
                <div class="store-activity">
                    <div class="container_3 account-wide" align="center">
                        <p style="padding: 20px;">
                            <!-- FORMS -->
                        </p>
						<?php if($this->response['result'] == false): ?>
							<?php echo Client::alert('error',$lng[81]);?>
						<?php elseif ($this->response['result'] == true):?>
							<?php echo Client::alert('info',$lng[135]);?>
                            <form action="<?=URI::get_path('profile/emailchange')?>" method="POST">
                                <div class="seperator"></div>
                                <div class="row">
                                    <label for="register-username"><?=$lng[23]?>:</label>
                                    <input type="password" id="password" name="password" maxlength="20" required>
                                </div>
                                <div class="row">
                                    <label for="register-username"><?=$lng[133]?>:</label>
                                    <input type="text" class="form-control grunge" name="newmail" id="newmail" required/>
                                </div>
                                <div class="row">
                                    <label for="register-username"><?=$lng[134]?>:</label>
                                    <input type="text" class="form-control grunge" name="newmail2" id="newmail2" required/>
                                </div>
                                <div class="seperator"></div>
                                <div class="row">
									<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                </div>
                                <div class="row" style="margin-top: 30px;">
                                    <div class="wbuttons wbuttons-buttonBorder">
                                        <input type="submit" value="<?=$lng[122]?>" class="wbuttons wbuttons-bt" AutoCompleteType="None" />
                                    </div>
                                </div>
                            </form>
						<?php endif;?>
                        <br />
                        <br />
                        <br />
                        <!-- FORMS.End -->
                    </div>
                </div>
                <!-- register.End -->
            </div>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>