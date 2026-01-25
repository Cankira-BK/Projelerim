<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[25]?> </center>
        </div>
        <div class="panel-body">
            <div class="container_3 red wide fading-notification" align="left">
				<?php if (isset($aid)):?>
					<?= Client::alert('error',$lng[74]);?>
				<?php else:?>
            </div>
            <form id="forgetPasswordForm" action="<?=URI::get_path('recuperare/control')?>" method="post" class="page_form" autocomplete="off">
                <label><?=$lng[22]?></label>
                <input type="text" class="form-control" name="login" id="login" placeholder="<?=$lng[22]?>">

                <label><?=$lng[78]?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="<?=$lng[78]?>">

                <br>
				<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                <br>
                <br>
                <div class="reg-buttons">
                    <center>
                        <button class="button-bg button-n" type="submit"><?=$lng[79]?></button>
                    </center>
                </div>
                <br>
            </form>
			<?php endif;?>
        </div>
    </div>
</main>