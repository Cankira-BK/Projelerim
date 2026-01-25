<div class="main-panel panel-download">
    <div class="main-header">
        <?=$lng[98]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if($this->response['result'] == false): ?>
                        <?php echo Client::alert('error',$lng[81]);?>
                    <?php elseif ($this->response['result'] == true):?>
                        <?php echo Client::alert('success',$lng[105]);?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>