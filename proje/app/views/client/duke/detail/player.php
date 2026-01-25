<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[32]?>
            </center>
        </div>
		<?php Cache::open($this->player['name']."_player");?>
		<?php if (Cache::check($this->player['name']."_player")):?>
            <div class="leader">
                <img src="<?=URL.'data/chrs/big/'.$this->player['job'].'/'.Functions::playerPortrait($this->player['level']).'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
            </div>

            <div class="guilds">
                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[35]?> </div>
                    <div class="detail-info">
                        <span class="purple">
                            <?=$this->player['name']?>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[35]?> </div>
                    <div class="detail-info">
                        <span class="purple">
                            <?= Functions::jobName($this->player['job'])?>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[37]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <?=Functions::flagName($this->player['empire'])[1]?>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[38]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <?= ($this->player['lonca'] == null) ? 'Yok' : $this->player['lonca']?>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[39]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <?=Functions::prettyDateTime1($this->player['last_play'])?>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[40]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <?=$this->player['playtime']?> <?=$lng[42]?>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[109]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <?=Functions::map($this->player['map_index'])?>
                        </span>
                    </div>
                </div>

                <div class="guild-detail-list">
                    <div class="detail-name"><?=$lng[41]?></div>
                    <div class="detail-info">
                        <span class="purple">
                            <img src="<?=URL.'data/chrs/small/'.Functions::playerOnlineStatus($this->player['last_play']).'.png'?>" style="width: 12px;" alt="">
                        </span>
                    </div>
                </div>
            </div>

		<?php endif;?>
		<?php Cache::close($this->player['name']."_player");?>
    </div>
</main>
