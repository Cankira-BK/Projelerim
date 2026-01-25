<?php
$patchInfo = $this->all["patch"];
?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
			<?php Cache::open($this->view['id']."_patch");?>
			<?php if (Cache::check($this->view['id']."_patch")):?>
                <div style="text-align: center">
					<?=$this->view['title']?>
                </div>
                <div style="text-align: right;font-size: 12px;color:#798127">
					<?=Functions::zaman($this->view['tarih']);?>
                </div>
                <br>
                <span style="font-size: 13px;">
					<?=$this->view['content']?>
                </span>
			<?php endif;?>
			<?php Cache::close($this->view['id']."_patch");?>
        </div>
    </div>
</main>