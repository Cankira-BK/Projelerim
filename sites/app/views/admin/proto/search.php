<?php
function where($arg)
{
	if ($arg == "INVENTORY")
		return "<b style='color: darkred'>Envanter</b>";
	else if ($arg == "EQUIPMENT")
		return "<b style='color: darkorange'>Giyili</b>";
	else if ($arg == "DRAGON_SOUL_INVENTORY")
		return "<b style='color: darkgreen'>Simya Envanter</b>";
	else if ($arg == "UPGRADE_INVENTORY" or $arg == "BOOK_INVENTORY" or $arg == "STONE_INVENTORY" or $arg == "ATTR_INVENTORY" or $arg == "FLOWER_INVENTORY" or $arg == "BLEND_INVENTORY")
		return "<b style='color: darkyellow'>K Envanter</b>";
	else if ($arg == "BELT_INVENTORY")
		return "<b style='color: darkred'>Kemer Envanter</b>";
	else
		return "<b style='color: darkblue'>Depo</b>";
}
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="icon-search font-dark"></i>
					<span class="caption-subject bold uppercase">Arama Sonuçları (<?=$this->search['name'];?>)</span>
				</div>
				<div class="tools"> </div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
					<thead>
					<tr>
						<th>id</th>
						<th>Eşya Adı</th>
						<th>Vnum</th>
						<th>Sahibini</th>
						<th>Nerde</th>
						<th>Miktarı</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($this->search['data'] as $row):?>
						<tr>
							<td><?=$row['id'];?></td>
							<td><?=$this->search['name'];?></td>
							<td><?=$row['vnum'];?></td>
							<?php if($row['window'] == "MALL" or $row['window'] == "SAFEBOX"):?><td>H: <?=Functions::hesap_adi_goster($row['owner_id']);?></td><?php else:?><td>P: <?=Functions::karakter_adi_goster($row['owner_id']);?></td><?php endif;?>
							<td><?=where($row['window']);?></td>
							<td><?=$row['count'];?></td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
