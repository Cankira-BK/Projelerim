<?php
$isBanned = $this->all["is_banned"];
$mailActive = $this->all["mail_active"];
?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading">
                <h2 class="head"> PIN Değiştir
                    <a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a>
                </h2>
            </div>
            <div class="body">
				<?php if ($isBanned):?>
					<?= Client::alert('error',$lng[112]); ?>
				<?php elseif ($mailActive === "0"):?>
					<?= Client::alert('error',$lng[113])?>
                    <a href="<?=URI::get_path('profile/aktive')?>" ><button type="submit" class="center-block btn btn-grunge"><?=$lng[114]?></button></a>
				<?php else:?>
                    <form action="<?=URI::get_path('profile/pinchange')?>" method="POST" class="page_form" autocomplete="off" >
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label"><?=$lng[23]?></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control2" name="password" id="password" required placeholder="<?=$lng[23]?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reCaptcha" class="col-sm-3 control-label"></label>
                            <div class="col-sm-12">
								<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" name="login_submit" class="btn form-btn"><?=$lng[156]?></button>
                            </div>
                        </div>
                    </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
<script>
    $("#pinChangeForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });
</script>