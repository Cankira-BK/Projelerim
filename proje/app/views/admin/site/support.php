<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"77") == true):?>
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
						<span class="caption-subject bold uppercase"> Tawk.To Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
                    <p>Tawk.to canlı desteği sitenize kurmak için <a href="https://dashboard.tawk.to/signup" target="_blank">https://dashboard.tawk.to/signup</a> buradan kayıt olup oluşturduğunuz canlı destek site ID'sini aşağıya giriniz.</p>
					<form id="settingedit" role="form" autocomplete="off" action="<?=URI::get_path('site/supportedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('tawkto_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Tawkto Durumu</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="site_id" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('tawkto_id')?>">
								<label for="form_control_1">Tawkto Site ID </label>
								<span class="help-block">Tawkto panelinden Ayarlar - Mülk Ayarlarından Site ID'nizi bulabilirsiniz.</span>
							</div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <p>Site ID'nizi <a href="https://dashboard.tawk.to" target="_blank">https://dashboard.tawk.to</a> adresinden giriş yapıp Ayarlar - Mülk Ayarlarınızdan bulabilirsiniz.</p>
                                <img src="<?=URI::public_path('layouts/layout/img/tawkto.png')?>" height="245">
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
        $('#settingedit').submit(function (eve) {
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
                success: function (response) {
                    if (!response.result)
                        notify('error',response.message);
                    else
                        notify('success',response.message);
                }
            });
        });
	</script>
<?php endif;?>