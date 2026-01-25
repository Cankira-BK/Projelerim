<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<div class="panel-heading"><?=$lng[21]?></div>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="left">
                    </div>
                </div>								<?php				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error','Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.');					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');					Session::set('cError',false);				}elseif($cError == 'empty'){					echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');					Session::set('cError',false);				} elseif($cError == 'error'){					echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');					Session::set('cError',false);				} elseif ($cError == 'OK') {					echo Client::alert('success','Kayıt işlemi başarılı. Lütfen giriş yapınız!');					Session::set('cError',false);				}				?>
                <form class="page_form" action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST" autocomplete="off" >
                    <div class="form-group">
                        <label for="login" class="col-sm-3 control-label"><?=$lng[22]?></label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control2" name="login" id="login" required maxlength="16"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label"><?=$lng[23]?></label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control2" name="password" id="password"/>
                        </div>
                    </div>
					<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                        <div class="form-group">
                            <label for="pin" class="col-sm-3 control-label">PIN</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control2" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>"/>
                            </div>
                        </div>
					<?php endif;?>
                    <div class="form-group">
                        <label for="recaptcha" class="col-sm-3 control-label"></label>
                        <div class="col-sm-12">
							<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" form="loginForm" name="login_submit" class="btn form-btn"><?=$lng[21]?></button>
                        </div>
                    </div>
                </form>
            </div>
        </article>
    </div>
</aside>
<script>
    $("#loginForm").on('submit', function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                if (response.result)
                    window.location.href = response.redirect;
                else
                {
                    errorNotify(response.message);
                    grecaptcha.reset();
                }
            }
        });
    });
</script>