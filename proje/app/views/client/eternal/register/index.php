<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <h2 class="head">Kayıt Ol</h2>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="left">
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
						}elseif($cError == 'kgs'){
							echo Client::alert('error','Karakter Güvenlik Şifreniz 6 haneli olmalıdır.');
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
                    </div>
                </div>
				<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
					<?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
				<?php else:?>
                <form action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs" method="POST" class="page_form">
                    <div class="bg-light">
                        <table>
                            <tbody>
                            <tr>
                                <td style="width: 150px;">
                                    <label class="register-input" for="register-email"><?=$lng[22]?>:</label>
                                </td>
                                <td>
                                    <input type="text" class="form-control grunge" name="login" id="login" required maxlength="16" onkeypress="return textonly(event,'#login')"/>
                                    <img id="loginOk" class="pull-right" src="<?=URI::public_path('asset/images/ok.png');?>" alt="" style="width: 20px;display: none;">
                                    <img id="loginNo" class="pull-right" src="<?=URI::public_path('asset/images/no.png');?>" alt="" style="width: 20px;display: none;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="register-input" for="register-email"><?=$lng[23]?>:</label>
                                </td>
                                <td>
                                    <input type="password" class="form-control grunge" name="password" id="pass"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="register-input" for="register-email"><?=$lng[94]?>:</label>
                                </td>
                                <td>
                                    <input type="password" class="form-control grunge" name="password2" id="pass2" required maxlength="30"/>
                                    <img id="passOk" class="pull-right" src="<?=URI::public_path('asset/images/ok.png');?>" alt="" style="width: 20px;display: none;">
                                    <img id="passNo" class="pull-right" src="<?=URI::public_path('asset/images/no.png');?>" alt="" style="width: 20px;display: none;">
                                </td>
                            </tr>
							<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') == 1) {?>
							<tr>
                                <td>
                                    <label class="register-input" for="register-pin">Pin Kodu:</label>
                                </td>
                                <td>
                                    <input id="pin" type="text" name="pin" class="form-control grunge" onkeypress="return numberonly(event,'#pin')" maxlength="4" required />
                                </td>
                            </tr>
							<?php }?>
                            <tr>
                                <td>
                                    <label class="register-input" for="register-email"><?=$lng[78]?>:</label>
                                </td>
                                <td>
                                    <input type="email" class="form-control grunge" name="email" id="email" required/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="register-input" for="register-email"><?=$lng[95]?>:</label>
                                </td>
                                <td>
                                    <input id="name" type="text" name="name" class="form-control grunge" onkeypress="return textonly2(event,'#name')" maxlength="30" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="register-input" for="register-email"><?=$lng[96]?>:</label>
                                </td>
                                <td>
                                    <input id="ksk" type="text" name="ksk" class="form-control grunge" onkeypress="return numberonly(event,'#ksk')" maxlength="7" required />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="register-input" for="register-email"><?=$lng[97]?>:</label>
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
                                     <label class="register-input" for="register-email">Bizi nerden buldunuz?:</label>
                                 </td>
                                 <td>
                                     <select name="findme">
										<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                             <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
										<?php endforeach;?>
                                     </select>
                                 </td>
                             </tr>
							<?php endif;?>
							<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') >= 1) {?>
                            <tr>
                                <td>
                                    <label class="register-input" for="register-email"><?=$lng[24]?>:</label>
                                </td>
                                <td>
									<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
									<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
                                </td>
                            </tr>
							<?php }?>
                            <tr>
                                <td></td>
                                <td>
                                    <span class="warfg_btn"><input type="submit" name="login_submit" value="<?=$lng[10]?>"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
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
    $('#login').change(function () {
        var url = "<?=URI::get_path('register/login')?>";
        var data = $(this).val();
        $.post(url,{data:data},function (result) {
            if(result.result == true){
                document.getElementById('loginNo').style.display = "none";
                document.getElementById('loginOk').style.display = "";
            }else if(result.result == false){
                document.getElementById('loginOk').style.display = "none";
                document.getElementById('loginNo').style.display = "";
                $('#login').notify(
                    "Kullanıcı adı kullanımda !",
                    { position:"right" }
                );
            }
        },"json");
    });
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