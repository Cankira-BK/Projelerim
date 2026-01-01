<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading"><h2 class="head"><?=$lng[110]?><a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a></h2></div>
            <div class="body">
				<?php if ($this->result['result'] == false):?>
					<?=Client::alert('error',$lng[168])?>
				<?php elseif($this->result['result'] == true): ?>
					<?=Client::alert('success',$lng[170])?>
                    <center><span id="say" style="font-weight: bold;font-size: 45px;">600</span><br> <?=$lng[169]?></center>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
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