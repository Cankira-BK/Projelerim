<?php if ($this->all["result"]):?>
	<?php
	$result = $this->all;
	?>
	<div class="dark-grey-box clearfix" style="background: #eade9e;">
		<div class="clearfix">
			<div class="money-showcase span5">
                <?php if (\StaticDatabase\StaticDatabase::settings('shop_recaptcha_status')):?>
                    <h5>Lütfen robot olmadığınızı doğrulayın!</h5>
                <?php else:?>
                    <h5>Bu eşyayı almak istediğinizi emin misiniz?</h5>
                <?php endif;?>
				<div class="currency_status_box" style="float: left; margin-right: 5%;">
					<form id="buyItem" action="<?=$result["url"]?>">
						<input id="itemID" name="item_id" type="hidden" value="<?=$result['item_id']?>">
						<input id="itemCount" name="item_num" type="hidden" value="<?=$result['item_num']?>">
						<input id="itemHash" name="item_hash" type="hidden" value="<?=$result['item_hash']?>">
						<?php if (\StaticDatabase\StaticDatabase::settings('shop_recaptcha_status')):?>
							<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                        <?php endif;?>
						<div class="buy-btn-box clearfix" style="margin-top: 15px;">
							<button type="submit" form="buyItem" class="btn-price premium">
								<span class="premium-name">Onayla</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script>
        $('#buyItem').submit(function (event) {
            event.preventDefault(event);
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                url : url,
                type : 'POST',
                data : data,
                dataType : 'json',
                success : function (response) {
                    $.fancybox({
                        tpl: {
                            closeBtn: '<button title="Close" class="fancybox-item fancybox-close btn-default" href="javascript:;"></button>'
                        },
                        href: "<?=$result["result_url"]?>",
                        type: 'ajax',
                        autoDimensions: false,
                        width: "auto",
                        height: "auto",
                        overlayOpacity: 0.6,
                        showCloseButton: true,
                        enableEscapeButton: false,
                        hideOnOverlayClick: false,
                        hideOnContentClick: false,
                        padding: 10,
                        ajax: {
                            type: 'POST',
                            data: {result:response.result,data:response.data,message:response.message}
                        }
                    });
                }
            });
        });
	</script>
<?php else:?>
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
<?php endif;?>
