<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading"><h2 class="head">PIN Unuttum</h2></div>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="left">
						<?php if (isset($aid)):?>
							<?= Client::alert('error',$lng[74]);?>
						<?php else:?>
                    </div>
                </div>
                <form action="<?=URI::get_path('recuperare/control3')?>" id="RecuperareNotifyOGs" method="post" accept-charset="utf-8" class="page_form" autocomplete="off">
                    <div class="form-group">
                        <label for="login" class="col-sm-3 control-label"><?=$lng[22]?></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="login" id="login" placeholder="<?=$lng[22]?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label"><?=$lng[78]?></label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="email" id="email" placeholder="<?=$lng[78]?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"></label>
                        <div class="col-sm-7">
							<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" name="login_submit" class="btn form-btn"><?=$lng[79]?></button>
                        </div>
                    </div>
                </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
<script>
    $("#forgetPINForm").on("submit", function (event) {
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