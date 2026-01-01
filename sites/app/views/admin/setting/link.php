<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"23") == true):?>
<?php
$captchaStatus = ['0'=>'Pasif','1'=>'Aktif']
?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-link font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Tanıtım & Forum </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="linkedit" role="form" action="<?=URI::get_path('setting/linkedit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="landing" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>">
							<label for="form_control_1">Tanıtım Linki</label>
							<span class="help-block">Tanıtım linkinizi yazınız...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="forum" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('forum')?>">
							<label for="form_control_1">Forum Linki</label>
							<span class="help-block">Forum linkinizi yazınız...</span>
						</div>
					</div>
					<div class="form-actions noborder">
						<!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
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
						<i class="fa fa-facebook font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Facebook </span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="linkedit2" role="form" action="<?=URI::get_path('setting/linkedit2');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="facebook_status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('facebook_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Facebook Haber Penceresi</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="facebook_news">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('facebook_like_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Facebook Beğeni Penceresi</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="facebook" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">
								<label for="form_control_1">Facebook Linki</label>
								<span class="help-block">Facebook linkinizi yazınız...</span>
							</div>

						</div>
						<div class="form-actions noborder">
							<!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
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
						<i class="fa fa-link font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Youtube & Intagram</span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="linkedit3" role="form" action="<?=URI::get_path('setting/linkedit3');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="youtube" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>">
								<label for="form_control_1">Youtube Linki</label>
								<span class="help-block">Youtube linkinizi yazınız...</span>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="instagram" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('instagram')?>">
								<label for="form_control_1">İnstagram Linki</label>
								<span class="help-block">İnstagram linkinizi yazınız....</span>
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
    $('#linkedit').submit(function (eve) {
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
	$('#linkedit2').submit(function (eve) {
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
	$('#linkedit3').submit(function (eve) {
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
	$('#linkedit4').submit(function (eve) {
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