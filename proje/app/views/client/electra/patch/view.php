<style>
    .main-text-bg{
        width: 95%;
        overflow: auto;
        padding: 20px;
    }
</style>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<?php Cache::open($this->view['id']);?>
			<?php if (Cache::check($this->view['id'])):?>
			<div class="panel-heading"><h2 class="head"><?=$this->view['title']?></h2></div>
            <div class="body">
                <div class="main-inner main-inner-news">
                    <div class="main-text-bg">
                        <div style="float: right;color: #77c1de"><?=Functions::zaman($this->view['tarih']);?></div>
                        <br><br>
                        <div class="main-text">
							<?=$this->view['content']?>
                        </div>
                    </div>
                </div>
            </div>
			<?php endif;?>
			<?php Cache::close($this->view['id']);?>
        </article>
    </div>
</aside>