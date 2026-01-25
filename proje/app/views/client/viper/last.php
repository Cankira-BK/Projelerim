<aside class="right-sidebar">
    <div class="dowload-button">
        <a href="download">ÜCRETSİZ İNDİR</a>
    </div>
    <div class="best-price-block">
        <a href="<?=URL.SHOP?>" class="best-price one itemshop itemshop-btn iframe">
            <div class="best-price-bottom">
                <br><br>
                <span>NESNE MARKET</span>
                Nesne marketimizden 7/24 <br>eşya satın alabilirsiniz.
            </div>
        </a>
    </div>
    <a href="<?=URL.MUTUAL?>" class="best-price two itemshop itemshop-btn iframe">
        <div class="best-price-bottom">
            <br>
            <span>DESTEK</span>
            Talep oluşturarak bizden <br>yardım isteyebilirsiniz.
        </div>
    </a>
	<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0):?>
        <div class="top-guilds-block">
            <div class="sidebar-title sidebar-title-dark">
                Oyun İstatistikleri
            </div>
            <div class="top-guilds">
				<?php Cache::open('server_statistics');?>
				<?php if (Cache::check('server_statistics')):?>
					<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
                        <div class="statistic">
                            <div class="clan-team">
								<?=$lng[4]?>
                            </div>
                            <div class="color-cyan">
								<?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?>
                            </div>
                        </div>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
                        <div class="statistic">
                            <div class="clan-team">
								<?=$lng[5]?>
                            </div>
                            <div class="color-cyan">
								<?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?>
                            </div>
                        </div>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
                        <div class="statistic">
                            <div class="clan-team">
								<?=$lng[6]?>
                            </div>
                            <div class="color-cyan">
								<?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?>
                            </div>
                        </div>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
                        <div class="statistic">
                            <div class="clan-team">
								<?=$lng[7]?>
                            </div>
                            <div class="color-cyan">
								<?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?>
                            </div>
                        </div>
					<?php endif;?>
				<?php endif;?>
				<?php Cache::close('server_statistics');?>
            </div>
        </div>
	<?php endif;?>
	<?php if (\StaticDatabase\StaticDatabase::settings('event_type') != "3"):?>
        <!-- Rank -->
        <div class="rankings-block">
            <div class="sidebar-title sidebar-title-light">
                Etkinlik Takvimi <br>
            </div>
            <div class="rankings">
				<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                    <iframe src="<?=URI::get_path('event')?>" style="border: none;width: 210px;height: 300px;margin-left: auto" id="fancybox-frame"></iframe>
				<?php else:?>
                    <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 273px; height: 301px;left: 0px;margin-left: auto" id="fancybox-frame"></iframe>
				<?php endif;?>
            </div>
        </div>
	<?php endif;?>
</aside>
</div>