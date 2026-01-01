<div class="main-panel panel-download">
    <div class="main-header">
        <?=$lng[25]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                        <div class="bg-light">
                            <?php if ($this->response['result'] == false):?>
                                <?php echo Client::alert('error',$lng[81]);?>
                            <?php elseif ($this->response['result'] == true):?>
                                <?php echo Client::alert('success',$lng[82]);?>
                                <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$lng[83]?> : <?=$this->response['data'];?></h3>
                            <?php endif; ?>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>