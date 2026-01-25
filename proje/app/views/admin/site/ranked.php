<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"78") == true):?>
	<?php
	$captchaStatus = ['0'=>'Pasif','1'=>'Aktif']
	?>
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-cc-visa font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Oyuncu Sıralama Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="settingedit" role="form" autocomplete="off" action="<?=URI::get_path('site/rankedplayeredit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('player_rank_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Oyuncu Sıralama Durumu </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="number" name="count" class="form-control" maxlength="2" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('player_rank')?>">
								<label for="form_control_1">Max Oyuncu Sıralama Sayısı </label>
								<span class="help-block">Önerilen değer : 20</span>
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
						<i class="fa fa-cc-visa font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Lonca Sıralama Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="settingedit2" role="form" autocomplete="off" action="<?=URI::get_path('site/rankedguildedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('guild_rank_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Lonca Sıralama Durumu </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="number" name="count" class="form-control" maxlength="2" id="form_control_1" value="<?=\StaticDatabase\StaticDatabase::settings('guild_rank')?>">
								<label for="form_control_1">Max Lonca Sıralama Sayısı </label>
								<span class="help-block">Önerilen değer : 20</span>
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
	</script>
<?php endif;?>