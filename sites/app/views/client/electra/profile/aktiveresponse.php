<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<div class="panel-heading"><h2 class="head"><?=$lng[98]?></h2></div>
            <div class="body">
                <div class="bg-light">
					<?php if($this->response['result'] == false): ?>
						<?php echo Client::alert('error',$lng[81]);?>
					<?php elseif ($this->response['result'] == true):?>
						<?php echo Client::alert('success',$lng[105]);?>
					<?php endif;?>
                </div>
            </div>
        </article>
    </div>
</aside>