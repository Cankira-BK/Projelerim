<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1125px;">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[73]?></div>
            <div class="panel-body">
				<?php if ($this->response['result'] == false):?>
					<?php echo Client::alert('error',$lng[84]);?>
				<?php elseif ($this->response['result'] == true):?>
					<?php echo Client::alert('success',$lng[85]);?>
                    <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;margin-left: 300px;
    margin-top: 50px;"><?=$lng[86]?> : <?=$this->response['data'];?></h3>
				<?php endif; ?>
            </div>
        </div>
    </div>
</div>