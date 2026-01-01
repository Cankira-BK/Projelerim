<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1150px;">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[10]?></div>
            <div class="panel-body">
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
				<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
					<?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
				<?php else:?>
                    <form action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[22]?> </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="login" id="login" maxlength="30" required autocomplete="off">
                            </div>
                            <div class="col-sm-1">
                                <img id="loginOk" class="pull-right" src="<?=URI::public_path('images/ok.png');?>" alt="" style="width: 20px;display: none;margin-top: 5px;margin-top: 5px;float: left!important;">
                                <img id="loginNo" class="pull-right" src="<?=URI::public_path('images/no.png');?>" alt="" style="width: 20px;display: none;margin-top: 5px;margin-top: 5px;float: left!important;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[23]?></label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password" id="password" maxlength="30" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[94]?></label>
                            <div class="col-sm-5">
                                <input type="password" class="form-control" name="password2" id="password2" maxlength="30" required>
                            </div>
                            <div class="col-sm-1">
                                <img id="passOk" class="pull-right" src="<?=URI::public_path('images/ok.png');?>" alt="" style="width: 20px;display: none;margin-top: 5px;margin-top: 5px;float: left!important;">
                                <img id="passNo" class="pull-right" src="<?=URI::public_path('images/no.png');?>" alt="" style="width: 20px;display: none;margin-top: 5px;margin-top: 5px;float: left!important;">
                            </div>
                        </div>
						<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label">PIN</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" onkeypress="return numberonly(event,this)" required>
                                </div>
                            </div>
						<?php endif;?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[78]?> </label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control" name="email" id="email" maxlength="50" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[95]?> </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="name" id="name" maxlength="30" onkeypress="return textonly2(event,'#name')" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[96]?> </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="ksk" id="ksk" onkeypress="return numberonly(event,'#ksk')" maxlength="7" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[97]?> </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="phone" id="phone" onkeypress="return numberonly(event,'#phone')" maxlength="10" placeholder="555-555-55-55" required autocomplete="off">
                            </div>
                        </div>
						<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
                            <div class="form-group">
								<?php
								$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
								$findMeList->execute();
								?>
                                <label for="inputEmail3" class="col-sm-3 control-label">Bizi nerden buldunuz? </label>
                                <div class="col-sm-5">
                                    <select name="findme" class="form-control">
										<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                            <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
										<?php endforeach;?>
                                    </select>
                                </div>
                            </div>
						<?php endif;?>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[24]?></label>
                            <div class="col-sm-5">
								<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-giris" style="margin-top: 10px;"> <?=$lng[10]?></button>
                            </div>
                        </div>
                    </form>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>


