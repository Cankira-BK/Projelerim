<style>
    .select-box{
        background-color: #131f2d;
        border: 1px solid #2c3545;
        color: #7d8a9f;
        padding: 8px 10px;
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
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="center">
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
						}elseif($cError == 'pin'){
							echo Client::alert('error',"Hatalı PIN girdiniz!");
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
                    </div>
                </div>
				<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
					<?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
				<?php else:?>
                    <form action="<?=URI::get_path('register/control')?>" method="POST" class="page_form" id="RegisterNotifyOGs">
                        <div class="form-group">
                            <label for="login" class="col-sm-3 control-label"><?=$lng[22]?></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control2" name="login" id="login" required maxlength="16" onkeypress="return textonly(event,'#login')"/>
                                <img id="loginOk" class="pull-right" src="<?=URI::public_path('extra/images/ok.png');?>" alt="" style="width: 20px;display: none;">
                                <img id="loginNo" class="pull-right" src="<?=URI::public_path('extra/images/no.png');?>" alt="" style="width: 20px;display: none;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pass" class="col-sm-3 control-label"><?=$lng[23]?></label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control2" name="password" id="pass"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pass2" class="col-sm-3 control-label"><?=$lng[94]?></label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control2" name="password2" id="pass2" required maxlength="30"/>
                                <img id="passOk" class="pull-right" src="<?=URI::public_path('extra/images/ok.png');?>" alt="" style="width: 20px;display: none;">
                                <img id="passNo" class="pull-right" src="<?=URI::public_path('extra/images/no.png');?>" alt="" style="width: 20px;display: none;">
                            </div>
                        </div>
						<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                            <div class="form-group">
                                <label for="pin" class="col-sm-3 control-label">PIN</label>
                                <div class="col-sm-7">
                                    <input type="password" class="form-control2" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" onkeypress="return numberonly(event,this)"/>
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
                            <label for="realname" class="col-sm-3 control-label"><?=$lng[95]?></label>
                            <div class="col-sm-7">
                                <input id="realname" type="text" name="name" class="form-control2" onkeypress="return textonly2(event,'#name')" maxlength="30" required />
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
                                <input type="text" id="phone" name="phone" class="form-control2" onkeypress="return numberonly(event,'#phone')" maxlength="10" placeholder="555-555-55-55"/>
                            </div>
                        </div>
						<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
                        <div class="form-group">
							<?php
							$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
							$findMeList->execute();
							?>
                            <label for="phone" class="col-sm-3 control-label">Bizi nerden buldunuz?</label>
                            <div class="col-sm-7">
                                <select name="findme" class="select-box">
									<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                        <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
									<?php endforeach;?>
                                </select>
                            </div>
                        </div>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') >= 1) {?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"></label>
                            <div class="col-sm-7">
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
								<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
                            </div>
                        </div>
						<?php }?>
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
            if(result.result == false){
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
            $('#pass2').notify(
                "Şifreler uyuşmuyor !",
                { position:"right" }
            );
        }
    });
    $('#pass').change(function () {
        var pass = $('#pass2').val();
        var pass2 = $(this).val();
        if(pass != ''){
            if(pass != pass2){
                $('#pass2').notify(
                    "Şifreler uyuşmuyor !",
                    { position:"right" }
                );
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