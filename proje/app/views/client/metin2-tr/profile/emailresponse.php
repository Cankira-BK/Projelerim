<div role="main">
    <div id="login" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2><?=$lng[122]?></h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <div class="trenner"></div>
						<?php if($this->response['result'] == false): ?>
							<?php echo Client::alert('error',$lng[81]);?>
						<?php elseif ($this->response['result'] == true):?>
						<?php echo Client::alert('info',$lng[135]);?>
                            <form name="loginForm" action="<?=URI::get_path('profile/emailchange3')?>" method="POST">
                                <div>
                                    <label for="password"><?=$lng[23]?>: *</label>
                                    <input type="password" id="password" name="password" maxlength="32" value="">
                                </div>
                                <div>
                                    <label for="username"><?=$lng[133]?>: *</label>
                                    <input type="email" name="newmail" id="newmail" required value="">
                                </div>
                                <div>
                                    <label for="username"><?=$lng[134]?>: *</label>
                                    <input type="email" name="newmail2" id="newmail2" required value="">
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