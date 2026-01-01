<style>
    .event-frame {
        border: none !important;
        width: 165px !important;
        height: 262px !important;
        margin-right: auto;
        display: block;
        margin-left: auto;
    }
</style>
</main><!-- .content -->
<aside class="sidebar">
    <div class="sign block">
        <a href="<?=URI::get_path('register')?>" class="bright"><b><?=$lng[186]?></b> <span><?=$lng[187]?></span></a>
    </div><!-- sign -->
    <div class="soc-block block">
        <table>
            <tbody>
            <tr>
                <td><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>"><i class="facebook icon"></i> Facebook</a></td>
                <td><a href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>"><i class="youtube icon"></i> Youtube</a></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!-- soc-block -->
    <div class="block hero-block">
        <div class="hero-i">
            <h3><?=$lng[14]?></h3>
        </div>
        <div class="h-read-more-b">
            <i class="h-read-more"></i> <a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>"><?=$lng[189]?></a>
        </div>
    </div>
    <!-- hero-block -->

	<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0):?>
        <div class="block item-block">
            <div class="title">
				<?=$lng[2]?>
            </div>
            <div class="item-b-block">
                <div class="news-bottom-block">
					<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
                        <a href="javascript:void(0)" class="bottom-news">
                            <div class="comments">
                                <i class="comment-icon"></i>
								<?php Cache::open('total_online_cache');?>
								<?php if (Cache::check('total_online_cache')):?>
                                    <b id="onlineCount"><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></b>
								<?php endif;?>
								<?php Cache::close('total_online_cache');?>
                            </div>
                            <div class="bottom-news-title">
								<?=$lng[190]?>
                            </div>
                        </a>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
                        <a href="javascript:void(0)" class="bottom-news">
                            <div class="comments">
                                <i class="comment-icon"></i>
								<?php Cache::open('active_pazar_cache');?>
								<?php if (Cache::check('active_pazar_cache')):?>
									<b><?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></b>
								<?php endif;?>
								<?php Cache::close('active_pazar_cache');?>
                            </div>
                            <div class="bottom-news-title">
								<?=$lng[7]?>
                            </div>
                        </a>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
                        <a href="javascript:void(0)" class="bottom-news">
                            <div class="comments">
                                <i class="comment-icon"></i>
								<?php Cache::open('today_login_cache');?>
								<?php if (Cache::check('today_login_cache')):?>
									<b><?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></b>
								<?php endif;?>
								<?php Cache::close('today_login_cache');?>
                            </div>
                            <div class="bottom-news-title">
								<?=$lng[4]?>
                            </div>
                        </a>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
                        <a href="javascript:void(0)" class="bottom-news">
                            <div class="comments">
                                <i class="comment-icon"></i>
								<?php Cache::open('total_account_cache');?>
								<?php if (Cache::check('total_account_cache')):?>
									<b><?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></b>
								<?php endif;?>
								<?php Cache::close('total_account_cache');?>
                            </div>
                            <div class="bottom-news-title">
								<?=$lng[5]?>
                            </div>
                        </a>
					<?php endif;?>
					<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
                        <a href="javascript:void(0)" class="bottom-news">
                            <div class="comments">
                                <i class="comment-icon"></i>
								<?php Cache::open('total_player_cache');?>
								<?php if (Cache::check('total_player_cache')):?>
									<b><?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></b>
								<?php endif;?>
								<?php Cache::close('total_player_cache');?>
                            </div>
                            <div class="bottom-news-title">
								<?=$lng[6]?>
                            </div>
                        </a>
					<?php endif;?>
                </div>
            </div>
        </div>
    <?php endif;?>

    <div class="block forum-block">
        <div class="title">
			<?=$lng[11]?>
        </div>
        <div id="ranking_category">
            <div id="left_arrow_ranking"></div>
            <div id="player_rank_text" data-rtype="player"><?=$lng[176]?></div>
            <div id="guild_rank_text" data-rtype="guild" style="display: none"><?=$lng[177]?></div>
            <div id="right_arrow_ranking"></div>
        </div>
        <div id="player_rank_table">
		<?php Cache::open('player_ranking');?>
		<?php if (Cache::check('player_ranking')):?>
			<?php if (count($result['topplayer']) != 0):?>
				<?php foreach ($result['topplayer'] as $player):?>
                    <div class="forum">
                        <div class="forum-ava">
                            <img src="<?=URI::public_path('assets/images/chrs/').$player["job"].".jpg"?>" alt="">
                        </div>
                        <div class="forum-info">
                            <a href="<?=URI::get_path('detail/player/'.$player['name'])?>" class="forum-title"><?=$player["name"]?></a>
                            <div class="ranking_points_title">level</div>
                            <div class="ranking_points_value"><?=$player["level"];?></div>
                        </div>
                    </div>

				<?php endforeach;?>
			<?php endif;?>
		<?php endif;?>
		<?php Cache::close('player_ranking')?>
        </div>
        <div id="guild_rank_table" style="display: none;">
			<?php Cache::open('guild_ranking');?>
			<?php if (Cache::check('guild_ranking')):?>
				<?php if (count($result['topguild']) != 0):?>
					<?php foreach ($result['topguild'] as $key => $guild):?>
                        <div class="forum">
                            <div class="forum-ava">
                                <img src="<?=URI::public_path()?>assets/images/rank/<?=$key+1?>.jpg" alt="">
                            </div>
                            <div class="forum-info">
                                <a href="<?=URI::get_path('detail/guild/'.$guild['name'])?>" class="forum-title"><?=$guild["name"]?></a>
                                <div class="ranking_points_title">level</div>
                                <div class="ranking_points_value"><?=$guild["ladder_point"];?></div>
                            </div>
                        </div>
					<?php endforeach;?>
				<?php endif;?>
			<?php endif;?>
			<?php Cache::close('guild_ranking')?>
        </div>
    </div><!-- forum-block -->

	<?php if (\StaticDatabase\StaticDatabase::settings('event_type') != "3"):?>
        <div class="block links-block">
            <div class="title">
				<?=$lng[15]?>
            </div>
			<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                <center><iframe src="<?=URI::get_path('event')?>" class="event-frame"></iframe></center>
			<?php else:?>
                <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 100%;height: 301px;" id="fancybox-frame"></iframe>
			<?php endif;?>
        </div>
    <?php endif;?>

</aside>