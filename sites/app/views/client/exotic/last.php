<div class="windowr">
    <div class="windows windows-wsRightTop"><span><?=$lng[11]?></span></div>
    <div class="wsCenter">
		<?php Cache::open('player_ranking'); ?>
		<?php if (Cache::check('player_ranking')): ?>
            <table class='wtablesmid' id="top-player">
                <thead>
                <tr>
					<?php if (count($result['topplayer']) != 0): ?>
                        <th width='20%'></th>
                        <th width='60%'></th>
                        <th width='20%'></th>
					<?php else: ?>
                        <th width='100%'></th>
					<?php endif; ?>
                </tr>
                </thead>
                <tbody>
				<?php if (count($result['topplayer']) != 0): ?>
					<?php foreach ($result['topplayer'] as $key => $row): ?>
                        <tr>
                            <td class='' style=''><span class='grade g1<?= $key + 1 ?>'></span></td>
                            <td class='' style='width: 158px;'><a class='sig'
                                                                  href='<?= URI::get_path('detail/player/' . $row['name']) ?>'><?= $row['name'] ?> </a>
                            </td>
                            <td class='' style=''><?= $row['level'] ?></td>
                        </tr>
					<?php endforeach; ?>
				<?php else: ?>
                    <tr>
                        <td class='' style='width: 273px;text-align: center;'><?=$lng[28]?></td>
                    </tr>
				<?php endif; ?>
                </tbody>
            </table>
            <table class='wtablesmid' id="top-guild" style="display: none;">
                <thead>
                <tr>
					<?php if (count($result['topguild']) != 0): ?>
                        <th width='20%'></th>
                        <th width='60%'></th>
                        <th width='20%'></th>
					<?php else: ?>
                        <th width='100%'></th>
					<?php endif; ?>
                </tr>
                </thead>
                <tbody>
				<?php if (count($result['topguild']) != 0): ?>
					<?php foreach ($result['topguild'] as $key => $row): ?>
                        <tr>
                            <td class='' style=''><span class='grade g<?= $key + 1 ?>'></span></td>
                            <td class='' style='width: 158px;'><a class='sig'
                                                                  href='<?= URI::get_path('detail/guild/' . $row['name']) ?>'><?= $row['name'] ?> </a>
                            </td>
                            <td class='' style=''><?= $row['ladder_point'] ?></td>
                        </tr>
					<?php endforeach; ?>
				<?php else: ?>
                    <tr>
                        <td class='' style='width: 273px;text-align: center;'><?=$lng[31]?></td>
                    </tr>
				<?php endif; ?>
                </tbody>
            </table>
		<?php endif; ?>
		<?php Cache::close('player_ranking') ?>
        <div class="mini-ranked-select">
            <ul class="idTabs">
                <li>
                    <a id="player-btn" href="javascript:void(0)" class="selected"><?=$lng[65]?></a>
                </li>
                <li>
                    <a id="guild-btn" href="javascript:void(0)" class=""><?=$lng[66]?></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="windows windows-wsBottom"></div>

	<?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')): ?>
        <div style="margin-top: 10px;" class="windows windows-wsTop"><span><?=$lng[15]?></span></div>
        <div class="wsCenter">
			<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                <iframe src="<?= URI::get_path('event') ?>" style="border: none;width: 210px;height: 300px;margin-left: 55px;" id="fancybox-frame"></iframe>
			<?php else:?>
                <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 273px; height: 301px;left: 0px;" id="fancybox-frame"></iframe>
			<?php endif;?>
        </div>
        <div class="windows windows-wsBottomB"></div>
	<?php endif; ?>
</div>
<script>
    var topNumber = 0;
    $('#player-btn').click(function () {
       if (topNumber !== 0)
       {
           document.getElementById('top-guild').style.display = "none";
           document.getElementById('player-btn').className = "selected";
           document.getElementById('guild-btn').className = "";
           $('#top-player').fadeIn("slow");
           topNumber = 0;
       }
    });
    $('#guild-btn').click(function () {
        if (topNumber !== 1)
        {
            document.getElementById('top-player').style.display = "none";
            document.getElementById('guild-btn').className = "selected";
            document.getElementById('player-btn').className = "";
            $('#top-guild').fadeIn("slow");
            topNumber = 1;
        }
    });
</script>