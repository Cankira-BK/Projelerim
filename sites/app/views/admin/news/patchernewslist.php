<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"68") == true):?>
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 05.05.2017
 * Time: 17:06
 */
if(Session::get('changeOK') == true){
	echo '<script>$(document).ready(function() {
  notify("success","İşlem başarılı");
});</script>';
	Session::set('changeOK',false);
}
$Labels = ['1'=>'Etkinlik','2'=>'Güncelleme','3'=>'Bilgi','4'=>'<b>Önemli Bilgi</b>','5'=>'Nesne Market','6'=>'Duyuru'];
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase">Patcher Haber Listesi</span>
				</div>
				<div class="tools"> </div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
					<thead>
					<tr>
						<th>#</th>
						<th>Önek</th>
						<th>Başlık</th>
						<th>İşlem</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($this->patchernewslist as $key => $row):?>
						<tr>
							<td><?=$key+1?></td>
							<td><?=$Labels[$row['label']]?></td>
							<td><?=$row['title']?></td>
							<td><div class="margin-bottom-5 text-center">
									<a href="<?=URI::get_path('news/patcherdelete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
										<i class="fa fa-times"></i>
									</a>
								</div></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase">Patcher Slider Listesi</span>
				</div>
				<div class="tools"> </div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
					<thead>
					<tr>
						<th>#</th>
						<th>Resim</th>
						<th>İşlem</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($this->patchersliderlist as $key => $row):?>
						<tr>
							<td><?=$key+1?></td>
							<td><img src="<?=$row['image']?>" width="400"></td>
							<td><div class="margin-bottom-5 text-center">
									<a href="<?=URI::get_path('news/patcherdelete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
										<i class="fa fa-times"></i>
									</a>
								</div></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-settings font-dark"></i>
					<span class="caption-subject bold uppercase">Patcher Menü Listesi</span>
				</div>
				<div class="tools"> </div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
					<thead>
					<tr>
						<th>#</th>
						<th>Başlık</th>
						<th>URL/Link</th>
						<th>Açıklama</th>
						<th>İşlem</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($this->patcherlinklist as $key => $row):?>
						<tr>
							<td><?=$key+1?></td>
							<td><?=$row['title']?></td>
							<td><a href="<?=$row['url']?>" target="_blank">Link'e Git</a></td>
							<td><?=$row['content']?></td>
							<td><div class="margin-bottom-5 text-center">
									<a href="<?=URI::get_path('news/patcherdelete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
										<i class="fa fa-times"></i>
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