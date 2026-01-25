<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"29") == true):?>
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
					<span class="caption-subject bold uppercase"> İtemci Ayarları </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="itemciedit" role="form" action="<?=URI::get_path('setting/itemciedit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="status">
								<?php foreach ($captchaStatus as $key=>$row):?>
									<?php if ($key == \StaticDatabase\StaticDatabase::settings('itemci_status')):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">İtemci Durum </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="token" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('itemci_link')?>">
							<label for="form_control_1">İtemci E-Pin Link </label>
							<span class="help-block">Lütfen itemci e-pin satış linkinizi giriniz...</span>
						</div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="number" name="commission" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('itemci_commission')?>">
                            <label for="form_control_1">İtemci Komisyon Oranı </label>
                            <span class="help-block">Lütfen itemci komisyon oranını giriniz...</span>
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
    $('#itemciedit').submit(function (eve) {
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