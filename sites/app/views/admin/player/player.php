<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 04.05.2017
     * Time: 17:05
     */
    $player = $this->info['player'][0];
    $equipment = $this->info['equipment'];
    $inventory = $this->info['inventory'];
    $belt = $this->info['belt'];
    $dragonsoul = $this->info['dragonsoul'];
    $special = $this->info['special'];
    $exchange = $this->info['exchange'];
    $shop = $this->info['shop'];
    function derece($alignment){

        if($alignment > 11999){return "Kahraman"; }
        elseif($alignment > 7999){return "Soylu"; }
        elseif($alignment > 3999){return "İyi"; }
        elseif($alignment > 1999){return "Arkadaşça"; }
        elseif($alignment > -3999){return "Tarafsız"; }
        elseif($alignment > -7999){return "Agresif"; }
        elseif($alignment > -11999){return "Hileli"; }
        elseif($alignment < -20000){return "Kötü Niyetli"; }
        elseif($alignment >= -20000){return "Zalim"; }
    }
    function riding($value){
        if ($value == 0){
            return 'Pasif';
        }else{
            return 'Aktif';
        }
    }
	function rutbe_ne($value){
		if ($value == "1")
			return "<b style='color: green'>Acemi Er</b>";
		else if ($value == "2")
			return "<b style='color: green'>Er</b>";
		else if ($value == "3")
			return "<b style='color: green'>Onbaşı</b>";
		else if ($value == "4")
			return "<b style='color: green'>Çavuş</b>";
		else if ($value == "5")
			return "<b style='color: green'>Uzman Onbaşı</b>";
		else if ($value == "6")
			return "<b style='color: green'>Uzman Çavuş</b>";
		else if ($value == "6")
			return "<b style='color: green'>Astsb. Çavuş</b>";
		else if ($value == "6")
			return "<b style='color: green'>Astsb. Üstçavuş</b>";
		else if ($value == "6")
			return "<b style='color: green'>Astsb. Başçavuş</b>";
		else if ($value == "6")
			return "<b style='color: green'>Asteğmen</b>";
		else if ($value == "6")
			return "<b style='color: green'>Teğmen</b>";
		else if ($value == "6")
			return "<b style='color: green'>Üsteğmen</b>";
		else if ($value == "6")
			return "<b style='color: green'>Yüzbaşı</b>";
		else if ($value == "6")
			return "<b style='color: green'>Binbaşı</b>";
		else if ($value == "6")
			return "<b style='color: green'>Yarbay</b>";
		else if ($value == "6")
			return "<b style='color: green'>Albay</b>";
		else if ($value == "6")
			return "<b style='color: green'>Tuğgeneral</b>";
		else if ($value == "6")
			return "<b style='color: green'>Tümgeneral</b>";
		else if ($value == "6")
			return "<b style='color: green'>Korgeneral</b>";
		else if ($value == "6")
			return "<b style='color: green'>Orgeneral</b>";
		else
			return "<b style='color: red'>Başlamamış</b>";
    }
	function reborn_ne($arg)
	{
		if ($arg == "1")
			return "<b style='color: green'>R1</b>";
		else if ($arg == "2")
			return "<b style='color: green'>R2</b>";
		else if ($arg == "3")
			return "<b style='color: green'>R3</b>";
		else if ($arg == "4")
			return "<b style='color: green'>R4</b>";
		else if ($arg == "5")
			return "<b style='color: green'>R5</b>";
		else if ($arg == "6")
			return "<b style='color: green'>R6</b>";
		else if ($arg == "7")
			return "<b style='color: green'>R7</b>";
		else if ($arg == "8")
			return "<b style='color: green'>R8</b>";
		else if ($arg == "9")
			return "<b style='color: green'>R9</b>";
		else if ($arg == "10")
			return "<b style='color: green'>R10</b>";
		else
			return "<b style='color: red'>Başlamamış</b>";
	}
	function where($arg)
	{
		if ($arg == "UPGRADE_INVENTORY")
			return "<b style='color: darkred'>Yükseltme</b>";
		else if ($arg == "BOOK_INVENTORY")
			return "<b style='color: darkorange'>Beceri Kitabı</b>";
		else if ($arg == "STONE_INVENTORY")
			return "<b style='color: darkorange'>Taş</b>";
		else if ($arg == "ATTR_INVENTORY")
			return "<b style='color: darkorange'>Efsun</b>";
		else if ($arg == "FLOWER_INVENTORY")
			return "<b style='color: darkorange'>Sandık</b>";
		else if ($arg == "BLEND_INVENTORY")
			return "<b style='color: darkorange'>Çiçek</b>";
		else
			return "<b style='color: darkblue'>Bilinmiyor</b>";
	}
	function shop_cord($value){
       return ($value - ($value % 100)) / 100;
    }

?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title tabbable-line">
                <div class="caption">
                    <i class="icon-user font-blue"></i>
                    <span class="caption-subject font-blue bold uppercase">Hesap İşlemleri</span>
                </div>
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#portlet_tab1" data-toggle="tab"> Genel </a>
                    </li>
                    <li>
                        <a href="#portlet_tab2" data-toggle="tab"> Ekipmanları </a>
                    </li>
                    <li>
                        <a href="#portlet_tab3" data-toggle="tab"> Envanteri </a>
                    </li>
					<li>
                        <a href="#portlet_tab4" data-toggle="tab"> Kemer </a>
                    </li>
					<li>
                        <a href="#portlet_tab5" data-toggle="tab"> Simya </a>
                    </li>
					<li>
                        <a href="#portlet_tab6" data-toggle="tab"> K Envanter </a>
                    </li>
					<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
					<li>
                        <a href="#portlet_tab7" data-toggle="tab"> Ticaret Kayıtları </a>
                    </li>
					<li>
                        <a href="#portlet_tab8" data-toggle="tab"> Pazar Kayıtları </a>
                    </li>
					<?php endif;?>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="portlet_tab1">
                        <h2 class="font-green-soft"> <?= $player['name'] ?> (<?= $player['id'] ?>)</h2><br>
                        <div class="alert alert-info">
                            <a href="<?= URI::get_path('account/ban/' . $player['account_id']) ?>" class="btn dark"><i
                                        class="fa fa-lock"></i> Banla</a>
                            <a href="<?= URI::get_path('account/allaccountlist/' . $player['account_id']) ?>"
                               class="btn blue"><i class="fa fa-search"></i> Tüm Hesaplarını Görüntüle</a>
                        </div>
                        <h5><b>Karakter Adı : </b><?= $player['name'] ?></h5>
                        <h5><b>Sınıfı : </b><?= Functions::jobName($player['job']) ?></h5>
                        <h5><b>Son Görüldüğü Harita : </b><?= Functions::map($player['map_index']) ?></h5>
                        <h5><b>Son Görüldüğü Koordinatlar : </b><?= $player['x'] ?> / <?= $player['y'] ?></h5>
                        <h5><b>Seviyesi : </b><?= $player['level'] ?> Level</h5>
                        <h5><b>Derecesi : </b><?= derece($player['alignment']); ?></h5>
						<?php if (\StaticDatabase\StaticDatabase::systems('rebirth_durum') === "1"):?>
						<h5><b>Rebirth Seviyesi : </b><?= reborn_ne($player[REBIRTH]) ?></h5>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::systems('rutbe_durum') === "1"):?>
						<h5><b>Rütbesi : </b><?= rutbe_ne($player[RUTBEPRESTIGE]) ?></h5>
						<?php endif;?>
                        <h5><b>Exp Miktarı : </b><?= $player['exp'] ?> EXP</h5>
                        <h5><b>Yang Miktarı : </b><?= $player['gold'] ?> Yang</h5>
						<?php if (\StaticDatabase\StaticDatabase::systems('won_durum') === "1"):?>
						<h5><b>Won Miktarı : </b><?= $player[CHEQUEWON] ?> Won</h5>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::systems('metingaya_durum') === "1"):?>
						<h5><b>Metin Gaya Miktarı : </b><?= $player[METINGAYA] ?> M.G</h5>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::systems('bossgaya_durum') === "1"):?>
						<h5><b>Boss Gaya Miktarı : </b><?= $player[BOSSGAYA] ?> B.G</h5>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::systems('np_durum') === "1"):?>
						<h5><b>NP Miktarı : </b><?= $player[NATURALPOINT] ?> NP</h5>
						<?php endif;?>
                        <h5><b>HP Miktarı : </b><?= $player['hp'] ?> HP</h5>
                        <h5><b>SP Miktarı : </b><?= $player['mp'] ?> SP</h5>
                        <h5><b>STR : </b><?= $player['st'] ?></h5>
                        <h5><b>VIT : </b><?= $player['ht'] ?></h5>
                        <h5><b>DEX : </b><?= $player['dx'] ?></h5>
                        <h5><b>INT : </b><?= $player['iq'] ?></h5>
                        <h5><b>Statü Puanı : </b><?= $player['stat_point'] ?></h5>
                        <h5><b>Beceri Puanı : </b><?= $player['skill_point'] ?></h5>
                        <h5><b>İp Adresi : </b><?= $player['ip'] ?></h5>
						<h5><b>Oyun Süresi : </b><?= Functions::convertTimeMinutes($player['playtime']) ?></h5>
                        <h5><b>Son Oynama Tarihi : </b><?= Functions::zaman($player['last_play']) ?></h5>
                        <h5><b>At Leveli : </b><?= $player['horse_level'] ?></h5>
                        <h5><b>At Üstünde : </b><?= riding($player['horse_riding']) ?></h5>
                    </div>
                    <div class="tab-pane" id="portlet_tab2">
                        <?php if(count($equipment) == 0): ?>
                            <h2>Ekipman Boş.</h2>
                        <?php else:?>
                            <?php foreach ($equipment as $key=>$rowMall):?>
                                <div href="javascript:;" class="icon-btn"  style="width: 220px;height: 180px;margin: 15px;">

                                    <i><img src="<?=URL.'data/items/'.Functions::itemToPng($rowMall['vnum'])?>" onerror="this.src='<?=URL.'data/items/60001.png'?>'" alt="" style="margin-bottom :<?php if ($rowMall['size']== '1'){echo '64px;';}elseif($rowMall['size'] == '2'){echo '32px;';}?>"></i>
                                    <p> <?=Functions::turkce_karakter($rowMall['name']);?> </p>
                                    <a class="btn blue" data-toggle="modal" href="#<?=$rowMall['id']?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="<?=URI::get_path('player/deleteitem1/'.$rowMall['id']);?>"  class="btn dark">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <span class="badge badge-danger"> <?=$rowMall['count'];?> </span>
                                </div>
                                <div class="modal fade" id="<?=$rowMall['id'];?>" style="display: none;">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content c-square">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title bold uppercase font-green-soft"><?=Functions::turkce_karakter($rowMall['name'])?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="tabbable-line">
                                                    <div class="tab-content">
                                                        <div class="border-default margin-bottom-10" style="padding: 10px; border: 2px solid #fff;">
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype0']]?> <?=$rowMall['attrvalue0']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype1']]?> <?=$rowMall['attrvalue1']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype2']]?> <?=$rowMall['attrvalue2']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype3']]?> <?=$rowMall['attrvalue3']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype4']]?> <?=$rowMall['attrvalue4']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype5']]?> <?=$rowMall['attrvalue5']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype6']]?> <?=$rowMall['attrvalue6']?></p>
                                                            <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$rowMall['socket0']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$rowMall['socket0']];}?></p>
                                                            <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$rowMall['socket1']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$rowMall['socket1']];}?></p>
                                                            <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$rowMall['socket2']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$rowMall['socket2']];}?></p>
                                                            <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$rowMall['socket3']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$rowMall['socket3']];}?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline dark sbold uppercase" data-dismiss="modal">Kapat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
                    <div class="tab-pane" id="portlet_tab3">
                        <?php if(count($inventory) == 0): ?>
                            <h2>Envanter Boş.</h2>
                        <?php else:?>
                            <?php foreach ($inventory as $key=>$rowMall):?>
                                <div href="javascript:;" class="icon-btn"  style="width: 220px;height: 180px;margin: 15px;">

                                    <i><img src="<?=URL.'data/items/'.Functions::itemToPng($rowMall['vnum'])?>" onerror="this.src='<?=URL.'data/items/60001.png'?>'" alt="" style="margin-bottom :<?php if ($rowMall['size']== '1'){echo '64px;';}elseif($rowMall['size'] == '2'){echo '32px;';}?>"></i>
                                    <p> <?=Functions::turkce_karakter($rowMall['name']);?> </p>
                                    <a class="btn blue" data-toggle="modal" href="#<?=$rowMall['id']?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a href="<?=URI::get_path('player/deleteitem1/'.$rowMall['id']);?>"  class="btn dark">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <span class="badge badge-danger"> <?=$rowMall['count'];?> </span>
                                </div>
                                <div class="modal fade" id="<?=$rowMall['id'];?>" style="display: none;">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content c-square">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title bold uppercase font-green-soft"><?=Functions::turkce_karakter($rowMall['name'])?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="tabbable-line">
                                                    <div class="tab-content">
                                                        <div class="border-default margin-bottom-10" style="padding: 10px; border: 2px solid #fff;">
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype0']]?> <?=$rowMall['attrvalue0']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype1']]?> <?=$rowMall['attrvalue1']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype2']]?> <?=$rowMall['attrvalue2']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype3']]?> <?=$rowMall['attrvalue3']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype4']]?> <?=$rowMall['attrvalue4']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype5']]?> <?=$rowMall['attrvalue5']?></p>
                                                            <p><?=Functions::gameIn('efsunlar')[$rowMall['attrtype6']]?> <?=$rowMall['attrvalue6']?></p>
                                                            <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$rowMall['socket0']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$rowMall['socket0']];}?></p>
                                                            <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$rowMall['socket1']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$rowMall['socket1']];}?></p>
                                                            <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$rowMall['socket2']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$rowMall['socket2']];}?></p>
                                                            <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$rowMall['socket3']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$rowMall['socket3']];}?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline dark sbold uppercase" data-dismiss="modal">Kapat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
					<div class="tab-pane" id="portlet_tab4">
                        <?php if(count($belt) == 0): ?>
                            <h2>Kemer Envanteri Boş.</h2>
                        <?php else:?>
                            <?php foreach ($belt as $key=>$rowBelt):?>
                                <div href="javascript:;" class="icon-btn"  style="width: 220px;height: 180px;margin: 15px;">

                                    <i><img src="<?=URL.'data/items/'.Functions::itemToPng($rowBelt['vnum'])?>" onerror="this.src='<?=URL.'data/items/60001.png'?>'" alt="" style="margin-bottom :<?php if ($rowBelt['size']== '1'){echo '64px;';}elseif($rowBelt['size'] == '2'){echo '32px;';}?>"></i>
                                    <p> <?=Functions::turkce_karakter($rowBelt['name']);?> </p>
                                    <a href="<?=URI::get_path('player/deleteitem1/'.$rowBelt['id']);?>"  class="btn dark">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <span class="badge badge-danger"> <?=$rowBelt['count'];?> </span>
                                </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
					<div class="tab-pane" id="portlet_tab5">
                        <?php if(count($dragonsoul) == 0): ?>
                            <h2>Simya Envanteri Boş.</h2>
                        <?php else:?>
                            <?php foreach ($dragonsoul as $key=>$rowDragonSoul):?>
                                <div href="javascript:;" class="icon-btn"  style="width: 220px;height: 180px;margin: 15px;">

                                    <i><img src="<?=URL.'data/items/'.Functions::itemToPng($rowDragonSoul['vnum'])?>" onerror="this.src='<?=URL.'data/items/60001.png'?>'" alt="" style="margin-bottom :<?php if ($rowDragonSoul['size']== '1'){echo '64px;';}elseif($rowDragonSoul['size'] == '2'){echo '32px;';}?>"></i>
                                    <p> <?=Functions::turkce_karakter($rowDragonSoul['name']);?> </p>
                                    <a href="<?=URI::get_path('player/deleteitem1/'.$rowDragonSoul['id']);?>"  class="btn dark">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <span class="badge badge-danger"> <?=$rowDragonSoul['count'];?> </span>
                                </div>
                            <?php endforeach;?>
                        <?php endif;?>
                    </div>
					<div class="tab-pane" id="portlet_tab6" style="margin-top: 40px;">
                        <?php if(count($special) == 0): ?>
                            <h2>K Envanteri Boş.</h2>
                        <?php else:?>
							<div class="portlet light bordered">
								<div class="portlet-title">
									<div class="tools"> </div>
								</div>
								<div class="portlet-body">
									<table class="table table-striped table-bordered table-hover order-column" id="sample_1">
										<thead>
										<tr>
											<th>#</th>
											<th>Eşya</th>
											<th>Miktarı</th>
											<th>Nerde</th>
											<th>İşlem</th>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($special as $key=>$rowSpecial):?>
											<tr>
												<td><img src="<?=URL.'data/items/'.Functions::itemToPng($rowSpecial['vnum'])?>" onerror="this.src='<?=URL.'data/items/zone.png'?>'" alt="" style="margin-bottom :16px"></td>
												<td><?=Functions::turkce_karakter($rowSpecial['name']);?></td>
												<td><?=$rowSpecial['count'];?></td>
												<td><?=where($rowSpecial['window']);?></td>
												<td><a href="<?=URI::get_path('player/deleteitem1/'.$rowSpecial['id']);?>"  class="btn dark"><i class="fa fa-trash"></i> Sil</a></td>
											</tr>
										<?php endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
                        <?php endif;?>
                    </div>
                    <div class="tab-pane" id="portlet_tab7" style="margin-top: 80px;">
                        <?php if(count($exchange) == 0): ?>
                            <h2>Ticaret kaydı yoktur.</h2>
                        <?php else:?>
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_0">
								<thead>
								<tr>
									<th>Başlatan</th>
									<th>Yapan</th>
									<th>Tarih</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($exchange as $ExcLog):?>
									<tr>
										<td><?=$ExcLog['kisi1']?></td>
										<td><?=$ExcLog['kisi2']?></td>
										<td><?=Functions::zaman($ExcLog['time'])?></td>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
                        <?php endif;?>
                    </div>
					<div class="tab-pane" id="portlet_tab8" style="margin-top: 80px;">
                        <?php if(count($shop) == 0): ?>
                            <h2>Pazar kaydı yoktur.</h2>
                        <?php else:?>
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_0">
								<thead>
								<tr>
									<th>Satan Karakter</th>
									<th>Satın Alan</th>
									<th>Eşya Adı (Kodu)</th>
									<th>Satış Fiyatı</th>
									<th>Tarih</th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($shop as $ShopLog):?>
									<tr>
										<td><?=$ShopLog['name']?></td>
										<td><?=$ShopLog['alanname']?></td>
										<td><?=Functions::item_adi_goster($ShopLog['vnum']);?>  (<?=$ShopLog['vnum']?>)</td>
										<td><?=$ShopLog['gold']?> Gold / <?=$ShopLog['cheque']?> Won</td>
										<td><?=Functions::zaman($ShopLog['time'])?></td>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
