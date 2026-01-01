</main>
<aside class="right-sidebar">
	<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0):?>
		<?php Cache::open('server_statistics');?>
		<?php if (Cache::check('server_statistics')):?>
            <div class="status-block flex-c-c">
                <div class="server" style="margin-top: 20px;">
                    <div class="title-t">
                        <span>Sunucu İstatistikleri</span>
                        <br>
						<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
                            <p class="server_statistics_p"><a>Toplam Online: <?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></a></p>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
                            <p class="server_statistics_p"><a>Toplam Hesap: <?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></a></p>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
                            <p class="server_statistics_p"><a>Bugün Girenler: <?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todayLogin')?></a></p>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
                            <p class="server_statistics_p"><a>Toplam Karakter: <?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></a></p>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
                            <p class="server_statistics_p"><a>Aktif Pazar: <?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></a></p>
						<?php endif;?>
                    </div>
                </div>
            </div>
		<?php endif;?>
		<?php Cache::close('server_statistics');?>
	<?php endif;?>
    <div class="widget red-light">
        <div class="widget-title">
            <span><?=$lng[15]?></span>
        </div>
        <div class="events">
			<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                <center><iframe src="<?=URI::get_path('event')?>" class="event-frame"></iframe></center>
			<?php else:?>
                <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 100%;height: 301px;left: -5px;" id="fancybox-frame"></iframe>
			<?php endif;?>
        </div>
    </div>
</aside>
<!-- right-sidebar -->
</div>