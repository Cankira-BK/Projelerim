<style>
    .select-box{
        width: 312px!important;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        color: #6c6c6c;
        border: none;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        width: 290px;
        height: 34px;
        padding: 0 10px 0 10px;
        background: rgba(0, 0, 0, .35);
        box-shadow: inset 0 0 3px rgba(0, 0, 0, .2), inset 0 1px 1px rgba(0, 0, 0, .4), 0 1px 0 rgba(255, 255, 255, .02);
        transition: all 300ms;
        -moz-transition: all 300ms;
        -webkit-transition: all 300ms;
        -o-transition: all 300ms;
    }
</style>
<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
                <div class="content" style="text-align: center; padding-top: 30px; padding-bottom: 30px;">
                    <span class="title"><?=$lng[10];?></span>
                    <!-- register -->
                    <div class="store-activity">
                        <div class="container_3 account-wide" align="center">
                            <p style="padding: 20px;">
                                <!-- FORMS -->
                            </p>
							<?php
							$cError = Session::get('cError');
							if($cError == 'recaptcha'){
								echo Client::alert('error',$lng[75]);
								Session::set('cError',false);
							}elseif($cError == 'filter'){
								echo Client::alert('error',$lng[87]);
								Session::set('cError',false);
							}elseif($cError == 'empty'){
								echo Client::alert('error',$lng[88]);
								Session::set('cError',false);
							}elseif($cError == 'control'){
								echo Client::alert('error',$lng[89]);
								Session::set('cError',false);
							}elseif($cError == 'password'){
								echo Client::alert('error',$lng[90]);
								Session::set('cError',false);
							}elseif($cError == 'login'){
								echo Client::alert('error',$lng[91]);
								Session::set('cError',false);
							}elseif($cError == 'ksk'){
								echo Client::alert('error',$lng[92]);
								Session::set('cError',false);
							}elseif($cError == 'phone'){
								echo Client::alert('error',$lng[93]);
								Session::set('cError',false);
							}elseif($cError == 'pin'){
								echo Client::alert('error',"Hatalı PIN girdiniz!");
								Session::set('cError',false);
							}elseif($cError == 'kgs'){
								echo Client::alert('error','Karakter Güvenlik Şifreniz 6 haneli olmalıdır.');
								Session::set('cError',false);
							}elseif($cError == 'database'){
								echo Client::alert('error','Kayıt işlemi başarısız!');
								Session::set('cError',false);
							}elseif($cError == 'OK'){
								Session::set('cError',false);
								Session::set('redirectRegister',true);
								$login = Session::get('redirectLogin');
								$password = Session::get('redirectPassword');
								$registerToken = $this->hash->create('md5',$login.$password,\StaticDatabase\StaticDatabase::settings('tokenkey'));
								URI::redirect("register/redirect&login=$login&password=$password&token=$registerToken");

							}
							?>
							<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
								<?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
							<?php else:?>
                                <form action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs" method="POST">
                                    <div class="seperator"></div>
                                    <div class="row">
                                        <label for="register-username"><?=$lng[22]?>:</label>
                                        <input type="text" class="form-control grunge" name="login" id="login" required maxlength="16" onkeypress="return textonly(event,'#login')"/>
                                        <img id="loginOk" class="pull-right" src="<?=URI::public_path('assets/images/ok.png');?>" alt="" style="display:none;margin-top: 10px;position: absolute;">
                                        <img id="loginNo" class="pull-right" src="<?=URI::public_path('assets/images/no.png');?>" alt="" style="display:none;margin-top: 10px;position: absolute;">
                                    </div>
                                    <div class="seperator"></div>
                                    <div class="row">
                                        <label for="register-password"><?=$lng[23]?>:</label>
                                        <input type="password" class="form-control grunge" name="password" id="pass"/>
                                    </div>
                                    <div class="row">
                                        <label for="register-password2"><?=$lng[94]?>:</label>
                                        <input type="password" class="form-control grunge" name="password2" id="pass2" required maxlength="30"/>
                                        <img id="passOk" class="pull-right" src="<?=URI::public_path('assets/images/ok.png');?>" alt="" style="display:none;margin-top: 10px;position: absolute;">
                                        <img id="passNo" class="pull-right" src="<?=URI::public_path('assets/images/no.png');?>" alt="" style="display:none;margin-top: 10px;position: absolute;">
                                        <div id="check_pw">
                                            <p></p>
                                        </div>
                                    </div>
									<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                        <div class="row">
                                            <label for="register-password">PIN:</label>
                                            <input type="password" class="form-control grunge" name="pin" id="pin" onkeypress="return numberonly(event,this)" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required/>
                                        </div>
									<?php endif;?>
                                    <div class="seperator"></div>
                                    <div class="row">
                                        <label for="register-displayName"><?=$lng[78]?>:</label>
                                        <input type="text" class="form-control grunge" name="email" id="email" required/>
                                    </div>
                                    <div class="row">
                                        <label for="register-email"><?=$lng[95]?>:</label>
                                        <input id="name" type="text" name="name" class="form-control grunge" onkeypress="return textonly2(event,'#name')" maxlength="30" required />
                                        <div id="check_mail">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="register-phone"><?=$lng[97]?> :</label>
                                        <input type="text" id="phone" name="phone" class="form-control grunge" onkeypress="return numberonly(event,'#phone')" maxlength="10" placeholder="555-555-55-55"/>
                                        <div id="check_phone">
                                            <p></p>
                                        </div>
                                    </div>
                                    <div class="seperator"></div>
                                    <div class="row">
                                        <label for="txtItemSealPW"><?=$lng[96]?>:</label>
                                        <input id="ksk" type="text" name="ksk" class="form-control grunge" onkeypress="return numberonly(event,'#ksk')" maxlength="7" required />
                                    </div>
									<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
                                    <div class="row">
										<?php
										$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
										$findMeList->execute();
										?>
                                        <label for="findme">Bizi nerden buldunuz?:</label>
                                        <select name="findme" class="select-box">
											<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                                <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
											<?php endforeach;?>
                                        </select>
                                    </div>
									<?php endif;?>
                                    <div class="seperator"></div>
                                    <div class="row">
										<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </div>
                                    <div style="margin-top: 15px;"><span>Kayıt olarak <a href="<?=URI::get_path('privacy/index')?>" target="_blank" style="color: wheat;">üyelik sözleşmesini</a> kabul ederim.</span></div>
                                    <div class="row" style="margin-top: 30px;">
                                        <div class="wbuttons wbuttons-buttonBorder">
                                            <input type="submit" value="<?=$lng[10]?>" class="wbuttons wbuttons-bt" AutoCompleteType="None" />
                                        </div>
                                    </div>
                                </form>
                            <?php endif;?>
                            <br />
                            <br />
                            <br />
                            <!-- FORMS.End -->
                        </div>
                    </div>
                    <!-- register.End -->
                </div>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>

<script>
    function textonly(e,id){
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);
//alert('Character was ' + character);
        //alert(code);
        //if (code == 8) return true;
        var AllowRegex  = /^[\ba-zA-Z0-9\s-]$/;
        if (AllowRegex.test(character)){
            return true;
        }else{
            $(id).notify(
                "Sadece harf ve rakam",
                { position:"right" }
            );
            return false;
        }
    }
    $('#pass2').change(function () {
        var pass = $('#pass').val();
        var pass2 = $(this).val();
        if(pass != pass2){
            document.getElementById('passOk').style.display = "none";
            document.getElementById('passNo').style.display = "";
            $('#pass2').notify(
                "Şifreler uyuşmuyor !",
                { position:"right" }
            );
        }else{
            document.getElementById('passNo').style.display = "none";
            document.getElementById('passOk').style.display = "";
        }
    });
    $('#pass').change(function () {
        var pass = $('#pass2').val();
        var pass2 = $(this).val();
        if(pass != ''){
            if(pass != pass2){
                document.getElementById('passOk').style.display = "none";
                document.getElementById('passNo').style.display = "";
                $('#pass2').notify(
                    "Şifreler uyuşmuyor !",
                    { position:"right" }
                );
            }else{
                document.getElementById('passNo').style.display = "none";
                document.getElementById('passOk').style.display = "";
            }
        }
    });
    function textonly2(e,id){
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);
//alert('Character was ' + character);
        //alert(code);
        //if (code == 8) return true;
        var AllowRegex  = /^[\ba-z-A-ZÇİĞÖŞÜçığöşü\s-]$/;
        if (AllowRegex.test(character)){
            return true;
        }else{
            $(id).notify(
                "Sadece harf !",
                { position:"right" }
            );
            return false;
        }
    }
    function numberonly(e,id){
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);
//alert('Character was ' + character);
        //alert(code);
        //if (code == 8) return true;
        var AllowRegex  = /^[\b0-9\s-]$/;
        if (AllowRegex.test(character)){
            return true;
        }else{
            $(id).notify(
                "Sadece rakam !",
                { position:"right" }
            );
            return false;
        }
    }
    $('#question').mouseover(function () {
        document.getElementById('question2').style.display="";
    });
    $('#question').mouseout(function () {
        document.getElementById('question2').style.display="none";
    });
</script>