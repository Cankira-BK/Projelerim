<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"100") == true):?>
<?php $durumlar = ['0'=>'Pasif','1'=>'Aktif']; $evrim = ['0'=>'Pasif','1'=>'Otlu Evrim Sistemi','2'=>'Otsuz Evrim Sistemi'];?>
<div class="row">
	<div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-key font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">Sistem Kontrolü </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form id="captchaedit" role="form" action="<?=URI::get_path('ssh/systemconfig');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="baslangiclevel" value="<?=SSHConnect::explode_line("SYSTEM_CONFIG","MIN_LEVEL");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">Başlangıç Seviyesi</label>
							<span class="help-block">Lütfen karakter başlangıç seviyesini giriniz.</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="maxlevel" value="<?=SSHConnect::explode_line("SYSTEM_CONFIG","MAX_LEVEL");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">Level Sınırı </label>
							<span class="help-block">Lütfen karakter level sınırını giriniz.</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="maxstatu" value="<?=SSHConnect::explode_line("SYSTEM_CONFIG","STATU_SINIRI");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">Statü Sınırı </label>
							<span class="help-block">Lütfen statü sınırını giriniz. Örn: 90 Statü için 91 girmelisiniz.</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="baslangicskill" value="<?=SSHConnect::explode_line("SYSTEM_CONFIG","BECERI_TAHTASI");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">Skill Başlangıç Oranı </label>
							<span class="help-block">Örnek oranlar aşağıdaki gibidir;<br>M Skill: 20<br>G Skill: 30<br>P Skill: 40</span>
						</div><br><br>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="tasorani" value="<?=SSHConnect::explode_line("SYSTEM_CONFIG","TAS_EKLEME_ORANI");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">Taş Eklenme Oranı </label>
							<span class="help-block">Lütfen taş eklenme oranını giriniz</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="minbagirma" value="<?=SSHConnect::explode_line("SYSTEM_CONFIG","BAGIRMA_LEVELI_MIN");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">Bağırma Min Seviye </label>
							<span class="help-block">Lütfen bağırma için gereken minimum seviyeyi giriniz</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="metintas">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","METINDEN_04_TAS_DUSME")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Metinden +0 +4 Arası Taşlar Düşsünmü </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="marketurl" value="<?=SSHConnect::explode_line("SYSTEM_CONFIG","MALL_URL");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">Nesne Market URL </label>
							<span class="help-block">Lütfen nesne market linkini giriniz!<br>Örn: web.siteadresi.com</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="olumbuff">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","OLUNCE_BUFF_GITMESIN")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Ölünce Buff Gitmesin </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="evrimsistem">
								<?php foreach ($evrim as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","EVRIM_SISTEMI_DURUMU")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Silah Evrim Tercihi </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="biyolog">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","BIYOLOG_BEKLEME")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Biyolog Süre Beklemesin </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="mana">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","SINIRSIZ_MANA")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Sınırsız Mana </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="offshop">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","OFFLINESHOP_DURUMU")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Çevrimdışı Pazar Sistemi </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="kenvanter">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","K_ENVANTER_DURUMU")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">K Envanteri Sistemi </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="kemer">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","KEMER_DURUMU")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Kemer Sistemi </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="aura">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","AURA_DURUMU")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Aura ve Kuşak Sistemi </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="pet">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","PET_DURUMU")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Levelli Offical Pet Sistemi </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<select class="form-control edited" name="simya">
								<?php foreach ($durumlar as $key=>$row):?>
									<?php if ($key == SSHConnect::explode_line("SYSTEM_CONFIG","SIMYA_DURUMU")):?>
										<option value="<?=$key?>" selected><?=$row?></option>
									<?php else:?>
										<option value="<?=$key?>"><?=$row?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
							<label for="form_control_1">Ejderha Simyası Sistemi </label>
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
<?php endif;?>