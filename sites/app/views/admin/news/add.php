<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"65") == true):?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="icon-settings font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Haber Ekle</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" id="newsCreate" method="post" action="<?= URI::get_path('news/newscreate')?>" enctype="multipart/form-data">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label ">
							<label class="control-label col-md-3">Haber Resmi Ekle</label>
							<div class="col-md-9">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-preview thumbnail" data-trigger="fileinput"
										 style="width: 200px; height: 150px;"></div>
									<div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> Resim Seç </span>
                                                                    <span class="fileinput-exists"> Değiştir </span>
                                                                    <input type="file" name="logo" id="logo" multiple
																		   class="file" data-preview-file-type="any"/> </span>
										<a href="javascript:;" class="btn red fileinput-exists"
										   data-dismiss="fileinput"> Sil </a>
									</div>
								</div>
							</div>
						</div>
						<br><br><br><br><br><br><br><br><br><br><br>
						<div class="form-group form-md-line-input">
							<input type="text" name="title" class="form-control" id="form_control_1" value="">
							<label class="control-label col-md-3">Haber Başlığı</label>
							<span class="help-block">Haber Başlığı Belirleyiniz...</span>
						</div>
						<div class="form-group form-md-line-input">
							<input type="text" name="content2" class="form-control" id="form_control_1" value="">
							<label class="control-label col-md-3">Kısa İçerik</label>
							<span class="help-block">[Zorunlu Değildir] Haber için kısa içerik (ÖRN :Patch v4 Güncellemesi için tıklayınız...)</span>
						</div>
						<div class="form-group form-md-line-input">
							<label for="form_control_1">Haber İçeriği</label>
							<textarea class="input-block-level" id="summernote_1" name="content" rows="18"></textarea>
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
                console.log(result);
                if (result.result === true)
                    notify('success','Haber Başarıyla Eklendi!');
                else
                    notify('success','Lütfen Tekrar Deneyiniz!');
            }
        });
    });
</script>
<?php endif;?>