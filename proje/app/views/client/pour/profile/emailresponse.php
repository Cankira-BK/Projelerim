<?php $status = $this->all['result']; ?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading">
                <h2 class="head"><?=$lng[122]?>
                    <a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a>
                </h2>
            </div>
            <div class="body">
				<?php if(!$status): ?>
					<?= Client::alert('error',$lng[81]);?>
				<?php else:?>
					<?= Client::alert('info',$lng[135]);?>
                    <form action="<?=URI::get_path('profile/emailchange3')?>" method="POST" class="page_form" autocomplete="off" >
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label"><?=$lng[23]?></label>
                            <div class="col-sm-12">
                                <input id="password" type="password" name="password" class="form-control2" placeholder="<?=$lng[23]?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newMail" class="col-sm-3 control-label"><?=$lng[133]?></label>
                            <div class="col-sm-12">
                                <input id="newMail" type="email" name="new_mail" value="" class="form-control2" placeholder="<?=$lng[133]?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reMail" class="col-sm-3 control-label"><?=$lng[134]?></label>
                            <div class="col-sm-12">
                                <input id="reMail" type="email" name="re_mail" value="" class="form-control2" placeholder="<?=$lng[134]?>">
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
                                <button type="submit" name="login_submit" class="btn form-btn"><?=$lng[122]?></button>
                            </div>
                        </div>
                    </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
<script>
    $("#emailChangeForm2").on("submit", function (event) {
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