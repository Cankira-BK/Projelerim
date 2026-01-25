<style>
	.ranked-table{
		display: table;
		width: 241px;
		margin-left: 7px;
	}
</style>
<aside id="left">
	<!-- Subscribe -->
	<div class="btns">
		<!--<a href="<?=URL.SHOP?>" class="ep_btn"></a>-->
		<a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>" class="tanitim_btn"></a>
		<?php if (isset($_SESSION['aid'])):?>
            <a href="<?=URI::get_path('download')?>" class="register_btn"></a>
        <?php else:?>
		
            <a href="<?=URI::get_path('register')?>" class="register_btn"></a>
        <?php endif;?>
		           

	</div>
	<section class="box sidebox">
		<div class="body">
			<div id="update_status">
				<div id="realmlist">
					<div class="Table" style="width:241px;">
						<?php Cache::open('server_statistics');?>
						<?php if (Cache::check('server_statistics')):?>
							<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status') != 0 || \StaticDatabase\StaticDatabase::settings('today_login_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_account_status') != 0 || \StaticDatabase\StaticDatabase::settings('total_player_status') != 0 || \StaticDatabase\StaticDatabase::settings('active_pazar_status') != 0):?>
								<?php if (\StaticDatabase\StaticDatabase::settings('total_online_status')):?>
						<div class="Row a">
							<div class="Cell">
								<p><span class="status a1"></span></p>
							</div>
							<div class="Cell">
								<p><?=$lng[3]?></p>
							</div>
							<div class="Cell">
								<p><span class="online"><p class="online"><?=$getCount['totalOnline']['count'] + \StaticDatabase\StaticDatabase::settings('online')?></span></p>
							</div>
						</div>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('today_login_status')):?>
						<div class="Row b">
							<div class="Cell">
								<p><span class="status a1"></span></p>
							</div>
							<div class="Cell">
								<p><?=$lng[4]?></p>
							</div>
							<div class="Cell">
								<p><span class="online"><p class="online"><?=$getCount['todayLogin']['count'] + \StaticDatabase\StaticDatabase::settings('todaylogin')?></span></p>
							</div>
						</div>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('total_account_status')):?>
						<div class="Row a">
							<div class="Cell">
								<p><span class="status a1"></span></p>
							</div>
							<div class="Cell">
								<p><?=$lng[5]?></p>
							</div>
							<div class="Cell">
								<p><span class="online"><p class="online"><?=$getCount['totalAccount']['count'] + \StaticDatabase\StaticDatabase::settings('totalaccount')?></span></p>
							</div>
						</div>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('total_player_status')):?>
						<div class="Row b">
							<div class="Cell">
								<p><span class="status a1"></span></p>
							</div>
							<div class="Cell">
								<p><?=$lng[6]?></p>
							</div>
							<div class="Cell">
								<p><span class="online"><p class="online"><?=$getCount['totalPlayer']['count'] + \StaticDatabase\StaticDatabase::settings('totalplayer')?></span></p>
							</div>
						</div>
								<?php endif;?>
								<?php if (\StaticDatabase\StaticDatabase::settings('active_pazar_status')):?>
						<div class="Row a">
							<div class="Cell">
								<p><span class="status a1"></span></p>
							</div>
							<div class="Cell">
								<p><?=$lng[7]?></p>
							</div>
							<div class="Cell">
								<p><span class="online"><p class="online"><?=$getCount['activePazar']['count'] + \StaticDatabase\StaticDatabase::settings('activepazar')?></span></p>
							</div>
						</div>
								<?php endif;?>
							<?php endif;?>
						<?php endif;?>
						<?php Cache::close('server_statistics');?>
					</div>
				</div>
				<?php Cache::open('player_ranking');?>
				<?php if (Cache::check('player_ranking')):?>
				<div id="realmlist">
					<div class="mini-bar-title"><a href="<?=URI::get_path('ranked/player')?>"><?=$lng[11]?></a></div>
					<div class="mini-ranked-select">
						<ul class="idTabs">
							<li>
								<a id="player-btn" href="javascript:void(0)" class="selected"><?=$lng[65]?></a>
							</li>
							<li>
								<a id="guild-btn" href="javascript:void(0)"><?=$lng[66]?></a>
							</li>
						</ul>
					</div>
					<div id="player-rank" class="ranked-table">
						<div class="Heading">
							<div class="Cell">
								<p><?=$lng[172]?></p>
							</div>
							<div class="Cell">
								<p><?=$lng[173]?></p>
							</div>
							<div class="Cell">
								<p><?=$lng[68]?></p>
							</div>
						</div>
						<div style="margin-top:5px;"></div>
						<?php if (count($result['topplayer'])!= 0):?>
						<?php foreach ($result['topplayer'] as $key=>$row):?>
							<div class="Row <?=($key / 2) == 0 ? 'a' : 'b'; ?>">
								<div class="Cell">
									<p><span class="grade g<?=$key+1?>"></span></p>
								</div>
								<div class="Cell">
									<p><a class="sig" href="<?=URI::get_path('detail/player/'.$row['name'])?>"><?=$row['name']?></a></p>
								</div>
								<div class="Cell">
									<p><span class="online"><?=$row['level']?></span></p>
								</div>
							</div>
						<?php endforeach;?>
						<?php else:?>
							<?=$lng[28]?>
						<?php endif;?>

					</div>
					<div id="guild-rank" class="ranked-table" style="display: none;">
						<div class="Heading">
							<div class="Cell">
								<p><?=$lng[172]?></p>
							</div>
							<div class="Cell">
								<p><?=$lng[174]?>ı</p>
							</div>
							<div class="Cell">
								<p><?=$lng[68]?></p>
							</div>
						</div>
						<div style="margin-top:5px;"></div>
						<?php if (count($result['topguild']) != 0):?>
						<?php foreach ($result['topguild'] as $key=>$row):?>
								<div class="Row <?=($key / 2) == 0 ? 'a' : 'b'; ?>">
									<div class="Cell">
										<p><span class="grade g<?=$key+1?>"></span></p>
									</div>
									<div class="Cell">
										<p><a class="sig" href="<?=URI::get_path('detail/guild/'.$row['name'])?>"><?=$row['name']?></a></p>
									</div>
									<div class="Cell">
										<p><span class="online"><?=$row['ladder_point']?></span></p>
									</div>
								</div>
						<?php endforeach;?>
						<?php else:?>
							<?=$lng[31]?>
						<?php endif;?>
					</div>
				</div>
				<?php endif;?>
				<?php Cache::close('player_ranking')?>
				<div id="realmlist">
					<div class="mini-bar-title"><?=$lng[15]?></div>
					<div class="Table" style="width:241px;">
						<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                            <iframe src="<?=URI::get_path('event')?>" class="event-frame"></iframe>
						<?php else:?>
                            <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 273px; height: 301px;left: 0px;" id="fancybox-frame"></iframe>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script>
		var playerActive = true;
		$('#player-btn').click(function () {
		    if (playerActive === false)
		    {
                $('#guild-rank').hide();
                $('#player-rank').fadeIn();
                playerActive = true;
                $(this).addClass('selected');
                $('#guild-btn').removeClass('selected');
			}
        });
        $('#guild-btn').click(function () {
            if (playerActive === true)
            {
                $('#player-rank').hide();
                $('#guild-rank').fadeIn();
                playerActive = false;
                $(this).addClass('selected');
                $('#player-btn').removeClass('selected');
			}
        });
	</script>
	<!-- Social -->
	<div class="social_media">
		<ul>
			<li class="facebook_button ">
				<a target="blank " href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" title="Facebook "></a>
			</li>
			<li class="linkedin_button">
				<a target="blank" href="<?=\StaticDatabase\StaticDatabase::settings('instagram')?>" title="İnstagram"></a>
			</li>
			<li class="googleplus_button">
				<a target="blank" href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>" title="YouTube"></a>
			</li>
			<li class="paypal_button">
				<a target="blank" href="<?=\StaticDatabase\StaticDatabase::settings('twitch')?>" title="Discord"></a>
			</li>
		</ul>
	</div>
	
	<!-- Social.End -->
</aside>