<div class="col-md-9">
    <div class="col-md-12 no-padding" style="min-height: 1125px;">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[110]?></div>
            <div class="panel-body">
				<?php if ($this->result['result'] == false):?>
					<?=Client::alert('error',$lng[168])?>
				<?php elseif($this->result['result'] == true): ?>
					<?=Client::alert('success',$lng[170])?>
                    <center><span id="say" style="font-weight: bold;font-size: 45px;">600</span><br> <?=$lng[169]?></center>
				<?php endif;?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var saniye = 601;
    function bak()
    {
        if(saniye != 0)
        {
            saniye = saniye - 1;
            document.getElementById("say").innerHTML = saniye;
            setTimeout(bak, 1000);
        }
    }
    window.onload=bak;
</script>