<?php
$item = $this->ajaxem['item'];
$category = $this->ajaxem['category'][0];
Session::init();
$aId = Session::get('aId');
$pId = Session::get('pId');
$itemId = $item['item_id'];
$vnum = $item['vnum'];
$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
$hash = $this->hash->create('sha256',$aId.$itemId.$vnum.'1',$tokenKey);
$item['coins'] = ($item['discount_status'] == 1 && $item['discount_1'] > 0) ? floor($item['coins'] - ($item['coins'] * $item['discount_1'] / 100)) : $item['coins'];
?>
<div id="item-fancybox" class="scrollable_container_fancy">
    <div id="itemDetails" class="contrast-box row-fluid contrast-box">
        <!--sale-->
        <div class="span12">
            <div class="meta-infos clearfix">
                <h2 id="name" class="left ">
                    <span id="selectionNameMain"><?= $item['item_name'] ?></span>
                </h2>
                <div class="meta-prop">
                    <div class="price">
                        <span class="price-label">Fiyat:</span>
                        <span class="amount js_currency">
                    <span class="block-price">
                        <img class="ttip" tooltip-content="Ejderha Markası" src="<?=URI::public_path('images/em_coins.png')?>" alt="Ejderha Markası"/>
                        <span id="end-price" class="end-price old-price"><?= $item['coins']; ?></span>
                    </span>
                        </span>
                    </div>
                </div>
                <div class="breadcrumb">
                    <span><a href="<?=URI::get_path('index')?>">Anasayfa</a>&rsaquo;</span>
					<?php $tokenI = md5($aId.$pId.$category['id']); ?>
                    <span><a href="<?=URI::get_path('product/view/'.$category['id'].'&token='.$tokenI)?>"><?=$category['name']?></a>&rsaquo;</span>
                    <span class="active"><?=$item['item_name']?></span>
                </div>
            </div>
            <div id="pictureShowcase">
                <div class="item-info clearfix">
                    <div class="item-showcase grey-box  span4">
                        <div id="image" class="picture_wrapper">
                            <img id="selectionImageMain" class="image" src="<?= URL.$item['item_image']; ?>" alt="<?=$item['item_name']?>"/>
                        </div>
                    </div>
                    <div class="tabbable item-description span8">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#info" data-toggle="tab">Bilgi</a></li>
                            <li ><a href="#description" data-toggle="tab">Açıklama</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div class="tab-pane scrollable_container_fancy grey-box active" id="info">
                                <p id="selectionShortMain">
									<?=$item['information'];?>
                                </p>
                            </div>
							<?php if($item['information'] != null): ?>
                                <div class="tab-pane scrollable_container_fancy grey-box " id="description">
									<?=$item['information'];?>
                                </div>
							<?php else: ?>
                                <div class="tab-pane scrollable_container_fancy grey-box" id="description">
                                    <p>Açıklama yok.</p>
                                </div>
							<?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="itemBuy" class="contrast-box volume_discount contrast-box">
        <div class="grey-box clearfix">
            <div class=" dark-grey-box clearfix">
                <div class="contrast-box 1 ">
                    <div class="amount clearfix js_currency" data-currency="1" style="padding: 20px;">
						<?php if ($item['multi_count'] > 1):?>
                            <label>Miktar seç:</label>
                            <ul id="js_button_container" class="clearfix ">
								<?php for ($i=0;$i<$item['multi_count'];$i++):?>
                                    <li onclick="changePrice(<?=$item['id']?>,<?=$i+1?>);">
										<?php if ($i === 0):?>
                                            <button id="btn-active-<?=$i+1?>" type="button" class="btn-discount _<?=$i+1?> btn-active"><?=$item['count_'.($i+1)]*$item['unit_price']?></button>
										<?php else:?>
                                            <button id="btn-active-<?=$i+1?>" type="button" class="btn-discount _<?=$i+1?>"><?=$item['count_'.($i+1)]*$item['unit_price']?></button>
										<?php endif;?>
										<?php if ($item['discount_status']):?>
                                            <div class="discount_percentage js_currency">
                                                <span><?=$item['discount_'.($i+1)]?>%</span>
                                            </div>
										<?php endif;?>
                                    </li>
								<?php endfor;?>
                            </ul>
						<?php else:?>
                            <label>Bu ürün için çoklu miktar seçim özelliği yoktur.</label>
                            <ul id="js_button_container" class="clearfix ">
                                <li>
                                    <button type="button" class="btn-discount _5 btn-active">1</button>
                                </li>
                            </ul>
						<?php endif;?>
                    </div>
                    <div class="arrow"></div>
                </div>
                <div id="buy" class="">
                    <form>
                        <p>Şu anki fiyatı:</p>
                        <p class="bill_price block-price">
                            <img class="ttip" tooltip-content="Ejderha Markası" src="<?=URI::public_path('images/em_coins.png')?>" alt="Ejderha Markası" />
                            <span id="end-price_1" class="end-price"><?= $item['coins']; ?></span>
                        </p>
                        <div class="buy-btn-box clearfix">
                            <div class="btn-group ">
                                <a id="buyItem" href="<?=URI::get_path('product/buyem/'.$itemId.'/1/'.$hash)?>" class="fancybox fancybox.ajax"><button type="button" class="btn-price">Satın al</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- grey-box closed -->
    </div> <!-- item-buy closed -->
</div><!-- item-fancy closed -->
<script>
    function changePrice(item_id,num) {
        var url = "<?=URI::get_path('product/price_change2')?>";
        var data = {item_id:item_id,num:num};
        $.post(url,data,function (rsp) {
            if (rsp.status === true)
            {
                for (var i=1;i<=rsp.multi;i++)
                {
                    if(num === i)
                        $("#btn-active-"+i).addClass("btn-active");
                    else
                        $("#btn-active-"+i).removeClass("btn-active");

                }
                $('#end-price').text(rsp.price);
                $('#end-price_1').text(rsp.price);
                $('#end-mileage').text(rsp.price);
                var buyUrl = "<?=URI::get_path('product/buyem/'.$itemId.'/')?>" + rsp.count + "/" + rsp.hash;
                $('#buyItem').attr('href',buyUrl);
            }
        },"json");
    }
</script>
