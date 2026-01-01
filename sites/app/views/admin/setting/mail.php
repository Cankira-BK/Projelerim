<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"22") == true):?>
<?php
$mailProtocol = ['tls'=>'TLS','ssl'=>'SSL']
?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-envelope font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Mail Ayarları </span>
				</div>
			</div>
			<div class="portlet-body form">
                <button id="yandexButton" type="button" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                    <span class="ladda-label">Yandex</span>
                </button>
                <button id="gmailButton" type="button" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                    <span class="ladda-label">Gmail</span>
                </button>
                <button id="mailgunButton" type="button" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                    <span class="ladda-label">Mailgun</span>
                </button>
				<button id="mailruButton" type="button" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                    <span class="ladda-label">MailRu</span>
                </button>
                <br>
                <br>
                <span style="color: firebrick"> Girdiğiniz bilgilerin sağında ve solunda boşluk, # işareti olmadığında emin olun.</span>
				<form id="newsCreate" role="form" action="<?=URI::get_path('setting/mailedit');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="title" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('smtp_from')?>">
							<label for="form_control_1">Mail Başlığı</label>
							<span class="help-block">Örn: Oyunadı Yönetimi</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="host" class="form-control" id="mail_host" value="<?=\StaticDatabase\StaticDatabase::settings('smtp_host')?>">
							<label for="mail_host">Mail Host</label>
							<span class="help-block">yandex için : smtp.yandex.com.tr, gmail için : smtp.gmail.com, kendi domaniniz için : mail.alanadi.com (alanadi yerine kendi domain adresinizi yazınız...)</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="mail" class="form-control" id="form_control_2" value="<?=\StaticDatabase\StaticDatabase::settings('smtp_username')?>">
							<label for="form_control_1">Mail Adresi</label>
							<span class="help-block">Örn: info@alanadi.com</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="password" class="form-control" id="form_control_3" value="<?=\StaticDatabase\StaticDatabase::settings('smtp_password')?>">
							<label for="form_control_1">Mail Şifreniz</label>
							<span class="help-block">Lütfen mail adresinizin şifresini giriniz...</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="port" class="form-control" id="mail_port" value="<?=\StaticDatabase\StaticDatabase::settings('smtp_port')?>">
							<label for="mail_port">Mail Port</label>
							<span class="help-block">TLS için : 587, SSL için: 465 </span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="protocol" id="mail_protocol">
								<option value="">Yok</option>
								<?php foreach ($mailProtocol as $key=>$row):?>
									<?php if ($key == \StaticDatabase\StaticDatabase::settings('smtp_secure')):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Mail Protokol </label>
						</div>
					</div>
					<div class="form-actions noborder">
						<!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
						<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Kaydet</span>
						</button>

                        <button id="mailTestButton" type="button" class="btn btn-warning mt-ladda-btn ladda-button pull-right">
                            <span class="ladda-label">Maili Test Et</span>
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
    $('#yandexButton').click(function () {
       var mailHost = "smtp.yandex.com.tr";
       var mailPort = "587";
       var mailProtocol = "TLS";
       $('#mail_host').val(mailHost);
       $('#mail_port').val(mailPort);
       $('#mail_protocol option:contains(' + mailProtocol + ')').prop({selected: true});
    });
    $('#gmailButton').click(function () {
        var mailHost = "smtp.gmail.com";
        var mailPort = "587";
        var mailProtocol = "TLS";
        $('#mail_host').val(mailHost);
        $('#mail_port').val(mailPort);
        $('#mail_protocol option:contains(' + mailProtocol + ')').prop({selected: true});
    });
    $('#mailgunButton').click(function () {
        var mailHost = "smtp.mailgun.org";
        var mailPort = "587";
        var mailProtocol = "TLS";
        $('#mail_host').val(mailHost);
        $('#mail_port').val(mailPort);
        $('#mail_protocol option:contains(' + mailProtocol + ')').prop({selected: true});
    });
	$('#mailruButton').click(function () {
        var mailHost = "smtp.mail.ru";
        var mailPort = "465";
        var mailProtocol = "SSL";
        $('#mail_host').val(mailHost);
        $('#mail_port').val(mailPort);
        $('#mail_protocol option:contains(' + mailProtocol + ')').prop({selected: true});
    });
    $('#mailTestButton').click(function () {
        $("#mailTestModal").modal();
    });
</script>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-files-o font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">Örnek Mail Ayarları </span>
				</div>
			</div>
			<div class="portlet-body form">
				<div>
					<b>Yandex <b style="color: darkgreen">(Önerilen mail servisi) </b></b> <br>
					Mail Host : smtp.yandex.com.tr <br>
					Mail Adresi : example@yandex.com (yandex mail adresiniz)<br>
					Mail Şifreniz : mail giriş şifreniz <br>
					Mail Port : 587 <br>
					Mail Protokol : TLS <br>
				</div>
				<br><br>
                <div>
                    <b>MailGun <b style="color: darkred">(<a href="https://www.mailgun.com/" target="_blank">https://www.mailgun.com/</a> buradan üyelik açıp alan adına bağlamalı ve DNS MX kayıtlarını yapmalısınız.)</b></b> <br>
                    Mail Host : smtp.mailgun.org <br>
                    Mail Adresi : example@alanadı.com ( )<br>
                    Mail Şifreniz : mail giriş şifreniz <br>
                    Mail Port : 587 <br>
                    Mail Protokol : TLS <br>
                </div>
                <br><br>
				<div>
					<b>Gmail <b style="color: darkred">(<a href="https://gmail.com" target="_blank">https://gmail.com</a> adresinden mail ayarlarınıza girip SMTP izini vermelisiniz, önerilmez.)</b></b> <br>
					Mail Host : smtp.gmail.com <br>
					Mail Adresi : example@gmail.com (gmail mail adresiniz)<br>
					Mail Şifreniz : mail giriş şifreniz <br>
					Mail Port : 587 <br>
					Mail Protokol : TLS <br>
				</div>
			</div>
		</div>
	</div>
</div>

    <div class="modal fade" id="mailTestModal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Maili Test Et</h4>
                </div>
                <div class="modal-body">
                    <b>
                        <span style="color: firebrick">Test etmeden önce mail ayarlarınızdaki mail bilgilerinin güncel olduğundan emin olun. Sadece bilgileri girmiş ve Kaydet dememişseniz test işlemi sırasında hata verecektir.</span>
                        <br>
                        <span style="color: blue">Not :</span> Test Et butonuna bastığınızda alt tarafta girdiğiniz mail adresine mail ayarlarında girdiğiniz mail
                        adresinden test mail gönderilmeye çalışılacak. Eğer mail tarafınıza ulaşırsa mail ayarlarını doğru girdiğiniz anlamına gelmektedir.
                    </b>
                    <form id="testMailForm" action="<?=URI::get_path('setting/testmail')?>" role="form" autocomplete="off" method="post" style="margin-top: 20px;">
                        <div class="form-body">
                            <div class="form-group">
                                <input type="email" id="testMailAddress" name="email" class="form-control" required="" placeholder="Lütfen kendi mail adresinizi giriniz... (Bu girilen mail adresine test mail gelecek.)">
                            </div>
                        </div>
                    </form>
                    <span id="errorSection" style="display: none">
                        <span style="color: darkred">Hata Mesajı :</span>
                        <br>
                        <span id="errorMessage"></span>
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Kapat</button>
                    <button type="submit" form="testMailForm" class="btn green">Test Et</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <script>
        $("#testMailForm").on('submit',function (event) {
            event.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $("#errorSection").fadeOut();

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function (response) {
                    if (!response.result)
                    {
                        $("#errorSection").fadeIn();
                        $("#errorMessage").html(response.error);
                        notify('error','Mail Gönderilemedi!');
                    }
                    else
                    {
                        $('#mailTestModal').modal('hide');
                        notify('success','Mail Başarıyla Gönderildi!');
                    }
                }
            });
        });
    </script>
<?php endif;?>