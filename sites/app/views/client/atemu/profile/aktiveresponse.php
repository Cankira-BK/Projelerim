<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1150px;">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[98]?></div>
            <div class="panel-body">
				<?php if($this->response['result'] == false): ?>
					<?php echo Client::alert('error',$lng[81]);?>
				<?php elseif ($this->response['result'] == true):?>
					<?php echo Client::alert('success',$lng[105]);?>
				<?php endif;?>
            </div>
        </div>
    </div>
</div>