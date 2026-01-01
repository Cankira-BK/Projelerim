<?php
$response = $this->result;
?>
<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[98]?> </center>
        </div>
        <div class="panel-body">
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
</main>
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