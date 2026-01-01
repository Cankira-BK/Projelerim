<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"26") == true):?>
<?php
$captchaStatus = ['0'=>'Pasif','1'=>'Google Recaptcha','2'=>'hCaptcha']
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-key font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Recaptcha Ayarları </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="captchaedit" role="form" action="<?=URI::get_path('setting/captchaedit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="status">
								<?php foreach ($captchaStatus as $key=>$row):?>
									<?php if ($key == \StaticDatabase\StaticDatabase::settings('recaptcha')):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Recaptcha Durumu </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="site" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('sitekey')?>">
							<label for="form_control_1">Recaptcha Site Key </label>
							<span class="help-block">Lütfen recaptcha'den aldığınız site key'ini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="secret" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('secretkey')?>">
							<label for="form_control_1">Recaptcha Secret Key</label>
							<span class="help-block">Lütfen recaptcha'den aldığınız secret key'ini giriniz...</span>
						</div>
					</div>
					<div class="form-actions noborder">
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Kaydet</span>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-key font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Nasıl ReCaptcha Key Alırım </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <h4 style="color: darkred">Adım-1</h4>
                    <span>
                        <a href="https://www.google.com/recaptcha/" target="_blank">https://www.google.com/recaptcha/</a> bu adrese giriniz.
                    </span>
                    <hr>
                    <h4 style="color: darkred">Adım-2</h4>
                    <span>
                        "Admin Console" yazan butona tıklayınız.
                        <br>
                        <br>
                        <img src="<?=URI::public_path('layouts/layout/img/recaptcha-1.png')?>" class="img-responsive">
                    </span>
                    <hr>
                    <h4 style="color: darkred">Adım-3</h4>
                    <span>
                        Gmail hesabınıza giriş yapınız. (Hesabınıza daha önce giriş yapıldıysa bu adım gözükmeyecektir, alttaki adımdan geçebilirsiniz.)
                        <br>
                        <img src="<?=URI::public_path('layouts/layout/img/recaptcha-2.png')?>" class="img-responsive">
                    </span>
                    <hr>
                    <h4 style="color: darkred">Adım-4</h4>
                    <span>
                        Sağda bulunan "+" butonuna basınız (Hesabınızdan daha önce recaptcha key alınmadıysa bu kısım gözükmeyecektir, alttaki adıma geçebilirsiniz.)
                        <br>
                        <br>
                        <img src="<?=URI::public_path('layouts/layout/img/recaptcha-3.png')?>" class="img-responsive">
                    </span>
                    <hr>
                    <h4 style="color: darkred">Adım-5</h4>
                    <span>
                        Aşağıdaki 2 bölüme alan adınızı yazıp <u>(başında https:// olmadan resimdeki gibi)</u> reCAPTCHA s2 > "Robot değilim" Onay Kutusu ve reCAPTCHA Hizmet Şartları'nı kabul edin kutusunu işaretleyip "GÖNDER" butonuna basınız.
                        <br>
                        <br>
                        <img src="<?=URI::public_path('layouts/layout/img/recaptcha-4.png')?>" class="img-responsive">
                    </span>
                    <hr>
                    <h4 style="color: darkred">Adım-6</h4>
                    <span>
                        Son olarak resimdeki gibi size 2 adet key verecek. Mavi ile işaretlenen yerlere tıklayarak keyleri kopyalayınız ve yukarıya başında <u># işareti olmadan</u> sırasıyla giriniz. Üstteki key üstte alttaki key altta olacak şekilde.
                        <br>
                        <br>
                        <img src="<?=URI::public_path('layouts/layout/img/recaptcha-5.png')?>" class="img-responsive">
                    </span>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#captchaedit').submit(function (eve) {
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