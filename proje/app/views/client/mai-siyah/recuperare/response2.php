<div class="row">
    <div class="col-md-9 normal-content">
        <div class="col-md-12 no-padding-all">
            <center><h3><?=$lng[73]?></h3></center>
            <h2 class="brackets"></h2>
        </div>
    <div class="col-md-12">
		<?php if ($this->response['result'] == false):?>
			<?php echo Client::alert('error',$lng[84]);?>
		<?php elseif ($this->response['result'] == true):?>
			<?php echo Client::alert('success',$lng[85]);?>
            <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;margin-left: 300px;
    margin-top: 50px;"><?=$lng[86]?> : <?=$this->response['data'];?></h3>
		<?php endif; ?>
    </div>
</div>