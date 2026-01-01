<?php
$getItem = $this->item['result'][0];
$file = "./data/items/".Functions::itemToPng($getItem['vnum']);
if(file_exists($file)){
	$setItemImage = Functions::itemToPng($getItem['vnum']);
}
else{
	$setItemImage = '60001.png';
}

$itemDesc = isset($this->item['item_desc']) ? $this->item['item_desc'] : null;
?>

<div class="row">
	<div class="col-md-12">
		<form id="itemAdd" class="form-horizontal form-row-seperated" action="<?=URI::get_path('product/wheel_itemadd/'.$getItem['vnum']);?>" method="POST">
			<div class="portlet">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-long-arrow-right"></i><?=Functions::utf8($getItem['locale_name']);?> </div>
					<div class="actions btn-set">

						<button class="btn btn-success" id="itemAddButton" type="submit">
							<i class="fa fa-check-circle"></i>  Kaydet</button>
					</div>
				</div>
				<div class="portlet-body">
					<div class="tabbable-bordered">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#tab_general" data-toggle="tab"> Genel Özellikleri </a>
							</li>
							<li>
								<a href="#tab_meta" data-toggle="tab"> Efsunlar ve Taşlar </a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_general">
								<div class="form-body">
									<div class="form-group" style="margin-bottom: 30px;">
										<label class="col-md-2 control-label">Eşya Resmi:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<img id="myItem" src="<?=URL.'data/items/'.$setItemImage;?>" alt="">
											<a class="btn red btn-circle btn-outline sbold" data-toggle="modal" href="#responsive"><i class="fa fa-image"></i> Değiştir </a>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Eşya Adı:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<input type="text" class="form-control" name="itemName" value="<?=Functions::utf8($getItem['locale_name']);?>" placeholder="">
											<input id="itemimage" type="hidden" class="form-control" name="itemImage" value="items/<?=$setItemImage;?>">
											<span class="help-block"> Eşyanın adını dilerseniz değiştirebilirsiniz... </span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Miktar :
											<span class="required"> * </span>
										</label>
										<div class="col-md-5">
											<input type="number" class="form-control" name="count" placeholder="" value="1">
											<span class="help-block"> Eşya miktarı </span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Süreli Eşya  :
											<span class="required"> * </span>
										</label>
										<div class="col-md-8">
											<div class="md-checkbox-list">
												<div class="md-checkbox has-info">
													<input type="hidden" name="time" class="md-check" value="0">
													<input type="checkbox" name="time" id="checkbox2" class="md-check" value="1" >
													<label for="checkbox2">
														<span></span>
														<span class="check"></span>
														<span class="box"></span><i style="color: red;" id="checkbox2Text"> Eşya Süreli Değil ! </i> </label>
												</div>
											</div>
											<span class="help-block"> Ekleyeceğiniz eşya süreli ise bunu işaretlemelisiniz ! Aşağıya manuel süre yazabilir ya da boş bırakarak item'in oyundaki süresi otomatik çekilir</span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Süresi :
											<span class="required"> * </span>
										</label>
										<div class="col-md-3">
											<input type="number" class="form-control" name="day" placeholder="Gün" value="0">
											<span class="help-block"> Eşya Kaç Günlük </span>
										</div>
										<div class="col-md-3">
											<input type="number" class="form-control" name="hour" placeholder="Saat" value="0">
											<span class="help-block"> Eşya Kaç Saatlik </span>
										</div>
										<div class="col-md-3">
											<input type="number" class="form-control" name="second" placeholder="Dakika" value="0">
											<span class="help-block"> Eşya Kaç Dakikalık </span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Eşya Açıklaması:</label>
										<div class="col-md-10">
											<textarea class="form-control maxlength-handler" rows="8" name="description" required><?=$itemDesc?></textarea>
											<span class="help-block"> Eşya Açıklamasını Giriniz  </span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Eşya Bilgisi:</label>
										<div class="col-md-10">
											<textarea class="form-control maxlength-handler" rows="8" name="information" required><?=$itemDesc?></textarea>
											<span class="help-block"> Eşya Bilgisini Giriniz (Max. 100) </span>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab_meta">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-2 control-label">Efsun #1 Türü:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="attrType1" style="display: inline;">
												<?php $efsun = Functions::gameIn('efsunlar');?>
												<?php foreach ($efsun as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
											<input type="number" class="form-control input-small" name="attrValue1" placeholder="Efsun Değeri" style="display: inline-block;position: absolute;margin-left: 30px;">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Efsun #2 Türü:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="attrType2" style="display: inline;">
												<?php foreach ($efsun as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
											<input type="number" class="form-control input-small" name="attrValue2" placeholder="Efsun Değeri" style="display: inline-block;position: absolute;margin-left: 30px;">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Efsun #3 Türü:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="attrType3" style="display: inline;">
												<?php foreach ($efsun as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
											<input type="number" class="form-control input-small" name="attrValue3" placeholder="Efsun Değeri" style="display: inline-block;position: absolute;margin-left: 30px;">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Efsun #4 Türü:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="attrType4" style="display: inline;">
												<?php foreach ($efsun as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
											<input type="number" class="form-control input-small" name="attrValue4" placeholder="Efsun Değeri" style="display: inline-block;position: absolute;margin-left: 30px;">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Efsun #5 Türü:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="attrType5" style="display: inline;">
												<?php foreach ($efsun as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
											<input type="number" class="form-control input-small" name="attrValue5" placeholder="Efsun Değeri" style="display: inline-block;position: absolute;margin-left: 30px;">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Efsun #6 Türü:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="attrType6" style="display: inline;">
												<?php foreach ($efsun as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
											<input type="number" class="form-control input-small" name="attrValue6" placeholder="Efsun Değeri" style="display: inline-block;position: absolute;margin-left: 30px;">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Efsun #7 Türü:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="attrType7" style="display: inline;">
												<?php foreach ($efsun as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
											<input type="number" class="form-control input-small" name="attrValue7" placeholder="Efsun Değeri" style="display: inline-block;position: absolute;margin-left: 30px;">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Slot #1:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="socket0" style="display: inline;">
												<?php $taslar = Functions::gameIn('taslar');?>
												<?php foreach ($taslar as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Slot #2:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="socket1" style="display: inline;">
												<?php foreach ($taslar as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2 control-label">Slot #3:
											<span class="required"> * </span>
										</label>
										<div class="col-md-10">
											<select class="table-group-action-input form-control input-xlarge" name="socket2" style="display: inline;">
												<?php foreach ($taslar as $key=>$row):?>
													<option value="<?=$key?>"><?=$row?></option>
												<?php endforeach;?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog" style="width: 500px;">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
						<h4 class="modal-title">Eşya Resmini Değiştir</h4>
					</div>
					<div class="modal-body">
						<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6">
									<form id="logoSetting" action="<?=URI::get_path('product/wheel_imageupload/'.$getItem['vnum']);?>" class="form-horizontal form-bordered" enctype="multipart/form-data">
										<div class="form-body" style="margin-left: 15px;">
											<div class="form-group ">
												<div class="col-md-12">
													<div class="fileinput fileinput-new" data-provides="fileinput">
														<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
														<div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> Resim Seç </span>
                                                                    <span class="fileinput-exists"> Değiştir </span>
                                                                    <input type="file" name="logo" id="logo" multiple class="file" data-preview-file-type="any"/> </span>
															<a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Sil </a>
															<button id="imgUpload" class="btn green fileinput-exists" > Yükle </button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function () {
        var dadad = 1;

        $('#imgUpa').click(function () {
            if(dadad == 1){
                $('#imgU').fadeIn();
                dadad = 0;
            }else{
                $('#imgU').fadeOut();
                dadad = 1;
            }

        });
        $('#imgUpload').click(function (eve) {
            eve.preventDefault();
            var url = $('#logoSetting').attr('action');
            var data = new FormData($('#logoSetting')[0]);
            var base_url = window.location.origin;
            var pathArray = window.location.pathname.split( '/' );
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    if(result.result == false){
                        if(result.message == 'empty'){
                            notify('error',"İlk önce eşyayı kayıt edin");
                        }else if(result.message == 'error'){
                            notify('error',"Başka bir resim kullanın");
                        }
                    }else if(result.result == true){
                        notify('success',"Eşya resmi başarıyla güncellendi");
                        var paths = window.location.pathname;
                        var protocol = window.location.protocol;
                        var host = window.location.host;
                        var path = paths.split('/')[1];
                        document.getElementById('myItem').src = protocol+'//'+host+'/'+path+'/'+result.message
                    }
                }
            });
        });
        $('#checkbox1').change(function () {
            if($(this).is(":checked")) {
                $('#checkbox1Text').text('Aktif');
                $('#checkbox1Text').css('color','blue');
            }else{
                $('#checkbox1Text').text('Pasif');
                $('#checkbox1Text').css('color','red');
            }
        });
        $('#checkbox2').change(function () {
            if($(this).is(":checked")) {
                $('#checkbox2Text').text('Eşya Süreli !');
                $('#checkbox2Text').css('color','blue');
            }else{
                $('#checkbox2Text').text('Eşya Süreli Değil !');
                $('#checkbox2Text').css('color','red');
            }
        });
        $('#itemAdd').submit(function (event) {
            event.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: data,
                processData: false,
                success: function(result){
                    if(result.result === true){
                        notify('success',"İtem başarıyla eklendi.");
                    }else{
                        notify('error',result.message);
                    }
                }
            });
        });
    });
</script>