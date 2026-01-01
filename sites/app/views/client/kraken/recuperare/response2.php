<div class="main-panel panel-download">
    <div class="main-header">
        <?=$lng[73]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <div class="bg-light">
                        <?php if ($this->response['result'] == false):?>
                            <?php echo Client::alert('error',$lng[84]);?>
                        <?php elseif ($this->response['result'] == true):?>
                            <?php echo Client::alert('success',$lng[85]);?>
                            <h3 class="header-3" style="text-transform: none;"><?=$lng[86]?> : <?=$this->response['data'];?></h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>