<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"25") == true):?>
<?php
$captchaStatus = ['0'=>'Pasif','1'=>'SocketLib Aktif','2'=>'SocketAPI Aktif']
?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-code font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Socket Ayarları </span>
				</div>
			</div>
			<div class="portlet-body form">
                <b style="color: darkred">Hatırlatma : Socket bağlantısı oyun src'si ile bağlantılı çalışmaktadır. Eğer bağlantı yapılmamışsa Socket Bağlatı Durumunu Aktif yapmayınız. Aksi halde güvenlik sorunu yaşabilirsiniz</b>
                <form id="socketedit" role="form" action="<?=URI::get_path('setting/socketedit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="status">
								<?php foreach ($captchaStatus as $key=>$row):?>
									<?php if ($key == \StaticDatabase\StaticDatabase::settings('socket_status')):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Socket Bağlantı Durumu </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="key" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('serverResponse')?>">
							<label for="form_control_1">Socket Karşılama Keyi </label>
							<span class="help-block">Lütfen socket karşılama key'inizi giriniz... (Varsayılan key : SHOWMETHEMONEY)</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="ch1" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('ch1_port')?>">
							<label for="form_control_1">Ch1 Port </label>
							<span class="help-block">Lütfen ch1 portunuzu giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="ch2" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('ch2_port')?>">
							<label for="form_control_1">Ch2 Port </label>
							<span class="help-block">Lütfen ch2 portunuzu giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="ch3" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('ch3_port')?>">
							<label for="form_control_1">Ch3 Port </label>
							<span class="help-block">Lütfen ch3 portunuzu giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="ch4" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('ch4_port')?>">
							<label for="form_control_1">Ch4 Port </label>
							<span class="help-block">Lütfen ch4 portunuzu giriniz...</span>
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
<script>
    $('#socketedit').submit(function (eve) {
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