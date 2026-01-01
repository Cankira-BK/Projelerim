<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"67") == true):?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Market Haber Ekle (SOL BANNER)</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" id="newsCreate" method="post" action="<?= URI::get_path('news/shopnewscreate')?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<input type="text" name="link" class="form-control" id="form_control_1" value="">
							<label class="control-label col-md-3">Haber Resim Linki</label>
							<span class="help-block">Haber Resim Linki Giriniz. ÖRN : https://gf3.geo.gfsrv.net/cdn85/73710b0e9893be93562199eaa5f21d.jpg</span>
						</div>
						<div class="form-group form-md-line-input">
							<input type="text" name="title" class="form-control" id="form_control_1" value="">
							<label class="control-label col-md-3">Haber Başlığı</label>
							<span class="help-block">Haber Başlığı Belirleyiniz...</span>
						</div>
						<div class="form-group form-md-line-input">
							<input type="text" name="content" class="form-control" id="form_control_1" value="">
							<label class="control-label col-md-3">Haber İçeriği</label>
							<span class="help-block">Haber İçeriği</span>
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
</script>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Market Haber Ekle (SAĞ MİNİ BANNER)</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" id="newsCreated" method="post" action="<?= URI::get_path('news/shopnewscreated')?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group form-md-line-input">
							<input type="text" name="link" class="form-control" id="form_control_1" value="">
							<label class="control-label col-md-3">Haber Resim Linki</label>
							<span class="help-block">Haber Resim Linki Giriniz. ÖRN : https://gf3.geo.gfsrv.net/cdn85/73710b0e9893be93562199eaa5f21d.jpg</span>
						</div>
						<div class="form-group form-md-line-input">
							<input type="text" name="title" class="form-control" id="form_control_1" value="">
							<label class="control-label col-md-3">Haber Başlığı</label>
							<span class="help-block">Haber Başlığı Belirleyiniz...</span>
						</div>
						<div class="form-group form-md-line-input">
							<input type="text" name="content" class="form-control" id="form_control_1" value="">
							<label class="control-label col-md-3">Haber İçeriği</label>
							<span class="help-block">Haber İçeriği</span>
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
    $('#newsCreated').submit(function (eve) {
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
                    notify('success','Haber Başarıyla Güncellendi');
                else
                    notify('error','Bir Hata Oluştu');
            }
        });
    });
</script>
<?php endif;?>