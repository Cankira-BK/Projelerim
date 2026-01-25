<?php
function slugString($text)
{
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	$text = preg_replace('~[^-\w]+~', '', $text);
	$text = trim($text, '-');
	$text = preg_replace('~-+~', '-', $text);
	$text = strtolower($text);
	if (empty($text)) {
		return 'n-a';
	}
	return $text;
}
?>
<?php Cache::open(slugString($this->view['title']));?>
<?php if (Cache::check(slugString($this->view['title']))):?>
    <div style="float: left; width: 665px; margin-left:20px;">
        <div style="float: left; margin-top: 10px;">
            <div class="windows windows-wbTop"></div>
            <div class="windows windows-wbCenter">
                <div class="content"
                     style="text-align:left; font-size:10pt; color:#776255; display:inline-block; padding-top:25px; padding-bottom:25px; font-weight:bold;">
                    <span class="title"><?=$this->view['title']?></span><br><br><br>
					<?=$this->view['content']?>
                    <div class="seperator" style="width: 571px;"></div>
					<?=$lng[64]?>  : <?=Functions::zaman($this->view['tarih']);?>
                </div>
            </div>
            <div class="windows windows-wbBottom"></div>
        </div>
    </div>
<?php endif;?>
<?php Cache::close(slugString($this->view['title']));?>