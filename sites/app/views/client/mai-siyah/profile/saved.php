<div class="col-md-9 normal-content">
    <div class="row">
        <ol class="breadcrumb grunge">
            <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
            <li class="active"><?=$lng[110]?></li>
        </ol>
    </div>
    <div class="col-md-12">
		<?php if ($this->result['result'] == false):?>
			<?=Client::alert('error',$lng[168])?>
		<?php elseif($this->result['result'] == true): ?>
			<?=Client::alert('success',$lng[170])?>
            <center><span id="say" style="font-weight: bold;font-size: 45px;">600</span><br> <?=$lng[169]?></center>
		<?php endif;?>
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