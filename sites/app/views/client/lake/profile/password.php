<?php $isBanned = $this->all["is_banned"];?>
<div class="title">
	<?=$lng[141]?>
</div>
<div class="news page">
	<?php if ($isBanned):?>
		<?= Client::alert('error', $lng[112]);?>
	<?php else:?>
        <form id="passwordChangeForm" action="<?=URI::get_path('profile/passwordchange')?>" method="POST" class="page_form" autocomplete="off">
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="old_password" id="oldPassword" placeholder="<?=$lng[165]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="<?=$lng[166]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" class="form-control" name="re_password" id="rePassword" placeholder="<?=$lng[167]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[141]?></button>
                </div>
            </div>
        </form>
	<?php endif;?>
</div>