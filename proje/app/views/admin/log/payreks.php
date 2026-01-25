<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"63") == true):?>
	<?php
	function paymentConvert($payment)
	{
		if ($payment === "CREDIT")
			return "Kredi Kartı";
		elseif ($payment === "MOBILE")
			return "Mobil Ödeme";
		elseif ($payment === "EFT")
			return "Havale/EFT";
		else
			return "İninal Kart";
	}
	?>
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light bordered">
				<div class="portlet-title">
					<div class="caption font-dark">
						<i class="icon-settings font-dark"></i>
						<span class="caption-subject bold uppercase">Payreks Sipariş Listesi</span>
					</div>
					<div class="tools"> </div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover order-column" id="desc_list">
						<thead>
						<tr>
							<th>Sipariş ID</th>
							<th>Account ID</th>
							<th>Account Login</th>
							<th>Bakiye</th>
							<th>Ödeme Yöntemi</th>
							<th>Kazanç</th>
							<th>Sipariş Tarihi</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($this->payreks as $row):?>
							<tr>
								<td><?=$row["order_id"]?></td>
								<td><?=$row['user_id']?></td>
								<td><?=$row['user_info']?></td>
								<td><?=$row['credit']?> EP</td>
								<td><?=paymentConvert($row['pay_label'])?></td>
								<td><?=$row['net_price']?> ₺</td>
								<td><?=$row['date_time']?></td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php endif;?>