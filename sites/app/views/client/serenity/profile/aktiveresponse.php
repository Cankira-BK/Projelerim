<div class="content_wrapper left">
    <div class="real_content">
        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[98]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
					<?php if($this->response['result'] == false): ?>
						<?php echo Client::alert('error',$lng[81]);?>
					<?php elseif ($this->response['result'] == true):?>
						<?php echo Client::alert('success',$lng[105]);?>
					<?php endif;?>
                </div>
            </div>
        </div
    </div>
</div>
</div>