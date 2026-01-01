<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[73]?> </center>
        </div>
        <div class="panel-body">
            <div class="container_3 red wide fading-notification" align="center">
				<?php if (isset($aid)):?>
					<?= Client::alert('error',$lng[74]);?>
				<?php else:?>
            </div>
            <form id="forgetAccountForm" action="<?=URI::get_path('recuperare/control2')?>" method="post" class="page_form" autocomplete="off">
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