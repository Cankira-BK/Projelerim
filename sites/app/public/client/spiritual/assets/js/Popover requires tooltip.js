
<!DOCTYPE html>
<html lang="tr">
<head>
<!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81212126-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-81212126-1');
</script>
<meta charset="utf-8">
<script type="text/javascript" src="js/jquery.min.js"></script>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="canonical" href="anasayfa"/>
<title>M2-Need - Editsiz Emek Server - Emek PvP - PvP Server - Metin2 PvP Server - Metin2 PvP - Metin2 - Mt2 PvP</title>
<meta name="generator" content="M2-Need "/>
<link rel="icon" type="image/ico" href="dist/img/m2h.ico"/>
<meta name="keywords" content="M2-Need , editsiz pvp serverler , editsiz pvp serverlar , editsiz emek pvp server , editsiz emek pvp , editsiz pvp , emek pvp server , emek pvp , metin2 emek server , metin2 editsiz emek server , mt2 editsiz emek pvp , mt2 editsiz emek server , mt2 emek server , metin2 emek serverlar , metin2 emek serverler , metin2 zor serverler , metin2 zor serverlar , metin2 zor pvp , metin2 server , metin2 , server , metin2 pvpler , metin2 pvp , pvp metin2 , mt2 pvp , pvp , metin2 pvp server , pvp server , pvp serverlar , pvp serverler , metin2 pvp serverlar , metin2 pvp serverler , metin2 kaydol , metin2 indir , metin2 oyna , metin2 hile indir , metin2 hileleri , metin2 sunucu , metin2 panel , metin2 files , turkmmo , metin2 forum , metin2 wslik pvp serverlar , metin2 wslik pvp serverler , metin2 orta pvp serverler , metin2 orta pvp serverlar , metin2 orta server , metin2 orta serverler , metin2 orta serverlar , orta pvp serverler , orta pvp serverlar , metin2 kolay pvp serverler , metin2 kolay pvp serverlar , metin2 orta pvp , metin2 kolay pvp , metin2 wslik pvp , metin2 kiralama , metin2 market paneli"/>
<meta name="description" content="M2-Need orta emek tarzında bir metin2 pvp sunucusudur.Oyun tamamen rekabet üzerine kurulu olup oyuncuların zevk alacağı şekilde tasarlanmıştır."/>
<meta name="robots" content="index,follow"/>
<meta name="copyright" content="Bu sitenin içeriği M2-Need lisansı ile korunmaktadır."/>
<meta name="author" content="M2-Need"/>
<meta name="language" content="Turkish"/>
<meta property="og:locale" content="tr_TR"/>
<meta property="og:type" content="article"/>
<meta property="og:title" content="M2-Need - Editsiz Emek Server - Emek PvP - PvP Server - Metin2 PvP Server - Metin2 PvP - Metin2 - Mt2 PvP"/>
<meta property="og:description" content="M2-Need orta emek tarzında bir metin2 pvp sunucusudur.Oyun tamamen rekabet üzerine kurulu olup oyuncuların zevk alacağı şekilde tasarlanmıştır."/>
<meta property="og:url" content="index.php"/>
<link href="bootstrap/css/stylee.css" rel="stylesheet">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="dist/css/animate.css" rel="stylesheet">
<link href="dist/css/site.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="dist/source/jquery.fancybox8cbb.css?v=2.1.5" media="screen"/>

<link rel="stylesheet" href="jquery.cluetip.css" type="text/css" />
<link rel="stylesheet" href="ajax/libs/jquery.colorbox/1.4.33/example1/colorbox.css" />
 <link rel="stylesheet" href="https://super.paywant.com/tema/remodal/jquery.remodal.css?v=1">
<div id="fb-root"></div>
 <link rel="stylesheet" href="https://super.paywant.com/tema/remodal/jquery.remodal.css?v=1">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://super.paywant.com/tema/remodal/jquery.remodal.js"></script>
</head>
<body>
<!-- Google Code for Epic of Metin2 Tan&#305;t&#305;m Conversion Page -->
<style>
.modal iframe {
    width: 100%;
    height: 100%;
}
</style>
	<script type="text/javascript">
	

		$(function(){
		
			$("#server-list").hide();
			$("#server").click(function(){
				$("#player-list").hide();
				$("#server-list").show();
				$("#server").html("<img src='assets/lonca-hover.png'/>");
				$("#player").html("<img src='assets/karakter-normal.png'/>");
			});
			
			$("#player").click(function(){
				$("#player-list").show();
				$("#server-list").hide();
				$("#player").html("<img src='assets/karakter-hover.png'/>");
				$("#server").html("<img src='assets/lonca-normal.png'/>");
			});
		
		})
		
		
		 
function kontrol()
{
	// var reg=new RegExp("\[ÜĞŞÇÖğıüşöç;*^&+%-!/|]");
	// var reg=new RegExp("\[ÜĞŞÇÖğıüşöç;*&%+!-^/|]");
	// var reg=new RegExp("\[ÜĞŞÇÖğıüşöç;*&%+!-^/|]");
	var reg=new RegExp("\[ÜĞŞÇÖğıüşöç;*/|]");

	if(reg.test(document.getElementById('username').value,reg))
	{
		alert('Hatalı Karakterler Girildi.Türkçe ve Özel Karakterler Girilemez ! (öğşıü)');
		document.getElementById('username').value="";
	}
} function kontrol2()
{
	var reg=new RegExp("\[ÜĞŞÇÖğıüşöç;*/|]");
	// var reg=new RegExp("\[ÜĞŞÇÖğıüşöç;*&%+!-^/|]");
	if(reg.test(document.getElementById('password').value,reg))
	{
		alert('Hatalı Karakterler Girildi.Türkçe Karakterler Girilemez ! (öğşıü)');
		document.getElementById('password').value="";
	}
} 
	</script>
    <script type="text/javascript">
      var onloadCallback = function() {
		  if(document.getElementById("html_element") !== null)
		{
			grecaptcha.render('html_element', {
			  'sitekey' : '6LfoXjEUAAAAAPCAxyFZkqMRmJWc-QTVRXgH-i1F'
			});
		}

	  if(document.getElementById("login_element") !== null)
		{
			grecaptcha.render('login_element', {
			  'sitekey' : '6LfoXjEUAAAAAPCAxyFZkqMRmJWc-QTVRXgH-i1F'
			});
		}

	  if(document.getElementById("epin_element") !== null)
		{
			grecaptcha.render('epin_element', {
			  'sitekey' : '6LfoXjEUAAAAAPCAxyFZkqMRmJWc-QTVRXgH-i1F'
			});
		}


      };
    </script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1010096941/?label=vrHGCM2TunEQrbbT4QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>



<div class="container-fluid icerik">
<div class="container">
<div class="row">
<div class="ust">
<nav class="navbar navbar-default">
<div class="container-fluid">
 
<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div>



<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">

<li><a href="anasayfa">&nbsp;Anasayfa</a></li>
<li><a href="kayit">&nbsp;Kayıt Ol</a></li>
<li><a href="indir">&nbsp;İndir</a></li>
<li><a href="siralama">&nbsp;Sıralama</a></li>
<li><a href="#">&nbsp;Destek</a></li>
<li><a href="http://forum.m2-need.com" target = "_blank" >Forum</a></li>

</ul>



</div>




</div>
</nav>
<div class="logo ">

</div>
  <div class="onlineoyuncu">
<span>
M2-Need
	</span>
</div>
  </div><div class="col-md-3">
<!-- 
<div class="col-md-12 no-padding">
<a href="#link"><div class="oyunindir_btn">
<i class="glyphicon glyphicon-film hidden-xs"></i>Youtube<small>[ KANALIMIZ ]</small></div></a>

</div>	
-->
<style type="text/css">
    @media screen and (min-width: 768px) {
        .modal-dialog {
          width: 700px; /* New width for default modal */
        }
        .modal-sm {
          width: 350px; /* New width for small modal */
        }
    }
    @media screen and (min-width: 992px) {
        .modal-lg {
          width: 950px; /* New width for large modal */
        }
    }
</style>
<script type="text/javascript" src="assets/themes/eternia2/js/global.js"></script>
<div class="col-md-12 no-padding">
<div class="panel panel-kucuk">
<div class="panel-heading">Üye Paneli</div>
<div class="panel-body">
			<div class="modal fade" id="MarketPanel"  tabindex="-1" role="document" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">

				  <div class="modal-header" style>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Nesne Market</h4>
				  </div>
				  <div class="modal-body">
						
					</div>
				
				</div>
			  </div>
			</div>
			
<form id="giris" method="post" action="javascript:void(0);" class="form_login" onkeypress="return event.keyCode != 13;">
<div class="form-group">
<label for="HesapAdi" class="giris-label">Hesap Adı</label>
<div class="input-group">
<span class="input-group-addon giris-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
<input type="text" class="form-control giris-input" name="id" placeholder="Hesapadı" aria-describedby="basic-addon1" required="">
</div>
</div>
<div class="form-group">
<label for="HesapSifre" class="giris-label">Parola</label>
<div class="input-group">
<span class="input-group-addon giris-addon" id="basic-addon2"><i class="glyphicon glyphicon-lock"></i></span>
<input type="password" class="form-control giris-input" name="pw" placeholder="Parola" aria-describedby="basic-addon2" required="">
</div>
</div>

<div class="modal fade" id="GirisGuvenlik" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel">Robot Güvenliğini Geçin</h4>
</div>
<div class="modal-body">
<div id="sonuc_giris"></div>
<center>
Lütfen robot olmadığınızı onaylayın<br><br>
<center>
      <div id="login_element" class="g-recaptcha"></div>


</center>
</center>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Vazgeç</button>
<button class="btn btn-giris" type="submit" style="font-size:12px;"  value="" onclick="giris();">Onayla</button>
</div>
</div>
</div>
</div>
<button type="button" data-toggle="modal" data-target="#GirisGuvenlik" class="btn btn-giris btn-block">Giriş Yap</button>
</form>
<div class="kayip-buttonlar">
<a href="unuttum">Şifremi Unuttum</a><br>
</div>
</div>
</div>
</div>

<div class="col-md-12 no-padding">
<div class="panel panel-kucuk">
<div class="panel-heading" align="center">
<a id="player" href="javascript:void(0);" ><img src="assets/karakter-hover.png"/>  </a> 

<a id="server" href="javascript:void(0);" ><img src="assets/lonca-normal.png"/> </a>
</div>
<div class="panel-body no-padding">
 
<table class="table table-siralama" id="player-list">
<thead>
<tr>
<td>Karakter Adı</td>
<td>Seviye</td>
<td style="text-align:center;">Oyun Süresi</td>
</tr>
</thead>
<tbody>

			<tr>
				<td>QQ</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">02 Gün</td>
			</tr>	
			
			<tr>
				<td>JagerAslan</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">02 Gün</td>
			</tr>	
			
			<tr>
				<td>Befty</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">02 Gün</td>
			</tr>	
			
			<tr>
				<td>105</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">01 Gün</td>
			</tr>	
			
			<tr>
				<td>Adonis</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">01 Gün</td>
			</tr>	
			
			<tr>
				<td>HELL</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">01 Gün</td>
			</tr>	
			
			<tr>
				<td>Toxin</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">01 Gün</td>
			</tr>	
			
			<tr>
				<td>ANTAKYA</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">01 Gün</td>
			</tr>	
			
			<tr>
				<td>PhLanax</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">01 Gün</td>
			</tr>	
			
			<tr>
				<td>Jacques</td>
				<td style="text-align:center;">105</td>
				<td style="text-align:center;">01 Gün</td>
			</tr>	
			</tbody>
</table>

 <table class="table table-siralama" id="server-list">
<thead>
<tr>
<td>Lonca Adı</td>
<td style="text-align:center;">Puan</td>
</tr>
</thead>
<tbody>
 	
								<tr>
								<td>KODES</td>
								<td style="text-align:center;">17000</td>
								</tr>	
								
								<tr>
								<td>EXCELLENT</td>
								<td style="text-align:center;">15000</td>
								</tr>	
								
								<tr>
								<td>HUKUMDAR</td>
								<td style="text-align:center;">12000</td>
								</tr>	
								
								<tr>
								<td>v8</td>
								<td style="text-align:center;">12000</td>
								</tr>	
								
								<tr>
								<td>ALTINORDA</td>
								<td style="text-align:center;">11000</td>
								</tr>	
								
								<tr>
								<td>Ottoman</td>
								<td style="text-align:center;">10000</td>
								</tr>	
								
								<tr>
								<td>TuranArmy</td>
								<td style="text-align:center;">10000</td>
								</tr>	
								
								<tr>
								<td>GUCUNYETMEZ</td>
								<td style="text-align:center;">9000</td>
								</tr>	
								
								<tr>
								<td>AVCI</td>
								<td style="text-align:center;">5000</td>
								</tr>	
								
								<tr>
								<td>YETIRIRIZ</td>
								<td style="text-align:center;">5000</td>
								</tr>	
							</tbody>
</table>
 
</div>
</div>
</div>


</div>


<style>
.video-container {
position: relative;
padding-bottom: 23.25%;
padding-top: 30px; height: 0; overflow: hidden;
}
 
.video-container iframe,
.video-container object,
.video-container embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}

.tanitim-container {
position: relative;
padding-bottom: 53.25%;
padding-top: 30px; height: 0; overflow: hidden;
}
 
.tanitim-container iframe,
.tanitim-container object,
.tanitim-container embed {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
</style>
<div class="col-md-9"><div class="col-md-8 no-padding">
<div class="col-md-12 mobil-nopad">
<a href="kayit"><div class="panel panel-buyuk hizlikayit animated infinite pulse">
<i class="glyphicon glyphicon-user hidden-xs"></i>
<h2>Hemen Ücretsiz Kaydol !</h2>
<span>Hesabını şimdi oluştur ve rekabet dolu savaşta yerini al</span>
</div></a>

<div class="panel panel-buyuk">
<div class="panel-heading"><center>M2-Need'ye Hoşgeldiniz</center>
</div> 
<div class="panel-body">
<center>
<iframe src="http://www.facebook.com/plugins/likebox.php?
href=http%3A%2F%2Fwww.facebook.com/metin2needofficial&amp;
width=420&amp;colorscheme=light&amp;show_faces=false&amp;
border_color&amp;stream=true&amp;header=true&amp;height=400"
scrolling="no" frameborder="0" style="border:none; overflow:
hidden;width:420px; height:400px;" allowTransparency="true">
</iframe>
</center>
</div>

</div>
</div>
</div>

<div class="col-md-4 no-padding">



<div class="col-md-12 mobil-nopad">
<div class="panel panel-buyuk">
<div class="panel-heading">Destek Sistemi</div>
<div class="panel-body no-padding" style="padding-bottom:1px;">
<a href="http://destek.m2-need.com" target="_blank"><img src="dist/img/destek.png"></a>
</div>
</div>
</div>

<div class="col-md-12 mobil-nopad">
<div class="panel panel-buyuk">
<div class="panel-heading">Facebook Sayfamız</div>
<div class="panel-body no-padding" style="padding-bottom:1px;">
<a href="http://m2-need.com" target="_blank"><img src="dist/img/wiki.png"></a>
</div>
</div>
</div>
<div class="col-md-12 mobil-nopad">
<div class="panel panel-buyuk">
<div class="panel-heading">İstatistikler
<i class="glyphicon glyphicon-pushpin cache-bilgi" data-toggle="tooltip" data-placement="right" title="Bu kısım 6 Ekim 2017 Cuma 23:01 tarihli veriyi göstermektedir.<br>Önbellek süresi 5 dakikadır her 5 dakikada bir veriler güncellenmektedir."></i>
</div>
<div class="panel-body">
<table class="table table-striped">
<tr>
<td>Aktif Oyuncu</td><td style="text-align:right;"></td></tr>
<tr><td>CH1 Durum</td><td style="text-align:center;"><img src='../assets/on.gif'/></td></tr>
<tr><td>CH2 Durum</td><td style="text-align:center;"><img src='../assets/on.gif'/></td></tr>
<tr><td>CH3 Durum</td><td style="text-align:center;"><img src='../assets/on.gif'/></td></tr>

<tr><td>CH4 Durum</td><td style="text-align:center;"><img src='../assets/on.gif'/></td></tr>

<tr><td>CH5 Durum</td><td style="text-align:center;"><img src='../assets/on.gif'/></td></tr>


 </table>
</div>
<div class="panel-footer uptime">
<div id="UptimeSure" style="display:none;">1691623199</div>  <b>Uptime</b><br><div id="UptimeSayac" data-toggle="tooltip" data-placement="top" title="En son bakımdan sonra geçen süre ."></div>
</div>
<script>
			// Uptime Sayacı
			// 08.01.2017
			var benimSayac = setInterval(UptimeSayac, 1000);
			var SureBaslangic = document.getElementById("UptimeSure").innerHTML;
			function UptimeSayac() {
				var Tarih = new Date();
				var SayacSurem = Math.floor(Tarih.getTime() / 1000) - SureBaslangic;
				var Mesaj = "";
				var Saat = Math.floor(SayacSurem / 3600);
				var Gun = Math.floor(Saat / 24);
				Saat = Saat - (Gun * 24);
				var Dakika = Math.floor((SayacSurem / 60) % 60);
				var Saniye = SayacSurem % 60; 
				
				if(Gun > 0)
					Mesaj += Gun + " gün ";
				if(Saat > 0)
					Mesaj += Saat + " saat ";
				if(Dakika > 0)
					Mesaj += Dakika + " dk. ";
				if(Saniye > 0)
					Mesaj += Saniye + " sn. ";
				
				document.getElementById("UptimeSayac").innerHTML = Mesaj;
			}
			</script>
</div>
</div>


</div> 



 </div> 	
</div>
	   <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
        async defer>
    </script>
<div class="row">
<div class="col-md-12">
<div class="footer">
<div class="footer_ust hidden-xs">
<ul>
<li><a href="http://www.m2-need.com" target="_blank">Oyun Tanıtımı</a></li>
<li><a href="kayit">Kayıt Ol</a></li>
<li><a href="indir">Oyunu İndir</a></li>
<li><a href="siralama">Karakter Sıralaması</a></li>
<li><a href="lonca_siralamasi">Lonca Sıralaması</a></li>
<li><a href="http://destek.m2-need.com">Destek Sistemi</a></li>
<li><a target="_new" href="https://www.facebook.com/Metin2needofficial">Facebook Sayfamız</a></li>
<li><a target="_new" href="http://forum.m2-need.com">Forum Sayfamız</a></li>
</ul>
<div style="clear:both"></div>
</div>
<div class="footer_alt hidden-xs">
<div class="col-md-12">

</div>
</div>
<div style="clear:both;"></div>
<style>
#duyuru-alt {position:fixed; z-index:999999; bottom:0; left:0; right:0; margin:0 auto; text-align:center;
	width:100%;
	height:80px;
	color:#ffffff;
	background:#94c6d3;
	-webkit-animation:duyuru 0.5s ease-in-out infinite alternate;
	animation:duyuru 1s ease-in-out infinite;
}

@-webkit-keyframes duyuru {
    0%   {background:#FF0000; height:80px;}
    100% {background:#990000; height:80px;}
}

#duyuru-alt span {
	color:#ffffff;
	padding-top:15px;
	display:inline-block
}

#duyuru-alt span b { font-size:20px }

</style>
<div id="duyuru-alt"><span><b>Test Sürüm Açıldı !  </span></b><br>
3 gün boyunca test sürümüne katılan ve 105 levele ulaşan oyuncular arasında çekiliş ile toplamda 600 ejderha parası ödül verilecektir. </div>
<center>
<!--
<copy>
Sanal Mağaza Sağlayıcı İletişim Bilgileri: Paywant Technology LTD. 
Telefon: +90 850 302 38 83 Mail : <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="7e1d11100a1f1d0a3e0e1f07091f100a501d1113">[email&#160;protected]</a> www.paywant.com / [ Web Tasarım: <b>FL3Me</b> ]</copy>
-->
</center>
</br>
<center>
<img src="dist/img/tgames.png"></img>
<img src="dist/img/12yas.png"></img>
<img src="dist/img/online.png"></img>
<img src="dist/img/siddet.png"></img>
</center>

<div style="display: none;">
<a href="http://www.m2-need.com" title="Pvp">Pvp Serverler`de en kaliteli server </a>|
<a href="http://www.m2-need.com" title="Pvp Serverler">5 yaşında </a>
<a href="http://www.m2-need.com" title="m2-need">m2-need </a>|
<a href="http://www.m2-need.com" title="editsiz pvp serverler">editsiz pvp serverler </a>|
<a href="http://www.m2-need.com" title="editsiz pvp serverlar">editsiz pvp serverlar </a>|
<a href="http://www.m2-need.com" title="editsiz emek pvp server">editsiz emek pvp server </a>|
<a href="http://www.m2-need.com" title="editsiz emek pvp">editsiz emek pvp </a>|
<a href="http://www.m2-need.com" title="editsiz pvp">editsiz pvp </a>|
<a href="http://www.m2-need.com" title="emek pvp server">emek pvp server </a>|
<a href="http://www.m2-need.com" title="emek pvp">emek pvp </a>|
<a href="http://www.m2-need.com" title="metin2 emek server">metin2 emek server </a>|
<a href="http://www.m2-need.com" title="metin2 editsiz emek server">metin2 editsiz emek server </a>|
<a href="http://www.m2-need.com" title="mt2 editsiz emek pvp">mt2 editsiz emek pvp </a>|
<a href="http://www.m2-need.com" title="mt2 editsiz emek server">mt2 editsiz emek server </a>|
<a href="http://www.m2-need.com" title="mt2 emek server">mt2 emek server </a>|
<a href="http://www.m2-need.com" title="metin2 emek serverlar">metin2 emek serverlar </a>|
<a href="http://www.m2-need.com" title="metin2 emek serverler">metin2 emek serverler </a>|
<a href="http://www.m2-need.com" title="metin2 zor serverler">metin2 zor serverler </a>|
<a href="http://www.m2-need.com" title="metin2 zor serverlar">metin2 zor serverlar </a>|
<a href="http://www.m2-need.com" title="metin2 zor pvp">metin2 zor pvp </a>|
<a href="http://www.m2-need.com" title="metin2 server">metin2 server </a>|
<a href="http://www.m2-need.com" title="metin2">metin2 </a>|
<a href="http://www.m2-need.com" title="server">server </a>|
<a href="http://www.m2-need.com" title="metin2 pvpler">metin2 pvpler </a>|
<a href="http://www.m2-need.com" title="metin2 pvp">metin2 pvp </a>|
<a href="http://www.m2-need.com" title="pvp metin2">pvp metin2 </a>|
<a href="http://www.m2-need.com" title="mt2 pvp">mt2 pvp </a>|
<a href="http://www.m2-need.com" title="pvp">pvp </a>|
<a href="http://www.m2-need.com" title="metin2 pvp server">metin2 pvp server </a>|
<a href="http://www.m2-need.com" title="pvp server">pvp server </a>|
<a href="http://www.m2-need.com" title="pvp serverlar">pvp serverlar </a>|
<a href="http://www.m2-need.com" title="pvp serverler">pvp serverler </a>|
<a href="http://www.m2-need.com" title="metin2 pvp serverlar">metin2 pvp serverlar </a>|
<a href="http://www.m2-need.com" title="metin2 pvp serverler">metin2 pvp serverler </a>|
<a href="http://www.m2-need.com" title="metin2 kaydol">metin2 kaydol </a>|
<a href="http://www.m2-need.com" title="metin2 indir">metin2 indir </a>|
<a href="http://www.m2-need.com" title="metin2 oyna">metin2 oyna </a>|
<a href="http://www.m2-need.com" title="metin2 hile indir">metin2 hile indir </a>|
<a href="http://www.m2-need.com" title="metin2 hileleri">metin2 hileleri </a>|
<a href="http://www.m2-need.com" title="metin2 sunucu">metin2 sunucu </a>|
<a href="http://www.m2-need.com" title="metin2 panel">metin2 panel </a>|
<a href="http://www.m2-need.com" title="metin2 files">metin2 files </a>|
<a href="http://www.m2-need.com" title="turkmmo">turkmmo </a>|
<a href="http://www.m2-need.com" title="metin2 forum">metin2 forum </a>|
<a href="http://www.m2-need.com" title="metin2 wslik pvp serverlar">metin2 wslik pvp serverlar </a>|
<a href="http://www.m2-need.com" title="metin2 wslik pvp serverler">metin2 wslik pvp serverler </a>|
<a href="http://www.m2-need.com" title="metin2 orta pvp serverler">metin2 orta pvp serverler </a>|
<a href="http://www.m2-need.com" title="metin2 orta pvp serverlar">metin2 orta pvp serverlar </a>|
<a href="http://www.m2-need.com" title="metin2 orta server">metin2 orta server </a>|
<a href="http://www.m2-need.com" title="metin2 orta serverler">metin2 orta serverler </a>|
<a href="http://www.m2-need.com" title="metin2 orta serverlar">metin2 orta serverlar </a>|
<a href="http://www.m2-need.com" title="orta pvp serverler">orta pvp serverler </a>|
<a href="http://www.m2-need.com" title="orta pvp serverlar">orta pvp serverlar </a>|
<a href="http://www.m2-need.com" title="metin2 kolay pvp serverler">metin2 kolay pvp serverler </a>|
<a href="http://www.m2-need.com" title="metin2 kolay pvp serverlar">metin2 kolay pvp serverlar </a>|
<a href="http://www.m2-need.com" title="metin2 orta pvp">metin2 orta pvp </a>|
<a href="http://www.m2-need.com" title="metin2 kolay pvp">metin2 kolay pvp </a>|
<a href="http://www.m2-need.com" title="metin2 wslik pvp">metin2 wslik pvp </a>|
<a href="http://www.m2-need.com" title="metin2 kiralama">metin2 kiralama </a>|
<a href="http://www.m2-need.com" title="metin2 market paneli">metin2 market paneli </a>|

</div>

<br><br>
</div>
</div>
</div>
</div>
</div>




<div id="yukari_don" class="yukari_don" data-toggle="tooltip" data-placement="left" title="" data-original-title="Sayfanın başına dönmek için tıklayınız."><i class="glyphicon glyphicon-chevron-up"></i></div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.12.4.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/sifre.js?ver=1491674222"></script>
<script type="text/javascript" src="dist/source/jquery.fancybox.pack8cbb.js?v=2.1.5"></script>
</body>
</html>