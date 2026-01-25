<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"90") == true):?>
	<?php
	$captchaStatus = ['0'=>'Pasif','1'=>'Aktif'];
	?>
	<div class="row">
		<div class="col-md-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-key font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase">Piyasa Kontrol Eşya Ekle </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="captchaedit" role="form" action="<?=URI::get_path('sql/offpriceadd');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" name="itemvnum" class="form-control" id="form_control_1">
                                <label for="form_control_1">Eşya Kodu </label>
                                <span class="help-block">Lütfen kontrole eklenecek eşya kodunu giriniz...</span>
                            </div>
							<div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" name="itemprice" class="form-control" id="form_control_1">
                                <label for="form_control_1">Min Fiyatı </label>
                                <span class="help-block">Lütfen eşya için minimum fiyatı giriniz...</span>
                            </div>
                        </div>
                        <div class="form-actions noborder">
                            <button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                                <span class="ladda-label">Ekle</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red">
                        <i class="icon-list font-red"></i>
                        <span class="caption-subject bold uppercase">Piyasa Kontrol Eşya Listesi</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column" id="PriceList">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>İsim</th>
                            <th>Minimum Fiyatı</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($this->all as $row):?>
                            <tr>
								<td><img src="<?=URL.'data/items/'.Functions::itemToPng($row['vnum'])?>" onerror="this.src='<?=URL.'data/items/60001.png'?>'" alt="" style="margin-bottom :32px"></td>
								<td><?=Functions::itemToNames($row['vnum']);?> (<?=$row['vnum'];?>)</td>
                                <td><?=$row['min_price'];?> Yang</td>
                                <td>
                                    <div class="margin-bottom-5 text-center">
                                        <a href="<?=URI::get_path('sql/offpricedelete/'.$row['vnum'])?>" class="btn btn-icon-only dark text-center">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
						<?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
<?php endif;?>