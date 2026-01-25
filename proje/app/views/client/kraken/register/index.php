<style>
    .nice-select{
        width: 195px;
    }
</style>
<div class="main-panel panel-download">
    <div class="main-header">
        <?=$lng[10];?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
                        <?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
                    <?php else:?>
                        <?php				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error',$lng[75]);					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error',$lng[87]);					Session::set('cError',false);				}elseif($cError == 'empty'){					echo Client::alert('error',$lng[88]);					Session::set('cError',false);				}elseif($cError == 'control'){					echo Client::alert('error',$lng[89]);					Session::set('cError',false);				}elseif($cError == 'password'){					echo Client::alert('error',$lng[90]);					Session::set('cError',false);				}elseif($cError == 'login'){					echo Client::alert('error',$lng[91]);					Session::set('cError',false);				}elseif($cError == 'ksk'){					echo Client::alert('error',$lng[92]);					Session::set('cError',false);				}elseif($cError == 'phone'){					echo Client::alert('error',$lng[93]);					Session::set('cError',false);				}elseif($cError == 'kgs'){					echo Client::alert('error','Karakter Güvenlik Şifreniz 6 haneli olmalıdır.');					Session::set('cError',false);				}elseif($cError == 'pin'){					echo Client::alert('error',"Hatalı PIN girdiniz!");					Session::set('cError',false);				}elseif($cError == 'database'){					echo Client::alert('error','Kayıt işlemi başarısız!');					Session::set('cError',false);				}elseif($cError == 'OK'){					Session::set('cError',false);					Session::set('redirectRegister',true);					$login = Session::get('redirectLogin');					$password = Session::get('redirectPassword');					$registerToken = $this->hash->create('md5',$login.$password,\StaticDatabase\StaticDatabase::settings('tokenkey'));					URI::redirect("register/redirect&login=$login&password=$password&token=$registerToken");				}				?>						<form action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs" method="POST" autocomplete="off">
                            <div class="bg-light">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td style="width: 150px;">
                                            <label class="register-input" for="login"><?=$lng[22]?>:</label>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control grunge" name="login" id="login" required maxlength="16"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="register-input" for="password"><?=$lng[23]?>:</label>
                                        </td>
                                        <td>
                                            <input type="password" class="form-control grunge" name="password" id="password" required maxlength="30"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="register-input" for="password2"><?=$lng[94]?>:</label>
                                        </td>
                                        <td>
                                            <input type="password" class="form-control grunge" name="password2" id="password2" required maxlength="30"/>
                                        </td>
                                    </tr>
						            <?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                    <tr>
                                        <td>
                                            <label class="register-input" for="pin">PIN:</label>
                                        </td>
                                        <td>
                                            <input type="password" class="form-control grunge" name="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" onkeypress="return numberonly(event,'#pin')" id="pin" required/>
                                        </td>
                                    </tr>
                                    <?php endif;?>
                                    <tr>
                                        <td>
                                            <label class="register-input" for="email"><?=$lng[78]?>:</label>
                                        </td>
                                        <td>
                                            <input type="email" class="form-control grunge" name="email" id="email" required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="register-input" for="name"><?=$lng[95]?>:</label>
                                        </td>
                                        <td>
                                            <input id="name" type="text" name="name" class="form-control grunge" onkeypress="return textonly2(event,'#name')" maxlength="60" required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="register-input" for="ksk"><?=$lng[96]?>:</label>
                                        </td>
                                        <td>
                                            <input id="ksk" type="text" name="ksk" class="form-control grunge" onkeypress="return numberonly(event,'#ksk')" maxlength="7" required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="register-input" for="phone"><?=$lng[97]?>:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="phone" name="phone" class="form-control grunge" onkeypress="return numberonly(event,'#phone')" maxlength="10" placeholder="555-555-55-55"/>
                                        </td>
                                    </tr>
									<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
                                    <tr>
                                        <?php
										$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
										$findMeList->execute();
                                        ?>
                                        <td>
                                            <label class="register-input" for="findme">Bizi nerden buldunuz?:</label>
                                        </td>
                                        <td>
                                            <select name="findme" id="findme">
                                                <option value="0" selected>Lütfen seçiniz...</option>
												<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                                    <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
												<?php endforeach;?>
                                            </select>
                                        </td>
                                    </tr>
									<?php endif;?>
                                    <tr>
                                        <td>
                                            <label class="register-input" for="recaptcha"><?=$lng[24]?>:</label>
                                        </td>
                                        <td>
											<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        </td>
                                        <td style="margin-top: -27px;">
                                            <div style="    margin-top: -20px;
    margin-left: -40px;
    margin-bottom: 20px;"><span>Kayıt olarak <a href="<?=URI::get_path('privacy/index')?>" target="_blank" style="color: wheat;">üyelik sözleşmesini</a> kabul ederim.</span></div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn"><?=$lng[10]?></button>
                            </div>
                        </form>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>
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