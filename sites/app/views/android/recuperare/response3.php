<div id="content" class="snap-content">
<div class="coverpage coverpage-bg3 coverpage-construction">
<div class="coverpage-content">
<h1><?=$lng[21]?></h1>

<?php if ($this->response['result'] == false):?>
<h3><?=$lng[86]?></h3>
<?php elseif ($this->response['result'] == true):?>
<h3><?=$lng[91]?></h3>
<p><?=$lng[92]?> : <?=$this->response['data'];?></p>
<?php endif; ?>

<a class="uppercase center-button button button-red" href="<?=URI::get_path('index')?>"><?=$lng[0]?></a>
</div>
<div class="overlay"></div>
</div>
</div>
