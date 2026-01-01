<?php $result = $this->all['result'];?>
<div id="notEnoughCash" class="contrast-box sys-message">
	<?php if ($result == 'false'): ?>
		<?php if ($this->all['message'] == 'coins'): ?>
		<div class="dark-grey-box clearfix">
			<div class="clearfix">
				<div class="item-showcase   span2">
					<div id="image" class="picture_wrapper ">
						<img class="item-thumb" src="<?= URL . $this->all['data'][2] ?>" width="98" height="98" alt=""/>
					</div>
				</div>
				<div class="money-showcase  span5 ">
					<h2>Ejderha Parası yetersiz mi?</h2>
					<div class="currency_status_box" style="float: left; margin-right: 5%;">
						<p>Şu anki hesap durumum:</p>
						<ul class="currency_status clearfix">
							<li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Parası" src="<?= URI::public_path('images/coins.png') ?>" width="16" height="16" alt="Ejderha Parası"/>
                                    <span class="end-price" data-currency="<?= $this->all['data'][1] ?>"><?= $this->all['data'][1] ?></span>
                                </span>
							</li>
						</ul>
					</div>
					<div class="currency_status_box">
						<p>Gerekli ejderha parası miktarı:</p>
						<ul class="currency_status clearfix">
							<li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Parası" src="<?= URI::public_path('images/coins.png') ?>" width="16" height="16" alt="Ejderha Parası"/>
                                    <span class="end-price" data-currency="<?= $this->all['data'][0] ?>"><?= $this->all['data'][3] * ($this->all['data'][0] - $this->all['data'][1]) ?></span>
                                </span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="alternativ_payment clearfix">
			<div class="alternativ_payment_head">
				<h3>Ne yapabilirsin?</h3>
				<div class="clearfix">

					<script type="text/javascript">
                        function openPaymentLink() {
                            location.href = ("<?=URI::get_path('buy/index')?>");
                        }
					</script>
					<button class="btn-price premium" href="javascript:void(0)" onClick="openPaymentLink()" title="">
						<img class="ttip" tooltip-content="Ejderha Parası" src="<?=URI::public_path('images/479d2a18c634f5772a66d11e35f9f9.png')?>" alt=""/>
						<span class="premium-name">EP SATIN AL</span>
					</button>
				</div>
			</div>
		</div>
	<?php elseif ($this->all['message'] == 'depo'): ?>
		<div class="dark-grey-box clearfix">
			<div class="clearfix">
				<div class="item-showcase   span2">
					<div id="image" class="picture_wrapper ">
						<img class="item-thumb" src="<?= URL . $this->all['data'][2] ?>" width="98" height="98" alt=""/>
					</div>
				</div>
				<div class="money-showcase  span5 ">
					<h2>Nesne market deponda hiç yer yok!</h2>
					<div class="currency_status_box" style="float: left; margin-right: 5%;">
						<p>Şu anki hesap durumum:</p>
						<ul class="currency_status clearfix">
							<li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Parası"
										 src="//gf1.geo.gfsrv.net/cdn06/479d2a18c634f5772a66d11e35f9f9.png" width="16"
										 height="16" alt="Ejderha Parası"/>
                                    <span class="end-price"
										  data-currency="<?= $this->all['data'][1] ?>"><?= $this->all['data'][1] ?></span>
                                </span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="alternativ_payment clearfix">
			<div class="alternativ_payment_head">
				<h3>Nesne Market Deponu Boşaltmalısın...</h3>
				<div class="clearfix">
				</div>
			</div>
		</div>
	<?php elseif ($this->all['message'] == "error"): ?>
		<div class="dark-grey-box clearfix">
			<div class="clearfix">
				<div class="money-showcase  span5 ">
					<h2>İşlem sırasında bir hata oluştu!</h2>
					<div class="currency_status_box" style="float: left; margin-right: 5%;">
						<p>Hatanın sebebi aşağıdakilerden bir tanesi olabilir :</p>
						<ul>
							<li>3. parti yazılım kullanarak kontrol sistemini geçmeye çalışıyor olabilirsiniz.</li>
							<li>Aktif olmayan bir bölüme girmeye çalışıyor olabilirsiniz.</li>
							<li>Hatalı bir işlem yapmış olabilirsiniz.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php elseif ($this->all['message'] == "faq_status"): ?>
		<div class="dark-grey-box clearfix">
			<div class="clearfix">
				<div class="money-showcase  span5 ">
					<h2>İşlem sırasında bir hata oluştu!</h2>
					<div class="currency_status_box" style="float: left; margin-right: 5%;">
						<p>Hatanın sebebi aşağıdakilerden bir tanesi olabilir :</p>
						<ul>
							<li>3. parti yazılım kullanarak kontrol sistemini geçmeye çalışıyor olabilirsiniz.</li>
							<li>Aktif olmayan bir bölüme girmeye çalışıyor olabilirsiniz.</li>
							<li>Hatalı bir işlem yapmış olabilirsiniz.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php elseif ($this->all['message'] == "same"):?>
		<div class="dark-grey-box clearfix">
			<div class="clearfix">
				<div class="money-showcase  span5 ">
					<h2>[<?= $this->all['data'][0] ?>] İşem sırasında bir hata oluştu!</h2>
					<div class="currency_status_box" style="float: left; margin-right: 5%;">
						<ul>
							<li>Lütfen sayfayı yenileyerek tekrar deneyiniz.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php elseif ($this->all['message'] == "select_faq"): ?>
		<div class="dark-grey-box clearfix">
			<div class="clearfix">
				<div class="item-showcase   span2">
					<div id="image" class="picture_wrapper ">
						<img class="item-thumb" src="<?= URL . $this->all['data'][2] ?>" width="98" height="98" alt=""/>
					</div>
				</div>
				<div class="money-showcase  span5 ">
					<h2>Lütfen 5 Adet Efsun Seçiniz!</h2>
					<div class="currency_status_box" style="float: left; margin-right: 5%;">
						<p>Şu anki hesap durumum:</p>
						<ul class="currency_status clearfix">
							<li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Parası"
										 src="//gf1.geo.gfsrv.net/cdn06/479d2a18c634f5772a66d11e35f9f9.png" width="16"
										 height="16" alt="Ejderha Parası"/>
                                    <span class="end-price"
										  data-currency="<?= $this->all['data'][1] ?>"><?= $this->all['data'][1] ?></span>
                                </span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="alternativ_payment clearfix">
			<div class="alternativ_payment_head">
				<h3>5 Adet Efsunu Seçip Tekrar Satın Almayı Deneyiniz.</h3>
				<div class="clearfix">
				</div>
			</div>
		</div>
	<?php elseif ($this->all['message'] == "false_faq_select"): ?>
		<div class="dark-grey-box clearfix">
			<div class="clearfix">
				<div class="item-showcase   span2">
					<div id="image" class="picture_wrapper ">
						<img class="item-thumb" src="<?= URL . $this->all['data'][2] ?>" width="98" height="98" alt=""/>
					</div>
				</div>
				<div class="money-showcase  span5 ">
					<h2>Yanlış Efsun Seçimi!</h2>
					<div class="currency_status_box" style="float: left; margin-right: 5%;">
						<p>Şu anki hesap durumum:</p>
						<ul class="currency_status clearfix">
							<li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Parası"
										 src="//gf1.geo.gfsrv.net/cdn06/479d2a18c634f5772a66d11e35f9f9.png" width="16"
										 height="16" alt="Ejderha Parası"/>
                                    <span class="end-price"
										  data-currency="<?= $this->all['data'][1] ?>"><?= $this->all['data'][1] ?></span>
                                </span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="alternativ_payment clearfix">
			<div class="alternativ_payment_head">
				<h3 style="font-size: 0.9em;">Bu Eşya için aynı efsunları seçiyor olabilirsiniz veya seçtiğiniz efsunlardan herhangibiri uyumlu değil!</h3>
				<div class="clearfix">
				</div>
			</div>
		</div>
	<?php endif; ?>
	<?php elseif ($result == 'true'): ?>
		<div class="dark-grey-box clearfix">
			<div class="clearfix">
				<div class="item-showcase   span2">
					<div id="image" class="picture_wrapper ">
						<img class="item-thumb" src="<?= URL . $this->all['data'][1] ?>" width="98" height="98" alt=""/>
					</div>
				</div>
				<div class="money-showcase  span5 ">
					<h2><i class="fa fa-check"></i>İşlem Başarılı (<?= $this->all['data'][0] ?>)</h2>
					<div class="currency_status_box" style="float: left; margin-right: 5%;">
						<p>Şu anki hesap durumum:</p>
						<ul class="currency_status clearfix">
							<li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Parası"
										 src="<?= URI::public_path('images/coins.png') ?>" width="16" height="16"
										 alt="Ejderha Parası"/>
                                    <span class="end-price"
										  data-currency="<?= $this->all['data'][2] ?>"><?= $this->all['data'][2] ?></span>
                                </span>
							</li>
							<li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Parası"
										 src="<?= URI::public_path('images/em_coins.png') ?>" width="16" height="16"
										 alt="Ejderha Parası"/>
                                    <span class="end-price"
										  data-currency="<?= $this->all['data'][2] ?>"><?= $this->all['data'][3] ?></span>
                                </span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="alternativ_payment clearfix">
			<div class="alternativ_payment_head">
				<h3>Lütfen Nesne Market Deponuzu Kontrol Ediniz...</h3>
				<div class="clearfix">
				</div>
			</div>
		</div>
	<?php
	$newCoins = $this->all['data'][2];
	$newEm = $this->all['data'][3];
	?>
		<script>
            $(document).ready(function () {
                $('#balances1').text("<?=$newCoins?>");
                $('#balances2').text("<?=$newEm?>");
            });
		</script>
	<?php endif; ?>
</div>


