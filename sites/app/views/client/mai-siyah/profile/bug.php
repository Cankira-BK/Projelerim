<?php
$char = $this->character;
$randomKey = Functions::generateRandomString();
Session::set('bug_key',$randomKey);
?>
<div class="col-md-9 normal-content">
    <div class="row">
        <ol class="breadcrumb grunge">
            <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
            <li class="active"><?=$lng[106]?></li>
        </ol>
    </div>
    <div class="col-md-6">
		<?php $count = count($char);?>
		<?php if ($count == 0):?>
			<?=Client::alert('warning',$lng[107]);?>
		<?php else:?>
        <?php foreach ($char as $row):?>
				<?php $bugHash = md5($row['name'].$randomKey);?>
        <div class="login-cont frame">
            <div class="frame-inner" style="padding:1px 15px 5px; ">
            <div class="portrait-row">
                <div class="portrait-left-col" style="float: left;width: 25%;" href="<?=URI::get_path("detail/player/".$row['name'])?>">
		                    <span class="icon-portrait icon-frame ">
                                <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" style="width:70px; " alt="<?=Functions::jobName($row['job']);?>">
			                    <span class="frame"></span>
		                    </span>
                </div>
                <div class="portrait-right-col">
                    <h3 class="header-3" style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none"><a href="<?=URI::get_path("detail/player/".$row['name'])?>">  <?=$row['name']?></a></h3>
					<?=$lng[109]?> : <strong><?=Functions::map($row['map_index']);?></strong><br><br>
                    <a href="<?=URI::get_path('profile/saved/'.$row['name'].'/'.$bugHash);?>" class="col-md-6"><button class="btn btn-block btn-grunge" style="margin-top: -15px;"><?=$lng[110]?></button></a>
                </div>
                <h2 class="header-2" style="text-align: center;text-shadow: 0 0 3px #c17373;padding-bottom: 5px;margin-bottom: 10px;margin-top: 10px;background: url(<?=URI::public_path('static/images/tool/skill-calculator/calc-divider.jpg')?>) 50% 100% no-repeat;"></h2>
            </div>
            </div>
            </div>
        <?php endforeach;?>
		<?php endif;?>
    </div>
</div>