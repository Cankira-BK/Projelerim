<div class="main-panel panel-download">
    <div class="main-header">
		<?=$lng[32]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php Cache::open($this->player['name']."_player");?>
                    <?php if (Cache::check($this->player['name']."_player")):?>
                    <div class="bg-light item-container">
                        <div class="player-card">
                            <h3><?=$lng[33]?></h3>
                            <img src="<?=URL.'data/chrs/big/'.$this->player['job'].'/'.Functions::playerPortrait($this->player['level']).'.png'?>" class="player-img"><br>
                            <span class="player-title"><i class="icon-power3 position-left"></i> <?=$this->player['level']?> Level</span>
                        </div>
                        <div class="player-info-card">
                            <span class="player-title"> <i class="icon-crown position-left"></i> <?=$this->player['exp']?></span>
                        </div>
                        <div class="player-informations">
                            <h3><?=$lng[34]?></h3>
                            <div class="player-table">
                                <div class="player-row">
                                    <strong><i class="icon-man position-left"></i> <?=$lng[35]?>:</strong>
                                    <span><?=$this->player['name']?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-height position-left"></i> <?=$lng[36]?>:</strong>
                                    <span><?= Functions::jobName($this->player['job'])?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-flag4 position-left"></i> <?=$lng[37]?>:</strong>
                                    <span><?=Functions::flagName($this->player['empire'])[1]?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-make-group position-left"></i> <?=$lng[38]?>:</strong>
                                    <span><?= ($this->player['lonca'] == null) ? 'Yok' : $this->player['lonca']?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-watch2 position-left"></i> <?=$lng[39]?>:</strong>
                                    <span><?=Functions::prettyDateTime1($this->player['last_play'])?></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-watch position-left"></i> <?=$lng[40]?>:</strong>
                                    <span><span title="<?=$this->player['playtime']?>"><?=$this->player['playtime']?> <?=$lng[42]?></span></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-map position-left"></i> <?=$lng[109]?>:</strong>
                                    <span><span title="<?=Functions::map($this->player['map_index'])?>"><?=Functions::map($this->player['map_index'])?></span></span>
                                </div>

                                <div class="player-row">
                                    <strong><i class="icon-feed position-left"></i> <?=$lng[41]?>:</strong>
                                    <span><img src="<?=URL.'data/chrs/small/'.Functions::playerOnlineStatus($this->player['last_play']).'.png'?>" style="width: 12px;" alt=""></span>
                                </div>

                            </div>
                        </div>
                        <div class="player-flag" style="background-color: rgba(84, 14, 14, 0.54);"></div>
                    </div>
                    <?php endif;?>
                    <?php Cache::close($this->player['name']."_player");?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>