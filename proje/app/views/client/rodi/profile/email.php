<?php
$isBanned = $this->all["is_banned"];
$mailActive = $this->all["mail_active"];
?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[122]?> </center>
        </div>
        <div class="panel-body">
			<?php if ($isBanned):?>
				<?= Client::alert('error',$lng[112]); ?>
			<?php elseif ($mailActive === "1"):?>
                <form id="emailChangeForm" action="<?=URI::get_path('profile/emailchange2')?>" method="POST" class="page_form" autocomplete="off">
                    <label><?=$lng[23]?></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="<?=$lng[23]?>">
                    <br>
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                    <br>
                    <br>
                    <div class="reg-buttons">
                        <center>
                            <button class="button-bg button-n" type="submit"><?=$lng[122]?></button>
                        </center>
                    </div>
                    <br>
                </form>
			<?php else:?>
                <form id="emailChangeForm" action="<?=URI::get_path('profile/emailchange')?>" method="POST" class="page_form" autocomplete="off" >
                    <label><?=$lng[23]?></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="<?=$lng[23]?>">

                    <label><?=$lng[133]?></label>
                    <input id="newMail" type="email" class="form-control" name="new_mail" placeholder="<?=$lng[133]?>">

                    <label><?=$lng[134]?></label>
                    <input id="reMail" type="email" class="form-control" name="re_mail" placeholder="<?=$lng[134]?>">
                    <br>
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                    <br>
                    <br>
                    <div class="reg-buttons">
                        <center>
                            <button class="button-bg button-n" type="submit"><?=$lng[122]?></button>
                        </center>
                    </div>
                </form>
			<?php endif;?>
        </div>
    </div>
</main>