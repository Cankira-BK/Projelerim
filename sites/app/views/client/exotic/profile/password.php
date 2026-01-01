<?php
$ban = $this->password;
$availDt = strtotime($ban['availDt']);
$now = time();
$fark = $availDt - $now;
?>
<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="padding-left:20px; padding-right:20px;">
                <span class="title"><?=$lng[141]?></span>
                <!-- register -->
                <div class="store-activity">
                    <div class="container_3 account-wide" align="center">
                        <p style="padding: 20px;">
                            <!-- FORMS -->
                        </p>
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
                            <form action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="POST">
                                <div class="seperator"></div>
                                <div class="row">
                                    <label for="register-username"><?=$lng[165]?>:</label>
                                    <input type="password" class="form-control grunge" name="oldpassword" maxlength="16" required>
                                </div>
                                <div class="row">
                                    <label for="register-username"><?=$lng[166]?>:</label>
                                    <input type="password" class="form-control grunge" name="newpassword" maxlength="16" required>
                                </div>
                                <div class="row">
                                    <label for="register-username"><?=$lng[167]?>:</label>
                                    <input type="password" class="form-control grunge" name="newpassword2" maxlength="16" required>
                                </div>
                                <div class="seperator"></div>
                                <div class="row">
									<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                </div>
                                <div class="row" style="margin-top: 30px;">
                                    <div class="wbuttons wbuttons-buttonBorder">
                                        <input type="submit" value="<?=$lng[141]?>" class="wbuttons wbuttons-bt" AutoCompleteType="None" />
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