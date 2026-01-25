<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"67") == true):?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Patcher Haber Ekle</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" id="patchernewscreate" method="post" action="<?= URI::get_path('news/patchernewscreate')?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<select class="form-control edited" name="label">
								<option value="1">Etkinlik</option>
								<option value="2">Güncelleme</option>
								<option value="3">Bilgi</option>
								<option value="4">Önemli Bilgi</option>
								<option value="5">Nesne Market</option>
								<option value="6">Duyuru</option>
							</select>
							<label>Haber Öneki</label>
						</div>
						<div class="form-group form-md-line-input">
							<input type="text" name="title" class="form-control" id="form_control_1" value="">
							<label>Haber Başlığı</label>
							<span class="help-block">Haber Başlığı Belirleyiniz...</span>
						</div>
						<div class="form-group form-md-line-input">
							<input type="text" name="link" class="form-control" id="form_control_1" value="">
							<label>Haber URL</label>
							<span class="help-block">Haber Linkini Belirleyiniz...</span>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn blue">Haber Oluştur</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $('#patchernewscreate').submit(function (eve) {
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
                    notify('success','Haber Başarıyla Oluşturuldu');
                else
                    notify('error','Bir Hata Oluştu');
            }
        });
    });
</script>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Patcher Slider Ekle</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" id="patcherslidercreate" method="post" action="<?= URI::get_path('news/patcherslidercreate')?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<input type="text" name="image" class="form-control" id="form_control_1" value="">
							<label>Slider Resim Linki</label>
							<span class="help-block">Slider Resim Linki Giriniz. ÖRN : https://i.hizliresim.com/40RFk4.png</span>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn blue">Slider Oluştur</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $('#patcherslidercreate').submit(function (eve) {
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
                    notify('success','Slider Başarıyla Oluşturuldu');
                else
                    notify('error','Bir Hata Oluştu');
            }
        });
    });
</script>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Patcher Menü Ekle</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" id="patcherlinkcreate" method="post" action="<?= URI::get_path('news/patcherlinkcreate')?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<input type="text" name="title" class="form-control" id="form_control_1" value="">
							<label>Menü Başlığı</label>
						</div>
						<div class="form-group form-md-line-input">
							<input type="text" name="link" class="form-control" id="form_control_1" value="">
							<label>Menü URL</label>
						</div>
						<div class="form-group form-md-line-input">
							<input type="text" name="content" class="form-control" id="form_control_1" value="">
							<label>Menü Açıklama</label>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn blue">Menü Oluştur</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
    $('#patcherlinkcreate').submit(function (eve) {
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
                    notify('success','Menü Başarıyla Oluşturuldu');
                else
                    notify('error','Bir Hata Oluştu');
            }
        });
    });
</script>
<?php endif;?>