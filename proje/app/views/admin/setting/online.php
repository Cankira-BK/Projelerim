<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"17") == true):?>
	<style>
		.dashboard-stat2 .display .number small {
			text-transform: none;
		}
	</style>
<?php if (\StaticDatabase\StaticDatabase::settings('socket_status') == '1'):?>
	<?php if ($this->online['ch1']['function'] === false):?>
			<b style="color: darkred">Sunucunuz socket gönerimini desteklemiyor. Lütfen php.ini dosyasından extension=php_sockets.dll ya da extension=php_sockets.so dosyasını aktif edip apache serverı yeniden başlatın.</b>
		<?php else: ?>
			<?php
			$data = $this->online;
			$ch1 = ($data["ch1"]['connect'] === true) ? $data["ch1"]["data"] : null;
			$ch2 = ($data["ch2"]['connect'] === true) ? $data["ch2"]["data"] : null;
			$ch3 = ($data["ch3"]['connect'] === true) ? $data["ch3"]["data"] : null;
			$ch4 = ($data["ch4"]['connect'] === true) ? $data["ch4"]["data"] : null;
			?>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2 ">
					<div class="display">
						<?php if ($ch1 === null):?>
							<div class="number">
								<h3 class="font-green-sharp">
									<span data-counter="counterup" data-value="0">CH1</span>
									<small class="font-green-sharp">Kapalı</small>
								</h3>
								<small>Yanıt yok</small>
							</div>
						<?php else:?>
							<div class="number">
								<h3 class="font-green-sharp">
									<span data-counter="counterup" data-value="<?=$ch1?>"><?=$ch1?></span>
									<small class="font-green-sharp">Kişi</small>
								</h3>
								<small>CH 1</small>
							</div>
						<?php endif;?>
						<div class="icon">
							<i class="icon-pie-chart"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2 ">
					<div class="display">
						<?php if ($ch2 === null):?>
							<div class="number">
								<h3 class="font-green-sharp">
									<span data-counter="counterup" data-value="0">CH2</span>
									<small class="font-green-sharp">Kapalı</small>
								</h3>
								<small>Yanıt yok</small>
							</div>
						<?php else:?>
							<div class="number">
								<h3 class="font-green-sharp">
									<span data-counter="counterup" data-value="<?=$ch2?>"><?=$ch2?></span>
									<small class="font-green-sharp">Kişi</small>
								</h3>
								<small>CH 2</small>
							</div>
						<?php endif;?>
						<div class="icon">
							<i class="icon-pie-chart"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2 ">
					<div class="display">
						<?php if ($ch3 === null):?>
							<div class="number">
								<h3 class="font-green-sharp">
									<span data-counter="counterup" data-value="0">CH3</span>
									<small class="font-green-sharp">Kapalı</small>
								</h3>
								<small>Yanıt yok</small>
							</div>
						<?php else:?>
							<div class="number">
								<h3 class="font-green-sharp">
									<span data-counter="counterup" data-value="<?=$ch3?>"><?=$ch3?></span>
									<small class="font-green-sharp">Kişi</small>
								</h3>
								<small>CH 3</small>
							</div>
						<?php endif;?>
						<div class="icon">
							<i class="icon-pie-chart"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2 ">
					<div class="display">
						<?php if ($ch4 === null):?>
							<div class="number">
								<h3 class="font-green-sharp">
									<span data-counter="counterup" data-value="0">CH4</span>
									<small class="font-green-sharp">Kapalı</small>
								</h3>
								<small>Yanıt yok</small>
							</div>
						<?php else:?>
							<div class="number">
								<h3 class="font-green-sharp">
									<span data-counter="counterup" data-value="<?=$ch4?>"><?=$ch4?></span>
									<small class="font-green-sharp">Kişi</small>
								</h3>
								<small>CH 4</small>
							</div>
						<?php endif;?>
						<div class="icon">
							<i class="icon-pie-chart"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<div class="dashboard-stat2 ">
					<div class="display">
							<div class="number">
								<h3 class="font-green-sharp">
									<span data-counter="counterup" data-value="<?=$ch1+$ch2+$ch3+$ch4?>"><?=$ch1+$ch2+$ch3+$ch4?></span>
									<small class="font-green-sharp">Kişi</small>
								</h3>
								<small>Toplam Online</small>
							</div>
						<div class="icon">
							<i class="icon-pie-chart"></i>
						</div>
					</div>
					<div class="progress-info">
						<div class="progress">
							<span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
						</div>
					</div>
				</div>
			</div>
	<?php endif;?>
<?php else:?>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat2 ">
                <div class="display">
                        <div class="number">
                            <h3 class="font-green-sharp">
                                <span data-counter="counterup" data-value="<?=$this->online['count']?>"><?=$this->online['count']?></span>
                                <small class="font-green-sharp">Kişi</small>
                            </h3>
                            <small>Toplam Online</small>
                        </div>
                    <div class="icon">
                        <i class="icon-pie-chart"></i>
                    </div>
                </div>
                <div class="progress-info">
                    <div class="progress">
                        <span style="width: 100%;" class="progress-bar progress-bar-striped"></span>
                    </div>
                </div>
            </div>
        </div>
<?php endif;?>
<?php endif;?>
