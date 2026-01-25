<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"76") == true):?>
	<?php
	$captchaStatus = ['0'=>'Pasif','1'=>'Aktif'];
	$discordTheme = ["banner1"=>"Tema-1","banner2"=>"Tema-2","banner3"=>"Tema-3","banner4"=>"Tema-4"];
	?>
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-cc-visa font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Discord Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
                    <p>Discord widget sitenize kurmak için aşağıdaki bölümleri doldurunuz!</p>
					<form id="settingedit" role="form" autocomplete="off" action="<?=URI::get_path('site/discordedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('discord_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Discord Durumu</label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="site_id" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('discord_id')?>">
								<label for="form_control_1">Discord Grup ID  </label>
								<span class="help-block">Discord grup id'nizi buraya giriniz.</span>
							</div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="theme">
									<?php foreach ($discordTheme as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('discord_theme')):?>
                                            <option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
                                            <option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Discord temasını seçiniz</label>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" name="link" class="form-control" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('discord_link')?>">
                                <label for="form_control_1">Discord Davet Linki  </label>
                                <span class="help-block">Discord davet linkinizi buraya giriniz.</span>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <p>Discord Grup ID'nizi oluşturduğunuz gruba sağ tıklayarak "ID'yi Kopyala" tuşuna basarak ulaşabilirsiniz.</p>
                                <img src="<?=URI::public_path('layouts/layout/img/discord_id.png')?>">
                                <br><br>
                                <hr>
                                <p>Discord Davet Linkinizi oluşturduğunuz gruba sağ tıklayarak "İnsanları Davet Et" tuşuna basarak ulaşabilirsiniz. Ek olarak "Bu bağlantıyı hiç sona ermemeye ayarla" kısmını işaretlemelisiniz.</p>
                                <img src="<?=URI::public_path('layouts/layout/img/discord_invite.png')?>">
                                <br><br>
                                <hr>
                                <p>Discord Grup Widget Ayarını Etklinleştirin.</p>
                                <img src="<?=URI::public_path('layouts/layout/img/discord_widget1.png')?>">
                                <br>
                                <br>
                                <img src="<?=URI::public_path('layouts/layout/img/discord_widget2.png')?>" height="400">
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
        $('#settingedit').submit(function (eve) {
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
                success: function (response) {
                    if (!response.result)
                        notify('error',response.message);
                    else
                        notify('success',response.message);
                }
            });
        });
	</script>
<?php endif;?>