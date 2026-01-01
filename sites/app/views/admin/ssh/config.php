<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"100") == true):?>
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
					<span class="caption-subject font-green bold uppercase">Config Yönetimi</span>
				</div>
			</div>
			<div class="portlet-body">
				<div id="themeList" class="mt-element-card mt-element-overlay">
					<div class="row" id="manuelyenileme">
						
						<div id="1" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="mt-card-item">
								<div class="mt-card-avatar mt-overlay-1">
									<img src="<?=URL.'data/extra/offshop.png'?>" style="height :200px; width :300px">
									<div class="mt-overlay">
										<ul class="mt-info">
											<li>
												<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="mt-card-content">
									<h3 class="mt-card-name">Çevrimdışı Pazar Ayarları</h3>
									<div class="mt-card-social">
										<ul>
											<li><button type="button" class="btn btn-primary" onclick="window.location.href='<?=URI::get_path('ssh/offshop_config')?>';">Seç</button></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div id="1" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="mt-card-item">
								<div class="mt-card-avatar mt-overlay-1">
									<img src="<?=URL.'data/extra/systemcf.png'?>" style="height :200px; width :300px">
									<div class="mt-overlay">
										<ul class="mt-info">
											<li>
												<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="mt-card-content">
									<h3 class="mt-card-name">Sistem Ayarları</h3>
									<div class="mt-card-social">
										<ul>
											<li><button type="button" class="btn btn-primary" onclick="window.location.href='<?=URI::get_path('ssh/system_config')?>';">Seç</button></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div id="1" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="mt-card-item">
								<div class="mt-card-avatar mt-overlay-1">
									<img src="<?=URL.'data/extra/notxt.png'?>" style="height :200px; width :300px">
									<div class="mt-overlay">
										<ul class="mt-info">
											<li>
												<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
											</li>
										</ul>
									</div>
								</div>
								<div class="mt-card-content">
									<h3 class="mt-card-name">DB Ayarları</h3>
									<div class="mt-card-social">
										<ul>
											<li><button type="button" class="btn btn-primary" onclick="window.location.href='<?=URI::get_path('ssh/notxt')?>';">Seç</button></li>
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

</div>
<?php endif;?>