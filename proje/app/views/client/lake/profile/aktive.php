<?php
$isBanned = $this->all["is_banned"];
$mailActive = $this->all["mail_active"];
?>
<div class="title">
	<?=$lng[98]?>
</div>
<div class="news page">
	<?php if ($isBanned):?>
		<?= Client::alert('error',$lng[112]); ?>
	<?php elseif ($mailActive === "1"):?>
		<?= Client::alert('info',$lng[99])?>
	<?php else:?>
        <form id="mailActivationForm" action="<?=URI::get_path('profile/aktivechange')?>" method="post" accept-charset="utf-8" class="page_form">
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" id="password" class="form-control" name="password" placeholder="<?=$lng[23]?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[104]?></button>
                </div>
            </div>
        </form>
	<?php endif;?>
</div>