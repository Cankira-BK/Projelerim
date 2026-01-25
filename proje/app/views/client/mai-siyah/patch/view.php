<div class="row">
    <div class="col-md-9 normal-content">
        <div class="col-md-12 no-padding-all">
            <center><h3><?=$lng[62]?></h3></center>
            <h2 class="brackets"></h2>
        </div>
    <div class="col-md-12">
        <div class="panel panel-news">
            <div class="panel-heading">
                <h4 class="panel-title pull-left">
                    <a href="#"><?=$this->view['title']?></a>
                </h4>
                <small class="pull-right" style="margin-top: 2px"><i class="fa fa-calendar"></i> <?=Functions::zaman($this->view['tarih'])?></small>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body faq-content">
                <?=Functions::find_url($this->view['content'])?>
            </div>
        </div>
    </div>
</div>