<?php
    /**
     * Created by PhpStorm.
     * User: Oğuzcan GÖKMEN
     * Date: 24.03.2017
     * Time: 20:51
     */
    $info = $this->info;
    $account = $info['account'];
	if (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"){$hwidban = $info['hwidban'];}
	if (\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"){$acclock = $info['acclock'];}
    $player = $info['player'];
    $safebox = $info['depo'];
    $mallBox = $info['nesne'];
    $marketLog = $info['market'];
    $loginLog = $info['loginLog'];
    $gameLog =  $info['gameLog'];
    $panelLog = $info['panelLog'];
    $oldPass = $info['oldPass'];
    $empireData = array(
        '1'=>'Kırmızı',
        '2'=>'Sarı',
        '3'=>'Mavi'
    );
    function playerStat($date){
        $now = date( 'Y-m-d H:i:s', strtotime('-30 minutes'));
        if ($now > $date){
            return 'off';
        }elseif ($now <= $date){
            return 'on';
        }
    }
    function convertLog($type){
        if ($type == 2)
            $data = "Şifre Değişikliği";
        elseif ($type == 3)
            $data = "Mail Değişikliği (0)";
        elseif ($type == 4)
            $data = "Mail Gönderildi";
        elseif ($type == 5)
            $data = "Mail Değişikliği (1)";
        elseif ($type == 6)
            $data = "Mail Gönderildi";
        elseif ($type == 7)
            $data = "Depo Şifresi Değişikliği";
        elseif ($type == 8)
            $data = "Mail Gönderildi";
        elseif ($type == 9)
            $data = "KSK Değişikliği";
        elseif ($type == 14)
            $data = "Mail Gönderildi";
        elseif ($type == 15)
            $data = "Mail Aktivasyonu Gerçekleşti";
        elseif ($type == 16)
            $data = "Bugdan Kurtarıldı";
        return $data;
    }
    function banType($value){
        if ($value == 0 || $value == 2)
            $data = "Süresiz Ban";
        elseif ($value == 1)
            $data = "Süreli Ban";
        elseif ($value == 3)
            $data = "Mac Ban";
        return $data;
    }
//    if(isset($_SESSION['oldPass']) && $_SESSION['oldPass'] == true){
//        Functions::alert('success',"Şife")
//    }
    $availDt = strtotime($account['availDt']);
    $now = time();
    $fark = $availDt - $now;
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
                    <?php $_SESSION['changeAccount'] = isset($_SESSION['changeAccount']) ? $_SESSION['changeAccount'] : null;?>
                    <li class="<?php if (Session::get('changeAccount') == null){ echo 'active';}?>">
                        <a href="#portlet_tab1" data-toggle="tab"> Genel </a>
                    </li>
                    <li>
                        <a href="#portlet_tab4" data-toggle="tab"> Karakterler </a>
                    </li>
					<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
                    <li class="<?php if ($_SESSION['changeAccount'] == 'delete'){ echo 'active';}?>">
                        <a href="#portlet_tab5" data-toggle="tab"> Depo </a>
                    </li>
                    <li class="<?php if ($_SESSION['changeAccount'] == 'delete1'){ echo 'active';}?>">
                        <a href="#portlet_tab6" data-toggle="tab"> Nesne Deposu </a>
                    </li>
					<li>
                        <a href="#portlet_tab2" data-toggle="tab"> Oyun giriş kayıtları </a>
                    </li>
					<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
                    <li>
                        <a href="#portlet_tab8" data-toggle="tab"> Panel hareket kayıtları </a>
                    </li>
					<?php endif;?>
                    <li>
                        <a href="#portlet_tab3" data-toggle="tab"> Panel giriş kayıtları </a>
                    </li>
                    <li>
                        <a href="#portlet_tab7" data-toggle="tab"> Market Log </a>
                    </li>
					<?php endif;?>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="tab-content">
                    <div class="tab-pane <?php if ($_SESSION['changeAccount'] == 'NO' || $_SESSION['changeAccount'] == null){ echo 'active';}?>" id="portlet_tab1">
                         <h2 class="font-green-soft"> <?=$account['login']?> (<?=$account['id']?>)
                             <?php if ($account['status'] == 'BLOCK' || $availDt > $now):?>
                             (Hesap Banlı)
                             <?php endif;?>
							 <?php if (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
							 <?php if ($hwidban['hwid']):?>
                             (HWID Banlı)
                             <?php endif;?>
                             <?php endif;?>
                         </h2><br>
                        <div class="alert alert-info">
							<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
                            <a href="<?=URI::get_path('account/addep/'.$account['id'])?>" class="btn red"><i class="fa fa-plus"></i> Ep Ver</a>
                            <?php endif;?>
							<?php if ($account['status'] == 'BLOCK' || $availDt > $now):?>
                            <a href="<?=URI::get_path('account/openban/'.$account['id'])?>" class="btn red"><i class="fa fa-unlock"></i> Banı Kaldır</a>
                            <?php elseif (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
                            <?php if ($hwidban['hwid']):?>
							<a href="<?=URI::get_path('account/openhwidban/'.$account[SECURITYPCTABLE3])?>" class="btn red"><i class="fa fa-unlock"></i> HWID Banı Kaldır</a>
							<?php endif;?>
							<?php else:?>
                            <a href="<?=URI::get_path('account/ban/'.$account['id'])?>" class="btn dark"><i class="fa fa-lock"></i> Banla</a>
                            <?php endif;?>
                            <a href="<?=URI::get_path('account/allaccountlist/'.$account['id'])?>" class="btn blue"><i class="fa fa-lock"></i> Tüm Hesaplarını Görüntüle</a>
                        </div>
                        <?php if (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
                        <?php if ($account['status'] == 'BLOCK' || $availDt > $now || $hwidban['hwid']):?>
                        <div class="alert alert-info">
                            <?php $getBanList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM ban_list WHERE account_id = :account_id");
                            $getBanList->execute(array(':account_id'=>$account['id']));
                            $getBanList->setFetchMode(PDO::FETCH_ASSOC);
                            $getBanLists = $getBanList->fetch();
                            ?>
                            <h5><b>Banlanma Nedeni : <?=$getBanLists['why'];?></b></h5>
                            <h5><b>Ban Kanıtı : <?=$getBanLists['evidence'];?></b></h5>
                            <h5><b>Banlanma Tarihi : <?=Functions::zaman($getBanLists['date']);?></b></h5>
                            <h5><b>Ban Tipi : <?=banType($getBanLists['type']);?></b></h5>
                        </div>
                        <?php endif;?>
                        <?php else:?>
						<?php if ($account['status'] == 'BLOCK' || $availDt > $now):?>
                        <div class="alert alert-info">
                            <?php $getBanList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM ban_list WHERE account_id = :account_id");
                            $getBanList->execute(array(':account_id'=>$account['id']));
                            $getBanList->setFetchMode(PDO::FETCH_ASSOC);
                            $getBanLists = $getBanList->fetch();
                            ?>
                            <h5><b>Banlanma Nedeni : <?=$getBanLists['why'];?></b></h5>
                            <h5><b>Ban Kanıtı : <?=$getBanLists['evidence'];?></b></h5>
                            <h5><b>Banlanma Tarihi : <?=Functions::zaman($getBanLists['date']);?></b></h5>
                            <h5><b>Ban Tipi : <?=banType($getBanLists['type']);?></b></h5>
                        </div>
                        <?php endif;?>
                        <?php endif;?>
                        <h5><b>Hesap Oluşturma Tarihi : </b><?=$account['create_time'];?> (<?=Functions::zaman($account['create_time'])?>)</h5>
                        <h5><b>Karakter Sayısı : </b><?=count($player);?></h5>
                        <h5><b>Bayrak :</b> <?php if (isset($player[0])){echo '<img src="'.URL.'data/flags/'.$player[0]['empire'].'.jpg" alt="">';}else{echo 'Karakter Kaydı Yok';}?></h5>
                        <h5><b>Toplam Yang : </b><?php if (count($player) == 0){echo "Henüz karakteri bulunmuyor";}else{echo Info::totalYang($account['id']);}?></h5>
                        <h5><b>Toplam Won : </b><?php if (count($player) == 0){echo "Henüz karakteri bulunmuyor";}else{echo Info::totalWon($account['id']);}?></h5>
						<h5><b>İp Adresi : </b><?=$account['ip'];?></h5>
						<?php if (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
						<h5><b>MAC Adresi : </b><?=$account[SECURITYPCTABLE3];?></h5>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
						<?php if ($account[PINTABLE] != null):?>
						<h5><b>Hesap Pin Kodu : </b><?=$account[PINTABLE];?></h5>
						<?php endif;?>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
						<?php if ($acclock['password'] != null):?>
						<h5><b>Hesap Kilit Şifresi : </b><?=$acclock['password'];?></h5>
						<?php endif;?>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
						<?php if ($account[PLAYERLOCKTABLE]):?>
						<h5><b>Karakter Kilit Şifresi : </b><?=$account[PLAYERLOCKTABLE];?></h5>
						<?php endif;?>
						<?php endif;?>
						<?php if (\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
						<?php if ($account[ITEMLOCKTABLE] != null):?>
						<h5><b>Eşya Kilit Şifresi : </b><?=$account[ITEMLOCKTABLE];?></h5>
						<?php endif;?>
						<?php endif;?>
                        <h5><b>Son Giriş Tarihi :</b> <?php if (count($player) == 0 ){ echo "Henüz karakteri bulunmuyor";}else{echo $player[0]['last_play'];}?></h5>
                        <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
						<h5><b>EP Miktarı :</b> <?=$account[CASH]?> EP</h5>
                        <h5><b>EM Miktarı :</b> <?=$account[MILEAGE]?> EM</h5>
                        <?php if($oldPass != null):?>
                        <a href="<?=URI::get_path('account/oldpass/'.$account['id'])?>" class="btn red">Şifreyi Geri Yükle</a>
                        <?php endif;?>
						<?php endif;?>
                        <br>
                            <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
							<form id="accountForm" role="form" method="POST" action="<?=URI::get_path('account/change')?>">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label>Adı Soyadı</label>
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                            <input type="text" id="real_name" class="form-control" name="real_name" value="<?=Functions::turkce_karakter($account['real_name']);?>">
                                            <input type="hidden" name="account_id" value="<?=Functions::turkce_karakter($account['id']);?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Kullanıcı Adı</label>
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                            <input type="text" id="login" class="form-control" name="login" value="<?=Functions::turkce_karakter($account['login']);?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Yeni Şifre</label>
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-lock"></i>
                                                        </span>
                                            <input type="text" id="password" class="form-control" name="password" >
                                        </div>
                                    </div>
									<?php if (\StaticDatabase\StaticDatabase::settings('pin_status') === "1"):?>
									<div class="form-group">
                                        <label>Pin Kodu</label>
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-lock"></i>
                                                        </span>
                                            <input type="text" id="pin" class="form-control" name="pin" value="<?=$account[PINTABLE];?>">
                                        </div>
                                    </div>
									<?php endif;?>
                                    <div class="form-group">
                                        <label>Mail Adresi</label>
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-envelope"></i>
                                                        </span>
                                            <input type="text" id="email" class="form-control" name="email" value="<?=$account['email'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Telefon Numarası</label>
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-lock"></i>
                                                        </span>
                                            <input type="text" id="phone1" class="form-control" name="phone1" value="<?=$account['phone1'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Karakter Silme Şifresi</label>
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-lock"></i>
                                                        </span>
                                            <input type="text" id="ksk" class="form-control" name="ksk" value="<?=$account['social_id'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Depo Şifresi</label>
                                        <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-lock"></i>
                                                        </span>
                                            <input type="text" id="depo" class="form-control" name="depo" value="<?php if($player[0]['depo'] == null){echo '000000';}else{echo $player[0]['depo'];};?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn blue">Güncelle</button>
                                </div>
                            </form>
							<?php endif;?>
                    </div>
                    <div class="tab-pane" id="portlet_tab2" style="margin-top: 80px;">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" style="margin-top: 150px;">
                            <thead>
                            <tr>
                                <th> Oyuncu İd </th>
                                <th> Tür </th>
                                <th> Giriş Zamanı </th>
                                <th> Oyun Süresi </th>
                                <th> Çıkış Zamanı </th>
                                <th> Kanal </th>
                                <th> ip </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($gameLog as $row5):?>
                                <tr class="odd gradeX">
                                    <td> <?=$row5['pid']?> </td>
                                    <td>
                                        <span class="label label-sm label-success"> <?=$row5['type']?> </span>
                                    </td>
                                    <td class="center"> <?=@Functions::zaman($row5['login_time'])?> </td>
                                    <td> <?=$row5['playtime']?> </td>
                                    <td class="center"> <?=@Functions::zaman($row5['logout_time'])?> </td>
                                    <td> <?=$row5['channel']?> </td>
                                    <td> <?=$row5['ip']?> </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab3"  style="margin-top: 50px;">
                        <table class="table table-striped table-bordered table-hover order-column" id="sample_4">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>İp Adresi</th>
                                <th>Tür</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($loginLog as $key3=>$row3):?>
                                <tr>
                                    <td><?=$key3+1;?></td>
                                    <td><?=$row3['ip']?></td>
                                    <td><?=Functions::logConvert($row3['type']);?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="portlet_tab4" style="margin-top: 50px;">
                                        <table class="table table-striped table-bordered table-hover order-column" id="sample" style="margin-top: 50px;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Adı</th>
                                                <th>Level</th>
                                                <th>Sınıf</th>
                                                <th>Ip Adresi</th>
                                                <th>Durum</th>
												<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
                                                <th>İşlem</th>
												<?php endif;?>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ($player as $key1=>$row1):?>
                                                <tr>
                                                    <td><?=$key1+1;?></td>
                                                    <td><?=$row1['name']?></td>
                                                    <td><?=$row1['level']?></td>
                                                    <td><img src="<?=URL.'data/chrs/small/'.$row1['job'].'.png'?>" alt=""></td>
                                                    <td><?=$row1['ip']?></td>
                                                    <td><img src="<?=URL.'data/chrs/small/'.playerStat($row1['last_play']).'.png'?>" alt=""></td>
                                                    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
													<td><div class="margin-bottom-5 text-center">
                                                            <a href="<?=URI::get_path('player/player/'.$row1['id'])?>" class="btn blue text-center">
                                                                <i class="fa fa-edit"></i>
                                                                incele
                                                            </a>
                                                        </div>
                                                    </td>
													<?php endif;?>
                                                </tr>
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>

                    </div>
                    <div class="tab-pane <?php if ($_SESSION['changeAccount'] == 'delete'){ echo 'active'; Session::set('changeAccount','NO');}?>" id="portlet_tab5">
                        <?php if(count($safebox) == 0): ?>
                            <h2>Depo Boş.</h2>
                        <?php else:?>
                        <?php foreach ($safebox as $key=>$row):?>
                            <div href="javascript:;" class="icon-btn"  style="width: 220px;height: 180px;margin: 15px;">

                                <i><img src="<?=URL.'data/items/'.Functions::itemToPng($row['vnum'])?>" onerror="this.src='<?=URL.'data/items/60001.png'?>'" alt="" style="margin-bottom :<?php if ($row['size']== '1'){echo '64px;';}elseif($row['size'] == '2'){echo '32px;';}?>"></i>
                                <p> <?=Functions::turkce_karakter($row['name']);?> </p>
                                <a class="btn blue" data-toggle="modal" href="#<?=$row['id']?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="<?=URI::get_path('account/deleteitem/'.$row['id']);?>"  class="btn dark">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <span class="badge badge-danger"> <?=$row['count'];?> </span>
                            </div>
                            <div class="modal fade" id="<?=$row['id'];?>" style="display: none;">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content c-square">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <h4 class="modal-title bold uppercase font-green-soft"><?=Functions::turkce_karakter($row['name'])?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="tabbable-line">
                                                <div class="tab-content">
                                                    <div class="border-default margin-bottom-10" style="padding: 10px; border: 2px solid #fff;">
                                                        <p><?=Functions::gameIn('efsunlar')[$row['attrtype0']]?> <?=$row['attrvalue0']?></p>
                                                        <p><?=Functions::gameIn('efsunlar')[$row['attrtype1']]?> <?=$row['attrvalue1']?></p>
                                                        <p><?=Functions::gameIn('efsunlar')[$row['attrtype2']]?> <?=$row['attrvalue2']?></p>
                                                        <p><?=Functions::gameIn('efsunlar')[$row['attrtype3']]?> <?=$row['attrvalue3']?></p>
                                                        <p><?=Functions::gameIn('efsunlar')[$row['attrtype4']]?> <?=$row['attrvalue4']?></p>
                                                        <p><?=Functions::gameIn('efsunlar')[$row['attrtype5']]?> <?=$row['attrvalue5']?></p>
                                                        <p><?=Functions::gameIn('efsunlar')[$row['attrtype6']]?> <?=$row['attrvalue6']?></p>
                                                        <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$row['socket0']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$row['socket0']];}?></p>
                                                        <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$row['socket1']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$row['socket1']];}?></p>
                                                        <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$row['socket2']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$row['socket2']];}?></p>
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
                    <div class="tab-pane <?php if ($_SESSION['changeAccount'] == 'delete1'){ echo 'active'; Session::set('changeAccount','NO');}?>" id="portlet_tab6">
                        <?php if(count($mallBox) == 0): ?>
                            <h2>Nesne Market Deposu Boş.</h2>
                        <?php else:?>
                        <?php foreach ($mallBox as $key=>$rowMall):?>
                            <div href="javascript:;" class="icon-btn"  style="width: 220px;height: 180px;margin: 15px;">

                                <i><img src="<?=URL.'data/items/'.Functions::itemToPng($rowMall['vnum'])?>" onerror="this.src='<?=URL.'data/items/60001.png'?>'" alt="" style="margin-bottom :<?php if ($rowMall['size']== '1'){echo '64px;';}elseif($rowMall['size'] == '2'){echo '32px;';}?>"></i>
                                <p> <?=Functions::turkce_karakter($rowMall['name']);?> </p>
                                <a class="btn blue" data-toggle="modal" href="#<?=$rowMall['id']?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="<?=URI::get_path('account/deleteitem1/'.$rowMall['id']);?>"  class="btn dark">
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
                    <div class="tab-pane" id="portlet_tab7" style="margin-top: 50px;">
                        <?php if(count($marketLog) == 0): ?>
                            <h2>Nesne Market Log'u Bulunamadı.</h2>
                        <?php else:?>
                        <table class="table table-striped table-bordered table-hover order-column" id="sample_1" style="margin-top: 50px;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Vnum</th>
                                <th>Eşya Adı</th>
                                <th>İşlem</th>
                                <th>Tarih</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($marketLog as $row2):?>
                                <tr>
                                    <td><?=$row2['id']?></td>
                                    <td><?=$row2['item_vnum']?></td>
                                    <td><?=$row2['item_name']?></td>
                                    <td><?=$row2['what']?></td>
                                    <td><?=$row2['date']?></td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php endif;?>
                    </div>
					<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
                    <div class="tab-pane" id="portlet_tab8" style="margin-top: 80px;">
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3" style="margin-top: 150px;">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> Tür </th>
                                <th> İşlem </th>
                                <th> Tarih </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($panelLog as $key6 =>$row6):?>
                                <tr class="odd gradeX">
                                    <td> <?=$key6+1;?> </td>
                                    <td>
                                        <span class="label label-sm label-success"> <?=convertLog($row6['type'])?> </span>
                                    </td>
                                    <td> <?=$row6['content']?> </td>
                                    <td class="center"> <?=@Functions::zaman($row6['date'])?> </td>
                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
					<?php endif;?>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    $('#accountForm').submit(function (event) {
        event.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();
        $.ajax({
            url: url,
            dataType: 'json',
            type: 'post',
            data: data,
            processData: false,
            success: function(result){
                if (result.result == 'error'){
                    notify('error','Kullanıcı bulunamadı !');
                }else if(result.result == 'got'){
                    notify('error','Böyle bir kullanıcı adı mevcut!');
                }else if(result.result == true){
                    notify('success','Güncelleme başarılı');
                }
            },
            error: function( jqXhr, textStatus, errorThrown ){
                console.log( errorThrown );
            }
        });
    });
    $(document).ready(function () {
       document.getElementById('sample_1').style.width = '100% !important'
    });

</script>