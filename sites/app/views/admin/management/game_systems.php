<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"27") == true):?>
<?php
$captchaStatus = ['0'=>'Pasif','1'=>'Aktif'];
$columnList = \StaticGame\StaticGame::sql("SHOW COLUMNS FROM ".PLAYER_DB_NAME.".player");
$SevilmeyenSutun = array("id","account_id","name","job","voice","dir","x","y","z","map_index","exit_x","exit_y","exit_map_index","hp","mp","stamina","random_hp","random_sp","playtime","level","level_step","st","ht","dx","iq","exp","gold","stat_point","skill_point","quickslot","ip","part_main","part_base","part_hair","part_sash","part_cape","skill_group","skill_level","alignment","last_play","change_name","mobile","sub_skill_point","stat_reset_count","horse_hp","horse_stamina","horse_level","horse_hp_droptime","horse_riding","horse_skill_point","newquickslot","extend_inventory","halounlv","phaloun","rhaloun","load_items","fish_slots","fish_use_count","dungeonindex","facebook","imza","kral","money","money2","money3","bugdan_kurtar","change_empire","sosyal");
?>
	<div class="row">
		<div class="col-md-8">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-key font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Cheque Won Sistemi Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda won sistemi yoksa won sistemini aktif etmeyiniz. Aksi halde panelde hatalar yaşayabilirsiniz.</b>
					<form id="chequewonedit" role="form" action="<?=URI::get_path('management/chequewonedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="won_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('won_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Won Durum </label>
							</div>
							<?php if (0 == \StaticDatabase\StaticDatabase::systems('won_durum')):?>
								<input type="hidden" name="won_sutun" class="form-control" value="cheque" hidden>
							<?php else:?>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="won_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('won_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Metin Gaya Kolon Adı </label>
								<span class="help-block">Oyununuzdaki metin gaya sistemi hangi kolondan çekiyorsa o kolon ismini yazınız. Örnek : gaya</span>
							</div>
							<?php endif;?>
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
					<img src="<?=URL.'data/extra/chequesistemi.png'?>" class="img-fluid img-thumbnail">
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
						<span class="caption-subject bold uppercase"> Metin Gaya Sistemi Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda gaya sistemi yoksa gaya sistemini aktif etmeyiniz. Aksi halde panelde hatalar yaşayabilirsiniz.</b>
					<form id="metingayaedit" role="form" action="<?=URI::get_path('management/metingayaedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="metingaya_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('metingaya_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Metin Gaya Durum </label>
							</div>
							<?php if (0 == \StaticDatabase\StaticDatabase::systems('metingaya_durum')):?>
								<input type="hidden" name="metingaya_sutun" class="form-control" value="gaya2" hidden>
							<?php else:?>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="metingaya_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('metingaya_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Metin Gaya Kolon Adı </label>
								<span class="help-block">Oyununuzdaki metin gaya sistemi hangi kolondan çekiyorsa o kolon ismini yazınız. Örnek : gaya</span>
							</div>
							<?php endif;?>
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
					<img src="<?=URL.'data/extra/metingaya.jpeg'?>" class="img-fluid img-thumbnail">
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
						<span class="caption-subject bold uppercase"> Boss Gaya Sistemi Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda boss gaya sistemi yoksa boss gaya sistemini aktif etmeyiniz. Aksi halde panelde hatalar yaşayabilirsiniz.</b>
					<form id="bossgayaedit" role="form" action="<?=URI::get_path('management/bossgayaedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="bossgaya_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('bossgaya_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Boss Gaya Durum </label>
							</div>
							<?php if (0 == \StaticDatabase\StaticDatabase::systems('bossgaya_durum')):?>
								<input type="hidden" name="bossgaya_sutun" class="form-control" value="gaya1" hidden>
							<?php else:?>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="bossgaya_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('bossgaya_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Boss Gaya Kolon Adı </label>
								<span class="help-block">Oyununuzdaki boss gaya sistemi hangi kolondan çekiyorsa o kolon ismini yazınız. Örnek : bossgaya</span>
							</div>
							<?php endif;?>
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
					<img src="<?=URL.'data/extra/bossgaya.jpg'?>" class="img-fluid img-thumbnail">
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
						<span class="caption-subject bold uppercase"> NP Sistemi Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda NP sistemi yoksa np sistemini aktif etmeyiniz. Aksi halde panelde hatalar yaşayabilirsiniz.</b>
					<form id="npedit" role="form" action="<?=URI::get_path('management/npedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="np_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('np_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">NP Durum </label>
							</div>
							<?php if (0 == \StaticDatabase\StaticDatabase::systems('np_durum')):?>
								<input type="hidden" name="np_sutun" class="form-control" value="np" hidden>
							<?php else:?>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="np_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('np_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">NP Kolon Adı </label>
								<span class="help-block">Oyununuzdaki np sistemi hangi kolondan çekiyorsa o kolon ismini yazınız. Örnek : np</span>
							</div>
							<?php endif;?>
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
					<img src="<?=URL.'data/extra/npsistemi.png'?>" class="img-fluid img-thumbnail">
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
						<span class="caption-subject bold uppercase"> Rebirth Sistemi Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda Rebirth sistemi yoksa rebirth sistemini aktif etmeyiniz. Aksi halde panelde hatalar yaşayabilirsiniz.</b>
					<form id="rebirthedit" role="form" action="<?=URI::get_path('management/rebirthedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="rebirth_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('rebirth_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Rebirth Durum </label>
							</div>
							<?php if (0 == \StaticDatabase\StaticDatabase::systems('rebirth_durum')):?>
								<input type="hidden" name="rebirth_sutun" class="form-control" value="rebirth" hidden>
							<?php else:?>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="rebirth_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('rebirth_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Rebirth Kolon Adı </label>
								<span class="help-block">Oyununuzdaki rebirth sistemi hangi kolondan çekiyorsa o kolon ismini yazınız. Örnek : rebirth</span>
							</div>
							<?php endif;?>
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
					<img src="<?=URL.'data/extra/rebirth.png'?>" class="img-fluid img-thumbnail">
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
						<span class="caption-subject bold uppercase"> Rütbe Sistemi Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<b> <span style="color: darkred">Dikkat :</span> Oyununuzda Rütbe sistemi yoksa rütbe sistemini aktif etmeyiniz. Aksi halde panelde hatalar yaşayabilirsiniz.</b>
					<form id="rutbeedit" role="form" action="<?=URI::get_path('management/rutbeedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="rutbe_durum">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::systems('rutbe_durum')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Rütbe Durum </label>
							</div>
							<?php if (0 == \StaticDatabase\StaticDatabase::systems('rutbe_durum')):?>
								<input type="hidden" name="rutbe_sutun" class="form-control" value="prestige" hidden>
							<?php else:?>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="rutbe_sutun">
									<?php foreach ($columnList as $column):?>
									<?php if(!in_array($column['Field'], $SevilmeyenSutun)):?>
										<?php if ($column['Field'] == \StaticDatabase\StaticDatabase::systems('rutbe_sutun')):?>
                                            <option value="<?=$column['Field']?>" selected><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php else:?>
                                            <option value="<?=$column['Field']?>"><?=$column['Field']?> [<?=$column['Type']?>]</option>
										<?php endif;?>
									<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Rütbe Kolon Adı </label>
								<span class="help-block">Oyununuzdaki rütbe sistemi hangi kolondan çekiyorsa o kolon ismini yazınız. Örnek : prestige</span>
							</div>
							<?php endif;?>
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
					<img src="<?=URL.'data/extra/rutbesistemi.png'?>" class="img-fluid img-thumbnail">
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
        $('#chequewonedit').submit(function (eve) {
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
                        notify('success','Won Ayarları Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$('#metingayaedit').submit(function (eve) {
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
                        notify('success','Metin Gaya Ayarları Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$('#bossgayaedit').submit(function (eve) {
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
                        notify('success','Boss Gaya Ayarları Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$('#npedit').submit(function (eve) {
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
                        notify('success','NP Ayarları Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$('#rebirthedit').submit(function (eve) {
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
                        notify('success','Rebirth Ayarları Güncelleme Başarılı');
                    else
                        notify('error',result.message);
                }
            });
        });
		$('#rutbeedit').submit(function (eve) {
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
                        notify('success','Rütbe Ayarları Güncelleme Başarılı');
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