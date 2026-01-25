<div class="container material-box">
<div class="one-half-responsive2">
<h4><?=$lng[143]?></h4>
<?php if($this->response['result'] == false): ?>
	<?php echo Functions::AndroidErrorMessage('error',$lng[86]);?>
<?php elseif ($this->response['result'] == true):?>
	<?php echo Functions::AndroidErrorMessage('success',$lng[165]);?>
<?php endif;?>
</div>
</div>