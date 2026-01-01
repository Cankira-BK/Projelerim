<?php
$GetNews = \StaticDatabase\StaticDatabase::init()->prepare("select * from autopatcher where type = 'SLIDER' ORDER BY id DESC");
$GetNews->execute();
$News = $GetNews->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($News as $row):?>
<div class="slide active"><span>#<?php echo $row['id']; ?></span><img src="<?php echo $row['image']; ?>" alt="etkinlik-<?php echo $row['id']; ?>"></div>
<?php endforeach;?>