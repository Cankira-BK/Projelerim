<div class="container material-box">
<div class="one-half-responsive2">
<h4><?=$lng[99]?></h4>
<?php if ($this->result['result'] == false):?>
	<?=Functions::AndroidErrorMessage('error',$lng[162])?>
<?php elseif($this->result['result'] == true): ?>
	<?=Functions::AndroidErrorMessage('success',$lng[164])?>
    <center><span id="say" style="font-weight: bold;font-size: 45px;">600</span><br> <?=$lng[163]?></center>
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