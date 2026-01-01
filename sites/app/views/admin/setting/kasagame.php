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
						<span class="caption-subject bold uppercase"> KasaGame Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b>KasaGame Geri Dönüş Linkiniz : <a href="<?=URL.SHOP.'/buy/kasagame_notify/'.\StaticDatabase\StaticDatabase::settings('kasagame_merc_id')?>" target="_blank"><?=URL.SHOP.'/buy/kasagame_notify/'.\StaticDatabase\StaticDatabase::settings('kasagame_merc_id')?></a></b>
					<form id="KasaGameEdit" role="form" action="<?=URI::get_path('setting/kasagameedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('kasagame_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">KasaGame Durum </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="api" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('kasagame_merc_id')?>">
								<label for="form_control_1">Mağaza NO </label>
								<span class="help-block">Lütfen mağaza no'nuzu giriniz...</span>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="secret" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('kasagame_api_key')?>">
								<label for="form_control_1">Mağaza Parola</label>
								<span class="help-block">Lütfen mağaza parola'nızı giriniz...</span>
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
        $('#KasaGameEdit').submit(function (eve) {
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