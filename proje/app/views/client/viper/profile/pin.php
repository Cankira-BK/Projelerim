<?php
$isBanned = $this->all["is_banned"];
$mailActive = $this->all["mail_active"];
?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
                PIN Değiştir </center>
        </div>
        <div class="panel-body">
			<?php if ($isBanned):?>
				<?= Client::alert('error',$lng[112]); ?>
			<?php elseif ($mailActive === "0"):?>
				<?= Client::alert('error',$lng[113])?>
                <a href="<?=URI::get_path('profile/aktive')?>" >
                    <button type="button" class="button-bg button-n center-block"><?=$lng[114]?></button>
                </a>
			<?php else:?>
                <form action="<?=URI::get_path('profile/pinchange')?>" method="POST" class="page_form" autocomplete="off" >
                    <label><?=$lng[23]?></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="<?=$lng[23]?>">
                    <br>
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                    <br>
                    <br>
                    <div class="reg-buttons">
                        <center>
                            <button class="button-bg button-n" type="submit">Mail Gönder</button>
                        </center>
                    </div>
                    <br>
                </form>
			<?php endif;?>
        </div>
    </div>
</main>