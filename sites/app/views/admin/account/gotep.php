<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"40") == true):?>
	<?php
	/**
	 * Created by PhpStorm.
	 * User: User
	 * Date: 17.11.2016
	 * Time: 08:28
	 */
	if(Session::get('changeOK') == true){
		echo '<script>$(document).ready(function() {
  notify("success","İşlem başarılı");
});</script>';
		Session::set('changeOK',false);
	}
	?>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold uppercase">Epi Olan Hesaplar</span>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
						<thead>
						<tr>
							<th>#</th>
							<th>id</th>
							<th>Kullanıcı Adı</th>
							<th>Ep Miktarı</th>
							<th>Ep'i Sil</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($this->ep as $key=>$row):?>
							<tr>
								<td><?=$key+1?></td>
								<td><?=$row['id'];?></td>
								<td><?=$row['login'];?></td>
								<td><?=$row[CASH];?></td>
								<td><div class="margin-bottom-5 text-center">
										<a href="<?=URI::get_path('account/epdelete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
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