<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="padding-left:20px; padding-right:20px;">
                <span class="title"> <?=$lng[98]?></span>
                <!-- register -->
                <div class="store-activity">
                    <div class="container_3 account-wide" align="center">
                        <p style="padding: 20px;">
                            <!-- FORMS -->
                        </p>
						<?php if($this->response['result'] == false): ?>
							<?php echo Client::alert('error',$lng[81]);?>
						<?php elseif ($this->response['result'] == true):?>
							<?php echo Client::alert('success',$lng[105]);?>
						<?php endif;?>
                        <br />
                        <br />
                        <br />
                        <!-- FORMS.End -->
                    </div>
                </div>
                <!-- register.End -->
            </div>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>