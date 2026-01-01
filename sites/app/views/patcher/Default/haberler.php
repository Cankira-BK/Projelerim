<?php
$GetNews = \StaticDatabase\StaticDatabase::init()->prepare("select * from autopatcher where type = 'HABER' ORDER BY id DESC LIMIT 6");
$GetNews->execute();
$News = $GetNews->fetchAll(PDO::FETCH_ASSOC);
$Labels = ['1'=>'Etkinlik','2'=>'Güncelleme','3'=>'Bilgi','4'=>'<b>Önemli Bilgi</b>','5'=>'Nesne Market','6'=>'Duyuru'];
?>
<?php foreach ($News as $row):?>
<li><a href="<?php echo $row['url']?>" target="_blank"><span class="label label--<?php echo $row['label']?>"><?php echo $Labels[$row['label']]?></span><div class="baslik"><h3><?php echo $row['title']; ?>, [Tıkla]</h3><span class="float-right"><?php echo date("d/m/Y", strtotime($row['tarih'])); ?></span></div></a></li>
<?php endforeach;?>