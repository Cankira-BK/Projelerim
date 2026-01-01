<footer class="footer">
  <div class="toTopBlock">
    <span class="toTop"></span>
  </div>
  <ul class="footer-menu">
    <li><a href="<?=URI::get_path('download')?>"><?=$lng[0]?></a></li>
    <li><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[65]?></a></li>
    <li><a href="<?=URI::get_path('ranked/guild')?>"><?=$lng[66]?></a></li>
    <li><a href="<?=URI::get_path('privacy')?>"><?=$lng[171]?></a></li>
    <li><a target="_blank" href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">Facebook</a></li>
    <li><a target="_blank" href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>"><?=$lng[14]?></a></li>
    <li><a target="_blank" href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>"><?=$lng[175]?></a></li>
      </ul>
  <div class="copy text-center">
    <p>Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
	Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.</p>
                          </div>
</footer>
  <div class="modal fade" id="sozlesme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Üyelik Sözleşmesi</h4>
        </div>
        <div class="modal-body">
          <p><p>HİZMET S&Ouml;ZLEŞMESİ<br />
1-) Kayıt olan her oyuncu, hesap bilgilerini gizli tutmakla y&uuml;k&uuml;ml&uuml;d&uuml;r. Bir hesabı sadece hesabın kayıtlı olduğu mail adresinin sahibi kullanabilir. Hesap alım satımı, devir-takas işlemleri yapılamaz. Hesabın bilgilerinin bir şekilde ele ge&ccedil;irilmesinden doğacak olan t&uuml;m sorumluluk oyuncunun kendisine aittir. <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetleri bu konuda hi&ccedil;bir sorumluluk kabul etmez.</p>

<p>2-) Kayıt olan her oyuncu, hesabını hi&ccedil;bir şekilde bir başkasına devredemez satış işlemi yapamaz. Hesabını satmaya ya da devretmeye &ccedil;alışan oyuncu tespit edildiğinde hesabı s&uuml;resiz olarak erişime engellenir.</p>

<p>3-) Kayıt olan her oyuncu, hesap bilgilerini gizli tutmak ile y&uuml;k&uuml;ml&uuml;d&uuml;r. Hesap bilgileri k&ouml;t&uuml; niyetli kişiler tarafından ele ge&ccedil;irildiğinde ya da oyuncu tarafından bir başkasına hesap bilgileri bilerek ve bilmeyerek paylaşıldığında ortaya &ccedil;ıkacak t&uuml;m sorumluluk oyuncunun kendisine aittir. <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetleri hi&ccedil;bir şekilde iade ya da tazmin işlemi ger&ccedil;ekleştirmez.</p>

<p>4-) Kayıt olan her oyuncu, <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetlerini bilgisayarına indirip oynamaya başladığında, herhangi bir şekilde oyunun yazılımı başta olmak &uuml;zere her t&uuml;rl&uuml; nedenden dolayı ortaya &ccedil;ıkan oyun hatası durumunu oyun y&ouml;neticilerine bildirmekle y&uuml;k&uuml;ml&uuml;d&uuml;r. Tespit edilen oyun a&ccedil;ıklarını yararına kullanmak kesinlikle kabul edilemez bir durumdur. Tespit edilen oyuncu ya da oyuncular s&uuml;resiz olarak oyundan uzaklaştırılacaktır.</p>

<p>5-) Kayıt olan her oyuncu, oyuna ait hi&ccedil;bir platform da diğer oyuncuları ger&ccedil;ek hayatı tehdit edici zorlayıcı bilerek maddi manevi zarar verici olay ve durumlarda bulunamaz. Bu tarz eylem ve davranışta bulunan oyuncu ya da oyuncular oyundan uzaklaştırılırlar. Bu eylem sonucunda uygulanacak olan uzaklaştırma cezasının s&uuml;resi konusunda karar <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetleri y&ouml;neticilerine aittir.</p>

<p>6-) <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetleri resmi dili T&uuml;rk&ccedil;edir. Oyun i&ccedil;erisinde ya da oyuna ait olan herhangi bir platformda sosyal medya hesapları da dahil olmak &uuml;zere oyuncular genel ahlak kurallarına aykırı konuşmalarda bulunamaz. Bu gibi durumlarda bulunduğu tespit edilen oyuncular caydırıcı nitelikli olarak hesapları s&uuml;reli olarak engellenir.</p>

<p>7-) Kayıt olan her oyuncu, oyuncu hesabı ve oyun i&ccedil;i materyalleri ger&ccedil;ek para ile satamaz. Gerek internet &uuml;zerinde sosyal medya hesapları, facebook, internet siteleri gerek y&uuml;z y&uuml;ze elden takas yoluyla gelir elde etmek amacıyla satılamaz. Satış yaptığı tespit edilen oyuncu yada oyuncular oyuna giriş sağladığı t&uuml;m hesapları ve bilgisayarları detaylı olarak incelenir ve bunun neticesinde s&uuml;resiz olarak erişime kapatılır.</p>

<p>8-) Kayıt olan her oyuncu, hizmet s&ouml;zleşmesi 7. Maddesini ihlal ettiği tespit edildiğinde o g&uuml;ne kadar oyun ile ilgili maddi ve manevi hi&ccedil;bir hak iddia edemez. Oyuna yatırmış olduğu paranın iadesini isteyemez.</p>

<p>9-) <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetleri, 7 maddeyi ihlal eden bir oyuncunun tespit edilmesi halinde, bu maddenin ihlalinden doğan maddi ya da manevi t&uuml;m zararlarını tazmin etme hakkını saklı tutar.</p>

<p>10-) Kayıt olan her oyuncu haksız rekabet yaratacak durumlarda bulunmayacağını ve oyunun genel ahlaki değerlerine aykırı davranışta bulunmayacağını taahh&uuml;t eder. Bu bağlamda oyun i&ccedil;erisinde yada <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetlerine ait olan herhangi bir platformda ortaya &ccedil;ıkacak kural ihlallerinde aşağıda belirtilen cezai işlemin uygulanmasını kabul eder.</p>

<p>10.1) Hile ve bot Kullanmak: S&Uuml;RESİZ.</p>

<p>10.2) Farklı oyunların yada oyun i&ccedil;erisinde rekabet yaratacak bir şeyin reklamını yapmak: S&Uuml;RESİZ.</p>

<p>10.3) Uygunsuz karakter ismi (Genel ahlaka aykırı toplum tarafından kabul g&ouml;rmeyecek isimler ) S&Uuml;RESİZ</p>

<p>10.4) Dini değerlere, Bayrağa ve Ataya hakaret etmek: S&Uuml;RESİZ.</p>

<p>10.5) Siyasi karakter ve lonca ismi kullanmak: S&Uuml;RESİZ.</p>

<p>10.6) Kendini oyun y&ouml;neticisi olarak tanıtarak oyuncuyu dolandırmaya &ccedil;alışmak ya da oyun y&ouml;neticisi olduğunu iddia etmek: S&Uuml;RESİZ.</p>

<p>10.7) Kendini oyun y&ouml;neticisi yakını olarak g&ouml;sterme tehdit etmek yada oyun y&ouml;neticisinin yakını olduğunu s&ouml;yleyerek oyuncuyu dolandırmaya &ccedil;alışmak: S&Uuml;RESİZ.</p>

<p>10.8) Ahlaksız teklifte bulunma:S&Uuml;RESİZ.</p>

<p>10.9) Hesap alım satımı yapmak: S&Uuml;RESİZ.</p>

<p>10.10) Oyunda Provokat&ouml;rl&uuml;k yapmak: S&Uuml;RESİZ.</p>

<p>10.11) İftira Atmak:12 SAAT CHAT BAN.</p>

<p>10.12) Ortak hesap paylaşımı: S&Uuml;RESİZ. (Y&ouml;neticinin takdirinde olan bir durumdur, ben ortak hesap kullanıyorum diyen oyuncuya bu işlem uygulanmaz.)</p>

<p>10.13) Hırsızlık yapmaya teşebb&uuml;s etmek ve Dolandırıcılık yapmak: S&Uuml;RESİZ.</p>

<p>11-) Oyun Y&ouml;neticileri bir hesabı yukarıdaki kurallara uysun ya da uymasın s&uuml;reli ya da s&uuml;resiz olarak ceza uygulayabilir. Servislerin herhangi birinde (Facebook,Youtube,Forum, IRC, vb) g&ouml;sterilen uygunsuz davranışlar oyun i&ccedil;erisinde yapılmış gibi algılanıp cezai işlem uygulanabilir.</p>

<p>12-) Eğer bir oyuncunun kurallara aykırı hareket ettiğini d&uuml;ş&uuml;n&uuml;yorsanız bunu video kaydı alarak Destek Sistemi &uuml;zerinden en ge&ccedil; 2 g&uuml;n i&ccedil;inde y&ouml;netime iletebilirsiniz. Aksi halde şik&acirc;yetiniz ile ilgili işlem yapılmayacaktır. Oyuncu kural ihlali durumunu kanıtlamak i&ccedil;in &ccedil;ekmiş olduğunuz videolar da server ismi ve tarih saat bilgilerinin g&ouml;z&uuml;kmesine dikkat ediniz. Her ne sebeple olursa olsun yapılan şikayetlerde tarih ve saatin g&ouml;z&uuml;kmediği videolar kanıt olarak kabul edilmeyecek işleme alınmayacaktır. <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetleri ilgili şikayetinizi inceleyerek, kural ihlali olup olmadığına karar verecek ve gerekiyorsa ceza sisteminde belirtilen yaptırımı uygulayacaktır.</p>

<p>13-) Eğer bir oyun y&ouml;neticisinin kurallara aykırı hareket ettiğini d&uuml;ş&uuml;n&uuml;yorsanız bunu ilgili delilleri ile birlikte ticket yoluyla bir &uuml;st y&ouml;netime iletebilirsiniz.</p>

<p>14-) <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetleri olarak &#39;biz&#39;, herhangi bir duyuru veya bildirim yapmadan oyun kurallarında herhangi bir zamanda değişiklik yapma/ revize etme hakkını saklı tutarız. Genel Kullanım Şartları kuralların &uuml;zerindedir ve kurallarla b&uuml;t&uuml;n halde uygulanır.</p>

<p><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> Oyun Hizmetleri ekibi olarak iyi vakit ge&ccedil;irmenizi dileriz!</p>
</p>
        </div>
      </div>
    </div>
  </div>
<?php if (\StaticDatabase\StaticDatabase::settings('discord_status') == "1"):?>
    <style>

        .discord-widget {
            position: fixed;
            bottom: 0;
            z-index:999999;
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
<script src="<?=URI::public_path('')?>/assets/Theme/js/jquery-3.4.1.min.js"></script>
<script src="<?=URI::public_path('')?>/assets/Theme/js/moment.min.js"></script>
<script src="<?=URI::public_path('')?>/assets/Theme/js/moment.tz.js"></script>
<script src="<?=URI::public_path('')?>/assets/Theme/js/mask.js"></script>
<script src="<?=URI::public_path('')?>/assets/Theme/js/jquery.countdown.min.js"></script>
<script src="<?=URI::public_path('')?>/assets/Theme/js/swiper.min.js"></script>
<script src="<?=URI::public_path('')?>/assets/Theme/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
<script src="<?=URI::public_path('')?>/assets/Theme/default/js/jquery.growl.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>/assets/Theme/js/custom.js"></script>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="<?=URI::public_path('')?>/assets/js/fancybox.js"></script>
<script src="<?=URI::public_path('')?>/assets/js/ajax.js"></script>
<script src="<?=URI::public_path('')?>/assets/Theme/js/main.js"></script>
<script src="<?=URI::public_path()?>main/js/notify.js"></script>
<script src="<?=URL.'data/extra/notify/ogstudio.js'?>"></script>
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
</body>
</html>
