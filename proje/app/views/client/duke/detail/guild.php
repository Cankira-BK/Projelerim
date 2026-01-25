<?php
$guild = $this->guild['info'];
?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[43]?>
            </center>
        </div>
		<?php Cache::open($guild['name']."_guild");?>
		<?php if (Cache::check($guild['name']."_guild")):?>
            <div class="leader">
                <img src="<?=URL.'data/chrs/big/'.$guild['job'].'/'.Functions::playerPortrait($guild['seviye']).'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
            </div>

            <div class="guilds">
                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[46]?> </div>
                    <div class="detail-info">
                        <span class="purple"><?=$guild['name']?></span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name">Lonca Lideri </div>
                    <div class="detail-info">
                        <span class="purple">
                            <a href="<?=URI::get_path('detail/player/'.$guild['baskan'])?>"><?=$guild['baskan']?></a>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[47]?></div>
                    <div class="detail-info">
                        <span class="purple"><?=$guild['ladder_point']?></span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name">EXP</div>
                    <div class="detail-info">
                        <span class="purple"><?=$guild['exp']?></span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[48]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <img src="<?=URL.'data/flags/'.$guild['empire'].'.png';?>" style="width:30px;" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[49]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <?=$guild['win']?>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[50]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <?=$guild['draw']?>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[51]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <?=$guild['loss']?>
                        </span>
                    </div>
                </div>
            </div>

		<?php endif;?>
		<?php Cache::close($guild['name']."_guild");?>
    </div>
</main>
