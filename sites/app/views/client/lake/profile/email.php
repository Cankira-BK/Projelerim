<?php
$isBanned = $this->all["is_banned"];
$mailActive = $this->all["mail_active"];
?>
<div class="title">
	<?=$lng[122]?>
</div>
<div class="news page">
	<?php if ($isBanned):?>
		<?= Client::alert('error',$lng[112]); ?>
	<?php elseif ($mailActive === "1"):?>
        <form id="emailChangeForm" action="<?=URI::get_path('profile/emailchange2')?>" method="POST" class="page_form" autocomplete="off" >
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="password" id="password" name="password" class="form-control2" placeholder="<?=$lng[23]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[122]?></button>
                </div>
            </div>
        </form>
	<?php else:?>
        <form id="emailChangeForm" action="<?=URI::get_path('profile/emailchange')?>" method="POST" class="page_form" autocomplete="off" >
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="password" id="password" name="password" class="form-control2" placeholder="<?=$lng[23]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="email" id="newMail" name="new_mail" class="form-control2" placeholder="<?=$lng[133]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="email" id="reMail" name="re_mail" class="form-control2" placeholder="<?=$lng[134]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[122]?></button>
                </div>
            </div>
        </form>
	<?php endif;?>
</div>