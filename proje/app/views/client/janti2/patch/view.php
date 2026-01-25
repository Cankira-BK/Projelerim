<main class="content">
<div class="panel panel-buyuk">
<div class="panel-heading">
			<?php Cache::open($this->view['id']);?>
			<?php if (Cache::check($this->view['id'])):?>
<center>
<?=$this->view['title']?> </center>
<br>
 <center>
<?=$this->view['content']?>
</center>
			<?php endif;?>
			<?php Cache::close($this->view['id']);?>
<center>
</center>
</div>



</div>
</main>