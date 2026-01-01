</main>
<aside class="right-sidebar">
    <div class="face-block">
        <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" target="_blank"><span>Facebook</span></a>
    </div>
	<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0):?>
		<?php Cache::open('server_statistics');?>
		<?php if (Cache::check('server_statistics')):?>
            <div style="clear:both;"></div>
            <div class="top-players-block p-block" style="background: url(<?=URI::public_path()?>asset/images/Wiki-Player.png) no-repeat right top;">
                <div class="sidebar-title sidebar-top-title flex-center">
                    <div class="title-t">
                        <span><?=$lng[2]?></span>
                        <br>
						<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
                            <p class="server_statistics_p"><a><?=$lng[3]?>: <?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></a></p>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
                            <p class="server_statistics_p"><a><?=$lng[7]?>: <?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></a></p>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
                            <p class="server_statistics_p"><a><?=$lng[4]?>: <?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></a></p>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
                            <p class="server_statistics_p"><a><?=$lng[5]?>: <?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></a></p>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
                            <p class="server_statistics_p"><a><?=$lng[6]?>: <?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></a></p>
						<?php endif;?>
                    </div>
                </div>
            </div>
		<?php endif;?>
		<?php Cache::close('server_statistics');?>
	<?php endif;?>

    <div class="top-players-block light p-block" >
        <div class="sidebar-title sidebar-top-title flex-center">
            <div class="title-t">
                <span><?=$lng[15]?></span>
            </div>
        </div>
        <div class="box-style2">
            <div id="events">
				<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                    <center><iframe src="<?=URI::get_path('event')?>" class="event-frame"></iframe></center>
				<?php else:?>
                    <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 100%;height: 301px;left: -5px;" id="fancybox-frame"></iframe>
				<?php endif;?>
            </div>
        </div>
    </div>
</aside>
<!-- right-sidebar -->
</div>