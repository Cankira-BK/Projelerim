<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Görüntülenen Pazar ID (<?=$this->shopsearch['name']?>)</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Eşya Adı</th>
                        <th>Eşya Adeti</th>
                        <th>Eşya Fiyatı</th>
                        <th>Efsun & Taş</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->shopsearch['data'] as $row):?>
                        <tr>
                            <td><?=$row['id'];?></td>
                            <td><?=Functions::item_adi_goster($row['vnum'])?> (<?=$row['vnum'];?>)</td>
                            <td><?=$row['count'];?></td>
                            <td><?=$row['price']?> Gold <?=$row['cheque_price']?> Won</td>
                            <td><a class="btn blue" data-toggle="modal" href="#<?=$row['id']?>"><i class="fa fa-eye"></i></a></td>
                        </tr>
						<div class="modal fade" id="<?=$row['id'];?>" style="display: none;">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content c-square">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title bold uppercase font-green-soft"><?=Functions::item_adi_goster($row['vnum'])?></h4>
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
                                                    <p style="color: red"><?php if(@array_search(Functions::gameIn('taslar')[$row['socket3']],Functions::gameIn('taslar')) == false){echo 'Taş Yok';}else{echo Functions::gameIn('taslar')[$row['socket3']];}?></p>
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>