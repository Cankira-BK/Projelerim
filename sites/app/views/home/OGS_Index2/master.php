<?php
$ayarbiyo = \StaticDatabase\StaticDatabase::init()->prepare("select * from index_biyolog where ayar_id=1");
$ayarbiyo->execute();
$GetBiyo = $ayarbiyo->fetchAll(PDO::FETCH_ASSOC);
foreach ($GetBiyo as $row){
$ork      = $row['ork'];
$lanet      = $row['lanet'];
$seytan      = $row['seytan'];
$buz      = $row['buz'];
$zelkova      = $row['zelkova'];
$tug      = $row['tug'];
$krm      = $row['krm'];
$lider      = $row['lider'];
$kem      = $row['kem'];
$bilge      = $row['bilge'];
$orksayi = $row['orksayi'];
$lanetsayi = $row['lanetsayi'];
$seytansayi = $row['seytansayi'];
$buzsayi = $row['buzsayi'];
$zelkovasayi = $row['zelkovasayi'];
$tugsayi = $row['tugsayi'];
$krmsayi = $row['krmsayi'];
$lidersayi = $row['lidersayi'];
$kemsayi = $row['kemsayi'];
$bilgesayi = $row['bilgesayi'];
}

$ayarbonus = \StaticDatabase\StaticDatabase::init()->prepare("select * from index_efsun where ayar_id=1");
$ayarbonus->execute();
$GetBonus = $ayarbonus->fetchAll(PDO::FETCH_ASSOC);
foreach ($GetBonus as $ayarla){
$guczeka = $ayarla['guczeka'];
$maxhp = $ayarla['maxhp'];
$maxsp = $ayarla['maxsp'];
$shizi = $ayarla['shizi'];
$hhizi = $ayarla['hhizi'];
$bhizi = $ayarla['bhizi'];
$hpspuretimi = $ayarla['hpspuretimi'];
$zsy = $ayarla['zsy'];
$kritdel = $ayarla['kritdel'];
$yari = $ayarla['yari'];
$buyu = $ayarla['buyu'];
$misolumsuz = $ayarla['misolumsuz'];
$savunma = $ayarla['savunma'];
$guczeka2 = $ayarla['guczeka2'];
$maxhp2 = $ayarla['maxhp2'];
$maxsp2 = $ayarla['maxsp2'];
$shizi2 = $ayarla['shizi2'];
$hhizi2 = $ayarla['hhizi2'];
$bhizi2 = $ayarla['bhizi2'];
$hpspuretimi2 = $ayarla['hpspuretimi2'];
$zsy2 = $ayarla['zsy2'];
$kritdel2 = $ayarla['kritdel2'];
$yari2 = $ayarla['yari2'];
$buyu2 = $ayarla['buyu2'];
$misolumsuz2 = $ayarla['misolumsuz2'];
$savunma2 = $ayarla['savunma2'];
$guczeka3 = $ayarla['guczeka3'];
$maxhp3 = $ayarla['maxhp3'];
$maxsp3 = $ayarla['maxsp3'];
$shizi3 = $ayarla['shizi3'];
$hhizi3 = $ayarla['hhizi3'];
$bhizi3 = $ayarla['bhizi3'];
$hpspuretimi3 = $ayarla['hpspuretimi3'];
$zsy3 = $ayarla['zsy3'];
$kritdel3 = $ayarla['kritdel3'];
$yari3 = $ayarla['yari3'];
$buyu3 = $ayarla['buyu3'];
$misolumsuz3 = $ayarla['misolumsuz3'];
$savunma3 = $ayarla['savunma3'];
}
?>