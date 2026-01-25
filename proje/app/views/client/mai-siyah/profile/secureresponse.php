<div class="main-panel panel-download">
    <div class="main-header">
        Güvenli PC
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if($this->response['result'] == 'false'): ?>
                        <?php echo Client::alert('error','Sistem : Bu alana giriş yetkiniz yok.');?>
                    <?php elseif ($this->response['result'] == 'error'):?>
                        <?php echo Client::alert('error','Giriş yaptığınız bilgisayar sistemde kayıtlı olduğu için ekleme işlemi gerçekleşmedi. Yeni kayıt eklemek için lütfen eklemek istediğiniz bilgisayardan oyuna giriş yaptıkdan sonra tekrar deneyin.');?>
                    <?php elseif ($this->response['result'] == 'empty'):?>
                        <?php echo Client::alert('error','Yeni kayıt eklemek için lütfen eklemek istediğiniz bilgisayardan oyuna giriş yaptıkdan sonra tekrar deneyin.');?>
                    <?php elseif ($this->response['result'] == 'true'):?>
                        <?php
                        $cError = Session::get('cError');
                        if($cError == 'recaptcha'){
                            echo Client::alert('error','Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.');
                            Session::set('cError',false);
                        }elseif($cError == 'filter'){
                            echo Client::alert('error','Lütfen ç,ı,ü,ğ,ö,ş,İ,Ğ,Ü,Ö,Ş,Ç karakterlerini kullanmayınız.');
                            Session::set('cError',false);
                        }elseif($cError == 'error'){
                            echo Client::alert('error','Şifrenizi hatalı girdiniz. Lütfen tekrar deneyiniz.');
                            Session::set('cError',false);
                        }elseif($cError == 'OK'){
                            echo Client::alert('success','Depo şifresi değiştirme linki mail adresinize gönderildi. Lütfen kontrol ediniz.');
                            Session::set('cError',false);
                        }elseif($cError == 'time'){
                            $now = date('i');
                            $residual = Session::get('residual');
                            $kalan = $now - $residual;
                            $kalans = 11 - $kalan;
                            echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
                            Session::set('cError',false);
                        } ?>
                        <?= Client::alert('info',"Son giriş yaptığınız bilgisayar Güvenli PC olarak eklenecektir. Bilgisayar Adı seçeneği daha sonra hatırlamanız için bir takma addır. Örneğin: EV")?>
                        <form action="<?=URI::get_path('profile/securechange')?>" method="POST">
                            <div class="bg-light">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td style="width: 150px;">
                                            <label class="register-input" for="register-email">Şifre:</label>
                                        </td>
                                        <td>
                                            <input type="password" id="password" name="password" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 150px;">
                                            <label class="register-input" for="register-email">Bilgisayar Adı:</label>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control grunge" name="secure" id="secure" required/><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="register-input" for="register-email" style="margin-top: -23px;">Kontrol:</label>
                                        </td>
                                        <td>
                                            <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn">Onayla</button>
                            </div>
                        </form>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>