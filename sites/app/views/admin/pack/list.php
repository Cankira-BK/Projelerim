<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"71") == true):?>
<?php
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
					<span class="caption-subject bold uppercase">Pack Listesi</span>
				</div>
				<div class="tools"> </div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
					<thead>
					<tr>
						<th>#</th>
						<th>İsmi</th>
						<th>Boyutu</th>
						<th>Kaynak</th>
						<th>İşlem</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($this->all as $key => $row):?>
						<tr>
							<td><?=$key+1?></td>
							<td><?=$row['name']?></td>
							<td><?=$row['size']?></td>
							<td><img src="../.<?=$row['image']?>" alt="" width="75px;"></td>
							<td>
                                <div class="margin-bottom-5 text-center">
									<a href="<?=URI::get_path('pack/delete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
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
<?php endif;?>