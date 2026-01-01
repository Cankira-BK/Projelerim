<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"75") == true):?>
<?php
$captchaStatus = ['0'=>'Pasif','1'=>'Aktif'];
$columnList = \StaticGame\StaticGame::sql("SHOW COLUMNS FROM ".ACCOUNT_DB_NAME.".account");
$SevilmeyenSutun = array("id","login","password","real_name","social_id","email","phone1","phone2","address","zipcode","create_time","question1","answer1","question2","answer2","is_testor","status","newsletter","empire","name_checked","availDt","reason","mileage","cash","gold_expire","silver_expire","safebox_expire","autoloot_expire","fish_mind_expire","marriage_fast_expire","money_drop_rate_expire","arc_rank","arc_conf","arc_ref_code","dragon_mark","sozlesme","dogum","tel_onay","kod_sure","tel_kod","tel_degisim","tel_sure","mail_degisim","email_kod","ttl_cash","ttl_mileage","channel_company","coins","jcoins","last_play","mail_onay","mail_code","phone_onay","phone_code","phone_time","phone_islem","sms_send","sms_code","sms_phn","sms_ip","ip","son_ip","ref","mobile","mobil_no","mobil_onay","email_onay","ban_sure","ban_time","kim_banlamis","mailaktive","t_status","t_key","t_token","t_type","t_date","ticket_ban","web_ip","ysifre","yemail","ylogin","tkod","ypass","ban_neden","durum","davet","davet_durum","cpu_id","hdd_model","machine_guid","hdd_serial","landing","drs","guvenligiris","securitycode");
$SevilmeyenTablo = array("account","api_maxepin","ban_list","banacanlar","block_exception","cark_kazanc","cark_urunler","duyurular","event_notice","fiksture","guncelleme_gecmisi","guvenli_ip","haberler","indirme_linkleri","iptocountry","is_bildirim","itemci_epin","kilit_sms","mail_islem","site_log","sms","string","turnuva","unuttum_sms","urielac_tokens","version","web_log","yasakli_ip","banned_hdd_list","banned_ip","secure_ip");
?>
	<div class="row">
		<div class="col-md-8">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-key font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> PIN Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda pin sistemi yoksa pin sistemini aktif etmeyiniz. Aksi takdirde Kayıt ve Giriş kısımlar çalışmaz.</b>
					<form id="pinedit" role="form" action="<?=URI::get_path('site/pinedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="pin_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('pin_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">PIN Durum </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select id="pinColumn" class="form-control edited" name="pin_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('pin_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">PIN Kolon Adı </label>
								<span class="help-block">Oyununuzdaki pin sistemi hangi kolondan çekiyorsa o kolon ismini yazınız. Örnek : pin</span>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="pin_adet" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>">
								<label for="form_control_1">PIN Karakter Sayısı</label>
								<span class="help-block">Oyununuzdaki pin sistemi kaç karakterliyse yazınız. Örnek : 4</span>
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
		<div class="col-md-4">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-image font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Örnek Sistem Görüntüsü </span>
					</div>
				</div>
				<div class="pop">
					<center><font size="1">Resmi büyültmek için üzerine tıklayabilirsiniz.</font></center>
					<img src="<?=URL.'data/extra/pinsistemi.jpg'?>" class="img-fluid img-thumbnail">
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-8">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-key font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> GüvenliPC Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda güvenli bilgisayar sistemi yoksa güvenlipc sistemini aktif etmeyiniz. Aksi takdirde panelde hata yaşayabilirsiniz.</b>
					<form id="guvenlipcedit" role="form" action="<?=URI::get_path('site/guvenlipcedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="guvenlipc_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('guvenlipc_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">GüvenliPC Durum </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select id="pinColumn" class="form-control edited" name="guvenlipc_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('guvenlipc_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">GüvenliPC Kolon Adı </label>
								<span class="help-block">Oyununuzdaki hwid adresini hangi kolondan çekiyorsa o kolon ismini seçiniz. Örnek : mac</span>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select id="pinColumn" class="form-control edited" name="guvenlipc_tablo1">
									<?php foreach ($this->securitytablelist['data'] as $SecurityTable):?>
									<?php if(!in_array($SecurityTable['TABLE_NAME'], $SevilmeyenTablo)):?>
										<?php if ($SecurityTable['TABLE_NAME'] == \StaticDatabase\StaticDatabase::systems('guvenlipc_tablo1')):?>
                                            <option value="<?=$SecurityTable['TABLE_NAME']?>" selected><?=$SecurityTable['TABLE_NAME']?></option>
										<?php else:?>
                                            <option value="<?=$SecurityTable['TABLE_NAME']?>"><?=$SecurityTable['TABLE_NAME']?></option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">GüvenliPC Tablo Adı </label>
								<span class="help-block">Oyununuzdaki güvenlipc izinlerini adresini hangi tablodan çekiyorsa o tablo ismini seçiniz. Örnek : guvenlipc</span>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select id="pinColumn" class="form-control edited" name="guvenlipc_tablo2">
									<?php foreach ($this->securitytablelist['data'] as $SecurityTable):?>
									<?php if(!in_array($SecurityTable['TABLE_NAME'], $SevilmeyenTablo)):?>
										<?php if ($SecurityTable['TABLE_NAME'] == \StaticDatabase\StaticDatabase::systems('guvenlipc_tablo2')):?>
                                            <option value="<?=$SecurityTable['TABLE_NAME']?>" selected><?=$SecurityTable['TABLE_NAME']?></option>
										<?php else:?>
                                            <option value="<?=$SecurityTable['TABLE_NAME']?>"><?=$SecurityTable['TABLE_NAME']?></option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">YasaklıPC Tablo Adı </label>
								<span class="help-block">Oyununuzdaki yasaklıpc izinlerini adresini hangi tablodan çekiyorsa o tablo ismini seçiniz. Örnek : yasaklimac</span>
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
		<div class="col-md-4">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-image font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Örnek Sistem Görüntüsü </span>
					</div>
				</div>
				<div class="pop">
					<center><font size="1">Resmi büyültmek için üzerine tıklayabilirsiniz.</font></center>
					<img src="<?=URL.'data/extra/guvenlipc.png'?>" class="img-fluid img-thumbnail">
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-8">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-key font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Hesap Kilit Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda hesap kilit sistemi yoksa hesap kilit sistemini aktif etmeyiniz. Aksi takdirde panelde hata yaşayabilirsiniz.</b>
					<form id="hesapkilitedit" role="form" action="<?=URI::get_path('site/hesapkilitedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="hesapkilit_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('hesapkilit_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Hesap Kilit Durum </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select id="pinColumn" class="form-control edited" name="hesapkilit_tablo">
									<?php foreach ($this->securitytablelist['data'] as $SecurityTable):?>
									<?php if(!in_array($SecurityTable['TABLE_NAME'], $SevilmeyenTablo)):?>
										<?php if ($SecurityTable['TABLE_NAME'] == \StaticDatabase\StaticDatabase::systems('hesapkilit_tablo')):?>
                                            <option value="<?=$SecurityTable['TABLE_NAME']?>" selected><?=$SecurityTable['TABLE_NAME']?></option>
										<?php else:?>
                                            <option value="<?=$SecurityTable['TABLE_NAME']?>"><?=$SecurityTable['TABLE_NAME']?></option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Hesap Kilit Tablo Adı </label>
								<span class="help-block">Oyununuzdaki hesap kilit izinlerini hangi tablodan çekiyorsa o tablo ismini seçiniz. Örnek : hesap_kilit</span>
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
		<div class="col-md-4">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-image font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Örnek Sistem Görüntüsü </span>
					</div>
				</div>
				<div class="pop">
					<center><font size="1">Resmi büyültmek için üzerine tıklayabilirsiniz.</font></center>
					<img src="<?=URL.'data/extra/hesapkilit.png'?>" class="img-fluid img-thumbnail">
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-8">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-key font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> İtem Kilit Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda item kilit sistemi yoksa item kilit sistemini aktif etmeyiniz. Aksi takdirde panelde hata yaşayabilirsiniz.</b>
					<form id="itemkilitedit" role="form" action="<?=URI::get_path('site/itemkilitedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="itemkilit_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('itemkilit_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">İtem Kilit Durum </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select id="pinColumn" class="form-control edited" name="itemkilit_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('itemkilit_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">İtem Kilit Kolon Adı </label>
								<span class="help-block">Oyununuzdaki item kilit şifrelerini hangi kolondan çekiyorsa o kolon ismini seçiniz. Örnek : ilocked_pw</span>
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
		<div class="col-md-4">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-image font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Örnek Sistem Görüntüsü </span>
					</div>
				</div>
				<div class="pop">
					<center><font size="1">Resmi büyültmek için üzerine tıklayabilirsiniz.</font></center>
					<img src="<?=URL.'data/extra/itemkilit.jpg'?>" class="img-fluid img-thumbnail">
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-8">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-key font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Karakter Kilit Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda karakter kilit sistemi yoksa karakter kilit sistemini aktif etmeyiniz. Aksi takdirde panelde hata yaşayabilirsiniz.</b>
					<form id="karakterkilitedit" role="form" action="<?=URI::get_path('site/karakterkilitedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="karakterkilit_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('karakterkilit_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Karakter Kilit Durum </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select id="pinColumn" class="form-control edited" name="karakterkilit_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('karakterkilit_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Karakter Kilit Kolon Adı </label>
								<span class="help-block">Oyununuzdaki karakter kilit şifrelerini hangi kolondan çekiyorsa o kolon ismini seçiniz. Örnek : security_password</span>
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
		<div class="col-md-4">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-image font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Örnek Sistem Görüntüsü </span>
					</div>
				</div>
				<div class="pop">
					<center><font size="1">Resmi büyültmek için üzerine tıklayabilirsiniz.</font></center>
					<img src="<?=URL.'data/extra/karakterkilit.jpg'?>" class="img-fluid img-thumbnail">
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog" data-dismiss="modal">
		<div class="modal-content"  >              
		  <div class="modal-body">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Kapat</span></button>
			<div class="col-xs-12">
				   <p class="text-center"><b>Sistem Önizlemesi</b></p>
			</div>
			<img src="" class="imagepreview" style="width: 100%;" >
		  </div> 
		  <div class="modal-footer">
			  <div class="col-xs-12">
				   <p class="text-left">Önizlemeden çıkmak için herhangi bir yere tıklayınız!</p>
			  </div>
		  </div>
		</div>
	  </div>
	</div>
	<script>
        $('#pinedit').submit(function (eve) {
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
                        notify('success','Pin Ayarları Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$('#guvenlipcedit').submit(function (eve) {
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
                        notify('success','GüvenliPC Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$('#itemkilitedit').submit(function (eve) {
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
                        notify('success','İtem Kilit Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$('#hesapkilitedit').submit(function (eve) {
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
                        notify('success','Hesap Kilit Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$('#karakterkilitedit').submit(function (eve) {
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
                        notify('success','Karakter Kilit Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$(function() {
            $('.pop').on('click', function() {
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#imagemodal').modal('show');   
            });     
		});
	</script>
<?php endif;?>