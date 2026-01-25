<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase">Tüm Hesaplar</span>
				</div>
				<div class="tools"> </div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover order-column" id="allList">
					<thead>
					<tr>
						<th>ID</th>
						<th>Kullanıcı Adı</th>
						<th>İsim Soyisim</th>
						<th>Email</th>
						<th>Telefon</th>
						<th>EP</th>
						<th>EM</th>
						<th>Durum</th>
						<th>İşlem</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($this->all as $key=>$row):?>
						<tr>
							<td><?=$row['id'];?></td>
							<td><?=$row['login'];?></td>
							<td><?=$row['real_name'];?></td>
							<td><?=$row['email'];?></td>
							<td><?=$row['phone1'];?></td>
							<td><?=$row[CASH];?></td>
							<td><?=$row[MILEAGE];?></td>
							<td><?=$row['status'];?></td>
							<td><div class="margin-bottom-5 text-center">
									<a href="<?=URI::get_path('account/account/'.$row['id'])?>" target="_blank" class="btn btn-icon-only primary text-center">
										<i class="fa fa-eye"></i>
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
