<?php
$getItem = $this->getItem["data"];
$itemTime = $getItem['socket0'];
$day = intval($itemTime / 86400);
$hour = intval(($itemTime - ($day * 24 * 60 * 60)) / 3600);
$minute = intval(($itemTime - ($day * 24 * 60 * 60) - ($hour * 60 * 60)) / 60);
?>
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-long-arrow-right"></i><?=$getItem['item_name']?> (Eşya Düzenleme)
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <table id="user" class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <td style="width:15%"> İtem Resmi </td>
                        <td style="width:50%">
                            <img id="myItem" src="<?=URL.$getItem['item_image'];?>" alt="">
                            <a class="btn red btn-circle btn-outline sbold" data-toggle="modal" href="#responsive"><i class="fa fa-image"></i> Değiştir </a>
                        </td>
                        <td style="width:35%">
                        </td>
                    </tr>
                    </tbody>
                </table>
                <form id="itemAdd" class="form-horizontal form-row-seperated" action="<?=URI::get_path('product/change/'.$getItem['item_id']);?>" method="POST">
                    <div class="portlet">
                        <div class="portlet-body">
                            <div class="tabbable-bordered">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_general" data-toggle="tab"> Genel Özellikleri </a>
                                    </li>
                                    <li>
                                        <a href="#tab_meta" data-toggle="tab"> Efsunlar ve Taşlar </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_general">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Eşya Adı:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="itemName" value="<?=$getItem['item_name'];?>" placeholder="">
                                                    <span class="help-block"> Eşyanın adını burdan değiştirebilirsiniz. </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Birim Fiyatı:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="itemEp" required value="<?=$getItem['coins'];?>">
                                                    <span class="help-block"> Eşyanın birim fiyatını burdan değiştirebilirsiniz </span>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="unit_price" required value="<?=$getItem['unit_price'];?>">
                                                    <span class="help-block"> Eşyanın birim adedini burdan değiştirebilirsiniz </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Miktar & İndirim - 1:
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="count_1" placeholder="" value="<?=$getItem['count_1'];?>">
                                                    <span class="help-block"> Eşya miktarını burdan değiştirebilirsiniz</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="discount_1" placeholder="" value="<?=$getItem['discount_1'];?>">
                                                    <span class="help-block"> Miktar indirimi % olarak hesaplanır (yoksa 0 yazınız)</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Miktar & İndirim - 2:
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="count_2" placeholder="" value="<?=$getItem['count_2'];?>">
                                                    <span class="help-block"> Eşya miktarını burdan değiştirebilirsiniz</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="discount_2" placeholder="" value="<?=$getItem['discount_2'];?>">
                                                    <span class="help-block"> Miktar indirimi % olarak hesaplanır (yoksa 0 yazınız)</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Miktar & İndirim - 3:
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="count_3" placeholder="" value="<?=$getItem['count_3'];?>">
                                                    <span class="help-block"> Eşya miktarını burdan değiştirebilirsiniz</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="discount_3" placeholder="" value="<?=$getItem['discount_3'];?>">
                                                    <span class="help-block"> Miktar indirimi % olarak hesaplanır (yoksa 0 yazınız)</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Miktar & İndirim - 4:
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="count_4" placeholder="" value="<?=$getItem['count_4'];?>">
                                                    <span class="help-block"> Eşya miktarını burdan değiştirebilirsiniz</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="discount_4" placeholder="" value="<?=$getItem['discount_4'];?>">
                                                    <span class="help-block"> Miktar indirimi % olarak hesaplanır (yoksa 0 yazınız)</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Miktar & İndirim - 5:
                                                </label>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="count_5" placeholder="" value="<?=$getItem['count_5'];?>">
                                                    <span class="help-block"> Eşya miktarını burdan değiştirebilirsiniz</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="number" class="form-control" name="discount_5" placeholder="" value="<?=$getItem['discount_5'];?>">
                                                    <span class="help-block"> Miktar indirimi % olarak hesaplanır (yoksa 0 yazınız)</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Kategori :
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <select class="table-group-action-input form-control input-xlarge" name="itemCategory">
														<?php
														$kate = \StaticDatabase\StaticDatabase::init()->prepare("SELECT id,name FROM shop_menu WHERE alone = :alone OR NOT mainmenu = :mainmenu");
														$kate->execute(array(':alone'=>'0',':mainmenu'=>'0'));
														$kate->setFetchMode(PDO::FETCH_ASSOC);
														$katet = $kate->fetchAll();
														?>
														<?php foreach ($katet as $rowss):?>
                                                            <?php if ($rowss['id'] == $this->getItem["category"]['id']):?>
                                                                <option value="<?=$rowss['id']?>" selected><?=$rowss['name']?></option>
                                                            <?php else:?>
                                                                <option value="<?=$rowss['id']?>"><?=$rowss['name']?></option>
                                                            <?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Durumu :
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <select class="table-group-action-input form-control input-xlarge" name="status">
                                                        <option value="0">Pasif</option>
                                                        <option value="1" selected>Aktif</option>
                                                        <option value="3">Em Market</option>
                                                    </select>
                                                    <span class="help-block"> Eşyanın Aktiflik Durumu ! </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Süreli Eşya  :
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="md-checkbox-list">
                                                        <div class="md-checkbox has-info">
                                                            <input type="hidden" name="time" class="md-check" value="0">
                                                            <input type="checkbox" name="time" id="checkbox2" class="md-check" value="1" <?php if ($getItem['item_time'] == 1){echo ' checked';}?>>
                                                            <label for="checkbox2">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span><i style="color: red;" id="checkbox2Text"></i> </label>
                                                        </div>
                                                    </div>
                                                    <span class="help-block"> Ekleyeceğiniz eşya süreli ise bunu işaretlemelisiniz ! Aşağıya manuel süre yazabilir ya da boş bırakarak item'in oyundaki süresi otomatik çekilir</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Süresi :
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" name="day" placeholder="Gün" value="<?=$day?>">
                                                    <span class="help-block"> Eşya Kaç Günlük </span>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" name="hour" placeholder="Saat" value="<?=$hour?>">
                                                    <span class="help-block"> Eşya Kaç Saatlik </span>
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number" class="form-control" name="second" placeholder="Dakika" value="<?=$minute?>">
                                                    <span class="help-block"> Eşya Kaç Dakikalık </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Sevilen Ürün  :
                                                </label>
                                                <div class="col-md-8">
                                                    <div class="md-checkbox-list">
                                                        <div class="md-checkbox has-info">
                                                            <input type="hidden" name="popular" class="md-check" value="0">
                                                            <input type="checkbox" name="popular" id="checkbox3" class="md-check" value="1" <?php if ($getItem['popularite'] == 1){echo ' checked';}?>>
                                                            <label for="checkbox3">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span></label>
                                                        </div>
                                                    </div>
                                                    <span class="help-block"> Sevilen ürün olarak seçmek için işaretleyiniz.</span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Eşya Açıklaması:</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control maxlength-handler" rows="8" name="description" required><?=$getItem['description']?></textarea>
                                                    <span class="help-block"> Eşya Açıklamasını Giriniz  </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Eşya Bilgisi:</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control maxlength-handler" rows="8" name="information" required><?=$getItem['information']?></textarea>
                                                    <span class="help-block"> Eşya Bilgisini Giriniz (Max. 100) </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_meta">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Efsun #1 Türü:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="attrType1" style="display: inline;">
														<?php $efsun = Functions::gameIn('efsunlar');?>
														<?php foreach ($efsun as $key=>$row):?>
                                                            <?php if ($getItem['attrtype0'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                    <input type="number" class="form-control input-small" name="attrValue1" value="<?=$getItem['attrvalue0']?>" style="display: inline-block;position: absolute;margin-left: 30px;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Efsun #2 Türü:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="attrType2" style="display: inline;">
														<?php foreach ($efsun as $key=>$row):?>
															<?php if ($getItem['attrtype1'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                    <input type="number" class="form-control input-small" name="attrValue2" value="<?=$getItem['attrvalue1']?>" style="display: inline-block;position: absolute;margin-left: 30px;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Efsun #3 Türü:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="attrType3" style="display: inline;">
														<?php foreach ($efsun as $key=>$row):?>
															<?php if ($getItem['attrtype2'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                    <input type="number" class="form-control input-small" name="attrValue3" value="<?=$getItem['attrvalue2']?>" style="display: inline-block;position: absolute;margin-left: 30px;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Efsun #4 Türü:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="attrType4" style="display: inline;">
														<?php foreach ($efsun as $key=>$row):?>
															<?php if ($getItem['attrtype3'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                    <input type="number" class="form-control input-small" name="attrValue4" value="<?=$getItem['attrvalue3']?>" style="display: inline-block;position: absolute;margin-left: 30px;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Efsun #5 Türü:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="attrType5" style="display: inline;">
														<?php foreach ($efsun as $key=>$row):?>
															<?php if ($getItem['attrtype4'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                    <input type="number" class="form-control input-small" name="attrValue5" value="<?=$getItem['attrvalue4']?>" style="display: inline-block;position: absolute;margin-left: 30px;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Efsun #6 Türü:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="attrType6" style="display: inline;">
														<?php foreach ($efsun as $key=>$row):?>
															<?php if ($getItem['attrtype5'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                    <input type="number" class="form-control input-small" name="attrValue6" value="<?=$getItem['attrvalue5']?>" style="display: inline-block;position: absolute;margin-left: 30px;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Efsun #7 Türü:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="attrType7" style="display: inline;">
														<?php foreach ($efsun as $key=>$row):?>
															<?php if ($getItem['attrtype6'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                    <input type="number" class="form-control input-small" name="attrValue7" value="<?=$getItem['attrvalue6']?>" style="display: inline-block;position: absolute;margin-left: 30px;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Slot #1:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="socket0" style="display: inline;">
														<?php $taslar = Functions::gameIn('taslar');?>
														<?php foreach ($taslar as $key=>$row):?>
															<?php if ($getItem['socket0'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Slot #2:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="socket1" style="display: inline;">
														<?php foreach ($taslar as $key=>$row):?>
															<?php if ($getItem['socket1'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Slot #3:
                                                    <span class="required"> * </span>
                                                </label>
                                                <div class="col-md-10">
                                                    <select class="table-group-action-input form-control input-xlarge" name="socket2" style="display: inline;">
														<?php foreach ($taslar as $key=>$row):?>
															<?php if ($getItem['socket2'] == $key):?>
                                                                <option value="<?=$key?>" selected><?=$row?></option>
															<?php else:?>
                                                                <option value="<?=$key?>"><?=$row?></option>
															<?php endif;?>
														<?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-title">
                            <div class="actions btn-set">
                                <button class="btn btn-success" id="itemAddButton" type="submit">
                                    <i class="fa fa-edit"></i>  Değiştir</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Eşya Resmini Değiştir</h4>
                </div>
                <div class="modal-body">
                    <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form id="logoSetting" action="<?=URI::get_path('product/imageupload/'.$getItem['vnum']);?>" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                    <div class="form-body" style="margin-left: 15px;">
                                        <div class="form-group ">
                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                                    <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> Resim Seç </span>
                                                                    <span class="fileinput-exists"> Değiştir </span>
                                                                    <input type="file" name="logo" id="logo" multiple class="file" data-preview-file-type="any"/> </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Sil </a>
                                                        <button id="imgUpload" class="btn green fileinput-exists" > Yükle </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $url = URI::get_path('product/change/'.$getItem['item_id']);?>
    <script>
        $(document).ready(function() {
            $('#imgUpload').click(function (eve) {
                eve.preventDefault();
                var url = $('#logoSetting').attr('action');
                var data = new FormData($('#logoSetting')[0]);
                var base_url = window.location.origin;
                var pathArray = window.location.pathname.split( '/' );
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        if(result.result == false){
                            if(result.message == 'empty'){
                                notify('error',"İlk önce eşyayı kayıt edin");
                            }else if(result.message == 'error'){
                                notify('error',"Başka bir resim kullanın");
                            }
                        }else if(result.result == true){
                            notify('success',"Eşya resmi başarıyla güncellendi");
                            var paths = window.location.pathname;
                            var protocol = window.location.protocol;
                            var host = window.location.host;
                            var path = paths.split('/')[1];
                            document.getElementById('myItem').src = protocol+'//'+host+'/'+path+'/'+result.message
                        }
                    }
                });
            });
        });
        $('#itemAdd').submit(function (event) {
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
                    if(result.result === true){
                        notify('success',"İtem başarıyla eklendi.");
                    }else{
                        notify('error',result.message);
                    }
                }
            });
        });
    </script>