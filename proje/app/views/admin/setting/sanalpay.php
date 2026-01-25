<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"33") == true):?>
	<?php
	$captchaStatus = ['0'=>'Pasif','1'=>'Aktif']
	?>
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-cc-visa font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> SanalPay Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b>SanalPay Geri Dönüş Linkiniz : <a href="<?=URL.SHOP.'/buy/sanalpay_notify/'.\StaticDatabase\StaticDatabase::settings('paywant_token')?>" target="_blank"><?=URL.SHOP.'/buy/sanalpay_notify/'.\StaticDatabase\StaticDatabase::settings('paywant_token')?></a></b>
					<form id="paywantedit" role="form" action="<?=URI::get_path('setting/sanalpayedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('sanalpay_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">SanalPay Durum </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="api" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('sanalpay_api')?>">
								<label for="form_control_1">SanalPay Api Key </label>
								<span class="help-block">Lütfen sanalpay api key'ini giriniz...</span>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="secret" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('sanalpay_hash')?>">
								<label for="form_control_1">SanalPay Hash Key</label>
								<span class="help-block">Lütfen sanalpay hash key'ini giriniz...</span>
							</div>
						</div>
						<div class="form-actions noborder">
							<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
								<span class="ladda-label">Güncelle</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
        $('#paywantedit').submit(function (eve) {
            eve.preventDefault();
            var url = $(this).attr('action');
            var data = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    if (result.result === true)
                        notify('success','Güncelleme Başarılı');
                    else
                        notify('error','Bir Hata Oluştu');
                }
            });
        });
	</script>
<?php endif;?>