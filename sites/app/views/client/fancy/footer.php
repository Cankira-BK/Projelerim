<footer class="footer">
    <div class="soc-block">
        <div class="social">
            Bizi Takip Edin :
            <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" class="fb" target="_blank"></a>
            <a href="<?=\StaticDatabase\StaticDatabase::settings('instagram')?>" class="inst" target="_blank"></a>
        </div>
    </div>
    <div class="footer-logo">
    </div>
    <br>
    <br>
    <div class="footer-menu">
        <ul>
            <li><a href="<?=URI::get_path('index')?>">Anasayfa</a></li>
            <li><a href="<?=URI::get_path('download')?>">Oyunu İndir</a></li>
            <li><a href="<?=URI::get_path('recuperare')?>">Şifremi Unuttum</a></li>
            <li><a href="<?=URI::get_path('privacy')?>">Üyelik Sözleşmesi</a></li>
            <li><a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>">Tanıtım</a></li>
            <li><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">Facebook</a></li>
            <li><a href="<?=\StaticDatabase\StaticDatabase::settings('instagram')?>">İnstagram</a></li>
        </ul>
    </div>
    <div class="copyright">
        Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
        Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br />
        <a href="https://www.viphosting.com.tr" target="_blank"><img src="<?=URL.'data/upload/logo-white-mini.png'?>" style="display: block;width: 100px;margin-right: auto;margin-left: auto;" alt="Metin2 PVP Sunucuları"></a>
    </div>
</footer>
</div>
<div class='modal_window' id="reg_modal">
    <a href="#" class='close_mw close-r'></a>
    <div class="popup-block">
        <div class="reg-title">
            Hızlı Kayıt Ol
        </div>
        <div class="reg-form">
			<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
				<?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
			<?php else:?>
			    <?php if (isset($_SESSION['aid'])):?>
					<?php echo Client::alert('error','Zaten giriş yaptınız!');?>
                <?php else:?>
                    <form id="registerFormMaster" action="<?=URI::get_path('register/control')?>" method="POST" class="page_form" autocomplete="off">

                        <p><?=$lng[22]?></p>
                        <input type="text" class="form-control" name="login" id="registerLogin" required maxlength="16"/>

                        <p><?=$lng[23]?></p>
                        <input type="password" class="form-control" name="password" id="registerPassword" required maxlength="30"/>

                        <p><?=$lng[94]?></p>
                        <input type="password" class="form-control" name="password2" id="registerPassword2" required maxlength="30"/>

						<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                            <p>PIN</p>
                            <input type="password" class="form-control" name="pin" id="registerPin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required/>
						<?php endif;?>

                        <p><?=$lng[78]?></p>
                        <input type="email" class="form-control" name="email" id="registerEmail" required />

                        <p><?=$lng[95]?></p>
                        <input id="registerName" type="text" name="name" class="form-control" maxlength="60" required />

                        <p><?=$lng[96]?></p>
                        <input id="registerKsk" type="text" name="ksk" class="form-control" maxlength="7" required />

                        <p><?=$lng[97]?></p>
                        <input type="text" id="registerPhone" name="phone" class="form-control" maxlength="10" placeholder="555-555-55-55" required/>
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

                        <div id="recaptchaRegister" class="g-recaptcha" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>

                        <br><br>
                        <div>
                            <span>Kayıt olarak <a href="javascript:void(0);" onclick='new modal("#sozlesme"); return false' target="_blank">üyelik sözleşmesini</a> kabul ederim.</span>
                        </div>
                        <div class="reg-buttons">
                            <center>
                                <button class="cont button-bg button-n" type="button" style="width: 100%" onclick="registerFormFunction();">Kayıt Ol</button>
                            </center>
                        </div>
                    </form>

				<?php endif;?>
			<?php endif;?>
        </div>
    </div>
</div>
<div class='modal_window' id="login_modal">
    <a href="#" class='close_mw close-r'></a>
    <div class="popup-block">
        <div class="reg-title">
			<?=$lng[21]?>
        </div>
        <div class="reg-form">
			<?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare'):?>
                <form id="loginFormMaster" action="<?=URI::get_path('login/control')?>" method="POST" autocomplete="off">
                    <p><?=$lng[22]?></p>
                    <input type="text" placeholder="<?=$lng[22]?>" name="login" id="login" maxlength="16" required>

                    <p><?=$lng[23]?></p>
                    <input type="password" placeholder="<?=$lng[23]?>" name="password" id="password" required>
					<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                        <p>PIN</p>
                        <input type="password" placeholder="PIN" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" required>
					<?php endif;?>

                    <div id="recaptchaLogin" class="g-recaptcha" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>

                    <div class="login-buttons" style="margin-top: 15px;margin-bottom: 15px;">
                        <button class="button-bg button-n" type="button" style="width: 100%" onclick="loginFormFunction();">Giriş Yap</button>
                    </div>
                </form>
                <br>
                <p>
                    <a href="<?=URI::get_path('recuperare/index')?>" style="text-transform: none;">Şifremi unuttum?</a>
                </p>
                <p>
                    <a href="<?=URI::get_path('recuperare/account')?>" style="text-transform: none;">Kullanıcı adımı unuttum?</a>
                </p>
				<?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
                    <p>
                        <a href="<?=URI::get_path('recuperare/pin')?>" style="text-transform: none;">PIN unuttum?</a>
                    </p>
				<?php endif;?>
            <?php else:?>
				<?php echo Client::alert('error','Bu sayfadayken giriş yapamazsınız!');?>
            <?php endif;?>
        </div>
    </div>
</div>
<div class='modal_window sozlesme_page' id="sozlesme">
    <a href="#" class='close_mw close-r'></a>
    <div class="popup-block">
        <div class="reg-title">
            Üyelik Sözleşmesi
        </div>
        <div class="reg-form">
            <p style="text-align: center;">
            <p>Her oyuncu hesap bilgilerini gizli tutmakla yükümlüdür.</p>
            <p>Bir hesabı sadece hesabın kayıtlı olduğu mail adresinin sahibi kullanabilir (hesap paylaşılamaz, satılamaz, devir edilemez ve ortak kullanılamaz) <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> takımı kaybedilen veya çalınan eşyaların iadesini yapmayacaktır.</p>
            <p>Hesap bilgilerinin bir başkası tarafından kullanılması ve bilinmesi tamamıyle sizin sorumluluğunuzdadır. (hesap satmaya teşebbüs etmek, ortak kullanmak, Skype Facebook benzeri yerlerden ve kişilerden dosya almak bunların verdiği linklere tıklamak, şahısların vermiş olduğu sahte sitelere girmek ve bilgilerinizi oradaki formlara girmek, hesap satın almak veya teşebbüs etmek, aldığınız hesabı kullanmak.) Bu durum, oyun sözleşmesinin 1. maddesi hesap bilgilerini gizli tutmamak, sahip çıkmamak ve aşağıda belirtilen ortak hesap kullanımı yada hesap alım satım takası suçlarının vuku bulduğu anlamına gelir. Buna istinaden ticket ile başvuru yaptığınızda çalındığını idda ettiğiniz hesap ve karşı tarafın bütün hesapları süresiz kapatılır. Sizede hesap iade edilmez. (Uyarılarımızı dikkate almayıp düştüğünüz durumdur ve bu sizinde kesinlikle kural ihlali yaptığınız anlamına gelir.)</p>
            <p>Eğer bir açık bulup bunu kendinize avantaj sağlamak için kullanırsanız oyun hesabınız süresiz olarak kapatılır.</p>
            <p>Bulunan tüm oyun ve programlama açıkları derhal Destek Sistemi kullanılarak oyun takımına iletilmelidir.</p>
            <p>Servislerin herhangi birinde (Facebook,Youtube,Forum, IRC, vb) gösterilen uygunsuz davranışların oyun içerisinde verilecek cezalarla sonuçlanabileceğini hesaba katmanız faydalı olacaktır.</p>
            <p><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> takımı olarak 'biz', herhangi bir duyuru veya bildirim yapmadan oyun kurallarında herhangi bir zamanda değişiklik yapma/revize etme hakkını saklı tutarız.</p>
            <p>Genel Kullanım Şartları kuralların üzerindedir ve kurallarla bütün halde uygulanır.</p>
            <p>Hiç bir oyuncu oyuna ait hiç bir ortamda diğer oyuncuları gerçek hayata yönelik olarak tehdit edemez ve gerçek hayata yönelik eylemlere zorlayamaz.</p>
            <p>Oyuna yönelik tehditler bu madde kapsamı dışındadır. Herhangi bir oyuncuyu, takım üyesini, <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> görevlisini, yada herhangi bir şekilde oyun servisleri ile ilgili birini bulup ona zarar verileceğine yönelik imalar ve söylemler kesinlikle yasaktır.</p>
            <p><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> sunucularının resmi dili Türkçedir. Oyun Sunucuları, Forum, resmi IRC kanalları bu kurala dahildir ancak bu kural yalnızca bu alanlarla sınırlı değildir.</p>
            <p>Sohbette kaba/argo dil kullanımı ve küfür yasaktır. Spam (Sürekli olarak aynı mesajın tekrarlanması), www.<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>.com oyun ve forum linkleri dışındaki linklerin paylaşılması, hile reklamı, hile talebi, yang satış reklamı vs. yasaktır.</p>
            <p>Oyun takımının kararları için itiraz ancak Destek Sistemi üzerinden yapılabilir.</p>
            <p>Destek sistemi üzerinden bir konu ile ilgili tek bir ticket açarak bildirim yapmalısınız.</p>
            <p>Aynı ticket üzerinden cevap gelmeden tekrar tekrar yazmanız cevap alma sürenizi geciktirmekten başka bir fayda sağlamayacaktır.</p>
            <p>Oyunun kullanıcı hesabı ve materyallerini gerçek para ile satmaya kalkışmak, satmak ve satın almak gibi eylemler kesinlikle yasaktır. Hiç bir kullanıcının böyle bir hakkı yoktur.</p>
            <p>Detaylı incelemelere sonucu bu faaliyette bulunan kullanıcıların hesapları süresiz olarak kapatılır!</p>
            <p>Eğer bir oyuncunun kurallara aykırı hareket ettiğini düşünüyorsanız bunu video kaydı alarak Destek Sistemi üzerinden en geç 2 gün içinde yönetime iletiniz.</p>
            <p>Aksi halde şikayetiniz işleme konulmayacaktır.Bu yüzden oyundaki sol üst köşedeki tarih göstergesini kapatmayınız! Oyundaki sağ taraftaki server ismi kesinlikle gözükmelidr.Aksi halde şikayetiniz bu yüzdende işleme konulmayacaktır. <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> takımı ilgili şikayetinizi inceleyerek, kural ihlali olup olmadığına karar verecek ve gerekiyorsa ceza sisteminde belirtilen yaptırımı uygulayacaktır.</p>
            <p>Eğer bir oyun yöneticisinin kurallara aykırı hareket ettiğini düşünüyorsanız bunu ilgili delilleri ile birlikte ticket yoluyla bir üst yönetiye iletebilirsiniz.</p>
            <p>Nesnelerin kontör & TL ile ticareti yasaktır.Bu tarz satış yapan ve alan kullanıcılar tespit edildiğinde karakteri süresiz olarak kapatılacaktır.</p>
            <p>Bu tarz satış yapan kişiden nesne alanda kullanıcıların kontör & TL yollayıp nesnesini vermez ise veya tam tersi nesne verip kontör & TL yollamaz ise <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> yönetimine hiçbir hak talep edemez.(Bu sebepten dolayı hesabı kısıtlanan oyuncu ve/veya oyuncular – lonca veya topluluklar yasal olarak hiçbir hak talep edemezler ve suç duyurusunda bulunamazlar.)</p>
            <p><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> yöneticileri kullanıcı hesaplarını sebepsiz olarak açabilir ya da kapatabilir.</p>
            <p>Bu insiyatif yöneticiler de bulunmaktadır.</p>
            <p>Yasal talep gelmesi durumunda, <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> oyunu, sitesi, bağlı bulunduğu şirket veya bağlı ortaklarına karşı hukuki uygunluk durumlarında, oyunu ve firmanın haklarını korumak ve müdafaa gerektiren durumlarda, olağandışı veya acil durumlarda, firmanın, oyunun ve halkın güvenliğini korumaya yönelik işlemlerde kişisel bilgiler ifşa edilebilir.</p>
            <p>Kayıt olan her kullanıcı oyunun kurallarına uyacağına ve uymadığı taktir de hesabının kapatılacağını onaylar. Oyun kurallarına buradan erişilebilir.</p>
            <p>Kayıt olan her kullanıcı, yukarıdaki maddeleri okuduğunu, uygulayacağını ve kullanıcı sözleşmesini kabul ettiğini taahhüt eder!</p>
            <p><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> bu kuralları istediği anda haber vermeden değiştirme hakkını saklı tutar.</p>
            <p>Bu üyelik ve hizmet sözleşmesi sayfası en son 04.01.2017 tarihinde güncellenmiştir.</p>
            <p>Bu gizlilik politikasıyla ilgili herhangi bir sorunuz varsa, aşağıdaki bilgileri kullanarak bizimle iletişime geçebilirsiniz. info@<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>.com</p>
            <p></p>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?=URI::public_path('assets/js/jquery-2.1.4.min.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('assets/js/modal.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('assets/js/slider.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('assets/js/mask.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('assets/js/fancybox.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('main/js/notify.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('notify/js/notify.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('notify/js/prettify.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('notify/js/notify-function.js')?>"></script>
<script type="text/javascript" src="<?=URI::public_path('assets/js/main.js')?>"></script>

<?php if (\StaticDatabase\StaticDatabase::settings('discord_status') == "1"):?>
    <style>

        .discord-widget {
            position: fixed;
            bottom: 0;
            z-index:10;
        }


        .discord-widget.active
        {
            right: 20px;
        }
    </style>
    <a class="discord-widget animated bounceInLeft" href="<?php echo \StaticDatabase\StaticDatabase::settings('discord_link')?>" title="Join us on Discord">
        <img src="https://discordapp.com/api/guilds/<?php echo \StaticDatabase\StaticDatabase::settings('discord_id')?>/embed.png?style=<?php echo \StaticDatabase\StaticDatabase::settings('discord_theme')?>">
    </a>
<?php endif;?>

<?php if (\StaticDatabase\StaticDatabase::settings('tawkto_status') == "1"):?>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/'+"<?php echo \StaticDatabase\StaticDatabase::settings('tawkto_id')?>"+'/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
<?php endif;?>

</body>
</html>
