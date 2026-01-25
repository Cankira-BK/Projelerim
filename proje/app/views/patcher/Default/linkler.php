<?php
$GetNews = \StaticDatabase\StaticDatabase::init()->prepare("select * from autopatcher where type = 'MENU' ORDER BY id ASC");
$GetNews->execute();
$News = $GetNews->fetchAll(PDO::FETCH_ASSOC);
?>
<?php foreach ($News as $row):?>
<li><a href="<?php echo $row['url']?>"><span><?php echo $row['title']?></span><small><?php echo $row['content']?></small></a></li>
<?php endforeach;?>