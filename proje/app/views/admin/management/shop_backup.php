<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"82") == true):?>
    <?php
    if (Session::get('error_status') === "true")
    {
        echo "<script>notify('error','".Session::get('error_message')."');</script>";
		Session::set('error_status', 'false');
    }
	if (Session::get('error_status') === "OK")
	{
		echo "<script>notify('success','".Session::get('error_message')."');</script>";
		Session::set('error_status', 'false');
	}
    ?>
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-upload font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Market Yedeği Al </span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="shopExport" role="form" autocomplete="off" action="<?=URI::get_path('management/shop_export');?>" method="post">
						<p>Şuanki marketinizin yedeğini almak için "Yedek Al" butonuna basınız!</p>
						<div class="form-actions noborder">
							<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
								<span class="ladda-label">Yedek Al</span>
							</button>
						</div>
					</form>
				</div>
			</div>

			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-download font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Market Yedeği Yükle </span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="shopImport" role="form"  autocomplete="off" action="<?=URI::get_path('management/shop_import');?>" method="post" enctype="multipart/form-data">
						<p>Aldığınız yedek dosyasını aşağıdaki "Dosya Seç" butonuna basarak bulup "Yedek Yükle" butonuna basınız!</p>
                        <div class="form-group">
                            <input type="file" name="shop_backup" id="shopBackup">
                        </div>
						<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') >= 1) {?>
                        <div class="form-group">
                            <?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
							<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
                        </div>
						<?php }?>
						<div class="form-actions noborder">
							<button id="registerFixButton" type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
								<span class="ladda-label">Yedek Yükle</span>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script>
        $('#shopExport').submit(function (eve) {
            eve.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
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
                        window.open(response.data, '_blank');
                }
            });
        });
	</script>
<?php endif;?>