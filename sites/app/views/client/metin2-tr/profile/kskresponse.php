<div role="main">
    <div id="login" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2><?=$lng[153]?></h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <div class="trenner"></div>
						<?php if($this->response['result'] == false): ?>
							<?php echo Client::alert('error',$lng[81]);?>
						<?php elseif ($this->response['result'] == true):?>
							<?php echo Client::alert('success',$lng[157]);?>
                            <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$lng[158]?> : <?=$this->response['data'];?></h3>
						<?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>