<?php
$menu = $this->views['menus'];
$allMenu = $this->views['allMenu'];
$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
$urlL = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
$urlL = rtrim($urlL, '/');
$urlL = filter_var($urlL, FILTER_SANITIZE_URL);
$_url = explode('/', $urlL);
$menuId = $_url[3];
$getMenuWho = \StaticDatabase\StaticDatabase::init()->prepare("SELECT who,alone FROM shop_menu WHERE id = :id");
$getMenuWho->execute(array(':id'=>$menuId));
$getMenuWho->setFetchMode(PDO::FETCH_ASSOC);
$getMenuWhos = $getMenuWho->fetch();
if($getMenuWhos['alone'] == 0){
	$getMenuId = $_url[3];
}else{
	$getMenuId = $getMenuWhos['who'];
}
?>
<div class="content clearfix" id="wt_refpoint">


    <div id="category">
        <h2>
            <ul class="breadcrumb">
                <?php foreach ($menu as $menuRow):?>
                    <?php if ($menuId == $menuRow['id']):?>
                    <li>
                        <a href="#" title="En gözdeler"><?=$menuRow['name']?></a>
                        <span class="item_count"></span>
                    </li>
                    <?php endif;?>
                <?php endforeach;?>
            </ul>

            <!-- BEGIN FORM ARTICLES SORT -->
            <div class="drop-sort-by">

                <form method="post" id="formArticlesSort" action="#">
                    <label> Sırala:</label>
                    <div id="searchDropdown" class="dropdown">

                        <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                            <span class="buttonText">İlgiye göre</span>
                            <span class="btn-default"><span class="caret"></span></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">
                                <i class="icon-loop3"></i>Sırala
                            </li>
                            <li>
                                <a class="sort-option" href="javascript:void(0);" data-value="standardArticleSort">İlgiye göre </a>
                            </li>
                            <li>
                                <a class="sort-option" href="javascript:void(0);" data-value="upNameArticleSort">İsim (artan) </a>
                            </li>
                            <li>
                                <a class="sort-option" href="javascript:void(0);" data-value="downNameArticleSort">İsim (azalan) </a>
                            </li>
                            <li>
                                <a class="sort-option" href="javascript:void(0);" data-value="upPriceArticleSort">Fiyat (artan) </a>
                            </li>
                            <li>
                                <a class="sort-option" href="javascript:void(0);" data-value="downPriceArticleSort">Fiyat (azalan) </a>
                            </li>
                        </ul>
                    </div>
                    <input type="hidden" name="selectComboName" id="selectComboName_hidden" value="standardArticleSort">
                    <input type="hidden" name="filterOption" id="filterOptionHidden" value="">
                </form>

                <script type="text/javascript">
                    $(document).ready(function () {
                        var sortValue = 'standardArticleSort';
                        $('#searchDropdown').find('.dropdown-menu a.sort-option[data-value=' + sortValue + ']').addClass('active');
                        $('#searchDropdown .dropdown-toggle').dropdown();
                        $('#searchDropdown').find('.dropdown-menu').find('a.sort-option').click(function () {
                            sortArticlesBy($(this).data('value'));
                            $('li.list-item.last-in-line').each(function () {
                                $(this).removeClass('last-in-line');
                            });
                            cardMargin();
                            var anchor = $(this);
                            anchor.parents('#searchDropdown').find('.active').each(function () {
                                $(this).removeClass('active');
                            });
                            anchor.addClass('active');
                            anchor.parents('#searchDropdown').find('.buttonText').text($.trim(anchor.text()));
                        });
                        $('#searchDropdown').find('.dropdown-menu').find('a.filter-option').click(function () {
                            var value = $(this).data('value');
                            var elem = $('#filterOptionHidden');
                            elem.val(value);
                            $(this).closest('form').trigger('submit');
                            setTimeout(function () {
                                window.location.href = window.location.href;
                            }, 500);
                        });
                        $('#searchDropdown').find('.dropdown-menu').find('a.filter-option').each(function () {
                            if ($('#filterOptionHidden').val() == $(this).data('value')) {
                                $(this).find('i').removeClass('icon-radio-unchecked').addClass('icon-radio-checked');
                            }
                        });
                        setSortDropdownText();
                    });
                    function setSortDropdownText() {
                        var selectedValue = $('#selectComboName_hidden').val();
                        $('#searchDropdown').find('.dropdown-menu').find('a.sort-option').each(function () {
                            var val = $(this).data('value');
                            if (!val) {
                                return;
                            }
                            if (val === selectedValue) {
                                var dropdownText = $.trim($(this).text());
                                $('#searchDropdown').find('button.dropdown-toggle').find('.buttonText').text(dropdownText);
                            }
                        });
                    }
                </script>
            </div>
        </h2>

        <div class="tabbable tabs-left">
            <ul id="subnavi" class="nav nav-tabs">
				<?php foreach ($menu as $key=>$row):?>
                    <li class="has-subnavi" >
                        <a class="btn-catitem btn-catitem<?php if($getMenuId == $row['who']){echo '-active';}?>" href="<?php if($row['alone'] == 0){echo URI::get_path('product/view/'.$row['id']);} else{echo URI::get_path('product/views/'.$row['id']);} ?>">
							<?php if ($row['icon_type'] == 1):?>
                                <img width="32" height="32" src="<?=$row['icon']?>" class="icon">
							<?php elseif ($row['icon_type'] == 0):?>
                                <i class="fa fa-<?=$row['icon']?>"></i>
							<?php endif;?>
                            <br><?=$row['name']?>
                        </a>
						<?php
						$id = $row['id'];
						$getSubMenu = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM shop_menu WHERE mainmenu = :mainmenu");
						$getSubMenu->execute(array(':mainmenu' => $id));
						$getSubMenu->setFetchMode(PDO::FETCH_ASSOC);
						$subMenu = $getSubMenu->fetchAll();
						?>
						<?php if ($getSubMenu->rowCount() > 0):?>
                            <ul class="dropdown-menu ">
								<?php foreach ($subMenu as $keys=>$rows):?>
									<?php $tokens = md5($aId.$pId.$rows['id']); ?>
                                    <li class="has-subnavi">
                                        <a class="btn-catitem btn-catitem-active" href="<?=URI::get_path('product/view/'.$rows['id'])?>"><?=$rows['name'];?></a>
                                    </li>
								<?php endforeach;?>
                            </ul>
						<?php endif;?>
                    </li>
				<?php endforeach;?>
            </ul>
            <div class="tab-content">
                <div class="scrollable_container row-fluid">
					<?php foreach ($allMenu as $rowMenu):?>
					<?php
					$categotyId = $rowMenu['id'];
					$items = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM items WHERE kategori_id = :kategori_id AND durum = :status");
					$items->execute(array(':kategori_id'=>$categotyId,':status'=>'1'));
					$items->setFetchMode(PDO::FETCH_ASSOC);
					$itemCount = $items->rowCount();
					?>
					<?php if ($itemCount != 0):?>
                    <h3 class="clearfix" id="h3_sub_23835"><?=$rowMenu['name']?> <span class="item_count">(<?=$itemCount;?>)</span></h3>
                    <ul class="item-list card clearfix">
							<?php foreach ($items->fetchAll() as $key=>$row):?>
								<?php $row['coins'] = ($row['discount_status'] == 1 && $row['discount_1'] > 0) ? floor($row['coins'] - ($row['coins'] * $row['discount_1'] / 100)) : $row['coins']; ?>
								<?php $itemToken = md5($aId.$row['item_id'].$row['vnum'].$tokenKey);?>
                                <li class="list-item shown js_currency quickbuy" data-sort-price="<?=$row['coins']?>" data-sort-name="<?=$row['item_name']?>">
                                    <div class="contrast-box  item-box inner-content clearfix">
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
                                                    <a class="card-heading" title="<?=$row['item_name']?>">
                                                        <?=$row['item_name']?>
                                                    </a>
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
                                                                <span class="dropdown-selection"><?=$row['count_1']*$row['unit_price']?></span>
                                                                <span class="btn-default"><span class="caret"></span></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
																<?php for ($i=0;$i<$row['multi_count'];$i++):?>
                                                                    <li onclick="changePrice2(<?=$row['id']?>,<?=$i+1?>);">
                                                                        <a class="dropdown-option" data-count="<?=$row['count_'.($i+1)]*$row['unit_price'];?>" data-text="<?=$row['count_'.($i+1)]*$row['unit_price'];?>">
                                                                            <span><?=$row['count_'.($i+1)]*$row['unit_price'];?></span>
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
                                </li>
							<?php endforeach;?>
                    </ul>
                        <?php endif;?>
					<?php endforeach;?>
                    <br class="clearfloat">
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