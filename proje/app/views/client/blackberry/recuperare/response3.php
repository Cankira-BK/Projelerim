<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading"><h2 class="head">PIN Unuttum</h2></div>
            <div class="body">
                <div class="bg-light">
					<?php if ($this->response['result'] == false):?>
						<?php echo Client::alert('error',$lng[84]);?>
					<?php elseif ($this->response['result'] == true):?>
						<?php echo Client::alert('success',$lng[85]);?>
                        <h3 class="header-3" style="text-transform: none;">PIN Kodunuz : <?=$this->response['data'];?></h3>
					<?php endif; ?>
                </div>
            </div>
        </article>
    </div>
</aside>