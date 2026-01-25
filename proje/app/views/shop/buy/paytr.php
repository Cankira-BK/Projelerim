<link rel="stylesheet" href="https://super.paywant.com/tema/remodal/jquery.remodal.css?v=1">
<script type="text/javascript" src="https://super.paywant.com/tema/remodal/jquery.remodal.js"></script>


<div class="content clearfix" id="wt_refpoint">
    <div id="category">

        <h2>
            <ul class="breadcrumb">
                <li>
                    <a href="#" title="En gözdeler">PayTR Ödeme Yöntemi</a>
                </li>
            </ul>
        </h2>

        <div class="tabbable tabs-left">
            <ul id="subnavi" class="nav nav-tabs">
				<?php if (\StaticDatabase\StaticDatabase::settings('paywant_status')):?>
                    <li class="has-subnavi2">
                        <a class="btn-catitem-active" href="<?=URI::get_path('buy/paywant')?>">
                            <img style="width: 82px;" src="<?=URI::public_path('images/paywant.png')?>" class="icon"></a>
                    </li>
				<?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('sanalpay_status')):?>
                    <li class="has-subnavi2">
                        <a class="btn-catitem-active" href="<?=URI::get_path('buy/sanalpay')?>">
                            <img style="width: 82px;" src="<?=URI::public_path('images/sanalpay.png')?>" class="icon"></a>
                    </li>
				<?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('kasagame_status')):?>
                    <li class="has-subnavi2">
                        <a class="btn-catitem-active" href="<?=URI::get_path('buy/kasagame')?>">
                            <img style="width: 70px;" src="<?=URI::public_path('images/kasagame.png')?>" class="icon"></a>
                    </li>
				<?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('payreks_status')):?>
					<li class="has-subnavi2">
						<a class="btn-catitem-active" href="<?=URI::get_path('buy/payreks')?>">
							<img style="width: 82px;" src="<?=URI::public_path('images/payreks.png')?>" class="icon"></a>
					</li>
				<?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('itemci_status')):?>
                    <li class="has-subnavi2" id="itemci">
                        <a class="btn-catitem-active" href="<?=\StaticDatabase\StaticDatabase::settings('itemci_link')?>" target="_blank">
                            <img style="width: 78px;" src="<?=URI::public_path('images/itemci.png')?>" class="icon"></a>
                    </li>
				<?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('oyunalisverisi_status')):?>
                    <li class="has-subnavi2" id="oyunalisveris">
                        <a class="btn-catitem-active" href="<?=\StaticDatabase\StaticDatabase::settings('oyunalisverisi_link')?>" target="_blank">
                            <img style="width: 78px;" src="<?=URI::public_path('images/oyunalisveris_logo.png')?>" class="icon"></a>
                    </li>
				<?php endif;?>
				<?php if (\StaticDatabase\StaticDatabase::settings('itemsultan_status')):?>
                    <li class="has-subnavi2" id="itemsultan">
                        <a class="btn-catitem-active" href="<?=\StaticDatabase\StaticDatabase::settings('itemsultan_link')?>" target="_blank">
                            <img style="width: 78px;" src="<?=URI::public_path('images/itemsultan.png')?>" class="icon"></a>
                    </li>
				<?php endif;?>
                <script>
                    $(document).ready(function () {
                        var genislik = $(window).width();
                        if (genislik < 801) {
                            document.getElementById('itemci').style.display = 'none';
                        }
                    });
                </script>
            </ul>
            <div class="tab-content">

                <div class="scrollable_container row-fluid">
                    <!--CONTENT BURAYA-->
                    <img src="<?=URI::public_path('images/paywant-header.png')?>" alt="" style="width: 75%;margin-left: auto;margin-right: auto;display: block;">

                    <div class="paywant animated infinite pulse" align="center" style="margin-top: 50px;"><a href='paytr#PayTrModal' ><img style="margin-left:-7px"src="https://i.hizliresim.com/grl0dQ.jpg" border="0"/></a></div>

                    <div class="remodal" data-remodal-id="PayTrModal">
                        <div class="login-body">
                                            <?php
												if($_SESSION["aId"] != "")
												{
													$loginBul = $_SESSION["aId"];
													$user = $_SESSION["cLogin"];
													$sorgu = \StaticGame\StaticGame::sql("SELECT * FROM account WHERE id = ?",[$loginBul]);
													if(count($sorgu) > 0 )
													{
														$merchant_id 	= \StaticDatabase\StaticDatabase::settings('paytr_id');
														$merchant_key 	= \StaticDatabase\StaticDatabase::settings('paytr_key');
														$merchant_salt	= \StaticDatabase\StaticDatabase::settings('paytr_salt');
														$hesapBilgisi	= $sorgu[0];
														
														function getIPAdresi()	{
															if(getenv("HTTP_CLIENT_IP"))
																$ip = getenv("HTTP_CLIENT_IP");
															else if(getenv("HTTP_X_FORWARDED_FOR")){
																$ip = getenv("HTTP_X_FORWARDED_FOR");
																if (strstr($ip, ',')){
																	$tmp = explode (',', $ip); $ip = trim($tmp[0]);
																}}
															else
																$ip = getenv("REMOTE_ADDR");
															return $ip;
														}

														$email = $hesapBilgisi['email'];
														$payment_amount	= 50;
														$user_address = $hesapBilgisi['phone1'];
														$user_phone = $hesapBilgisi['phone1'];
														$merchant_ok_url = URL.SHOP.'/buy/paytr_notify/'.\StaticDatabase\StaticDatabase::settings('paytr_id');
														$merchant_fail_url = URL.SHOP.'/buy/paytr_notify/'.\StaticDatabase\StaticDatabase::settings('paytr_id');
														$user_basket = "EP";
														$user_ip=getIPAdresi();
														$timeout_limit = "30";
														$debug_on = 1;
														$test_mode = 0;

														$no_installment	= 0;
														$max_installment = 0;

														$currency = "TL";
														$hash_str = $merchant_id .$user_ip .$loginBul .$email .$payment_amount .$user_basket.$no_installment.$max_installment.$currency.$test_mode;
														$paytr_token=base64_encode(hash_hmac('sha256',$hash_str.$merchant_salt,$merchant_key,true));
														$post_vals=array(
																'merchant_id'=>$merchant_id,
																'user_ip'=>$user_ip,
																'merchant_oid'=>$loginBul,
																'email'=>$email,
																'payment_amount'=>$payment_amount,
																'paytr_token'=>$paytr_token,
																'user_basket'=>$user_basket,
																'debug_on'=>$debug_on,
																'no_installment'=>$no_installment,
																'max_installment'=>$max_installment,
																'user_name'=>$user,
																'user_address'=>$user_address,
																'user_phone'=>$user_phone,
																'merchant_ok_url'=>$merchant_ok_url,
																'merchant_fail_url'=>$merchant_fail_url,
																'timeout_limit'=>$timeout_limit,
																'currency'=>$currency,
																'test_mode'=>$test_mode
															);
														
														$ch=curl_init();
														curl_setopt($ch, CURLOPT_URL, "https://www.paytr.com/odeme/api/get-token");
														curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
														curl_setopt($ch, CURLOPT_POST, 1) ;
														curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
														curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
														curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
														curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
														curl_setopt($ch, CURLOPT_TIMEOUT, 20);
														$result = @curl_exec($ch);

														if(curl_errno($ch))
															echo("PAYTR IFRAME connection error. err:".curl_error($ch));

														curl_close($ch);
														
														$result=json_decode($result,1);
															
														if($result['status']=='success')
															echo '<iframe seamless="seamless" id="payTrFrame" style="display:block; width:800px; height:570px;" frameborder="0" scrolling="yes" src="https://www.paytr.com/odeme/guvenli/'.$result["token"].'" id="odemeFrame"></iframe>';
														else
															echo("PAYTR IFRAME failed. reason:".$result['reason']);
													}else{echo "Bu alanı sadece giriş yapmış kullanıcılarımız görebilir.";}
												}else{echo "Bu alanı sadece giriş yapmış kullanıcılarımız görebilir.";}
											?>

                                            <script type="text/javascript">
                                                (function (wd, doc) {
                                                    var w = wd.innerWidth || doc.documentElement.clientWidth;
                                                    var h = wd.innerHeight || doc.documentElement.clientHeight;
                                                    var screenSize = {w: w, h: h};
                                                    if (screenSize.w > 0 && screenSize.w < 801) {
                                                        document.getElementById('payTrFrame').style.width = '650px';
                                                    }
                                                })(window, document);
                                            </script>
                        </div>
                    </div>
                    <br class="clearfloat">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        // click on currency dropdown
        $('a[data-selected-currency]').click(function (ev) {
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
                $('li.js_currency').each(function (i, li) {
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
            $(zs.data.subcategoryIds).each(function (i, id) {
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


        $('.article-limit-counter').each(function () {
            var elem = $(this),
                seconds = elem.data('seconds');

            elem.countdown({
                until: seconds,
                format: 'dHMS',
                compact: true,
                onExpiry: function () {
                    window.location.href = window.location.href;
                }
            });
        });

        // load the article images
        window.onload = function () {
            var images = document.querySelectorAll('img.lazy-loading[lazy-src]');

            if (images && images.length > 0) {
                for (var i = 0, len = images.length; i < len; i = i + 1) {
                    var img = images[i];
                    img.setAttribute('src', img.getAttribute('lazy-src'));

                    // debug lazy loaded images
                    //img.style.border = '2px solid #FF0A5B';
                }
            }
        };

    </script>
</div>