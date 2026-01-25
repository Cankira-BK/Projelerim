<div class="row">
    <div class="col-md-9 normal-content">
        <div class="col-md-12 no-padding-all">
            <center><h3><?=$lng[10];?></h3></center>
            <h2 class="brackets"></h2>
        </div>
    <div class="col-md-12">
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
            <form action="<?=URI::get_path('register/control')?>" id="RegisterNotifyOGs" method="post" class="form-horizontal">
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[22]?> <span
                                class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="text" class="form-control grunge" name="login" id="login" required maxlength="16" onkeypress="return textonly(event,'#login')"/>
                        <i class="fa fa-user form-control-feedback"></i>
                    </div>
                    <div class="col-sm-1">
                        <img id="loginOk" class="pull-right" src="<?=URI::public_path('images/ok.png');?>" alt="" style="width: 20px;display: none;margin-top: 10px;">
                        <img id="loginNo" class="pull-right" src="<?=URI::public_path('images/no.png');?>" alt="" style="width: 20px;display: none;margin-top: 10px;">
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[23]?> <span
                                class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="password" class="form-control grunge" name="password" id="pass"/>
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[94]?> <span
                                class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="password" class="form-control grunge" name="password2" id="pass2" required maxlength="30"/>
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                    <div class="col-sm-1">
                        <img id="passOk" class="pull-right" src="<?=URI::public_path('images/ok.png');?>" alt="" style="width: 20px;display: none;margin-top: 10px;">
                        <img id="passNo" class="pull-right" src="<?=URI::public_path('images/no.png');?>" alt="" style="width: 20px;display: none;margin-top: 10px;">
                    </div>
                </div>
				<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                    <div class="form-group has-feedback">
                        <label for="regpassword" class="col-sm-4 control-label">PIN <span
                                    class="text-danger">*</span></label>

                        <div class="col-sm-5">
                            <input type="password" class="form-control grunge" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" onkeypress="return numberonly(event,this)"/>
                            <i class="fa fa-lock form-control-feedback"></i>
                        </div>
                    </div>
				<?php endif;?>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[78]?> <span
                                class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="email" class="form-control grunge" name="email" id="email" maxlength="100" required />
                        <i class="fa fa-envelope form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[95]?> <span
                                class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input id="name" type="text" name="name" class="form-control grunge" onkeypress="return textonly2(event,'#name')" maxlength="30" required />
                        <i class="fa fa-edit form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[96]?> <span
                                class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input id="ksk" type="text" name="ksk" class="form-control grunge" onkeypress="return numberonly(event,'#ksk')" maxlength="7" required />
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[97]?> <span
                                class="text-danger"></span></label>

                    <div class="col-sm-5">
                        <input type="text" id="phone" name="phone" class="form-control grunge" onkeypress="return numberonly(event,'#phone')" maxlength="10" placeholder="555-555-55-55"/>
                        <i class="fa fa-phone form-control-feedback"></i>
                    </div>
                </div>
				<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
                <div class="form-group has-feedback">
					<?php
					$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
					$findMeList->execute();
					?>
                    <label for="findme" class="col-sm-4 control-label">Bizi nerden buldunuz? <span
                                class="text-danger"></span></label>

                    <div class="col-sm-5">
                        <select name="findme" class="form-control grunge">
							<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
							<?php endforeach;?>
                        </select>
                    </div>
                </div>
				<?php endif;?>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[24]?> <span
                                class="text-danger">*</span></label>

                    <div class="col-sm-5">
						<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-7 col-sm-offset-4">
                        <label for="terms">Üyelik Sözleşmesi</label>
                        <div class="terms">
                            <ul class="list-unstyled">
                                <li>
                                <li>Yaş Sınırlaması</li>
                                <li>13-18 Yaş arasındaki oyuncu adaylarının ebeveyn isteği dışında sisteme kayıt olmaları yasaktır.</li>
                                <li>13 Yaş altındaki oyuncu adaylarının sisteme kayıt olması kesinlikle yasaktır.</li>
                                <li>Oyun içerisinde tespit edilen 13 yaş altı oyuncuların hesapları kişinin belirtilen yaşını doldurana kadar kapatılacaktır.</li>
                                <br>
                                <li>Ücretsiz Oyun</li>
                                <li>Oyun tamamen ücretsiz olarak oynanabildiği gibi, yardımcı nesnelerin kullanımı , belirtilen fiyatlarda ödeme yapılarak sağlanabilmektedir.</li>
                                <li>Ödeme yapan kişi herhangi bir sebepten dolayı ceza alırsa veya kapatılırsa hak talebinde bulunamaz.</li>
                                <br>
                                <li>Yardımcı nesneler için kesinlikle değişim ve soyulma olaylarında iade yapılmayacaktır.</li>
                                <br>
                                <li>Geri Dönüşüm</li>
                                <li> Kullanıcıların kendi karakterlerini geliştirmek amacı ile yaptığı ödemeler karşılıksız kalmaz, Sistem Güçlendirme / Geliştirme Çalışmalarıyla kullanıcılara hizmet kalitesi olarak geri dönecektir.</li>
                                <br>
                                <li>Engelli Hesaplar</li>
                                <li>Kullanıcıların hesapları , Ceza sistemi'nde bulunan süreli veya süresiz kapatılma cezalarını aldıklarında oyun içinde faydalandıkları yardımcı nesnelerin kesinlikle iadeleri yapılmaz.</li>
                                <li>Eğer bir açık bulup bunu kendinize avantaj sağlamak için kullanırsanız oyun hesabınız cezalandırılır. Bulunan tüm oyun ve programlama açıkları derhal Destek Sistemi kullanılarak oyun takımına iletilmelidir.</li>
                                <li>Destek sistemine gönderilen sahte resim,video ve benzeri unsurlar için tarafların başlatacağı hukuki işlemlerde <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> yönetimi sorumlu değildir.</li>
                                <li>Sorumluluk, öğeyi gönderen oyuncu ve kapatılan oyuncunundur.</li>
                                <li>3-)Hiç bir oyuncu oyuna ait hiç bir ortamda diğer oyuncuları gerçek hayata yönelik olarak tehdit edemez ve gerçek hayata yönelik eylemlere zorlayamaz. Oyuna yönelik tehditler bu madde kapsamı dışındadır. Herhangi bir oyuncuyu, takım üyesini, <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> sorumlusunu, yada herhangi bir şekilde oyun servisleri ile ilgili birini bulup ona zarar verileceğine yönelik imalar ve söylemler kesinlikle yasaktır.</li>
                                <li>Oyun Yöneticileri uygun görmediği bir oyuncunun hesabını sebep belirtmeksizin kapatabilir.</li>
                                <br>
                                <li>Hesap Paylaşımı</li>
                                <li>Kullanıcı bilgilerinin paylaşımı kesinlikle yasaktır.</li>
                                <li>Hesabın veya oyun içindeki herhangi bir eşyanın, başka kişi ya da kurumlara Ücret (TL, $, EURO vs) , Oyun Parası (Yang) veya Ejder Parası (EP) karşılığında Satılması Kesinlikle yasaktır.</li>
                                <li>Serverlar arası eşya takası,alış veya satışı yasaktır.</li>
                                <li>Hesapların takası durumunda hiçbir Oyun Yöneticisi, Moderatörü vs. sorumlu tutulamaz. Tarafların kendi aralarındaki meseledir. Sorumluluk taraflarındır.</li>
                                <br>
                                <li>Dosya Paylaşımı / Hesap Soyulmaları / Eşya Çalınması</li>
                                <li>Oyun içindeki diğer kullanıcılardan veya internet bağlantılarıyla alınan dosyalardan gelebilecek olan ve bilgisayarınızda çalıştırıldığında klavyede basılan her tür harf,sayı vb. karakterlerin kaydedilmesi durumunda hesap soyulmaları meydana gelmektedir.</li>
                                <li>Hesap güvenliği tamamen kullanıcıya aittir ve bu gibi durumlarda çalınan hesap, nesne vs. geri iadesi söz konusu değildir.</li>
                                <li>Eğer ispat edilirse sadece suçlu hesap süresiz kapatılır.</li>
                                <br>
                                <li>Hesap Güvenliği</li>
                                <li><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> olarak hesabınızı güvenlik şifresi sistemi ve güvenli bilgisayar sistemi ile de ek olarak korumaktayız.</li>
                                <li>Eğer güvenli bilgisayar tanımlamazsanız hesabınızın soyulma ihtimali artar.</li>
                                <li>Soyulma durumlarında yetkililer hiçbir şekilde eşya iadesi yapmayacaklardır.</li>
                                <li>Hesabınızın çalınması durumunda yöneticilerin durum değerlendirmesine bağlı olarak hesap geri verilebilir.</li>
                                <br>
                                <li>Oyuncular Arası İletişim</li>
                                <li>Oyun içerisinde, oyuncular arası ilişkiler sonucu gerçek hayatta ortaya çıkabilecek hiçbir olaydan <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Yönetimi sorumlu tutulamaz.</li>
                                <li>Oyun kayıtları içerisinde gerçek hayata yönelik tehditler tespit edilir veya bildirilirse sorumlu hesaplar süresiz kapatılır.</li>
                                <br>
                                <li>ÖNEMLİ !</li>
                                <br>
                                <li>YAPILAN BAĞIŞ SADECE SERVER AÇIK KALMASI İÇİNDİR Yukarıda Belirtilen Maddelerde Belirtilen Durumlarda Oluşabilecek Hiçbir Sıkıntıdan Oyun Yöneticileri Sorumlu Tutulamaz.</li>
                                <li>Kurallara aykırı olan davranış ve tutumlara Hiçbir şekilde tolerans gösterilmeyecektir.</li>
                                <li>Kayıt olan , Oyuna giriş yapan ve Oyun hizmetlerinden yararlanan tüm kullanıcılar Üyelik ve Hizmet Sözleşmesini kabul etmiş sayılır.</li>
                                <li>Olası bir iade konusunda <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> takımı kanıt istemekde yükümlüdür.<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Takımını tatmin etmeyen kanıtlar geçersiz sayılıp iade işlemi yapılmayacakdır.</li>
                                <li>EP Alanlar mutlaka ScreenShot gibi kanıtlar yanlarında bulundurmalıdırlar.(Dekont,video,screenshot vs.)</li>
                                <br>
                                <li><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Yönetimi,</li>
                                <li>Üyelik ve Hizmet Sözleşmesi'nde belirtilen maddeleri değiştirme hakkını gizli tutar. </li>
                            </ul>                        </div>
                        <span>Kayıt olarak yukarıdaki üyelik sözleşmesini kabul ederim.</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-inline col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-grunge"><?=$lng[10]?></button>
                    </div>
                </div>
            </form>
        <?php endif;?>
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