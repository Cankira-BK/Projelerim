<?php
$char = $this->character;
$randomKey = Functions::generateRandomString();
Session::set('bug_key',$randomKey);
?>
<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="padding-left:20px; padding-right:20px;">
                <span class="title"><?=$lng[106]?></span>
                <!-- register -->
                <div class="store-activity">
                    <div class="container_3 account-wide" align="center">
                        <p style="padding: 20px;">
                            <!-- FORMS -->
                        </p>
						<?php $count = count($char);?>
						<?php if ($count == 0):?>
							<?=Client::alert('warning',$lng[107]);?>
						<?php else:?>
                            <h3>Karakterlerim</h3>
							<?php foreach ($char as $row):?>
								<?php $bugHash = md5($row['name'].$randomKey);?>
                                <a href="<?=URI::get_path('profile/saved/'.$row['id']);?>">
                                    <div id="profileBox" class="player-table">
                                        <div class="player-row">
                                            <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                                            <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></span></center><br>
                                            <center><span><?=$lng[109]?> : <?=Functions::map($row['map_index']);?></span></center>
                                            <a href="<?=URI::get_path('profile/saved/'.$row['name'].'/'.$bugHash);?>"><button class="wbuttons wbuttons-bt" style="margin-top: 10px;"><?=$lng[110]?></button></a>
                                        </div>
                                    </div>
                                </a>
							<?php endforeach;?>
						<?php endif;?>
                        <br />
                        <br />
                        <br />
                        <!-- FORMS.End -->
                    </div>
                </div>
                <!-- register.End -->
            </div>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>