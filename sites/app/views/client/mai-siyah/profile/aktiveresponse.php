<div class="col-md-9 normal-content">
    <div class="row">
        <ol class="breadcrumb grunge">
            <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
            <li class="active"><?=$lng[98]?></li>
        </ol>
    </div>
    <div class="col-md-12">
		<?php if($this->response['result'] == false): ?>
			<?php echo Client::alert('error',$lng[81]);?>
		<?php elseif ($this->response['result'] == true):?>
			<?php echo Client::alert('success',$lng[105]);?>
		<?php endif;?>
    </div>
</div>