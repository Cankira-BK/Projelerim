<div class="title">
	<?=$lng[98]?>
</div>
<div class="news page">
	<?php if($this->response['result'] == false): ?>
		<?php echo Client::alert('error',$lng[81]);?>
	<?php elseif ($this->response['result'] == true):?>
		<?php echo Client::alert('success',$lng[105]);?>
	<?php endif;?>
</div>