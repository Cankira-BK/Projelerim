<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/png" href="<?=URL?>favicon.ico" sizes="16x16" />
    <title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - Tanıtım</title>
	
	<meta name="keywords" content="metin2, <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>, emek, orta emek, metin, pvp server metin2"/>
    <meta name="description" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> pvp server Metin2 emek/zor."/>
	<meta name="robots" content="index,follow" />
	<meta name="author" content="OGStudio" />
	<meta name="language" content="Turkish" />

    <link href="<?=URI::home_patch('dist/ui/font-awesome/4.7.0/css/font-awesome.min.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=URI::home_patch('dist/ui/bootstrap/4.3.1/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=URI::home_patch('dist/ui/carousel/owl.carousel.css')?>">
    <link rel="stylesheet" href="<?=URI::home_patch('dist/css/style.css')?>">
    <link rel="stylesheet" href="<?=URI::home_patch('dist/ui/animate/animate.css')?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="<?=URI::home_patch('dist/ui/jquery/jquery-3.3.1.slim.min.js')?>"></script>
    <script src="<?=URI::home_patch('dist/ui/carousel/owl.carousel.min.js')?>"></script>
    <script src="<?=URI::home_patch('dist/ui/popper/popper.min.js')?>"></script>
    <script src="<?=URI::home_patch('dist/ui/bootstrap/4.3.1/js/bootstrap.min.js')?>"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid top">
         <img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" width="100%" class="logo nomobile">
        <div class="container">
				<div class="row">
                    <div class="col-lg-12 f-d-n">
                        <img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" width="100%" alt="">
                    </div>
                    <div class="col-lg-4">
                        <a href="<?=URI::get_index('index')?>" class="homepage">
                            <strong>Anasayfa</strong>
                            <span>Ana sayfaya gitmek için tıklayınız</span>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="<?=URI::get_index('register')?>" class="register">
                            <strong>Kayıt Ol</strong>
                            <span>Hemen kaydolmak için tıklayınız</span>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="<?=URI::get_index('download')?>" class="download">
                            <strong>Oyunu İndir</strong>
                            <span>Oyunu indirmek için tıklayınız</span>
                        </a>
                    </div>
                </div>
        </div>
    </div>
    <div class="container-fluid center">
        <div class="container">
            <div class="row">
             <div class="col-lg-12 pd-l-0">
                <div class="card text-center">
                    <div class="card-header">
                        Genel Özellikler
                    </div>
                    <div class="card-body list-items">
                        <div class="row">
                            <?php
$GetCategory = \StaticDatabase\StaticDatabase::init()->prepare("select * from index_basliklar");
$GetCategory->execute();
$Categorys = $GetCategory->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($Categorys as $row):?>
	<br><div class="col-lg-4"><b class="item"><?php echo $row['kategori_adi']; ?></b></div><br>
<?php endforeach;?>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-12 pd-l-0 mt-4">
                <div class="card text-center">
                    <div class="card-header">
                        Biyolog Süreleri
                    </div>
                    <div class="card-body text-left list-items">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/OrkDisi.png')?>" class="mx-auto" data-toggle="tooltip" data-placement="top" title="Ork Dişi" alt="Ork Dişi">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Ork Dişi (x<?=$orksayi;?>)</h5>
                                            <?=$ork;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/Tugyis.png')?>" class="mx-auto" data-toggle="tooltip" data-placement="top" title="Tugyis Tabelası" alt="Tugyis Tabelası">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Tugyis Tabelası (x<?php echo $tugsayi; ?>)</h5>
                                            <?php echo $tug; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/LanetKitabi.png')?>" data-toggle="tooltip" data-placement="top" title="Lanet Kitabı" class="mx-auto" alt="Lanet Kitabı">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Lanet Kitabı (x<?php echo $lanetsayi; ?>)</h5>
                                           <?php echo $lanet; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/Dal.png')?>" data-toggle="tooltip" data-placement="top" title="Krm. Hayalet Ağaç Dalı" class="mx-auto" alt="Krm. Hayalet Ağaç Dalı">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Krm. Hayalet Ağaç Dalı (x<?php echo $krmsayi; ?>)</h5>
                                            <?php echo $krm; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/SeytanHatirasi.png')?>" data-toggle="tooltip" data-placement="top" title="Şeytan Hatırası" class="mx-auto" alt="Şeytan Hatırası">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Şeytan Hatırası (x<?php echo $seytansayi; ?>)</h5>
                                            <?php echo $seytan; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/Liderin.png')?>" data-toggle="tooltip" data-placement="top" title="Liderin Notları" class="mx-auto" alt="Liderin Notları">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Liderin Notları (x<?php echo $lidersayi; ?>)</h5>
                                            <?php echo $lider; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/BuzTopu.png')?>" data-toggle="tooltip" data-placement="top" title="Buz Topu" class="mx-auto" alt="Buz Topu">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Buz Topu (x<?php echo $buzsayi; ?>)</h5>
                                            <?php echo $buz; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/Kemgoz.png')?>" data-toggle="tooltip" data-placement="top" title="Kemgöz Mücevheri" class="mx-auto" alt="Kemgöz Mücevheri">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Kemgöz Mücevheri (x<?php echo $kemsayi; ?>)</h5>
                                            <?php echo $kem; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/Zelkova.png')?>" data-toggle="tooltip" data-placement="top" title="Zelkova Dalı" class="mx-auto" alt="Zelkova Dalı">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Zelkova Dalı (x<?php echo $zelkovasayi; ?>)</h5>
                                            <?php echo $zelkova; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="item">
                                    <div class="media">
                                        <div class="img-thumbnail img-box mr-2 ml-2">
                                            <img src="<?=URI::home_patch('dist/images/biyolog/Bilgelik.png')?>" data-toggle="tooltip" data-placement="top" title="Bilgelik Mücevheri" class="mx-auto" alt="Bilgelik Mücevheri">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mt-0">Bilgelik Mücevheri (x<?php echo $bilgesayi; ?>)</h5>
                                            <?php echo $bilge; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-12 pd-l-0">
                <div class="card text-center">
                    <div class="card-header">
                        EFSUN ORANLARI
                    </div>
                    <div class="card-body text-left list-items">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-green-style" role="alert">
                                    <i class="fa fa-info-circle"></i> Efsun Oranları Sabittir. Gösterilen Değerler Gelebilen Efsun Değerleridir.
                                </div>
                                <table class="table table-striped table-bordered table-hover table-trailer">
                                    <thead>
                                        <tr>
                                            <td><b>Efsun Adı</b></td>
                                            <td><b>Efsun Oranı - 1</b></td>
                                            <td><b>Efsun Oranı - 2</b></td>
                                            <td><b>Efsun Oranı - 3</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Güç - Zeka - Canlılık - Çeviklik </td>
                                            <td><?php echo $guczeka; ?></td>
                                            <td><?php echo $guczeka2; ?></td>
                                            <td><?php echo $guczeka3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Max. HP</td>
                                            <td><?php echo $maxhp; ?></td>
											<td><?php echo $maxhp2; ?></td>
											<td><?php echo $maxhp3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Max. SP</td>
                                            <td><?php echo $maxsp; ?></td>
											<td><?php echo $maxsp2; ?></td>
											<td><?php echo $maxsp3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Saldırı Hızı</td>
                                            <td><?php echo $shizi; ?></td>
											<td><?php echo $shizi2; ?></td>
											<td><?php echo $shizi3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Hareket Hızı</td>
                                            <td><?php echo $hhizi; ?></td>
											<td><?php echo $hhizi2; ?></td>
											<td><?php echo $hhizi3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Büyü Hızı</td>
                                            <td><?php echo $bhizi; ?></td>
											<td><?php echo $bhizi2; ?></td>
											<td><?php echo $bhizi3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>HP - SP Üretimi</td>
                                            <td><?php echo $hpspuretimi; ?></td>
											<td><?php echo $hpspuretimi2; ?></td>
											<td><?php echo $hpspuretimi3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Zehirleme - Sersemletme - Yavaşlama Şansı</td>
                                            <td><?php echo $zsy; ?></td>
											<td><?php echo $zsy2; ?></td>
											<td><?php echo $zsy3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Kritik - Delici vuruş şansı</td>
                                            <td><?php echo $kritdel; ?></td>
											<td><?php echo $kritdel2; ?></td>
											<td><?php echo $kritdel3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Yarı insanlara karşı güçlü</td>
                                            <td><?php echo $yari; ?></td>
											<td><?php echo $yari2; ?></td>
											<td><?php echo $yari3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Büyüye Karşı Dayanıklılık</td>
                                            <td><?php echo $buyu; ?></td>
											<td><?php echo $buyu2; ?></td>
											<td><?php echo $buyu3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Mistik - Ölümsüz - Şeytan (Benzeri Efsunlar)</td>
                                            <td><?php echo $misolumsuz; ?></td>
											<td><?php echo $misolumsuz2; ?></td>
											<td><?php echo $misolumsuz3; ?></td>
                                        </tr>

                                        <tr>
                                            <td>Bütün Savunma Oranları</td>
                                            <td><?php echo $savunma; ?></td>
											<td><?php echo $savunma2; ?></td>
											<td><?php echo $savunma3; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
        <div class="row mt-5">
            <div class="col-lg-12 pd-l-0">
                <div class="card text-center">
                    <div class="card-header">
                        NPCLER
                    </div>
					<div class="card-body text-left list-items">
                        <div class="row">
							<?php
							$GetShopList = \StaticDatabase\StaticDatabase::init()->prepare("select * from index_market");
							$GetShopList->execute();
							$ShopList = $GetShopList->fetchAll(PDO::FETCH_ASSOC);
							?>
							<?php foreach ($ShopList as $row2):?>
							<div class="col-lg-4">
                                <img class="mx-auto w-100" src="<?php echo $row2['market_resim']; ?>">
                                <div class="alert alert-green-style mt-4" role="alert">
                                    <i class="fa fa-info-circle"></i> <b><?php echo $row2['market_adi']; ?></b>
                                </div>
                            </div>
							<?php endforeach;?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
		
       <?php  
$GetSlotList = \StaticDatabase\StaticDatabase::init()->prepare("select * from index_detay");
$GetSlotList->execute();
$SlotList = $GetSlotList->fetchAll(PDO::FETCH_ASSOC);
foreach ($SlotList as $row3):
?>
        <div class="row mt-5">
            <div class="col-lg-12 pd-l-0">
                <div class="card text-center">
                    <div class="card-header">
                        <?php echo $row3['konu_baslik']; ?>
                    </div>
                    <div class="card-body text-left list-items">
                        <div class="row">
						    <div class="mx-auto w-100"><img class="mx-auto w-100" src="<?php echo $row3['konu_resim']; ?>"></div>
                        </div>
                        <?php if ($row3['konu_bir'] != NULL):?><div class="alert alert-green-style mt-4" role="alert"><i class="fa fa-info-circle"></i> <?php echo $row3['konu_bir']; ?></div><?php endif;?>
                        <?php if ($row3['konu_iki'] != NULL):?><div class="alert alert-green-style mt-4" role="alert"><i class="fa fa-info-circle"></i> <?php echo $row3['konu_iki']; ?></div><?php endif;?>
                        <?php if ($row3['konu_uc'] != NULL):?><div class="alert alert-green-style mt-4" role="alert"><i class="fa fa-info-circle"></i> <?php echo $row3['konu_uc']; ?></div><?php endif;?>
                        <?php if ($row3['konu_dort'] != NULL):?><div class="alert alert-green-style mt-4" role="alert"><i class="fa fa-info-circle"></i> <?php echo $row3['konu_dort']; ?></div><?php endif;?>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach;?>
    </div>
</div>

<div class="container-fluid bottom">
Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br/>
</div>
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
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        var owl = $("#owl-npc");

        owl.owlCarousel({
                items: 10, //10 items above 1000px browser width
                pagination: false,
                itemsDesktop: [2000, 6], //5 items between 1000px and 901px
                itemsDesktopSmall: [900, 3], // betweem 900px and 601px
                itemsTablet: [600, 2], //2 items between 600 and 0
                itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option
            });
    });

</script>
<script>
    $(window).scroll(function(){
        if ($(this).scrollTop() > 100)
            $("#yukari").fadeIn(500);
        else
            $("#yukari").fadeOut(500);
    });
    $(document).ready(function(){
        $("#yukari").click(function(){
            $("html, body").animate({ scrollTop: "0" }, 1000);
            return false;
        });
    });
</script>
<div id="yukari" class="yukari_don" data-toggle="tooltip" data-placement="left" title="" data-original-title="Sayfanın başına dönmek için tıklayınız." style="display: none"><i class="glyphicon glyphicon-chevron-up"></i></div>

</body>

</html>
