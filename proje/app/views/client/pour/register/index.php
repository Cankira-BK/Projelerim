<style>
    .select-box{
        background-color: #5d1698;
        border: 1px solid #9831ec;
        color: #ffffff;
        padding: 7px 10px;
        font-size: 12px;
        position: relative;
        border-radius: 3px;
        transition: all 0.5s ease;
        width: 100%;
    }
</style>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading"><h2 class="head">Kayıt Ol</h2></div>
            <div class="body">
				<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
					<?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
				<?php else:?>
                    <?php				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error',$lng[75]);					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error',$lng[87]);					Session::set('cError',false);				}elseif($cError == 'empty'){					echo Client::alert('error',$lng[88]);					Session::set('cError',false);				}elseif($cError == 'control'){					echo Client::alert('error',$lng[89]);					Session::set('cError',false);				}elseif($cError == 'password'){					echo Client::alert('error',$lng[90]);					Session::set('cError',false);				}elseif($cError == 'login'){					echo Client::alert('error',$lng[91]);					Session::set('cError',false);				}elseif($cError == 'ksk'){					echo Client::alert('error',$lng[92]);					Session::set('cError',false);				}elseif($cError == 'phone'){					echo Client::alert('error',$lng[93]);					Session::set('cError',false);				}elseif($cError == 'kgs'){					echo Client::alert('error','Karakter Güvenlik Şifreniz 6 haneli olmalıdır.');					Session::set('cError',false);				}elseif($cError == 'pin'){					echo Client::alert('error',"Hatalı PIN girdiniz!");					Session::set('cError',false);				}elseif($cError == 'database'){					echo Client::alert('error','Kayıt işlemi başarısız!');					Session::set('cError',false);				}elseif($cError == 'OK'){					Session::set('cError',false);					Session::set('redirectRegister',true);					$login = Session::get('redirectLogin');					$password = Session::get('redirectPassword');					$registerToken = $this->hash->create('md5',$login.$password,\StaticDatabase\StaticDatabase::settings('tokenkey'));					URI::redirect("register/redirect&login=$login&password=$password&token=$registerToken");				}				?>					<form action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs" method="POST" class="page_form" autocomplete="off">
                        <div class="form-group">
                            <label for="login" class="col-sm-3 control-label"><?=$lng[22]?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control2" name="login" id="login" required maxlength="16" onkeypress="return textonly(event,'#login')"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label"><?=$lng[23]?></label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control2" name="password" id="password" required maxlength="30"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-sm-3 control-label"><?=$lng[94]?></label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control2" name="password2" id="password2" required maxlength="30"/>
                            </div>
                        </div>
						<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                            <div class="form-group">
                                <label for="pin" class="col-sm-3 control-label">PIN</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control2" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" onkeypress="return numberonly(event,this)" required/>
                                </div>
                            </div>
						<?php endif;?>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label"><?=$lng[78]?></label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control2" name="email" id="email" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label"><?=$lng[95]?></label>
                            <div class="col-sm-7">
                                <input id="name" type="text" name="name" class="form-control2" onkeypress="return textonly2(event,'#name')" maxlength="60" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ksk" class="col-sm-3 control-label"><?=$lng[96]?></label>
                            <div class="col-sm-7">
                                <input id="ksk" type="text" name="ksk" class="form-control2" onkeypress="return numberonly(event,'#ksk')" maxlength="7" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label"><?=$lng[97]?></label>
                            <div class="col-sm-7">
                                <input type="text" id="phone" name="phone" class="form-control2" onkeypress="return numberonly(event,'#phone')" maxlength="10" placeholder="555-555-55-55" required/>
                            </div>
                        </div>
						<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
                            <div class="form-group">
								<?php
								$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
								$findMeList->execute();
								?>
                                <label for="findme" class="col-sm-3 control-label">Bizi nerden buldunuz?</label>
                                <div class="col-sm-7">
                                    <select name="findme" class="select-box">
                                        <option value="0" selected>Lütfen seçiniz...</option>
										<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                            <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
										<?php endforeach;?>
                                    </select>
                                </div>
                            </div>
						<?php endif;?>
                        <div class="form-group">
                            <label for="recaptcha" class="col-sm-3 control-label"></label>
                            <div class="col-sm-7">
								<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 15px;">
                            <div class="col-sm-offset-3 col-sm-6">
                                <span style="color: #ffffff">Kayıt olarak <a href="<?=URI::get_path('privacy/index')?>" target="_blank">üyelik sözleşmesini</a> kabul ederim.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" name="login_submit" class="btn form-btn"><?=$lng[10]?></button>
                            </div>
                        </div>
                    </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
<script>
    $('#pass2').change(function ()
    {
        var pass = $('#pass').val();
        var pass2 = $(this).val();
        if(pass != pass2){
            $('#pass2').notify(
                "Şifreler uyuşmuyor !",
                { position:"right" }
            );
        }
    });

    $("#registerForm").on("submit", function (event) {
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
                {
                    successNotify(response.message);
                    setTimeout(function () {
                        window.location.href = response.redirect;
                    },2000)
                }
                else
                {
                    errorNotify(response.message);
                    grecaptcha.reset();
                }
            }
        });
    });
</script>