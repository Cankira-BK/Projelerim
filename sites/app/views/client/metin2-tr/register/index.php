<style>
    .select-box{
        background: url(http://gf2.geo.gfsrv.net/cdnac/a29fbb433fe4ad8ae6273a65f290e0.gif) repeat-x;
        border: 1px solid #622400;
        color: #534236;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 16px;
        font-weight: bold;
        height: 32px;
        padding: 5px 10px;
        width: 265px;
    }
</style>
<div role="main">
    <div id="login" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2><?=$lng[10];?></h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <div class="trenner"></div>
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
                            <form name="loginForm" action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs" method="POST">
                                <div>
                                    <label for="username"><?=$lng[22]?>: *</label>
                                    <input type="text" name="login" id="login" required maxlength="16">
                                </div>
                                <div>
                                    <label for="password"><?=$lng[23]?>: *</label>
                                    <input type="password" id="password" name="password" required maxlength="32" value="">
                                </div>
                                <div>
                                    <label for="password"><?=$lng[94]?>: *</label>
                                    <input type="password" id="password2" name="password2" required maxlength="32" value="">
                                </div>
								<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                    <div>
                                        <label for="pin">PIN: *</label>
                                        <input type="password" id="pin" name="pin" required maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" value="">
                                    </div>
								<?php endif;?>
                                <div>
                                    <label for="password"><?=$lng[78]?>: *</label>
                                    <input type="email"name="email" id="email" required value="">
                                </div>
                                <div>
                                    <label for="password"><?=$lng[95]?>: *</label>
                                    <input type="text" name="name" id="name" required value="">
                                </div>
                                <div>
                                    <label for="password"><?=$lng[96]?>: *</label>
                                    <input type="text" id="ksk" name="ksk" maxlength="7" required value="">
                                </div>
                                <div>
                                    <label for="password"><?=$lng[97]?>: *</label>
                                    <input type="text" id="phone" name="phone" maxlength="10" placeholder="555-555-55-55" required value="">
                                </div>
								<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
                                <div>
									<?php
									$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
									$findMeList->execute();
									?>
                                    <label for="password">Bizi nerden buldunuz?: *</label>
                                    <select name="findme" class="select-box">
										<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                            <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
										<?php endforeach;?>
                                    </select>
                                </div>
								<?php endif;?>
                                <div>
                                    <label for="password"><?=$lng[24]?>: *</label>
                                    <script src='https://www.google.com/recaptcha/api.js'></script>
                                    <div class="g-recaptcha rc-anchor-dark" style="    transform: scale(0.90);margin-left: -17px;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
                                </div>
                                <input id="submitBtn" class="btn-big" type="submit" name="SubmitLoginForm" value="<?= $lng[10] ?>">
                            </form>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
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