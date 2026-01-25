<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"35") == true):?>

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

						<span class="caption-subject bold uppercase"> Payreks Entegrasyon Ayarları </span>

					</div>

				</div>

				<div class="portlet-body form">

                    <b style="color: darkred">Payreks Elektronik Cüzdan'a <a href="https://payreks.com/" target="_blank">buradan</a> ulaşabilir ve başvuru yapabilirsiniz. Üyeliğiniz varsa

                        <a href="https://cpanel.payreks.com/" target="_blank">buradan</a> giriş yapabilirsiniz.</b><br><br>

					<form id="payreksSettingForm" role="form" action="<?=URI::get_path('setting/payreksedit');?>" method="post">

						<div class="form-body">

							<div class="form-group form-md-line-input form-md-floating-label">

								<select class="form-control edited" name="status">

									<?php foreach ($captchaStatus as $key=>$row):?>

										<?php if ($key == \StaticDatabase\StaticDatabase::settings('payreks_status')):?>

											<option value="<?=$key?>" selected><?=$row?></option>

										<?php else:?>

											<option value="<?=$key?>"><?=$row?></option>

										<?php endif;?>

									<?php endforeach;?>

								</select>

								<label for="form_control_1">Payreks Durum </label>

							</div>

							<div class="form-group form-md-line-input form-md-floating-label">

								<input type="text" disabled class="form-control" value="<?=URL.SHOP.'/buy/payreks_notify/'.\StaticDatabase\StaticDatabase::settings('payreks_token')?>">

								<label for="form_control_1">Payreks Geri Dönüş Adresiniz </label>

							</div>

							<div class="form-group form-md-line-input form-md-floating-label">

								<input type="text" name="api" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('payreks_api')?>">

								<label for="form_control_1">Payreks Api Key </label>

								<span class="help-block">Lütfen payreks api key'ini giriniz...</span>

							</div>

							<div class="form-group form-md-line-input form-md-floating-label">

								<input type="text" name="secret" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('payreks_secret')?>">

								<label for="form_control_1">Payreks Secret Key</label>

								<span class="help-block">Lütfen payreks secret key'ini giriniz...</span>

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

	<div class="row">

		<div class="col-md-9">

			<!-- BEGIN SAMPLE FORM PORTLET-->

			<div class="portlet light bordered">

				<div class="portlet-title">

					<div class="caption font-red-sunglo">

						<i class="fa fa-cc-visa font-red-sunglo"></i>

						<span class="caption-subject bold uppercase"> Payreks Bildirim Ayarları </span>

					</div>

				</div>

				<div class="portlet-body form">

					<form id="payreksNotificationForm" role="form" action="<?=URI::get_path('setting/payreksedit2');?>" method="post">

						<div class="form-body">

							<div class="form-group form-md-line-input form-md-floating-label">

								<select class="form-control edited" name="status">

									<?php foreach ($captchaStatus as $key=>$row):?>

										<?php if ($key == \StaticDatabase\StaticDatabase::settings('payreks_notification_status')):?>

											<option value="<?=$key?>" selected><?=$row?></option>

										<?php else:?>

											<option value="<?=$key?>"><?=$row?></option>

										<?php endif;?>

									<?php endforeach;?>

								</select>

								<label for="form_control_1">Payreks Bildirim Durum </label>

							</div>

							<div class="form-group form-md-line-input form-md-floating-label">

								<input type="text" name="token" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('payreks_notification_token')?>">

								<label for="form_control_1">Payreks Bildirim Anahtarı</label>

								<span class="help-block">Lütfen payreks bildirim anahtarınızı giriniz...</span>

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

        $('#payreksSettingForm').submit(function (eve) {

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

        $('#payreksNotificationForm').submit(function (eve) {

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