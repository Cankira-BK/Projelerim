<div role="main">
    <div id="login" class="content content-last">
        <div class="content-bg">
            <div class="content-bg-bottom">
                <h2><?=$lng[73]?></h2>
                <div class="inner-form-border">
                    <div class="inner-form-box">
                        <div class="trenner"></div>
						<?php if ($this->response['result'] == false):?>
							<?php echo Client::alert('error',$lng[84]);?>
						<?php elseif ($this->response['result'] == true):?>
							<?php echo Client::alert('success',$lng[85]);?>
                            <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;margin-left: 300px;
    margin-top: 50px;"><?=$lng[86]?> : <?=$this->response['data'];?></h3>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>