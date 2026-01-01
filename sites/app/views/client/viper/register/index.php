<style>
    .g-recaptcha{
        margin-top: 15px;
    }
</style>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
                Kayıt Ol
            </center>
        </div>
        <div class="panel-body">
			<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
				<?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
			<?php else:?>
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
				<form action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs" method="POST" class="form-template" autocomplete="off">

                    <p><?=$lng[22]?></p>
                    <input type="text" class="form-control" name="login" id="login" required maxlength="16"/>

                    <p><?=$lng[23]?></p>
                    <input type="password" class="form-control" name="password" id="password" required maxlength="30"/>

                    <p><?=$lng[94]?></p>
                    <input type="password" class="form-control" name="password2" id="password2" required maxlength="30"/>

					<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                        <p>PIN</p>
                        <input type="password" class="form-control" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required/>
					<?php endif;?>

                    <p><?=$lng[78]?></p>
                    <input type="email" class="form-control" name="email" id="email" required />

                    <p><?=$lng[95]?></p>
                    <input id="name" type="text" name="name" class="form-control" maxlength="60" required />

                    <p><?=$lng[96]?></p>
                    <input id="ksk" type="text" name="ksk" class="form-control" maxlength="7" required />

                    <p><?=$lng[97]?></p>
                    <input type="text" id="phone" name="phone" class="form-control" maxlength="10" placeholder="555-555-55-55" required/>
					<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
						<?php
						$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
						$findMeList->execute();
						?>
                        <p>Bizi Nereden Buldunuz ?</p>
                        <select name="findme" class="select-box">
                            <option value="0" selected>Lütfen seçiniz...</option>
							<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
							<?php endforeach;?>
                        </select>
					<?php endif;?>

					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>

                    <br><br>
                    <div>
                        <span>Kayıt olarak <a href="javascript:void(0);" onclick='new modal("#sozlesme"); return false' target="_blank">üyelik sözleşmesini</a> kabul ederim.</span>
                    </div>
                    <div class="reg-buttons">
                        <center>
                            <button class="cont button-bg button-n" type="submit" style="width: 100%">Kayıt Ol</button>
                        </center>
                    </div>
                </form>
			<?php endif;?>
        </div>
    </div>
</main>