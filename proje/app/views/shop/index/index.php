<?php
    $tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
?>
<div class="content clearfix" id="wt_refpoint">
    <div id="landing" class="scrollable_container">
        <div class="row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <div id="prmo-area" class="span12">
                        <div id="zs-prmo-slider" class="span8">
                            <div id="prmoSlider" class="royalSlider rsMinW">
                                <?php foreach ($this->model['mainBanner'] as $key => $row): ?>
                                    <div class="rsContent slide">
                                        <div class="bContainer">
                                            <img src="<?= $row['image'] ?>">
                                            <div class="slider_banner">
                                                <h3><?= $row['title'] ?></h3>
                                                <p><?= $row['content'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
						<?php if (\StaticDatabase\StaticDatabase::settings('happy_hour')):?>
                            <div id="zs-prmo-ad" class="span4">
                                <div class="call-to-action contrast-box">
                                    <div id="happy-hour">
                                        <img src="<?=URI::public_path('images/happy-hour-table.png')?>">
                                        <a class="hh-content" href="<?=URI::get_path('buy')?>">
                                            <div class="hh-box">
                                                <p class="hh-text">Happy Hour Etkinliğine Özel Ejderha Parası Satın Alımlarında <span class="hh-percent">%<?=\StaticDatabase\StaticDatabase::settings('happy_hour_discount')?> </span> <br> Daha Fazla Ejderha Parası Kazan!</p>
                                            </div>
                                            <div class="hh-box-btn" style="width: 50px;margin-top: -138px;transform: rotate(-45deg);-webkit-transform: rotate(43deg);margin-right: 10px;font-size: 17px;font-weight: 700;color: #f6b509;text-shadow: 1px 1px 2px black, 0 0 22px #3a5f1f, 0 0 11px #54b10e;">
                                                %<?=\StaticDatabase\StaticDatabase::settings('happy_hour_discount')?> DAHA FAZLA
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
						<?php else:?>
                            <div id="zs-prmo-ad" class="span4">
                                <div class="call-to-action contrast-box">
                                    <img src="<?= $this->model['subBanner']['image'] ?>">
                                    <div class="slider_banner">
                                        <h3><?= $this->model['subBanner']['title'] ?></h3>
                                        <p><?= $this->model['subBanner']['content'] ?></p></div>
                                </div>
                            </div>
						<?php endif;?>
                    </div>
                </div>
            </div>
            <!-- Main CallToAction for a primary calltoaction message-->
            <br class="clearfloat">
            <div class="row-fluid">
                <div class="item-sample span12">
                    <h2 class="heading-cat">
						<?php
						$firstMainCategory = \StaticDatabase\StaticDatabase::init()->prepare("SELECT id FROM shop_menu WHERE mainmenu = 0 LIMIT 1");
						$firstMainCategory->execute();
						?>
                        <a class="text-link" href="<?=URI::get_path('product/views/'.$firstMainCategory->fetch(PDO::FETCH_ASSOC)['id'])?>">Tüm ürünleri göster</a>Sevilen Ürünler</h2>
                    <div class="carousell royalSlider contentslider rsDefault visibleNearby card">
                        <?php foreach ($this->model['items'] as $key=>$row):?>
                            <?php $itemToken = md5($aId.$row['item_id'].$row['vnum'].$tokenKey);?>
                            <?php $row['coins'] = ($row['discount_status'] == 1 && $row['discount_1'] > 0) ? $row['coins'] - ($row['coins'] * $row['discount_1'] / 100) : $row['coins']; ?>
                            <div class="span4 list-item quickbuy">
                                <div class="contrast-box  item-box inner-content clearfix" >
                                    <div class="desc row-fluid">
                                        <div class="item-description">
                                            <p class="item-status js_currency_default">
                                                <?php if ($row['item_time'] == 1):?>
                                                    <i class="zicon-hd-time-ingame ttip" tooltip-content="<?=Functions::secondsToDay($row['socket0'])?>"></i>
												<?php endif;?>
												<?php if ($row['discount_status'] == 1):?>
                                                    <i class="zicon-hd-discount ttip" tooltip-content="Miktar İndirimi"></i>
												<?php endif;?>
                                            </p>
                                            <h4 class="fancybox fancybox.ajax" href="<?=URI::get_path('product/ajax/'.$row['item_id'].'&token='.$itemToken)?>">
                                                <a class="card-heading" title="<?=$row['item_name']?>"><?=$row['item_name']?></a>
                                            </h4>
                                            <div class="item-shortdesc clearfix">
                                                <a class="item-thumb fancybox fancybox.ajax" href="<?=URI::get_path('product/ajax/'.$row['item_id'].'&token='.$itemToken)?>">
                                                    <div class="item-thumb-container">
                                                        <div id="image" class="picture_wrapper_2">
                                                            <img class="item-thumb-63" src="<?=URL.$row['item_image']?>" alt="<?=$row['item_name']?>">
                                                        </div>
                                                    </div>
                                                </a>
                                                <span class="category-link"></span>
                                                <div class="fancybox fancybox.ajax" href="<?=URI::get_path('product/ajax/'.$row['item_id'].'&token='.$itemToken)?>">
                                                    <p class="item-box-description">
														<?=$row['description']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Buttons -->
                                        <div class="item-footer price_desc row-fluid js_currency_default">
                                            <div class="action-box left">
                                                <?php if ($row['multi_count'] > 1):?>
                                                    <div class="zs-dropdown">
                                                        <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                                            <span class="dropdown-selection"><?=$row['count_1']?></span>
                                                            <span class="btn-default"><span class="caret"></span></span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <?php for ($i=0;$i<$row['multi_count'];$i++):?>
                                                                <li onclick="changePrice2(<?=$row['id']?>,<?=$i+1?>);">
                                                                    <a class="dropdown-option" data-count="<?=$row['count_'.($i+1)];?>" data-text="<?=$row['count_'.($i+1)];?>">
                                                                        <span><?=$row['count_'.($i+1)];?></span>
																		<?php if ($row['discount_'.($i+1)] > 0):?>
                                                                            <span class="extra-info">%<?=$row['discount_'.($i+1)]?> İndirim</span>
																		<?php endif;?>
                                                                    </a>
                                                                </li>
                                                            <?php endfor;?>
                                                        </ul>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                            <div class="action-box right">
                                                <button class="span5 right btn-price">
                                                    <span class="block-price">
                                                        <img class="ttip" tooltip-content="Ejderha Parası" src="<?=URI::public_path('images/coins.png')?>" alt="Ejderha Parası"/>
                                                        <span id="item_price_<?=$row['id']?>" class="end-price" data-value="<?=$row['coins']?>"><?=$row['coins']?></span>
                                                    </span>
                                                </button>
                                                <button class="span5 right btn-buy fancybox fancybox.ajax" href="<?=URI::get_path('product/ajax/'.$row['item_id'].'&token='.$itemToken)?>">Satın al</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changePrice2(item_id,num) {
        var url = "<?=URI::get_path('product/price_change')?>";
        var data = {item_id:item_id,num:num};
        $.post(url,data,function (rsp) {
            console.log(rsp);
           if (rsp.status === true)
           {
                $("#item_price_" + item_id).text(rsp.price);
                $("#item_price_" + item_id).attr("data-value",rsp.price);
           }
        },"json");
    }
</script>