<?php if (\StaticDatabase\StaticDatabase::settings('socket_status') == 0):?>
	<b style="color: darkred">Bu işlemi gerçekleştirebilmem için <a href="<?=URI::get_path('setting/socket')?>">buradan</a> oyununuzun socket bağlantısını gerçekleştirmeniz gerekiyor...</b>
<?php else:?>
	<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"52") == true):?>
		<div class="row">
			<div class="col-md-6 ">
				<!-- BEGIN SAMPLE FORM PORTLET-->
				<div class="portlet light bordered">
					<div class="portlet-title">
						<div class="caption font-red">
							<i class="fa fa-gift font-red"></i>
							<span class="caption-subject bold uppercase"> Dropları Aç </span>
						</div>
					</div>
					<div class="portlet-body form">
						<form id="dropOpen" role="form" action="<?=URI::get_path('socket/drop_open');?>" method="post">
							<div class="form-body">
								<div class="form-group form-md-line-input form-md-floating-label">
									<select class="form-control edited" name="flag">
										<option value="0">Tüm Bayraklar</option>
										<option value="1">Kırmızı Bayrak</option>
										<option value="2">Sarı Bayrak</option>
										<option value="3">Mavi Bayrak</option>
									</select>
									<label for="form_control_1">Bayrak Seçiniz </label>
								</div>
								<div class="form-group form-md-line-input form-md-floating-label">
									<select class="form-control edited" name="type">
										<option value="0">Tüm Droplar</option>
										<option value="1">İtem Drop</option>
										<option value="2">Gold Drop</option>
										<option value="3">Gold10 Drop</option>
										<option value="4">Exp Drop</option>
									</select>
									<label for="form_control_1">Drop Türü Seçiniz </label>
								</div>
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <input type="text" id="time" name="percent" class="form-control" required>
                                    <label for="form_control_1">Oran</label>
                                    <span class="help-block">Açmak İstediğiniz Drop Oranı</span>
                                </div>
								<div class="form-group form-md-line-input form-md-floating-label">
									<input type="text" id="time" name="time" class="form-control" required>
									<label for="form_control_1">Süre</label>
									<span class="help-block">Drop Süresi (Saat olarak hesaplanır)</span>
								</div>
							</div>
							<div class="form-actions noborder">
								<!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
								<button type="submit" class="btn red mt-ladda-btn ladda-button" data-style="contract">
									<span class="ladda-label">Drop Aç</span>
								</button>
							</div>
						</form>
					</div>
				</div>
				<!-- END SAMPLE FORM PORTLET-->
			</div>
		</div>
		<script>
            $(document).ready(function () {
                $('#dropOpen').submit(function (event) {
                    event.preventDefault();
                    var data = $(this).serialize();
                    var url = $(this).attr('action');
                    $.ajax({
                        url: url,
                        dataType: 'json',
                        type: 'post',
                        data: data,
                        processData: false,
                        success: function(result){
                            if (result === false){
                                notify('error',"Lütfen Bilgileri Kontrol Ediniz!");
                            }else if(result === true){
                                notify('success',"Belirlediğiniz drop açıldı!");
                            }
                        },
                        error: function( jqXhr, textStatus, errorThrown ){
                            console.log( errorThrown );
                        }
                    });
                });
            });
		</script>
	<?php endif;?>
<?php endif;?>