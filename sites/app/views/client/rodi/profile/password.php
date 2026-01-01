<?php $isBanned = $this->all["is_banned"];?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[141]?> </center>
        </div>
        <div class="panel-body">
			<?php if ($isBanned):?>
				<?= Client::alert('error', $lng[112]);?>
			<?php else:?>
            <form id="passwordChangeForm" action="<?=URI::get_path('profile/passwordchange')?>" method="post" accept-charset="utf-8" class="page_form" autocomplete="off">
                <label><?=$lng[165]?></label>
                <input id="oldPassword" type="password" class="form-control" name="old_password" placeholder="<?=$lng[165]?>">

                <label><?=$lng[166]?></label>
                <input id="newPassword" type="password" class="form-control" name="new_password" placeholder="<?=$lng[166]?>">

                <label><?=$lng[167]?></label>
                <input id="rePassword" type="password" class="form-control" name="re_password" placeholder="<?=$lng[167]?>">
                <br>
				<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                <br>
                <br>
                <div class="reg-buttons">
                    <center>
                        <button class="button-bg button-n" type="submit"><?=$lng[141]?></button>
                    </center>
                </div>
                <br>
            </form>
			<?php endif;?>
        </div>
    </div>
</main>