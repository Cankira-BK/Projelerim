<?php
    $char = $this->character;
?>
<style>
    .g-recaptcha{
        -webkit-transform: scale(1);
        margin-top: 15px;
    }
</style>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <h2 class="head"><?=$lng[106]?><a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a></h2>
            <div class="body">
				<?php $count = count($char);?>
				<?php if ($count == 0):?>
					<?=Functions::alert('warning',$lng[107]);?>
				<?php else:?>
					<?php foreach ($char as $row):?>
                        <a href="<?=URI::get_path('profile/saved/'.$row['id']);?>">
                            <div id="profileBox" class="player-table">
                                <div class="player-row">
                                    <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                                    <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></span></center><br>
                                    <center><span><?=$lng[109]?> : <?=Functions::map($row['map_index']);?></span></center>
                                    <br>
                                    <a href="<?=URI::get_path('profile/saved/'.$row['id']);?>"><span style="margin-left: 40%;" class="warfg_btn"><input type="submit" name="login_submit" value="<?=$lng[110]?>"></span></a>
                                </div>
                            </div>
                        </a>
					<?php endforeach;?>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>