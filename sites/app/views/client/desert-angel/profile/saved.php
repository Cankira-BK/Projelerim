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
    </div>
    <div class="main-bottom"></div>
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