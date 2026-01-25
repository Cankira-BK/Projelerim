<div class="notification-page">
<?php Cache::open($this->view['id']."_patch_android");?>
<?php if (Cache::check($this->view['id']."_patch_android")):?>
<p class="notification-page-item material-box2">
<?=Functions::IsFileExists($this->view['image']) ?>
<?= $this->view['content'] ?>
<a><?= Functions::zaman($this->view['tarih']); ?></a>
<a><?= $this->view['title'] ?></a>
</p>
<?php endif;?>
<?php Cache::close($this->view['id']."_patch_android");?>
<div class="content decoration"></div>
</div>