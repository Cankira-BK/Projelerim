<!--edit-->
<?php
    $char = $this->character;
    $randomKey = Functions::generateRandomString();
    Session::set('bug_key',$randomKey);
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
			<div class="panel-heading"><h2 class="head"><?=$lng[106]?><a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a></h2></div>
            <div class="body">
				<?php $count = count($char);?>
				<?php if ($count == 0):?>
					<?=Client::alert('warning',$lng[107]);?>
				<?php else:?>
					<?php foreach ($char as $row):?>
						<?php $bugHash = md5($row['name'].$randomKey);?>
                        <a href="<?=URI::get_path('profile/saved/'.$row['id']);?>">
                            <div id="profileBox" class="player-table detail-section">
                                <div class="player-row">
                                    <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                                    <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></span></center><br>
                                    <center><span><?=$lng[109]?> : <?=Functions::map($row['map_index']);?></span></center>
                                    <br>
                                    <a href="<?=URI::get_path('profile/saved/'.$row['name'].'/'.$bugHash);?>">
									<button type="submit" name="login_submit" class="btn form-btn" style="top: -4px;"><?=$lng[110]?></button></a>
                                </div>
                            </div>
                        </a>
					<?php endforeach;?>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>