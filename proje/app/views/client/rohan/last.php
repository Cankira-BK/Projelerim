<aside class="right-sidebar sidebar">
  <?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare'):?>
  <a href="<?=URI::get_path('download')?>" class="download bright">ÜCRETSİZ İNDİR</a>
  <?php endif;?>
  <div class="serverBlock flex-c-c">
    <div class="server">
      <div class="server-progressbar">
        <span style="width: 12%;"></span>
      </div>
	  <?php Cache::open('online_statistics');?>
	  <?php if (Cache::check('online_statistics')):?>
		<div class="server-online">
			<?=$lng[174]?> : <span><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></span>
		</div>
	  <?php endif;?>
	  <?php Cache::close('online_statistics');?>
      </div>
  </div>
  <div class="soc-block">
          <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>"><div><img src="<?=URI::public_path('')?>/assets/Theme/images/facebook-icon.png" alt="Facebook"></div>Facebook</a>
              <a href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>"><div><img src="<?=URI::public_path('')?>/assets/Theme/images/facebook-icon.png" alt="Facebook"></div>Grup</a>
              <a href="<?=\StaticDatabase\StaticDatabase::settings('discord_id')?>"><div></div>Discord</a>
              <a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>"><div></div>Wiki</a>
      </div>
      <div class="sidebarBlock">
      <div class="sidebarTitle">
        <h2><?=$lng[65]?></h2> <span><a href="<?=URI::get_path('ranked/player')?>">+ Tüm liste</a></span>
      </div>
      <div id="topGuildsGroup">
        <ul class="top-block">
                      <div id="collapse_guilds_DEFAULT" class="panel-collapse collapse in">
              <li class="top-title">
                <span class="top-number">#</span> <span class="top-name"><?=$lng[35]?></span> <span class="score"><?=$lng[68]?></span>
              </li>
              <div id="top_guilds_DEFAULT">
				<?php Cache::open('player_ranking');?>
				<?php if (Cache::check('player_ranking')):?>
				<?php if (count($result['topplayer']) != 0):?>
				<?php foreach ($result['topplayer'] as $key=>$row):?>
				<li class="top-list">
                    <span class="top-number"><?=$key+1?>.</span>
                    <span class="top-name"><a href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></span>
                    <span class="top-lvl"><?=$row['level']?><sup>Lv</sup></span>
				</li>
				<?php endforeach;?>
				<?php endif;?>
				<?php endif;?>
				<?php Cache::close('player_ranking')?>
                                  
                              </div>
            </div>
                  </ul>
      </div>
    </div>
    </aside>
</div>