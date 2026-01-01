<div role="main">
<div class="content">
    <div class="content-bg">
        <div class="content-bg-bottom">
            <h2><?=$lng[62]?></h2>
            <div class="inner-content" id="news">
                <table style="width: 100%;">
                    <tbody>
					<?php Cache::open($this->view['id']);?>
					<?php if (Cache::check($this->view['id'])):?>
                    <tr>
                        <td>
                            <h3><a name="news_0" style="color:#7B1300" href="javascript:void(0)"><?=$this->view['title'];?></a></h3>
                            <p class="message" style="margin-top: 30px;">
								<?=$this->view['content'];?>
                            </p>
                            <p class="author"></p>
                            <p class="date"><?=Functions::zaman($this->view['tarih'])?></p>
                        </td>
                    </tr>
					<?php endif;?>
					<?php Cache::close($this->view['id']);?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>