<div class="title">
	<?=$lng[73]?>
</div>
<div class="news page">
	<?php if (isset($aid)):?>
		<?= Client::alert('error',$lng[74]);?>
	<?php else:?>
        <form id="forgetAccountForm" action="<?=URI::get_path('recuperare/control2')?>" method="post" accept-charset="utf-8" class="page_form" autocomplete="off">
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" id="email" placeholder="<?=$lng[78]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[79]?></button>
                </div>
            </div>
        </form>
	<?php endif;?>
</div>