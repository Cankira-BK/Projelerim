<div class="container material-box">
<div class="one-half-responsive2">
<h4><?=$lng[101]?></h4>
<?php if($this->response['result'] == false): ?>
	<?php echo Functions::AndroidErrorMessage('error',$lng[86]);?>
<?php elseif ($this->response['result'] == true):?>
	<?php echo Functions::AndroidErrorMessage('success',$lng[188]);?>
    <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$lng[189]?> : <?=$this->response['data']?></h3>
<?php endif;?>
</div>
</div>