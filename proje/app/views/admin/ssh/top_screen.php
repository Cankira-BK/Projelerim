<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"100") == true): error_reporting(1);?>
<div class="row">
	<div class="col-lg-12 col-md-3 col-sm-6 col-xs-12">
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-red-sunglo">
					<i class="fa fa-key font-red-sunglo"></i>
					<span class="caption-subject bold uppercase">Sunucu İstatistik | Ram: <?=SSHConnect::get_ram_info();?> | İşlemci: <?=SSHConnect::get_cpu_info();?></span>
				</div>
			</div>
			<div class="dashboard-stat2 ">
				<?=SSHConnect::topscreen()?>
			</div>
		</div>
	</div>
	<div class="portlet light bordered">
		<div class="portlet-title">
			<div class="caption font-red">
				<i class="icon-list font-red"></i>
				<span class="caption-subject bold uppercase">Sunucu Uptime</span>
			</div>
			<div class="tools"> </div>
		</div>
		<div class="portlet-body">
			<table class="table table-striped table-bordered table-hover order-column" id="PriceList">
				<thead>
				<tr>
					<th>Kanal Adı</th>
					<th>Uptime</th>
					<th>Durum</th>
				</tr>
				</thead>
				<tbody>
				<?php 
					$ssh = new Net_SSH2(GAME_DB_HOST);
					if (!$ssh->login('root', GAME_SSH_PASS)) {
						exit('SSH2 Bağlantısı başarısız, şifre hatalı olabilir lütfen kontrol ediniz!');
					}
					
					$statusn = $ssh->exec("sh /usr/game/share/lib/sh/status.sh");
					$status = json_decode($statusn, true);
				?>
				<tr>
					<td>auth</td>
					<td><?= $ssh->secondsToTime($status['auth']['time']) ?></td>
					<td><?PHP if($status['auth']['pid']) echo '<font color="green">Açık</font>'; else echo '<font color="red">Kapalı</font>'; ?></td>
				</tr>
				<tr>
					<td>db</td>
					<td><?= $ssh->secondsToTime($status['db']['time']) ?></td>
					<td><?PHP if($status['db']['pid']) echo '<font color="green">Açık</font>'; else echo '<font color="red">Kapalı</font>'; ?></td>
				</tr>
				<?PHP
				foreach ($status['channels'] as $r){
					$status = $r['pid'] ? '<font color="green">Açık</font>' : '<font color="red">Kapalı</font>';
					echo "
				<tr>
					<td>{$r['name']}</td>
					<td>{$ssh->secondsToTime($r['time'])}</td>
					<td>$status</td>
				</tr>
					";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php endif;?>