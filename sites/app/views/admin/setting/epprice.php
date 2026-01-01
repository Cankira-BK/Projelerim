<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"30") == true):?>
<?php
if(Session::get('changeOK') == true){
	echo '<script>$(document).ready(function() {
  notify("success","İşlem başarılı");
});</script>';
	Session::set('changeOK',false);
}
?>
<div class="row">
	<div class="col-md-9">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-try font-red-sunglo"></i>
					<span class="caption-subject bold uppercase"> EP-TL Ayarları </span>
				</div>
			</div>
			<div class="portlet-body form">
				Buradan kaç ep'in kaç tl olacağını belirleyiniz...
				<form role="form" action="<?=URI::get_path('setting/eppriceadd');?>" method="post">
					<div class="form-body">
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="ep" class="form-control">
							<label for="form_control_1">EP </label>
						</div>
						<div class="form-group form-md-line-input form-md-floating-label">
							<input type="text" name="tl" class="form-control">
							<label for="form_control_1">TL </label>
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
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase">EP-TL Listesi</span>
				</div>
				<div class="tools"> </div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
					<thead>
					<tr>
						<th>#</th>
						<th>EP Miktarı</th>
						<th>TL Tutarı</th>
						<th>Sil</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($this->all as $key=>$row):?>
						<tr>
							<td><?=$key+1?></td>
							<td><?=$row['ep'];?></td>
							<td><?=$row['tl'];?></td>
							<td><div class="margin-bottom-5 text-center">
									<a href="<?=URI::get_path('setting/epdelete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
										<i class="fa fa-trash"></i>
									</a>
								</div></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif;?>