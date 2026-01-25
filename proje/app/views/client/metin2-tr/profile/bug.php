<?php
$char = $this->character;
$randomKey = Functions::generateRandomString();
Session::set('bug_key',$randomKey);
?>
<div role="main">
    <div id="register" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2><?=$lng[106]?></h2>
                <div class="row" style="margin: 0px;">
                    <div class="inner-form-border"><div class="inner-form-box"><p>
								<?php $count = count($char);?>
								<?php if ($count == 0):?>
									<?=Client::alert('warning',$lng[107]);?>
								<?php else:?>
                            <h3><?=$lng[108]?></h3>
							<?php foreach ($char as $row):?>
								<?php $bugHash = md5($row['name'].$randomKey);?>
                                <div id="profileBox" class="player-table">
                                    <div class="player-row">
                                        <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                                        <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></span></center><br>
                                        <center><span><?=$lng[109]?> : <?=Functions::map($row['map_index']);?></span></center>
                                        <a href="<?=URI::get_path('profile/saved/'.$row['name'].'/'.$bugHash);?>"><button class="btn" style="margin-top: 10px;margin-right: auto;margin-left: auto;"><?=$lng[110]?></button></a>
                                    </div>
                                </div>
							<?php endforeach;?>
							<?php endif;?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>