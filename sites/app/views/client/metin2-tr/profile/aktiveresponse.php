<div role="main">
    <div id="login" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2><?=$lng[98]?></h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <div class="trenner"></div>
						<?php if($this->response['result'] == false): ?>
							<?php echo Client::alert('error',$lng[81]);?>
						<?php elseif ($this->response['result'] == true):?>
							<?php echo Client::alert('success',$lng[105]);?>
						<?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>