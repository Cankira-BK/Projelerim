<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1150px;">
		<?php Cache::open($this->view['id']); ?>
		<?php if (Cache::check($this->view['id'])): ?>
            <div class="panel panel-buyuk">
                <div class="panel-heading"><?= $this->view['title'] ?>
                    <small class="pull-right"><?= Functions::zaman($this->view['tarih']); ?> </small>
                </div>
                <div class="panel-body">
					<?= $this->view['content'] ?>
                </div>
            </div>
		<?php endif; ?>
		<?php Cache::close($this->view['id']); ?>
    </div>
</div>