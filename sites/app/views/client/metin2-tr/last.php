<div class="secondary">
	<!-- side boxes -->
	<?php if (isset($_SESSION['aid'])):?>
        <aside class="itemshop" role="complementary">
            <h2><?=$lng[147]?></h2>
            <a class="itemshop itemshop-btn iframe" href="<?=URL.SHOP?>" title="Nesne Market"></a>
        </aside>
	<?php else:?>
	<?php if ($urlLang[0] != 'register' && $urlLang[0] != 'login' && $urlLang[0] != 'recuperare'):?>
	<aside class="login" role="complementary">
		<h2><?=$lng[21]?></h2>
		<form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="post">
			<div class="form-login">
				<label><?=$lng[22]?></label>
				<div class="input">
					<input type="text" value="" name="login" id="login" maxlength="30"/>
				</div>
				<label><?=$lng[23]?></label>
				<div class="input">
					<input type="password" value="" name="password" id="password" maxlength="32"/>
				</div>
				<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                    <label>PIN</label>
                    <div class="input">
                        <input type="password" value="" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>"/>
                    </div>
				<?php endif;?>
                <label><?=$lng[24]?></label>
                <div style="    margin-bottom: -16px;">
                <script src='https://www.google.com/recaptcha/api.js'></script>
                <div class="g-recaptcha rc-anchor-dark" style="    transform: scale(0.50);margin-left: -50px;margin-top: -11px;" data-sitekey="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>"></div>
                </div>
                    <div>
					<input type="submit" class="btn-login" value="<?=$lng[21]?>"/>
					<p class="agbok">
                        <a href="<?=URI::get_path('recuperare')?>" rel="nofollow" class="password"><?=$lng[25]?></a>
                        <a href="<?=URI::get_path('recuperare/account')?>" rel="nofollow" class="password"><?=$lng[26]?></a>
					</p>
				</div>
			</div>
		</form>
	</aside>
	<?php endif;?>
	<?php endif;?>

	<aside class="download" role="complementary">
		<h2>İndir</h2>
		<a href="<?=URI::get_path('download')?>" title="İndir ve bedava oyna">İndir ve bedava
			oyna</a>
	</aside>


	<aside class="highscore" role="complementary">
		<h2>Sıralama</h2>

		<ul class="tabcontrols">
			<li class="selected"><a href="#players"><img
						src="<?=URI::public_path('assets/img/232b3d471340f1d6bed8d4deccc169.png')?>" alt="Oyuncular"
						title="Oyuncular"/></a></li>
			<li><a href="#guilds"><img src="<?=URI::public_path('assets/img/f46f0d2068aca9e35f0359d1f1b020.png')?>"
									   alt="Loncalar" title="Loncalar"/></a></li>
		</ul>

		<?php Cache::open('player_ranking');?>
		<?php if (Cache::check('player_ranking')):?>
		<div class="tab players selected">
			<div id="highscore-player">
				<table>
					<?php if (count($result['topplayer']) != 0):?>
					<?php foreach ($result['topplayer'] as $key=>$row):?>
                        <?php if ($key % 2 == 0):?>
                                <tr>
                                    <td class="position"><?=$key+1?></td>
                                    <td class="name"><a href="<?=URI::get_path('ranked/player')?>"><?=$row['name']?></a>
                                    </td>
                                    <td class="faction" style="color: #b7772a;">
										<?=$row['level']?>
                                    </td>
                                </tr>
                        <?php else:?>
                                <tr class="alt">
                                    <td class="position"><?=$key+1?></td>
                                    <td class="name"><a href="<?=URI::get_path('ranked/player')?>"><?=$row['name']?></a>
                                    </td>
                                    <td class="faction" style="color: #b7772a;">
										<?=$row['level']?>
                                    </td>
                                </tr>
                        <?php endif;?>
					<?php endforeach;?>
					<?php else:?>
						<span style="color: #b7772a;margin-left: 34px;display: block;"><?=$lng[28]?></span>
					<?php endif;?>
				</table>
			</div>
			<a href="<?=URI::get_path('ranked/player')?>" rel="nofollow"><?=$lng[29]?></a>
		</div>

		<div class="tab guilds">
			<div id="highscore-guild">
				<table>
					<?php if (count($result['topguild']) != 0):?>
					<?php foreach ($result['topguild'] as $key=>$row):?>
					    <?php if ($key % 2 == 0):?>
                                <tr>
                                    <td class="position"><?=$key+1?></td>
                                    <td class="name"><a
                                                href="<?=URI::get_path('ranked/guild')?>"><?=$row['name']?></a></td>
                                    <td class="faction" style="color: #b7772a;">
										<?=$row['ladder_point']?>
                                    </td>
                                </tr>
					    <?php else:?>
                                <tr class="alt">
                                    <td class="position"><?=$key+1?></td>
                                    <td class="name"><a
                                                href="<?=URI::get_path('ranked/guild')?>"><?=$row['name']?></a></td>
                                    <td class="faction" style="color: #b7772a;">
										<?=$row['ladder_point']?>
                                    </td>
                                </tr>
					    <?php endif;?>
					<?php endforeach;?>
					<?php else:?>
                        <span style="color: #b7772a;margin-left: 34px;display: block;"><?=$lng[31]?></span>
					<?php endif;?>
				</table>
			</div>

			<a href="<?=URI::get_path('ranked/guild')?>" rel="nofollow"><?=$lng[29]?></a>
		</div>
		<?php endif;?>
		<?php Cache::close('player_ranking')?>

	</aside>

    <aside class="highscore" role="complementary">
        <h2>Event Takvimi</h2>
            <div class="tab players selected">
                <div id="highscore-player">
					<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                        <iframe src="<?= URI::get_path('event') ?>" style="border: none;width: 210px;height: 300px;margin-left: 12px;" id="fancybox-frame"></iframe>
					<?php else:?>
                        <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 273px; height: 301px;left: 0px;" id="fancybox-frame"></iframe>
					<?php endif;?>
                </div>
            </div>
    </aside>

	<div id="coop" class="pepsi">
		<a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>" target="_blank"></a>
	</div>
</div>
</div>
