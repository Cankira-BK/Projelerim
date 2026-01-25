</main>
<aside class="right-sidebar">
    <div class="shop-block">
        <div class="shop shop-one">
            <h3>Oyun Rehberi</h3>
            <br>
            <a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>" class="blue-a button button-small">Tıkla</a>
        </div>
        <div class="shop shop-two">
            <h3>Nesne Market</h3>
            <br>
            <a href="<?=URL.SHOP?>" class="green-a button button-small itemshop itemshop-btn iframe">Tıkla</a>
        </div>
        <div class="shop shop-three">
            <h3>Destek Sistemi</h3>
            <br>
            <a href="<?=URL.MUTUAL?>" class="gold-a button button-small itemshop itemshop-btn iframe">Tıkla</a>
        </div>
    </div>
	<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0):?>
		<?php Cache::open('server_statistics');?>
		<?php if (Cache::check('server_statistics')):?>
            <div class="best-p-block border">
                <div class="sidebar-title right-sidebar-title">
                    <div class="title-t">
                        <span><?=$lng[2]?></span>
                    </div>
                </div>
                <div class="box-style2">
                    <div class="entry">
                        <div id="top_guilds">
                            <table class="sidebar_rank" border="0">
                                <tbody>
								<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
                                    <tr>
                                        <td><?=$lng[7]?></td>
                                        <td><?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></td>
                                    </tr>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
                                    <tr>
                                        <td><?=$lng[4]?></td>
                                        <td><?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></td>
                                    </tr>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
                                    <tr>
                                        <td><?=$lng[5]?></td>
                                        <td><?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></td>
                                    </tr>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
                                    <tr>
                                        <td><?=$lng[6]?></td>
                                        <td><?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></td>
                                    </tr>
								<?php endif;?>
                                </tbody>
                            </table>
                        </div>
                        <span style="float:right;margin-right:28px"></span>
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