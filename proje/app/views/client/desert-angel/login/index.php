<div class="main-panel panel-download">
    <div class="main-header">
		<?=$lng[21]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php
                        $cError = Session::get('cError');
                        if($cError == 'recaptcha'){
                            echo Client::alert('error','Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.');
                            Session::set('cError',false);
                        }elseif($cError == 'filter'){
                            echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
                            Session::set('cError',false);
                        }elseif($cError == 'empty'){
                            echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
                            Session::set('cError',false);
                        } elseif($cError == 'error'){
                            echo Client::alert('error','Hatalı kullanıcı adı veya şifre. Lütfen tekrar deneyiniz.');
                            Session::set('cError',false);
                        } elseif ($cError == 'OK') {
							echo Client::alert('success','Kayıt işlemi başarılı. Lütfen giriş yapınız!');
							Session::set('cError',false);
                        }
                    ?>
                    <form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="POST">
                        <div class="bg-light">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input" for="register-login"><?=$lng[22]?>:</label>
                                    </td>
                                    <td>
                                        <input type="text" id="login" name="login" placeholder="<?=$lng[22]?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <label class="register-input" for="register-email"><?=$lng[23]?></label>
                                    </td>
                                    <td>
                                        <input type="password" id="password" name="password" maxlength="20"
                                               placeholder="<?=$lng[23]?>">
                                    </td>
                                </tr>
								<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                                <tr>
                                    <td>
                                        <label class="register-input" for="register-email">PIN</label>
                                    </td>
                                    <td>
                                        <input type="password" id="pin" name="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>"
                                               placeholder="PIN">
                                    </td>
                                </tr>
                                <?php endif;?>
                                <tr>
                                    <td>
                                        <label class="register-input" for="register-email" style="margin-top: -23px;"><?=$lng[24]?></label>
                                    </td>
                                    <td>
                                        <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn"><?=$lng[21]?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>