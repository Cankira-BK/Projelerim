<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"58") == true):?>
	<?php
	$captchaStatus = ['0'=>'Pasif','1'=>'Aktif']
	?>
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-ticket font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Ticket Ayarları </span>
					</div>
				</div>
				<div class="portlet-body form">
					<form id="paywantedit" role="form" action="<?=URI::get_path('setting/ticketedit');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('ticket_status')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Ticket Durum </label>
							</div>
							<div class="form-group form-md-line-input form-md-floating-label">
								<select class="form-control edited" name="mail_status">
									<?php foreach ($captchaStatus as $key=>$row):?>
										<?php if ($key == \StaticDatabase\StaticDatabase::settings('ticket_mail')):?>
											<option value="<?=$key?>" selected><?=$row?></option>
										<?php else:?>
											<option value="<?=$key?>"><?=$row?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
								<label for="form_control_1">Ticket Mail Gönderimi (Oyuncu ticket gönderdiğinde ticket ayrıntıları mail hesabına gönderilir) </label>
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
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN SAMPLE FORM PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-ticket font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Ticket Konu Başlığı Ekle </span>
					</div>
				</div>
				<div class="portlet-body form">
					<form role="form" action="<?=URI::get_path('setting/ticketcategory');?>" method="post">
						<div class="form-body">
							<div class="form-group form-md-line-input form-md-floating-label">
								<input type="text" name="ticket_category" class="form-control" id="form_control_1">
								<label for="form_control_1">Ticket Konu Başlığı  </label>
								<span class="help-block">Lütfen oluşturmak istediğiniz konu başlığını giriniz...</span>
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
	<div class="row">
		<div class="col-md-9">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-red-sunglo">
						<i class="fa fa-ticket font-red-sunglo"></i>
						<span class="caption-subject bold uppercase"> Ticket Konu Başlığı Listesi </span>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
						<thead>
						<tr>
							<th>#</th>
							<th>Başlık</th>
							<th>İşlem</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($this->title as $key => $row):?>
							<tr>
								<td><?=$key+1?></td>
								<td><?=$row['title']?></td>
								<td>
									<div class="margin-bottom-5 text-center">
										<a href="<?=URI::get_path('setting/ticketdelete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
											<i class="fa fa-times"></i>
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
        $('#paywantedit').submit(function (eve) {
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
                success: function (result) {
                    if (result.result === true)
                        notify('success','Güncelleme Başarılı');
                    else
                        notify('error','Bir Hata Oluştu');
                }
            });
        });
	</script>
<?php endif;?>