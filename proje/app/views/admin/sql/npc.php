<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"90") == true):?>
<style>
	/* common */
	.ribbon {
		width: 150px;
		height: 150px;
		overflow: hidden;
		position: absolute;
		z-index: 99;
	}
	.ribbon::before,
	.ribbon::after {
		position: absolute;
		z-index: -1;
		content: '';
		display: block;
		border: 5px solid #2980b9;
	}
	.ribbon span {
		position: absolute;
		display: block;
		width: 225px;
		padding: 10px 0;
		background-color: #337ab7;
		box-shadow: 0 5px 10px rgba(0,0,0,.1);
		color: #fff;
		font: 700 15px/1 'Lato', sans-serif;
		text-shadow: 0 1px 1px rgba(0,0,0,.2);
		/* text-transform: uppercase; */
		text-align: center;
	}
	
	/* common */
	.ribbon-r {
		width: 150px;
		height: 150px;
		overflow: hidden;
		position: absolute;
		z-index: 99;
	}
	.ribbon-r::before,
	.ribbon-r::after {
		position: absolute;
		z-index: -1;
		content: '';
		display: block;
		border: 5px solid #2980b9;
	}
	.ribbon-r span {
		position: absolute;
		display: block;
		width: 225px;
		padding: 10px 0;
		background-color: #d02141;
		box-shadow: 0 5px 10px rgba(0,0,0,.1);
		color: #fff;
		font: 700 15px/1 'Lato', sans-serif;
		text-shadow: 0 1px 1px rgba(0,0,0,.2);
		/* text-transform: uppercase; */
		text-align: center;
	}
	
	/* top right*/
	.ribbon-top-right {
		top: -10px;
		right: -10px;
	}
	.ribbon-top-right::before,
	.ribbon-top-right::after {
		border-top-color: transparent;
		border-right-color: transparent;
	}
	.ribbon-top-right::before {
		top: 0;
		left: 0;
	}
	.ribbon-top-right::after {
		bottom: 0;
		right: 0;
	}
	.ribbon-top-right span {
		left: -25px;
		top: 35px;
		transform: rotate(45deg);
	}
	
	/* top left*/
	.ribbon-top-left {
		top: -10px;
		left: -10px;
	}
	.ribbon-top-left::before,
	.ribbon-top-left::after {
		border-top-color: transparent;
		border-left-color: transparent;
	}
	.ribbon-top-left::before {
		top: 0;
		right: 0;
	}
	.ribbon-top-left::after {
		bottom: 0;
		left: 0;
	}
	.ribbon-top-left span {
		right: -25px;
		top: 36px;
		transform: rotate(-45deg);
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light portlet-fit bordered">
			<div class="portlet-title">
				<div class="caption">
					<i class=" icon-layers font-green"></i>
					<span class="caption-subject font-green bold uppercase">NPC İşlemleri</span>
				</div>
			</div>
			<div class="portlet-body">
				<div id="themeList" class="mt-element-card mt-element-overlay">
					<div class="row" id="manuelyenileme">
						
						<div id="1" class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="mt-card-item">
								<div class="mt-card-avatar mt-overlay-1">
									<img src="<?=URL.'data/extra/npcitemekle.png'?>" style="height :100px">
									<div class="mt-overlay">
										<ul class="mt-info">
											<li>
												<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="mt-card-content">
									<h3 class="mt-card-name">NPC İtem Ekle</h3>
									<div class="mt-card-social">
										<ul>
											<li><button type="button" class="btn btn-primary" onclick="window.location.href='<?=URI::get_path('sql/npcitemekle')?>';">Seç</button></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div id="1" class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="mt-card-item">
								<div class="mt-card-avatar mt-overlay-1">
									<img src="<?=URL.'data/extra/npcitemduzenle.png'?>" style="height :100px">
									<div class="mt-overlay">
										<ul class="mt-info">
											<li>
												<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="mt-card-content">
									<h3 class="mt-card-name">NPC İtem Düzenle</h3>
									<div class="mt-card-social">
										<ul>
											<li><button type="button" class="btn btn-primary" onclick="window.location.href='<?=URI::get_path('sql/npcitemduzenle')?>';">Seç</button></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div id="1" class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="mt-card-item">
								<div class="mt-card-avatar mt-overlay-1">
									<img src="<?=URL.'data/extra/npcekle.png'?>" style="height :100px">
									<div class="mt-overlay">
										<ul class="mt-info">
											<li>
												<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="mt-card-content">
									<h3 class="mt-card-name">NPC Ekle</h3>
									<div class="mt-card-social">
										<ul>
											<li><button type="button" class="btn btn-primary" onclick="window.location.href='<?=URI::get_path('sql/npcekle')?>';">Seç</button></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div id="1" class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="mt-card-item">
								<div class="mt-card-avatar mt-overlay-1">
									<img src="<?=URL.'data/extra/npctur.png'?>" style="height :100px">
									<div class="mt-overlay">
										<ul class="mt-info">
											<li>
												<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="mt-card-content">
									<h3 class="mt-card-name">NPC Düzenle</h3>
									<div class="mt-card-social">
										<ul>
											<li><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-npctur-modal-lg">Seç</button></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade bd-npctur-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">NPC Tür Değiştir</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover order-column" id="newsList" >
					<thead>
					<tr>
						<th>Npc Adı</th>
						<th>Npc Türü</th>
						<th>İşlem</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($this->npcliste as $row):?>
						<tr>
							<td><?=Functions::mobToNames($row['npc_vnum']);?></td>
							<td><?=Functions::npc_type($row['npc_type']);?></td>
							<td>
                                <div class="margin-bottom-5 text-center">
                                    <button type="button" class="btn btn-primary" onclick="window.location.href='<?=URI::get_path('sql/npctur/'.$row['vnum'])?>';">Düzenle</button>
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

</div>
<?php endif;?>