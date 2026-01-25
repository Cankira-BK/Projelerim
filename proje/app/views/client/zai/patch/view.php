<div class="content_wrapper left">
    <div class="real_content">
		<?php Cache::open($this->view['id']); ?>
		<?php if (Cache::check($this->view['id'])): ?>
        <h2 class="headline_news active"><span class="title"><?= $this->view['title'] ?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
                    <p>
                    </p><p>
						<?= $this->view['content'] ?></p>

                    <br>


                    <p></p>

                </div>
            </div>
        </div>
		<?php endif; ?>
		<?php Cache::close($this->view['id']); ?>
    </div>
</div>