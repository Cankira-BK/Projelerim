<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<div class="panel-heading"><h2 class="head"><?=$lng[73]?></h2></div>
            <div class="body">
                <div class="bg-light">
					<?php if ($this->response['result'] == false):?>
						<?php echo Client::alert('error',$lng[84]);?>
					<?php elseif ($this->response['result'] == true):?>
						<?php echo Client::alert('success',$lng[85]);?>
                        <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$lng[86]?> : <?=$this->response['data'];?></h3>
					<?php endif; ?>
                </div>
            </div>
        </article>
    </div>
</aside>