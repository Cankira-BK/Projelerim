<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"100") == true):?>
<div class="row">
	<div class="col-lg-10 col-md-3 col-sm-6 col-xs-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-key font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">Çevrimdışı Pazar Ayarları </span>
				</div>
			</div>
			<div class="portlet-body form">
				<form role="form" id="offshopconfig" action="<?=URI::get_path('ssh/offshopconfig');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="maxpazar" value="<?=SSHConnect::explode_line("OFFLINE_SHOP_CONFIG","OFFLINE_SHOP_TOTAL_COUNT");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">Max Pazar Sayısı </label>
							<span class="help-block">Lütfen maximum pazar limitini giriniz. Default: 500</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="oneprice" value="<?=SSHConnect::explode_line("OFFLINE_SHOP_CONFIG","OFFLINESHOP_ONE_PRICE");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">1 Saatlik Pazar Ücreti (Yang)</label>
							<span class="help-block">Lütfen default değerdeki gibi noktasız ve boşluksuz giriniz. Default: 5000000</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="twoprice" value="<?=SSHConnect::explode_line("OFFLINE_SHOP_CONFIG","OFFLINESHOP_TWO_PRICE");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">4 Saatlik Pazar Ücreti (Yang)</label>
							<span class="help-block">Lütfen default değerdeki gibi noktasız ve boşluksuz giriniz. Default: 15000000</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="threeprice" value="<?=SSHConnect::explode_line("OFFLINE_SHOP_CONFIG","OFFLINESHOP_THREE_PRICE");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">8 Saatlik Pazar Ücreti (Yang)</label>
							<span class="help-block">Lütfen default değerdeki gibi noktasız ve boşluksuz giriniz. Default: 20000000</span>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="fourprice" value="<?=SSHConnect::explode_line("OFFLINE_SHOP_CONFIG","OFFLINESHOP_FOUR_PRICE");?>" class="form-control" id="form_control_1">
							<label for="form_control_1">Süresiz Pazar Ücreti (Yang)</label>
							<span class="help-block">Lütfen default değerdeki gibi noktasız ve boşluksuz giriniz. Default: 50000000</span>
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