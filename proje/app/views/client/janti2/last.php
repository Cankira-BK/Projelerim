<aside class="right-sidebar">
<div class="dowload-button">
<a href="download">ÜCRETSİZ İNDİR</a>
</div>
<a href="<?=\StaticDatabase\StaticDatabase::settings('wiki')?>" class="hero-guides-block">
<div class="block-info">
<span>WIKI SAYFASI</span>
Detaylı bilgi için <br> wiki sayfamıza <br> göz atabilirsiniz. </div>
</a>
<div class="rankings-block">
<div class="sidebar-title sidebar-title-light">
<a href="<?=URI::get_path('ranked/player')?>">+ Tüm liste</a>
Oyuncu Sıralaması <br>
</div>
<div class="rankings">
<div class="rankings-title">
<div class="rank-number">#</div> <div class="rank-name">Karakter adı</div> <div class="rank-lvl">Seviye</div>
</div>
													<?php Cache::open('player_ranking');?>
													<?php if (Cache::check('player_ranking')):?>
													<?php if (count($result['topplayer']) != 0):?>
													<?php foreach ($result['topplayer'] as $key=>$row):?>
<a title="<?=$row['name']?>" class="rankings-title-block">
<div class="rank-number"><?=$key+1?></div> <div class="rank-name"><?=$row['name']?></div> <div class="rank-lvl"><span class="purple"><?=$row['level']?> Lv.</span></div>
</a>
													<?php endforeach;?>
													<?php endif;?>
													<?php endif;?>
													<?php Cache::close('player_ranking')?>
</div>
</div>
</aside>
</div>