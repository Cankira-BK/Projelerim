<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"80") == true):?>
<style type="text/css">
  .numara{
  width: 100px;
  margin-left: 20px;
  }
</style>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-link font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> Efsun Yönetimi </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form class="form-inline" role="form" action="<?=URI::get_path('site/landing3');?>" method="post">
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="guczeka" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","guczeka","ayar_id")?>">
							<input type="text" name="guczeka2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","guczeka2","ayar_id")?>">
							<input type="text" name="guczeka3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","guczeka3","ayar_id")?>">
							<label>Güç-Zeka-Canlılık Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="maxhp" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","maxhp","ayar_id")?>">
							<input type="text" name="maxhp2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","maxhp2","ayar_id")?>">
							<input type="text" name="maxhp3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","maxhp3","ayar_id")?>">
							<label>Max. HP Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="maxsp" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","maxsp","ayar_id")?>">
							<input type="text" name="maxsp2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","maxsp2","ayar_id")?>">
							<input type="text" name="maxsp3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","maxsp3","ayar_id")?>">
							<label>Max. SP Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="shizi" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","shizi","ayar_id")?>">
							<input type="text" name="shizi2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","shizi2","ayar_id")?>">
							<input type="text" name="shizi3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","shizi3","ayar_id")?>">
							<label>Saldırı Hızı Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="hhizi" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","hhizi","ayar_id")?>">
							<input type="text" name="hhizi2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","hhizi2","ayar_id")?>">
							<input type="text" name="hhizi3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","hhizi3","ayar_id")?>">
							<label>Hareket Hızı Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="bhizi" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","bhizi","ayar_id")?>">
							<input type="text" name="bhizi2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","bhizi2","ayar_id")?>">
							<input type="text" name="bhizi3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","bhizi3","ayar_id")?>">
							<label>Büyü Hızı Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="hpspuretimi" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","hpspuretimi","ayar_id")?>">
							<input type="text" name="hpspuretimi2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","hpspuretimi2","ayar_id")?>">
							<input type="text" name="hpspuretimi3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","hpspuretimi3","ayar_id")?>">
							<label>Hp-Sp Üretimi Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="zsy" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","zsy","ayar_id")?>">
							<input type="text" name="zsy2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","zsy2","ayar_id")?>">
							<input type="text" name="zsy3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","zsy3","ayar_id")?>">
							<label>Zehirleme-Sersemletme Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="kritdel" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","kritdel","ayar_id")?>">
							<input type="text" name="kritdel2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","kritdel2","ayar_id")?>">
							<input type="text" name="kritdel3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","kritdel3","ayar_id")?>">
							<label>Kritik-Delici Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="yari" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","yari","ayar_id")?>">
							<input type="text" name="yari2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","yari2","ayar_id")?>">
							<input type="text" name="yari3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","yari3","ayar_id")?>">
							<label>Yarı İnsanlara Karşı Güç Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="buyu" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","buyu","ayar_id")?>">
							<input type="text" name="buyu2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","buyu2","ayar_id")?>">
							<input type="text" name="buyu3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","buyu3","ayar_id")?>">
							<label>Büyüye Karşı Dayanıklılık Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="misolumsuz" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","misolumsuz","ayar_id")?>">
							<input type="text" name="misolumsuz2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","misolumsuz2","ayar_id")?>">
							<input type="text" name="misolumsuz3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","misolumsuz3","ayar_id")?>">
							<label>Mistik-Ölümsüz-Şeytan Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
						</div>
					</div>
					<div class="form-body">
						<div class="form-group mx-sm-4 mb-4 form-md-line-input">
							<br><input type="text" name="savunma" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","savunma","ayar_id")?>">
							<input type="text" name="savunma2" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","savunma2","ayar_id")?>">
							<input type="text" name="savunma3" class="form-control" value="<?=\StaticDatabase\StaticDatabase::gettable("index_efsun","savunma3","ayar_id")?>">
							<label>Savunma Oranları</label>
							<span class="help-block">1, 2, ve 3. aşamada gelen efsunları sırasıyla yazın.</span>
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

<?php endif;?>