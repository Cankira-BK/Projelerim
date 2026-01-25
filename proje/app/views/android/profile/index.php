<?php
$account = $this->players['account'];
$status = $account['status'];
$availDt = strtotime($account['availDt']);
$now = time();
$fark = $availDt - $now;
    function find_url($string){
//"www."
        $pattern_preg1 = '#(^|\s)(www|WWW)\.([^\s<>\.]+)\.([^\s\n<>]+)#sm';
        $replace_preg1 = '\\1<a href="http://\\2.\\3.\\4" target="_blank" class="link">\\2.\\3.\\4</a>';

//"http://"
        $pattern_preg2 = '#(^|[^\"=\]]{1})(http|HTTP|ftp)(s|S)?://([^\s<>\.]+)\.([^\s<>]+)#sm';
        $replace_preg2 = '\\1<a href="\\2\\3://\\4.\\5" target="_blank" class="link">\\2\\3://\\4.\\5</a>';

        $string = preg_replace($pattern_preg1, $replace_preg1, $string);
        $string = preg_replace($pattern_preg2, $replace_preg2, $string);

        return $string;
    }

?>
<div class="container material-box">
<div class="sidebar-left-small staff-sidebar-small">
<h4 class="no-bottom"><?=$lng[106]?>, <?=$this->players['account']['login'];?></h4>
<p><?=$this->players['account']['email'];?></p>

<div class="decoration"></div>
<ul class="font-icon-list">
<li><a href="#" class="open-right"><i class="fa fa-user"></i><?=$lng[117]?></a></li>
<?php if ($this->players['modaration'] == true):?>
<li><a href="moderation/index"><i class="fa fa-gavel"></i><?=$lng[138]?></a></li>
<?php endif;?>
<li><a href="#"><i class="fa fa-phone"></i><?=$this->players['account']['phone1'];?></a></li>
<li><a href="#"><i class="fa fa-inr"></i><?=$this->players['account'][CASH];?> <?=$lng[107]?></a></li>
<li><a href="#"><i class="fa fa-dollar"></i><?=$this->players['account'][MILEAGE];?> <?=$lng[108]?></a></li>
</ul>
<br>
</div>
<div class="decoration hide-if-responsive"></div>
<div class="sidebar-right-big">
<?php if ($status == 'BLOCK'):?>
	<?=Functions::AndroidErrorMessage('warning',$lng[109]); ?>
    <h4><?=$lng[111]?></h4>
    <center><p><?=$this->players['ban']['why']?></p></center>
	<?php if ($this->players['ban']['evidence'] != ''):?>
    <h4><?=$lng[112]?></h4>
    <center><p><?=find_url($this->players['ban']['evidence'])?></p></center>
<?php endif;?>
<?php elseif ($availDt > $now):?>
	<?=Functions::AndroidErrorMessage('warning',$lng[110]); ?>
    <h4><?=$lng[111]?></h4>
    <center><p><?=$this->players['ban']['why']?></p></center>
<?php if ($this->players['ban']['evidence'] != ''):?>
    <h4><?=$lng[112]?></h4>
    <center><p><?=find_url($this->players['ban']['evidence'])?></p></center>
<?php endif;?>
    <div class="bg-light item-container">
        <center><span id="say" class="text-highlight highlight-dark"><?=$fark?></span><br> <?=$lng[113]?></center>
    </div>
    <script type="text/javascript">
        var saniye = <?=$fark+1?>;
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
<?php endif;?>
<div class="clear"></div>
<h4><?=$lng[116]?></h4>
<?php foreach ($this->players['player'] as $key=>$row):?>
    <a href="javascript:void(0)">
        <div id="profileBox" class="player-table detail-section">
            <div class="player-row">
                <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: green"><?=$row['name']?></span></center><br>
                <center><span><?=$lng[114]?> : <?=Functions::jobName($row['job']);?></span></center>
                <center><span><?=$lng[69]?> : <?=$row['level'];?></span></center>
                <center><span><?=$lng[72]?> : <?=$row['playtime'];?> <?=$lng[83]?>.</span></center>
                <center><span><?=$lng[115]?> : <?=$row['last_play'];?></span></center>
            </div>
        </div>
    </a>
<?php endforeach;?>
</div>
</div>
