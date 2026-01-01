<style>
    .main-text-bg{
        width: 95%;
        overflow: auto;
        padding: 20px;
        background: url(<?=URI::public_path('asset/images/content-bg.jpg')?>);
        filter: brightness(1.72);
    }
</style>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<?php Cache::open($this->view['id']."_patch"); ?>			<?php if (Cache::check($this->view['id']."_patch")): ?>
                <div class="panel-heading">
                    <h2 class="head"><?= $this->view['title'] ?></h2>
                </div>
                <div class="body">
                    <div class="main-inner main-inner-news">
                        <div class="main-text-bg">
                            <div style="float: right;color: #77c1de"><?=Functions::prettyDateTime1($this->view['tarih']);?></div>
                            <br><br>
                            <div class="main-text">
								<?= $this->view['content'] ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php endif;?>
			<?php Cache::close($this->view['id']."_patch"); ?>
        </article>
    </div>
</aside>