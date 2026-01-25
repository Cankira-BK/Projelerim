<div class="col-md-9 normal-content">
    <div class="row">
        <ol class="breadcrumb grunge">
            <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
            <li class="active"><?=$lng[111]?></li>
        </ol>
    </div>
    <div class="col-md-12">
		<?php if($this->response['result'] == false): ?>
			<?php echo Client::alert('error',$lng[81]);?>
		<?php elseif ($this->response['result'] == true):?>
			<?php echo Client::alert('success',$lng[120]);?>
            <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$lng[121]?> : <?=$this->response['data']?></h3>
		<?php endif;?>
    </div>
</div>