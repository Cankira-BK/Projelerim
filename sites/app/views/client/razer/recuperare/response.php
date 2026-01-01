<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<div class="panel-heading"><h2 class="head"><?=$lng[25]?></h2></div>
            <div class="body">
                <div class="bg-light">
					<?php if ($this->response['result'] == false):?>
						<?php echo Client::alert('error',$lng[81]);?>
					<?php elseif ($this->response['result'] == true):?>
						<?php echo Client::alert('success',$lng[82]);?>
                        <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$lng[83]?> : <?=$this->response['data'];?></h3>
					<?php endif; ?>
                </div>
            </div>
        </article>
    </div>
</aside>