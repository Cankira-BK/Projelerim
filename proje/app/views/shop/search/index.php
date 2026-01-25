<?php
$menu = isset($this->search['menu']) ? $this->search['menu'] : null;
$result = $this->search['result'];
$message = $this->search['message'];
$items = isset($this->search['data']) ? $this->search['data'] : null;
$tokenKey = \StaticDatabase\StaticDatabase::settings('tokenkey');
$count = (count($items) > 0) ? count($items) : null;
?>
    <div class="content clearfix" id="wt_refpoint">
        <div id="category">
            <h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="#" title="">Arama Sonuçları</a>
                        <?php if (count($items) > 0):?>
                        <span class="item_count">(<?=$count?>)</span>
                        <?php endif;?>
                    </li>
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
				<?php if ($result === true):?>
                <ul id="subnavi" class="nav nav-tabs">
					<?php foreach ($menu as $key=>$row):?>
						<?php $token = md5($aId.$pId.$row['id']) ?>
                        <li class="has-subnavi" >
                            <a class="btn-catitem long" href="<?php if($row['alone'] == 0){echo URI::get_path('product/view/'.$row['id']);} else{echo URI::get_path('product/views/'.$row['id']);} ?>">
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
				<?php endif;?>
                <div class="tab-content">
                    <div class="scrollable_container row-fluid">
                        <?php if ($result === false):?>
                            <div id="error" class="contrast-box">
                                <div class="dark-grey-box">
                                    <h3><i class="icon-info left"></i> Aradığınız eşya bulunamadı !</h3>
                                    <p>(<?=$message?>) Hatanın sebebi aşağıdakilerden bir tanesi olabilir!</p>
                                    <ul style="list-style: circle">
                                        <li>Aradığınız eşya mevcut olmayabilir.</li>
                                        <li>Arama yaparken özel karakter kullanıyor olabilirsiniz.</li>
                                        <li>Bir haneli harf ya da rakam için arama yapıyor olabilirsiniz.</li>
                                        <li>Sistem kontrolünü aşmaya çalışıyor olabilirsiniz.</li>
                                    </ul>
                                </div>
                            </div>
                        <?php else:?>
                            <ul class="item-list card clearfix">
								<?php foreach ($items as $key=>$row):?>
									<?php $row['coins'] = ($row['discount_status'] == 1 && $row['discount_1'] > 0) ? $row['coins'] - ($row['coins'] * $row['discount_1'] / 100) : $row['coins']; ?>
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
                                    </li>
								<?php endforeach;?>
                            </ul>
                        <?php endif;?>
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
<?php die;?>
<?php if ($result == false):?>
	<?php if ($message == 'hash'):?>
        HASH HATASI
	<?php elseif ($message == 'empty'):?>
        <div class="content clearfix" id="wt_refpoint">
            <div id="category">

                <h2>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#" title="En gözdeler">Hata</a>
                            <span class="item_count"></span>
                        </li>
                    </ul>

                    <!-- BEGIN FORM ARTICLES SORT -->
                    <div class="drop-sort-by">

                        <form method="post" id="formArticlesSort" action="https://tr-shop-metin2.gameforge.com:443/category/display?__token=73c7ba03430518b6489e30f1e32c27f6">
                            <label> Sırala:</label>
                            <div id="searchDropdown" class="dropdown">

                                <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                    <span class="buttonText">İlgiye göre</span>
                                    <span class="btn-default"><span class="caret"></span></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header"><i class="icon-loop3"></i>Sırala</li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="standardArticleSort">
                                            İlgiye göre                            </a>
                                    </li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="upNameArticleSort">
                                            İsim (artan)                            </a>
                                    </li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="downNameArticleSort">
                                            İsim (azalan)                            </a>
                                    </li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="upPriceArticleSort">
                                            Fiyat (artan)                            </a>
                                    </li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="downPriceArticleSort">
                                            Fiyat (azalan)                            </a>
                                    </li>



                                </ul>
                            </div>
                            <input
                                    type="hidden"
                                    name="selectComboName"
                                    id="selectComboName_hidden"
                                    value="standardArticleSort"
                            >
                            <input type="hidden" name="filterOption" id="filterOptionHidden" value="">
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                // set selected sort option active
                                var sortValue = 'standardArticleSort';
                                $('#searchDropdown').find('.dropdown-menu a.sort-option[data-value=' + sortValue + ']').addClass('active');

                                // click event on sort options: reload
                                $('#searchDropdown .dropdown-toggle').dropdown();
                                $('#searchDropdown').find('.dropdown-menu').find('a.sort-option').click(function () {
                                    sortArticlesBy($(this).data('value'));

                                    $('li.list-item.last-in-line').each(function() {
                                        $(this).removeClass('last-in-line');
                                    });

                                    cardMargin();

                                    var anchor = $(this);

                                    // toggle active-class
                                    anchor.parents('#searchDropdown').find('.active').each(function() {
                                        $(this).removeClass('active');
                                    });

                                    anchor.addClass('active');

                                    // show sort text in button
                                    anchor.parents('#searchDropdown').find('.buttonText').text(anchor.text().trim());
                                });

                                // click event on filter options: reload
                                $('#searchDropdown').find('.dropdown-menu').find('a.filter-option').click(function () {
                                    var value = $(this).data('value');
                                    var elem = $('#filterOptionHidden');
                                    elem.val(value);

                                    $(this).closest('form').trigger('submit');
                                    setTimeout(function () {
                                        window.location.href = window.location.href;
                                    }, 500);
                                });

                                // set filter options (un)checked
                                $('#searchDropdown').find('.dropdown-menu').find('a.filter-option').each(function() {
                                    if ($('#filterOptionHidden').val() == $(this).data('value')) {
                                        $(this).find('i').removeClass('icon-radio-unchecked').addClass('icon-radio-checked');
                                    }
                                });

                                setSortDropdownText();
                            });

                            function setSortDropdownText() {
                                var selectedValue = $('#selectComboName_hidden').val();

                                $('#searchDropdown').find('.dropdown-menu').find('a.sort-option').each(function() {
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
                    <!-- END FORM ARTICLES SORT-->
                </h2>

                <div class="tabbable tabs-left">
                    <ul id="subnavi" class="nav nav-tabs">
						<?php foreach ($menu as $key=>$row):?>
							<?php $token = md5($aId.$pId.$row['id']) ?>
                            <li >
                                <a class="btn-catitem btn-catitem" href="<?php if($row['alone'] == 0){echo URI::get_path('product/view/'.$row['id'].'&token='.$token);} else{echo '#';} ?>"  style="padding: 1px 1px;"><br><i class="fa fa-<?=$row['icon']?>" style="font-size: 1em;     float: left;"></i><i style="font-size: 1em; float: left; font-family: Helvetica,Arial,sans-serif; margin-left: 3px;"><?=$row['name']?></i></a>
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
                                            <li>
                                                <a class="btn-subcatitem" href="<?=URI::get_path('product/view/'.$rows['id'].'&token='.$tokens)?>"><?=$rows['name'];?></a>
                                            </li>
										<?php endforeach;?>
                                    </ul>
								<?php endif;?>
                            </li>
						<?php endforeach;?>
                    </ul>


                    <div id="error" class="contrast-box">
                        <div class="dark-grey-box">
                            <h2><i class="icon-info left"></i>Hata : Boş değer girdiniz!</h2>
                            <p>Bir hata oluştu.</p>
                            <div class="btn_wrapper">
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            var genislik = $(window).width();
                            if (genislik < 801) {
                                document.getElementById('error').style.marginLeft = '135px';
                            }
                        });
                    </script>

                </div>
            </div>

            <script type="text/javascript">

                // click on currency dropdown
                $('a[data-selected-currency]').click(function(ev) {
                    ev.preventDefault();

                    var currency = $(this).data('selectedCurrency');
                    if ('' !== currency) {
                        // user has clicked on "currency anzeigen und merken"

                        // hide or show "In der gemerkten Währung gibt es keine Artikel" text
                        $('#category h2.js_currency').hide();
                        $('#category h2[data-currency=' + currency + ']').show();

                        // hide all articles
                        $('#category li.js_currency').hide().removeClass('shown');
                        // show articles of selected currency
                        $('#category li[data-currency*="' + currency + '"]').show().addClass('shown');

                        // hide all quickbuy buttons
                        $('#category li.js_currency > div > div > div.price_desc').hide().removeClass('currency-show');
                        // show quickbuy button of selected currency, remove "Artikel gibt es nicht in der gewünschten Währung" title
                        $('#category li.js_currency > div > div > div.price_desc[data-currency=' + currency + ']').show().addClass('currency-show').find('a').removeAttr('title');

                        // hide all banderoles
                        $('#category li.js_currency > p.item-status').hide().removeClass('currency-show');
                        // show banderole of selected currency
                        $('#category li.js_currency > p.item-status[data-currency=' + currency + ']').show().addClass('currency-show');

                        // change image and text of "Sie haben folgende Währung gewählt: "
                        /*
                         $('p.selected-currency img').attr('src', zs.data.currencies[currency]['image']);
                         $('p.selected-currency img').attr('alt', zs.data.currencies[currency]['loca']);
                         $('p.selected-currency img').attr('title', zs.data.currencies[currency]['loca']);
                         $('p.selected-currency span').text(zs.data.currencies[currency]['loca']);
                         */

                        /*
                         // update currecy icons on header
                         $('#header .currency_status li.selected-currency')
                         .removeClass('selected-currency')
                         .attr('data-toggle', 'popover');
                         $('#header .currency_status li[data-currency=' + currency + ']')
                         .addClass('selected-currency')
                         .attr('data-toggle', '');
                         */

                    } else {
                        // user has clicked on "alle Währungen anzeigen"

                        // hide "In der gemerkten Währung gibt es keine Artikel" text
                        $('h2.js_currency').hide();

                        // show all articles
                        $('li.js_currency').show().addClass('shown');

                        // remove all "Artikel gibt es nicht in der gewünschten Währung" titles
                        $('li.js_currency > div > div > div.price_desc > a').removeAttr('title');
                        // hide all quickbuy buttons
                        $('li.js_currency > div > div > div.price_desc').hide();

                        // hide all banderoles
                        $('li.js_currency > p.item-status').hide();

                        // show the last selected currency banderole and quickbuy button if it exists,
                        // the default currency banderole and quickbuy button otherwise
                        $('li.js_currency').each(function(i,li) {
                            if ($(li).find('div.price_desc.currency-show').size() > 0) {
                                $(li).find('.currency-show').show();
                            }
                            else {
                                $(li).find('.js_currency_default').show();
                                $(li).find('div.price_desc.js_currency_default > a').attr('title', "Bu eşya seçilen birimde mevcut değil.");
                            }
                        });
                    }

                    // recalculate article card margins
                    cardMargin();

                    // replace dropdown text with selected text
                    $('#currencydropdown span:first').html($(this).html());

                    // recalculate amount of shown vs. total article count
                    // for breadcrumb
                    var breadcrumbtext = zs.data.categoryArticleCount.total;
                    var shownarticles = $('#category .card li.span4.shown').size();
                    if (shownarticles != breadcrumbtext) {
                        breadcrumbtext = '(' + shownarticles + '/' + breadcrumbtext + ')';
                    } else {
                        breadcrumbtext = '(' + breadcrumbtext + ')';
                    }
                    $('ul.breadcrumb li:last .item_count').text(breadcrumbtext);

                    // and for every subcategory
                    var subcategorytext = 0;
                    $(zs.data.subcategoryIds).each(function(i,id) {
                        subcategorytext = zs.data.categoryArticleCount[id];
                        shownarticles = $('#ul_sub_' + id + ' li.span4.shown').size();
                        if (shownarticles != subcategorytext) {
                            subcategorytext = '(' + shownarticles + '/' + subcategorytext + ')';
                        }
                        else {
                            subcategorytext = '(' + subcategorytext + ')';
                        }
                        $('#h3_sub_' + id + ' .item_count').text(subcategorytext);
                    });
                });


                $('.article-limit-counter').each(function(){
                    var elem = $(this),
                        seconds = elem.data('seconds');

                    elem.countdown({
                        until: seconds,
                        format: 'dHMS',
                        compact: true,
                        onExpiry: function() {
                            window.location.href = window.location.href;
                        }
                    });
                });

                // load the article images
                window.onload = function() {
                    var images = document.querySelectorAll('img.lazy-loading[lazy-src]');

                    if (images && images.length > 0) {
                        for (var i = 0, len = images.length; i < len; i = i+1) {
                            var img = images[i];
                            img.setAttribute('src', img.getAttribute('lazy-src'));

                            // debug lazy loaded images
                            //img.style.border = '2px solid #FF0A5B';
                        }
                    }
                };

            </script>
        </div>
	<?php elseif ($message == '404'):?>
        <div class="content clearfix" id="wt_refpoint">
            <div id="category">

                <h2>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#" title="En gözdeler">Arama Sonuçları</a>
                            <span class="item_count">(0)</span>
                        </li>
                    </ul>

                    <!-- BEGIN FORM ARTICLES SORT -->
                    <div class="drop-sort-by">

                        <form method="post" id="formArticlesSort" action="https://tr-shop-metin2.gameforge.com:443/category/display?__token=73c7ba03430518b6489e30f1e32c27f6">
                            <label> Sırala:</label>
                            <div id="searchDropdown" class="dropdown">

                                <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                    <span class="buttonText">İlgiye göre</span>
                                    <span class="btn-default"><span class="caret"></span></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header"><i class="icon-loop3"></i>Sırala</li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="standardArticleSort">
                                            İlgiye göre                            </a>
                                    </li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="upNameArticleSort">
                                            İsim (artan)                            </a>
                                    </li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="downNameArticleSort">
                                            İsim (azalan)                            </a>
                                    </li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="upPriceArticleSort">
                                            Fiyat (artan)                            </a>
                                    </li>
                                    <li>
                                        <a class="sort-option" href="javascript:void(0);" data-value="downPriceArticleSort">
                                            Fiyat (azalan)                            </a>
                                    </li>



                                </ul>
                            </div>
                            <input
                                    type="hidden"
                                    name="selectComboName"
                                    id="selectComboName_hidden"
                                    value="standardArticleSort"
                            >
                            <input type="hidden" name="filterOption" id="filterOptionHidden" value="">
                        </form>

                        <script type="text/javascript">
                            $(document).ready(function(){
                                // set selected sort option active
                                var sortValue = 'standardArticleSort';
                                $('#searchDropdown').find('.dropdown-menu a.sort-option[data-value=' + sortValue + ']').addClass('active');

                                // click event on sort options: reload
                                $('#searchDropdown .dropdown-toggle').dropdown();
                                $('#searchDropdown').find('.dropdown-menu').find('a.sort-option').click(function () {
                                    sortArticlesBy($(this).data('value'));

                                    $('li.list-item.last-in-line').each(function() {
                                        $(this).removeClass('last-in-line');
                                    });

                                    cardMargin();

                                    var anchor = $(this);

                                    // toggle active-class
                                    anchor.parents('#searchDropdown').find('.active').each(function() {
                                        $(this).removeClass('active');
                                    });

                                    anchor.addClass('active');

                                    // show sort text in button
                                    anchor.parents('#searchDropdown').find('.buttonText').text(anchor.text().trim());
                                });

                                // click event on filter options: reload
                                $('#searchDropdown').find('.dropdown-menu').find('a.filter-option').click(function () {
                                    var value = $(this).data('value');
                                    var elem = $('#filterOptionHidden');
                                    elem.val(value);

                                    $(this).closest('form').trigger('submit');
                                    setTimeout(function () {
                                        window.location.href = window.location.href;
                                    }, 500);
                                });

                                // set filter options (un)checked
                                $('#searchDropdown').find('.dropdown-menu').find('a.filter-option').each(function() {
                                    if ($('#filterOptionHidden').val() == $(this).data('value')) {
                                        $(this).find('i').removeClass('icon-radio-unchecked').addClass('icon-radio-checked');
                                    }
                                });

                                setSortDropdownText();
                            });

                            function setSortDropdownText() {
                                var selectedValue = $('#selectComboName_hidden').val();

                                $('#searchDropdown').find('.dropdown-menu').find('a.sort-option').each(function() {
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
                    <!-- END FORM ARTICLES SORT-->
                </h2>

                <div class="tabbable tabs-left">
                    <ul id="subnavi" class="nav nav-tabs">
						<?php foreach ($menu as $key=>$row):?>
							<?php $token = md5($aId.$pId.$row['id']) ?>
                            <li >
                                <a class="btn-catitem btn-catitem" href="<?php if($row['alone'] == 0){echo URI::get_path('product/view/'.$row['id'].'&token='.$token);} else{echo '#';} ?>"  style="padding: 1px 1px;"><br><i class="fa fa-<?=$row['icon']?>" style="font-size: 1em;     float: left;"></i><i style="font-size: 1em; float: left; font-family: Helvetica,Arial,sans-serif; margin-left: 3px;"><?=$row['name']?></i></a>
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
                                            <li>
                                                <a class="btn-subcatitem" href="<?=URI::get_path('product/view/'.$rows['id'].'&token='.$tokens)?>"><?=$rows['name'];?></a>
                                            </li>
										<?php endforeach;?>
                                    </ul>
								<?php endif;?>
                            </li>
						<?php endforeach;?>
                    </ul>


                    <div id="error" class="contrast-box">
                        <div class="dark-grey-box">
                            <h2><i class="icon-info left"></i>Hata : Aradığınız eşya bulunamadı !</h2>
                            <p>Bir hata oluştu.</p>
                            <div class="btn_wrapper">
                            </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            var genislik = $(window).width();
                            if (genislik < 801) {
                                document.getElementById('error').style.marginLeft = '135px';
                            }
                        });
                    </script>

                </div>
            </div>

            <script type="text/javascript">

                // click on currency dropdown
                $('a[data-selected-currency]').click(function(ev) {
                    ev.preventDefault();

                    var currency = $(this).data('selectedCurrency');
                    if ('' !== currency) {
                        // user has clicked on "currency anzeigen und merken"

                        // hide or show "In der gemerkten Währung gibt es keine Artikel" text
                        $('#category h2.js_currency').hide();
                        $('#category h2[data-currency=' + currency + ']').show();

                        // hide all articles
                        $('#category li.js_currency').hide().removeClass('shown');
                        // show articles of selected currency
                        $('#category li[data-currency*="' + currency + '"]').show().addClass('shown');

                        // hide all quickbuy buttons
                        $('#category li.js_currency > div > div > div.price_desc').hide().removeClass('currency-show');
                        // show quickbuy button of selected currency, remove "Artikel gibt es nicht in der gewünschten Währung" title
                        $('#category li.js_currency > div > div > div.price_desc[data-currency=' + currency + ']').show().addClass('currency-show').find('a').removeAttr('title');

                        // hide all banderoles
                        $('#category li.js_currency > p.item-status').hide().removeClass('currency-show');
                        // show banderole of selected currency
                        $('#category li.js_currency > p.item-status[data-currency=' + currency + ']').show().addClass('currency-show');

                        // change image and text of "Sie haben folgende Währung gewählt: "
                        /*
                         $('p.selected-currency img').attr('src', zs.data.currencies[currency]['image']);
                         $('p.selected-currency img').attr('alt', zs.data.currencies[currency]['loca']);
                         $('p.selected-currency img').attr('title', zs.data.currencies[currency]['loca']);
                         $('p.selected-currency span').text(zs.data.currencies[currency]['loca']);
                         */

                        /*
                         // update currecy icons on header
                         $('#header .currency_status li.selected-currency')
                         .removeClass('selected-currency')
                         .attr('data-toggle', 'popover');
                         $('#header .currency_status li[data-currency=' + currency + ']')
                         .addClass('selected-currency')
                         .attr('data-toggle', '');
                         */

                    } else {
                        // user has clicked on "alle Währungen anzeigen"

                        // hide "In der gemerkten Währung gibt es keine Artikel" text
                        $('h2.js_currency').hide();

                        // show all articles
                        $('li.js_currency').show().addClass('shown');

                        // remove all "Artikel gibt es nicht in der gewünschten Währung" titles
                        $('li.js_currency > div > div > div.price_desc > a').removeAttr('title');
                        // hide all quickbuy buttons
                        $('li.js_currency > div > div > div.price_desc').hide();

                        // hide all banderoles
                        $('li.js_currency > p.item-status').hide();

                        // show the last selected currency banderole and quickbuy button if it exists,
                        // the default currency banderole and quickbuy button otherwise
                        $('li.js_currency').each(function(i,li) {
                            if ($(li).find('div.price_desc.currency-show').size() > 0) {
                                $(li).find('.currency-show').show();
                            }
                            else {
                                $(li).find('.js_currency_default').show();
                                $(li).find('div.price_desc.js_currency_default > a').attr('title', "Bu eşya seçilen birimde mevcut değil.");
                            }
                        });
                    }

                    // recalculate article card margins
                    cardMargin();

                    // replace dropdown text with selected text
                    $('#currencydropdown span:first').html($(this).html());

                    // recalculate amount of shown vs. total article count
                    // for breadcrumb
                    var breadcrumbtext = zs.data.categoryArticleCount.total;
                    var shownarticles = $('#category .card li.span4.shown').size();
                    if (shownarticles != breadcrumbtext) {
                        breadcrumbtext = '(' + shownarticles + '/' + breadcrumbtext + ')';
                    } else {
                        breadcrumbtext = '(' + breadcrumbtext + ')';
                    }
                    $('ul.breadcrumb li:last .item_count').text(breadcrumbtext);

                    // and for every subcategory
                    var subcategorytext = 0;
                    $(zs.data.subcategoryIds).each(function(i,id) {
                        subcategorytext = zs.data.categoryArticleCount[id];
                        shownarticles = $('#ul_sub_' + id + ' li.span4.shown').size();
                        if (shownarticles != subcategorytext) {
                            subcategorytext = '(' + shownarticles + '/' + subcategorytext + ')';
                        }
                        else {
                            subcategorytext = '(' + subcategorytext + ')';
                        }
                        $('#h3_sub_' + id + ' .item_count').text(subcategorytext);
                    });
                });


                $('.article-limit-counter').each(function(){
                    var elem = $(this),
                        seconds = elem.data('seconds');

                    elem.countdown({
                        until: seconds,
                        format: 'dHMS',
                        compact: true,
                        onExpiry: function() {
                            window.location.href = window.location.href;
                        }
                    });
                });

                // load the article images
                window.onload = function() {
                    var images = document.querySelectorAll('img.lazy-loading[lazy-src]');

                    if (images && images.length > 0) {
                        for (var i = 0, len = images.length; i < len; i = i+1) {
                            var img = images[i];
                            img.setAttribute('src', img.getAttribute('lazy-src'));

                            // debug lazy loaded images
                            //img.style.border = '2px solid #FF0A5B';
                        }
                    }
                };

            </script>

        </div>
	<?php endif;?>
<?php elseif ($result == true):?>
    <div class="content clearfix" id="wt_refpoint">
        <div id="category">

            <h2>
                <ul class="breadcrumb">
                    <li>
                        <a href="#" title="En gözdeler">Arama Sonuçları</a>
                        <span class="item_count">(<?=$count?>)</span>
                    </li>
                </ul>

                <!-- BEGIN FORM ARTICLES SORT -->
                <div class="drop-sort-by">

                    <form method="post" id="formArticlesSort" action="https://tr-shop-metin2.gameforge.com:443/category/display?__token=73c7ba03430518b6489e30f1e32c27f6">
                        <label> Sırala:</label>
                        <div id="searchDropdown" class="dropdown">

                            <button class="dropdown-toggle" type="button" data-toggle="dropdown">
                                <span class="buttonText">İlgiye göre</span>
                                <span class="btn-default"><span class="caret"></span></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"><i class="icon-loop3"></i>Sırala</li>
                                <li>
                                    <a class="sort-option" href="javascript:void(0);" data-value="standardArticleSort">
                                        İlgiye göre                            </a>
                                </li>
                                <li>
                                    <a class="sort-option" href="javascript:void(0);" data-value="upNameArticleSort">
                                        İsim (artan)                            </a>
                                </li>
                                <li>
                                    <a class="sort-option" href="javascript:void(0);" data-value="downNameArticleSort">
                                        İsim (azalan)                            </a>
                                </li>
                                <li>
                                    <a class="sort-option" href="javascript:void(0);" data-value="upPriceArticleSort">
                                        Fiyat (artan)                            </a>
                                </li>
                                <li>
                                    <a class="sort-option" href="javascript:void(0);" data-value="downPriceArticleSort">
                                        Fiyat (azalan)                            </a>
                                </li>



                            </ul>
                        </div>
                        <input
                                type="hidden"
                                name="selectComboName"
                                id="selectComboName_hidden"
                                value="standardArticleSort"
                        >
                        <input type="hidden" name="filterOption" id="filterOptionHidden" value="">
                    </form>

                    <script type="text/javascript">
                        $(document).ready(function(){
                            // set selected sort option active
                            var sortValue = 'standardArticleSort';
                            $('#searchDropdown').find('.dropdown-menu a.sort-option[data-value=' + sortValue + ']').addClass('active');

                            // click event on sort options: reload
                            $('#searchDropdown .dropdown-toggle').dropdown();
                            $('#searchDropdown').find('.dropdown-menu').find('a.sort-option').click(function () {
                                sortArticlesBy($(this).data('value'));

                                $('li.list-item.last-in-line').each(function() {
                                    $(this).removeClass('last-in-line');
                                });

                                cardMargin();

                                var anchor = $(this);

                                // toggle active-class
                                anchor.parents('#searchDropdown').find('.active').each(function() {
                                    $(this).removeClass('active');
                                });

                                anchor.addClass('active');

                                // show sort text in button
                                anchor.parents('#searchDropdown').find('.buttonText').text(anchor.text().trim());
                            });

                            // click event on filter options: reload
                            $('#searchDropdown').find('.dropdown-menu').find('a.filter-option').click(function () {
                                var value = $(this).data('value');
                                var elem = $('#filterOptionHidden');
                                elem.val(value);

                                $(this).closest('form').trigger('submit');
                                setTimeout(function () {
                                    window.location.href = window.location.href;
                                }, 500);
                            });

                            // set filter options (un)checked
                            $('#searchDropdown').find('.dropdown-menu').find('a.filter-option').each(function() {
                                if ($('#filterOptionHidden').val() == $(this).data('value')) {
                                    $(this).find('i').removeClass('icon-radio-unchecked').addClass('icon-radio-checked');
                                }
                            });

                            setSortDropdownText();
                        });

                        function setSortDropdownText() {
                            var selectedValue = $('#selectComboName_hidden').val();

                            $('#searchDropdown').find('.dropdown-menu').find('a.sort-option').each(function() {
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
                <!-- END FORM ARTICLES SORT-->
            </h2>

            <div class="tabbable tabs-left">
                <ul id="subnavi" class="nav nav-tabs">
					<?php foreach ($menu as $key=>$row):?>
						<?php $token = md5($aId.$pId.$row['id']) ?>
                        <li class="has-subnavi" >
                            <a class="btn-catitem
                            <?php if ($key == 0){echo 'btn-catitem-active';}else{echo 'long';}?>
                            " href="<?php if($row['alone'] == 0){echo URI::get_path('product/view/'.$row['id'].'&token='.$token);} else{echo URI::get_path('product/views/'.$row['id'].'&token='.$token);} ?>">
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
                                            <a class="btn-catitem btn-catitem-active" href="<?=URI::get_path('product/view/'.$rows['id'].'&token='.$tokens)?>"><?=$rows['name'];?></a>
                                        </li>
									<?php endforeach;?>
                                </ul>
							<?php endif;?>
                        </li>
					<?php endforeach;?>
                </ul>
                <div class="tab-content">

                    <div class="scrollable_container row-fluid">
                        <ul class="item-list card clearfix">
							<?php foreach ($items as $key=>$row):?>
                                <li class="list-item   shown js_currency   quickbuy" data-currency="1" data-sort-price="<?=$row['coins']?>"
                                    data-sort-name="<?=$row['item_name']?>" data-sort-sort="0">
                                    <div class="contrast-box  item-box inner-content clearfix">
                                        <div class="desc row-fluid">
                                            <div class="item-description">
												<?php if($row['item_time'] == 1):?>
													<?php $time = $row['socket0'];
													$day = $time / (60 * 60 * 24) ;
													?>
                                                    <p class="item-status   js_currency_default" data-currency="1">
                                                        <i class="zicon-hd-time-real ttip" tooltip-content="Süre: <?=$day?> gün"></i>
                                                    </p>
												<?php endif;?>
                                                <h4>
                                                    <a class="fancybox fancybox.ajax card-heading" href="#" title="<?=$row['item_name']?>"><?=$row['item_name']?></a>
                                                </h4>
                                                <div id="scrollTo03705" class="item-shortdesc clearfix">
                                                    <a class="item-thumb fancybox fancybox.ajax" href="#" title="" style="    background: transparent url(<?=URI::public_path()?>images/item-bg.png) no-repeat 0 0;
                                                            background-size: cover;
                                                            width: 98px;
                                                            height: 98px;
                                                            position: relative;">
                                                        <img class="item-thumb" src="<?=URL.$row['item_image']?>" alt="<?=$row['item_name']?>" style="    position: absolute;
    padding: 0;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
    transform: rotate(0);
    transition: all 0.2s linear;">
                                                    </a>
                                                    <span class="category-link"></span>
													<?=$row['description']?>
                                                </div>
                                            </div>
                                            <!-- Buttons -->
                                            <div class="price_desc row-fluid    js_currency_default" data-currency="1">
												<?php
												$tokenI = md5($aId.$row['item_id'].$row['vnum'].$tokenKey);
												?>
												<?php if ($row['durum'] == 3):?>
                                                    <button class="btn-default fancybox fancybox.ajax " href="<?=URI::get_path('product/ajaxem/'.$row['item_id'].'&token='.$tokenI)?>">Ayrıntılar &raquo;</button>
                                                    <p class="span5 price">
                                                        <span class="price-label">Fiyat:</span>
                                                        <span class="block-price">
                                                        <img class="ttip" src="<?=URI::public_path('images/em_coins.png')?>" alt="Ejderha Markası" tooltip-content="Ejderha Markası"/>
                                                            <span class="end-price"><?=$row['coins']?></span>
                                                    </span>
                                                    </p>
                                                    <button class="span5 btn-price">
                                                <span class="block-price">
                                                    <img class="ttip" tooltip-content="Ejderha Parası" src="<?=URI::public_path('images/em_coins.png')?>" alt="Ejderha Parası"/>
                                                        <span class="end-price"><?=$row['coins']?></span>
                                                </span>
                                                    </button>
                                                    <button class="span5 btn-buy fancybox fancybox.ajax" href="<?=URI::get_path('product/ajax/'.$row['item_id'].'&token='.$tokenI)?>">Satın al</button>
												<?php elseif ($row['durum'] == 1 || $row['durum'] == 2):?>
                                                    <button class="btn-default fancybox fancybox.ajax " href="<?=URI::get_path('product/ajax/'.$row['item_id'].'&token='.$tokenI)?>">Ayrıntılar &raquo;</button>
                                                    <p class="span5 price">
                                                        <span class="price-label">Fiyat:</span>
                                                        <span class="block-price">
                                                        <img class="ttip" src="<?=URI::public_path('images/coins.png')?>" alt="Ejderha Parası" tooltip-content="Ejderha Parası"/>
                                                            <span class="end-price"><?=$row['coins']?></span>
                                                    </span>
                                                    </p>
                                                    <button class="span5 btn-price">
                                                <span class="block-price">
                                                    <img class="ttip" tooltip-content="Ejderha Parası" src="<?=URI::public_path('images/coins.png')?>" alt="Ejderha Parası"/>
                                                        <span class="end-price"><?=$row['coins']?></span>
                                                </span>
                                                    </button>
                                                    <button class="span5 btn-buy fancybox fancybox.ajax" href="<?=URI::get_path('product/ajax/'.$row['item_id'].'&token='.$tokenI)?>">Satın al</button>
												<?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
							<?php endforeach;?>
                        </ul>
                        <script type="text/javascript">
                            var zs = zs || {}; // global zshop object
                            zs.data = zs.data || {};
                            zs.data.categoryId = '18645';
                            zs.data.subcategoryIds = ['18650','22980'];
                            zs.data.categoryArticleCount = {
                                '18645': 8                                                      , '18650': 17                                              , '22980': 3                            , 'total': 28    };
                        </script>
                        <script type="text/javascript">

                            function scrollBottom() {
//						var $nextHiddenItem = $('ul.item-list li.hidden').first();
//
//						if ($nextHiddenItem.length <= 0)  {
//							$('ul.item-list li.loading').hide();
//							return;
//						}
//
//						$nextHiddenItem.removeClass('hidden');
//						$nextHiddenItem.nextAll().each(function (i, item) {
//							if (i < 11) {
//								$(item).removeClass('hidden');
//							}
//						});
                                customScroll();
                            }
                        </script>

                        <br class="clearfloat">
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">

            // click on currency dropdown
            $('a[data-selected-currency]').click(function(ev) {
                ev.preventDefault();

                var currency = $(this).data('selectedCurrency');
                if ('' !== currency) {
                    // user has clicked on "currency anzeigen und merken"

                    // hide or show "In der gemerkten Währung gibt es keine Artikel" text
                    $('#category h2.js_currency').hide();
                    $('#category h2[data-currency=' + currency + ']').show();

                    // hide all articles
                    $('#category li.js_currency').hide().removeClass('shown');
                    // show articles of selected currency
                    $('#category li[data-currency*="' + currency + '"]').show().addClass('shown');

                    // hide all quickbuy buttons
                    $('#category li.js_currency > div > div > div.price_desc').hide().removeClass('currency-show');
                    // show quickbuy button of selected currency, remove "Artikel gibt es nicht in der gewünschten Währung" title
                    $('#category li.js_currency > div > div > div.price_desc[data-currency=' + currency + ']').show().addClass('currency-show').find('a').removeAttr('title');

                    // hide all banderoles
                    $('#category li.js_currency > p.item-status').hide().removeClass('currency-show');
                    // show banderole of selected currency
                    $('#category li.js_currency > p.item-status[data-currency=' + currency + ']').show().addClass('currency-show');

                    // change image and text of "Sie haben folgende Währung gewählt: "
                    /*
                     $('p.selected-currency img').attr('src', zs.data.currencies[currency]['image']);
                     $('p.selected-currency img').attr('alt', zs.data.currencies[currency]['loca']);
                     $('p.selected-currency img').attr('title', zs.data.currencies[currency]['loca']);
                     $('p.selected-currency span').text(zs.data.currencies[currency]['loca']);
                     */

                    /*
                     // update currecy icons on header
                     $('#header .currency_status li.selected-currency')
                     .removeClass('selected-currency')
                     .attr('data-toggle', 'popover');
                     $('#header .currency_status li[data-currency=' + currency + ']')
                     .addClass('selected-currency')
                     .attr('data-toggle', '');
                     */

                } else {
                    // user has clicked on "alle Währungen anzeigen"

                    // hide "In der gemerkten Währung gibt es keine Artikel" text
                    $('h2.js_currency').hide();

                    // show all articles
                    $('li.js_currency').show().addClass('shown');

                    // remove all "Artikel gibt es nicht in der gewünschten Währung" titles
                    $('li.js_currency > div > div > div.price_desc > a').removeAttr('title');
                    // hide all quickbuy buttons
                    $('li.js_currency > div > div > div.price_desc').hide();

                    // hide all banderoles
                    $('li.js_currency > p.item-status').hide();

                    // show the last selected currency banderole and quickbuy button if it exists,
                    // the default currency banderole and quickbuy button otherwise
                    $('li.js_currency').each(function(i,li) {
                        if ($(li).find('div.price_desc.currency-show').size() > 0) {
                            $(li).find('.currency-show').show();
                        }
                        else {
                            $(li).find('.js_currency_default').show();
                            $(li).find('div.price_desc.js_currency_default > a').attr('title', "Bu eşya seçilen birimde mevcut değil.");
                        }
                    });
                }

                // recalculate article card margins
                cardMargin();

                // replace dropdown text with selected text
                $('#currencydropdown span:first').html($(this).html());

                // recalculate amount of shown vs. total article count
                // for breadcrumb
                var breadcrumbtext = zs.data.categoryArticleCount.total;
                var shownarticles = $('#category .card li.span4.shown').size();
                if (shownarticles != breadcrumbtext) {
                    breadcrumbtext = '(' + shownarticles + '/' + breadcrumbtext + ')';
                } else {
                    breadcrumbtext = '(' + breadcrumbtext + ')';
                }
                $('ul.breadcrumb li:last .item_count').text(breadcrumbtext);

                // and for every subcategory
                var subcategorytext = 0;
                $(zs.data.subcategoryIds).each(function(i,id) {
                    subcategorytext = zs.data.categoryArticleCount[id];
                    shownarticles = $('#ul_sub_' + id + ' li.span4.shown').size();
                    if (shownarticles != subcategorytext) {
                        subcategorytext = '(' + shownarticles + '/' + subcategorytext + ')';
                    }
                    else {
                        subcategorytext = '(' + subcategorytext + ')';
                    }
                    $('#h3_sub_' + id + ' .item_count').text(subcategorytext);
                });
            });


            $('.article-limit-counter').each(function(){
                var elem = $(this),
                    seconds = elem.data('seconds');

                elem.countdown({
                    until: seconds,
                    format: 'dHMS',
                    compact: true,
                    onExpiry: function() {
                        window.location.href = window.location.href;
                    }
                });
            });

            // load the article images
            window.onload = function() {
                var images = document.querySelectorAll('img.lazy-loading[lazy-src]');

                if (images && images.length > 0) {
                    for (var i = 0, len = images.length; i < len; i = i+1) {
                        var img = images[i];
                        img.setAttribute('src', img.getAttribute('lazy-src'));

                        // debug lazy loaded images
                        //img.style.border = '2px solid #FF0A5B';
                    }
                }
            };

        </script>

    </div>
<?php endif;?>