<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"90") == true):?>
<?php 
$info = $this->info;
$account = $info['account'];
?>
	<div class="row">
		<div class="col-md-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red">
                        <i class="icon-list font-red"></i>
                        <span class="caption-subject bold uppercase">NPC İtem Ekle</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
						<div class="form-body">
						<div class="span12">Npcdeki İtemleri Silmek İçin Resmin Üstüne Tıklayınız.<br> Sıralama Tablo Boyutuna Göre Değişiklik Gösterebilir.</div>
							<div style="background-image: url(<?=URL.'data/extra/bosnpc.png'?>); height: 345px; width: 324px; border: 1px solid black;"><br/>
								<table>
									<tbody>
									<?php
									$i=0;
									$say=0;
									foreach ($account as $row0){
									$i = $i +1;
									$linkne = URI::get_path("sql/npcitemkaldir/".$row0['item_vnum']."/".$row0['shop_vnum']."");
									if($say == 0){echo"<tr>";}
									echo '<td><a href="'.$linkne.'" class="ipucu">
									<img src="'.URL.'data/items/'.Functions::itemToPng($row0['item_vnum']).'" onmouseout="disable()"/>        
									<span class="ipucuyazi">'.Functions::itemToNames($row0['item_vnum']).'<br>'.$row0['count'].' Adet<br>Satış Fiyatı <br><font color="gold">'.$row0['price'].' Yang</font></span>
									</a></td>
									';
									$say++;
									if($i == 10){
									echo"</tr>";
									$say=0;
									$i=0;}
									}
									?>
									</tbody>
								</table>
							</div>
						</div>
                </div>
            </div>
		</div>
	</div>
<?php endif;?>