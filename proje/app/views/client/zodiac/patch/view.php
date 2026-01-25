
<?php Cache::open($this->view['id']."_patch");?>
<?php if (Cache::check($this->view['id']."_patch")):?>
    <div class="title">
		<?=$this->view['title']?>
    </div>
    <div class="news page">
        <div class="main-inner main-inner-news">
            <div class="main-text-bg">
                <div style="float: right;color: #83bb6d"><?=Functions::prettyDateTime1($this->view['tarih']);?></div>
                <br><br>
                <div class="main-text">
					<?=$this->view['content']?>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<?php Cache::close($this->view['id']."_patch");?>