<div class="title">
	<?=$lng[32]?>
</div>
<div class="news page">
    <div class="warfg_account">
        <section id="ucp_top">
			<?php Cache::open($this->player['name']."_player");?>
			<?php if (Cache::check($this->player['name']."_player")):?>
                <section id="ucp_info" style="padding-right:15px;padding-left:15px;width: 100%;">
                    <aside class="detail-section">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="40%"><?=$lng[35]?> :</td>
                                <td width="50%" class="wheat">
									<?=$this->player['name']?>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[68]?> :</td>
                                <td width="50%" class="wheat">
									<?=$this->player['level']?>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[35]?> :</td>
                                <td width="50%" class="wheat">
									<?= Functions::jobName($this->player['job'])?>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[37]?> :</td>
                                <td width="50%" class="wheat">
									<?=Functions::flagName($this->player['empire'])[1]?>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[66]?> :</td>
                                <td width="50%" class="wheat">
									<?= ($this->player['lonca'] == null) ? 'Yok' : $this->player['lonca']?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </aside>
                    <aside class="detail-section">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="40%"><?=$lng[39]?> :</td>
                                <td width="50%" class="wheat">
									<?=Functions::prettyDateTime1($this->player['last_play'])?>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[40]?> :</td>
                                <td width="50%" class="wheat">
									<?=$this->player['playtime']?> <?=$lng[42]?>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[109]?> :</td>
                                <td width="50%" class="wheat">
									<?=Functions::map($this->player['map_index'])?>
                                </td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[41]?> :</td>
                                <td width="50%" class="wheat">
                                    <img src="<?=URL.'data/chrs/small/'.Functions::playerOnlineStatus($this->player['last_play']).'.png'?>" style="width: 12px;" alt="">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </aside>
                    <aside class="detail-section">
                        <div class="leader">
                            <img src="<?=URL.'data/chrs/big/'.$this->player['job'].'/'.Functions::playerPortrait($this->player['level']).'.png'?>" style="width:100px;margin-right: auto;margin-left: auto;display: block;">
                        </div>
                    </aside>
                </section>
			<?php endif;?>
			<?php Cache::close($this->player['name']."_player");?>
            <div class="clear"></div>
        </section>
    </div>
</div>
