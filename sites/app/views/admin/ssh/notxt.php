<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"100") == true):?>
<?php $durumlar = ['0'=>'Pasif','1'=>'Aktif'];?>
<div class="row">
	<div class="col-lg-10 col-md-3 col-sm-6 col-xs-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-key font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">DB Ayar Yönetimi </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" id="offshopconfig" action="<?=URI::get_path('ssh/notxt');?>" method="post">
					<div class="form-group form-md-line-input form-md-floating-label">
						<select class="form-control edited" name="metintas">
							<?php foreach ($durumlar as $key=>$row):?>
								<?php if ($key == SSHConnect::explode_line2("conf.txt","NO_TXT")):?>
									<option value="<?=$key?>" selected><?=$row?></option>
								<?php else:?>
									<option value="<?=$key?>"><?=$row?></option>
								<?php endif;?>
							<?php endforeach;?>
						</select>
						<label for="form_control_1">No TXT Durumu </label>
					</div>
					<div class="form-group form-md-line-input form-md-floating-label">
						<input type="text" name="leveldel" value="<?=SSHConnect::explode_line2("conf.txt","PLAYER_DELETE_LEVEL_LIMIT");?>" class="form-control" id="leveldel">
						<label for="leveldel">Karakter Silme Level Sınırı </label>
						<span class="help-block">Buraya girilen değere ulaşan karakter silinemez duruma gelir.</span>
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