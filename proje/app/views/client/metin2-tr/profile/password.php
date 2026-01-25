<?php
    $ban = $this->password;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;
?>
<div role="main">
    <div id="login" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2><?=$lng[141]?></h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <div class="trenner"></div>
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
                        <form name="loginForm" action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="POST">
                            <div>
                                <label for="password"><?=$lng[165]?>: *</label>
                                <input type="password" id="oldpassword" name="oldpassword" maxlength="32" value="">
                            </div>
                            <div>
                                <label for="password"><?=$lng[166]?>: *</label>
                                <input type="password" id="newpassword" name="newpassword" maxlength="32" value="">
                            </div>
                            <div>
                                <label for="password"><?=$lng[167]?>: *</label>
                                <input type="password" id="newpassword2" name="newpassword2" maxlength="32" value="">
                            </div>
                            <div>
                                <label for="password"><?=$lng[24]?>: *</label>
                                <script src='https://www.google.com/recaptcha/api.js'></script>
                                <div class="g-recaptcha rc-anchor-dark" style="    transform: scale(0.90);margin-left: -17px;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
                            </div>
                            <input id="submitBtn" class="btn-big" type="submit" name="SubmitLoginForm" value="<?= $lng[21] ?>">
                        </form>
						<?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>