<?php$guild = $this->guild['info'];
?>
<div class="main-panel panel-download">
    <div class="main-header">
		<?=$lng[43]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <?php Cache::open($guild['name']."_guild");?>
            <?php if (Cache::check($guild['name']."_guild")):?>
            <div class="content-title"><?=$guild['name']?></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <div class="bg-light item-container">
                        <div class="player-card">
                            <h3><?=$lng[44]?> : <a href="<?=URI::get_path('detail/player/'.$guild['baskan'])?>"><?=$guild['baskan']?></a></h3>
                            <img src="<?=URL.'data/chrs/big/'.$guild['job'].'/'.Functions::playerPortrait($guild['seviye']).'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>" style="width:100px"><br><br>
                        </div>
                        <div class="player-informations">
                            <h3><?=$lng[45]?></h3>
                            <div class="player-table">
                                <div class="player-row">
                                    <strong><i class="icon-make-group position-left"></i> <?=$lng[46]?>:</strong>
                                    <span><?=$guild['name']?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-trophy3 position-left"></i> <?=$lng[47]?>:</strong>
                                    <span><?=$guild['ladder_point']?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-chart position-left"></i> EXP:</strong>
                                    <span><?=$guild['exp']?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-flag4 position-left"></i> <?=$lng[48]?>:</strong>
                                    <span><img src="<?=URL.'data/flags/'.$guild['empire'].'.png';?>" style="width:30px;" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-stats-growth2 position-left"></i> <?=$lng[49]?>:</strong>
                                    <span><?=$guild['win']?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-pulse2 position-left"></i> <?=$lng[50]?>:</strong>
                                    <span><?=$guild['draw']?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-stats-decline2 position-left"></i> <?=$lng[51]?>:</strong>
                                    <span><?=$guild['loss']?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>
            <?php Cache::close($guild['name']."_guild");?>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>
