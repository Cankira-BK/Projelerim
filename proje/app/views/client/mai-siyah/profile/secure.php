<?php
    $secure = $this->secure['control'];
    $availDt = strtotime($secure['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>
<div class="main-panel panel-download">
    <div class="main-header">
        Güvenli PC
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if ($secure['status'] == 'BLOCK' || $availDt > $now):?>
                        <?=Client::alert('error',"Hesabınız banlandığı için bu işlemi gerçekleştiremiyoruz."); ?>
                    <?php endif;?>
                    <?php if ($secure['status'] == 'OK' && $availDt <= $now):?>
                    <?php if ($secure['mailaktive'] == 0):?>
                        <?=Client::alert('error','Bu işlemi kullanabilmek için önce mail aktivasyonu yapmanız gerekmektedir.')?>
                        <a href="<?=URI::get_path('profile/aktive')?>" ><button type="submit" class="center-block btn btn-grunge">Mail aktivasyon</button></a>
                    <?php else:?>
                         <?php if ($secure['mac_address'] == '0'):?>
                                <?=Client::alert('error',"Oyuna hiç giriş yapmadığınız için Güvenli PC aktif edemiyoruz. Lütfen oyunda yeni karakter oluşturup tekrar deneyiniz."); ?>
                         <?php else:?>
                                <?php if ($secure['permitted_mac_address'] == 0):?>
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
                                        echo Client::alert('success','Güvenli PC özelliğini aktifleştirmek için bir onay maili gönderilmiştir. Lütfen spam kutunuz dahil kontrol ediniz. Önemli Not : Linke tıklamadan önce oyuna giriş yapmanız ve bilgisayarınızın sistemimizde tanımlanması gerekmektedir.');
                                        Session::set('cError',false);
                                    }elseif($cError == 'time'){
                                        $now = date('i');
                                        $residual = Session::get('residual');
                                        $kalan = $now - $residual;
                                        $kalans = 11 - $kalan;
                                        echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
                                        Session::set('cError',false);
                                    }else{
                                        echo Client::alert('info','Güvenli PC Aktif Et tuşuna bastığınızda sistemde kayıtlı mail adresinize link gönderilecektir. Lütfen linki takip ederek Güvenli Bilgisayar\'ı aktifleştiriniz.');
                                    }
                                    ?>
                                    <form action="<?=URI::get_path('profile/securecreate')?>" method="POST">
                                        <div class="bg-light">
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td style="width: 150px;">
                                                        <label class="register-input" for="register-email">Şifre</label>
                                                    </td>
                                                    <td>
                                                        <input type="password" id="password" name="password" placeholder="Şifre" required>
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
                                            <button type="submit" class="btn">Güvenli PC Aktif Et</button>
                                        </div>
                                    </form>
                                <?php elseif ($secure['permitted_mac_address'] == 1):?>
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
                                    }elseif($cError == 'newAccount'){
                                        echo Client::alert('success','Yeni bir Güvenli Bilgisayar ekleyebilmek için bir onay maili gönderilmiştir. Lütfen spam kutunuz dahil kontrol ediniz. Önemli Not : Linke tıklamadan önce oyuna giriş yapmanız ve bilgisayarınızın sistemimizde tanımlanması gerekmektedir.');
                                        Session::set('cError',false);
                                    }elseif($cError == 'okCreate'){
                                        echo Client::alert('success','Yeni Bilgisayarınız Sisteme Başarıyla Tanımlanmıştır.');
                                        Session::set('cError',false);
                                    }elseif($cError == 'time'){
                                        $now = date('i');
                                        $residual = Session::get('residual');
                                        $kalan = $now - $residual;
                                        $kalans = 11 - $kalan;
                                        echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
                                        Session::set('cError',false);
                                    }
                                    ?>
                                    <div class="bg-light item-container">
                                        <div class="player-flag" style="background-color: rgba(84,14,14,0);"></div>
                                        <div class="player-informations">
                                            <h3>Kayıtlı Bilgisayarlar</h3>
                                            <div class="player-table">
                                                <?php foreach ($this->secure['data'] as $secure):?>
                                                    <div class="player-row">
                                                        <strong><i class="icon-man position-left"></i> Bilgisayar Adı:</strong>
                                                        <span><?=$secure['alias']?></span>
                                                    </div>
                                                <?php endforeach;?>
                                            </div>
                                            <h3>İşlemler</h3>
                                            <a href="<?=URI::get_path('profile/securepasif')?>"><button class="btn">Güvenli PC Pasif Et</button></a><br>
                                            <a href="<?=URI::get_path('profile/securenew')?>"><button class="btn">Yeni Kayıt Ekle</button></a><br>
                                        </div>
                                        <div class="player-flag" style="background-color: rgba(84,14,14,0);"></div>
                                    </div>
                                <?php endif;?>
                         <?php endif;?>
                        <?php endif;?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>