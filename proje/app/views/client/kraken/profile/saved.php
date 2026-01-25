<?php
$response = $this->result;
?>
<div class="main-panel panel-download">
    <div class="main-header">
        <?=$lng[110]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                        <div class="bg-light">
                            <?php if ($response['result'] == false):?>
                                <?=Client::alert('error',$response['message'])?>
                            <?php elseif($response['result'] == true): ?>
                                <?=Client::alert('success',$response['message'])?>
                                <center>
                                    <span id="countDown" style="font-weight: bold;font-size: 45px;">600</span>
                                    <br>
									<?=$lng[169]?>
                                </center>
                            <?php endif;?>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>
<script type="text/javascript">
    var minute = 601;
    function countDown()
    {
        if(minute !== 0)
        {
            minute = minute - 1;
            document.getElementById("countDown").innerHTML = minute;
            setTimeout(countDown, 1000);
        }
    }
    window.onload=countDown;
</script>