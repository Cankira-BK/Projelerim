<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"79") == true):?>
	<?php
	$captchaStatus = ['0'=>'Pasif','1'=>'Aktif'];
	?>
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-key font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Kayıt Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="settingedit" role="form" autocomplete="off" action="<?=URI::get_path('site/registeredit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('register_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Kayıt Durumu </label>
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

            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-gift font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Bonus EP </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <span> <b style="color: red">Uyarı : </b> <b>Bu özellik ile kayıt olan herkese EP belirlediğiniz miktarda EP verebilirsiniz.</b></span>
                    <form id="registerGiftEdit" role="form" autocomplete="off" action="<?=URI::get_path('site/registergift');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('register_gift_status')):?>
                                            <option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
                                            <option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Bonus EP Durumu </label>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="number" name="gift" class="form-control" value="<?=\StaticDatabase\StaticDatabase::settings('register_gift_count')?>">
                                <label for="form_control_1">Bonus EP Miktarı </label>
                                <span class="help-block">Kayıt olan hesaba ne kadar EP vereceğinizi giriniz...</span>
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

            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-gift font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Drop Ayarları </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <span> <b style="color: red">Uyarı : </b> <b>Bu özellik ile kayıt olan herkese drop verebilirsiniz.</b></span><br>
                    <img src="<?=URI::public_path('layouts/layout/img/shop/drop.png')?>">
                    <form id="registerDropEdit" role="form" autocomplete="off" action="<?=URI::get_path('site/registerdrop');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('register_drop_status')):?>
                                            <option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
                                            <option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Drop Durumu </label>
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

			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-gears font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Kayıt Sorunu </span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="settingedit2" role="form" autocomplete="off" action="<?=URI::get_path('site/registerfix');?>" method="post">
						<p>Panelde kayıt sorunu varsa aşağıdaki "Onar" butonuna basınız. Yoksa lütfen bu butona basmayınız!</p>
						<div class="form-actions noborder">
							<button id="registerFixButton" type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
								<span class="ladda-label">Onar</span>
							</button>
						</div>
					</form>
				</div>
			</div>

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-key font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> "Bizi Nerden Buldunuz?" Durumu </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="findmeEdit" role="form" autocomplete="off" action="<?=URI::get_path('site/findmeedit');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('findme_status')):?>
                                            <option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
                                            <option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
                                </select>
                                <label for="form_control_1">Bizi Nerden Buldunuz? Durumu </label>
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

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-key font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase">"Bizi Nerden Buldunuz?" Ekle </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="captchaedit" role="form" action="<?=URI::get_path('site/findmeadd');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" name="findme" class="form-control" id="form_control_1">
                                <label for="form_control_1">"Bizi Nerden Buldunuz?" Ekle </label>
                                <span class="help-block">Lütfen "Bizi Nerden Buldunuz?" değeri giriniz...</span>
                            </div>
                        </div>
                        <div class="form-actions noborder">
                            <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
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
                        <span class="caption-subject bold uppercase">"Bizi Nerden Buldunuz?" Listesi</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column" id="findMeList">
                        <thead>
                        <tr>
                            <th>İsim</th>
                            <th>Kişi Sayısı</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($this->all as $row):?>
                            <tr>
                                <td><?=$row['name'];?></td>
                                <td><?=$row['total'];?> Kişi</td>
                                <td>
                                    <div class="margin-bottom-5 text-center">
                                        <a href="<?=URI::get_path('site/findmedelete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
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
        $('#settingedit2').submit(function (eve) {
            eve.preventDefault();
            var url = $(this).attr('action')+"?fix=ok";
            $.ajax({
                type: "GET",
                url: url,
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
        $('#findmeEdit').submit(function (eve) {
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
        $('#registerGiftEdit').submit(function (eve) {
            eve.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function (response) {
                    if (!response.result)
                        notify('error',response.message);
                    else
                        notify('success',response.message);
                }
            });
        });
        $('#registerDropEdit').submit(function (eve) {
            eve.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
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