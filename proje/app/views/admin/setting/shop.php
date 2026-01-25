<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"20") == true):?>
<?php
$captchaStatus = ['0'=>'Pasif','1'=>'Aktif'];
?>
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-cc-visa font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Market Ayarları </span>
					</div>
				</div>
				<b style="color: #191313;font-size: 11px;">Güvenlik Uyarısı! cmd_general.cpp dosyanızda ki varsayılan(GF9001) SAS keyi değiştirmeniz güvenliğiniz için önem teşkil etmektedir.</b><br>
                <b style="color: #191313;font-size: 11px;">Oyun içi marketi aktif etmek için /usr/game/cores/channel1,... vs. içinde ki CONFIG dosyasına MALL_URL karşısına bu değeri giriniz.</b><br>
                <b style="color: #191313;font-size: 11px;">MALL_URL : <a href="javascript:void(0)" style="color: darkred"><?=rtrim(explode("://",URL)[1],'/')?></a></b>
                <div class="portlet-body form">
					<form id="paywantedit" role="form" action="<?=URI::get_path('setting/shopedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('shop_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Market Durumu </label>
							</div>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="sas_key" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('gameKey')?>">
							<label for="form_control_1">Market SAS KEY </label>
							<span class="help-block">Source'de cmd_general.cpp dosyasında ki SAS keyinizi giriniz. Varsayılan : GF9001 </span>
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
    <div class="row">
        <div class="col-md-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-gift font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Happy Hour Etkinliği </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="paywantedit1" role="form" action="<?=URI::get_path('setting/shopedit1');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('happy_hour')):?>
                                            <option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
                                            <option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Happy Hour Etkinlik Durumu </label>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" name="sas_key" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('happy_hour_discount')?>">
                                <label for="form_control_1">Happy Hour Etkinliği Kazanç Miktarı  </label>
                                <span class="help-block">Örnek : 20 yaptığınızda tüm ep satın alımlarında oyuncuların hesabına otomatik +%20 daha fazla ep yüklenir. Tüm ödeme sistemleri için geçerlidir.</span>
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
    <div class="row">
        <div class="col-md-9">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-database font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> EP ve EM Kolon Ayarları (Database) </span>
                    </div>
                </div>
                   <div class="portlet-body form">
                    <form id="paywantedit2" role="form" action="<?=URI::get_path('setting/shopedit2');?>" method="post">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" name="ep" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('cash')?>">
                            <label for="form_control_1">Account EP Kolonu </label>
                            <span class="help-block">Lütfen account tablosundaki geçerli ep kolonunu giriniz. Default : cash </span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" name="em" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('mileage')?>">
                            <label for="form_control_1">Account EM Kolonu </label>
                            <span class="help-block">Lütfen account tablosundaki geçerli em kolonunu giriniz. Default : mileage </span>
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
    <div class="row">
        <div class="col-md-9">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-database font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Bedava (0 EP) Eşya Satma </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="freeSellForm" role="form" action="<?=URI::get_path('setting/freesell');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('free_sell_item')):?>
                                            <option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
                                            <option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Bedava Eşya Satma Durumu </label>
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
	<div class="row">
        <div class="col-md-9">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-database font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Slot Cash Ayarları </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="slotCashForm" role="form" action="<?=URI::get_path('setting/slotcash');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="slot_cash_status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('slot_cash_status')):?>
                                            <option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
                                            <option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Slot Cash Durumu </label>
                            </div>
                        </div>
                        <b style="color: #191313;font-size: 11px;">Slot Cash resim sayısı ne kadar fazlaysa kazanma riski o kadar azdır. Önerilen : 10</b><br>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="number" name="slot_cash_count" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('slot_cash_count')?>">
                            <label for="form_control_1">Slot Cash Resim Sayısı </label>
                            <span class="help-block">Slot Cash Resim Sayısı </span>
                        </div>
                        <b style="color: #191313;font-size: 11px;">Slot Cash kazanıldığında kazanan kişiye oynadığın EP'in katı kadar hediye verir. Örnek : Aşağıda 10 değeri için 5 EP ile oynayan oyuncu 5*10 = 50 EP kazanç elde eder.</b><br>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="number" name="slot_cash_gift" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('slot_cash_gift')?>">
                            <label for="form_control_1">Slot Cash Hediye (X EP)</label>
                            <span class="help-block">Slot Cash Resim Sayısı </span>
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

    <div class="row">
        <div class="col-md-9">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-database font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Market Recaptcha Ayarı </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="shopRecaptchaForm" role="form" action="<?=URI::get_path('setting/shoprecaptcha');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="shop_recaptcha_status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('shop_recaptcha_status')):?>
                                            <option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
                                            <option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Market Recaptcha Durumu </label>
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
        $('#paywantedit').submit(function (eve) {
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
        $('#paywantedit1').submit(function (eve) {
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
        $('#paywantedit2').submit(function (eve) {
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
        $('#freeSellForm').submit(function (eve) {
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
		$('#slotCashForm').submit(function (eve) {
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
                        notify('success',result.message);
                    else
                        notify('error',result.message);
                }
            });
        });
        $('#shopRecaptchaForm').submit(function (eve) {
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
                        notify('success',result.message);
                    else
                        notify('error',result.message);
                }
            });
        });
	</script>
<?php endif;?>