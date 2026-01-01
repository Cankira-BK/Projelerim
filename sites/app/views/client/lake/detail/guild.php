<?php
$guildInfo = $this->all["info"];
$name = $this->all["name"];
$guildMembers = $this->all["members"];
?>
<div class="title">
	<?=$lng[43]?>
</div>
<div class="news page">
    <div class="warfg_account">
        <section id="ucp_top">
			<?php Cache::open($guild['name']."_guild");?>
			<?php if (Cache::check($guild['name']."_guild")):?>
                <section id="ucp_info" style="padding-right:15px;padding-left:15px;width: 100%;">
                    <aside class="detail-section">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="40%"><?=$lng[46]?> :</td>
                                <td width="50%" class="wheat"><?=$guild['name']?></td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[47]?> :</td>
                                <td width="50%" class="wheat"><?=$guild['ladder_point']?></td>
                            </tr>
                            <tr>
                                <td width="40%">EXP :</td>
                                <td width="50%" class="wheat"><?=$guild['exp']?></td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[48]?> :</td>
                                <td width="50%" class="wheat">
                                    <img src="<?=URL.'data/flags/'.$guild['empire'].'.png';?>" style="width:30px;" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </aside>
                    <aside class="detail-section">
                        <table width="100%">
                            <tbody>
                            <tr>
                                <td width="40%"><?=$lng[49]?> :</td>
                                <td width="50%" class="wheat"><?=$guild['win']?></td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[50]?> :</td>
                                <td width="50%" class="wheat"><?=$guild['draw']?></td>
                            </tr>
                            <tr>
                                <td width="40%"><?=$lng[51]?> :</td>
                                <td width="50%" class="wheat"><?=$guild['loss']?></td>
                            </tr>
                            </tbody>
                        </table>
                    </aside>
                    <aside class="detail-section">
                        <div class="leader">
                            <img src="<?=URL.'data/chrs/big/'.$guildInfo->job.'/'.Functions::playerPortrait($guildInfo->seviye).'.png'?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>" style="width:100px;margin-right: auto;margin-left: auto;display: block;">
                            <a href="<?=URI::get_path('detail/player/'.$guild['baskan'])?>" style="text-align: center;display: block">
                                <?=$guild['baskan']?>
                            </a>
                        </div>
                    </aside>
                </section>
			<?php endif;?>
			<?php Cache::close($guild['name']."_guild");?>
            <div class="clear"></div>
        </section>
    </div>
</div>
