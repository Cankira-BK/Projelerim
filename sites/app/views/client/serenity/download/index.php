<div class="content_wrapper left">
    <div class="real_content">

        <h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[0]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
                    <br>
                    <table class="topranking" cellspacing="1" cellpadding="0" style="line-height: 4">
                        <tbody><tr class="c0">
                            <td class="pname"><i><?=$lng[52]?></i></td>
                            <td class="pname"><i><?=$lng[53]?></i></td>
                            <td class="pname"><i><?=$lng[54]?></i></td>
                            <td class="pname"><i><?=$lng[55]?></i></td>
                        </tr>
						<?php foreach ($this->pack as $row):?>
                        <tr class="c1">
                            <td class="pname"><?=$row['name'];?></td>
                            <td class="pname"><?=$row['size'];?></td>
                            <td class="pname"><img src="<?=$row['image']?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>" width="70px;"></td>
                            <td class="pname">
                                <a id="player-btn" href="<?=$row['url']?>" target="_blank"><input type="button" value="indir"></a> <br>
                            </td>
                        </tr>
						<?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
