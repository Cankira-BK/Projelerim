<div class="row">
    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"7") == true):?>
	<?php $efsun = Functions::gameIn('efsunlar');?>
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="fa fa-barcode font-green"></i>
                    <span class="caption-subject bold uppercase"> Bonus Ekle</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="BonusAddShop" role="form" action="<?=URI::get_path('product/bonusadd');?>" method="post">
                    <div class="form-group">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <select class="table-group-action-input form-control input-xlarge" name="wear_flag">
								<option value="weapon">Silah</option>
								<option value="armor">Zırh</option>
								<option value="wrist">Bileklik</option>
								<option value="foots">Ayakkabı</option>
								<option value="neck">Kolye</option>
								<option value="head">Kafalık</option>
								<option value="shield">Kalkan</option>
								<option value="ear">Yüzük</option>
								<option value="costume_body">Kostüm</option>
								<option value="costume_weapon">Kostüm Silah</option>
								<option value="costume_hair">Kostüm Saç</option>
								<option value="costume_mount">Binek</option>
								<option value="costume_pet">Pet</option>
								<option value="costume_pendant">Tılsım</option>
								<option value="other">Diğer</option>
                            </select>
                            <label for="form_control_1">Tür Seç</label>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <select class="table-group-action-input form-control input-xlarge" name="apply">
								<?php foreach ($efsun as $key=>$row):?>
									<option value="<?=$key?>"><?=$row?></option>
								<?php endforeach;?>
                            </select>
                            <label for="form_control_1">Bonus Seç</label>
                        </div>
                    </div>
					<div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" id="BonusRate" name="rate" class="form-control" required>
                            <label for="form_control_1">Bonus Oranı</label>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" name="sub" class="btn blue">Bonus Ekle</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
    <?php endif;?>
</div>
<script>
    $(document).ready(function () {
        $('#BonusAddShop').submit(function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var link = $(this).attr('action');
            $.post(link,data,function () {
                notify('success',"Bonus Listeye eklendi!");
                $('#BonusRate').val('');
            });
        });
    });
</script>