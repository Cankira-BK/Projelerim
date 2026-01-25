<?php
    $ban = $this->securepasif;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>
<div class="main-panel panel-download">
    <div class="main-header">
        Güvenli PC Pasif Etme
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
                        <?=Client::alert('error',"Hesabınız banlandığı için bu işlemi gerçekleştiremiyoruz."); ?>
                    <?php endif;?>
                    <?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
                        <?php if ($ban['mailaktive'] == 0):?>
                            <?=Client::alert('error','Bu işlemi kullanabilmek için önce mail aktivasyonu yapmanız gerekmektedir.')?>
                            <a href="<?=URI::get_path('profile/aktive')?>" ><button type="submit" class="center-block btn btn-grunge">Mail aktivasyon</button></a>
                        <?php else:?>
                            <?php
                            $cError = Session::get('cError');
                            if($cError == 'recaptcha'){
                                echo Client::alert('error','Captcha yanlış işlem yaptınız. Lütfen tekrar deneyiniz.');
                                Session::set('cError',false);
                            }elseif($cError == 'filter'){
                                echo Client::alert('error','Şifrenizi hatalı girdiniz. Lütfen tekrar deneyiniz.');
                                Session::set('cError',false);
                            }elseif($cError == 'error'){
                                echo Client::alert('error','Şifrenizi hatalı girdiniz. Lütfen tekrar deneyiniz.');
                                Session::set('cError',false);
                            }elseif($cError == 'OK'){
                                echo Client::alert('success','Güvenli PC pasifleştirme linki mail adresinize gönderilmiştir. Lütfen kontrol ediniz.');
                                Session::set('cError',false);
                            }elseif($cError == 'time'){
                                $now = date('i');
                                $residual = Session::get('residual');
                                $kalan = $now - $residual;
                                $kalans = 11 - $kalan;
                                echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
                                Session::set('cError',false);
                            }else{
                                echo Client::alert('info','Güvenli PC pasifleştir tuşuna bastığınızda sistemde kayıtlı mail adresinize link gönderilecektir. Lütfen linki takip ederek depo şifrenizi değiştiriniz.');
                            }
                            ?>
                            <form action="<?=URI::get_path('profile/securepasifchange')?>" method="POST">
                                <div class="bg-light">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td style="width: 150px;">
                                                <label class="register-input" for="register-email">Şifre</label>
                                            </td>
                                            <td>
                                                <input type="password" id="password" name="password" maxlength="20"
                                                       placeholder="Şifre" required>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="register-input" for="register-email" style="margin-top: -23px;">Kontrol</label>
                                            </td>
                                            <td>
                                                <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn">Güvenli PC Pasifleştir</button>
                                </div>
                            </form>
                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>