<div class="main-panel panel-download">
    <div class="main-header">
		<?=$lng[62]?>
    </div>
    <div class="main-content">
		<?php Cache::open($this->view['id']);?>
		<?php if (Cache::check($this->view['id'])):?>
        <div class="main-inner main-inner-news">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div style="margin-left:340px; "><?=Functions::zaman($this->view['tarih']);?></div>
                <br><br>
                    <div class="main-text">
                        <?=$this->view['content']?>
                    </div>
            </div>
        </div>
		<?php endif;?>
		<?php Cache::close($this->view['id']);?>
        <div class="main-bottom"></div>
    </div>
    <!-- /main content -->
</div>