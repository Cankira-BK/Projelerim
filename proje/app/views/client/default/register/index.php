<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[10]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
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
						echo Client::alert('error','Karakter Güvenlik Şifreniz 4 haneli olmalıdır.');
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
                    <form action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs BirForm" method="post">
                        <table border="0" align="center" width="100%">
                            <tbody>
                            <tr>
                                <td align="center"><label><?=$lng[22]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="login" type="text" id="username" maxlength="30" required autocomplete="off"></label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[23]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input name="password" type="password" id="password" maxlength="30" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[94]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input type="password" name="password2" id="password2" maxlength="30" required></label>
                                </td>
                            </tr>
							<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') == 1) {?>
							<tr>
								<td align="center"><label>Pin Kodu :<span style="color:darkred;text-shadow:none;">*</span><br>
									<input type="password" name="pin" id="pin" maxlength="4" required autocomplete="off"></label>
								</td>
							</tr>
							<?php }?>
                            <tr>
                                <td align="center"><label><?=$lng[78]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input type="text" name="email" id="email" maxlength="50" required autocomplete="off"></label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[95]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input type="text" name="name" id="name" maxlength="30" required autocomplete="off"></label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[96]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input type="text" name="ksk" id="ksk" maxlength="7" required autocomplete="off"></label>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"><label><?=$lng[97]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
                                        <input type="text" name="phone" id="phone" maxlength="10" placeholder="555-555-55-55" required autocomplete="off"></label>
                                </td>
                            </tr>
							<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
                             <tr>
								<?php
								$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
								$findMeList->execute();
								?>
                                 <td align="center"><label>Bizi nerden buldunuz? :<span style="color:darkred;text-shadow:none;">*</span><br>
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
                                <td align="center"><label><?=$lng[24]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
										<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
										<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
                                    </label>
                                </td>
                            </tr>
							<?php }?>
                            <tr>
                                <td align="center">
                                    <br>
                                    <input type="submit" value="<?=$lng[10]?>">
                                    <div class="clear"></div>
                                    <br>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
					<?php endif;?>
                </div>
            </div>
        </div
    </div>
</div>
</div>


