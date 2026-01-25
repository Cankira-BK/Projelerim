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
					<span class="caption-subject font-green bold uppercase">Sunucu Yönetimi</span>
				</div>
			</div>
			<div class="portlet-body form">
				<?php
						$cError = Session::get('cError');
						if($cError == 'ch1'){
							echo Functions::alert_admin('success',"Oyun 1 CH olarak başlatılmıştır.");
							Session::set('cError',false);
						}elseif($cError == 'ch2'){
							echo Functions::alert_admin('success',"Oyun 2 CH olarak başlatılmıştır.");
							Session::set('cError',false);
						}elseif($cError == 'ch3'){
							echo Functions::alert_admin('success',"Oyun 3 CH olarak başlatılmıştır.");
							Session::set('cError',false);
						}elseif($cError == 'ch4'){
							echo Functions::alert_admin('success',"Oyun 4 CH olarak başlatılmıştır.");
							Session::set('cError',false);
						}elseif($cError == 'stopch'){
							echo Functions::alert_admin('info',"Oyun kanalları kapatılmıştır.");
							Session::set('cError',false);
						}elseif($cError == 'stopauth'){
							echo Functions::alert_admin('info',"Oyun girişleri kapatılmıştır.");
							Session::set('cError',false);
						}elseif($cError == 'stopdb'){
							echo Functions::alert_admin('info',"Oyun db kapatılmıştır.");
							Session::set('cError',false);
						}elseif($cError == 'ssh2logout'){
							echo Functions::alert_admin('error',"SSH2 Bağlantısı başarısız, şifre hatalı olabilir lütfen kontrol ediniz!");
							Session::set('cError',false);
						}elseif($cError == 'error'){
							echo Functions::alert_admin('warning',"İşlem sırasında hata oluştu, tekrar deneyiniz.");
							Session::set('cError',false);
						}
						?>
				<div id="themeList" class="mt-element-card mt-element-overlay">
					<div class="row">
						<form role="form" id="freeSellForm" action="<?=URI::get_path('ssh/server')?>" method="post" >
							<div class="form-body">
								<div id="1" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="mt-card-item">
										<div class="mt-card-avatar mt-overlay-1">
											<img src="<?=URL.'data/extra/start.png'?>" style="height :100px">
											<div class="mt-overlay">
												<ul class="mt-info">
													<li>
														<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
													</li>
												</ul>
											</div>
										</div>
										<div class="mt-card-content">
											<h3 class="mt-card-name">Oyunu Başlat</h3>
											<div class="mt-card-social">
												<ul>
													<li><button type="submit" class="btn btn-primary" name="action" value="start1">1 CH</button></li>
													<li><button type="submit" class="btn btn-primary" name="action" value="start2">2 CH</button></li>
													<li><button type="submit" class="btn btn-primary" name="action" value="start3">3 CH</button></li>
													<li><button type="submit" class="btn btn-primary" name="action" value="start4">4 CH</button></li>
													<small class="help-block">Lütfen ch açmadan önce kanalların kapalı olduğuna emin olunuz!</span>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div id="1" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="mt-card-item">
										<div class="mt-card-avatar mt-overlay-1">
											<img src="<?=URL.'data/extra/stop.png'?>" style="height :100px">
											<div class="mt-overlay">
												<ul class="mt-info">
													<li>
														<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
													</li>
												</ul>
											</div>
										</div>
										<div class="mt-card-content">
											<h3 class="mt-card-name">Oyunu Durdur</h3>
											<div class="mt-card-social">
												<ul>
													<li><button type="submit" class="btn btn-primary" name="action" value="stopch">Kanallar</button></li>
													<li><button type="submit" class="btn btn-primary" name="action" value="stopauth">Giriş</button></li>
													<li><button type="submit" class="btn btn-primary" name="action" value="stopdb">DB</button></li>
													<small class="help-block">DB kapatma işlemini kanalları ve girişleri kapattıktan 5 dakika sonra yapmanızı tavsiye ederiz.</span>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<div id="1" class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="mt-card-item">
										<div class="mt-card-avatar mt-overlay-1">
											<img src="<?=URL.'data/extra/reboot.png'?>" style="height :100px">
											<div class="mt-overlay">
												<ul class="mt-info">
													<li>
														<a class="btn default btn-outline"><i class="icon-magnifier"></i></a>
													</li>
												</ul>
											</div>
										</div>
										<div class="mt-card-content">
											<h3 class="mt-card-name">Reboot At</h3>
											<div class="mt-card-social">
												<ul>
													<li><button type="submit" class="btn btn-primary" name="action" value="reboot">Seç</button></li>
													<small class="help-block">Bu işlemi uyguladığınızda panel erişimi kesilecektir. Sunucu açıldığında panele bağlanabilirsiniz.</span>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif;?>