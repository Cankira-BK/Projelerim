<?php
$isBanned = $this->all["is_banned"];
$mailActive = $this->all["mail_active"];
?>
<div class="title">
	<?=$lng[111]?>
</div>
<div class="news page">
	<?php if ($isBanned):?>
		<?= Client::alert('error',$lng[112]); ?>
	<?php elseif ($mailActive === "0"):?>
		<?= Client::alert('error',$lng[113])?>
        <a href="<?=URI::get_path('profile/aktive')?>" ><button type="submit" class="center-block btn btn-grunge"><?=$lng[114]?></button></a>
	<?php else:?>
        <form id="safeBoxPasswordForm" action="<?=URI::get_path('profile/depochange')?>" method="POST" class="page_form" autocomplete="off" >
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="password" id="password" name="password" value="" class="form-control2" placeholder="<?=$lng[23]?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[119]?></button>
                </div>
            </div>
        </form>
	<?php endif;?>
</div>