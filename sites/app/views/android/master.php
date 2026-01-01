<div class="all-elements">
<div class="snap-drawers">

<div class="snap-drawer snap-drawer-left">
<div class="sidebar-header">
<p><img src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" class="responsive-image"></p>
</div>
<ul class="sidebar-navigation full-bottom">
<li class="selected">
<a href="<?=URI::get_path('index')?>"><i class="fa fa-home"></i><em><?=$lng[0]?></em></a>
</li>
<li>
<?php if (isset($_SESSION['aid'])):?>
<a href="<?=URI::get_path('profile')?>"><i class="fa fa-users"></i><em><?=$lng[1]?></em></a>
<?php else:?>
<a href="<?=URI::get_path('register')?>"><i class="fa fa-sign-in"></i><em><?=$lng[2]?></em></a>
<?php endif;?>
</li>
<li>
<a href="<?=URI::get_path('ranked/player')?>"><i class="fa fa-list-ol"></i><em><?=$lng[4]?></em></a>
</li>
<li>
<a href="<?=URL.MUTUAL?>" class="itemshop itemshop-btn iframe" id="store"><i class="fa fa-ticket"></i><em><?=$lng[5]?></em></a>
</li>
<li>
<a href="<?=URL.SHOP?>" class="itemshop itemshop-btn iframe" id="store"><i class="fa fa-shopping-cart"></i><em><?=$lng[6]?></em></a>
</li>
<li>
<a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>"><i class="fa fa-rss"></i><em><?=$lng[7]?></em></a>
</li>
</ul>
<div class="decoration"></div>
<ul class="sidebar-navigation full-bottom">
 <li>
<a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>"><i class="fa fa-external-link"></i><em><?=$lng[8]?></em></a>
</li>
<li>
<a href="<?=\StaticDatabase\StaticDatabase::settings('wiki')?>"><i class="fa fa-university"></i><em><?=$lng[9]?></em></a>
</li>
<li>
<a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>"><i class="fa fa-facebook"></i><em><?=$lng[10]?></em></a>
</li>
<li>
<a href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>"><i class="fa fa-youtube-play"></i><em><?=$lng[11]?></em></a>
</li>
<li>
<a href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>"><i class="fa fa-instagram"></i><em><?=$lng[12]?></em></a>
</li>
<li>
<a href="#" class="sidebar-close"><?=$lng[13]?></a>
</li>
</ul>
</div>