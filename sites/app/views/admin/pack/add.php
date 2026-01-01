<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"70") == true):?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-files-o font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Pack Ekle </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="newsCreate" role="form" action="<?=URI::get_path('pack/create');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="name" class="form-control" id="form_control_1" required>
							<label for="form_control_1">Pack Adı</label>
							<span class="help-block">Örn: Full Patch</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="size" class="form-control" id="form_control_1" required>
							<label for="form_control_1">Pack Boyutu</label>
							<span class="help-block">Örn: 82.32MB</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="url" class="form-control" id="form_control_1" required>
							<label for="form_control_1">Pack Linki</label>
							<span class="help-block">Örn: https://tr.metin2.gameforge.com</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select id="source" class="form-control edited" name="source">
								<option value="./data/flags/dosyatc.png" selected>Dosya.tc</option>
								<option value="./data/flags/dosyaco.png" selected>Dosya.co</option>
								<option value="./data/flags/mega.png">Mega.nz</option>
								<option value="./data/flags/yandex.png">Yandex.Disk</option>
								<option value="./data/flags/mediafire.png">Mediafire</option>
								<option value="./data/flags/dosyaupload.png">DosyaUpload.com</option>
								<option value="./data/flags/file.png">Diğer</option>
							</select>
							<label for="form_control_1">Hangi Kaynak </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<img id="fileImage" src="<?=URL.'/data/flags/file.png'?>" width="100px">
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Oluştur</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $('#newsCreate').submit(function (eve) {
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
	$('#source').change(function(){
		var image = $('#source').val();
		document.getElementById('fileImage').src = "<?=URL?>" + image;
	});
</script>
<?php endif;?>