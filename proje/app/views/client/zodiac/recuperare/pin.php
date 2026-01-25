<div class="title">
    PIN Unuttum
</div>
<div class="news page">
	<?php if (isset($aid)):?>
		<?= Client::alert('error',$lng[74]);?>
	<?php else:?>
        <form action="<?=URI::get_path('recuperare/control3')?>" id="RecuperareNotifyOGs" method="post" accept-charset="utf-8" class="page_form" autocomplete="off">
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="login" id="login" placeholder="<?=$lng[22]?>" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
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