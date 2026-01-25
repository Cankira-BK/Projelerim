<div class="title">
    PIN Değiştir
</div>
<div class="news page">
	<?php if($this->response['result'] == false): ?>
		<?php echo Client::alert('error',$lng[81]);?>
	<?php elseif ($this->response['result'] == true):?>
		<?php echo Client::alert('success',"PIN kodunuz başarıyla değiştirilmiştir.");?>
        <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;">Yeni PIN Kodunuz : <?=$this->response['data'];?></h3>
	<?php endif;?>
</div>