<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[21]?> </center>
        </div>
        <div class="panel-body">
            <form id="loginForm" action="<?=URI::get_path('login/control')?>" method="POST" autocomplete="off" class="form-template">
                <label><?=$lng[22]?></label>
                <input type="text" placeholder="<?=$lng[22]?>" name="login" id="login" maxlength="16" required>

                <label><?=$lng[23]?></label>
                <input type="password" placeholder="<?=$lng[23]?>" name="password" id="password" required>

				<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                    <label>PIN</label>
                    <input type="password" placeholder="PIN" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required>
				<?php endif;?>

                <label><?=$lng[24]?></label>
				<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>

                <br>
                <div class="reg-buttons">
                    <center>
                        <button class="button-bg button-n" type="submit" name="login_submit"><?=$lng[21]?></button>
                    </center>
                </div>
                <br>

            </form>
        </div>
    </div>
</main>