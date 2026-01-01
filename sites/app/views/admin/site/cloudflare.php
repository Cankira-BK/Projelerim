<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"83") == true):?>
<?php
$captchaStatus = ['0'=>'Pasif','1'=>'Aktif'];
?>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-cloud font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> CloudFlare Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> CloudFlare kullanıyorsanız aktif etmeyi ihmal etmeyin.</b>
					<form id="cloudedit" role="form" action="<?=URI::get_path('site/cloudflare');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="cloud_status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('cloud_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">CloudFlare Durum </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="cloud_mail" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('cloud_mail')?>">
								<label for="form_control_1">Mail Adresi</label>
								<span class="help-block">CloudFlare giriş için kullandığınız mail adresini girin</span>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="cloud_auth" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('cloud_auth')?>">
								<label for="form_control_1">Global API Key</label>
								<span class="help-block">CloudFlare auth key almak için <a href="https://dash.cloudflare.com/profile/api-tokens" target="_blank">tıklayın!</a></span>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="cloud_dom" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('cloud_dom')?>">
								<label for="form_control_1">Site Adresi</label>
								<span class="help-block">CloudFlare üzerinde barınan site adresi Örn: siteadresi.com</span>
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
        $('#cloudedit').submit(function (eve) {
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
                    console.log(result);
                    if (result.result === true)
                        notify('success','CloudFlare API Bilgileri Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
	</script>
<?php endif;?>