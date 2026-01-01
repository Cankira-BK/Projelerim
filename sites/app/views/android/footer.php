<div class="content decoration"></div>
<div class="footer">
<p class="center-text">
Copyright &copy; by<a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>" class="footer-up"><?=\StaticDatabase\StaticDatabase::settings('footer_name')?></a> - <?=date("Y")?><br>
Tüm hakları saklıdır ve <a href="<?=URI::get_path('index')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a> mülkiyetindedir.<br/>
</p>
</div>
</div>
<div class="footer-menu">
<a href="#" class="show-left-sidebar open-left"><i class="fa fa-navicon"></i></a>
<?php if ($urlLang[1] != 'register' && $urlLang[1] != 'login' && $urlLang[1] != 'recuperare'):?>
<a href="#" class="show-right-sidebar open-right"><i class="fa fa-user"></i></a>
<?php endif;?>
</div>
</div>
<?php if (\StaticDatabase\StaticDatabase::settings('discord_status') == "1"):?>
<a class="show-left-discord" target="_blank" href="<?php echo \StaticDatabase\StaticDatabase::settings('discord_link')?>" title="Join us on Discord">
    <img src="https://discordapp.com/api/guilds/<?php echo \StaticDatabase\StaticDatabase::settings('discord_id')?>/embed.png?style=shield">
</a>
<?php endif;?>
<?php if (\StaticDatabase\StaticDatabase::settings('tawkto_status') == "1"):?>
<a class="show-right-tawkto" target="_blank" href="https://tawk.to/chat/<?php echo \StaticDatabase\StaticDatabase::settings('tawkto_id')?>/default" title="TawkTo Live Support">
    <img src="<?=URI::public_path();?>images/tawkto.png">
</a>
<?php endif;?>
<?php if (\StaticDatabase\StaticDatabase::settings('multi_languages')):?>
<?php
$getLanguage = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM language");
$getLanguage->execute();
$languagesS = $getLanguage->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
	.large:hover {
		height: <?=count($languagesS) * 45?>px;
	}
</style>
<ul class="languagepicker roundborders large">
	<?php foreach ($languagesS as $languages):?>
		<?php if ($languages['code'] === $_SESSION['language']):?>
			<a href="javascript:void(0)"><li><img src="<?=URL."data/flags/country/".$languages['code'].".png"?>"/></li></a>
		<?php endif;?>
	<?php endforeach;?>
	<?php foreach ($languagesS as $languages):?>
		<?php if ($languages['code'] !== $_SESSION['language']):?>
			<a href="<?=URI::get_path('languages/select/'.$languages['code'])?>"><li><img src="<?=URL."data/flags/country/".$languages['code'].".png"?>"/></li></a>
		<?php endif;?>
	<?php endforeach;?>
</ul>
<?php endif;?>
</body>
</html>