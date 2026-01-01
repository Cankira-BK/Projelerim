<!DOCTYPE html>
<html lang="tr">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?=URL?>favicon.ico" sizes="16x16" />

	<title><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> - Tanıtım</title>

	<meta name="keywords" content="metin2, <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>, emek, orta emek, metin, pvp server metin2"/>
    <meta name="description" content="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> pvp server Metin2 emek/zor."/>
	<meta name="robots" content="index,follow" />
	<meta name="author" content="OGStudio" />
	<meta name="language" content="Turkish" />
	<link href="<?=URI::home_patch('bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=URI::home_patch('dist/css/animate.css')?>" rel="stylesheet">
	<link href="<?=URI::home_patch('dist/css/jquery.fancybox.min.css')?>" rel="stylesheet">
	<link href="<?=URI::home_patch('dist/css/OGStudio.css')?>" rel="stylesheet">
	<link href="<?=URI::home_patch('design.css')?>" rel="stylesheet">
<style>
		iframe {
    display: block;       /* iframes are inline by default */
    border: none;         /* Reset default border */
    height: 50vh;        /* Viewport-relative units */
    width: 100%;
}
		</style>

</head>
<body>
<div class="container">
<div class="row">
<div class="ust">
				<style type="text/css">
					.TanitimLogo{
						margin-left: 430px;


					}

				</style>

				<div class="TanitimLogo">

				<a href="<?=URI::get_index('index')?>">	<img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>"></a>

				</div> 
</div>
<div class="col-md-12">
<div class="col-md-12 no-padding tanitim">
<center>
<div class="btns">
<div class="row">
<div class="col-md-12 col-xs-12">
<a href="<?=URI::get_index('index')?>" class="b1-anasayfa">
Anasayfa
</a>
<a href="<?=URI::get_index('register')?>" class="b1-anasayfa">
Kaydol
</a>
<a href="<?=URI::get_index('download')?>" class="b1-anasayfa">
Tıkla İndir
</a>
</div>
</div>
</div>
<br><br>
<div style="clear:both;"></div>
</center>

<div class="panel panel-buyuk" id="GenelOzellik">
<div class="panel-heading">Genel Özellikler</div>
<div class="panel-body">
<?php
$GetCategory = \StaticDatabase\StaticDatabase::init()->prepare("select * from index_basliklar");
$GetCategory->execute();
$Categorys = $GetCategory->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($Categorys as $row):?>
	<div class="col-md-4">
		<li class="list-group-item"><?php echo $row['kategori_adi']; ?></li>
	
	</div>
<?php endforeach;?>
<div style="clear:Both;"></div>
</div>
</div>
<div class="panel panel-buyuk" id="BiyologSüreleri">
<div class="panel-heading">Biyolog Süreleri</div>
<div class="panel-body">
<div class="col-md-6">
<ul class="list-group">
<li class="list-group-item">
<img src="https://i.hizliresim.com/367Wmj.png" class="Biyolo-Item-Img" />
<b>Ork Dişi (x<?=$orksayi;?>)</b><br>
 <?=$ork;?>
</li>
<li class="list-group-item">
<img src="https://i.hizliresim.com/y6EJBM.png" class="Biyolo-Item-Img" />
<b>Lanet Kitabı (x<?php echo $lanetsayi; ?>)</b><br>
 <?php echo $lanet; ?>
</li>
<li class="list-group-item">
<img src="https://i.hizliresim.com/Rr08Wo.png" class="Biyolo-Item-Img" />
<b>Şeytan Hatırası (x<?php echo $seytansayi; ?>)</b><br>
 <?php echo $seytan; ?>
</li>
<li class="list-group-item">
<img src="https://i.hizliresim.com/Ov08G3.png" class="Biyolo-Item-Img" />
<b>Buz Topu (x<?php echo $buzsayi; ?>)</b><br>
 <?php echo $buz; ?>
</li>
<li class="list-group-item">
<img src="https://i.hizliresim.com/Nnp8zk.png" class="Biyolo-Item-Img" />
<b>Zelkova Dalı (x<?php echo $zelkovasayi; ?>)</b><br>
 <?php echo $zelkova; ?>
</li>
</ul>
</div>
<div class="col-md-6">
<ul class="list-group">
<li class="list-group-item">
<img src="https://i.hizliresim.com/pb0Mdz.png" class="Biyolo-Item-Img" />
<b>Tugyis Tabelası (x<?php echo $tugsayi; ?>)</b><br>
 <?php echo $tug; ?>
</li>
<li class="list-group-item">
<img src="https://i.hizliresim.com/zj3O6g.png" class="Biyolo-Item-Img" />
<b>Krm. Hayalet Ağaç Dalı (x<?php echo $krmsayi; ?>)</b><br>
 <?php echo $krm; ?>
</li>
<li class="list-group-item">
<img src="https://i.hizliresim.com/6a9pok.png" class="Biyolo-Item-Img" />
<b>Liderin Notları (x<?php echo $lidersayi; ?>)</b><br>
 <?php echo $lider; ?>
</li>
<li class="list-group-item">
<img src="https://i.hizliresim.com/GmBWdv.png" class="Biyolo-Item-Img" />
<b>Kemgöz Mücevheri (x<?php echo $kemsayi; ?>)</b><br>
 <?php echo $kem; ?>
</li>
<li class="list-group-item">
<img src="https://i.hizliresim.com/alL8Vd.png" class="Biyolo-Item-Img" />
<b>Bilgelik Mücevheri (x<?php echo $bilgesayi; ?>)</b><br>
 <?php echo $bilge; ?>
</li>
</ul>
</div>
<div class="col-md-12">

</br>
</div>
</div>
</div>

										<div class="panel panel-buyuk" id="Draw2">
											<div class="panel-heading">Efsun Oranları</div>
											<div class="panel-body">
												<table class="table table-bordered table-hover ">
													<thead>
														<tr style="background-color: #741a17;">
															<td ><b style="color: white;">Efsun Adı</b></td>
															<td style="text-align: center"><b style="color: white;">Efsun Oranı - 1</b></td>
															<td style="text-align: center"><b style="color: white;">Efsun Oranı - 2</b></td>
															<td style="text-align: center"><b style="color: white;">Efsun Oranı - 3</b></td>
														</tr>
													</thead>
													<tbody style="color: #fcdda2;">
														<tr style="background-color: #741a17;">
															<td >Güç & Zeka & Canlılık & Çeviklik </td>
															<td style="text-align: center"><?php echo $guczeka; ?></td>
															<td style="text-align: center"><?php echo $guczeka2; ?></td>
															<td style="text-align: center"><?php echo $guczeka3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Max. HP</td>
															<td style="text-align: center"><?php echo $maxhp; ?></td>
															<td style="text-align: center"><?php echo $maxhp2; ?></td>
															<td style="text-align: center"><?php echo $maxhp3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Max. SP</td>
															<td style="text-align: center"><?php echo $maxsp; ?></td>
															<td style="text-align: center"><?php echo $maxsp2; ?></td>
															<td style="text-align: center"><?php echo $maxsp3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Saldırı Hızı</td>
															<td style="text-align: center"><?php echo $shizi; ?></td>
															<td style="text-align: center"><?php echo $shizi2; ?></td>
															<td style="text-align: center"><?php echo $shizi3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Hareket Hızı</td>
															<td style="text-align: center"><?php echo $hhizi; ?></td>
															<td style="text-align: center"><?php echo $hhizi2; ?></td>
															<td style="text-align: center"><?php echo $hhizi3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Büyü Hızı</td>
															<td style="text-align: center"><?php echo $bhizi; ?></td>
															<td style="text-align: center"><?php echo $bhizi2; ?></td>
															<td style="text-align: center"><?php echo $bhizi3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>HP ve SP Üretimi %</td>
															<td style="text-align: center"><?php echo $hpspuretimi; ?></td>
															<td style="text-align: center"><?php echo $hpspuretimi2; ?></td>
															<td style="text-align: center"><?php echo $hpspuretimi3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Zehirleme & Sersemletme & Kanatma ve Yavaşlık Değişimi %</td>
															<td style="text-align: center"><?php echo $zsy; ?></td>
															<td style="text-align: center"><?php echo $zsy2; ?></td>
															<td style="text-align: center"><?php echo $zsy3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Kritik ve Delici vuruş şansı %</td>
															<td style="text-align: center"><?php echo $kritdel; ?></td>
															<td style="text-align: center"><?php echo $kritdel2; ?></td>
															<td style="text-align: center"><?php echo $kritdel3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Yarı insanlara karşı güçlü %</td>
															<td style="text-align: center"><?php echo $yari; ?></td>
															<td style="text-align: center"><?php echo $yari2; ?></td>
															<td style="text-align: center"><?php echo $yari3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Büyüye Karşı Dayanıklılık %</td>
															<td style="text-align: center"><?php echo $buyu; ?></td>
															<td style="text-align: center"><?php echo $buyu2; ?></td>
															<td style="text-align: center"><?php echo $buyu3; ?></td>
														</tr>


														<tr style="background-color: #741a17;">
															<td>Mistik & Ölümsüz , Şeytan vs. karşı güçlü %</td>
															<td style="text-align: center"><?php echo $misolumsuz; ?></td>
															<td style="text-align: center"><?php echo $misolumsuz2; ?></td>
															<td style="text-align: center"><?php echo $misolumsuz3; ?></td>
														</tr>

														<tr style="background-color: #741a17;">
															<td>Bütün Savunma Oranları %</td>
															<td style="text-align: center"><?php echo $savunma; ?></td>
															<td style="text-align: center"><?php echo $savunma2; ?></td>
															<td style="text-align: center"><?php echo $savunma3; ?></td>
														</tr>




													</tbody>
												</table>
											</div>
										</div>
<center>
										<style type="text/css">
											#Npcler{
												background: url(https://i.hizliresim.com/26rVWA.jpg);
											}

											button {
												width: 120px;
												height: 40px;
											 color: #212121;
											 background-color: #d0b177;
											 border-radius: 3px 3px 3px 3px;
											 -webkit-border-radius: 3px 3px 3px 3px;
											 -moz-border-radius: 3px 3px 3px 3px;
											}

											button:hover{
												background-color: #b49355;
											}
										</style>



									<div class="panel panel-buyuk" id="Npcler">
						<div class="panel-heading">Market İçeriği</div>
						<div class="panel-body">
							<div class="col-md-12">
								<table>
									<tr >
										<td >
<?php
$GetShopList = \StaticDatabase\StaticDatabase::init()->prepare("select * from index_market");
$GetShopList->execute();
$ShopList = $GetShopList->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($ShopList as $row2): $marketresim = $row2['market_resim'];?>
	<button style="width:150px" onclick="ResimGetir('market_img', '<?php echo $row2['market_resim']; ?>')"><?php echo $row2['market_adi']; ?></button><br><br>
<?php endforeach;?>
										</td>

										<td>
											<div>
												<img id="market_img" src="<?php echo $marketresim; ?>">
											</div>
										</td>
									</tr>
								</table>
								<br>

							</div>
						</div>
					</div>
																<script>
		function ResimGetir(tag, adres) {
			document.getElementById(tag).src = adres;
		}
	</script>

</center>
<?php  
$GetSlotList = \StaticDatabase\StaticDatabase::init()->prepare("select * from index_detay");
$GetSlotList->execute();
$SlotList = $GetSlotList->fetchAll(PDO::FETCH_ASSOC);
foreach ($SlotList as $row3):
?>
		<div class="panel panel-buyuk" id="Draw2">
			<div class="panel-heading"><?php echo $row3['konu_baslik']; ?></div>
			<div id="mobil" ></div>
			<div class="panel-body">
				<div class="col-md-12">
	
					<center><a data-fancybox="gallery" href="<?php echo $row3['konu_resim']; ?>" target="_blank" data-caption=""><img src="<?php echo $row3['konu_resim']; ?>"/></a></center>
				</div>
				<div class="col-md-12">
					<ul class="list-group">
						<?php if ($row3['konu_bir'] != NULL):?><li class="list-group-item"><?php echo $row3['konu_bir']; ?></li><?php endif;?>
						<?php if ($row3['konu_iki'] != NULL):?><li class="list-group-item"><?php echo $row3['konu_iki']; ?></li><?php endif;?>
						<?php if ($row3['konu_uc'] != NULL):?><li class="list-group-item"><?php echo $row3['konu_uc']; ?></li><?php endif;?>
						<?php if ($row3['konu_dort'] != NULL):?><li class="list-group-item"><?php echo $row3['konu_dort']; ?></li><?php endif;?>
					</ul>
				</div>
			</div>
		</div>
<?php endforeach;?>
												<center>Copyright &copy; by <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br />
                        Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br/></center><br><br><br>


</div>
</style>
</body>



</html>
