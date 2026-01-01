<?php
$response = $this->result;
?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading">
                <h2 class="head"><?=$lng[110]?>
                    <a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a>
                </h2>
            </div>
            <div class="body">
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
        </article>
    </div>
</aside>
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