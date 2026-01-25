<?php $status = $this->all['result']; ?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[122]?> </center>
        </div>
        <div class="panel-body">
			<?php if(!$status): ?>
				<?= Client::alert('error',$lng[81]);?>
			<?php else:?>
				<?= Client::alert('info',$lng[135]);?>
                <form action="<?=URI::get_path('profile/emailchange3')?>" method="POST" class="page_form" autocomplete="off" >
                    <label><?=$lng[23]?></label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="<?=$lng[23]?>">

                    <label><?=$lng[133]?></label>
                    <input id="newMail" type="email" class="form-control" name="new_mail" placeholder="<?=$lng[133]?>">

                    <label><?=$lng[134]?></label>
                    <input id="reMail" type="email" class="form-control" name="re_mail" placeholder="<?=$lng[134]?>">
                    <br>
                    <br>
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                    <br>
                    <div class="reg-buttons">
                        <center>
                            <button class="button-bg button-n" type="submit"><?=$lng[104]?></button>
                        </center>
                    </div>
                </form>
			<?php endif;?>
        </div>
    </div>
</main>