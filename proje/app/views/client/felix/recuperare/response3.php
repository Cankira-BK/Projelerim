<div class="title">
    PIN Unuttum
</div>
<div class="news page">
	<?php if ($this->response['result'] == false):?>
		<?php echo Client::alert('error',$lng[84]);?>
	<?php elseif ($this->response['result'] == true):?>
		<?php echo Client::alert('success',$lng[85]);?>
        <h3 class="header-3" style="text-transform: none;">PIN Kodunuz : <?=$this->response['data'];?></h3>
	<?php endif; ?>
</div>